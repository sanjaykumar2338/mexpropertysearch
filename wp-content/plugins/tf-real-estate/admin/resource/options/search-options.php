<?php
return array(
    'title'  => esc_html__('Search Options', 'tf-real-estate'),
    'id'     => 'search-options',
    'desc'   => '',
    'icon'   => 'el el-search',
    'fields' => array(
        array(
            'id'       => 'begin_advanced_search',
            'type'     => 'accordion',
            'title'    => esc_html__('Advanced Search', 'tf-real-estate'),
            'position' => 'start',
            'open'     => true
        ),
        array(
            'id'      => 'enable_advanced_search_ajax',
            'type'    => 'button_set',
            'title'   => esc_html__('Enable Advanced Search Ajax', 'tf-real-estate'),
            'options' => array(
                'y' => esc_html__('Yes', 'tf-real-estate'),
                'n' => esc_html__('No', 'tf-real-estate'),
            ),
            'default' => 'y',
            'class'   => 'hide-icon-blank',
        ),
        array(
            'id'      => 'enable_advanced_search_form',
            'type'    => 'button_set',
            'title'   => esc_html__('Enable Advanced Search Form', 'tf-real-estate'),
            'options' => array(
                'y' => esc_html__('Yes', 'tf-real-estate'),
                'n' => esc_html__('No', 'tf-real-estate'),
            ),
            'default' => 'y',
            'class'   => 'hide-icon-blank',
        ),
        array(
            'id'    => 'item_per_page_advanced_search',
            'type'  => 'text',
            'title' => esc_html__('Items Per Page Advanced Search', 'tf-real-estate'),
        ),
        array(
            'id'      => 'enable_save_search',
            'type'    => 'button_set',
            'title'   => esc_html__('Enable Save Search', 'tf-real-estate'),
            'options' => array(
                'y' => esc_html__('Yes', 'tf-real-estate'),
                'n' => esc_html__('No', 'tf-real-estate'),
            ),
            'default' => 'y',
            'class'   => 'hide-icon-blank',
        ),
        array(
            'id'    => 'item_per_page_saved_advanced_search',
            'type'  => 'text',
            'title' => esc_html__('Item Per Page Saved Advanced Search', 'tf-real-estate'),
        ),
        array(
            'id'      => 'search_criteria_keyword_field',
            'type'    => 'select',
            'title'   => esc_html__('Search Criteria Keyword Field', 'tf-real-estate'),
            'desc'    => esc_html__('Choose one search criteria for the keyword field', 'tf-real-estate'),
            'options' => array(
                'criteria_title'   => esc_html__('Title', 'tf-real-estate'),
                'criteria_address' => esc_html__('Address, street, zip or property ID', 'tf-real-estate'),
                'criteria_state'   => esc_html__('State or Area', 'tf-real-estate'),
            ),
            'default' => 'criteria_title',
        ),
        array(
            'id'      => 'price_search_field_type',
            'type'    => 'button_set',
            'title'   => esc_html__('Property Price Field Type', 'tf-real-estate'),
            'options' => array(
                'dropdown' => esc_html__('Dropdown', 'tf-real-estate'),
                'slider'   => esc_html__('Slider', 'tf-real-estate'),
            ),
            'default' => 'dropdown',
            'class'   => 'hide-icon-blank',
        ),
        array(
            'id'      => 'size_search_field_type',
            'type'    => 'button_set',
            'title'   => esc_html__('Property Size Field Type', 'tf-real-estate'),
            'options' => array(
                'dropdown' => esc_html__('Dropdown', 'tf-real-estate'),
                'slider'   => esc_html__('Slider', 'tf-real-estate'),
            ),
            'default' => 'dropdown',
            'class'   => 'hide-icon-blank',
        ),
        array(
            'id'      => 'land_size_search_field_type',
            'type'    => 'button_set',
            'title'   => esc_html__('Property Land Size Field Type', 'tf-real-estate'),
            'options' => array(
                'dropdown' => esc_html__('Dropdown', 'tf-real-estate'),
                'slider'   => esc_html__('Slider', 'tf-real-estate'),
            ),
            'default' => 'dropdown',
            'class'   => 'hide-icon-blank',
        ),
        array(
            'id'      => 'garage_size_search_field_type',
            'type'    => 'button_set',
            'title'   => esc_html__('Property Garage Size Field Type', 'tf-real-estate'),
            'options' => array(
                'dropdown' => esc_html__('Dropdown', 'tf-real-estate'),
                'slider'   => esc_html__('Slider', 'tf-real-estate'),
            ),
            'default' => 'dropdown',
            'class'   => 'hide-icon-blank',
        ),
        array(
            'id'      => 'toggle_property_features',
            'type'    => 'button_set',
            'title'   => esc_html__('Toggle Property Features', 'tf-real-estate'),
            'options' => array(
                'y' => esc_html__('Yes', 'tf-real-estate'),
                'n' => esc_html__('No', 'tf-real-estate'),
            ),
            'default' => 'n',
            'class'   => 'hide-icon-blank',
        ),
        array(
            'id'       => 'end_advanced_search',
            'type'     => 'accordion',
            'position' => 'end',
        ),

        // Price Field Value
        array(
            'id'       => 'begin_price_field',
            'type'     => 'accordion',
            'title'    => esc_html__('Price Field', 'tf-real-estate'),
            'position' => 'start',
            'open'     => false
        ),
        array(
            'id'    => 'minimum_prices_dropdown',
            'type'  => 'text',
            'title' => esc_html__('Minimum Prices Dropdown', 'tf-real-estate'),
            'desc'  => esc_html__('Allow only comma separated numbers list', 'tf-real-estate')
        ),
        array(
            'id'    => 'maximum_prices_dropdown',
            'type'  => 'text',
            'title' => esc_html__('Maximum Prices Dropdown', 'tf-real-estate'),
            'desc'  => esc_html__('Allow only comma separated numbers list', 'tf-real-estate'),
        ),
        array(
            'id'    => 'minimum_prices_slider',
            'type'  => 'text',
            'title' => esc_html__('Minimum Prices Slider', 'tf-real-estate'),
        ),
        array(
            'id'    => 'maximum_prices_slider',
            'type'  => 'text',
            'title' => esc_html__('Maximum Prices Slider', 'tf-real-estate'),
        ),
        array(
            'id'       => 'end_price_field',
            'type'     => 'accordion',
            'position' => 'end',
        ),
        // Size Field Value
        array(
            'id'       => 'accordion_size_field_start',
            'type'     => 'accordion',
            'title'    => esc_html__('Size Field', 'tf-real-estate'),
            'position' => 'start',
            'open'     => false
        ),
        array(
            'id'    => 'minimum_sizes_dropdown',
            'type'  => 'text',
            'title' => esc_html__('Minimum Sizes Dropdown', 'tf-real-estate'),
            'desc'  => esc_html__('Allow only comma separated numbers list', 'tf-real-estate')
        ),
        array(
            'id'    => 'maximum_sizes_dropdown',
            'type'  => 'text',
            'title' => esc_html__('Maximum Sizes Dropdown', 'tf-real-estate'),
            'desc'  => esc_html__('Allow only comma separated numbers list', 'tf-real-estate')
        ),
        array(
            'id'    => 'minimum_sizes_slider',
            'type'  => 'text',
            'title' => esc_html__('Minimum Sizes Slider', 'tf-real-estate'),
        ),
        array(
            'id'    => 'maximum_sizes_slider',
            'type'  => 'text',
            'title' => esc_html__('Maximum Sizes Slider', 'tf-real-estate'),
        ),
        array(
            'id'       => 'accordion_size_field_end',
            'type'     => 'accordion',
            'position' => 'end',
        ),
        // Land Size Field Value
        array(
            'id'       => 'accordion_land_size_field_start',
            'type'     => 'accordion',
            'title'    => esc_html__('Land Size Field', 'tf-real-estate'),
            'position' => 'start',
            'open'     => false
        ),
        array(
            'id'    => 'minimum_land_sizes_dropdown',
            'type'  => 'text',
            'title' => esc_html__('Minimum Land Sizes Dropdown', 'tf-real-estate'),
            'desc'  => esc_html__('Allow only comma separated numbers list', 'tf-real-estate')
        ),
        array(
            'id'    => 'maximum_land_sizes_dropdown',
            'type'  => 'text',
            'title' => esc_html__('Maximum Land Sizes Dropdown', 'tf-real-estate'),
            'desc'  => esc_html__('Allow only comma separated numbers list', 'tf-real-estate')
        ),
        array(
            'id'    => 'minimum_land_sizes_slider',
            'type'  => 'text',
            'title' => esc_html__('Minimum Land Sizes Slider', 'tf-real-estate'),
        ),
        array(
            'id'    => 'maximum_land_sizes_slider',
            'type'  => 'text',
            'title' => esc_html__('Maximum Land Sizes Slider', 'tf-real-estate'),
        ),
        array(
            'id'       => 'accordion_land_size_field_end',
            'type'     => 'accordion',
            'position' => 'end',
        ),
        // Garage Size Field Value
        array(
            'id'       => 'accordion_garage_size_field_start',
            'type'     => 'accordion',
            'title'    => esc_html__('Garage Size Field', 'tf-real-estate'),
            'position' => 'start',
            'open'     => false
        ),
        array(
            'id'    => 'minimum_garage_sizes_dropdown',
            'type'  => 'text',
            'title' => esc_html__('Minimum Garage Sizes Dropdown', 'tf-real-estate'),
            'desc'  => esc_html__('Allow only comma separated numbers list', 'tf-real-estate')
        ),
        array(
            'id'    => 'maximum_garage_sizes_dropdown',
            'type'  => 'text',
            'title' => esc_html__('Maximum Garage Sizes Dropdown', 'tf-real-estate'),
            'desc'  => esc_html__('Allow only comma separated numbers list', 'tf-real-estate')
        ),
        array(
            'id'    => 'minimum_garage_sizes_slider',
            'type'  => 'text',
            'title' => esc_html__('Minimum Garage Sizes Slider', 'tf-real-estate'),
        ),
        array(
            'id'    => 'maximum_garage_sizes_slider',
            'type'  => 'text',
            'title' => esc_html__('Maximum Garage Sizes Slider', 'tf-real-estate'),
        ),
        array(
            'id'       => 'accordion_garage_size_field_end',
            'type'     => 'accordion',
            'position' => 'end',
        ),
        // Other dropdown Fields
        array(
            'id'       => 'accordion_other_dropdown_field_start',
            'type'     => 'accordion',
            'title'    => esc_html__('Other Dropdown Field', 'tf-real-estate'),
            'position' => 'start',
            'open'     => false
        ),
        array(
            'id'    => 'rooms_list_dropdown',
            'type'  => 'text',
            'title' => esc_html__('Rooms List Dropdown', 'tf-real-estate'),
            'desc'  => esc_html__('Allow only comma separated numbers list', 'tf-real-estate')
        ),
        array(
            'id'    => 'bathrooms_list_dropdown',
            'type'  => 'text',
            'title' => esc_html__('Bathrooms List Dropdown', 'tf-real-estate'),
            'desc'  => esc_html__('Allow only comma separated numbers list', 'tf-real-estate')
        ),
        array(
            'id'    => 'bedrooms_list_dropdown',
            'type'  => 'text',
            'title' => esc_html__('Bedrooms List Dropdown', 'tf-real-estate'),
            'desc'  => esc_html__('Allow only comma separated numbers list', 'tf-real-estate')
        ),
        array(
            'id'    => 'garages_list_dropdown',
            'type'  => 'text',
            'title' => esc_html__('Garages List Dropdown', 'tf-real-estate'),
            'desc'  => esc_html__('Allow only comma separated numbers list', 'tf-real-estate')
        ),
        array(
            'id'       => 'accordion_other_dropdown_field_end',
            'type'     => 'accordion',
            'position' => 'end',
        ),
        // Show Hide Advanced Form Fields Accordion
        array(
            'id'       => 'begin_show_hide_advanced_search_fields',
            'type'     => 'accordion',
            'title'    => esc_html__('Sort and Show Advanced Search Fields', 'tf-real-estate'),
            'position' => 'start',
            'open'     => false
        ),
        array(
            'id'    => 'placeholder_keyword_field',
            'type'  => 'text',
            'title' => esc_html__('Placeholder Keyword Field', 'tf-real-estate'),
            'desc'  => esc_html__('Change placeholder input search keyword', 'tf-real-estate')
        ),
        array(
            'id'       => 'advanced_search_fields',
            'type'     => 'sortable',
            'mode'     => 'checkbox',
            'title'    => esc_html__('Show Advanced Search Form Fields', 'tf-real-estate'),
            'subtitle' => esc_html__('Choose which fields you want to show on advanced search form?', 'tf-real-estate'),
            'options'  => array(
                'keyword'               => esc_html__('Keyword', 'tf-real-estate'),
                'property-type'         => esc_html__('Property type', 'tf-real-estate'),
                'property-country'      => esc_html__('Property country', 'tf-real-estate'),
                'property-title'        => esc_html__('Property title', 'tf-real-estate'),
                'property-address'      => esc_html__('Property Address', 'tf-real-estate'),
                'property-status'       => esc_html__('Property status', 'tf-real-estate'),
                'property-label'        => esc_html__('Property label', 'tf-real-estate'),
                'province-state'        => esc_html__('Property province state', 'tf-real-estate'),
                'property-neighborhood' => esc_html__('Property neighborhood', 'tf-real-estate'),
                'property-rooms'        => esc_html__('Property rooms', 'tf-real-estate'),
                'property-bathrooms'    => esc_html__('Property bathrooms', 'tf-real-estate'),
                'property-bedrooms'     => esc_html__('Property bedrooms', 'tf-real-estate'),
                'property-garage'       => esc_html__('Property garage', 'tf-real-estate'),
                'property-garage-size'  => esc_html__('Property garage size', 'tf-real-estate'),
                'property-price'        => esc_html__('Property Price', 'tf-real-estate'),
                'property-size'         => esc_html__('Property Size', 'tf-real-estate'),
                'property-land-size'    => esc_html__('Property land size', 'tf-real-estate'),
                'property-feature'      => esc_html__('Property feature', 'tf-real-estate'),
            ),
            'default'  => array(
                'keyword'               => true,
                'property-type'         => true,
                'property-country'      => true,
                'property-title'        => false,
                'property-address'      => false,
                'property-status'       => true,
                'property-label'        => false,
                'province-state'        => true,
                'property-neighborhood' => true,
                'property-rooms'        => true,
                'property-bathrooms'    => true,
                'property-bedrooms'     => true,
                'property-garage'       => false,
                'property-garage-size'  => false,
                'property-price'        => true,
                'property-size'         => true,
                'property-land-size'    => false,
                'property-feature'      => true,
            ),
        ),
        array(
            'id'       => 'end_show_hide_advanced_search_fields',
            'type'     => 'accordion',
            'position' => 'end',
        ),
    )
);
?>