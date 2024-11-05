<?php
/**
 * @var $property_data
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$property_title_value          = $property_data ? $property_data->post_title : '';
$property_full_address_value   = $property_data ? get_post_meta($property_data->ID, 'property_address', true) : '';
$property_zip_code_value       = $property_data ? get_post_meta($property_data->ID, 'property_zip', true) : '';
$property_country_value        = $property_data ? get_post_meta($property_data->ID, 'property_country', true) : '';
$property_province_state_value = $property_data ? tfre_get_single_taxonomy_by_post_id($property_data->ID, 'province-state', true) : '';
$property_neighborhood_value   = $property_data ? tfre_get_single_taxonomy_by_post_id($property_data->ID, 'neighborhood', true) : '';
$property_location_value       = $property_data ? get_post_meta($property_data->ID, 'property_location', true) : '';
$show_hide_property_fields     = tfre_get_option('show_hide_property_fields', array());
?>
<div class="tfre-field-wrap tfre-property-information">
    <div class="tfre-field-title">
        <h3><?php esc_html_e('Information', 'tf-real-estate'); ?></h3>
    </div>
    <div class="tfre-field tfre-property-title">
        <div class="form-group">
            <label
                for="property_title"><?php echo esc_html__('Title', 'tf-real-estate') . tfre_required_field('property-type', 'required_property_fields'); ?></label>
            <input type="text" id="property_title" class="form-control" name="property_title"
                placeholder="<?php esc_attr_e('Enter title', 'tf-real-estate'); ?>"
                value="<?php echo esc_attr($property_title_value); ?>" />
        </div>
    </div>
    <div class="tfre-field tfre-property-description">
        
        <?php if ($show_hide_property_fields['property_description'] == 1): ?>
            <div class="form-group">
                <label
                    for="property_description"><?php echo esc_html__('Description', 'tf-real-estate'); ?></label>
                <?php
                $description = $property_data ? $property_data->post_content : '';
                $editor_id   = 'property_description';
                $settings    = array(
                    'wpautop'       => true,
                    'media_buttons' => false,
                    'textarea_name' => $editor_id,
                    'textarea_rows' => get_option('default_post_edit_rows', 5),
                    'teeny'         => false,
                    'dfw'           => false,
                    'tinymce'       => true,
                    'quicktags'     => true,
                    'editor_css'    => '',
                    'editor_class'  => '',
                );
                wp_editor($description, $editor_id, $settings); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="property-fields property-location row">
        <div class="col-sm-4">
            <?php if ($show_hide_property_fields['property_full_address'] == 1): ?>
                <div class="form-group">
                    <label
                        for="full_address"><?php echo esc_html__('Full Address', 'tf-real-estate') . tfre_required_field('property_full_address', 'required_property_fields'); ?></label>
                    <input type="text" class="form-control" name="property_full_address" id="full_address"
                        value="<?php echo esc_attr($property_full_address_value); ?>"
                        placeholder="<?php esc_attr_e('Enter property full address', 'tf-real-estate'); ?>">
                </div>
            <?php endif; ?>
        </div>
        <div class="col-sm-4">
            <?php if ($show_hide_property_fields['property_zip_code'] == 1): ?>
                <div class="form-group">
                    <label
                        for="zip_code"><?php echo esc_html__('Zip Code', 'tf-real-estate') . tfre_required_field('property_zip_code', 'required_property_fields'); ?></label>
                    <input type="text" class="form-control" name="property_zip_code" id="zip_code"
                        value="<?php echo esc_attr($property_zip_code_value); ?>"
                        placeholder="<?php esc_attr_e('Enter property zip code', 'tf-real-estate'); ?>">
                </div>
            <?php endif; ?>
        </div>
        <div class="col-sm-4">
            <?php if ($show_hide_property_fields['property_country'] == 1): ?>
                <div class="form-group">
                    <label
                        for="property_country"><?php echo esc_html__('Country', 'tf-real-estate') . tfre_required_field('property_country', 'required_property_fields'); ?></label>
                    <select name="property_country" id="property_country" class="form-control">
                        <?php
                        $default_country = $property_country_value ? $property_country_value : 'AF';
                        $countries       = tfre_selected_countries();
                        foreach ($countries as $key => $country):
                            echo '<option ' . selected($default_country, $key, false) . ' value="' . esc_attr($key) . '">' . esc_html($country) . '</option>';
                        endforeach;
                        ?>
                    </select>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-sm-6">
            <?php if ($show_hide_property_fields['property_province_state'] == 1): ?>
                <div class="form-group">
                    <label
                        for="property_province_state"><?php echo esc_html__('Province / State', 'tf-real-estate') . tfre_required_field('property_province_state', 'required_property_fields'); ?></label>
                    <select name="property_province_state" id="property_province_state" class="form-control">
                        <?php tfre_get_taxonomy_options('province-state', $property_province_state_value, true); ?>
                    </select>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-sm-6">
            <?php if ($show_hide_property_fields['property_neighborhood'] == 1): ?>
                <div class="form-group">
                    <label
                        for="property_neighborhood"><?php echo esc_html__('Neighborhood', 'tf-real-estate') . tfre_required_field('property_neighborhood', 'required_property_fields'); ?></label>
                    <select name="property_neighborhood" id="property_neighborhood" class="form-control">
                        <?php tfre_get_taxonomy_options('neighborhood', $property_neighborhood_value, true); ?>
                    </select>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-sm-12 mt-3">
            <?php if ($show_hide_property_fields['map'] == 1): ?>
                <div class="map-container">
                    <input data-field-control="" class="latlng_searching" type="hidden" class="tfre-map-latlng-field"
                        name="property_location[]"
                        value="<?php echo esc_attr(is_array($property_location_value) ? $property_location_value[0] : ''); ?>" />
                    <div class="tfre-map-address-field">
                        <div class="tfre-map-address-field-input">
                            <input data-field-control="" class="address_searching" type="text" name="property_location[]"
                                value="<?php echo esc_attr(is_array($property_location_value) ? $property_location_value[1] : ''); ?>" />
                        </div>
                        <button type="button" class="button-location">
                            <i class="fa fa-location-arrow"></i>
                        </button>
                    </div>
                    <div class="map mt-3" id="map-single" style="height: 300px">
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>