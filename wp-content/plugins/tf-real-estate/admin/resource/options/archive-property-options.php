<?php
return array(
	'id'     => 'archive-property-options',
	'title'  => esc_html__( 'Archive Property', 'tf-real-estate' ),
	'icon'   => 'el el-folder-close',
	'fields' => array(
		array(
			'id'       => 'layout_archive_property',
			'type'     => 'image_select',
			'title'    => esc_html__( 'Layout', 'tf-real-estate' ),
			'subtitle' => esc_html__( 'Select main layout for archive property page. Choose between grid or list layout.', 'tf-real-estate' ),
			'options'  => array(
				'grid' => array(
					'alt' => esc_html__( 'grid', 'tf-real-estate' ),
					'img' => ReduxFramework::$_url . 'assets/img/4-col-portfolio.png'
				),
				'list' => array(
					'alt' => esc_html__( 'list', 'tf-real-estate' ),
					'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
				),
			),
			'default'  => 'grid'
		),
		array(
			'id'       => 'begin_layout_grid_options',
			'type'     => 'section',
			'title'    => esc_html__( 'Layout Grid', 'tf-real-estate' ),
			'indent'   => true,
			'required' => array( 'layout_archive_property', '=', 'grid' )
		),
		array(
			'id'       => 'item_style_layout_grid',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Item Style', 'tf-real-estate' ),
			'subtitle' => esc_html__( 'Choose item style of archive property', 'tf-real-estate' ),
			'class'    => 'hide-icon-blank',
			'options'  => array(
				'style1' => esc_html__( 'Style 1', 'tf-real-estate' ),
				'style3' => esc_html__( 'Style 2', 'tf-real-estate' ),
				'style4' => esc_html__( 'Style 3', 'tf-real-estate' ),
			),
			'default'  => 'style1',
			'required' => array( 'layout_archive_property', '=', 'grid' )
		),
		array(
			'id'       => 'column_layout_grid',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Columns', 'tf-real-estate' ),
			'subtitle' => esc_html__( 'Choose columns of archive property', 'tf-real-estate' ),
			'class'    => 'hide-icon-blank',
			'options'  => array(
				'column-2' => esc_html__( 'Column 2', 'tf-real-estate' ),
				'column-3' => esc_html__( 'Column 3', 'tf-real-estate' ),
				'column-4' => esc_html__( 'Column 4', 'tf-real-estate' )
			),
			'default'  => 'column-4',
			'required' => array( 'layout_archive_property', '=', 'grid' )
		),
		array(
			'id'       => 'end_layout_grid_options',
			'type'     => 'section',
			'indent'   => false,
			'required' => array( 'layout_archive_property', '=', 'grid' )
		),

		array(
			'id'       => 'begin_layout_list_options',
			'type'     => 'section',
			'title'    => esc_html__( 'Layout List', 'tf-real-estate' ),
			'indent'   => true,
			'required' => array( 'layout_archive_property', '=', 'list' )
		),
		array(
			'id'       => 'item_style_layout_list',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Item Style', 'tf-real-estate' ),
			'subtitle' => esc_html__( 'Choose item style of archive property', 'tf-real-estate' ),
			'class'    => 'hide-icon-blank',
			'options'  => array(
				'style2' => esc_html__( 'Style 1', 'tf-real-estate' ),
				'style5' => esc_html__( 'Style 2', 'tf-real-estate' ),
			),
			'default'  => 'style2',
			'required' => array( 'layout_archive_property', '=', 'list' )
		),
		array(
			'id'       => 'column_layout_list',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Columns', 'tf-real-estate' ),
			'subtitle' => esc_html__( 'Choose columns of archive property', 'tf-real-estate' ),
			'class'    => 'hide-icon-blank',
			'options'  => array(
				'column-1' => esc_html__( 'Column 1', 'tf-real-estate' ),
				'column-2' => esc_html__( 'Column 2', 'tf-real-estate' ),
			),
			'default'  => 'column-2',
			'required' => array( 'layout_archive_property', '=', 'list' )
		),
		array(
			'id'       => 'end_layout_list_options',
			'type'     => 'section',
			'indent'   => false,
			'required' => array( 'layout_archive_property', '=', 'list' )
		),
		array(
			'id'       => 'archive_property_search_form',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Search Form', 'tf-real-estate' ),
			'subtitle' => esc_html__( 'Enable/Disable Search Form.', 'tf-real-estate' ),
			'class'    => 'hide-icon-blank',
			'options'  => array(
				'enable'  => esc_html__( 'Enable', 'tf-real-estate' ),
				'disable' => esc_html__( 'Disable', 'tf-real-estate' ),
			),
			'default'  => 'enable',
		),
		array(
			'id'       => 'map_position',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Map Position', 'tf-real-estate' ),
			'subtitle' => esc_html__( 'Choose map position.', 'tf-real-estate' ),
			'class'    => 'hide-icon-blank',
			'options'  => array(
				'hide-map'       => esc_html__( 'Hide Map', 'tf-real-estate' ),
				'map-header'     => esc_html__( 'Map Header', 'tf-real-estate' ),
				'half-map-right' => esc_html__( 'Half Map Right', 'tf-real-estate' ),
				'half-map-left'  => esc_html__( 'Half Map Left', 'tf-real-estate' ),
			),
			'default'  => 'half-map-right',
		),
		array(
            'id'      => 'hide_map_mobile',
            'type'    => 'button_set',
            'title'   => esc_html__('Hide Map On Mobile', 'tf-real-estate'),
            'options' => array(
                'y' => esc_html__('Yes', 'tf-real-estate'),
                'n' => esc_html__('No', 'tf-real-estate'),
            ),
            'default' => 'n',
            'class'   => 'hide-icon-blank',
        ),
		array(
			'id'       => 'item_per_page_archive_property',
			'type'     => 'text',
			'title'    => esc_html__( 'Item Per Page', 'tf-real-estate' ),
			'subtitle' => esc_html__( 'Set number of item per page archive property.', 'tf-real-estate' ),
			'default'  => esc_html__( '10', 'tf-real-estate' )
		),
		array(
			'id'       => 'archive_property_sidebar',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Sidebar', 'tf-real-estate' ),
			'subtitle' => esc_html__( 'Enable/Disable sidebar.', 'tf-real-estate' ),
			'class'    => 'hide-icon-blank',
			'options'  => array(
				'enable'  => esc_html__( 'Enable', 'tf-real-estate' ),
				'disable' => esc_html__( 'Disable', 'tf-real-estate' ),
			),
			'default'  => 'disable',
			'required' => array(
				array( 'map_position', '=', array( 'hide-map', 'map-header' ) )
			)
		),
		array(
			'id'       => 'archive_property_sidebar_position',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Sidebar Position', 'tf-real-estate' ),
			'subtitle' => esc_html__( 'Choose sidebar position.', 'tf-real-estate' ),
			'class'    => 'hide-icon-blank',
			'options'  => array(
				'sidebar-left'  => esc_html__( 'Sidebar Left', 'tf-real-estate' ),
				'sidebar-right' => esc_html__( 'Sidebar Right', 'tf-real-estate' ),
			),
			'default'  => 'sidebar-right',
			'required' => array( 'archive_property_sidebar', '=', 'enable' )
		),
		array(
			'id'       => 'begin_card_property',
			'type'     => 'accordion',
			'title'    => esc_html__( 'Card Property', 'tf-real-estate' ),
			'position' => 'start',
			'open'     => false
		),
		array(
			'id'      => 'enable_card_label',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable Label', 'tf-real-estate' ),
			'default' => 1,
		),
		array(
			'id'      => 'enable_card_price',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable Price', 'tf-real-estate' ),
			'default' => 1,
		),
		array(
			'id'      => 'enable_card_action',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable Action', 'tf-real-estate' ),
			'default' => 1,
		),
		array(
			'id'      => 'enable_card_address',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable Address', 'tf-real-estate' ),
			'default' => 1,
		),
		array(
			'id'      => 'enable_card_bedroom',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable Bedroom', 'tf-real-estate' ),
			'default' => 1,
		),
		array(
			'id'      => 'enable_card_bathroom',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable Bathroom', 'tf-real-estate' ),
			'default' => 1,
		),
		array(
			'id'      => 'enable_card_size',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable Size', 'tf-real-estate' ),
			'default' => 1,
		),
		array(
			'id'      => 'enable_card_land_area',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable Land Area', 'tf-real-estate' ),
			'default' => 0,
		),
		array(
			'id'      => 'enable_card_room',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable Room', 'tf-real-estate' ),
			'default' => 0,
		),
		array(
			'id'      => 'enable_card_garage',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable Garage', 'tf-real-estate' ),
			'default' => 0,
		),
		array(
			'id'      => 'enable_card_garage_size',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable Garage Size', 'tf-real-estate' ),
			'default' => 0,
		),
		array(
			'id'      => 'enable_card_agent',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable Agent', 'tf-real-estate' ),
			'default' => 1,
		),
		array(
			'id'      => 'enable_card_year',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable Year', 'tf-real-estate' ),
			'default' => 1,
		),
		array(
			'id'       => 'end_card_property',
			'type'     => 'accordion',
			'position' => 'end'
		),
	)
);