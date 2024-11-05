<?php
return array(
	'title'  => esc_html__( 'Property Options', 'tf-real-estate' ),
	'id'     => 'property-options',
	'desc'   => '',
	'icon'   => 'el el-home',
	'fields' => array(
		array(
			'id'      => 'allow_submit_property_from_fe',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Allow to submit property from frontend', 'tf-real-estate' ),
			'options' => array(
				'y' => esc_html__( 'Yes', 'tf-real-estate' ),
				'n' => esc_html__( 'No', 'tf-real-estate' ),
			),
			'default' => 'y',
			'class'   => 'hide-icon-blank',
		),
		array(
			'id'      => 'all_user_can_submit_property',
			'type'    => 'button_set',
			'title'   => esc_html__( 'All User can submit property', 'tf-real-estate' ),
			'desc'    => esc_html__( 'If "No", only admin or agent can submit property', 'tf-real-estate' ),
			'options' => array(
				'y' => esc_html__( 'Yes', 'tf-real-estate' ),
				'n' => esc_html__( 'No', 'tf-real-estate' ),
			),
			'default' => 'y',
			'class'   => 'hide-icon-blank',
		),
		array(
			'id'      => 'auto_publish_submitted',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Automatically publish the submitted property?', 'tf-real-estate' ),
			'options' => array(
				'y' => esc_html__( 'Yes', 'tf-real-estate' ),
				'n' => esc_html__( 'No', 'tf-real-estate' ),
			),
			'default' => 'n',
			'class'   => 'hide-icon-blank',
		),
		array(
			'id'      => 'auto_publish_edited',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Automatically publish the edited property?', 'tf-real-estate' ),
			'options' => array(
				'y' => esc_html__( 'Yes', 'tf-real-estate' ),
				'n' => esc_html__( 'No', 'tf-real-estate' ),
			),
			'default' => 'n',
			'class'   => 'hide-icon-blank',
		),
		array(
			'id'       => 'add_property_panels_manager',
			'type'     => 'sortable',
			'title'    => esc_html__( 'Add Property Panels Manager', 'tf-real-estate' ),
			'subtitle' => esc_html__( 'Define and reorder these however you want.', 'tf-real-estate' ),
			'mode'     => 'checkbox',
			'options'  => array(
				'upload-media'           => esc_html__( 'Upload Media', 'tf-real-estate' ),
				'information'            => esc_html__( 'Information', 'tf-real-estate' ),
				'price'                  => esc_html__( 'Price', 'tf-real-estate' ),
				'additional-information' => esc_html__( 'Additional Information', 'tf-real-estate' ),
				'amenities'              => esc_html__( 'Amenities', 'tf-real-estate' ),
				'file-attachment'        => esc_html__( 'File Attachment', 'tf-real-estate' ),
				'virtual-360'            => esc_html__( 'Virtual 360', 'tf-real-estate' ),
				'video'                  => esc_html__( 'Video', 'tf-real-estate' ),
				'floors'                 => esc_html__( 'Floors', 'tf-real-estate' ),
				'agent'                  => esc_html__( 'Agent', 'tf-real-estate' )
			),
			'default'  => array(
				'upload-media'           => true,
				'information'            => true,
				'price'                  => true,
				'additional-information' => true,
				'amenities'              => true,
				'file-attachment'        => true,
				'virtual-360'            => true,
				'video'                  => true,
				'floors'                 => true,
				'agent'                  => true,
			),
		),
		array(
			'id'       => 'single_property_panels_manager',
			'type'     => 'sortable',
			'title'    => esc_html__( 'Single Property Panels Manager', 'tf-real-estate' ),
			'subtitle' => esc_html__( 'Show Hide and Reorder (except Gallery & Review) these however you want.', 'tf-real-estate' ),
			'mode'     => 'checkbox',
			'options'  => array(
				'overview'                => esc_html__( 'Overview', 'tf-real-estate' ),
				'description'             => esc_html__( 'Description', 'tf-real-estate' ),
				'property-detail'         => esc_html__( 'Property Details', 'tf-real-estate' ),
				'features'                => esc_html__( 'Features', 'tf-real-estate' ),
				'map-location'            => esc_html__( 'Map Address', 'tf-real-estate' ),
				'floors'                  => esc_html__( 'Floor Plans', 'tf-real-estate' ),
				'file-attachment'         => esc_html__( 'File Attachment', 'tf-real-estate' ),
				'video'                   => esc_html__( 'Video ', 'tf-real-estate' ),
				'virtual-360'             => esc_html__( '360 Virtual Tour', 'tf-real-estate' ),
				'loan-calculator'         => esc_html__( 'Loan Calculator', 'tf-real-estate' ),
				'nearby-places'           => esc_html__( 'Nearby Places', 'tf-real-estate' ),
				'gallery'                 => esc_html__( 'Gallery', 'tf-real-estate' ),
				'review'                  => esc_html__( 'Review', 'tf-real-estate' ),
				'global-custom-section'   => esc_html__( 'Global Custom Section', 'tf-real-estate' ),
				'personal-custom-section' => esc_html__( 'Personal Custom Section', 'tf-real-estate' ),
			),
			'default'  => array(
				'overview'                => true,
				'description'             => true,
				'property-detail'         => true,
				'features'                => true,
				'map-location'            => true,
				'floors'                  => true,
				'file-attachment'         => true,
				'video'                   => true,
				'virtual-360'             => true,
				'loan-calculator'         => true,
				'nearby-places'           => true,
				'gallery'                 => true,
				'review'                  => true,
				'global-custom-section'   => false,
				'personal-custom-section' => false,
			),
		),
		array(
			'id'    => 'item_per_page_my_properties',
			'type'  => 'text',
			'title' => esc_html__( 'Item Per Page My Properties', 'tf-real-estate' ),
		),
		array(
			'id'    => 'add_property_button_text',
			'type'  => 'text',
			'title' => esc_html__( 'Add Property Button Text', 'tf-real-estate' ),
		),
		array(
			'id'    => 'update_property_button_text',
			'type'  => 'text',
			'title' => esc_html__( 'Update Property Button Text', 'tf-real-estate' ),
		),
		array(
			'id'    => 'maximum_images',
			'type'  => 'text',
			'title' => esc_html__( 'Maximum Images', 'tf-real-estate' ),
			'desc'  => esc_html__( 'Maximum number of images allowed for single property', 'tf-real-estate' ),
		),
		array(
			'id'    => 'maximum_image_size',
			'type'  => 'text',
			'title' => esc_html__( 'Maximum Image Size', 'tf-real-estate' ),
			'desc'  => esc_html__( 'Maximum upload image file size. For example 10kb, 500kb, 1mb, 10m, 100mb', 'tf-real-estate' ),
		),
		array(
			'id'    => 'image_types',
			'type'  => 'text',
			'title' => esc_html__( 'Image Types', 'tf-real-estate' ),
			'desc'  => esc_html__( 'Allow only comma separated numbers. Ex: jpg,jpeg,gif,png', 'tf-real-estate' ),
		),
		array(
			'id'      => 'image_width_property',
			'type'    => 'text',
			'title'   => esc_html__( 'Image Width', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Set image width for property.', 'tf-real-estate' ),
			'default' => esc_html__( '628', 'tf-real-estate' )
		),
		array(
			'id'      => 'image_height_property',
			'type'    => 'text',
			'title'   => esc_html__( 'Image Height', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Set image height for property.', 'tf-real-estate' ),
			'default' => esc_html__( '450', 'tf-real-estate' )
		),
		array(
			'id'      => 'single_property_gallery_style',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Single Property Gallery Style', 'tf-real-estate' ),
			'options' => array(
				'gallery-style-slider'   => esc_html__( 'Slider (Style 1)', 'tf-real-estate' ),
				'gallery-style-slider-2' => esc_html__( 'Slider (Style 2)', 'tf-real-estate' ),
				'gallery-style-grid'     => esc_html__( 'Grid', 'tf-real-estate' ),
			),
			'default' => 'gallery-style-grid',
			'class'   => 'hide-icon-blank',
		),
		array(
			'id'    => 'maximum_attachments',
			'type'  => 'text',
			'title' => esc_html__( 'Maximum Attachments', 'tf-real-estate' ),
			'desc'  => esc_html__( 'Maximum number of attachments allowed for single property', 'tf-real-estate' ),
		),
		array(
			'id'    => 'maximum_attachment_size',
			'type'  => 'text',
			'title' => esc_html__( 'Maximum Attachment Size', 'tf-real-estate' ),
			'desc'  => esc_html__( 'Maximum upload attachment file size. For example 10kb, 500kb, 1mb, 10m, 100mb', 'tf-real-estate' ),
		),
		array(
			'id'    => 'attachment_types',
			'type'  => 'text',
			'title' => esc_html__( 'Attachment Types', 'tf-real-estate' ),
			'desc'  => esc_html__( 'Allow only comma separated numbers. Ex: pdf,txt,doc,docx', 'tf-real-estate' ),
		),
		array(
			'id'      => 'default_property_image',
			'type'    => 'media',
			'url'     => true,
			'title'   => esc_html__( 'Default Property Image', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Display this image if property no image', 'tf-real-estate' ),
			'default' => array(
				'url' => ''
			),
		),
		array(
			'id'      => 'measurement_units',
			'type'    => 'select',
			'title'   => esc_html__( 'Measurement units', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Choose Measurement units for Property Size, Garage Size, Land Area.', 'tf-real-estate' ),
			'options' => array(
				'SqFt'   => esc_html__( 'Square Feet (SqFt)', 'tf-real-estate' ),
				'm2'     => esc_html__( 'Square Meters (m2)', 'tf-real-estate' ),
				'custom' => esc_html__( 'Custom Unit', 'tf-real-estate' )
			),
			'default' => 'SqFt',
		),
		array(
			'id'       => 'custom_measurement_units',
			'type'     => 'text',
			'title'    => esc_html__( 'Custom Measurement Units ', 'tf-real-estate' ),
			'required' => [ 'measurement_units', '=', 'custom' ]
		),
		array(
			'id'      => 'enable_convert_year',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable Convert Year', 'tf-real-estate' ),
			'default' => 1,
		),
		// Related Properties
		array(
			'id'       => 'begin_related_properties',
			'type'     => 'accordion',
			'title'    => esc_html__( 'Related Properties', 'tf-real-estate' ),
			'position' => 'start',
			'open'     => false
		),
		array(
			'id'      => 'heading_related_properties',
			'type'    => 'text',
			'title'   => esc_html__( 'Heading', 'tf-real-estate' ),
			'default' => esc_html__( 'Featured properties', 'tf-real-estate' )
		),
		array(
			'id'      => 'description_related_properties',
			'type'    => 'text',
			'title'   => esc_html__( 'Description', 'tf-real-estate' ),
			'default' => esc_html__( 'Explore all the different types of properties so you can choose the best option for you.', 'tf-real-estate' )
		),
		array(
			'id'      => 'item_per_page_related_properties',
			'type'    => 'text',
			'title'   => esc_html__( 'Item per page', 'tf-real-estate' ),
			'default' => esc_html__( '6' )
		),
		array(
			'id'      => 'related_by_taxonomy',
			'type'    => 'select',
			'title'   => esc_html__( 'Related by taxonomy', 'tf-real-estate' ),
			'options' => array(
				'property-type'    => esc_html__( 'Property Type', 'tf-real-estate' ),
				'property-status'  => esc_html__( 'Property Status', 'tf-real-estate' ),
				'property-label'   => esc_html__( 'Property Label', 'tf-real-estate' ),
				'property-feature' => esc_html__( 'Property Feature', 'tf-real-estate' ),
				'province-state'   => esc_html__( 'Property State', 'tf-real-estate' ),
				'neighborhood'     => esc_html__( 'Property Neighborhood', 'tf-real-estate' ),
			),
			'default' => 'property-type',
		),
		array(
			'id'      => 'enable_loop_related_properties',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable Loop', 'tf-real-estate' ),
			'default' => 0,
		),
		array(
			'id'      => 'enable_auto_loop_related_properties',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable Auto Loop', 'tf-real-estate' ),
			'default' => 0,
		),
		array(
			'id'      => 'enable_arrow_related_properties',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable Arrow', 'tf-real-estate' ),
			'default' => 0,
		),
		array(
			'id'      => 'enable_bullets_related_properties',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable Bullets', 'tf-real-estate' ),
			'default' => 1,
		),
		array(
			'id'      => 'spacing_related_properties',
			'type'    => 'text',
			'title'   => esc_html__( 'Spacing Item', 'tf-real-estate' ),
			'default' => esc_html__( '30' )
		),
		array(
			'id'      => 'carousel_prev_icon_related_properties',
			'type'    => 'text',
			'title'   => esc_html__( 'Previous Icon', 'tf-real-estate' ),
			'default' => esc_html__( 'far fa-arrow-left' )
		),
		array(
			'id'      => 'carousel_next_icon_related_properties',
			'type'    => 'text',
			'title'   => esc_html__( 'Next Icon', 'tf-real-estate' ),
			'default' => esc_html__( 'far fa-arrow-right' )
		),
		array(
			'id'      => 'carousel_column_desk_related_properties',
			'type'    => 'text',
			'title'   => esc_html__( 'Column Desk', 'tf-real-estate' ),
			'default' => esc_html__( '3' )
		),
		array(
			'id'      => 'carousel_column_laptop_related_properties',
			'type'    => 'text',
			'title'   => esc_html__( 'Column Laptop', 'tf-real-estate' ),
			'default' => esc_html__( '3' )
		),
		array(
			'id'      => 'carousel_column_tablet_related_properties',
			'type'    => 'text',
			'title'   => esc_html__( 'Column Tablet', 'tf-real-estate' ),
			'default' => esc_html__( '2' )
		),
		array(
			'id'      => 'carousel_column_mobile_related_properties',
			'type'    => 'text',
			'title'   => esc_html__( 'Column Mobile', 'tf-real-estate' ),
			'default' => esc_html__( '1' )
		),
		array(
			'id'       => 'end_related_properties',
			'type'     => 'accordion',
			'position' => 'end'
		),
		// Price Format Accordion
		array(
			'id'       => 'begin_price_format',
			'type'     => 'accordion',
			'title'    => esc_html__( 'Price Format', 'tf-real-estate' ),
			'position' => 'start',
			'open'     => false
		),
		array(
			'id'      => 'enable_price_unit',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable Price Unit', 'tf-real-estate' ),
			'default' => 1,
		),
		array(
			'id'      => 'enable_short_price_unit',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable Short Price Unit', 'tf-real-estate' ),
			'default' => 0,
		),
		array(
			'id'    => 'thousand_text',
			'type'  => 'text',
			'title' => esc_html__( 'Thousand Text', 'tf-real-estate' ),
			'desc'  => esc_html__( 'K, k or Thousand', 'tf-real-estate' )
		),
		array(
			'id'    => 'million_text',
			'type'  => 'text',
			'title' => esc_html__( 'Million Text', 'tf-real-estate' ),
			'desc'  => esc_html__( 'M, m or Million', 'tf-real-estate' )
		),
		array(
			'id'    => 'billion_text',
			'type'  => 'text',
			'title' => esc_html__( 'Billion Text', 'tf-real-estate' ),
			'desc'  => esc_html__( 'B, b or Billion', 'tf-real-estate' )
		),
		array(
			'id'    => 'currency_sign',
			'type'  => 'text',
			'title' => esc_html__( 'Currency Sign', 'tf-real-estate' ),
		),
		array(
			'id'      => 'currency_sign_position',
			'type'    => 'select',
			'title'   => esc_html__( 'Currency Sign Position', 'tf-real-estate' ),
			'options' => array(
				'before' => esc_html__( 'Before ($1,000)', 'tf-real-estate' ),
				'after'  => esc_html__( 'After (1,000$)', 'tf-real-estate' ),
			),
			'default' => 'before',
		),
		array(
			'id'    => 'thousand_separator',
			'type'  => 'text',
			'title' => esc_html__( 'Thousand Separator', 'tf-real-estate' ),
			'desc'  => esc_html__( 'This sets the thousand separator of displayed prices.', 'tf-real-estate' )
		),
		array(
			'id'    => 'decimal_separator',
			'type'  => 'text',
			'title' => esc_html__( 'Decimal Separator', 'tf-real-estate' ),
			'desc'  => esc_html__( 'This sets the decimal separator of displayed prices.', 'tf-real-estate' )
		),
		array(
			'id'    => 'number_of_decimal_digits',
			'type'  => 'text',
			'title' => esc_html__( 'Number Of Decimal Digits', 'tf-real-estate' ),
			'desc'  => esc_html__( 'This set number of decimal digits', 'tf-real-estate' )
		),
		array(
			'id'    => 'price_to_call_text',
			'type'  => 'text',
			'title' => esc_html__( 'Price to Call Text', 'tf-real-estate' ),
		),
		array(
			'id'       => 'end_price_format',
			'type'     => 'accordion',
			'position' => 'end'
		),
		// Show Hide Property Form Fields Accordion
		array(
			'id'       => 'begin_show_hide_property_fields',
			'type'     => 'accordion',
			'title'    => esc_html__( 'Show Property Form Fields', 'tf-real-estate' ),
			'position' => 'start',
			'open'     => false
		),
		array(
			'id'       => 'show_hide_property_fields',
			'type'     => 'checkbox',
			'title'    => esc_html__( 'Show Property Form Fields', 'tf-real-estate' ),
			'subtitle' => esc_html__( 'Choose which fields you want to show on Add/Edit Property page?', 'tf-real-estate' ),
			'options'  => array(
				// Information
				'gallery_images'             => esc_html__( 'Gallery Images', 'tf-real-estate' ),
				'property_description'       => esc_html__( 'Property Description', 'tf-real-estate' ),
				'property_full_address'      => esc_html__( 'Property Full Address', 'tf-real-estate' ),
				'property_zip_code'          => esc_html__( 'Property Zip Code', 'tf-real-estate' ),
				'property_country'           => esc_html__( 'Property Country', 'tf-real-estate' ),
				'property_province_state'    => esc_html__( 'Property Province State', 'tf-real-estate' ),
				'property_neighborhood'      => esc_html__( 'Property Neighborhood', 'tf-real-estate' ),
				'map'                        => esc_html__( 'Map', 'tf-real-estate' ),
				// Price
				'property_price_value'       => esc_html__( 'Property Price Value', 'tf-real-estate' ),
				'property_price_unit'        => esc_html__( 'Property Price Unit', 'tf-real-estate' ),
				'property_price_prefix'      => esc_html__( 'Property Price Prefix', 'tf-real-estate' ),
				'property_price_postfix'     => esc_html__( 'Property Price Postfix', 'tf-real-estate' ),
				'property_price_to_call'     => esc_html__( 'Property Price To Call', 'tf-real-estate' ),
				// Additional Information
				'property-type'              => esc_html__( 'Property Type', 'tf-real-estate' ),
				'property-status'            => esc_html__( 'Property Status', 'tf-real-estate' ),
				'property-label'             => esc_html__( 'Property Label', 'tf-real-estate' ),
				'property_size'              => esc_html__( 'Property Size', 'tf-real-estate' ),
				'property_land'              => esc_html__( 'Property Land', 'tf-real-estate' ),
				'property_rooms'             => esc_html__( 'Property Rooms', 'tf-real-estate' ),
				'property_bedrooms'          => esc_html__( 'Property Bedrooms', 'tf-real-estate' ),
				'property_bathrooms'         => esc_html__( 'Property Bathrooms', 'tf-real-estate' ),
				'property_garage'            => esc_html__( 'Property Garage', 'tf-real-estate' ),
				'property_garage_size'       => esc_html__( 'Property Garage Size', 'tf-real-estate' ),
				'property_year'              => esc_html__( 'Property Year', 'tf-real-estate' ),
				'property_identity'          => esc_html__( 'Property Identity', 'tf-real-estate' ),
				// Additional Detail
				'property_additional_detail' => esc_html__( 'Property Additional Detail', 'tf-real-estate' ),
				// Amenities
				'property-feature'           => esc_html__( 'Property Features', 'tf-real-estate' ),
				// Attachments file
				'attachments_file'           => esc_html__( 'Attachments File', 'tf-real-estate' ),
				// Virtual 360
				'virtual_360'                => esc_html__( 'Virtual 360', 'tf-real-estate' ),
				// Video
				'property_video_url'         => esc_html__( 'Property Video', 'tf-real-estate' ),
				// Floor
				'floors_plan'                => esc_html__( 'Floors Plan', 'tf-real-estate' ),
				// Agent
				'agent_info'                 => esc_html__( 'Agent Information', 'tf-real-estate' ),
				// Loan Calculator
				'loan_calculator'            => esc_html( 'Loan Calculator', 'tf-real-estate' ),
				// Nearby Places
				'nearby_places'              => esc_html( 'Nearby Places', 'tf-real-estate' ),
			),
			'default'  => array(
				// Information
				'gallery_images'             => 1,
				'property_description'       => 1,
				'property_full_address'      => 1,
				'property_zip_code'          => 1,
				'property_country'           => 1,
				'property_province_state'    => 1,
				'property_neighborhood'      => 1,
				'map'                        => 1,
				// Price
				'property_price_value'       => 1,
				'property_price_unit'        => 1,
				'property_price_prefix'      => 1,
				'property_price_postfix'     => 1,
				'property_price_to_call'     => 1,
				// Additional Information
				'property-type'              => 1,
				'property-status'            => 1,
				'property-label'             => 1,
				'property_size'              => 1,
				'property_land'              => 1,
				'property_rooms'             => 1,
				'property_bedrooms'          => 1,
				'property_bathrooms'         => 1,
				'property_garage'            => 1,
				'property_garage_size'       => 1,
				'property_year'              => 1,
				'property_identity'          => 1,
				// Additional Detail
				'property_additional_detail' => 1,
				// Amenities
				'property-feature'           => 1,
				// Attachments file
				'attachments_file'           => 1,
				// Virtual 360
				'virtual_360'                => 1,
				// Video
				'property_video_url'         => 1,
				// Floor
				'floors_plan'                => 1,
				// Agent
				'agent_info'                 => 1,
				// Loan Calculator
				'loan_calculator'            => 1,
				// Nearby Places
				'nearby_places'              => 1
			),
		),
		array(
			'id'       => 'end_show_hide_property_fields',
			'type'     => 'accordion',
			'position' => 'end',
		),
		// Required Property Form Fields Accordion
		array(
			'id'       => 'begin_required_property_fields',
			'type'     => 'accordion',
			'title'    => esc_html__( 'Required Property Form Fields', 'tf-real-estate' ),
			'position' => 'start',
			'open'     => false
		),
		array(
			'id'       => 'required_property_fields',
			'type'     => 'checkbox',
			'title'    => esc_html__( 'Required Property Form Fields', 'tf-real-estate' ),
			'subtitle' => esc_html__( 'Choose which fields you want to that fields required', 'tf-real-estate' ),
			'options'  => array(
				// Information
				'property_title'          => esc_html__( 'Property Title', 'tf-real-estate' ),
				'property_full_address'   => esc_html__( 'Property Full Address', 'tf-real-estate' ),
				'property_zip_code'       => esc_html__( 'Property Zip Code', 'tf-real-estate' ),
				'property_country'        => esc_html__( 'Property Country', 'tf-real-estate' ),
				'property_province_state' => esc_html__( 'Property Province State', 'tf-real-estate' ),
				'property_neighborhood'   => esc_html__( 'Property Neighborhood', 'tf-real-estate' ),
				// Price
				'property_price_value'    => esc_html__( 'Property Price Value', 'tf-real-estate' ),
				'property_price_unit'     => esc_html__( 'Property Price Unit', 'tf-real-estate' ),
				'property_price_to_call'  => esc_html__( 'Property Price To Call', 'tf-real-estate' ),
				// Additional Information
				'property-type'           => esc_html__( 'Property Type', 'tf-real-estate' ),
				'property-status'         => esc_html__( 'Property Status', 'tf-real-estate' ),
				'property-label'          => esc_html__( 'Property Label', 'tf-real-estate' ),
				'property_size'           => esc_html__( 'Property Size', 'tf-real-estate' ),
				'property_land'           => esc_html__( 'Property Land', 'tf-real-estate' ),
				'property_rooms'          => esc_html__( 'Property Rooms', 'tf-real-estate' ),
				'property_bedrooms'       => esc_html__( 'Property Bedrooms', 'tf-real-estate' ),
				'property_bathrooms'      => esc_html__( 'Property Bathrooms', 'tf-real-estate' ),
				'property_garage'         => esc_html__( 'Property Garage', 'tf-real-estate' ),
				'property_garage_size'    => esc_html__( 'Property Garage Size', 'tf-real-estate' ),
				'property_year'           => esc_html__( 'Property Year', 'tf-real-estate' ),
				// Amenities
				'property-feature'        => esc_html__( 'Property Features', 'tf-real-estate' ),
			),
			'default'  => array(
				// Information
				'property_title'          => 1,
				'property_full_address'   => 1,
				'property_zip_code'       => 1,
				'property_country'        => 1,
				'property_province_state' => 1,
				'property_neighborhood'   => 1,
				// Price
				'property_price_value'    => 1,
				'property_price_unit'     => 1,
				'property_price_to_call'  => 1,
				// Additional Information
				'property-type'           => 1,
				'property-status'         => 1,
				'property-label'          => 1,
				'property_size'           => 1,
				'property_land'           => 1,
				'property_rooms'          => 1,
				'property_bedrooms'       => 1,
				'property_bathrooms'      => 1,
				'property_garage'         => 1,
				'property_garage_size'    => 1,
				'property_year'           => 1,
				// Amenities
				'property-feature'        => 1,
			),
		),
		array(
			'id'       => 'end_required_property_fields',
			'type'     => 'accordion',
			'position' => 'end',
		),
	)
);
?>