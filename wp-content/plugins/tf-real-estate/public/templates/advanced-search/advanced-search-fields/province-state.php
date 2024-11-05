<?php
/**
 * @var $css_class_field
 * @var $value_state
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div class="<?php echo esc_attr($css_class_field); ?> form-group state-field">
    <select name="state" title="<?php esc_attr_e('Province/States', 'tf-real-estate') ?>"
        class="tfre-province-state-ajax search-field form-control" data-default-value="" data-selected="<?php echo esc_attr($value_state); ?>">
        <option value="" <?php selected('', $value_state) ?>>
            <?php esc_html_e('Province/States', 'tf-real-estate') ?>
        </option>
        <?php tfre_get_taxonomy_options('province-state', $value_state, true, false); ?>
    </select>
</div>