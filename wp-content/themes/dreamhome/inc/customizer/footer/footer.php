<?php 

$wp_customize->add_setting ( 
    'show_footer',
    array (
        'sanitize_callback' => 'themesflat_sanitize_checkbox' ,
        'default' => themesflat_customize_default('show_footer'),     
    )
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_footer',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__('Show Footer ( OFF | ON )', 'dreamhome'),
        'section'   => 'section_footer',
        'priority'  => 1
    ))
);

$wp_customize->add_setting ( 
    'tab_footer',
    array (
        'sanitize_callback' => 'themesflat_sanitize_checkbox' ,
        'default' => themesflat_customize_default('tab_footer'),     
    )
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'tab_footer',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__('Collapse Widget Footer on Mobile ( OFF | ON )', 'dreamhome'),
        'description'    => esc_html__( 'This function is only working on Mobile devices!', 'dreamhome' ),
        'section'   => 'section_footer',
        'priority'  => 2
    ))
);

// Footer Box control
$wp_customize->add_setting(
    'footer_controls',
    array(
        'default' => themesflat_customize_default('footer_controls'),
        'sanitize_callback' => 'themesflat_sanitize_text',
    )
);
$wp_customize->add_control( new themesflat_BoxControls($wp_customize,
    'footer_controls',
    array(
        'label' => esc_html__( 'Footer Box Controls (px)', 'dreamhome' ),
        'section' => 'section_footer',
        'type' => 'box-controls',
        'priority' => 3
    ))
);