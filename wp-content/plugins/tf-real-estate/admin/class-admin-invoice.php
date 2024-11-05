<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if ( ! class_exists( 'Admin_Invoice' ) ) {
	/**
	 * Class Admin_Invoice
	 */
	class Admin_Invoice {

		public function tfre_register_column_titles( $columns ) {
			$columns['cb']                     = "<input type=\"checkbox\" />";
			$columns['title']                  = esc_html__( 'Title', 'tf-real-estate' );
			$columns['invoice_payment_status'] = esc_html__( 'Payment Status', 'tf-real-estate' );
			$columns['invoice_payment_method'] = esc_html__( 'Payment Method', 'tf-real-estate' );
			$columns['invoice_price']          = esc_html__( 'Price', 'tf-real-estate' );
			$columns['invoice_buyer_id']       = esc_html__( 'Buyer', 'tf-real-estate' );
			$columns['date']                   = esc_html__( 'Date', 'tf-real-estate' );
			$new_columns                       = array();
			$custom_order                      = array(
				'cb',
				'title',
				'invoice_payment_status',
				'invoice_payment_method',
				'invoice_price',
				'invoice_buyer_id',
				'date'
			);
			foreach ( $custom_order as $colname ) {
				$new_columns[ $colname ] = $columns[ $colname ];
			}

			return $new_columns;
		}

		function tfre_set_page_order_in_admin( $wp_query ) {
			global $pagenow;
			if ( is_admin() && $_GET['post_type'] == 'invoice' && 'edit.php' == $pagenow && !isset($_GET['orderby'])) {
				$wp_query->set( 'orderby', 'date' );
				$wp_query->set( 'order', 'desc' );
			}
		}

		public function tfre_display_column_value( $column ) {
			global $post;
			$invoice_payment_method = get_post_meta( $post->ID, 'invoice_payment_method', true );
			$invoice_payment_status = get_post_meta( $post->ID, 'invoice_payment_status', true );
			$invoice_price          = get_post_meta( $post->ID, 'invoice_price', true );
			$invoice_buyer_id       = get_post_meta( $post->ID, 'invoice_buyer_id', true );
			switch ( $column ) {
				case 'invoice_payment_status':
					echo '<span>' . esc_html__( ( $invoice_payment_status == 0 ? 'Not Paid' : 'Paid' ), 'tf-real-estate' ) . '</span>';
					break;
				case 'invoice_payment_method':
					echo esc_html( Invoice_Public::tfre_get_invoice_payment_method( $invoice_payment_method ) );
					break;
				case 'invoice_price':
					echo esc_html( tfre_get_format_number(floatval($invoice_price)) );
					break;
				case 'invoice_buyer_id':
					$user = get_userdata( $invoice_buyer_id );
					if ( $user ) {
						echo esc_html__( $user->user_login );
					}
					break;
				default:
					# code...
					break;
			}
		}

		public function tfre_filter_restrict_manage_invoices() {
			global $typenow;

			if ( $typenow == 'invoice' ) {
				//Buyer
				$invoice_buyer = isset( $_GET['invoice_buyer'] ) ? wp_unslash( $_GET['invoice_buyer'] ) : '';
				?>
				<input type="text" placeholder="<?php echo esc_attr__( 'Buyer', 'tf-real-estate' ); ?>" name="invoice_buyer"
					value="<?php echo esc_attr( $invoice_buyer ); ?>">
				<?php
				//Payment Status
				$values = array(
					0 => esc_html__( 'Not Paid', 'tf-real-estate' ),
					1 => esc_html__( 'Paid', 'tf-real-estate' ),
				);
				?>
				<select name="invoice_payment_status">
					<option value=""><?php echo esc_html__( 'All Payment Status', 'tf-real-estate' ); ?></option>
					<?php $curr_value = isset( $_GET['invoice_payment_status'] ) ? wp_unslash( $_GET['invoice_payment_status'] ) : '';
					foreach ( $values as $value => $label ) {
						printf
						(
							'<option value="%s"%s>%s</option>',
							$value,
							$value == $curr_value ? ' selected="selected"' : '',
							$label
						);
					}
					?>
				</select>
				<?php
				//Payment method
				$values = array(
					'paypal'        => esc_html__( 'Paypal', 'tf-real-estate' ),
					'wire_transfer' => esc_html__( 'Wire Transfer', 'tf-real-estate' ),
					'free_package'  => esc_html__( 'Free Package', 'tf-real-estate' ),
				);
				?>
				<select name="invoice_payment_method">
					<option value=""><?php echo esc_html__( 'All Payment Methods', 'tf-real-estate' ); ?></option>
					<?php $curr_value = isset( $_GET['invoice_payment_method'] ) ? wp_unslash( $_GET['invoice_payment_method'] ) : '';
					foreach ( $values as $value => $label ) {
						printf
						(
							'<option value="%s"%s>%s</option>',
							$value,
							$value == $curr_value ? ' selected="selected"' : '',
							$label
						);
					}
					?>
				</select>
			<?php }
		}

		public function tfre_handle_filter_restrict_manage_invoices( $query ) {
			global $pagenow;
			$query_vars   = &$query->query_vars;
			$filter_array = array();

			if ( $pagenow == 'edit.php' && isset( $query_vars['post_type'] ) && $query_vars['post_type'] == 'invoice' ) {
				$invoice_buyer = isset( $_GET['invoice_buyer'] ) ? wp_unslash( $_GET['invoice_buyer'] ) : '';
				if ( $invoice_buyer != '' ) {
					$user    = get_user_by( 'login', $invoice_buyer );
					$user_id = -1;
					if ( $user ) {
						$user_id = $user->ID;
					}
					$filter_array[] = array(
						'key'     => 'invoice_buyer_id',
						'value'   => $user_id,
						'compare' => 'IN',
					);
				}

				$curr_invoice_payment_status = isset( $_GET['invoice_payment_status'] ) ? wp_unslash( $_GET['invoice_payment_status'] ) : '';
				if ( $curr_invoice_payment_status != '' ) {
					$filter_array[] = array(
						'key'     => 'invoice_payment_status',
						'value'   => $curr_invoice_payment_status,
						'compare' => '=',
					);
				}

				$curr_invoice_payment_method = isset( $_GET['invoice_payment_method'] ) ? wp_unslash( $_GET['invoice_payment_method'] ) : '';
				if ( $curr_invoice_payment_method != '' ) {
					$filter_array[] = array(
						'key'     => 'invoice_payment_method',
						'value'   => $curr_invoice_payment_method,
						'compare' => '=',
					);
				}

				if ( ! empty( $filter_array ) ) {
					$query_vars['meta_query'] = $filter_array;
				}
			}
		}
	}
}