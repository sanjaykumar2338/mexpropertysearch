<?php 
$wp_customize->add_setting(
    'show_footer_info',
    array(
        'default'   => themesflat_customize_default('show_footer_info'),
        'sanitize_callback'  => 'themesflat_sanitize_checkbox',
    )
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
        'show_footer_info',
        array(
            'type'      => 'checkbox',
            'label'     => esc_html__('Contact Seller, Sell Property ( OFF | ON )', 'dreamhome'),
            'section'   => 'section_info_footer',
            'priority'  => 1
        )
    )
);

$wp_customize->add_control( new themesflat_Info( $wp_customize, 'footer_info_label', array(
    'label'    => esc_html__( 'Contact Seller', 'dreamhome' ),
    'section'   => 'section_info_footer',
    'settings' => 'themesflat_options[info]',
    'priority' => 2,
) )
);

// image
$wp_customize->add_setting(
    'footer_info_image',
    array(
        'default' => themesflat_customize_default('footer_info_image'),
        'sanitize_callback' => 'esc_url_raw',
    )
);    
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'footer_info_image',
        array(
           'label'          => esc_html__( 'Upload Your Image ', 'dreamhome' ),
           'description'    => esc_html__( 'If you don\'t display image please remove it your website display 
            Site Title default in General', 'dreamhome' ),
           'type'           => 'image',
           'section'   => 'section_info_footer',
           'priority'       => 2,
        )
    )
);
// Heading
$wp_customize->add_setting(
    'footer_info_text',
    array(
        'default'   =>  themesflat_customize_default('footer_info_text'),
        'sanitize_callback'  =>  'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'footer_info_text',
    array(
        'type'      =>  'text',
        'label'     =>  esc_html__('Heading', 'dreamhome'),
        'section'   =>  'section_info_footer',
        'priority'  =>  3
    )
);
// Description
$wp_customize->add_setting(
    'footer_info_description',
    array(
        'default'   =>  themesflat_customize_default('footer_info_description'),
        'sanitize_callback'  =>  'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'footer_info_description',
    array(
        'type'      =>  'text',
        'label'     =>  esc_html__('Description', 'dreamhome'),
        'section'   =>  'section_info_footer',
        'priority'  =>  4
    )
);
// Button text
$wp_customize->add_setting(
    'footer_info_button',
    array(
        'default'   =>  themesflat_customize_default('footer_info_button'),
        'sanitize_callback'  =>  'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'footer_info_button',
    array(
        'type'      =>  'text',
        'section'   =>  'section_info_footer',
        'label'     =>  esc_html__('Button Text', 'dreamhome'),
        'priority'  => 5
    )
);
// Button Url
$wp_customize->add_setting(
    'footer_info_button_url',
    array(
        'default' => themesflat_customize_default('footer_info_button_url'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'footer_info_button_url',
    array(
        'label' => esc_html__( 'Button Url', 'dreamhome' ),
        'section' => 'section_info_footer',
        'type' => 'text',
        'priority' => 6
    )
);

$wp_customize->add_control( new themesflat_Info( $wp_customize, 'footer_info_label_2', array(
    'label'    => esc_html__( 'Sell Property', 'dreamhome' ),
    'section'   => 'section_info_footer',
    'settings' => 'themesflat_options[info]',
    'priority' => 7,
) )
);

// image 2
$wp_customize->add_setting(
    'footer_info_image2',
    array(
        'default' => themesflat_customize_default('footer_info_image2'),
        'sanitize_callback' => 'esc_url_raw',
    )
);    
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'footer_info_image2',
        array(
           'label'          => esc_html__( 'Upload Your Image ', 'dreamhome' ),
           'description'    => esc_html__( 'If you don\'t display image please remove it your website display 
            Site Title default in General', 'dreamhome' ),
           'type'           => 'image',
           'section'   => 'section_info_footer',
           'priority'       => 7,
        )
    )
);

$wp_customize->add_setting(
    'footer_info_text2',
    array(
        'default'   =>  themesflat_customize_default('footer_info_text2'),
        'sanitize_callback'  =>  'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'footer_info_text2',
    array(
        'type'      =>  'text',
        'label'     =>  esc_html__('Heading', 'dreamhome'),
        'section'   =>  'section_info_footer',
        'priority'  =>  8
    )
);


$wp_customize->add_setting(
    'footer_info_description2',
    array(
        'default'   =>  themesflat_customize_default('footer_info_description2'),
        'sanitize_callback'  =>  'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'footer_info_description2',
    array(
        'type'      =>  'text',
        'label'     =>  esc_html__('Description', 'dreamhome'),
        'section'   =>  'section_info_footer',
        'priority'  =>  9
    )
);

$wp_customize->add_setting(
    'footer_info_button2',
    array(
        'default'   =>  themesflat_customize_default('footer_info_button2'),
        'sanitize_callback'  =>  'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'footer_info_button2',
    array(
        'type'      =>  'text',
        'section'   =>  'section_info_footer',
        'label'     =>  esc_html__('Button Text', 'dreamhome'),
        'priority'  => 10
    )
);

// Button Url
$wp_customize->add_setting(
    'footer_info_button_url2',
    array(
        'default' => themesflat_customize_default('footer_info_button_url2'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'footer_info_button_url2',
    array(
        'label' => esc_html__( 'Button Url', 'dreamhome' ),
        'section' => 'section_info_footer',
        'type' => 'text',
        'priority' => 11
    )
);
