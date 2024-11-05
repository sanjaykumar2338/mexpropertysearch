<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Admin_Meta_Boxes' ) ) {
	class Admin_Meta_Boxes {
		public function tfre_get_list_config_meta_boxes( $post_type ) {
			$options = array();

			switch ( $post_type ) {
				case 'property':
					$measurement_units = tfre_get_option_measurement_units();
					$list_agent = array();
					$get_post_types_agent = get_posts(
						array(
							'post_type'   => 'agent',
							'post_status' => 'publish',
							'numberposts' => -1,
						)
					);
					foreach ( $get_post_types_agent as $key => $value ) {
						$list_agent[ $value->ID ] = $value->post_title;
					}
					$enable_price_unit = tfre_get_option( 'enable_price_unit', true );
					// Basic Information
					$options['basic_information'] = array(
						'type'    => 'heading',
						'section' => 'basic-information',
						'title'   => esc_html__( 'Basic Information', 'tf-real-estate' ),
					);
					$options['property_price_value'] = array(
						'type'        => 'text',
						'title'       => esc_html__( 'Price', 'tf-real-estate' ),
						'section'     => 'basic-information',
						'placeholder' => $this->tfre_customize_placeholder_options( 'price_value' ),
					);
					if ( $enable_price_unit == true ) {
						$options['property_price_unit'] = array(
							'type'    => 'radio',
							'title'   => esc_html__( 'Price Unit', 'tf-real-estate' ),
							'section' => 'basic-information',
							'default' => '1',
							'choices' => array(
								'1'          => array(
									'label'    => esc_html__( 'None', 'tf-real-estate' ),
									'children' => array(),
								),
								'1000'       => array(
									'label'    => esc_html__( 'Thousand', 'tf-real-estate' ),
									'children' => array(),
								),
								'1000000'    => array(
									'label'    => esc_html__( 'Million', 'tf-real-estate' ),
									'children' => array(),
								),
								'1000000000' => array(
									'label'    => esc_html__( 'Billion', 'tf-real-estate' ),
									'children' => array(),
								),
							),
						);
					}

					$options['property_price_prefix'] = array(
						'type'        => 'text',
						'title'       => esc_html__( 'Before Price Label', 'tf-real-estate' ),
						'section'     => 'basic-information',
						'placeholder' => $this->tfre_customize_placeholder_options( 'property_price_prefix' ),
					);
					$options['property_price_postfix'] = array(
						'type'        => 'text',
						'title'       => esc_html__( 'After Price Label', 'tf-real-estate' ),
						'section'     => 'basic-information',
						'placeholder' => $this->tfre_customize_placeholder_options( 'property_price_postfix' ),
					);
					$options['property_price_to_call'] = array(
						'type'     => 'toggle',
						'title'    => esc_html__( 'Call to price?', 'tf-real-estate' ),
						'section'  => 'basic-information',
						'children' => array( 'property_price_value', 'property_price_unit', 'property_price_prefix', 'property_price_postfix' ),
						'default'  => false,
						'classes'  => 'toggle-reverse'
					);
					$options['property_size'] = array(
						'type'        => 'number',
						'title'       => sprintf( __( 'Size (%s)', 'tf-real-estate' ), $measurement_units ),
						'section'     => 'basic-information',
						'placeholder' => $this->tfre_customize_placeholder_options( 'property_size' ),
					);
					$options['property_land'] = array(
						'type'        => 'number',
						'title'       => sprintf( __( 'Land Area (%s)', 'tf-real-estate' ), $measurement_units ),
						'section'     => 'basic-information',
						'placeholder' => $this->tfre_customize_placeholder_options( 'property_land' ),
					);
					$options['property_rooms'] = array(
						'type'        => 'number',
						'title'       => esc_html__( 'Rooms', 'tf-real-estate' ),
						'section'     => 'basic-information',
						'placeholder' => $this->tfre_customize_placeholder_options( 'property_rooms' ),
					);
					$options['property_bedrooms'] = array(
						'type'        => 'number',
						'title'       => esc_html__( 'Bedrooms', 'tf-real-estate' ),
						'section'     => 'basic-information',
						'placeholder' => $this->tfre_customize_placeholder_options( 'property_bedrooms' ),
					);
					$options['property_bathrooms'] = array(
						'type'        => 'number',
						'title'       => esc_html__( 'Bathrooms', 'tf-real-estate' ),
						'section'     => 'basic-information',
						'placeholder' => $this->tfre_customize_placeholder_options( 'property_bathrooms' ),
					);
					$options['property_garage'] = array(
						'type'        => 'number',
						'title'       => esc_html__( 'Garages', 'tf-real-estate' ),
						'section'     => 'basic-information',
						'placeholder' => $this->tfre_customize_placeholder_options( 'property_garage' ),
					);
					$options['property_garage_size'] = array(
						'type'        => 'number',
						'title'       => sprintf( __( 'Garages Size (%s)', 'tf-real-estate' ), $measurement_units ),
						'section'     => 'basic-information',
						'placeholder' => $this->tfre_customize_placeholder_options( 'property_garage_size' ),
					);
					$options['property_year'] = array(
						'type'        => 'number',
						'title'       => esc_html__( 'Year Built', 'tf-real-estate' ),
						'section'     => 'basic-information',
						'placeholder' => $this->tfre_customize_placeholder_options( 'property_year' ),
					);
					$options['property_identity'] = array(
						'type'        => 'unselect',
						'title'       => esc_html__( 'Property ID', 'tf-real-estate' ),
						'section'     => 'basic-information',
						'placeholder' => $this->tfre_customize_placeholder_options( 'property_identity' ),
					);
					$options['property_featured'] = array(
						'type'    => 'toggle',
						'title'   => esc_html__( 'Mark this property as featured ?', 'tf-real-estate' ),
						'section' => 'basic-information',
						'default' => false
					);
					$options['property_additional_detail'] = array(
						'type'                      => 'panel-dynamic',
						'title'                     => esc_html__( 'Additional detail', 'tf-real-estate' ),
						'section'                   => 'basic-information',
						'children-dynamic-controls' => array(
							'additional_detail_title' => array(
								'type'        => 'text',
								'title'       => esc_html__( 'Title', 'tf-real-estate' ),
								'section'     => 'property_additional_detail',
								'placeholder' => '',
							),
							'additional_detail_value' => array(
								'type'        => 'text',
								'title'       => esc_html__( 'Value', 'tf-real-estate' ),
								'section'     => 'property_additional_detail',
								'placeholder' => '',
							),
						)
					);
					// Additional Custom Fields
					$configs = tfre_get_additional_fields();
					foreach ( $configs as $key => $config ) {
						$options[ $key ] = $config;
					}
					// Location Map
					$options['location_map_heading'] = array(
						'type'    => 'heading',
						'section' => 'location-map',
						'title'   => esc_html__( 'Location Map', 'tf-real-estate' ),
					);
					$options['property_address'] = array(
						'type'    => 'text',
						'title'   => esc_html__( 'Full Address', 'tf-real-estate' ),
						'section' => 'location-map',
					);
					$options['property_zip'] = array(
						'type'    => 'text',
						'title'   => esc_html__( 'Zip Code', 'tf-real-estate' ),
						'section' => 'location-map',
					);
					$options['property_location'] = array(
						'type'        => 'map',
						'title'       => esc_html__( 'Property Location at Google Map', 'tf-real-estate' ),
						'section'     => 'location-map',
						'placeholder' => esc_html__( 'map location', 'tf-real-estate' ),
					);
					// Floors Plan
					$options['floors_plan_heading'] = array(
						'type'    => 'heading',
						'section' => 'floors-plan',
						'title'   => esc_html__( 'Floors Plan', 'tf-real-estate' ),
					);
					$options['floors_plan_toggle'] = array(
						'type'     => 'toggle',
						'title'    => esc_html__( 'Enable Floors', 'tf-real-estate' ),
						'section'  => 'floors-plan',
						'children' => array(
							'floors_plan',
						),
						'default'  => false
					);
					$options['floors_plan'] = array(
						'type'                      => 'panel-dynamic',
						'section'                   => 'floors-plan',
						'title'                     => esc_html__( 'Floor', 'tf-real-estate' ),
						'children-dynamic-controls' => array(
							'floor_name'          => array(
								'type'        => 'text',
								'title'       => esc_html__( 'Floor Name', 'tf-real-estate' ),
								'section'     => 'floors_plan',
								'placeholder' => esc_html__( 'Floor Name', 'tf-real-estate' ),
							),
							'floor_price'         => array(
								'type'        => 'number',
								'title'       => esc_html__( 'Floor Price', 'tf-real-estate' ),
								'section'     => 'floors_plan',
								'placeholder' => esc_html__( 'Floor Price', 'tf-real-estate' ),
							),
							'floor_price_postfix' => array(
								'type'        => 'text',
								'title'       => esc_html__( 'Price Postfix', 'tf-real-estate' ),
								'section'     => 'floors_plan',
								'placeholder' => esc_html__( 'Price Postfix', 'tf-real-estate' ),
							),
							'floor_size'          => array(
								'type'        => 'number',
								'title'       => esc_html__( 'Floor Size', 'tf-real-estate' ),
								'section'     => 'floors_plan',
								'placeholder' => esc_html__( 'Floor Size', 'tf-real-estate' ),
							),
							'floor_size_postfix'  => array(
								'type'        => 'text',
								'title'       => esc_html__( 'Size Postfix', 'tf-real-estate' ),
								'section'     => 'floors_plan',
								'placeholder' => esc_html__( 'Size Postfix', 'tf-real-estate' ),
							),
							'floor_bedrooms'      => array(
								'type'        => 'number',
								'title'       => esc_html__( 'Floor Bedrooms', 'tf-real-estate' ),
								'section'     => 'floors_plan',
								'placeholder' => esc_html__( 'Floor Bedrooms', 'tf-real-estate' ),
							),
							'floor_bathrooms'     => array(
								'type'        => 'number',
								'title'       => esc_html__( 'Floor Bathrooms', 'tf-real-estate' ),
								'section'     => 'floors_plan',
								'placeholder' => esc_html__( 'Floor Bathrooms', 'tf-real-estate' ),
							),
							'floor_description'   => array(
								'type'    => 'textarea',
								'title'   => esc_html__( 'Description', 'tf-real-estate' ),
								'section' => 'floors_plan',
							),
							'floor_image'         => array(
								'type'    => 'single-image-control',
								'section' => 'floors_plan',
								'default' => $this->tfre_customize_placeholder_options( 'no_image' ),
								'title'   => esc_html__( 'Floor Image', 'tf-real-estate' ),
							)
						)
					);
					// Gallery image
					$options['gallery_image_heading'] = array(
						'type'    => 'heading',
						'section' => 'gallery-image',
						'title'   => esc_html__( 'Gallery Image', 'tf-real-estate' ),
					);

					$options['gallery_image_type'] = array(
						'type'    => 'radio',
						'title'   => esc_html__( 'Gallery Image Type', 'tf-real-estate' ),
						'section' => 'gallery-image',
						'default' => 'none',
						'choices' => array(
							'none'                   => array(
								'label' => esc_html__( 'None', 'tf-real-estate' ),
							),
							'gallery-style-grid'     => array(
								'label' => esc_html__( 'Grid', 'tf-real-estate' ),
							),
							'gallery-style-slider'   => array(
								'label' => esc_html__( 'Slider (Style 1)', 'tf-real-estate' ),
							),
							'gallery-style-slider-2' => array(
								'label' => esc_html__( 'Slider (Style 2)', 'tf-real-estate' ),
							),
							'gallery-style-slider-2' => array(
								'label' => esc_html__( 'Slider (Style 2)', 'tf-real-estate' ),
							),
							'single-style-2'         => array(
								'label' => esc_html__( 'Single Fullwidth & Show Property Navigation', 'tf-real-estate' ),
							),
						),
					);

					$options['gallery_images'] = array(
						'type'    => 'image-control',
						'section' => 'gallery-image',
						'title'   => esc_html__( 'Images List', 'tf-real-estate' ),
						'default' => ''
					);
					// Attachments File
					$options['attachments_file_heading'] = array(
						'type'    => 'heading',
						'section' => 'attachments-file',
						'title'   => esc_html__( 'Attachments File', 'tf-real-estate' ),
					);

					$options['attachments_file'] = array(
						'type'    => 'attachments-control',
						'section' => 'attachments-file',
						'title'   => esc_html__( 'Attachments List', 'tf-real-estate' ),
						'default' => ''
					);
					// Property video
					$options['property_video_heading'] = array(
						'type'    => 'heading',
						'section' => 'property-video',
						'title'   => esc_html__( 'Property Video', 'tf-real-estate' ),
					);

					$options['video_url'] = array(
						'type'        => 'text',
						'title'       => esc_html__( 'Video URL', 'tf-real-estate' ),
						'section'     => 'property-video',
						'placeholder' => esc_html__( 'Input only URL. YouTube, Vimeo', 'tf-real-estate' ),
					);

					// Virtual Tour
					$options['virtual_tour_heading'] = array(
						'type'    => 'heading',
						'section' => 'virtual-tour',
						'title'   => esc_html__( 'Virtual Tour', 'tf-real-estate' ),
					);
					$options['virtual_tour_type'] = array(
						'type'    => 'radio',
						'title'   => esc_html__( 'Virtual Tour Type', 'tf-real-estate' ),
						'section' => 'virtual-tour',
						'default' => '0',
						'choices' => array(
							'0' => array(
								'label'    => esc_html__( 'Embedded code', 'tf-real-estate' ),
								'children' => array( 'virtual_tour_embedded_code' ),
							),
							'1' => array(
								'label'    => esc_html__( 'Upload image', 'tf-real-estate' ),
								'children' => array( 'virtual_tour_upload_image' ),
							),
						),
					);

					$options['virtual_tour_embedded_code'] = array(
						'type'    => 'textarea',
						'title'   => esc_html__( 'Embedded code virtual tour', 'tf-real-estate' ),
						'section' => 'virtual-tour',
					);

					$options['virtual_tour_upload_image'] = array(
						'type'    => 'single-image-control',
						'title'   => esc_html__( 'Upload image virtual', 'tf-real-estate' ),
						'section' => 'virtual-tour',
					);
					// Agent
					$create_agent_link = admin_url( sprintf( 'post-new.php%s', '?post_type=agent' ) );
					$edit_agent_link = admin_url( sprintf( 'post.php?action=edit&post=post_id' ) );

					$options['agent_heading'] = array(
						'type'    => 'heading',
						'section' => 'agent',
						'title'   => esc_html__( 'Agent', 'tf-real-estate' ),
					);

					$options['agent_information_options'] = array(
						'type'    => 'radio',
						'title'   => esc_html__( 'Choose one option to display agent information:', 'tf-real-estate' ),
						'section' => 'agent',
						'default' => 'agent_info',
						'choices' => array(
							'agent_info' => array(
								'label'    => esc_html__( 'Agent Information', 'tf-real-estate' ),
								'children' => array( 'property_agent_info', 'property_add_new_agent', 'property_edit_agent' ),
							),
							'other_info' => array(
								'label'    => esc_html__( 'Other', 'tf-real-estate' ),
								'children' => array( 'property_other_agent_name', 'property_other_agent_email', 'property_other_agent_phone', 'property_other_agent_description' ),
							),
							'hide_info'  => array(
								'label'    => esc_html__( 'Hide', 'tf-real-estate' ),
								'children' => array( '' ),
							),
						),
					);

					$options['property_agent_info'] = array(
						'type'    => 'select',
						'section' => 'agent',
						'title'   => esc_html__( 'Agent Information', 'tf-real-estate' ),
						'choices' => $list_agent,
					);

					$options['property_edit_agent'] = array(
						'type'    => 'button',
						'section' => 'agent',
						'title'   => esc_html__( 'Edit', 'tf-real-estate' ),
						'href'    => $edit_agent_link,
						'classes' => array( 'edit-agent-button' ),
					);

					$options['property_add_new_agent'] = array(
						'type'    => 'button',
						'section' => 'agent',
						'title'   => esc_html__( 'Add New', 'tf-real-estate' ),
						'href'    => $create_agent_link,
					);

					$options['property_other_agent_name'] = array(
						'type'        => 'text',
						'title'       => esc_html__( 'Other Agent Name', 'tf-real-estate' ),
						'section'     => 'agent',
						'placeholder' => esc_html__( 'Other Agent Name', 'tf-real-estate' ),
					);

					$options['property_other_agent_email'] = array(
						'type'        => 'text',
						'title'       => esc_html__( 'Other Agent Email', 'tf-real-estate' ),
						'section'     => 'agent',
						'placeholder' => esc_html__( 'Other Agent Email', 'tf-real-estate' ),
					);

					$options['property_other_agent_phone'] = array(
						'type'        => 'text',
						'title'       => esc_html__( 'Other Agent Phone', 'tf-real-estate' ),
						'section'     => 'agent',
						'placeholder' => esc_html__( 'Other Agent Phone', 'tf-real-estate' ),
					);

					$options['property_other_agent_description'] = array(
						'type'    => 'textarea',
						'title'   => esc_html__( 'Other Agent Description', 'tf-real-estate' ),
						'section' => 'agent',
					);
					// Custom Section
					$options['toggle_custom_section'] = array(
						'type'     => 'toggle',
						'title'    => esc_html__( 'Enable', 'tf-real-estate' ),
						'section'  => 'custom-section',
						'children' => array(
							'title_custom_section', 'content_custom_section'
						),
						'default'  => false
					);
					$options['title_custom_section'] = array(
						'type'        => 'text',
						'title'       => esc_html__( 'Title', 'tf-real-estate' ),
						'section'     => 'custom-section',
						'placeholder' => 'Title Custom Section'
					);

					$options['content_custom_section'] = array(
						'type'    => 'editor',
						'title'   => esc_html__( 'Custom Section', 'tf-real-estate' ),
						'section' => 'custom-section',
					);
					break;
				case 'agent':
					// Basic Information
					$options['basic_info_heading'] = array(
						'type'    => 'heading',
						'section' => 'basic-information',
						'title'   => esc_html__( 'Basic Information', 'tf-real-estate' )
					);

					$options['agent_email'] = array(
						'type'        => 'text',
						'title'       => esc_html__( 'Email', 'tf-real-estate' ),
						'section'     => 'basic-information',
						'placeholder' => esc_html__( 'Email', 'tf-real-estate' ),
					);

					$options['agent_phone_number'] = array(
						'type'        => 'number',
						'title'       => esc_html__( 'Phone Number', 'tf-real-estate' ),
						'section'     => 'basic-information',
						'placeholder' => esc_html__( 'Phone Number', 'tf-real-estate' ),
					);

					$options['agent_fax_number'] = array(
						'type'        => 'text',
						'title'       => esc_html__( 'Fax Number', 'tf-real-estate' ),
						'section'     => 'basic-information',
						'placeholder' => esc_html__( 'Fax Number', 'tf-real-estate' ),
					);

					$options['agent_company_name'] = array(
						'type'        => 'text',
						'title'       => esc_html__( 'Company Name', 'tf-real-estate' ),
						'section'     => 'basic-information',
						'placeholder' => esc_html__( 'Company Name', 'tf-real-estate' ),
					);

					$options['agent_office_number'] = array(
						'type'        => 'number',
						'title'       => esc_html__( 'Office Number', 'tf-real-estate' ),
						'section'     => 'basic-information',
						'placeholder' => esc_html__( 'Office Number', 'tf-real-estate' ),
					);

					$options['agent_office_address'] = array(
						'type'        => 'text',
						'title'       => esc_html__( 'Office Address', 'tf-real-estate' ),
						'section'     => 'basic-information',
						'placeholder' => esc_html__( 'Office Address', 'tf-real-estate' ),
					);

					$options['agent_position'] = array(
						'type'        => 'text',
						'title'       => esc_html__( 'Position', 'tf-real-estate' ),
						'section'     => 'basic-information',
						'placeholder' => esc_html__( 'Position', 'tf-real-estate' ),
					);

					$options['agent_des_info'] = array(
						'type'    => 'textarea',
						'title'   => esc_html__( 'Description', 'tf-real-estate' ),
						'section' => 'basic-information',
					);

					// Social Profiles

					$options['social_heading'] = array(
						'type'    => 'heading',
						'title'   => esc_html__( 'Social Profiles', 'tf-real-estate' ),
						'section' => 'social-profiles',
					);

					$options['agent_website'] = array(
						'type'        => 'text',
						'title'       => esc_html__( 'Website', 'tf-real-estate' ),
						'section'     => 'social-profiles',
						'placeholder' => esc_html__( 'Website', 'tf-real-estate' ),
					);

					$options['agent_facebook'] = array(
						'type'        => 'text',
						'title'       => esc_html__( 'Facebook', 'tf-real-estate' ),
						'section'     => 'social-profiles',
						'placeholder' => esc_html__( 'Facebook', 'tf-real-estate' ),
					);

					$options['agent_twitter'] = array(
						'type'        => 'text',
						'title'       => esc_html__( 'Twitter', 'tf-real-estate' ),
						'section'     => 'social-profiles',
						'placeholder' => esc_html__( 'Twitter', 'tf-real-estate' ),
					);

					$options['agent_instagram'] = array(
						'type'        => 'text',
						'title'       => esc_html__( 'Instagram', 'tf-real-estate' ),
						'section'     => 'social-profiles',
						'placeholder' => esc_html__( 'Instagram', 'tf-real-estate' ),
					);

					$options['agent_pinterest'] = array(
						'type'        => 'text',
						'title'       => esc_html__( 'Pinterest', 'tf-real-estate' ),
						'section'     => 'social-profiles',
						'placeholder' => esc_html__( 'Pinterest', 'tf-real-estate' ),
					);

					$options['agent_linkedin'] = array(
						'type'        => 'text',
						'title'       => esc_html__( 'LinkedIn', 'tf-real-estate' ),
						'section'     => 'social-profiles',
						'placeholder' => esc_html__( 'LinkedIn', 'tf-real-estate' ),
					);

					$options['agent_vimeo'] = array(
						'type'        => 'text',
						'title'       => esc_html__( 'Vimeo', 'tf-real-estate' ),
						'section'     => 'social-profiles',
						'placeholder' => esc_html__( 'Vimeo', 'tf-real-estate' ),
					);

					$options['agent_youtube'] = array(
						'type'        => 'text',
						'title'       => esc_html__( 'Youtube', 'tf-real-estate' ),
						'section'     => 'social-profiles',
						'placeholder' => esc_html__( 'Youtube', 'tf-real-estate' ),
					);

					$options['agent_tiktok'] = array(
						'type'        => 'text',
						'title'       => esc_html__( 'Tiktok', 'tf-real-estate' ),
						'section'     => 'social-profiles',
						'placeholder' => esc_html__( 'Tiktok', 'tf-real-estate' ),
					);
					break;
				case 'package':

					$options['package_free'] = array(
						'type'      => 'toggle',
						'title'     => esc_html__( 'Is Free Package ?', 'tf-real-estate' ),
						'section'   => 'package-detail',
						'default'   => 0,
						'children'  => array( 'package_price' ),
						'row_index' => 0
					);

					$options['package_price'] = array(
						'type'      => 'number',
						'title'     => esc_html__( 'Package Price', 'tf-real-estate' ),
						'section'   => 'package-detail',
						'row_index' => 0
					);

					$options['package_unlimited_listing'] = array(
						'type'      => 'toggle',
						'title'     => esc_html__( 'Is Unlimited Listing ?', 'tf-real-estate' ),
						'section'   => 'package-detail',
						'default'   => 0,
						'children'  => array( 'package_number_listing' ),
						'row_index' => 1
					);

					$options['package_number_listing'] = array(
						'type'      => 'number',
						'title'     => esc_html__( 'Number Listing', 'tf-real-estate' ),
						'section'   => 'package-detail',
						'row_index' => 1
					);

					$options['package_unlimited_time'] = array(
						'type'      => 'toggle',
						'title'     => esc_html__( 'Is Unlimited Time ?', 'tf-real-estate' ),
						'section'   => 'package-detail',
						'default'   => 0,
						'children'  => array( 'package_time_unit', 'package_number_time_unit' ),
						'row_index' => 2
					);

					$options['package_time_unit'] = array(
						'type'      => 'radio',
						'title'     => esc_html__( 'Time Unit', 'tf-real-estate' ),
						'section'   => 'package-detail',
						'default'   => 'month',
						'choices'   => array(
							'day'   => array(
								'label' => esc_html__( 'Day', 'tf-real-estate' ),
							),
							'week'  => array(
								'label' => esc_html__( 'Week', 'tf-real-estate' ),
							),
							'month' => array(
								'label' => esc_html__( 'Month', 'tf-real-estate' ),
							),
							'year'  => array(
								'label' => esc_html__( 'Year', 'tf-real-estate' ),
							),
						),
						'row_index' => 2
					);

					$options['package_number_time_unit'] = array(
						'type'      => 'number',
						'title'     => esc_html__( 'Number Of Time Unit', 'tf-real-estate' ),
						'section'   => 'package-detail',
						'row_index' => 2
					);

					$options['package_popular'] = array(
						'type'      => 'toggle',
						'title'     => esc_html__( 'Is Popular Package ?', 'tf-real-estate' ),
						'section'   => 'package-detail',
						'default'   => 0,
						'row_index' => 3
					);

					$options['package_visible'] = array(
						'type'      => 'toggle',
						'title'     => esc_html__( 'Hidden', 'tf-real-estate' ),
						'section'   => 'package-detail',
						'default'   => 0,
						'row_index' => 3
					);

					$options['package_order_display'] = array(
						'type'      => 'number',
						'title'     => esc_html__( 'Order Display', 'tf-real-estate' ),
						'section'   => 'package-detail',
						'row_index' => 3
					);

				default:
					break;
			}
			return $options;
		}

		public function tfre_register_meta_boxes() {
			$property_information_sections = array(
				'basic-information' => array( 'title' => esc_html__( 'Basic Information', 'tf-real-estate' ) ),
				'location-map'      => array( 'title' => esc_html__( 'Location Map', 'tf-real-estate' ) ),
				'floors-plan'       => array( 'title' => esc_html__( 'Floors plan', 'tf-real-estate' ) ),
				'gallery-image'     => array( 'title' => esc_html__( 'Gallery Image', 'tf-real-estate' ) ),
				'attachments-file'  => array( 'title' => esc_html__( 'Attachments File', 'tf-real-estate' ) ),
				'property-video'    => array( 'title' => esc_html__( 'Property Video', 'tf-real-estate' ) ),
				'virtual-tour'      => array( 'title' => esc_html__( 'Virtual Tour', 'tf-real-estate' ) ),
				'agent'             => array( 'title' => esc_html__( 'Agent', 'tf-real-estate' ) ),
				'custom-section'    => array( 'title' => esc_html__( 'Custom Section', 'tf-real-estate' ) )
			);
			$get_additional_fields         = tfre_get_additional_fields();
			new Meta_Boxes(
				array(
					'id'         => 'property-information',
					'label'      => esc_html__( 'Property Information ', 'tf-real-estate' ),
					'post_types' => 'real-estate',
					'context'    => 'normal',
					'priority'   => 'high',
					'sections'   => count( $get_additional_fields ) > 0 ? array_merge( array_slice( $property_information_sections, 0, 1 ), array( 'additional-custom-fields' => array( 'title' => esc_html( 'Additional Custom Fields', 'tf-real-estate' ) ) ), array_slice( $property_information_sections, 1 ) ) : $property_information_sections,
					'options'    => $this->tfre_get_list_config_meta_boxes( 'property' )
				)
			);

			new Meta_Boxes(
				array(
					'id'         => 'agent-information',
					'label'      => esc_html__( 'Agent Information ', 'tf-real-estate' ),
					'post_types' => 'agent',
					'context'    => 'normal',
					'priority'   => 'high',
					'sections'   => array(
						'basic-information' => array( 'title' => esc_html__( 'Basic Information', 'tf-real-estate' ) ),
						'social-profiles'   => array( 'title' => esc_html__( 'Social Profiles', 'tf-real-estate' ) ),
					),
					'options'    => $this->tfre_get_list_config_meta_boxes( 'agent' )
				)
			);

			new Meta_Boxes(
				array(
					'id'         => 'property-country',
					'label'      => esc_html__( 'Property Country', 'tf-real-estate' ),
					'callback'   => 'tfre_render_property_country',
					'post_types' => 'real-estate',
					'context'    => 'side',
					'priority'   => 'default',
					'sections'   => array(),
					'options'    => array(),
				)
			);

			new Meta_Boxes(
				array(
					'id'         => 'package-detail',
					'label'      => esc_html__( 'Package', 'tf-real-estate' ),
					'post_types' => 'package',
					'context'    => 'normal',
					'priority'   => 'high',
					'sections'   => array(
						'package-detail' => array( 'title' => esc_html__( 'Package Detail', 'tf-real-estate' ) ),
					),
					'options'    => $this->tfre_get_list_config_meta_boxes( 'package' )
				)
			);

			new Meta_Boxes(
				array(
					'id'         => 'invoice-detail',
					'label'      => esc_html__( 'Invoice Detail', 'tf-real-estate' ),
					'post_types' => 'invoice',
					'callback'   => 'tfre_render_invoice_meta_boxes',
					'context'    => 'normal',
					'priority'   => 'high',
					'sections'   => array(),
					'options'    => array(),
				)
			);

			new Meta_Boxes(
				array(
					'id'         => 'user-package-detail',
					'label'      => esc_html__( 'User Package Detail', 'tf-real-estate' ),
					'post_types' => 'user-package',
					'callback'   => 'tfre_render_user_package_meta_boxes',
					'context'    => 'normal',
					'priority'   => 'high',
					'sections'   => array(),
					'options'    => array(),
				)
			);

			new Meta_Boxes(
				array(
					'id'         => 'transaction-log-detail',
					'label'      => esc_html__( 'Transaction Log Detail', 'tf-real-estate' ),
					'post_types' => 'transaction-log',
					'callback'   => 'tfre_render_transaction_log_meta_boxes',
					'context'    => 'normal',
					'priority'   => 'high',
					'sections'   => array(),
					'options'    => array(),
				)
			);
		}

		function tfre_customize_placeholder_options( $key ) {
			$no_image_src = is_array( tfre_get_option( 'default_property_image', '' ) ) && tfre_get_option( 'default_property_image', '' )['url'] != '' ? tfre_get_option( 'default_property_image', '' )['url'] : TF_PLUGIN_URL . 'includes/elementor-widget/assets/images/no-image.jpg';
			$default      = array(
				'price_value'            => sprintf( esc_html__( 'Example Value: 12345%s05', 'tf-real-estate' ), ',' ),
				'property_price_prefix'  => esc_html__( 'Example Value: Start From', 'tf-real-estate' ),
				'property_price_postfix' => esc_html__( 'Example Value: Per Month', 'tf-real-estate' ),
				'property_size'          => esc_html__( 'Example Value: 200', 'tf-real-estate' ),
				'property_land'          => esc_html__( 'Example Value: 2000', 'tf-real-estate' ),
				'property_rooms'         => esc_html__( 'Example Value: 6', 'tf-real-estate' ),
				'property_bedrooms'      => esc_html__( 'Example Value: 4', 'tf-real-estate' ),
				'property_bathrooms'     => esc_html__( 'Example Value: 2', 'tf-real-estate' ),
				'property_garage'        => esc_html__( 'Example Value: 1', 'tf-real-estate' ),
				'property_garage_size'   => esc_html__( 'Example Value: 25', 'tf-real-estate' ),
				'property_year'          => esc_html__( 'Example Value: 5', 'tf-real-estate' ),
				'property_identity'      => esc_html__( 'Property ID (default=postId)' ),
				'no_image'               => $no_image_src,
			);
			return $default[ $key ];
		}
	}
}