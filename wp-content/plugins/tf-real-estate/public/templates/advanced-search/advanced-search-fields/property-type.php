<?php
/**
 * @var $css_class_field
 * @var $value_type
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div class="<?php echo esc_attr($css_class_field); ?> form-group type-field">
    <select name="type" title="<?php esc_attr_e('Property Type', 'tf-real-estate') ?>"
        class="tfre-property-type-ajax search-field form-control" data-default-value="">
        <option value="" <?php selected('', $value_type) ?>>
            <?php esc_html_e('Property Types', 'tf-real-estate') ?>
        </option>
        <?php tfre_get_taxonomy_options('property-type', $value_type, true, false); ?>
    </select>
</div>