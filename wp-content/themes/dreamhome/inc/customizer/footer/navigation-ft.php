<?php 
$wp_customize->add_setting(
    'show_footer_navigation',
    array(
        'default'   => themesflat_customize_default('show_footer_navigation'),
        'sanitize_callback'  => 'themesflat_sanitize_checkbox',
    )
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
        'show_footer_navigation',
        array(
            'type'      => 'checkbox',
            'label'     => esc_html__('Navigation Footer ( OFF | ON )', 'dreamhome'),
            'section'   => 'section_navigation_footer',
            'priority'  => 1
        )
    )
);

//Logo
$wp_customize->add_setting(
    'site_logo_ft',
    array(
        'default' => themesflat_customize_default('site_logo_ft'),
        'sanitize_callback' => 'esc_url_raw',
    )
);    
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'site_logo_ft',
        array(
           'label'          => esc_html__( 'Upload Logo Footer', 'dreamhome' ),
           'description'    => esc_html__( 'If you don\'t display logo please remove it your website display 
            Site Title default in General', 'dreamhome' ),
           'type'           => 'image',
           'section'   => 'section_navigation_footer',
           'priority'       => 2,
           'active_callback' => function () use ( $wp_customize ) {
            return 1 == $wp_customize->get_setting( 'show_footer_navigation' )->value();
        },
        )
    )
);

// Logo Size    
$wp_customize->add_setting(
    'logo_width_ft',
    array(
        'default'   =>  themesflat_customize_default('logo_width_ft'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new themesflat_Slide_Control( $wp_customize,
    'logo_width_ft',
        array(
            'type'      =>  'slide-control',
            'section'   => 'section_navigation_footer',
            'label'     =>  esc_html__( 'Logo Size Width(px)', 'dreamhome' ),
            'priority'  => 3,
            'input_attrs' => array(
                'min' => 0,
                'max' => 500,
                'step' => 1,
            ),
            'active_callback' => function () use ( $wp_customize ) {
                return 1 == $wp_customize->get_setting( 'show_footer_navigation' )->value();
            },
        )

    )
);

$wp_customize->add_setting(
    'show_footer_navigation_menu',
    array(
        'default'   => themesflat_customize_default('show_footer_navigation_menu'),
        'sanitize_callback'  => 'themesflat_sanitize_checkbox',
    )
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
        'show_footer_navigation_menu',
        array(
            'type'      => 'checkbox',
            'label'     => esc_html__('Show Menu ( OFF | ON )', 'dreamhome'),
            'section'   => 'section_navigation_footer',
            'priority'  => 4,
            'active_callback' => function () use ( $wp_customize ) {
                return 1 == $wp_customize->get_setting( 'show_footer_navigation' )->value();
            },
        )
    )
);

$wp_customize->add_setting(
    'show_footer_navigation_social',
    array(
        'default'   => themesflat_customize_default('show_footer_navigation_social'),
        'sanitize_callback'  => 'themesflat_sanitize_checkbox',
    )
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
        'show_footer_navigation_social',
        array(
            'type'      => 'checkbox',
            'label'     => esc_html__('Show Social ( OFF | ON )', 'dreamhome'),
            'section'   => 'section_navigation_footer',
            'priority'  => 5,
            'active_callback' => function () use ( $wp_customize ) {
                return 1 == $wp_customize->get_setting( 'show_footer_navigation' )->value();
            },
        )
    )
);


