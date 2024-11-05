<?php
/**
 * @var $css_class_field
 * @var $value_title
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div class="<?php echo esc_attr($css_class_field); ?> form-group title-field">
    <input type="text" class="form-control search-field" data-default-value=""
        value="<?php echo esc_attr($value_title); ?>" name="title"
        placeholder="<?php esc_attr_e('Title', 'tf-real-estate') ?>">
</div>