<?php
/**
 * @var $css_class_field
 * @var $value_neighborhood
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div class="<?php echo esc_attr($css_class_field); ?> form-group neighborhood-field">
    <select name="neighborhood" title="<?php esc_attr_e('Neighborhoods', 'tf-real-estate') ?>"
        class="tfre-property-neighborhood-ajax search-field form-control" data-default-value="" data-selected="<?php echo esc_attr($value_neighborhood); ?>">
        <option value="" <?php selected('', $value_neighborhood) ?>>
            <?php esc_html_e('Neighborhoods', 'tf-real-estate') ?>
        </option>
        <?php tfre_get_taxonomy_options('neighborhood', $value_neighborhood, true, false); ?>
    </select>
</div>