<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if ( ! class_exists( 'Dashboard' ) ) {
	class Dashboard {
		function tfre_enqueue_dashboard_scripts() {
			wp_enqueue_script( 'datetimepicker', TF_PLUGIN_URL . '/public/assets/js/datetimepicker.js', array( 'jquery' ), null, false );
			wp_enqueue_script( 'dashboard-js', TF_PLUGIN_URL . '/public/assets/js/dashboard.js', array( 'jquery' ), null, false );
			wp_localize_script( 'dashboard-js', 'dashboard_variables',
				array(
					'ajax_url'                     => TF_AJAX_URL,
					'confirm_action_property_text' => esc_html__( 'Are you sure you want to ', 'tf-real-estate' ),
					'nonce'                        => wp_create_nonce( 'dashboard-ajax-nonce' ),
				)
			);
		}
		public static function tfre_dashboard_shortcode() {
			ob_start();
			$posts_per_page   = '10';
			$list_post_status = array(
				'publish' => esc_html__( 'publish', 'tf-real-estate' ),
				'expired' => esc_html__( 'expired', 'tf-real-estate' ),
				'pending' => esc_html__( 'pending', 'tf-real-estate' ),
				'hidden'  => esc_html__( 'hidden', 'tf-real-estate' ),
				'sold'    => esc_html__( 'sold', 'tf-real-estate' ) );
			$total_post       = wp_count_posts( 'real-estate' );
			$total_count      = 0;

			// Sum up the counts for all post statuses
			foreach ( $total_post as $status => $status_count ) {
				$total_count += $status_count;
			}

			$selected_post_status = $title_search = '';
			$from_date = ! empty( $_REQUEST['from_date'] ) ? wp_unslash( $_REQUEST['from_date'] ) : '';
			$to_date   = ! empty( $_REQUEST['to_date'] ) ? wp_unslash( $_REQUEST['to_date'] ) : '';

			$current_user = wp_get_current_user();
			$author_id    = $current_user->ID;
			// count review by user 
			$review_args     = array(
				'user_id' => $author_id,
				'type'    => 'comment',
				'count'   => true
			);
			$total_review    = get_comments( $review_args );
			$class_property  = new Property_Public();
			$total_favorites = $class_property->tfre_get_total_my_favorites();

			$title_search = ! empty( $_REQUEST['title_search'] ) ? wp_unslash( $_REQUEST['title_search'] ) : '';
			// get list pending property by user.
			$pending_post_by_user_args = array(
				'post_type'      => 'real-estate',
				'author'         => $author_id,
				'posts_per_page' => -1,
				'post_status'    => 'pending',
			);
			if ( current_user_can( 'administrator' ) ) {
				$pending_post_by_user_args['author'] = 0;
			}
			$pending_data             = new WP_Query( $pending_post_by_user_args );
			$pending_post_by_user     = $pending_data->found_posts;
			$publish_property_by_user = count_user_posts( $author_id, 'real-estate', true );
			$args                     = array(
				'post_type'           => 'real-estate',
				'post_status'         => $list_post_status,
				'author'              => $author_id,
				'ignore_sticky_posts' => 1,
				'posts_per_page'      => $posts_per_page,
				'offset'              => ( max( 1, get_query_var( 'paged' ) ) - 1 ) * $posts_per_page,
				'orderby'             => 'date',
				'order'               => 'desc',
				's'                   => $title_search,
				'date_query'          => array(
					'after'     => $from_date,
					'before'    => $to_date,
					'inclusive' => true,
				),
			);

			if ( current_user_can( 'administrator' ) ) {
				$args['author']      = 0;
				$args['post_status'] = array( 'any', 'expired', 'hidden', 'sold' );
			}

			if ( ! empty( $_REQUEST['post_status'] ) && $_REQUEST['post_status'] != 'default' ) {
				$selected_post_status = wp_unslash( $_REQUEST['post_status'] );
				$args['post_status']  = $selected_post_status;
			} else {
				$args['post_status'] = array( 'any', 'expired', 'hidden', 'sold' );
			}
			$properties         = new WP_Query( $args );
			$total_post_listing = $properties->found_posts;
			// Get review data
			$comments = get_comments( array(
				'post_type'           => 'real-estate',
				'status'              => 'approve',
				'ignore_sticky_posts' => 1,
				'number'              => 5,
				'orderby'             => 'date',
				'order'               => 'DESC',
				'meta_query'          => array(
					'key' => 'property_rating'
				)
			) );
			wp_reset_postdata();
			tfre_get_template_with_arguments(
				'/dashboard/dashboard.php',
				array(
					'properties'               => $properties->posts,
					'pending_properties'       => $pending_post_by_user,
					'publish_property_by_user' => current_user_can( 'administrator' ) ? $total_post_listing : $publish_property_by_user,
					'total_post'               => $total_count,
					'total_post_listing'       => $total_post_listing,
					'max_num_pages'            => $properties->max_num_pages,
					'list_post_status'         => $list_post_status,
					'selected_post_status'     => $selected_post_status,
					'search'                   => $title_search,
					'from_date'                => $from_date,
					'to_date'                  => $to_date,
					'total_favorite'           => $total_favorites,
					'total_review'             => $total_review,
					'reviews'                  => $comments
				)
			);
			return ob_get_clean();
		}

		public function tfre_handle_actions_properties_dashboard() {
			check_ajax_referer( 'dashboard-ajax-nonce', 'security' );
			if ( ! empty( $_REQUEST['property_action'] ) ) {
				$property_action = isset( $_REQUEST['property_action'] ) ? wp_unslash( $_REQUEST['property_action'] ) : '';
				$property_id     = isset( $_REQUEST['property_id'] ) ? absint( wp_unslash( $_REQUEST['property_id'] ) ) : '';
				$response        = array(
					'status' => false
				);
				try {
					switch ( $property_action ) {
						case 'delete':
							wp_trash_post( $property_id );
							$response['status'] = true;
							echo json_encode( $response );
							wp_die();
							break;
						case 'sold':
							$data_update = array(
								'ID'          => $property_id,
								'post_type'   => 'real-estate',
								'post_status' => 'sold'
							);
							wp_update_post( $data_update );
							$response['status'] = true;
							echo json_encode( $response );
							wp_die();
							break;
						default:
							# code...
							break;
					}
				} catch (\Throwable $th) {
					//throw $th;
				}
			}
		}

		public static function tfre_get_chart_data() {
			global $current_user;
			wp_get_current_user();
			$tracking_view_day = ! empty( $_REQUEST['tracking_view_day'] ) ? $_REQUEST['tracking_view_day'] : 7;
			$tracking_view_day--;

			$all_properties = get_posts( array(
				'author'         => current_user_can( 'administrator' ) ? 0 : $current_user->ID,
				'posts_per_page' => -1,
				'post_type'      => 'real-estate',
				'post_status'    => array( 'publish' )
			) );
			$array_data     = array();
			for ( $i = $tracking_view_day; $i >= 0; $i-- ) {
				$date  = date( 'Y-m-d', strtotime( '-' . $i . 'day' ) );
				$total = 0;
				foreach ( $all_properties as $key => $value ) {
					$views_by_date = get_post_meta( $value->ID, 'property_views_by_date', true );

					if ( ! is_array( $views_by_date ) ) {
						$views_by_date = array();
					}

					if ( isset( $views_by_date[ $date ] ) ) {
						$total += $views_by_date[ $date ];
					}
				}
				$array_data[] = $total;
			}
			return $array_data;
		}

		public static function tfre_get_chart_labels() {
			$tracking_view_day = ! empty( $_REQUEST['tracking_view_day'] ) ? $_REQUEST['tracking_view_day'] : 7;
			$tracking_view_day--;

			$array_labels = array();
			for ( $i = $tracking_view_day; $i >= 0; $i-- ) {
				$date           = strtotime( date( "Y-m-d", strtotime( "-" . $i . "day" ) ) );
				$array_labels[] = date_i18n( get_option( 'date_format' ), $date );
			}
			return $array_labels;
		}

		public function tfre_dashboard_insight_chart_ajax() {
			$response = array(
				'status'  => false,
				'message' => esc_html__( 'Error, try again !', 'tf-real-estate' )
			);

			if ( ! is_user_logged_in() ) {
				$response['message'] = esc_html( 'You aren\'t login', 'tf-real-estate' );
				echo json_encode( $response );
				wp_die();
			}

			$nonce = isset( $_POST['nonce'] ) ? wp_unslash( $_POST['nonce'] ) : '';
			if ( ! isset( $nonce ) || ! wp_verify_nonce( $nonce, 'dashboard-ajax-nonce' ) ) {
				$response['message'] = esc_html__( 'Check nonce failed!', 'tf-real-estate' );
				echo json_encode( $response );
				wp_die();
			}

			$response = array(
				'status'       => true,
				'message'      => esc_html__( 'Successfully', 'tf-real-estate' ),
				'chart_labels' => Dashboard::tfre_get_chart_labels(),
				'chart_data'   => Dashboard::tfre_get_chart_data(),
				'chart_type'   => 'line',
				'chart_label'  => esc_html__( 'Page Views', 'tf-real-estate' )
			);
			echo json_encode( $response );
			wp_die();
		}
	}
}