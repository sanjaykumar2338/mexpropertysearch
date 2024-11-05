<?php
/**
 * @var $property_data
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$agent_information_options_value        = 'agent_info';
$property_other_agent_name_value        = '';
$property_other_agent_email_value       = '';
$property_other_agent_phone_value       = '';
$property_other_agent_description_value = '';
if ($property_data) {
    $agent_information_options              = get_post_meta($property_data->ID, 'agent_information_options', true);
    $agent_information_options_value        = !empty($agent_information_options) ? $agent_information_options : 'agent_info';
    $property_other_agent_name              = get_post_meta($property_data->ID, 'property_other_agent_name', true);
    $property_other_agent_name_value        = !empty($property_other_agent_name) ? $property_other_agent_name : '';
    $property_other_agent_email             = get_post_meta($property_data->ID, 'property_other_agent_email', true);
    $property_other_agent_email_value       = !empty($property_other_agent_email) ? $property_other_agent_email : '';
    $property_other_agent_phone             = get_post_meta($property_data->ID, 'property_other_agent_phone', true);
    $property_other_agent_phone_value       = !empty($property_other_agent_phone) ? $property_other_agent_phone : '';
    $property_other_agent_description       = get_post_meta($property_data->ID, 'property_other_agent_description', true);
    $property_other_agent_description_value = !empty($property_other_agent_description) ? $property_other_agent_description : '';
}
$show_hide_property_fields = tfre_get_option('show_hide_property_fields', array());
?>
<div class="tfre-field-wrap tfre-property-agent-sc">
    <div class="tfre-field-title">
        <h3><?php esc_html_e('Agent Information', 'tf-real-estate'); ?></h3>
    </div>
    <div class="tfre-field tfre-property-agent-information">
        <?php if ($show_hide_property_fields['agent_info'] == 1): ?>
            <div class="form-group">
                <label><?php echo esc_html__('Choose type agent information?', 'tf-real-estate') ?></label>
                <div class="agent-information-options">
                    <div class="group-checkbox">
                        <input class="tfre-agent-info-information-option" id="agent_info_information_option" value="agent_info" type="radio"
                            name="agent_information_options" <?php checked($agent_information_options_value, 'agent_info') ?>>
                        <label class="form-check-label" for="agent_info_information_option">
                            <?php esc_html_e('Your current user information', 'tf-real-estate'); ?>
                        </label>
                    </div>
                    <div class="group-checkbox">
                        <input class="tfre-other-info-information-option" id="other_info_information_option" value="other_info" type="radio"
                            name="agent_information_options" <?php checked($agent_information_options_value, 'other_info') ?>>
                        <label class="form-check-label" for="other_info_information_option">
                            <?php esc_html_e('Other contact', 'tf-real-estate'); ?>
                        </label>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="tfre-field tfre-property-agent-information-content">
        <?php if ($show_hide_property_fields['agent_info'] == 1): ?>
            <div class="tfre-other-info-information" style="display: none;">
                <div class="form-group">
                    <label for="property_other_agent_name"><?php esc_html_e('Other contact name', 'tf-real-estate'); ?></label>
                    <input type="text" id="property_other_agent_name" class="form-control" name="property_other_agent_name"
                        value="<?php echo esc_attr($property_other_agent_name_value); ?>">
                </div>
                <div class="form-group">
                    <label for="property_other_agent_email"><?php esc_html_e('Other contact email', 'tf-real-estate'); ?></label>
                    <input type="text" id="property_other_agent_email" class="form-control"
                        name="property_other_agent_email"
                        value="<?php echo esc_attr($property_other_agent_email_value); ?>">
                </div>
                <div class="form-group">
                    <label for="property_other_agent_phone"><?php esc_html_e('Other contact phone', 'tf-real-estate'); ?></label>
                    <input type="text" id="property_other_agent_phone" class="form-control"
                        name="property_other_agent_phone"
                        value="<?php echo esc_attr($property_other_agent_phone_value); ?>">
                </div>
                <div class="form-group">
                    <label for="property_other_agent_description"><?php esc_html_e('Other contact description', 'tf-real-estate'); ?></label>
                    <textarea rows="5" id="property_other_agent_description"
                        name="property_other_agent_description"><?php echo esc_attr($property_other_agent_description_value); ?></textarea>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>