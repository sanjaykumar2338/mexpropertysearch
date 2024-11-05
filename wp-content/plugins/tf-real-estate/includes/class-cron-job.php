<?php
if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Cron_Job')) {
    /**
     * Class Cron_Job
     */
    class Cron_Job
    {
        public function activate_cron_job() {
            $enable_saved_advanced_search = get_option('enable_saved_advanced_search', '1');
            if ($enable_saved_advanced_search == '1') {
                if (!wp_next_scheduled('check_matching_saved_search')) {
                    wp_schedule_event(time(), 'daily', 'check_matching_saved_search');
                }
            }
        }

        public static function deactivate_cron_job() {
            wp_clear_scheduled_hook('check_matching_saved_search');
        }

        public function custom_cron_schedules($schedules) {
            if (!isset($schedules["5min"])) {
                $schedules["5min"] = array(
                    'interval' => 5*60,
                    'display'  => __('Once every 5 minutes')
                );
            }
            return $schedules;
        }

        public function query_result($search_query) {
            $links      = '';
            $properties = new WP_Query($search_query);
            if ($properties->have_posts()) {
                while ($properties->have_posts()):
                    $properties->the_post();
                    $property_id = get_the_ID();
                    $links .= get_the_permalink($property_id) . "\r\n";
                endwhile;
                wp_reset_postdata();
            }
            return $links;
        }

        public function tfre_check_matching_saved_search() {
            $current_time = getdate(strtotime("0 days"));
            $date_query   = array(
                array(
                    'year'  => $current_time['year'],
                    'month' => $current_time['mon'],
                    'day'   => $current_time['mday'],
                )
            );
            $args         = array(
                'post_type'      => 'real-estate',
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'date_query'     => $date_query
            );
            $new_property = new WP_Query($args);
            if ($new_property->have_posts()) {
                global $wpdb;
                $links_matching = '';
                $user_email     = '';
                $table          = $wpdb->prefix . 'save_advanced_search';
                $results        = $wpdb->get_results($wpdb->prepare('SELECT * FROM %s', $table));
                if (count($results) > 0) {
                    foreach ($results as $result) {
                        $search_query                   = unserialize(base64_encode($result->search_query));
                        $search_query['date_query']     = $date_query;
                        $search_query['posts_per_page'] = -1;
                        $links_matching                 = $this->query_result($search_query);
                        if ($links_matching != '') {
                            $user_email = $result->user_email;
                        }
                    }
                }
                $email_args = array(
                    'email'          => $user_email,
                    'links_matching' => $links_matching
                );
                $enable_user_email_matching_new_property = tfre_get_option('enable_user_email_matching_new_property', 'y');
                if ($enable_user_email_matching_new_property) {
                    tfre_send_email($user_email, 'user_email_matching_new_property', $email_args);
                }
                
                wp_reset_postdata();
            }
        }
    }
}