<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if ( ! class_exists( 'Admin_Agent' ) ) {
	/**
	 * Class Admin_Agent
	 */
	class Admin_Agent {
		
		/**
		 * @param $actions
		 * @param $post
		 *
		 * @return mixed
		 */
		public function modify_list_row_actions( $actions, $post ) {
			// Check for your post type.
			if ( $post->post_type == 'agent' ) {
				if ( in_array( $post->post_status, array( 'pending' ) ) ) {
					$actions['agent-approve'] = '<a href="' . wp_nonce_url( add_query_arg( 'approve_agent', $post->ID ), 'approve_agent' ) . '">' . esc_html__( 'Approve', 'tf-real-estate' ) . '</a>';
				}
			}
            
			return $actions;
		}

		/**
		 * Approve Agent
		 */
		public function tfre_approve_agent() {

			$approve_agent = isset( $_GET['approve_agent'] ) ? absint(  wp_unslash( $_GET['approve_agent'] )  ) : '';
			$_wpnonce      = isset( $_REQUEST['_wpnonce'] ) ?  wp_unslash( $_REQUEST['_wpnonce'] )  : '';
			if ( $approve_agent !== '' && wp_verify_nonce( $_wpnonce, 'approve_agent' ) ) {
				$listing_data = array(
					'ID'          	=> $approve_agent,
					'post_status' 	=> 'publish',
					'post_type' 	=> 'agent',
				);
				wp_update_post( $listing_data );

				$author_id  = get_post_field( 'post_author', $approve_agent );
				$user       = get_user_by( 'id', $author_id );
				$user_email = $user->user_email;
				$agent_name = $user->user_login;
				$email_args = array(
					'email'      => $user_email,
					'agent_name' => $agent_name
				);
				$enable_user_email_approve_agent = tfre_get_option('enable_user_email_approve_agent', 'y');
				if($enable_user_email_approve_agent == 'y'){
					tfre_send_email($user_email, 'user_email_approve_agent', $email_args);
				}
				wp_redirect( remove_query_arg( 'approve_agent', add_query_arg( 'approve_agent', $approve_agent, admin_url( 'edit.php?post_type=agent' ) ) ) );
				exit;
			}
		}

		public function tfre_agent_filter( $query ) {
			global $pagenow;
			$post_type = 'agent';
			$q_vars    = &$query->query_vars;
			if ( $pagenow == 'edit.php' && isset( $q_vars['post_type'] ) && $q_vars['post_type'] == $post_type ) {
				$taxonomy = 'agencies';
				if ( isset( $q_vars[ $taxonomy ] ) && is_numeric( $q_vars[ $taxonomy ] ) && $q_vars[ $taxonomy ] != 0 ) {
					$term                = get_term_by( 'id', $q_vars[ $taxonomy ], $taxonomy );
					$q_vars[ $taxonomy ] = $term->slug;
				}
			}
		}

	}
}
?>