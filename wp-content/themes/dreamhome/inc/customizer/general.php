<?php 

// Enable Smooth Scroll
$wp_customize->add_setting(
  'enable_smooth_scroll',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('enable_smooth_scroll'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'enable_smooth_scroll',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Smooth Scroll ( OFF | ON )', 'dreamhome'),
        'section' => 'general_panel',
        'priority' => 2,
    ))
);

// Enable Preload
$wp_customize->add_setting(
  'enable_preload',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('enable_preload'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'enable_preload',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Preload ( OFF | ON )', 'dreamhome'),
        'section' => 'general_panel',
        'priority' => 4,
    ))
);

//Socials
$wp_customize->add_setting(
    'social_links',
    array(
      'sanitize_callback' => 'esc_attr',
      'default' => themesflat_customize_default('social_links'),     
    )   
  );
  $wp_customize->add_control( new themesflat_SocialIcons($wp_customize,
      'social_links',
      array(
          'type' => 'social-icons',
          'label' => esc_html__('Social Media', 'dreamhome'),
          'section' => 'general_panel',
          'priority' => 6,
      ))
  );

// Go To Button
$wp_customize->add_setting(
  'go_top',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('go_top'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'go_top',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Go To Button ( OFF | ON )', 'dreamhome'),
        'section' => 'general_panel',
        'priority' => 8,
    ))
);

//Image Login Form
$wp_customize->add_setting(
    'feature_form_login',
    array(
        'default' => themesflat_customize_default('feature_form_login'),
        'sanitize_callback' => 'esc_url_raw',
    )
);    
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'feature_form_login',
        array(
           'label'          => esc_html__( 'Upload Background Login Form', 'dreamhome' ),
           'type'           => 'image',
           'section' => 'general_panel',
           'priority'       => 10,
        )
    )
);

//Page Title Background
$wp_customize->add_setting(
    'feature_form_register',
    array(
        'default' => themesflat_customize_default('feature_form_register'),
        'sanitize_callback' => 'esc_url_raw',
    )
);    
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'feature_form_register',
        array(
           'label'          => esc_html__( 'Upload Background Register Form', 'dreamhome' ),
           'type'           => 'image',
           'section' => 'general_panel',
           'priority'       => 11,
        )
    )
);
