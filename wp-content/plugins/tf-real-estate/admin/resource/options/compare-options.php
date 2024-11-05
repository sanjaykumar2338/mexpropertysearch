<?php
return array(
    'title'  => esc_html__('Compare Options', 'tf-real-estate'),
    'id'     => 'compare-options',
    'desc'   => '',
    'icon'   => 'el el-filter',
    'fields' => array(
        array(
            'id'      => 'enable_compare',
            'type'    => 'button_set',
            'title'   => esc_html__('Enable Compare Properties', 'tf-real-estate'),
            'options' => array(
                'y' => esc_html__('Yes', 'tf-real-estate'),
                'n' => esc_html__('No', 'tf-real-estate'),
            ),
            'default' => 'y',
            'class'   => 'hide-icon-blank',
        ),
        array(
            'id'    => 'max_items_compare',
            'type'  => 'text',
            'title' => esc_html__('Max Items Compare', 'tf-real-estate'),
        ),
        // Show Hide Compare Fields Accordion
        array(
            'id'       => 'begin_show_hide_compare_fields',
            'type'     => 'accordion',
            'title'    => esc_html__('Show Compare Fields', 'tf-real-estate'),
            'position' => 'start',
            'open'     => false
        ),
        array(
            'id'       => 'show_hide_compare_fields',
            'type'     => 'checkbox',
            'title'    => esc_html__('Show Compare Fields', 'tf-real-estate'),
            'subtitle' => esc_html__('Choose which fields you want to show on compare page?', 'tf-real-estate'),
            'options'  => array(
                'property-feature'     => esc_html__('Property Feature', 'tf-real-estate'),
                'property-type'        => esc_html__('Property Type', 'tf-real-estate'),
                'property-status'      => esc_html__('Property Status', 'tf-real-estate'),
                'property_year'        => esc_html__('Property Year', 'tf-real-estate'),
                'property_size'        => esc_html__('Property Size', 'tf-real-estate'),
                'property_garage_size' => esc_html__('Property Garage Size', 'tf-real-estate'),
                'property_land'        => esc_html__('Property Land Area', 'tf-real-estate'),
                'property_rooms'       => esc_html__('Property Rooms', 'tf-real-estate'),
                'property_bedrooms'    => esc_html__('Property Bedrooms', 'tf-real-estate'),
                'property_bathrooms'   => esc_html__('Property Bathrooms', 'tf-real-estate'),
                'property_garage'      => esc_html__('Property Garage', 'tf-real-estate'),
            ),
            'default' => array(
                'property-feature'     => 1,
                'property-type'        => 1,
                'property-status'      => 1,
                'property_year'        => 1,
                'property_size'        => 1,
                'property_garage_size' => 1,
                'property_land'        => 1,
                'property_rooms'       => 1,
                'property_bedrooms'    => 1,
                'property_bathrooms'   => 1,
                'property_garage'      => 1,
            )
        ),
        array(
            'id'       => 'end_show_hide_compare_fields',
            'type'     => 'accordion',
            'position' => 'end',
        ),
    )
);
?>