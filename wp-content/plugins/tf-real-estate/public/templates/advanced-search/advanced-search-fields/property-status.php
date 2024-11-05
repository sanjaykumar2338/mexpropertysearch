<?php
/**
 * @var $css_class_field
 * @var $value_status
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div class="<?php echo esc_attr($css_class_field); ?> form-group status-field">
    <select name="status" title="<?php esc_attr_e('Property Status', 'tf-real-estate') ?>"
        class="search-field form-control" data-default-value="">
        <option value="" <?php selected('', $value_status) ?>>
            <?php esc_html_e('Property Status', 'tf-real-estate') ?>
        </option>
        <?php tfre_get_options_status_advanced_search_by_slug($value_status); ?>
    </select>
</div>