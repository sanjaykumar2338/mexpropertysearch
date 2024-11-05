<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Payment_Public' ) ) {
	class Payment_Public {

		public $tfre_package;
		public $tfre_invoice;
		public $tfre_user_package;
		public $tfre_transaction_log;

		private static $_instance;

		public static function getInstance() {
			if ( self::$_instance == null ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		public function __construct() {
			$this->tfre_package         = new Package_Public();
			$this->tfre_invoice         = new Invoice_Public();
			$this->tfre_user_package    = new User_Package_Public();
			$this->tfre_transaction_log = new Transaction_Logs_Public();
		}

		public function tfre_register_payment_scripts() {
			$payment_variables = array(
				'ajax_url' => TF_AJAX_URL,
			);
			wp_register_script( 'payment-script', TF_PLUGIN_URL . 'public/assets/js/payment.js', array( 'jquery' ), false, true );
			wp_localize_script( 'payment-script', 'payment_variables', $payment_variables );
		}

		public function tfre_payment_invoice_shortcode() {
			ob_start();
			tfre_get_template_with_arguments(
				'payment/payment-invoice.php',
				array()
			);
			return ob_get_clean();
		}

		public function tfre_payment_completed_shortcode() {
			ob_start();
			tfre_get_template_with_arguments(
				'payment/payment-completed.php',
				array()
			);
			return ob_get_clean();
		}

		private function tfre_get_paypal_access_token() {
			$is_paypal_live = tfre_get_option( 'paypal_api' );
			$host           = 'https://api.sandbox.paypal.com';
			if ( $is_paypal_live == 'live' ) {
				$host = 'https://api.paypal.com';
			}
			$url_request              = $host . '/v1/oauth2/token';
			$paypal_client_id         = tfre_get_option( 'paypal_client_id' );
			$paypal_client_secret_key = tfre_get_option( 'paypal_client_secret_key' );
			$auth                     = base64_encode( $paypal_client_id . ':' . $paypal_client_secret_key );
			$response                 = wp_remote_post( $url_request, array(
				'sslverify' => false,
				'headers'   => array(
					'Authorization' => "Basic {$auth}"
				),
				'body'      => 'grant_type=client_credentials'
			) );
			$status                   = wp_remote_retrieve_response_code( $response );
			if ( $status === 200 || $status === 201 ) {
				$content = json_decode( wp_remote_retrieve_body( $response ) );
				return $content->access_token;
			}
			return null;
		}

		private function tfre_execute_paypal_request( $url, $json, $access_token ) {
			$response = wp_remote_post( $url, array(
				'sslverify' => false,
				'headers'   => array(
					'Authorization' => "Bearer {$access_token}",
					'Accept'        => 'application/json',
					'Content-Type'  => 'application/json'
				),
				'body'      => $json
			) );
			$status   = wp_remote_retrieve_response_code( $response );
			if ( $status === 200 || $status === 201 ) {
				$content = json_decode( wp_remote_retrieve_body( $response ), true );
				return $content;
			}
			return wp_remote_retrieve_response_message( $response );
		}

		public function tfre_handle_payment_invoice_by_paypal() {
			check_ajax_referer( 'tfre_payment_ajax_nonce', 'tfre_security_payment' );
			if ( ! is_user_logged_in() ) {
				exit();
			}
			global $current_user;
			wp_get_current_user();
			$user_id                 = $current_user->ID;
			$home_url                = esc_url( home_url() );
			$package_id              = isset( $_POST['package_id'] ) ? absint( wp_unslash( $_POST['package_id'] ) ) : 0;
			$user_package_id         = get_the_author_meta( 'package_id', $user_id );
			$user_package_price      = floatval( get_post_meta( $user_package_id, 'package_price', true ) );
			$package_price           = floatval( get_post_meta( $package_id, 'package_price', true ) );
			$package_name            = get_the_title( $package_id );
			$check_package_available = $this->tfre_user_package->tfre_check_user_package_available( $user_id );

			if ( empty( $package_id ) && empty( $package_price ) ) {
				exit();
			}

			if ( ! empty( $user_package_id ) && ( $check_package_available == 1 ) && ( $package_price < $user_package_price ) ) {
				exit();
			}

			$currency_code       = tfre_get_option( 'currency_code', 'USD' );
			$payment_description = esc_html__( 'Membership payment ', 'tf-real-estate' ) . $package_name . ' on ' . $home_url;
			$paypal_api          = tfre_get_option( 'paypal_api' );
			$host                = 'https://api.sandbox.paypal.com';
			if ( $paypal_api == 'live' ) {
				$host = 'https://api.paypal.com';
			}
			$paypal_url                  = $host . '/v1/payments/payment';
			$access_token                = $this->tfre_get_paypal_access_token();
			$payment_completed_page_link = tfre_get_permalink( 'payment_completed_page' );
			$return_url                  = add_query_arg( array( 'payment_method' => 1 ), $payment_completed_page_link );
			$cancel_url                  = tfre_get_permalink( 'dashboard_page' );
			if ( $access_token == null ) {
				echo sanitize_url( remove_query_arg( array( 'payment_method' ), $return_url ) );
				exit();
			}

			$payment_request = array(
				'intent'        => 'sale',
				'payer'         => array( "payment_method" => "paypal" ),
				"redirect_urls" => array(
					"return_url" => $return_url,
					"cancel_url" => $cancel_url
				),
			);

			$payment_request['transactions'][0] = array(
				'amount'          => array(
					'total'    => $package_price,
					'currency' => $currency_code,
					'details'  => array(
						'subtotal' => $package_price,
						'tax'      => '0.00',
						'shipping' => '0.00'
					)
				),
				'description'     => $payment_description,
				"payment_options" => array(
					"allowed_payment_method" => "INSTANT_FUNDING_SOURCE"
				)
			);

			$payment_request['transactions'][0]['item_list']['items'][] = array(
				'quantity' => '1',
				'name'     => esc_html__( 'Payment Package', 'tf-real-estate' ),
				'price'    => $package_price,
				'currency' => $currency_code,
				'sku'      => $package_name . ' ' . esc_html__( 'Payment Package', 'tf-real-estate' ),
			);

			$payment_request_json = json_encode( $payment_request );
			$json_response        = $this->tfre_execute_paypal_request( $paypal_url, $payment_request_json, $access_token );
			$payment_approval_url = $payment_execute_url = '';
			foreach ( $json_response['links'] as $key => $link ) {
				if ( $link['rel'] == 'execute' ) {
					$payment_execute_url = $link['href'];
				} else if ( $link['rel'] == 'approval_url' ) {
					$payment_approval_url = $link['href'];
				}
			}
			$transfer_data['payment_execute_url'] = $payment_execute_url;
			$transfer_data['access_token']        = $access_token;
			$transfer_data['package_id']          = $package_id;
			update_user_meta( $user_id, 'paypal_transfer', $transfer_data );
			echo sanitize_url( $payment_approval_url );
			wp_die();
		}

		public function tfre_payment_completed_by_paypal() {
			global $current_user;
			wp_get_current_user();
			$user_id        = $current_user->ID;
			$user_email     = $current_user->user_email;
			$admin_email    = get_bloginfo( 'admin_email' );
			$payment_method = 'paypal';
			try {
				if ( isset( $_GET['token'] ) && isset( $_GET['PayerID'] ) ) {
					$payer_id      = wp_unslash( $_GET['PayerID'] );
					$payment_id    = wp_unslash( $_GET['paymentId'] );
					$transfer_data = get_user_meta( $user_id, 'paypal_transfer', true );
					if ( empty( $transfer_data ) ) {
						return;
					}
					$payment_execute_url = $transfer_data['payment_execute_url'];
					$access_token        = $transfer_data['access_token'];
					$package_id          = $transfer_data['package_id'];
					$payment_execute     = array(
						'payer_id' => $payer_id
					);
					$json                = json_encode( $payment_execute );
					$json_response       = $this->tfre_execute_paypal_request( $payment_execute_url, $json, $access_token );
					delete_user_meta( $user_id, 'paypal_transfer' );
					if ( $json_response['state'] == 'approved' ) {
						$package_price = floatval( get_post_meta( $package_id, 'package_price', true ) );
						$this->tfre_user_package->tfre_insert_user_package( $user_id, $package_id );
						$invoice_id       = $this->tfre_invoice->tfre_insert_invoice( $package_id, $user_id, $payment_method, $payment_id, 'package', $payer_id, 1 );
						$args_admin_email = array(
							'invoice_no'  => $invoice_id,
							'total_price' => tfre_get_format_number( $package_price )
						);
						tfre_send_email( $admin_email, 'admin_email_paid_package', $args_admin_email );
						tfre_send_email( $user_email, 'user_email_paid_package', array() );
					} else {
						$message = esc_html__( 'Transaction failed', 'tf-real-estate' );
						$this->tfre_transaction_log->tfre_insert_transaction_log( $package_id, $user_id, $payment_method, $payment_id, 'package', $payer_id, 0, 0, $message );
						$error = '<div class="alert alert-danger" role="alert">' . wp_kses_post( __( '<strong>Error!</strong> Transaction failed', 'tf-real-estate' ) ) . '</div>';
						echo wp_kses_post( $error );
					}
				}
			} catch (Exception $e) {
				$error = '<div class="alert alert-danger" role="alert"><strong>' . esc_html__( 'Error!', 'tf-real-estate' ) . '</strong> ' . wp_kses_post( $e->getMessage() ) . '</div>';
				echo wp_kses_post( $error );
			}
		}

		public function tfre_handle_payment_invoice_by_wire_transfer() {
			check_ajax_referer( 'tfre_payment_ajax_nonce', 'tfre_security_payment' );
			if ( ! is_user_logged_in() ) {
				exit();
			}
			global $current_user;
			$current_user            = wp_get_current_user();
			$user_id                 = $current_user->ID;
			$user_email              = $current_user->user_email;
			$admin_email             = get_bloginfo( 'admin_email' );
			$package_id              = isset( $_POST['package_id'] ) ? absint( wp_unslash( $_POST['package_id'] ) ) : 0;
			$package_price           = floatval( get_post_meta( $package_id, 'package_price', true ) );
			$user_package_id         = absint( get_the_author_meta( 'package_id', $user_id ) );
			$user_package_price      = floatval( get_post_meta( $user_package_id, 'package_price', true ) );
			$check_package_available = $this->tfre_user_package->tfre_check_user_package_available( $user_id );

			if ( empty( $package_id ) ) {
				exit();
			}

			if ( ! empty( $user_package_id ) && ( $check_package_available == 1 ) && ( $package_price < $user_package_price ) ) {
				exit();
			}

			$payment_method = 'wire_transfer';
			$invoice_id     = $this->tfre_invoice->tfre_insert_invoice( $package_id, $user_id, $payment_method, '', 'package', '', 0 );
			$args_email     = array(
				'invoice_no'  => $invoice_id,
				'total_price' => tfre_get_format_number( $package_price )
			);
			tfre_send_email( $admin_email, 'admin_email_wire_transfer', $args_email );
			tfre_send_email( $user_email, 'user_email_wire_transfer', $args_email );
			$payment_completed_page_link = tfre_get_permalink( 'payment_completed_page' );
			$return_url                  = add_query_arg( array( 'payment_method' => 2 ), $payment_completed_page_link );
			echo sanitize_url( $return_url );
			wp_die();
		}

		public function tfre_handle_free_package() {
			check_ajax_referer( 'tfre_payment_ajax_nonce', 'tfre_security_payment' );
			if ( ! is_user_logged_in() ) {
				exit();
			}
			global $current_user;
			wp_get_current_user();
			$user_id                     = $current_user->ID;
			$user_free_package           = get_the_author_meta( 'free_package', $user_id );
			$payment_completed_page_link = tfre_get_permalink( 'payment_completed_page' );
			if ( empty( $user_free_package ) ) {
				$package_id = isset( $_POST['package_id'] ) ? absint( wp_unslash( $_POST['package_id'] ) ) : 0;
				$this->tfre_user_package->tfre_insert_user_package( $user_id, $package_id );
				$payment_method = 'free_package';
				$invoice_id     = $this->tfre_invoice->tfre_insert_invoice( $package_id, $user_id, $payment_method, '', 'package', '', 1 );
				update_user_meta( $user_id, 'free_package', 'yes' );
				$return_url = add_query_arg( array( 'payment_method' => 3 ), $payment_completed_page_link );
				echo sanitize_url( $return_url );
				wp_die();
			} else {
				echo sanitize_url( $payment_completed_page_link );
				wp_die();
			}
		}

		public static function tfre_handle_payment_invoice_by_stripe( $package_id = null ) {
			require_once( TF_PLUGIN_PATH . '/includes/libraries/stripe-php/init.php' );
			$stripe_publishable_key = tfre_get_option( 'stripe_publishable_key' );
			$stripe_secret_key      = tfre_get_option( 'stripe_secret_key' );
			\Stripe\Stripe::setApiKey( $stripe_secret_key );
			global $current_user;
			wp_get_current_user();
			$user_id    = $current_user->ID;
			$user_email = get_the_author_meta( 'user_email', $user_id );
			if ( $package_id == null ) {
				$package_id = isset( $_POST['packageID'] ) ? absint( wp_unslash( $_POST['packageID'] ) ) : 0;
			}
			$package_name  = get_the_title( $package_id );
			$package_price = floatval( get_post_meta( $package_id, 'package_price', true ) );
			$currency_code = tfre_get_option( 'currency_code', 'USD' );
			if ( ! tfre_is_zero_decimal_currency( $currency_code ) ) {
				$package_price = $package_price * 100;
			}

			$payment_completed_page_link = tfre_get_permalink( 'payment_completed_page' );
			$stripe_success_url          = add_query_arg( array( 'payment_method' => 4 ), $payment_completed_page_link );
			$stripe_cancel_url           = tfre_get_permalink( 'dashboard_page' );
			wp_enqueue_script( 'stripe-checkout' );
			wp_localize_script( 'stripe-checkout', 'stripe_variables', array(
				'stripe_payment' => array(
					'key'  => $stripe_publishable_key,
					'data' => array(
						'amount'         => $package_price,
						'email'          => $user_email,
						'currency'       => $currency_code,
						'zipCode'        => true,
						'billingAddress' => true,
						'name'           => esc_html__( 'Payment Package', 'tf-real-estate' ),
						'description'    => wp_kses_post( sprintf( __( '%s Payment', 'tf-real-estate' ), $package_name ) )
					)
				)
			) );
			?>
			<form class="stripe-payment-form" id="stripe_payment" action=<?php echo esc_url( $stripe_success_url ) ?> method="post">
				<button class="stripe-checkout-button" style="display:none !important"></button>
				<input type="hidden" id="package_id" name="package_id" value="<?php echo esc_attr( $package_id ); ?>" />
				<input type="hidden" id="payment_amount" name="payment_amount" value="<?php echo esc_attr( $package_price ); ?>" />
			</form>
			<?php
		}

		public function tfre_payment_completed_by_stripe() {
			require_once( TF_PLUGIN_PATH . '/includes/libraries/stripe-php/init.php' );
			$stripe_publishable_key = tfre_get_option( 'stripe_publishable_key' );
			$stripe_secret_key      = tfre_get_option( 'stripe_secret_key' );
			\Stripe\Stripe::setApiKey( $stripe_secret_key );
			global $current_user;
			wp_get_current_user();
			$user_id        = $current_user->ID;
			$user_email     = $current_user->user_email;
			$admin_email    = get_bloginfo( 'admin_email' );
			$payment_method = 'stripe';
			$currency_code  = tfre_get_option( 'currency_code', 'USD' );
			$payment_id     = $payer_id = $stripe_email = '';

			if ( isset( $_POST['stripeEmail'] ) && is_email( $_POST['stripeEmail'] ) ) {
				$stripe_email = sanitize_email( wp_unslash( $_POST['stripeEmail'] ) );
			}

			if ( isset( $_POST['package_id'] ) && ! is_numeric( wp_unslash( $_POST['package_id'] ) ) ) {
				die();
			}

			if ( isset( $_POST['payment_amount'] ) && ! is_numeric( wp_unslash( $_POST['payment_amount'] ) ) ) {
				die();
			}
			try {
				$stripe_token   = isset( $_POST['stripeToken'] ) ? wp_unslash( $_POST['stripeToken'] ) : '';
				$payment_amount = isset( $_POST['payment_amount'] ) ? floatval( wp_unslash( $_POST['payment_amount'] ) ) : 0;
				$package_id     = isset( $_POST['package_id'] ) ? absint( wp_unslash( $_POST['package_id'] ) ) : 0;

				$customer = \Stripe\Customer::create( array(
					'email'  => $stripe_email,
					'source' => $stripe_token
				) );

				$charge = \Stripe\Charge::create( array(
					'amount'   => $payment_amount,
					'customer' => $customer->id,
					'currency' => $currency_code
				) );

				if ( isset( $charge->id ) && ( ! empty( $charge->id ) ) ) {
					$payment_id = $charge->id;
				}

				if ( isset( $customer->id ) && ( ! empty( $customer->id ) ) ) {
					$payer_id = $customer->id;
				}

				if ( isset( $charge->status ) && ( ! empty( $charge->status ) ) ) {
					if ( $charge->status == 'succeeded' ) {
						$package_price = floatval( get_post_meta( $package_id, 'package_price', true ) );
						$this->tfre_user_package->tfre_insert_user_package( $user_id, $package_id );
						$invoice_id       = $this->tfre_invoice->tfre_insert_invoice( $package_id, $user_id, $payment_method, $payment_id, 'package', $payer_id, 1 );
						$args_admin_email = array(
							'invoice_no'  => $invoice_id,
							'total_price' => tfre_get_format_number( $package_price )
						);
						tfre_send_email( $admin_email, 'admin_email_paid_package', $args_admin_email );
						tfre_send_email( $user_email, 'user_email_paid_package', array() );
					} else {
						$message = esc_html( 'Your payment has been Failed!', 'tf-real-estate' );
						$this->tfre_transaction_log->tfre_insert_transaction_log( $package_id, $user_id, $payment_method, $payment_id, 'package', $payer_id, 0, 0, $message );
						$error = '<div class="alert alert-danger" role="alert">' . wp_kses_post( __( '<strong>Error!</strong> transaction failed', 'tf-real-estate' ) ) . '</div>';
						echo wp_kses_post( $error );
					}
				}
			} catch (\Exception $e) {
				$error = '<div class="alert alert-danger" role="alert"><strong>' . esc_html__( 'Error!', 'tf-real-estate' ) . '</strong>' . wp_kses_post( $e->getMessage() ) . '</div>';
				echo wp_kses_post( $error );
			}
		}
	}
}