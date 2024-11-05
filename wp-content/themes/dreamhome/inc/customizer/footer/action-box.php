<?php 
$wp_customize->add_setting(
    'show_action_box',
    array(
        'default'   => themesflat_customize_default('show_action_box'),
        'sanitize_callback'  => 'themesflat_sanitize_checkbox',
    )
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
        'show_action_box',
        array(
            'type'      => 'checkbox',
            'label'     => esc_html__('Call To Action ( OFF | ON )', 'dreamhome'),
            'section'   => 'section_action_box',
            'priority'  => 1
        )
    )
);

// Heading
$wp_customize->add_setting(
    'action_box_text',
    array(
        'default' => themesflat_customize_default('action_box_text'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'action_box_text',
    array(
        'label' => esc_html__( 'Heading', 'dreamhome' ),
        'section' => 'section_action_box',
        'type' => 'text',
        'priority' => 2
    )
);

// Heading
$wp_customize->add_setting(
    'action_box_desc',
    array(
        'default' => themesflat_customize_default('action_box_desc'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'action_box_desc',
    array(
        'label' => esc_html__( 'Description', 'dreamhome' ),
        'section' => 'section_action_box',
        'type' => 'text',
        'priority' => 3
    )
);

// Button Text
$wp_customize->add_setting(
    'action_box_button_text',
    array(
        'default' => themesflat_customize_default('action_box_button_text'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'action_box_button_text',
    array(
        'label' => esc_html__( 'Button Text', 'dreamhome' ),
        'section' => 'section_action_box',
        'type' => 'text',
        'priority' => 4
    )
);
// Button Url
$wp_customize->add_setting(
    'action_box_button_url',
    array(
        'default' => themesflat_customize_default('action_box_button_url'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'action_box_button_url',
    array(
        'label' => esc_html__( 'Button Url', 'dreamhome' ),
        'section' => 'section_action_box',
        'type' => 'text',
        'priority' => 5
    )
);

// image
$wp_customize->add_setting(
    'action_box_image',
    array(
        'default' => themesflat_customize_default('action_box_image'),
        'sanitize_callback' => 'esc_url_raw',
    )
);    
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'action_box_image',
        array(
           'label'          => esc_html__( 'Upload Your Image ', 'dreamhome' ),
           'description'    => esc_html__( 'If you don\'t display image please remove it your website display 
            Site Title default in General', 'dreamhome' ),
           'type'           => 'image',
           'section'   =>  'section_action_box',
           'priority'       => 6,
        )
    )
);

// background
$wp_customize->add_setting(
    'action_box_features_image',
    array(
        'default' => themesflat_customize_default('action_box_features_image'),
        'sanitize_callback' => 'esc_url_raw',
    )
);    
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'action_box_features_image',
        array(
           'label'          => esc_html__( 'Background ActionBox Section', 'dreamhome' ),
           'description'    => esc_html__( 'If you don\'t display image please remove it your website display 
            Site Title default in General', 'dreamhome' ),
           'type'           => 'image',
           'section'   =>  'section_action_box',
           'priority'       => 7,
        )
    )
);