<?php
/**
 * @var $css_class_field
 * @var $value_label
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div class="<?php echo esc_attr($css_class_field); ?> form-group label-field">
    <select name="label" title="<?php esc_attr_e('Property Labels', 'tf-real-estate') ?>"
        class="tfre-property-label-ajax search-field form-control" data-default-value="">
        <option value="" <?php selected('', $value_label) ?>>
            <?php esc_html_e('Property Labels', 'tf-real-estate') ?>
        </option>
        <?php tfre_get_taxonomy_options('property-label', $value_label, true, false); ?>
    </select>
</div>