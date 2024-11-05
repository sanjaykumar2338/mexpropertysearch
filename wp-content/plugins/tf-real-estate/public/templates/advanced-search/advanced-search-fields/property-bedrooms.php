<?php
/**
 * @var $css_class_field
 * @var $value_bedrooms
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$bedrooms_list  = tfre_get_option('bedrooms_list_dropdown', '1,2,3,4,5,6,7,8,9,10');
$bedrooms_array = explode(',', $bedrooms_list);
?>
<div class="<?php echo esc_attr($css_class_field); ?> form-group bedrooms-field">
    <select name="bedrooms" title="<?php esc_attr_e('Property bedrooms', 'tf-real-estate') ?>"
        class="tfre-property-bedroom-ajax search-field form-control" data-default-value="">
        <option value="" <?php selected('', $value_bedrooms) ?>>
            <?php esc_html_e('Beds: Any', 'tf-real-estate') ?>
        </option>
        <?php if (is_array($bedrooms_array) && !empty($bedrooms_array)): ?>
            <?php foreach ($bedrooms_array as $room): ?>
                <option <?php selected($value_bedrooms, $room) ?> value="<?php echo esc_attr($room) ?>"><?php echo esc_html($room) ?></option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
</div>