<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
require_once( TF_PLUGIN_PATH . 'includes/class-background-emailer.php' );

if ( ! class_exists( 'User_Public' ) ) {
	class User_Public {
		const ACCESS_TOKEN = 'access_token';

		public $google_client;

		public function __construct( TF_Google_Client $client ) {
			$this->google_client = $client;
		}

		function tfre_enqueue_user_scripts() {
			wp_enqueue_script( 'user-js', TF_PLUGIN_URL . '/public/assets/js/user.js', array( 'jquery' ), null, true );
			wp_localize_script( 'user-js', 'ajax_object',
				array(
					'ajaxUrl'                   => TF_AJAX_URL,
					'nonce'                     => wp_create_nonce( 'custom-ajax-nonce' ),
					'confirm_become_agent_text' => esc_html__( 'Are you sure you want to become an Agent?', 'tf-real-estate' ),
					'confirm_leave_agent_text'  => esc_html__( 'Are you sure you want to Remove Agent Account?', 'tf-real-estate' ),
					'required_profile_fields'   => array(
						'full_name'           => tfre_check_required_field( 'full_name', 'require_profile_fields' ),
						'user_description'    => tfre_check_required_field( 'user_description', 'require_profile_fields' ),
						'user_company'        => tfre_check_required_field( 'user_company', 'require_profile_fields' ),
						'user_position'       => tfre_check_required_field( 'user_position', 'require_profile_fields' ),
						'user_office_number'  => tfre_check_required_field( 'user_office_number', 'require_profile_fields' ),
						'user_office_address' => tfre_check_required_field( 'user_office_address', 'require_profile_fields' ),
						'user_licenses'       => tfre_check_required_field( 'user_licenses', 'require_profile_fields' ),
						'user_job'            => tfre_check_required_field( 'user_job', 'require_profile_fields' ),
						'user_email'          => tfre_check_required_field( 'user_email', 'require_profile_fields' ),
						'user_phone'          => tfre_check_required_field( 'user_phone', 'require_profile_fields' ),
						'user_location'       => tfre_check_required_field( 'user_location', 'require_profile_fields' ),
						'user_socials'        => tfre_check_required_field( 'user_socials', 'require_profile_fields' ),
					),
					'enable_login_popup'        => tfre_get_option( 'enable_login_register_popup', 'y' ),
					'login_page'                => tfre_get_permalink( 'login_page' ),
				)
			);
		}

		public function tfre_custom_register_ajax_handler() {
			check_ajax_referer( 'custom-ajax-nonce', 'security' );
			$username         = isset( $_POST['username'] ) ? sanitize_user( wp_unslash( $_POST['username'] ) ) : '';
			$email            = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
			$password         = isset( $_POST['password'] ) ? wp_unslash( $_POST['password'] ) : '';
			$confirm_password = isset( $_POST['confirm_password'] ) ? wp_unslash( $_POST['confirm_password'] ) : '';

			$response = array(
				'status'  => false,
				'message' => ''
			);

			header( 'Content-Type: application/json' );
			if ( empty( $username ) || empty( $email ) || empty( $password ) || empty( $confirm_password ) ) {
				$response['message'] = esc_html__( 'All fields are required.', 'tf-real-estate' );
				echo json_encode( $response );
				wp_die();
			}

			if ( username_exists( $username ) ) {
				$response['message'] = esc_html__( 'Username already exists. Please choose a different username.', 'tf-real-estate' );
				echo json_encode( $response );
				wp_die();
			}

			if ( ! is_email( $email ) ) {
				$response['message'] = esc_html__( 'Invalid email address', 'tf-real-estate' );
				echo json_encode( $response );
				wp_die();
			}

			if ( email_exists( $email ) ) {
				$response['message'] = esc_html__( 'Email address is already registered.', 'tf-real-estate' );
				echo json_encode( $response );
				wp_die();
			}

			if ( $password !== $confirm_password ) {
				$response['message'] = esc_html__( 'Passwords do not match.', 'tf-real-estate' );
				echo json_encode( $response );
				wp_die();
			}

			// If no errors, create the user
			if ( empty( $errors ) ) {
				$user_id = wp_create_user( $username, $password, $email );
				if ( ! is_wp_error( $user_id ) ) {
					wp_set_current_user( $user_id );
					wp_set_auth_cookie( $user_id );
					wp_update_user( array( 'ID' => $user_id, 'role' => 'subscriber' ) );
					$response['status']  = true;
					$response['message'] = esc_html__( 'Your account was created, login now!', 'tf-real-estate' );
					echo json_encode( $response );
				} else {
					$response['message'] = esc_html__( 'Cannot create a new account!', 'tf-real-estate' );
					wp_die();
				}
				wp_die();
			}
		}

		public function tfre_custom_login_ajax_handler() {
			check_ajax_referer( 'custom-ajax-nonce', 'security' );
			$username = isset( $_POST['username'] ) ? wp_unslash( $_POST['username'] ) : '';
			$password = isset( $_POST['password'] ) ? wp_unslash( $_POST['password'] ) : '';

			if ( empty( $username ) ) {
				echo json_encode( array( 'status' => false, 'message' => esc_html__( 'The username field is empty.', 'tf-real-estate' ) ) );
				wp_die();
			}

			if ( empty( $password ) ) {
				echo json_encode( array( 'status' => false, 'message' => esc_html__( 'The password field is empty.', 'tf-real-estate' ) ) );
				wp_die();
			}

			wp_clear_auth_cookie();

			$response = array(
				'status'  => false,
				'message' => null
			);
			header( 'Content-Type: application/json' );

			$credentials = array(
				'user_login'    => $username,
				'user_password' => $password,
			);

			$user = wp_signon( $credentials, false );

			if ( is_wp_error( $user ) ) {
				// Login failed, handle the error
				$response['message'] = esc_html__( 'A account or password is invalid!', 'tf-real-estate' );
				echo json_encode( $response );
				wp_die();
			} else {
				// Login successful
				wp_set_current_user( $user->ID );
				wp_set_auth_cookie( $user->ID );
				$response['status']       = true;
				$response['message']      = esc_html__( 'Login successful', 'tf-real-estate' );
				$response['redirect_url'] = home_url();
				echo json_encode( $response );
			}
			wp_die();
		}

		public static function tfre_custom_register_form_shortcode() {
			ob_start();
			include TF_THEME_PATH . '/account/register.php';
			return ob_get_clean();
		}

		public function tfre_custom_login_form_shortcode() {
			ob_start();
			$login_google_url = User_Public::tfre_enable_google_login() ? $this->google_client->tfre_get_authorization_url() : '';
			include TF_THEME_PATH . '/account/login.php';
			return ob_get_clean();
		}

		public static function tfre_my_profile_shortcode() {
			ob_start();
			$current_user          = wp_get_current_user();
			$full_name             = get_the_author_meta( 'full_name', $current_user->ID );
			$user_description      = get_user_meta( $current_user->ID, 'user_description', true );
			$user_company          = get_the_author_meta( 'user_company', $current_user->ID );
			$user_job              = get_the_author_meta( 'user_job', $current_user->ID );
			$user_email            = $current_user->user_email;
			$user_phone            = get_the_author_meta( 'user_phone', $current_user->ID );
			$user_location         = get_the_author_meta( 'user_location', $current_user->ID );
			$user_facebook         = get_the_author_meta( 'user_facebook', $current_user->ID );
			$user_twitter          = get_the_author_meta( 'user_twitter', $current_user->ID );
			$user_linkedin         = get_the_author_meta( 'user_linkedin', $current_user->ID );
			$user_avatar_id        = get_the_author_meta( 'profile_image_id', $current_user->ID );
			$user_avatar           = get_the_author_meta( 'profile_image', $current_user->ID );
			$user_avatar_file_name = get_the_author_meta( 'profile_image_name', $current_user->ID );
			$user_position         = get_the_author_meta( 'user_position', $current_user->ID );
			$user_office_number    = get_the_author_meta( 'user_office_number', $current_user->ID );
			$user_office_address   = get_the_author_meta( 'user_office_address', $current_user->ID );
			$user_licenses         = get_the_author_meta( 'user_licenses', $current_user->ID );
			$agent_id              = get_the_author_meta( 'author_agent_id', $current_user->ID );
			$agent_poster          = get_the_post_thumbnail_url( $agent_id, 'full' );

			$user_data = array(
				'agent_id'              => $agent_id ? $agent_id : '',
				'agent_poster'          => $agent_poster ? $agent_poster : '',
				'user_id'               => $current_user->ID,
				'full_name'             => $full_name,
				'user_description'      => $user_description,
				'user_company'          => $user_company,
				'user_job'              => $user_job,
				'user_email'            => $user_email,
				'user_phone'            => $user_phone,
				'user_location'         => $user_location,
				'user_facebook'         => $user_facebook,
				'user_twitter'          => $user_twitter,
				'user_linkedin'         => $user_linkedin,
				'user_avatar_id'        => $user_avatar_id,
				'user_avatar'           => $user_avatar,
				'user_avatar_file_name' => $user_avatar_file_name,
				'user_position'         => $user_position,
				'user_office_number'    => $user_office_number,
				'user_office_address'   => $user_office_address,
				'user_licenses'         => $user_licenses,
			);

			ob_start();
			tfre_get_template_with_arguments(
				'account/my-profile.php',
				array(
					'user_data' => $user_data,
				)
			);
			return ob_get_clean();
		}

		public function tfre_profile_update_ajax_handler() {
			check_ajax_referer( 'custom-ajax-nonce', 'security' );
			$response = array(
				'status'  => false,
				'message' => ''
			);
			header( 'Content-Type: application/json' );
			$current_user        = wp_get_current_user();
			$user_id             = $current_user->ID;
			$full_name           = isset( $_POST['full_name'] ) ? $_POST['full_name'] : '';
			$user_description    = isset( $_POST['user_description'] ) ? $_POST['user_description'] : '';
			$user_company        = isset( $_POST['user_company'] ) ? $_POST['user_company'] : '';
			$user_position       = isset( $_POST['user_position'] ) ? $_POST['user_position'] : '';
			$user_office_number  = isset( $_POST['user_office_number'] ) ? $_POST['user_office_number'] : '';
			$user_office_address = isset( $_POST['user_office_address'] ) ? $_POST['user_office_address'] : '';
			$user_licenses       = isset( $_POST['user_licenses'] ) ? $_POST['user_licenses'] : '';
			$user_job            = isset( $_POST['user_job'] ) ? $_POST['user_job'] : '';
			$user_email          = isset( $_POST['user_email'] ) ? $_POST['user_email'] : '';
			$user_phone          = isset( $_POST['user_phone'] ) ? $_POST['user_phone'] : '';
			$user_location       = isset( $_POST['user_location'] ) ? $_POST['user_location'] : '';
			$user_facebook       = isset( $_POST['user_facebook'] ) ? $_POST['user_facebook'] : '';
			$user_twitter        = isset( $_POST['user_twitter'] ) ? $_POST['user_twitter'] : '';
			$user_linkedin       = isset( $_POST['user_linkedin'] ) ? $_POST['user_linkedin'] : '';
			$default_avatar_url  = tfre_get_option( 'default_user_avatar', '' )['url'] != '' ? tfre_get_option( 'default_user_avatar', '' )['url'] : get_avatar_url( $user_id );
			$user_avatar         = get_the_author_meta( 'profile_image', $user_id ) ? get_the_author_meta( 'profile_image', $user_id ) : $default_avatar_url;
			$user_avatar_id      = get_the_author_meta( 'profile_image_id', $user_id ) ? get_the_author_meta( 'profile_image_id', $user_id ) : 0;
			$agent_id            = get_the_author_meta( 'author_agent_id', $user_id );

			$agencies = isset( $_POST['agencies'] ) ? array_map( 'intval', wp_unslash( $_POST['agencies'] ) ) : null;
			wp_set_object_terms( $agent_id, $agencies, 'agencies' );

			update_user_meta( $user_id, 'full_name', $full_name );
			update_user_meta( $user_id, 'user_description', $user_description );
			update_user_meta( $user_id, 'user_company', $user_company );
			update_user_meta( $user_id, 'user_job', $user_job );
			wp_update_user(
				array(
					'ID'         => $user_id,
					'user_email' => $user_email
				)
			);
			update_user_meta( $user_id, 'user_email', $user_email );
			update_user_meta( $user_id, 'user_phone', $user_phone );
			update_user_meta( $user_id, 'user_location', $user_location );
			update_user_meta( $user_id, 'user_facebook', $user_facebook );
			update_user_meta( $user_id, 'user_twitter', $user_twitter );
			update_user_meta( $user_id, 'user_linkedin', $user_linkedin );

			// for agent information
			update_user_meta( $user_id, 'user_position', $user_position );
			update_user_meta( $user_id, 'user_office_number', $user_office_number );
			update_user_meta( $user_id, 'user_office_address', $user_office_address );
			update_user_meta( $user_id, 'user_licenses', $user_licenses );

			// Update Agent information
			if ( ! empty( $agent_id ) && ( get_post_type( $agent_id ) == 'agent' ) && ( get_post_status( $agent_id ) == 'publish' ) ) {
				if ( ! empty( $full_name ) ) {
					wp_update_post( array(
						'ID'         => $agent_id,
						'post_title' => $full_name
					) );
				}
				update_post_meta( $agent_id, 'agent_full_name', $full_name );
				update_post_meta( $agent_id, 'agent_des_info', $user_description );
				update_post_meta( $agent_id, 'agent_company_name', $user_company );
				update_post_meta( $agent_id, 'agent_job', $user_job );
				update_post_meta( $agent_id, 'agent_email', $user_email );
				update_post_meta( $agent_id, 'agent_phone_number', $user_phone );
				update_post_meta( $agent_id, 'agent_location', $user_location );
				update_post_meta( $agent_id, 'agent_facebook', $user_facebook );
				update_post_meta( $agent_id, 'agent_twitter', $user_twitter );
				update_post_meta( $agent_id, 'agent_linkedin', $user_linkedin );
				update_post_meta( $agent_id, 'agent_avatar', $user_avatar_id );
				update_post_meta( $agent_id, 'agent_position', $user_position );
				update_post_meta( $agent_id, 'agent_office_number', $user_office_number );
				update_post_meta( $agent_id, 'agent_office_address', $user_office_address );
				update_post_meta( $agent_id, 'agent_licenses', $user_licenses );
			}

			$response['status']     = true;
			$response['message']    = esc_html__( 'Profile updated successfully', 'tf-real-estate' );
			$response['avatar_url'] = $default_avatar_url;

			echo json_encode( $response );
			wp_die();
		}

		public function tfre_upload_avatar_ajax_handler() {
			$response = array(
				'status'  => false,
				'message' => ''
			);
			header( 'Content-Type: application/json' );
			$current_user = wp_get_current_user();
			$user_id      = $current_user->ID;
			$agent_id     = get_the_author_meta( 'author_agent_id', $user_id );
			// Handle the profile image upload, if provided
			if ( ! empty( $_FILES['tfre_avatar'] ) ) {
				$file       = $_FILES['tfre_avatar'];
				$file_name  = $_FILES['tfre_avatar']['name'];
				$upload_dir = wp_upload_dir();

				// Handle the avatar image upload
				$uploaded_avatar = wp_handle_upload( $file, array( 'test_form' => false ) );
				if ( $uploaded_avatar && ! isset( $uploaded_avatar['error'] ) ) {
					// Avatar uploaded successfully
					$avatar_url = $uploaded_avatar['url'];
					move_uploaded_file( $file['tmp_name'], $avatar_url );
					update_user_meta( $user_id, 'profile_image', $avatar_url );
					update_user_meta( $user_id, 'profile_image_name', $file_name );

					$file_type          = wp_check_filetype( $uploaded_avatar['file'] );
					$attachment_details = array(
						'guid'           => $uploaded_avatar['url'],
						'post_mime_type' => $file_type['type'],
						'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $file_name ) ),
						'post_content'   => '',
						'post_status'    => 'inherit'
					);

					$attach_id   = wp_insert_attachment( $attachment_details, $uploaded_avatar['file'] );
					$attach_data = wp_generate_attachment_metadata( $attach_id, $uploaded_avatar['file'] );
					wp_update_attachment_metadata( $attach_id, $attach_data );

					update_user_meta( $user_id, 'profile_image_id', $attach_id );
					update_post_meta( $agent_id, 'agent_avatar', $attach_id );

					$response['status']     = true;
					$response['avatar_url'] = $avatar_url;
					$response['message']    = esc_html__( 'Avatar uploaded successfully', 'tf-real-estate' );
					echo json_encode( $response );
					wp_die();
				} else {
					$response['message'] = esc_html__( 'Avatar upload failed.', 'tf-real-estate' );
					echo json_encode( $response );
					wp_die();
				}
			}
		}

		public function tfre_upload_agent_poster_ajax_handler() {
			$response = array(
				'status'  => false,
				'message' => ''
			);
			header( 'Content-Type: application/json' );
			$current_user = wp_get_current_user();
			$user_id      = $current_user->ID;
			// Handle the profile image upload, if provided
			if ( ! empty( $_FILES['tfre_agent_poster'] ) ) {
				$file       = $_FILES['tfre_agent_poster'];
				$file_name  = $_FILES['tfre_agent_poster']['name'];
				$upload_dir = wp_upload_dir();

				// Handle the avatar image upload
				$uploaded_agent_poster = wp_handle_upload( $file, array( 'test_form' => false ) );
				if ( $uploaded_agent_poster && ! isset( $uploaded_agent_poster['error'] ) ) {
					// Avatar uploaded successfully
					$agent_poster_url = $uploaded_agent_poster['url'];
					move_uploaded_file( $file['tmp_name'], $agent_poster_url );
					$file_type          = wp_check_filetype( $uploaded_agent_poster['file'] );
					$attachment_details = array(
						'guid'           => $uploaded_agent_poster['url'],
						'post_mime_type' => $file_type['type'],
						'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $file_name ) ),
						'post_content'   => '',
						'post_status'    => 'inherit'
					);
					$attach_id          = wp_insert_attachment( $attachment_details, $uploaded_agent_poster['file'] );
					$attach_data        = wp_generate_attachment_metadata( $attach_id, $uploaded_agent_poster['file'] );
					wp_update_attachment_metadata( $attach_id, $attach_data );

					$agent_id = get_the_author_meta( 'author_agent_id', $user_id );

					if ( ! empty( $agent_id ) && ( get_post_type( $agent_id ) == 'agent' ) && ( get_post_status( $agent_id ) == 'publish' ) ) {
						update_post_meta( $agent_id, '_thumbnail_id', $attach_id );
					}

					$response['status']           = true;
					$response['agent_poster_url'] = $agent_poster_url;
					$response['message']          = esc_html__( 'Agent poster uploaded successfully', 'tf-real-estate' );
					echo json_encode( $response );
					wp_die();
				} else {
					$response['message'] = esc_html__( 'Agent poster upload failed.', 'tf-real-estate' );
					echo json_encode( $response );
					wp_die();
				}
			}
		}

		public function tfre_leave_agent_ajax() {
			check_ajax_referer( 'custom-ajax-nonce', 'security' );
			global $current_user;
			wp_get_current_user();
			$user_id  = $current_user->ID;
			$agent_id = get_the_author_meta( 'author_agent_id', $user_id );
			$response = array(
				'status'  => false,
				'message' => ''
			);
			if ( ! empty( $agent_id ) && ( get_post_type( $agent_id ) == 'agent' ) ) {
				wp_delete_post( $agent_id );
				update_user_meta( $user_id, 'author_agent_id', '' );
				$response['status']  = true;
				$response['message'] = esc_html__( 'Remove Agent Account successfully!', 'tf-real-estate' );
				echo json_encode( $response );
				wp_die();
			} else {
				$response['message'] = esc_html__( 'Agent not found!', 'tf-real-estate' );
				echo json_encode( $response );
				wp_die();
			}

		}

		public function tfre_become_agent_ajax() {
			$user_can_become_agent = tfre_get_option( 'user_can_become_agent', 'y' );
			if ( $user_can_become_agent == 'y' ) {
				check_ajax_referer( 'custom-ajax-nonce', 'security' );
				$response = array(
					'status'  => false,
					'message' => ''
				);
				global $current_user;
				wp_get_current_user();
				$user_id               = $current_user->ID;
				$full_name             = get_the_author_meta( 'full_name', $current_user->ID );
				$user_description      = get_the_author_meta( 'user_description', $current_user->ID );
				$user_company          = get_the_author_meta( 'user_company', $current_user->ID );
				$user_job              = get_the_author_meta( 'user_job', $current_user->ID );
				$user_email            = $current_user->user_email;
				$user_phone            = get_the_author_meta( 'user_phone', $current_user->ID );
				$user_location         = get_the_author_meta( 'user_location', $current_user->ID );
				$user_avatar_id        = get_the_author_meta( 'profile_image_id', $current_user->ID );
				$user_avatar           = get_the_author_meta( 'profile_image', $current_user->ID );
				$user_avatar_file_name = get_the_author_meta( 'profile_image_name', $current_user->ID );
				$user_login            = get_the_author_meta( 'user_login', $current_user->ID );
				$user_position         = get_the_author_meta( 'user_position', $current_user->ID );
				$user_office_number    = get_the_author_meta( 'user_office_number', $current_user->ID );
				$user_office_address   = get_the_author_meta( 'user_office_address', $current_user->ID );
				$user_licenses         = get_the_author_meta( 'user_licenses', $current_user->ID );
				$user_facebook         = get_the_author_meta( 'user_facebook', $current_user->ID );
				$user_twitter          = get_the_author_meta( 'user_twitter', $current_user->ID );
				$user_linkedin         = get_the_author_meta( 'user_linkedin', $current_user->ID );

				// TO DO: need to add auto_approved_agent to setting and retrieve from there for send email to admin approval
				$post_status         = 'pending';
				$auto_approved_agent = tfre_get_option( 'auto_approve_agent', 'n' );
				if ( $auto_approved_agent == 'y' ) {
					$post_status = 'publish';
				}
				// Insert Agent
				$agent_id = wp_insert_post(
					array(
						'post_title'   => $full_name ? $full_name : $user_login,
						'post_type'    => 'agent',
						'post_status'  => $post_status,
						'post_content' => $user_description
					)
				);
				if ( $agent_id > 0 ) {
					update_user_meta( $user_id, 'author_agent_id', $agent_id );
					$agent_email = $current_user->user_email;

					update_post_meta( $agent_id, 'agent_user_id', $user_id );
					update_post_meta( $agent_id, 'agent_full_name', $full_name );
					update_post_meta( $agent_id, 'agent_des_info', $user_description );
					update_post_meta( $agent_id, 'agent_company_name', $user_company );
					update_post_meta( $agent_id, 'agent_job', $user_job );
					update_post_meta( $agent_id, 'agent_email', $user_email );
					update_post_meta( $agent_id, 'agent_phone_number', $user_phone );
					update_post_meta( $agent_id, 'agent_location', $user_location );
					update_post_meta( $agent_id, 'agent_facebook', $user_facebook );
					update_post_meta( $agent_id, 'agent_twitter', $user_twitter );
					update_post_meta( $agent_id, 'agent_linkedin', $user_linkedin );
					update_post_meta( $agent_id, 'agent_avatar', $user_avatar_id );
					update_post_meta( $agent_id, 'agent_position', $user_position );
					update_post_meta( $agent_id, 'agent_office_number', $user_office_number );
					update_post_meta( $agent_id, 'agent_office_address', $user_office_address );
					update_post_meta( $agent_id, 'agent_licenses', $user_licenses );

					$admin_email = get_option( 'new_admin_email' ); // Get the admin email address
					$email_args  = array(
						'email'      => $admin_email,
						'agent_name' => $full_name ? $full_name : $user_login
					);

					$enable_admin_email_approve_agent = tfre_get_option( 'enable_admin_email_approve_agent', 'y' );
					if ( $enable_admin_email_approve_agent == 'y' ) {
						tfre_send_email( $admin_email, 'admin_email_approve_agent', $email_args );
					}

					if ( $auto_approved_agent == 'y' ) {
						$response['status']  = true;
						$response['message'] = esc_html__( 'You have successfully registered!', 'tf-real-estate' );
					} else {
						$response['status']  = true;
						$response['message'] = esc_html__( 'You have successfully registered and is pending approval by an admin!', 'tf-real-estate' );
					}
				} else {
					$response['message'] = esc_html__( 'Become an Agent Failed!', 'tf-real-estate' );
				}
				echo json_encode( $response );
				wp_die();
			} else {
				$response = array(
					'status'  => false,
					'message' => esc_html__( 'We do not allow to become an Agent.', 'tf-real-estate' ),
				);
				echo json_encode( $response );
				wp_die();
			}
		}

		public function tfre_login_register_modal() {
			if ( ! is_user_logged_in() ) {
				echo tfre_get_template_with_arguments(
					'account/login-register-modal.php', array()
				);
			}
		}

		public function tfre_reset_password_ajax() {
			check_ajax_referer( 'tfre_reset_password_ajax_nonce', 'tfre_security_reset_password' );
			$user_login = isset( $_POST['user_login'] ) ? wp_unslash( $_POST['user_login'] ) : '';

			if ( empty( $user_login ) ) {
				echo json_encode( array( 'success' => false, 'message' => esc_html__( 'Enter a username or email address.', 'tf-real-estate' ) ) );
				wp_die();
			}
			$login     = trim( $user_login );
			$user_data = get_user_by( 'login', $login );
			// Check user by username first
			if ( empty( $user_data ) ) {
				// Check user by email
				$user_data = get_user_by( 'email', $login );
				if ( empty( $user_data ) ) {
					echo json_encode( array( 'success' => false, 'message' => esc_html__( 'There is no user registered with that email or username.', 'tf-real-estate' ) ) );
					wp_die();
				}
			}
			$user_login = $user_data->user_login;
			$user_email = $user_data->user_email;
			$key        = get_password_reset_key( $user_data );
			if ( is_wp_error( $key ) ) {
				echo json_encode( array( 'success' => false, 'message' => $key ) );
				wp_die();
			}

			$message = esc_html__( 'You have requested to reset your password.', 'tf-real-estate' ) . "\r\n\r\n";
			$message .= sprintf( esc_html__( 'Username: %s', 'tf-real-estate' ), $user_login ) . "\r\n\r\n";
			$message .= esc_html__( 'If you did not request a password reset, please ignore this email.', 'tf-real-estate' ) . "\r\n\r\n";
			$message .= esc_html__( 'To reset your password, visit the following address:', 'tf-real-estate' ) . "\r\n\r\n";
			$message .= site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' ) . "\r\n";
			$subject = sprintf( esc_html__( 'Password Reset Request', 'tf-real-estate' ) );
			$subject = apply_filters( 'retrieve_password_title', $subject, $user_login, $user_data );
			$message = apply_filters( 'retrieve_password_message', $message, $key, $user_login, $user_data );
			if ( $message && ! wp_mail( $user_email, $subject, $message ) ) {
				echo json_encode( array( 'success' => false, 'message' => esc_html__( 'The email could not be sent.', 'tf-real-estate' ) . "<br />\n" . esc_html__( 'Possible reason: your host may have disabled the mail() function.', 'tf-real-estate' ) ) );
				wp_die();
			} else {
				echo json_encode( array( 'success' => true, 'message' => esc_html__( 'Please check your email for reset password!', 'tf-real-estate' ) ) );
				wp_die();
			}
		}

		public function tfre_change_password_ajax() {
			check_ajax_referer( 'tfre_change_password_ajax_nonce', 'tfre_security_change_password' );
			global $current_user;
			wp_get_current_user();
			$user_id = $current_user->ID;

			$old_pass     = isset( $_POST['old_pass'] ) ? wp_unslash( $_POST['old_pass'] ) : '';
			$new_pass     = isset( $_POST['new_pass'] ) ? wp_unslash( $_POST['new_pass'] ) : '';
			$confirm_pass = isset( $_POST['confirm_pass'] ) ? wp_slash( $_POST['confirm_pass'] ) : '';
			$response     = array(
				'status'  => false,
				'message' => null
			);
			if ( $new_pass == '' || $confirm_pass == '' ) {
				$response['message'] = esc_html__( 'New password or confirm password is required', 'tf-real-estate' );
				echo json_encode( $response );
				wp_die();
			}
			if ( $new_pass != $confirm_pass ) {
				$response['message'] = esc_html__( 'Passwords do not match', 'tf-real-estate' );
				echo json_encode( $response );
				wp_die();
			}

			$user = get_user_by( 'id', $user_id );

			// Not allow change password demo account
			if ( $user_id == 7 && $user->data->user_login == 'agent' ) {
				$response['message'] = esc_html__( 'Demo account are not allowed to change password', 'tf-real-estate' );
				echo json_encode( $response );
				wp_die();
			}

			if ( $user && wp_check_password( $old_pass, $user->data->user_pass, $user_id ) ) {
				wp_set_password( $new_pass, $user_id );
				wp_set_current_user( $user_id );
				wp_set_auth_cookie( $user_id );
				$response['success'] = true;
				$response['message'] = esc_html__( 'Password changed successfully', 'tf-real-estate' );
				echo json_encode( $response );
			} else {
				$response['message'] = esc_html__( 'Old password is not correct', 'tf-real-estate' );
				echo json_encode( $response );
			}
			wp_die();
		}

		public function tfre_set_access_token_google() {
			check_ajax_referer( 'custom-ajax-nonce', 'security' );
			$response = array( 'status' => false );
			if ( isset( $_POST['code'] ) ) {
				$get_access_token = $this->google_client->tfre_get_access_token( $_POST['code'] );
				session_start();
				$_SESSION[ self::ACCESS_TOKEN ] = isset( $get_access_token['access_token'] ) ? $get_access_token['access_token'] : null;
				$response['status']             = true;
			}
			echo json_encode( $response );
			wp_die();
		}

		public function tfre_handle_google_login() {
			check_ajax_referer( 'custom-ajax-nonce', 'security' );
			$response = array( 'status' => false );
			header( 'Content-Type: application/json' );
			session_start();
			if ( $_SESSION[ self::ACCESS_TOKEN ] ) {
				$user = $this->google_client->tfre_get_user_info( $_SESSION[ self::ACCESS_TOKEN ] );
				$this->tfre_login_with_google_user( $user );
				$response['status']       = true;
				$response['redirect_url'] = tfre_get_permalink( 'dashboard_page' );
			}
			echo json_encode( $response );
			wp_die();
		}

		public function tfre_login_with_google_user( $user ) {
			// if there is any error, send the error back to client
			if ( isset( $user->error ) ) {
				wp_send_json_error( $user->error_description );
			} else {
				// check if user already exists in WP user
				$first_name      = isset( $user['given_name'] ) ? $user['given_name'] : '';
				$last_name       = isset( $user['family_name'] ) ? $user['family_name'] : '';
				$user_picture    = isset( $user['picture'] ) ? $user['picture'] : '';
				$user_picture_id = tfre_save_image_from_url( $user_picture );
				$name            = isset( $user['name'] ) ? $user['name'] : '';
				$email           = isset( $user['email'] ) ? $user['email'] : '';
				$email_exists    = email_exists( $email );
				if ( ! $email_exists ) {
					$random_password = wp_generate_password( $length = 12, $include_standard_special_chars = false );
					// insert the user as WP user
					$user_id = wp_insert_user( [ 
						'user_email'   => $email,
						'user_login'   => $email,
						'user_pass'    => $random_password,
						'display_name' => $name,
						'nickname'     => $name,
						'first_name'   => $first_name,
						'last_name'    => $last_name
					] );
					wp_update_user( array( 'ID' => $user_id, 'role' => 'subscriber' ) );
					//set user profile picture
					update_user_meta( $user_id, 'profile_image', $user_picture );
					update_user_meta( $user_id, 'profile_image_id', $user_picture_id );
				}

				// do login
				$user = get_user_by( 'email', $email );

				if ( ! is_wp_error( $user ) ) {
					wp_clear_auth_cookie();
					wp_set_current_user( $user->ID, $user->user_login );
					wp_set_auth_cookie( $user->ID );
				}
			}
		}

		public static function tfre_enable_google_login() {
			if ( tfre_get_option( 'enable_google_login' ) == 'y' ) {
				return true;
			}
			return false;
		}
	}
}