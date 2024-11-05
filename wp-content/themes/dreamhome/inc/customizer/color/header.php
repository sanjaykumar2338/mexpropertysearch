<?php 
// Menu Background
$wp_customize->add_setting(
    'header_backgroundcolor',
    array(
        'default'           => themesflat_customize_default('header_backgroundcolor'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new themesflat_ColorOverlay(
        $wp_customize,
        'header_backgroundcolor',
        array(
            'label'         => esc_html__('Header Background', 'dreamhome'),
            'description'   => esc_html__(' Opacity =1 for Background Color', 'dreamhome'),
            'section'       => 'color_header',
            'priority'      => 1
        )
    )
);

// Header Background sticky
$wp_customize->add_setting(
    'header_backgroundcolor_sticky',
    array(
        'default'           => themesflat_customize_default('header_backgroundcolor_sticky'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new themesflat_ColorOverlay(
        $wp_customize,
        'header_backgroundcolor_sticky',
        array(
            'label'         => esc_html__('Sticky Header Background', 'dreamhome'),
            'section'       => 'color_header',
            'priority'      => 2
        )
    )
); 

// Menu a color on sticky
$wp_customize->add_setting(
    'mainnav_color_sticky',
    array(
        'default'           => themesflat_customize_default('mainnav_color_sticky'),
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'mainnav_color_sticky',
        array(
            'label' => esc_html__('Menu Color on Sticky', 'dreamhome'),
            'section' => 'color_header',
            'priority' => 3
        )
    )
);

// Menu a color
$wp_customize->add_setting(
    'mainnav_color',
    array(
        'default'           => themesflat_customize_default('mainnav_color'),
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'mainnav_color',
        array(
            'label' => esc_html__('Menu color', 'dreamhome'),
            'section' => 'color_header',
            'priority' => 4
        )
    )
);

// Menu hover color
$wp_customize->add_setting(
    'mainnav_hover_color',
    array(
        'default'           => themesflat_customize_default('mainnav_hover_color'),
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'mainnav_hover_color',
        array(
            'label' => esc_html__('Menu Hover & Active', 'dreamhome'),
            'section' => 'color_header',
            'priority' => 5
        )
    )
);

// Sub menu a color
$wp_customize->add_setting(
    'sub_nav_color',
    array(
        'default'           => themesflat_customize_default('sub_nav_color'),
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'sub_nav_color',
        array(
            'label' => esc_html__('SubMenu color', 'dreamhome'),
            'section' => 'color_header',
            'priority' => 23
        )
    )
);    

// Sub nav background hover
$wp_customize->add_setting(
    'sub_nav_color_hover',
    array(
        'default'   => themesflat_customize_default('sub_nav_color_hover'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'sub_nav_color_hover',
        array(
            'label' => esc_html__('SubMenu Hover & Active', 'dreamhome'),
            'section' => 'color_header',
            'priority' => 24
        )
    )
);

// Sub nav background
$wp_customize->add_setting(
    'sub_nav_background',
    array(
        'default'           => themesflat_customize_default('sub_nav_background'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'sub_nav_background',
        array(
            'label' => esc_html__('SubMenu Background', 'dreamhome'),
            'section' => 'color_header',
            'priority' => 25
        )
    )
);

// Sub nav background hover
$wp_customize->add_setting(
    'sub_nav_background_hover',
    array(
        'default'   => themesflat_customize_default('sub_nav_background_hover'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'sub_nav_background_hover',
        array(
            'label' => esc_html__('SubMenu Background Hover & Active', 'dreamhome'),
            'section' => 'color_header',
            'priority' => 26
        )
    )
);

// Sub nav line color between link
$wp_customize->add_setting(
    'sub_nav_border_color',
    array(
        'default'           => themesflat_customize_default('sub_nav_border_color'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    new themesflat_ColorOverlay(
        $wp_customize,
        'sub_nav_border_color',
        array(
            'label' => esc_html__('SubMenu Border Line', 'dreamhome'),
            'section' => 'color_header',
            'priority' => 27
        )
    )
);
