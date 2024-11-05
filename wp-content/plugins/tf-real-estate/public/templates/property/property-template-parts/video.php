<?php
/**
 * @var $property_data
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$video_url_value = '';
if ($property_data) {
    $video_url       = get_post_meta($property_data->ID, 'video_url', true);
    $video_url_value = isset($video_url) ? $video_url : '';
}
$show_hide_property_fields = tfre_get_option('show_hide_property_fields', array());
?>
<div class="tfre-field-wrap tfre-video-sc">
    <div class="tfre-field-title">
        <h3><?php esc_html_e('Video', 'tf-real-estate'); ?></h3>
    </div>
    <div class="tfre-field tfre-property-video">
        <?php if ($show_hide_property_fields['property_video_url'] == 1): ?>
            <div class="form-group">
                <label for="property_video_url"
                    class="virtual-360-title"><?php esc_html_e('Video URL', 'tf-real-estate'); ?></label>
                <input type="text" class="form-control" name="video_url" id="property_video_url"
                    placeholder="<?php esc_attr_e('YouTube, Vimeo url', 'tf-real-estate'); ?>"
                    value="<?php echo esc_attr($video_url_value); ?>">
            </div>
        <?php endif; ?>
    </div>
</div>