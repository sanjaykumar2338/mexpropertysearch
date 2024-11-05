<?php
return array(
	'id'     => 'single-property-options',
	'title'  => esc_html__( 'Single Property', 'tf-real-estate' ),
	'icon'   => 'el el-folder-close',
	'fields' => array(
		array(
			'id'     => 'begin_global_custom_section_single_property',
			'type'   => 'section',
			'title'  => esc_html__( 'Global Custom Section', 'tf-real-estate' ),
			'indent' => true,
		),
		array(
			'id'       => 'title_global_custom_section',
			'type'     => 'text',
			'title'    => esc_html__( 'Title Section', 'tf-real-estate' ),
			'default'  => esc_html__( 'Custom Section', 'tf-real-estate' ),
		),
		array(
			'id'       => 'content_global_custom_section',
			'type'     => 'editor',
			'title'    => esc_html__( 'Content', 'tf-real-estate' ),
			'args'     => array(
				'textarea_rows' => 30,
				'wpautop'       => true,
				'media_buttons' => true,
				'quicktags'     => true,
			),
		),
		array(
			'id'     => 'end_global_custom_section_single_property',
			'type'   => 'section',
			'indent' => true,
		),
		array(
			'id'     => 'begin_actions_single_property',
			'type'   => 'section',
			'title'  => esc_html__( 'Property Actions Button', 'tf-real-estate' ),
			'indent' => true,
		),
		array(
            'id'       => 'show_hide_actions_button',
            'type'     => 'checkbox',
            'title'    => esc_html__('Show Actions Button', 'tf-real-estate'),
            'subtitle' => esc_html__('Choose which button you want to show on single page?', 'tf-real-estate'),
            'options'  => array(
                'favorite-actions-button'     => esc_html__('Favorite Button', 'tf-real-estate'),
                'compare-actions-button'     => esc_html__('Compare Button', 'tf-real-estate'),
                'social-actions-button'     => esc_html__('Social Share Button', 'tf-real-estate'),
                'print-actions-button'     => esc_html__('Print Button', 'tf-real-estate'),
            ),
            'default' => array(
                'favorite-actions-button'     => 1,
                'compare-actions-button'     => 1,
                'social-actions-button'     => 1,
                'print-actions-button'     => 1,
            )
        ),
		array(
            'id'       => 'show_hide_list_social_button',
            'type'     => 'checkbox',
            'title'    => esc_html__('Show Item Social Share', 'tf-real-estate'),
            'subtitle' => esc_html__('Choose which button you want to show on list social share', 'tf-real-estate'),
            'options'  => array(
                'social-actions-facebook'     => esc_html__('Facebook', 'tf-real-estate'),
                'social-actions-twitter'     => esc_html__('Twitter', 'tf-real-estate'),
                'social-actions-linkedin'     => esc_html__('Linkedin', 'tf-real-estate'),
                'social-actions-pinterest'     => esc_html__('Pinterest', 'tf-real-estate'),
                'social-actions-skype'     => esc_html__('Skype', 'tf-real-estate'),
                'social-actions-whatsapp'     => esc_html__('Whatsapp', 'tf-real-estate'),
            ),
            'default' => array(
                'social-actions-facebook'     => 1,
                'social-actions-twitter'     => 1,
                'social-actions-linkedin'     => 1,
                'social-actions-pinterest'     => 1,
                'social-actions-skype'     => 1,
                'social-actions-whatsapp'     => 1,
            )
        ),
		array(
			'id'     => 'end_actions_single_property',
			'type'   => 'section',
			'indent' => true,
		),
	)
);