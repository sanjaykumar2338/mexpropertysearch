<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if ( ! class_exists( 'WP_Async_Request', false ) ) {
	include_once TF_PLUGIN_PATH . 'includes/libraries/wp-async-request.php';
}

if ( ! class_exists( 'WP_Background_Process', false ) ) {
	require_once TF_PLUGIN_PATH . 'includes/libraries/wp-background-process.php';
}

if (!class_exists('Email_Sending_Process')) {
    class Email_Background_Process extends WP_Background_Process { 
        protected $action = 'tfre_email_background_process';
        /**
         * Complete
         *
         * Override if applicable, but ensure that the below actions are
         * performed, or, call parent::complete().
         */
        protected function complete() {
            parent::complete();
        }

        public function __construct() {
            parent::__construct();
        }

        public function task( $data ) {
            // Extract the necessary data from the $data array
            $email_template    = $data['email_template'];
            $email             = $data['email'];
            $enable_send_email = tfre_get_option("enable_{$email_template}", 'y');
            $args              = $data['args'];
            $headers           = array(
                'Content-Type: text/html; charset=UTF-8', // Set the content type
            );
            if ($enable_send_email == 'y') {
                $subject              = tfre_get_option("subject_{$email_template}", '');
                $message              = tfre_get_option($email_template, '');
                $message              = wpautop($message);
                $args['website_url']  = get_option('siteurl');
                $args['website_name'] = get_option('blogname');
                $args['user_email']   = $email;
                $user                 = get_user_by('email', $email);
                $args['username']     = $user->user_login;
                foreach ($args as $key => $val) {
                    $subject = str_replace('$' . $key, $val, $subject);
                    $message = str_replace('$' . $key, $val, $message);
                }
            }

            // Send the email using the wp_mail() function
            $result = wp_mail($email, $subject, $message, $headers);

            // Return false to stop the background process if necessary
            return $result;
        }
    }
}