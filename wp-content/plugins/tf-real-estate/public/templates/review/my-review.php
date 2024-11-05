<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if (!is_user_logged_in()) {
    tfre_get_template_with_arguments('global/access-permission.php', array( 'type' => 'not_login' ));
    return;
}
?>
<div class="tfre-my-review-listing">
    <?php if (count($reviews) == 0): ?>
        <span><?php esc_html_e('You don\'t have any reviews.', 'tf-real-estate'); ?></span>
    <?php else: ?>
        <ul>
            <?php foreach ($reviews as $review):
                $author_picture = get_the_author_meta('profile_image', $review->user_id);
                $no_avatar_src  = TF_PLUGIN_URL . 'includes/elementor-widget/assets/images/no-image.jpg';
                $default_avatar = tfre_get_option('default_user_avatar', '');
                $width          = 34;
                $height         = 34;
                if (is_array($default_avatar) && $default_avatar['url'] != '') {
                    $no_avatar_src = tfre_image_resize_url($default_avatar['url'], $width, $height, true)['url'];
                }
                $user_link = get_author_posts_url($review->user_id);
                ?>
                <li class="comment byuser">
                    <div class="group-author">
                        <img loading="lazy" class="avatar" width="<?php echo esc_attr($width) ?>"
                            height="<?php echo esc_attr($height) ?>"
                            src="<?php echo esc_url($author_picture ? $author_picture : '') ?>"
                            onerror="this.src = '<?php echo esc_url($no_avatar_src) ?>';" alt="" title="">
                        <?php
                        $user_info = get_userdata($review->user_id);
                        ?>
                        <span class="review-name">
                            <?php echo sprintf(__('<b>%s</b>', 'tf-real-estate'), $user_info ? $user_info->user_nicename : '') ?></span>
                        <span class="review-date"><?php echo tfre_get_comment_time($review->comment_ID); ?></span>
                    </div>
                    <div class="content">
                        <p><?php echo esc_html($review->comment_content); ?> </p>
                        <span class="rating-wrap">
                            <div class="form-group">
                                <div class="star-rating">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="star disabled-click icon-dreamhome-star <?php echo esc_attr($i <= get_comment_meta($review->comment_ID, 'property_rating', true) ? 'active' : ''); ?>"
                                            data-rating="<?php echo esc_attr($i); ?>"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </span>
                    </div>
                    <?php
                    $action = array( 'id' => 'edit', 'label' => __('Edit', 'tf-real-estate'), 'tooltip' => __('Edit Review', 'tf-real-estate'), 'nonce' => true );

                    $action_url = get_edit_comment_link($review->comment_ID);
                    if ($action['nonce']) {
                        $action_url = wp_nonce_url($action_url, 'tfre_my_review_actions');
                    }
                    ?>
                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title=""
                        class="btn-action tfre-edit-review" data-id="<?php echo esc_attr($review->comment_ID) ?>"><img loading="lazy"
                            src="<?php bloginfo('template_url'); ?>/images/svg-theme/icon-5.svg" alt="icon">
                        <?php echo esc_html($action['label']); ?></a>
                    <form action="#" style="display:none" id="tfre-edit-review-in-line-<?php echo esc_attr($review->comment_ID) ?>"
                        data-id="<?php echo esc_attr($review->comment_ID) ?>">
                        <div id="update_review_msgs" class="tfre_message message"></div>
                        <input type="text" class="tf-edit-review-in-line"
                            value="<?php echo esc_html($review->comment_content); ?>">
                        <div class="star-rating">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="icon-dreamhome-star <?php echo esc_attr($i <= get_comment_meta($review->comment_ID, 'property_rating', true) ? 'active' : ''); ?>"
                                    data-rating="<?php echo esc_attr($i); ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <?php wp_nonce_field('tfre_update_review_ajax_nonce', 'tfre_security_update_review'); ?>
                        <button type="button" class="tfre_update_review"
                            id="tfre_update_review"><?php esc_html_e('Update', 'tf-real-estate'); ?></button>
                        <input type="hidden" id="rating-submit" value="5" name="rating">
                    </form>
                    <span class="text-danger"></span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <?php tfre_get_template_with_arguments('global/pagination.php', array( 'max_num_pages' => $max_num_pages )); ?>
</div>