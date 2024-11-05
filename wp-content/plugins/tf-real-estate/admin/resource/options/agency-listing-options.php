<?php
return array(
    'id'     => 'agency-listing-options',
    'title'  => esc_html__('Agency Listing', 'tf-real-estate'),
    'icon'   => 'el el-folder-close',
    'fields' => array(
        array(
            'id'       => 'item_per_page_agency_listing',
            'type'     => 'text',
            'title'    => esc_html__('Item Agency Per Page', 'tf-real-estate'),
            'subtitle' => esc_html__('Set number of item per page agency listing.', 'tf-real-estate'),
            'default'  => esc_html__('10', 'tf-real-estate')
        ),
        array(
            'id'       => 'item_properties_per_page_single_agency',
            'type'     => 'text',
            'title'    => esc_html__('Item Properties Per Page Agency Single', 'tf-real-estate'),
            'subtitle' => esc_html__('Set number of properties item per page single agency.', 'tf-real-estate'),
            'default'  => esc_html__('4', 'tf-real-estate')
        ),
        array(
            'id'       => 'agency_listing_sidebar',
            'type'     => 'button_set',
            'title'    => esc_html__('Sidebar', 'tf-real-estate'),
            'subtitle' => esc_html__('Enable/Disable sidebar.', 'tf-real-estate'),
            'class'    => 'hide-icon-blank',
            'options'  => array(
                'enable'  => esc_html__('Enable','tf-real-estate'),
                'disable' => esc_html__('Disable','tf-real-estate'),
            ),
            'default'  => 'disable',
        ),
        array(
            'id'       => 'agency_listing_sidebar_position',
            'type'     => 'button_set',
            'title'    => esc_html__('Sidebar Position', 'tf-real-estate'),
            'subtitle' => esc_html__('Choose sidebar position.', 'tf-real-estate'),
            'class'    => 'hide-icon-blank',
            'options'  => array(
                'sidebar-left'  => 'Sidebar Left',
                'sidebar-right' => 'Sidebar Right',
            ),
            'default'  => 'sidebar-right',
            'required' => array( 'agency_listing_sidebar', '=', 'enable' )
        ),
    )
);