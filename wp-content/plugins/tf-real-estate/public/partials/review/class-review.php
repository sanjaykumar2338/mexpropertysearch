<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if (!class_exists('Review')) {
    class Review {
        function tfre_enqueue_review_scripts () {
            wp_enqueue_script('review-js', TF_PLUGIN_URL . '/public/assets/js/review.js', array('jquery'), null, false);
            wp_localize_script('review-js', 'review_variables', array(
                'ajaxUrl' => TF_AJAX_URL,
                'message_required_review' => esc_html__('Please enter your review.', 'tf-real-estate')
            ));
        }
        public static function tfre_my_review_shortcode () {
            ob_start();
            $posts_per_page = tfre_get_option('item_per_page_my_review', '4');
            global $current_user;
            $user_id = $current_user->ID;
            $args           = array(
                'user_id'             => $user_id,
                'post_type'           => 'real-estate',
                'post_status'         => 'publish',
                'status'              => 'approve',
                'ignore_sticky_posts' => 1,
                'posts_per_page'      => $posts_per_page,
                'offset'              => (max(1, get_query_var('paged')) - 1) * $posts_per_page,
                'orderby'             => 'date',
                'order'               => 'desc',
                'meta_query'          => array(
                    'key' => 'property_rating'
                )
            );
            $comments_query = new WP_Comment_Query($args);
            $comments       = $comments_query->comments;

            wp_reset_postdata();
            tfre_get_template_with_arguments(
                '/review/my-review.php',
                array(
                    'reviews'       => $comments,
                    'max_num_pages' => $comments_query->max_num_pages
                )
            );
            return ob_get_clean();
        }

        public function tfre_submit_review_ajax() {
            check_ajax_referer('tfre_submit_review_ajax_nonce', 'tfre_security_submit_review');
            global $wpdb, $current_user;
            wp_get_current_user();
            $user_id = $current_user->ID;
            $user = get_user_by('id', $user_id);
            $property_id = isset($_POST['property_id']) ? wp_unslash($_POST['property_id']) : '';
           
            $rating_value = isset($_POST['rating']) ? wp_unslash($_POST['rating']) : '';
            $enable_review_agent_approve_by_admin = tfre_get_option('enable_review_agent_approve_by_admin', 'n');
            $comment_approved = 1;
            if($enable_review_agent_approve_by_admin != 'n'){
                $comment_approved = 0;
            }
            $data = Array();
            $user = $user->data;
            $data['comment_post_ID'] = $property_id;
            $data['comment_content'] = isset($_POST['review']) ?  wp_filter_post_kses($_POST['review']) : '';
            $data['comment_date'] = current_time('mysql');
            $data['comment_approved'] = $comment_approved;
            $data['comment_author'] = $user->user_login;
            $data['comment_author_email'] = $user->user_email;
            $data['comment_author_url'] = $user->user_url;
            $data['user_id'] = $user_id;
            $comment_id = wp_insert_comment($data);

            add_comment_meta($comment_id, 'property_rating', $rating_value);
            do_action('tfre_property_rating_meta', $property_id, $rating_value);
            wp_send_json_success();
        }
    
        public function tfre_rating_meta_filter($property_id, $rating_value, $comment_exist = true, $old_rating_value = 0) {
            $property_rating = get_post_meta($property_id, 'property_rating', true);
            if ($comment_exist == true) {
                if (is_array($property_rating) && isset($property_rating[$rating_value])) {
                    $property_rating[$rating_value]++;
                } else {
                    $property_rating = Array();
                    $property_rating[1] = 0;
                    $property_rating[2] = 0;
                    $property_rating[3] = 0;
                    $property_rating[4] = 0;
                    $property_rating[5] = 0;
                    $property_rating[$rating_value]++;
                }
            } else {
                $property_rating[$old_rating_value]--;
                $property_rating[$rating_value]++;
            }
            update_post_meta($property_id, 'property_rating', $property_rating);
        }

        public function tfre_property_review() {
            ob_start();
            global $wpdb;
            $list_filter_review     = array( 'newest' => esc_html__( 'newest', 'tf-real-estate' ), 'oldest' => esc_html__( 'oldest', 'tf-real-estate' ));
            $current_user = wp_get_current_user();
            $user_id = $current_user->ID;
            $orderBy = isset( $_GET['reviewOrderby'] ) ? sanitize_text_field( $_GET['reviewOrderby'] ) : '';
            $order = '';
            if($orderBy == 'newest'){
                $order = 'DESC';
            }else{
                $order = 'ASC';
            }
            $property_id = get_the_ID();
            $property_rating = get_post_meta($property_id, 'property_rating', true);
            $rating = $total_reviews = $total_stars = 0;
            $comments_query = $wpdb->prepare("SELECT * FROM {$wpdb->comments}  as comment INNER JOIN {$wpdb->commentmeta} as meta WHERE  comment.comment_post_ID = %d AND meta.meta_key = 'property_rating' AND  meta.comment_id = comment.comment_ID AND (comment.comment_approved = 1 OR comment.user_id = %d) GROUP BY meta.comment_ID ORDER BY comment.comment_date " . $order, $property_id, $user_id);
            $get_comments = $wpdb->get_results($comments_query);
            $my_review = $wpdb->get_row( $wpdb->prepare("SELECT * FROM {$wpdb->comments} as comment INNER JOIN {$wpdb->commentmeta} as meta WHERE comment.comment_post_ID = %d AND comment.user_id = %d AND meta.meta_key = 'property_rating' AND meta.comment_id = comment.comment_ID ORDER BY comment.comment_ID DESC", $property_id, $user_id));
           
            if (!is_null($get_comments)) {
                foreach ($get_comments as $comment) {
                    if ($comment->comment_approved == 1) {
                        $total_reviews++;
                        if(is_numeric($comment->meta_value)){
                            $total_stars += $comment->meta_value;
                        }
                    }
                }
                if ($total_reviews != 0) {
                    $rating = ($total_stars / $total_reviews);
                }
            }
			tfre_get_template_with_arguments( 'single-property/review.php', 
                array(
                    'rating'                    => $rating,
                    'total_reviews'             => $total_reviews,
                    'get_comments'              => $get_comments,
                    'property_id'               => $property_id,
                    'selected_filter_review'    => $orderBy,
                    'list_filter_review'        => $list_filter_review
            ) );
            echo ob_get_clean();
		}
        public function tfre_update_review_ajax() {
           
            check_ajax_referer('tfre_update_review_ajax_nonce', 'tfre_security_update_review');
            global $current_user;
            wp_get_current_user();
            $user_id = $current_user->ID;

            $review_ID = isset($_POST['review_ID']) ? wp_unslash($_POST['review_ID']) : '';
            $review_content = isset($_POST['review_content']) ? wp_unslash($_POST['review_content']) : '';
            $review_rating = isset($_POST['rating']) ? wp_unslash($_POST['rating']) : '';
            
            $response = array(
                'status'    => false,
                'message'   => null
            );
            if ($review_ID && $review_content) {
                $review_data = array(
                    'comment_ID' => $review_ID,
                    'comment_content' => $review_content,
                    'comment_date' => current_time('mysql'),
                );
                
                wp_update_comment($review_data);
                update_comment_meta($review_ID, 'property_rating', $review_rating);
                $response['status'] = true;
                $response['message'] = esc_html__('Review updated successfully', 'tf-real-estate');
                echo json_encode($response);
                wp_die();
            }else{
                $response['message'] = esc_html__('Review field is required', 'tf-real-estate');
                echo json_encode($response);
                wp_die();
            }
           
        }
    }
}
