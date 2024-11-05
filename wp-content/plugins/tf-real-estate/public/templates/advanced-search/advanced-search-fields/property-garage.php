<?php
/**
 * @var $css_class_field
 * @var $value_garage
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$garage_list  = tfre_get_option('garages_list_dropdown', '1,2,3,4,5,6,7,8,9,10');
$garage_array = explode(',', $garage_list);
?>
<div class="<?php echo esc_attr($css_class_field); ?> form-group garage-field">
    <select name="garage" title="<?php esc_attr_e('Property Garages', 'tf-real-estate') ?>"
        class="tfre-property-garage-ajax search-field form-control" data-default-value="">
        <option value="">
            <?php esc_html_e('Garages: Any', 'tf-real-estate') ?>
        </option>
        <?php if (is_array($garage_array) && !empty($garage_array)): ?>
            <?php foreach ($garage_array as $garage): ?>
                <option <?php selected($value_garage, $garage) ?> value="<?php echo esc_attr($garage) ?>"><?php echo esc_html($garage) ?></option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
</div>