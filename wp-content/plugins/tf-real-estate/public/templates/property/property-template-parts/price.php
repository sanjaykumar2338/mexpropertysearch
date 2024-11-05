<?php
/**
 * @var $property_data
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$decimal_point                = tfre_get_option('decimal_separator', '.');
$property_price_short_format  = '^[0-9]+([' . $decimal_point . '][0-9]+)?$';
$property_price_value         = $property_data ? get_post_meta($property_data->ID, 'property_price_value', true) : '';
$property_price_unit_value    = $property_data ? get_post_meta($property_data->ID, 'property_price_unit', true) : '1';
$property_price_prefix_value  = $property_data ? get_post_meta($property_data->ID, 'property_price_prefix', true) : '';
$property_price_postfix_value = $property_data ? get_post_meta($property_data->ID, 'property_price_postfix', true) : '';
$property_price_to_call_value = $property_data ? get_post_meta($property_data->ID, 'property_price_to_call', true) : '';
$show_hide_property_fields    = tfre_get_option('show_hide_property_fields', array());
$enable_price_unit            = tfre_get_option('enable_price_unit', 1);
?>
<div class="tfre-field-wrap tfre-property-price-sc">
    <div class="tfre-field-title">
        <h3><?php esc_html_e('Price', 'tf-real-estate'); ?></h3>
    </div>
    <div class="property-fields property-price row">
        <?php if ($show_hide_property_fields['property_price_value'] == 1): ?>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="property_price_value">
                        <?php echo esc_html_e('Price', 'tf-real-estate') . tfre_required_field('property_price_value', 'required_property_fields'); ?>
                    </label>
                    <input pattern="<?php echo esc_attr($property_price_short_format) ?>" type="number"
                        id="property_price_value" class="form-control" name="property_price_value"
                        value="<?php echo esc_attr($property_price_value); ?>"
                        placeholder="<?php echo sprintf(esc_html__('Example Value: 12345%s05', 'tf-real-estate'), $decimal_point) ?>">
                </div>
            </div>
        <?php endif; ?>
        <?php if ($enable_price_unit == 1 && $show_hide_property_fields['property_price_unit'] == 1): ?>
            <div class="col-sm-4">
                <div class="form-group">
                    <label
                        for="property_price_unit"><?php echo esc_html_e('Unit price', 'tf-real-estate') . (tfre_check_required_field('property_price_value', 'required_property_fields') ? tfre_required_field('property_price_unit', 'required_property_fields') : ''); ?></label>
                    <select name="property_price_unit" id="property_price_unit" class="form-control">
                        <option <?php tfre_check_value_is_selected_option($property_price_unit_value, '1') ?> value="1"><?php esc_html_e('None', 'tf-real-estate'); ?></option>
                        <option <?php tfre_check_value_is_selected_option($property_price_unit_value, '1000') ?>
                            value="1000"><?php esc_html_e('Thousand', 'tf-real-estate'); ?></option>
                        <option <?php tfre_check_value_is_selected_option($property_price_unit_value, '1000000') ?>
                            value="1000000"><?php esc_html_e('Million', 'tf-real-estate'); ?></option>
                        <option <?php tfre_check_value_is_selected_option($property_price_unit_value, '1000000000') ?>
                            value="1000000000"><?php esc_html_e('Billion', 'tf-real-estate'); ?></option>
                    </select>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($show_hide_property_fields['property_price_prefix'] == 1): ?>
            <div class="col-sm-4">
                <div class="form-group">
                    <label
                        for="property_price_prefix"><?php echo esc_html_e('Before Price Label', 'tf-real-estate'); ?></label>
                    <input type="text" id="property_price_prefix" class="form-control" name="property_price_prefix"
                        value="<?php echo esc_attr($property_price_prefix_value); ?>">
                </div>
            </div>
        <?php endif; ?>
        <?php if ($show_hide_property_fields['property_price_postfix'] == 1): ?>
            <div class="col-sm-12">
                <div class="form-group">
                    <label
                        for="property_price_postfix"><?php echo esc_html_e('After Price Label', 'tf-real-estate'); ?></label>
                    <input type="text" id="property_price_postfix" class="form-control" name="property_price_postfix"
                        value="<?php echo esc_attr($property_price_postfix_value); ?>">
                </div>
                <?php if ($show_hide_property_fields['property_price_to_call'] == 1): ?>
                        <div class="group-checkbox">
                            <input type="checkbox" id="property_price_to_call"
                                name="property_price_to_call" <?php tfre_check_value_is_checked_option($property_price_to_call_value, '1') ?>>
                            <label class="form-check-label"
                                for="property_price_to_call"><?php echo esc_html_e('Price to Call', 'tf-real-estate') . (tfre_check_required_field('property_price_value', 'required_property_fields') ? '' : tfre_required_field('property_price_to_call', 'required_property_fields')); ?></label>
                        </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
    </div>
</div>