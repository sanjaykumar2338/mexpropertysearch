<?php 
// Bottom Copyright Fonts
$wp_customize->add_setting('themesflat_options[info]', array(
        'type'              => 'info_control',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',            
    )
);
$wp_customize->add_control( new themesflat_Info( $wp_customize, 'typography-bottom-copyright', array(
    'label' => esc_html__('Copyright', 'dreamhome'),
    'section' => 'section_typo_bottom',
    'settings' => 'themesflat_options[info]',
    'priority' => 1
    ) )
);

$wp_customize->add_setting(
    'typography_bottom_copyright',
    array(
        'default' => themesflat_customize_default('typography_bottom_copyright'),
        'sanitize_callback' => 'esc_html',
    )
);
$wp_customize->add_control( new themesflat_Typography($wp_customize,
    'typography_bottom_copyright',
    array(
        'label' => esc_html__( 'Font name/style/sets', 'dreamhome' ),
        'section' => 'section_typo_bottom',
        'type' => 'typography',
        'fields' => array('family','style','line_height','size'),
        'priority' => 2
    ))
);

// Bottom text color
$wp_customize->add_setting(
    'bottom_text_color',
    array(
        'default'           => themesflat_customize_default('bottom_text_color'),
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new  themesflat_ColorOverlay(
        $wp_customize,
        'bottom_text_color',
        array(
            'label'         => esc_html__('Color', 'dreamhome'),
            'section'       => 'section_typo_bottom',
            'settings'      => 'bottom_text_color',
            'priority'      => 3
        )
    )
);