<?php 
  $wp_customize->add_control( new themesflat_Info( $wp_customize, 'header_logo_label', array(
    'label'    => esc_html__( 'Logo Header', 'dreamhome' ),
    'section'        => 'section_logo',
    'settings' => 'themesflat_options[info]',
    'priority' => 1,
) )
);
//Logo
$wp_customize->add_setting(
    'site_logo',
    array(
        'default' => themesflat_customize_default('site_logo'),
        'sanitize_callback' => 'esc_url_raw',
    )
);    
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'site_logo',
        array(
           'label'          => esc_html__( 'Upload Header Logo ', 'dreamhome' ),
           'description'    => esc_html__( 'If you don\'t display logo please remove it your website display 
            Site Title default in General', 'dreamhome' ),
           'type'           => 'image',
           'section'        => 'section_logo',
           'priority'       => 2,
        )
    )
);

// Logo Size    
$wp_customize->add_setting(
    'logo_width',
    array(
        'default'   =>  themesflat_customize_default('logo_width'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new themesflat_Slide_Control( $wp_customize,
    'logo_width',
        array(
            'type'      =>  'slide-control',
            'section'   =>  'section_logo',
            'label'     =>  esc_html__( 'Logo Size Width(px)', 'dreamhome' ),
            'priority'  => 3,
            'input_attrs' => array(
                'min' => 0,
                'max' => 500,
                'step' => 1,
            ),
        )

    )
);

// Logo Box control
$wp_customize->add_setting(
    'logo_controls',
    array(
        'default' => themesflat_customize_default('logo_controls'),
        'sanitize_callback' => 'themesflat_sanitize_text',
    )
);
$wp_customize->add_control( new themesflat_BoxControls($wp_customize,
    'logo_controls',
    array(
        'label' => esc_html__( 'Box Controls (px)', 'dreamhome' ),
        'section' => 'section_logo',
        'type' => 'box-controls',
        'priority' => 4
    ))
);

$wp_customize->add_control( new themesflat_Info( $wp_customize, 'mobile_logo_label', array(
    'label'    => esc_html__( 'Logo Mobile', 'dreamhome' ),
    'section'        => 'section_logo',
    'settings' => 'themesflat_options[info]',
    'priority' => 5,
) )
);

//Logo
$wp_customize->add_setting(
    'site_logo_mobile',
    array(
        'default' => themesflat_customize_default('site_logo_mobile'),
        'sanitize_callback' => 'esc_url_raw',
    )
);    
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'site_logo_mobile',
        array(
           'label'          => esc_html__( 'Upload Logo On Mobile', 'dreamhome' ),
           'description'    => esc_html__( 'If you don\'t display logo please remove it your website display 
            Site Title default in General', 'dreamhome' ),
           'type'           => 'image',
           'section'        => 'section_logo',
           'priority'       => 6,
        )
    )
);

$wp_customize->add_control( new themesflat_Info( $wp_customize, 'dashboard_logo_label', array(
    'label'    => esc_html__( 'Logo Dashboard', 'dreamhome' ),
    'section'        => 'section_logo',
    'settings' => 'themesflat_options[info]',
    'priority' => 11,
) )
);

//Logo Dashboard
$wp_customize->add_setting(
    'site_logo_dashboard',
    array(
        'default' => themesflat_customize_default('site_logo_dashboard'),
        'sanitize_callback' => 'esc_url_raw',
    )
);    
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'site_logo_dashboard',
        array(
           'label'          => esc_html__( 'Upload Logo Dashboard ', 'dreamhome' ),
           'description'    => esc_html__( 'If you don\'t display logo please remove it your website display 
            Site Title default in General', 'dreamhome' ),
           'type'           => 'image',
           'section' => 'section_logo',
           'priority'       => 12,
        )
    )
);