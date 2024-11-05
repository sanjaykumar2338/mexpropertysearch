<?php
/**
 * @var $css_class_field
 * @var $value_country
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$list_countries = tfre_selected_countries();
?>
<div class="<?php echo esc_attr($css_class_field); ?> form-group country-field">
    <select name="country" title="<?php esc_attr_e('Property Country', 'tf-real-estate') ?>"
        class="tfre-property-country-ajax search-field form-control" data-default-value=""
        data-selected="<?php echo esc_attr($value_country); ?>">
        <option value="" <?php selected('', $value_country) ?>>
            <?php esc_html_e('Property Country', 'tf-real-estate') ?>
        </option>
        <?php foreach ($list_countries as $key => $value): ?>
            <option <?php selected($key, $value_country) ?> value="<?php echo esc_attr($key) ?>"><?php echo esc_html($value) ?></option>
        <?php endforeach; ?>
    </select>
</div>