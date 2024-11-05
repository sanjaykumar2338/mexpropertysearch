<?php 

/* property 
=================================================*/  
$wp_customize->add_control( new themesflat_Info( $wp_customize, 'property', array(
    'label' => esc_html__('Property', 'dreamhome'),
    'section' => 'section_content_post_type',
    'settings' => 'themesflat_options[info]',
    'priority' => 1
    ) )
); 

$wp_customize->add_setting(
    'property_layout',
    array(
        'default'           => themesflat_customize_default('property_layout'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'property_layout',
    array (
        'type'      => 'select',           
        'section'   => 'section_content_post_type',
        'priority'  => 2,
        'label'         => esc_html__('Sidebar Position', 'dreamhome'),
        'choices'   => array (
            'tfre-sidebar-right'     => esc_html__( 'Sidebar Right','dreamhome' ),
            'tfre-fullwidth'         =>   esc_html__( 'Full Width','dreamhome' ),
        ),
    )
);

$wp_customize->add_setting(
    'property_style_gallery',
    array(
        'default'           => themesflat_customize_default('property_style_gallery'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'property_style_gallery',
    array (
        'type'      => 'select',           
        'section'   => 'section_content_post_type',
        'priority'  => 3,
        'label'         => esc_html__('Sidebar Position', 'dreamhome'),
        'choices'   => array (
            'gallery-style-grid'     => esc_html__( 'Grid Layout','dreamhome' ),
            'gallery-style-slider'         =>   esc_html__( 'Slider','dreamhome' ),
        ),
    )
);

/* agent 
=================================================*/  
$wp_customize->add_control( new themesflat_Info( $wp_customize, 'agent', array(
    'label' => esc_html__('Agent', 'dreamhome'),
    'section' => 'section_content_post_type',
    'settings' => 'themesflat_options[info]',
    'priority' => 4
    ) )
); 

$wp_customize->add_setting(
    'agent_layout',
    array(
        'default'           => themesflat_customize_default('agent_layout'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'agent_layout',
    array (
        'type'      => 'select',           
        'section'   => 'section_content_post_type',
        'priority'  => 5,
        'label'         => esc_html__('Sidebar Position', 'dreamhome'),
        'choices'   => array (
            'agent-sidebar-right'     => esc_html__( 'Sidebar Right','dreamhome' ),
            'agent-fullwidth'         =>   esc_html__( 'Full Width','dreamhome' ),
        ),
    )
);