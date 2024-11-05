<?php
/**
 * @var $property_data
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if (isset($property_data)) {
    $property_attachment_meta  = get_post_meta($property_data->ID, 'attachments_file', false);
    $property_attachments_file = (isset($property_attachment_meta) && is_array($property_attachment_meta) && count($property_attachment_meta) > 0) ? $property_attachment_meta[0] : '';
    $property_attachments_file = !empty($property_attachments_file) ? json_decode($property_attachments_file) : array();
    $property_attachments_file = array_unique($property_attachments_file);

}
$show_hide_property_fields = tfre_get_option('show_hide_property_fields', array());
?>
<div class="tfre-field-wrap tfre-file-attachment">
    <div class="tfre-field-title">
        <h3><?php esc_html_e('File Attachments', 'tf-real-estate'); ?></h3>
    </div>
    <div class="tfre-field tfre-property-attachment">
        <?php if ($show_hide_property_fields['attachments_file'] == 1): ?>
            <div class="form-group">
                <div id="tfre_attachment_plupload_container" class="media-drag-drop">
                    <div class="icon-upload-media">
                        <img loading="lazy" src="<?php bloginfo('template_url'); ?>/images/svg-theme/icon-upload.svg" alt="icon">
                    </div>
                    <button type="button"
                        id="tfre_choose_attachment_files"><?php esc_html_e('Choose File', 'tf-real-estate'); ?></button>
                    <h5>
                        <?php esc_html_e('or file here to upload', 'tf-real-estate'); ?>
                    </h5>
                </div>
                <div class="media-attachment">
                    <label class="media-attachment-title"><?php esc_html_e('File attachments', 'tf-real-estate'); ?></label>
                    <div id="tfre_property_attachment_container" class="row">
                        <?php
                        if (!empty($property_attachments_file) && is_array($property_attachments_file)) {
                            foreach ($property_attachments_file as $attach_id) {
                                $attach_url = wp_get_attachment_url($attach_id);
                                if ($attach_url) {
                                    $file_type      = wp_check_filetype($attach_url);
                                    $file_type_name = isset($file_type['ext']) ? $file_type['ext'] : '';
                                    $thumb_url      = TF_PLUGIN_URL . 'public/assets/image/attachment/attach-' . $file_type_name . '.png';  
                                    $file_name      = basename($attach_url);
                                    echo '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 file-attachment-wrap __thumb">';
                                    echo '<figure class="attachment-file">';
                                    echo '<img loading="lazy" src="' . esc_url($thumb_url) . '">';
                                    echo '<a href="' . esc_url($attach_url) . '">' . esc_html($file_name) . '</a>';
                                    echo '<div class="media-item-actions">';
                                    echo '<a class="icon icon-delete" data-property-id="' . esc_attr(intval($property_data->ID)) . '" data-attachment-id="' . esc_attr(intval($attach_id)) . '" href="javascript:void(0)">';
                                    echo '<i class="fa fa-times"></i>';
                                    echo '</a>';
                                    echo '<input type="hidden" class="attachments_file" name="attachments_file[]" value="' . esc_attr(intval($attach_id)) . '">';
                                    echo '<span style="display: none;" class="icon icon-loader">';
                                    echo '<i class="fa fa-spinner fa-spin"></i>';
                                    echo '</span>';
                                    echo '</div>';
                                    echo '</figure>';
                                    echo '</div>';
                                }
                            }
                        }
                        ?>
                    </div>
                </div>

                <div id="tfre_attachment_errors"></div>
            </div>
        <?php endif; ?>
    </div>
</div>