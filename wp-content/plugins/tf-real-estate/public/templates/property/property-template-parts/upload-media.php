<?php
/**
 * @var $property_data
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$property_images = array();
if (isset($property_data)) {
    $property_images = get_post_meta($property_data->ID, 'gallery_images', true);
    $property_images = !empty($property_images) ? json_decode($property_images) : array();
    $property_images = array_unique($property_images);
}
$show_hide_property_fields = tfre_get_option('show_hide_property_fields', array());
?>
<div class="tfre-field-wrap tfre-upload-media">
    <div class="tfre-field-title">
        <h3><?php esc_html_e('Upload Media', 'tf-real-estate'); ?></h3>
    </div>
    <div class="tfre-field tfre-property-gallery">
        <?php if ($show_hide_property_fields['gallery_images'] == 1): ?>
            <div class="form-group">
                <div id="tfre_gallery_plupload_container" class="media-drag-drop">
                    <div class="icon-upload-media">
                        <img loading="lazy" src="<?php bloginfo('template_url'); ?>/images/svg-theme/icon-upload.svg" alt="icon">
                    </div>
                    <button type="button" id="tfre_choose_gallery_images"><?php esc_html_e('Choose image', 'tf-real-estate'); ?></button>
                    <h5>
                        <?php esc_html_e('or drop image here to upload', 'tf-real-estate'); ?>
                    </h5>
                </div>
                <div class="media-gallery">
                    <label class="media-gallery-title"><?php esc_html_e('Gallery Media', 'tf-real-estate'); ?></label>
                    <div id='sortable'>
                        <ul id="tfre_property_gallery_container" class="row">
                            <?php
                                if (!empty($property_images) && is_array($property_images)) {
                                    foreach ($property_images as $attach_id) {
                                        if (wp_get_attachment_image_url($attach_id)) {
                                            echo '<li class="sortable_item col-sm-2 media-gallery-wrap __thumb">';
                                            echo '<figure class="media-thumb">';
                                            echo '<img loading="lazy" src="' . esc_attr(wp_get_attachment_image_url($attach_id)) . '"/>';
                                            echo '<div class="media-item-actions">';
                                            echo '<a class="icon icon-delete" data-property-id="' . esc_attr(intval($property_data->ID)) . '" data-img-id="' . esc_attr(intval($attach_id)) . '" href="javascript:void(0)">';
                                            echo '<i class="fa fa-times"></i>';
                                            echo '</a>';
                                            echo '<input type="hidden" class="gallery_images" name="gallery_images[]" value="' . esc_attr(intval($attach_id)) . '">';
                                            echo '<span style="display: none;" class="icon icon-loader">';
                                            echo '<i class="fa fa-spinner fa-spin"></i>';
                                            echo '</span>';
                                            echo '</div>';
                                            echo '</figure>';
                                            echo '</li>';
                                        }
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                <div id="tfre_gallery_errors"></div>
            </div>
        <?php endif; ?>
    </div>
</div>