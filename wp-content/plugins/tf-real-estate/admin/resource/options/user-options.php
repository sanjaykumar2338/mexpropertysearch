<?php
return array(
	'title'  => esc_html__( 'User Options', 'tf-real-estate' ),
	'id'     => 'user-options',
	'desc'   => '',
	'icon'   => 'el el-user',
	'fields' => array(
		array(
			'id'      => 'show_demo_account',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Show Demo Account', 'tf-real-estate' ),
			'options' => array(
				'y' => esc_html__( 'Yes', 'tf-real-estate' ),
				'n' => esc_html__( 'No', 'tf-real-estate' ),
			),
			'default' => 'n',
			'class'   => 'hide-icon-blank',
		),
		array(
			'id'      => 'user_can_become_agent',
			'type'    => 'button_set',
			'title'   => esc_html__( 'User can register become an agent ?', 'tf-real-estate' ),
			'options' => array(
				'y' => esc_html__( 'Yes', 'tf-real-estate' ),
				'n' => esc_html__( 'No', 'tf-real-estate' ),
			),
			'default' => 'y',
			'class'   => 'hide-icon-blank',
		),
		array(
			'id'      => 'auto_approve_agent',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Automatically approved user become an agent ?', 'tf-real-estate' ),
			'options' => array(
				'y' => esc_html__( 'Yes', 'tf-real-estate' ),
				'n' => esc_html__( 'No', 'tf-real-estate' ),
			),
			'default' => 'n',
			'class'   => 'hide-icon-blank',
		),
		array(
			'id'      => 'enable_login_register_popup',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Enable Login & Register Popup', 'tf-real-estate' ),
			'options' => array(
				'y' => esc_html__( 'Yes', 'tf-real-estate' ),
				'n' => esc_html__( 'No', 'tf-real-estate' ),
			),
			'default' => 'n',
			'class'   => 'hide-icon-blank',
		),
		array(
			'id'      => 'default_user_avatar',
			'type'    => 'media',
			'url'     => true,
			'title'   => esc_html__( 'Default User Avatar', 'tf-real-estate' ),
			'default' => array(
				'url' => ''
			),
		),
		// Google Login
		array(
			'id'       => 'begin_google_login',
			'type'     => 'accordion',
			'title'    => esc_html__( 'Google Login', 'tf-real-estate' ),
			'position' => 'start',
			'open'     => false
		),
		array(
			'id'      => 'enable_google_login',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Enable Google Login', 'tf-real-estate' ),
			'options' => array(
				'y' => esc_html__( 'Yes', 'tf-real-estate' ),
				'n' => esc_html__( 'No', 'tf-real-estate' ),
			),
			'default' => 'n',
			'class'   => 'hide-icon-blank',
		),
		array(
			'id'       => 'google_login_dev_api_key',
			'type'     => 'text',
			'title'    => esc_html__( 'API Key', 'tf-real-estate' ),
			'required' => array( 'enable_google_login', '=', 'y' )
		),
		array(
			'id'       => 'google_login_client_id',
			'type'     => 'text',
			'title'    => esc_html__( 'Client ID', 'tf-real-estate' ),
			'required' => array( 'enable_google_login', '=', 'y' )
		),
		array(
			'id'       => 'google_login_client_secret',
			'type'     => 'text',
			'title'    => esc_html__( 'Client Secret', 'tf-real-estate' ),
			'required' => array( 'enable_google_login', '=', 'y' )
		),
		array(
			'id'       => 'end_google_login',
			'type'     => 'accordion',
			'position' => 'end',
		),
		// Show Hide Agent Information Accordion
		array(
			'id'       => 'begin_show_hide_agent_information',
			'type'     => 'accordion',
			'title'    => esc_html__( 'Show Agent Information', 'tf-real-estate' ),
			'position' => 'start',
			'open'     => false
		),
		array(
			'id'       => 'show_hide_agent_information',
			'type'     => 'checkbox',
			'title'    => esc_html__( 'Show Agent Information', 'tf-real-estate' ),
			'subtitle' => esc_html__( 'Choose which information you want to show on Agent page?', 'tf-real-estate' ),
			'options'  => array(
				// Information
				'user_email'   => esc_html__( 'Email', 'tf-real-estate' ),
				'user_phone'   => esc_html__( 'Phone', 'tf-real-estate' ),
				'user_socials' => esc_html__( 'Socials', 'tf-real-estate' ),
			),
			'default'  => array(
				// Information
				'user_email'   => 1,
				'user_phone'   => 1,
				'user_socials' => 1,
			)
		),
		array(
			'id'       => 'end_show_hide_agent_information',
			'type'     => 'accordion',
			'position' => 'end',
		),
		// Show Hide Agency Information Accordion
		array(
			'id'       => 'begin_show_hide_agency_information',
			'type'     => 'accordion',
			'title'    => esc_html__( 'Show Agency Information', 'tf-real-estate' ),
			'position' => 'start',
			'open'     => false
		),
		array(
			'id'       => 'show_hide_agency_information',
			'type'     => 'checkbox',
			'title'    => esc_html__( 'Show Agency Information', 'tf-real-estate' ),
			'subtitle' => esc_html__( 'Choose which information you want to show on Agency page?', 'tf-real-estate' ),
			'options'  => array(
				// Information
				'user_email'   => esc_html__( 'Email', 'tf-real-estate' ),
				'user_hotline' => esc_html__( 'Hotline', 'tf-real-estate' ),
				'user_phone'   => esc_html__( 'Phone', 'tf-real-estate' ),
				'user_fax'     => esc_html__( 'Fax', 'tf-real-estate' ),
				'user_socials' => esc_html__( 'Socials', 'tf-real-estate' ),
			),
			'default'  => array(
				// Information
				'user_email'   => 1,
				'user_hotline' => 1,
				'user_phone'   => 1,
				'user_fax'     => 1,
				'user_socials' => 1,
			)
		),
		array(
			'id'       => 'end_show_hide_agency_information',
			'type'     => 'accordion',
			'position' => 'end',
		),
		// Show Hide Profile Form Fields Accordion
		array(
			'id'       => 'begin_show_hide_profile_fields',
			'type'     => 'accordion',
			'title'    => esc_html__( 'Show Profile Fields', 'tf-real-estate' ),
			'position' => 'start',
			'open'     => false
		),
		array(
			'id'       => 'show_hide_profile_fields',
			'type'     => 'checkbox',
			'title'    => esc_html__( 'Show Profile Form Fields', 'tf-real-estate' ),
			'subtitle' => esc_html__( 'Choose which fields you want to show on Profile page?', 'tf-real-estate' ),
			'options'  => array(
				// Information
				'full_name'           => esc_html__( 'Full Name', 'tf-real-estate' ),
				'user_description'    => esc_html__( 'User Description', 'tf-real-estate' ),
				'user_company'        => esc_html__( 'Company', 'tf-real-estate' ),
				'user_job'            => esc_html__( 'Job', 'tf-real-estate' ),
				'user_email'          => esc_html__( 'Email', 'tf-real-estate' ),
				'user_phone'          => esc_html__( 'Phone', 'tf-real-estate' ),
				'user_location'       => esc_html__( 'Location', 'tf-real-estate' ),
				'user_socials'        => esc_html__( 'Socials', 'tf-real-estate' ),
				// Information For Agent
				'user_position'       => esc_html__( 'Position', 'tf-real-estate' ),
				'user_office_number'  => esc_html__( 'Office Number', 'tf-real-estate' ),
				'user_office_address' => esc_html__( 'Office Address', 'tf-real-estate' ),
				'user_licenses'       => esc_html__( 'Licenses', 'tf-real-estate' ),
				'user_select_agency'  => esc_html__( 'Select Agency (only Agent)', 'tf-real-estate' ),

			),
			'default'  => array(
				// Information
				'full_name'           => 1,
				'user_description'    => 1,
				'user_company'        => 1,
				'user_job'            => 1,
				'user_email'          => 1,
				'user_phone'          => 1,
				'user_location'       => 1,
				'user_socials'        => 1,
				// Information For Agent
				'user_position'       => 1,
				'user_office_number'  => 1,
				'user_office_address' => 1,
				'user_licenses'       => 1,
				'user_select_agency'  => 1,
			)
		),
		array(
			'id'       => 'end_show_hide_profile_fields',
			'type'     => 'accordion',
			'position' => 'end',
		),
		// Require Profile Form Fields Accordion
		array(
			'id'       => 'begin_require_profile_fields',
			'type'     => 'accordion',
			'title'    => esc_html__( 'Require Profile Fields', 'tf-real-estate' ),
			'position' => 'start',
			'open'     => false
		),
		array(
			'id'       => 'require_profile_fields',
			'type'     => 'checkbox',
			'title'    => esc_html__( 'Require Profile Form Fields', 'tf-real-estate' ),
			'subtitle' => esc_html__( 'Choose which fields you want to require on Profile page?', 'tf-real-estate' ),
			'options'  => array(
				// Information
				'full_name'           => esc_html__( 'Full Name', 'tf-real-estate' ),
				'user_description'    => esc_html__( 'User Description', 'tf-real-estate' ),
				'user_company'        => esc_html__( 'Company', 'tf-real-estate' ),
				'user_job'            => esc_html__( 'Job', 'tf-real-estate' ),
				'user_email'          => esc_html__( 'Email', 'tf-real-estate' ),
				'user_phone'          => esc_html__( 'Phone', 'tf-real-estate' ),
				'user_location'       => esc_html__( 'Location', 'tf-real-estate' ),
				'user_socials'        => esc_html__( 'Socials', 'tf-real-estate' ),
				// Information For Agent
				'user_position'       => esc_html__( 'Position', 'tf-real-estate' ),
				'user_office_number'  => esc_html__( 'Office Number', 'tf-real-estate' ),
				'user_office_address' => esc_html__( 'Office Address', 'tf-real-estate' ),
				'user_licenses'       => esc_html__( 'Licenses', 'tf-real-estate' ),

			),
			'default'  => array(
				// Information
				'full_name'           => 1,
				'user_description'    => 1,
				'user_company'        => 1,
				'user_job'            => 1,
				'user_email'          => 1,
				'user_phone'          => 1,
				'user_location'       => 1,
				'user_socials'        => 1,
				// Information For Agent
				'user_position'       => 1,
				'user_office_number'  => 1,
				'user_office_address' => 1,
				'user_licenses'       => 1,
			)
		),
		array(
			'id'       => 'end_require_profile_fields',
			'type'     => 'accordion',
			'position' => 'end',
		),
	)
);
?>