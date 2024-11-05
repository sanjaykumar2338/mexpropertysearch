<?php 

// Action Box Heading color    
$wp_customize->add_setting(
    'action_box_heading_color',
    array(
        'default'           => themesflat_customize_default('action_box_heading_color'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    new themesflat_ColorOverlay(
        $wp_customize,
        'action_box_heading_color',
        array(
            'label'         => esc_html__('Heading Color', 'dreamhome'),
            'section'       => 'color_action_box',
            'settings'      => 'action_box_heading_color',
            'priority'      => 1
        )
    )
); 

// Action Box Text color    
$wp_customize->add_setting(
    'action_box_text_color',
    array(
        'default'           => themesflat_customize_default('action_box_text_color'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    new themesflat_ColorOverlay(
        $wp_customize,
        'action_box_text_color',
        array(
            'label'         => esc_html__('Text Color', 'dreamhome'),
            'section'       => 'color_action_box',
            'settings'      => 'action_box_text_color',
            'priority'      => 2
        )
    )
);

// Action Box Button Text Color 
$wp_customize->add_setting(
    'action_box_button_color',
    array(
        'default'           => themesflat_customize_default('action_box_button_color'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    new themesflat_ColorOverlay(
        $wp_customize,
        'action_box_button_color',
        array(
            'label'         => esc_html__('Button Color', 'dreamhome'),
            'section'       => 'color_action_box',
            'settings'      => 'action_box_button_color',
            'priority'      => 3
        )
    )
);


// Action Box Button Color Hover 
$wp_customize->add_setting(
    'action_box_button_color_hover',
    array(
        'default'           => themesflat_customize_default('action_box_button_color_hover'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    new themesflat_ColorOverlay(
        $wp_customize,
        'action_box_button_color_hover',
        array(
            'label'         => esc_html__('Button Color Hover', 'dreamhome'),
            'section'       => 'color_action_box',
            'settings'      => 'action_box_button_color_hover',
            'priority'      => 4
        )
    )
);

// Action Box Button Background    
$wp_customize->add_setting(
    'action_box_button_background',
    array(
        'default'           => themesflat_customize_default('action_box_button_background'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    new themesflat_ColorOverlay(
        $wp_customize,
        'action_box_button_background',
        array(
            'label'         => esc_html__('Button Background', 'dreamhome'),
            'section'       => 'color_action_box',
            'settings'      => 'action_box_button_background',
            'priority'      => 5
        )
    )
);

// Action Box Button Background Hover 
$wp_customize->add_setting(
    'action_box_button_background_hover',
    array(
        'default'           => themesflat_customize_default('action_box_button_background_hover'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    new themesflat_ColorOverlay(
        $wp_customize,
        'action_box_button_background_hover',
        array(
            'label'         => esc_html__('Button Background Hover', 'dreamhome'),
            'section'       => 'color_action_box',
            'settings'      => 'action_box_button_background_hover',
            'priority'      => 6
        )
    )
);
