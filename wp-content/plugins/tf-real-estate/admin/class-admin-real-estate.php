<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if ( ! class_exists( 'Admin_Real_Estate' ) ) {
	/*
	 * Class Admin_Real_Estate 
	 */
	class Admin_Real_Estate {

		public function tfre_allow_only_admin_access_wpadmin() {
			$user = wp_get_current_user();
			if ( ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) && ! current_user_can( 'administrator' ) && ( empty( $user ) || ! in_array( "administrator", (array) $user->roles ) ) ) {
				$redirect = isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : home_url();
				exit( wp_safe_redirect( $redirect ) );
			}
		}

		public function tfre_remove_admin_bar() {
			if ( ! current_user_can( 'administrator' ) && ! is_admin() ) {
				show_admin_bar( false );
			}
		}

		public function modify_list_row_actions( $actions, $post ) {
			// Check for your post type.
			if ( $post->post_type == 'real-estate' ) {
				if ( in_array( $post->post_status, array( 'pending' ) ) && current_user_can( 'publish_real-estates', $post->ID ) ) {
					$actions['property-approve'] = '<a href="' . wp_nonce_url( add_query_arg( 'approve_property', $post->ID ), 'approve_property' ) . '">' . esc_html__( 'Approve', 'tf-real-estate' ) . '</a>';
				}
				if ( in_array( $post->post_status, array( 'publish' ) ) && current_user_can( 'publish_real-estates', $post->ID ) ) {
					$actions['property-hidden'] = '<a href="' . wp_nonce_url( add_query_arg( 'hidden_property', $post->ID ), 'hidden_property' ) . '">' . esc_html__( 'Hide', 'tf-real-estate' ) . '</a>';
				}
				if ( in_array( $post->post_status, array( 'hidden' ) ) && current_user_can( 'publish_real-estates', $post->ID ) ) {
					$actions['property-show'] = '<a href="' . wp_nonce_url( add_query_arg( 'show_property', $post->ID ), 'show_property' ) . '">' . esc_html__( 'Show', 'tf-real-estate' ) . '</a>';
				}
			}
			return $actions;
		}

		public function tfre_approve_property() {
			if ( ! empty( $_GET['approve_property'] ) && wp_verify_nonce( wp_unslash( $_REQUEST['_wpnonce'] ), 'approve_property' ) && current_user_can( 'publish_post', $_GET['approve_property'] ) ) {
				$post_id       = absint( wp_unslash( $_GET['approve_property'] ) );
				$property_data = array(
					'ID'          => $post_id,
					'post_status' => 'publish'
				);
				wp_update_post( $property_data );

				$author_id  = get_post_field( 'post_author', $post_id );
				$user       = get_user_by( 'id', $author_id );
				$user_email = $user->user_email;
				$user_name  = $user->user_login;

				$email_args = array(
					'user_name'      => $user_name,
					'property_title' => get_the_title( $post_id ),
					'property_url'   => get_permalink( $post_id )
				);

				$enable_user_email_approve_property = tfre_get_option( 'enable_user_email_approve_property', 'y' );
				if ( $enable_user_email_approve_property ) {
					tfre_send_email( $user_email, 'user_email_approve_property', $email_args );
				}

				wp_redirect( remove_query_arg( 'approve_property', add_query_arg( 'approve_property', $post_id, admin_url( 'edit.php?post_type=real-estate' ) ) ) );
				exit;
			}
		}

		public function tfre_hidden_property() {
			if ( ! empty( $_GET['hidden_property'] ) && wp_verify_nonce( wp_unslash( $_REQUEST['_wpnonce'] ), 'hidden_property' ) && current_user_can( 'publish_post', $_GET['hidden_property'] ) ) {
				$post_id       = absint( wp_unslash( $_GET['hidden_property'] ) );
				$property_data = array(
					'ID'          => $post_id,
					'post_status' => 'hidden'
				);
				wp_update_post( $property_data );
				wp_redirect( remove_query_arg( 'hidden_property', add_query_arg( 'hidden_property', $post_id, admin_url( 'edit.php?post_type=real-estate' ) ) ) );
				exit;
			}
		}

		public function tfre_show_property() {
			if ( ! empty( $_GET['show_property'] ) && wp_verify_nonce( wp_unslash( $_REQUEST['_wpnonce'] ), 'show_property' ) && current_user_can( 'publish_post', $_GET['show_property'] ) ) {
				$post_id       = absint( wp_unslash( $_GET['show_property'] ) );
				$property_data = array(
					'ID'          => $post_id,
					'post_status' => 'publish'
				);
				wp_update_post( $property_data );
				wp_redirect( remove_query_arg( 'show_property', add_query_arg( 'show_property', $post_id, admin_url( 'edit.php?post_type=real-estate' ) ) ) );
				exit;
			}
		}

		public function tfre_filter_restrict_manage_properties_list() {
			global $post_type;
			$post_type_property = 'real-estate';
			if ( $post_type == $post_type_property ) {
				$property_author   = isset( $_GET['property_author'] ) ? $_GET['property_author'] : '';
				$property_identity = isset( $_GET['property_identity'] ) ? $_GET['property_identity'] : '';
				$taxonomy_array    = array( 'property-status', 'property-type', 'property-feature', 'property-label' );
				foreach ( $taxonomy_array as $key => $tax ) {
					$tax_selected  = isset( $_GET[ $tax ] ) ? $_GET[ $tax ] : '';
					$info_taxonomy = get_taxonomy( $tax );
					wp_dropdown_categories(
						array(
							'show_option_all' => sprintf( esc_html__( 'All %s', 'tf-real-estate' ), esc_html( $info_taxonomy->label ) ),
							'taxonomy'        => $tax,
							'name'            => $tax,
							'orderby'         => 'name',
							'selected'        => $tax_selected,
							'show_count'      => true,
							'hide_empty'      => false,
						) );
				}
				?>
				<input type="text" placeholder="<?php esc_attr_e( 'Property Author', 'tf-real-estate' ); ?>" name="property_author"
					value="<?php echo esc_attr( $property_author ); ?>">
				<input type="text" placeholder="<?php esc_attr_e( 'Property ID', 'tf-real-estate' ); ?>" name="property_identity"
					value="<?php echo esc_attr( $property_identity ); ?>" disabled>
				<?php
			}
		}

		public function tfre_handle_filter_properties_list( $query ) {
			global $pagenow;
			$post_type  = 'real-estate';
			$query_vars = &$query->query_vars;
			if ( $pagenow == 'edit.php' && isset( $query_vars['post_type'] ) && $query_vars['post_type'] == $post_type ) {
				$taxonomy_array = array( 'property-type', 'property-status', 'property-feature', 'property-label' );
				foreach ( $taxonomy_array as $key => $tax ) {
					if ( isset( $query_vars[ $tax ] ) && is_numeric( $query_vars[ $tax ] ) && $query_vars[ $tax ] != 0 ) {
						$term               = get_term_by( 'id', $query_vars[ $tax ], $tax );
						$query_vars[ $tax ] = $term->slug;
					}
				}

				if ( isset( $_GET['property_author'] ) && $_GET['property_author'] != '' ) {
					$query_vars['author_name'] = wp_unslash( $_GET['property_author'] );
				}

				if ( isset( $_GET['property_identity'] ) && $_GET['property_identity'] != '' ) {
					$query_vars['meta_key']     = 'property_identity';
					$query_vars['meta_value']   = wp_unslash( $_GET['property_identity'] );
					$query_vars['meta_type']    = 'CHAR';
					$query_vars['meta_compare'] = '=';
				}
			}
		}

		public function tfre_register_new_post_status() {

			register_post_status( 'expired', array(

				'label'                     => _x( 'Expired', 'post status', 'tf-real-estate' ),

				'public'                    => true,

				'protected'                 => true,

				'exclude_from_search'       => true,

				'show_in_admin_all_list'    => true,

				'show_in_admin_status_list' => true,

				'label_count'               => _n_noop( 'Expired <span class="count">(%s)</span>', 'Expired <span class="count">(%s)</span>', 'tf-real-estate' ),

			) );

			register_post_status( 'hidden', array(

				'label'                     => _x( 'Hidden', 'post status', 'tf-real-estate' ),

				'public'                    => true,

				'protected'                 => true,

				'exclude_from_search'       => true,

				'show_in_admin_all_list'    => true,

				'show_in_admin_status_list' => true,

				'label_count'               => _n_noop( 'Hidden <span class="count">(%s)</span>', 'Hidden <span class="count">(%s)</span>', 'tf-real-estate' ),

			) );

			register_post_status( 'sold', array(

				'label'                     => _x( 'Sold', 'post status', 'tf-real-estate' ),

				'public'                    => true,

				'protected'                 => true,

				'exclude_from_search'       => true,

				'show_in_admin_all_list'    => true,

				'show_in_admin_status_list' => true,

				'label_count'               => _n_noop( 'Sold <span class="count">(%s)</span>', 'Sold <span class="count">(%s)</span>', 'tf-real-estate' ),

			) );
		}
	}
}