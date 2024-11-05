<?php
/**
 * @var $css_class_field
 * @var $value_bathrooms
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$bathrooms_list  = tfre_get_option('bathrooms_list_dropdown', '1,2,3,4,5,6,7,8,9,10');
$bathrooms_array = explode(',', $bathrooms_list);
?>
<div class="<?php echo esc_attr($css_class_field); ?> form-group bathrooms-field">
    <select name="bathrooms" title="<?php esc_attr_e('Property bathrooms', 'tf-real-estate') ?>"
        class="tfre-property-bathroom-ajax search-field form-control" data-default-value="">
        <option value="" <?php selected('', $value_bathrooms) ?>>
            <?php esc_html_e('Baths: Any', 'tf-real-estate') ?>
        </option>
        <?php if (is_array($bathrooms_array) && !empty($bathrooms_array)): ?>
            <?php foreach ($bathrooms_array as $room): ?>
                <option <?php selected($value_bathrooms, $room) ?> value="<?php echo esc_attr($room) ?>"><?php echo esc_html($room) ?></option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
</div>