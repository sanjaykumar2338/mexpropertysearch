<?php
return array(
	'title'  => esc_html__( 'General Options', 'tf-real-estate' ),
	'id'     => 'general-options',
	'desc'   => '',
	'icon'   => 'el el-cog',
	'fields' => array(
		array(
			'id'      => 'toggle_lazy_load',
			'type'    => 'button_set',
			'title'   => esc_html__( 'On/Off LazyLoad', 'tf-real-estate' ),
			'options' => array(
				'on'  => esc_html__( 'On', 'tf-real-estate' ),
				'off' => esc_html__( 'Off', 'tf-real-estate' ),
			),
			'default' => 'off',
			'class'   => 'hide-icon-blank',
		),
		array(
			'id'      => 'language_datepicker',
			'type'    => 'select',
			'title'   => esc_html__( 'Language Datepicker', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Select language for datepicker', 'tf-real-estate' ),
			'options' => tfre_list_language_datepicker(),
			'default' => 'en-GB'
		),
		array(
			'id'      => 'map_service',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Map Service', 'tf-real-estate' ),
			'options' => array(
				'google-map' => esc_html__( 'Google Map', 'tf-real-estate' ),
				'map-box'    => esc_html__( 'MapBox', 'tf-real-estate' ),
			),
			'default' => 'map-box',
			'class'   => 'hide-icon-blank',
		),
		array(
			'id'       => 'google_map_api_key',
			'type'     => 'text',
			'title'    => esc_html__( 'Google Map API Key', 'tf-real-estate' ),
			'desc'     => sprintf( esc_html__( 'Get your %s google map API key %s for accurate and long-term use.', 'tf-real-estate' ), '<a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">', '</a>' ),
			'required' => array( 'map_service', '=', 'google-map' )
		),
		array(
			'id'       => 'map_box_api_key',
			'type'     => 'text',
			'title'    => esc_html__( 'MapBox API Key', 'tf-real-estate' ),
			'desc'     => sprintf( esc_html__( 'Get your %s MapBox API key %s for accurate and long-term use.', 'tf-real-estate' ), '<a href="https://www.mapbox.com" target="_blank">', '</a>' ),
			'required' => array( 'map_service', '=', 'map-box' )
		),
		array(
			'id'       => 'map_box_style',
			'type'     => 'select',
			'title'    => esc_html__( 'MapBox Style', 'tf-real-estate' ),
			'desc'     => esc_html__( 'Choose one map style', 'tf-real-estate' ),
			'options'  => array(
				'satellite-streets-v12' => esc_html__( 'satellite streets', 'tf-real-estate' ),
				'light-v11'             => esc_html__( 'light', 'tf-real-estate' ),
				'dark-v11'              => esc_html__( 'dark', 'tf-real-estate' ),
				'streets-v12'           => esc_html__( 'streets', 'tf-real-estate' ),
				'outdoors-v12'          => esc_html__( 'outdoors', 'tf-real-estate' ),
			),
			'default'  => 'streets-v12',
			'required' => array( 'map_service', '=', 'map-box' )
		),
		array(
			'id'            => 'map_zoom',
			'type'          => 'slider',
			'title'         => esc_html__( 'Map Zoom', 'tf-real-estate' ),
			"default"       => 10,
			"min"           => 1,
			"step"          => 1,
			"max"           => 25,
			'display_value' => 'text'
		),
		array(
			'id'      => 'default_marker_image',
			'type'    => 'media',
			'url'     => true,
			'title'   => esc_html__( 'Default Marker Image', 'tf-real-estate' ),
			'default' => array(
				'url' => ''
			),
		),
		array(
			'id'       => 'marker_image_width',
			'type'     => 'text',
			'title'    => esc_html__( 'Marker Image Width', 'tf-real-estate' ),
			'subtitle' => esc_html__( 'Set marker image width. (Ex: 30px)', 'tf-real-estate' ),
		),
		array(
			'id'       => 'marker_image_height',
			'type'     => 'text',
			'title'    => esc_html__( 'Marker Image Height', 'tf-real-estate' ),
			'subtitle' => esc_html__( 'Set marker image height. (Ex: 40px)', 'tf-real-estate' ),
		),
		array(
			'id'     => 'begin_custom_url_postype_heading',
			'type'   => 'section',
			'title'  => esc_html__( 'Custom Slug PostType', 'tf-real-estate' ),
			'subtitle' => esc_html__( 'When you make changes, please go to the permalinks settings and press "Save Changes" to refresh the URL. ', 'tf-real-estate' ),
			'indent' => true,
		),
		array(
			'id'       => 'custom_url_properties',
			'type'     => 'text',
			'title'    => esc_html__( 'Properties', 'tf-real-estate' ),
		),
		array(
			'id'       => 'custom_url_property_type',
			'type'     => 'text',
			'title'    => esc_html__( 'Property Type', 'tf-real-estate' ),
		),
		array(
			'id'       => 'custom_url_property_status',
			'type'     => 'text',
			'title'    => esc_html__( 'Property Status', 'tf-real-estate' ),
		),
		array(
			'id'       => 'custom_url_property_feature',
			'type'     => 'text',
			'title'    => esc_html__( 'Property Feature', 'tf-real-estate' ),
		),
		array(
			'id'       => 'custom_url_property_label',
			'type'     => 'text',
			'title'    => esc_html__( 'Property Label', 'tf-real-estate' ),
		),
		array(
			'id'       => 'custom_url_property_status',
			'type'     => 'text',
			'title'    => esc_html__( 'Property Status', 'tf-real-estate' ),
		),
		array(
			'id'       => 'custom_url_property_province_state',
			'type'     => 'text',
			'title'    => esc_html__( 'Property Province / State', 'tf-real-estate' ),
		),
		array(
			'id'       => 'custom_url_property_neighborhood',
			'type'     => 'text',
			'title'    => esc_html__( 'Property Neighborhood', 'tf-real-estate' ),
		),
		array(
			'id'       => 'custom_url_agent',
			'type'     => 'text',
			'title'    => esc_html__( 'Agent', 'tf-real-estate' ),
		),
		array(
			'id'       => 'custom_url_agency',
			'type'     => 'text',
			'title'    => esc_html__( 'Agency', 'tf-real-estate' ),
		),
	)
);
?>