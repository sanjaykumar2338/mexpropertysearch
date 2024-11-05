<?php
if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Save_Advanced_Search')) {
    class Save_Advanced_Search
    {
        protected $alert_message;

        public function tfre_my_saved_advanced_search_shortcode() {
            ob_start();
            global $wpdb, $current_user;
            wp_get_current_user();
            $user_id        = $current_user->ID;
            $query          = "SELECT * FROM {$wpdb->prefix}save_advanced_search WHERE user_id =" . $user_id;
            $total_query    = "SELECT COUNT(1) FROM (${query}) AS combined_table";
            $total          = $wpdb->get_var($total_query);
            $items_per_page = tfre_get_option('item_per_page_saved_advanced_search', 10);
            $totalPage      = ceil($total / $items_per_page);
            $page           = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $offset         = ($page * $items_per_page) - $items_per_page;
            $results        = $wpdb->get_results($wpdb->prepare($query . " ORDER BY id DESC LIMIT %d, %d", $offset, $items_per_page));
            echo $this->alert_message;
            tfre_get_template_with_arguments(
                'advanced-search/my-saved-advanced-search.php',
                array(
                    'list_save_advanced_search' => $results,
                    'max_num_pages'             => $totalPage
                )
            );
            return ob_get_clean();
        }

        public static function tfre_create_table_save_advanced_search() {
            global $wpdb;
            $charset_collate = $wpdb->get_charset_collate();
            $table_name      = $wpdb->prefix . 'save_advanced_search';
            $sql             = "CREATE TABLE $table_name (
			  id mediumint(9) NOT NULL AUTO_INCREMENT,
              title longtext DEFAULT '' NOT NULL,
              parameters longtext DEFAULT '' NOT NULL,
              search_query longtext NOT NULL,
              url_request longtext DEFAULT '' NOT NULL,
			  user_id mediumint(9) NOT NULL,
			  user_email longtext DEFAULT '' NOT NULL,
			  time_saved datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			  PRIMARY KEY  (id)
			) $charset_collate;";
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }

        public function tfre_save_advanced_search_ajax() {
            global $wpdb, $current_user;
            wp_get_current_user();

            $nonce = isset($_REQUEST['tfre_save_search_nonce']) ? (wp_unslash($_REQUEST['tfre_save_search_nonce'])) : '';
            if (!wp_verify_nonce($nonce, 'tfre_save_search_nonce_field')) {
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => esc_html__("Permission error!", 'tf-real-estate'),
                    )
                );
                wp_die();
            }
            
            $title        = isset($_REQUEST['title']) ? (wp_unslash($_REQUEST['title'])) : '';
            $parameters   = isset($_REQUEST['parameters']) ? (wp_unslash($_REQUEST['parameters'])) : '';
            $search_query = isset($_REQUEST['search_query']) ? (wp_unslash($_REQUEST['search_query'])) : '';
            $url_request  = isset($_REQUEST['url_request']) ? sanitize_url(wp_unslash($_REQUEST['url_request'])) : '';
            $table_name   = $wpdb->prefix . 'save_advanced_search';
            $wpdb->insert(
                $table_name,
                array(
                    'title'        => $title,
                    'parameters'   => $parameters,
                    'search_query' => $search_query,
                    'url_request'  => $url_request,
                    'user_id'      => $current_user->ID,
                    'user_email'   => $current_user->user_email,
                    'time_saved'   => current_time('mysql'),
                ),
                array(
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%d',
                    '%s',
                    '%s'
                )
            );

            echo json_encode(array( 'success' => true, 'msg' => esc_html__('Save successfully', 'tf-real-estate') ));
            wp_die();
        }

        public function tfre_handle_action_my_saved_advanced_search() {
            if (!empty($_REQUEST['action']) && !empty($_REQUEST['_wpnonce']) && wp_verify_nonce(wp_unslash($_REQUEST['_wpnonce']), 'tfre_my_saved_advanced_search_actions')) {
                global $wpdb, $current_user;
                wp_get_current_user();
                $user_id = $current_user->ID;
                $action         = isset($_REQUEST['action']) ? wp_unslash($_REQUEST['action']) : '';
                $save_search_id = isset($_REQUEST['save_search_id']) ? absint(wp_unslash($_REQUEST['save_search_id'])) : '';
                try {
                    switch ($action) {
                        case 'remove':
                            $result = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}save_advanced_search WHERE id = %d", $save_search_id));
                            if (!empty($result) && $result->user_id == $user_id) {
                                $wpdb->delete($wpdb->prefix . 'save_advanced_search', array( 'id' => $save_search_id ), array( '%d' ));
                                $this->alert_message = '<div class="alert alert-success" role="alert">' . sprintf(wp_kses_post(__('<strong>Success!</strong> %s has been removed', 'tf-real-estate')), $result->title) . '</div>';
                            }
                            break;
                        default:
                            break;
                    }
                }
                catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }
        
        public function tfre_get_total_my_save_advanced_search(){
            if(!is_user_logged_in()) return;
            global $wpdb;
            $user_id = get_current_user_id();
            $results       = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$wpdb->prefix}save_advanced_search WHERE user_id = %d", $user_id), OBJECT );
            return count($results);
        }
    }
}