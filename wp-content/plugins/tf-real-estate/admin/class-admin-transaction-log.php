<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if ( ! class_exists( 'Admin_Transaction_Log' ) ) {
	/**
	 * Class Admin_Transaction_Log
	 */
	class Admin_Transaction_Log {
		private static $_instance;

		public static function getInstance() {
			if ( self::$_instance == null ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		public function tfre_register_custom_column_titles( $columns ) {
			$columns['cb']                       = "<input type=\"checkbox\" />";
			$columns['title']                    = esc_html__( 'Title', 'tf-real-estate' );
			$columns['trans_log_payment_method'] = esc_html__( 'Payment Method', 'tf-real-estate' );
			$columns['trans_log_price']          = esc_html__( 'Price', 'tf-real-estate' );
			$columns['trans_log_buyer_id']       = esc_html__( 'Buyer', 'tf-real-estate' );
			$columns['trans_log_status']         = esc_html__( 'Status', 'tf-real-estate' );
			$columns['date']                     = esc_html__( 'Date', 'tf-real-estate' );
			$new_columns                         = array();
			$custom_order                        = array(
				'cb',
				'title',
				'trans_log_payment_method',
				'trans_log_price',
				'trans_log_buyer_id',
				'trans_log_status',
				'date'
			);
			foreach ( $custom_order as $colname ) {
				$new_columns[ $colname ] = $columns[ $colname ];
			}

			return $new_columns;
		}

		function tfre_set_page_order_in_admin( $wp_query ) {
			global $pagenow;
			if ( is_admin() && $_GET['post_type'] == 'transaction-log' && 'edit.php' == $pagenow && !isset($_GET['orderby'])) {
				$wp_query->set( 'orderby', 'date' );
				$wp_query->set( 'order', 'desc' );
			}
		}

		public function tfre_display_column_value( $column ) {
			global $post;
			$trans_log_payment_method = get_post_meta( $post->ID, 'trans_log_payment_method', true );
			$trans_log_price          = get_post_meta( $post->ID, 'trans_log_price', true );
			$trans_log_buyer_id       = get_post_meta( $post->ID, 'trans_log_buyer_id', true );
			$trans_log_status         = get_post_meta( $post->ID, 'trans_log_status', true );
			switch ( $column ) {
				case 'trans_log_payment_method':
					echo esc_html( Invoice_Public::tfre_get_invoice_payment_method( $trans_log_payment_method ) );
					break;
				case 'trans_log_price':
					echo esc_html( tfre_get_format_number(floatval($trans_log_price)) );
					break;
				case 'trans_log_buyer_id':
					$user_info = get_userdata( $trans_log_buyer_id );
					if ( $user_info ) {
						echo esc_html( $user_info->display_name );
					}
					break;
				case 'trans_log_status':

					if ( $trans_log_status == 1 ) {
						echo '<span>' . esc_html__( 'Succeeded', 'tf-real-estate' ) . '</span>';
					} else {
						echo '<span>' . esc_html__( 'Failed', 'tf-real-estate' ) . '</span>';
					}
					break;
			}
		}

		public function tfre_filter_restrict_manage_transaction_log() {
			global $typenow;

			if ( $typenow == 'transaction-log' ) {
				//Invoice Status
				$values    = array(
					1 => esc_html__( 'Succeeded', 'tf-real-estate' ),
					0 => esc_html__( 'Failed', 'tf-real-estate' ),
				);
				$current_v = isset( $_GET['trans_log_status'] ) ? wp_unslash( $_GET['trans_log_status'] ) : '';
				?>
				<select name="trans_log_status">
					<option value=""><?php _e( 'All Status', 'tf-real-estate' ); ?></option>
					<?php foreach ( $values as $k => $v ) : ?>
						<option value="<?php echo esc_attr( $k ) ?>" <?php selected( $k, $current_v ) ?>><?php echo esc_html( $v ) ?>
						</option>
					<?php endforeach; ?>
					?>
				</select>
				<?php
				//Payment method
				$values    = array(
					'paypal'        => esc_html__( 'Paypal', 'tf-real-estate' ),
					'stripe'        => esc_html__( 'Stripe', 'tf-real-estate' ),
					'wire_transfer' => esc_html__( 'Wire Transfer', 'tf-real-estate' ),
					'free_package'  => esc_html__( 'Free Package', 'tf-real-estate' ),
				);
				$current_v = isset( $_GET['trans_log_payment_method'] ) ? wp_unslash( $_GET['trans_log_payment_method'] ) : '';
				?>
				<select name="trans_log_payment_method">
					<option value=""><?php _e( 'All Payment Methods', 'tf-real-estate' ); ?></option>
					<?php foreach ( $values as $k => $v ) : ?>
						<option value="<?php echo esc_attr( $k ) ?>" <?php selected( $k, $current_v ) ?>><?php echo esc_html( $v ) ?>
						</option>
					<?php endforeach; ?>

				</select>
				<?php
				// Buyer
				$trans_log_user = isset( $_GET['trans_log_buyer'] ) ? wp_unslash( $_GET['trans_log_buyer'] ) : '';
				?>
				<input type="text" placeholder="<?php esc_attr_e( 'Buyer', 'tf-real-estate' ); ?>" name="trans_log_buyer"
					value="<?php echo esc_attr( $trans_log_user ); ?>">
			<?php }
		}

		public function tfre_handle_filter_restrict_manage_transaction_log( $query ) {
			global $pagenow;
			$query_vars   = &$query->query_vars;
			$filter_array = array();

			if ( $pagenow == 'edit.php' && isset( $query_vars['post_type'] ) && $query_vars['post_type'] == 'transaction-log' ) {
				$trans_log_buyer = isset( $_GET['trans_log_buyer'] ) ? wp_unslash( $_GET['trans_log_buyer'] ) : '';
				if ( $trans_log_buyer != '' ) {
					$user    = get_user_by( 'login', $trans_log_buyer );
					$user_id = -1;
					if ( $user ) {
						$user_id = $user->ID;
					}
					$filter_array[] = array(
						'key'     => 'trans_log_buyer_id',
						'value'   => $user_id,
						'compare' => 'IN',
					);
				}

				$curr_trans_log_status = isset( $_GET['trans_log_status'] ) ? wp_unslash( $_GET['trans_log_status'] ) : '';
				if ( $curr_trans_log_status != '' ) {
					$filter_array[] = array(
						'key'     => 'trans_log_status',
						'value'   => $curr_trans_log_status,
						'compare' => '=',
					);
				}

				$curr_trans_log_payment_method = isset( $_GET['trans_log_payment_method'] ) ? wp_unslash( $_GET['trans_log_payment_method'] ) : '';
				if ( $curr_trans_log_payment_method != '' ) {
					$filter_array[] = array(
						'key'     => 'trans_log_payment_method',
						'value'   => $curr_trans_log_payment_method,
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