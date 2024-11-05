<?php
/**
 * @var $css_class_field
 * @var $value_address
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div class="<?php echo esc_attr($css_class_field); ?> form-group address-field">
    <input type="text" class="form-control search-field" data-default-value=""
        value="<?php echo esc_attr($value_address); ?>" name="address"
        placeholder="<?php esc_attr_e('Address', 'tf-real-estate') ?>">
</div>