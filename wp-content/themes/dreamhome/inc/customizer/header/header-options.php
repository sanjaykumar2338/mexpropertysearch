<?php 

//Header Style
$wp_customize->add_setting(
    'style_header',
    array(
        'default'           => themesflat_customize_default('style_header'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new themesflat_RadioImages($wp_customize,
    'style_header',
    array (
        'type'      => 'radio-images',           
        'section'   => 'section_options',
        'priority'  => 1,
        'label'         => esc_html__('Header Style', 'dreamhome'),
        'choices'   => array (
            'header-default' => array (
                'tooltip'   => esc_html__( 'Header Default','dreamhome' ),
                'src'       => THEMESFLAT_LINK . 'images/controls/header-default.jpg'
            ),
            'header-02' => array (
                'tooltip'   => esc_html__( 'Header 02','dreamhome' ),
                'src'       => THEMESFLAT_LINK . 'images/controls/header-02.jpg'
            ),
            'header-form-search' => array (
                'tooltip'   => esc_html__( 'Header Form Search','dreamhome' ),
                'src'       => THEMESFLAT_LINK . 'images/controls/header-form-search.jpg'
            ),
        ),
    ))
); 

// Enable Header Absolute
$wp_customize->add_setting(
  'header_absolute',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('header_absolute'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'header_absolute',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Header Absolute ( OFF | ON )', 'dreamhome'),
        'section' => 'section_options',
        'priority' => 2,
    ))
);

// Enable Header Sticky
$wp_customize->add_setting(
  'header_sticky',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('header_sticky'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'header_sticky',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Header Sticky ( OFF | ON )', 'dreamhome'),
        'section' => 'section_options',
        'priority' => 3,
    ))
);    

// Show search 
$wp_customize->add_setting(
  'header_search_box',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('header_search_box'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'header_search_box',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Search Box ( OFF | ON )', 'dreamhome'),
        'section' => 'section_options',
        'priority' => 4,
    ))
);

// Show Login
$wp_customize->add_setting(
    'header_login',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('header_login'),     
      )   
  );
  $wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
      'header_login',
      array(
          'type' => 'checkbox',
          'label' => esc_html__('Login ( OFF | ON )', 'dreamhome'),
          'section' => 'section_options',
          'priority' => 4,
      ))
  );

// Show socials 
$wp_customize->add_setting(
    'header_socials',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('header_socials'),     
      )   
  );
  $wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
      'header_socials',
      array(
          'type' => 'checkbox',
          'label' => esc_html__('Socials ( OFF | ON )', 'dreamhome'),
          'section' => 'section_options',
          'priority' => 5,
      ))
  );

// Show infor 
$wp_customize->add_setting(
    'header_infor_phone',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('header_infor_phone'),     
      )   
  );
  $wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
      'header_infor_phone',
      array(
          'type' => 'checkbox',
          'label' => esc_html__('Infor Contact ( OFF | ON )', 'dreamhome'),
          'section' => 'section_options',
          'priority' => 6,
      ))
  );

  $wp_customize->add_control( new themesflat_Info( $wp_customize, 'header_info_label_time', array(
    'label'    => esc_html__( 'Phone', 'dreamhome' ),
    'section'  => 'section_options',
    'settings' => 'themesflat_options[info]',
    'priority' => 8,
    'active_callback' => function () use ( $wp_customize ) {
        return 1 == $wp_customize->get_setting( 'header_infor_phone' )->value();
    },
) )
);

// Infor Icon
$wp_customize->add_setting(
    'header_info_phone_icon',
    array(
        'default' => themesflat_customize_default('header_info_phone_icon'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'header_info_phone_icon',
    array(
        'label' => esc_html__( 'Phone Icon', 'dreamhome' ),
        'section' => 'section_options',
        'type' => 'text',
        'priority' => 9,
        'active_callback' => function () use ( $wp_customize ) {
            return 1 == $wp_customize->get_setting( 'header_infor_phone' )->value();
        }
    )
);

// Phone Label
$wp_customize->add_setting(
    'header_info_phone_text',
    array(
        'default' => themesflat_customize_default('header_info_phone_text'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'header_info_phone_text',
    array(
        'label' => esc_html__( 'Phone Label', 'dreamhome' ),
        'section' => 'section_options',
        'type' => 'text',
        'priority' => 10,
        'active_callback' => function () use ( $wp_customize ) {
            return 1 == $wp_customize->get_setting( 'header_infor_phone' )->value();
        }
    )
);

// Phone Number
$wp_customize->add_setting(
    'header_info_phone_number',
    array(
        'default' => themesflat_customize_default('header_info_phone_number'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'header_info_phone_number',
    array(
        'label' => esc_html__( 'Phone Number', 'dreamhome' ),
        'section' => 'section_options',
        'type' => 'text',
        'priority' => 11,
        'active_callback' => function () use ( $wp_customize ) {
            return 1 == $wp_customize->get_setting( 'header_infor_phone' )->value();
        }
    )
);

$wp_customize->add_control( new themesflat_Info( $wp_customize, 'header_button_label', array(
    'label'    => esc_html__( 'Button', 'dreamhome' ),
    'section'  => 'section_options',
    'settings' => 'themesflat_options[info]',
    'priority' => 12,
    'active_callback' => function () use ( $wp_customize ) {
        return 1 === $wp_customize->get_setting( 'header_button' )->value();
    }, 
) )
);

$wp_customize->add_control( new themesflat_Info( $wp_customize, 'header_info_label_mail', array(
    'label'    => esc_html__( 'Email Address', 'dreamhome' ),
    
    'section'  => 'section_options',
    'settings' => 'themesflat_options[info]',
    'priority' => 13,
    'active_callback' => function () use ( $wp_customize ) {
        return 1 == $wp_customize->get_setting( 'header_infor_phone' )->value();
    },
) )
);

// Infor Icon
$wp_customize->add_setting(
    'header_info_email_icon',
    array(
        'default' => themesflat_customize_default('header_info_email_icon'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'header_info_email_icon',
    array(
        'description'    => esc_html__( 'Email only show on panel menu Mobile device', 'dreamhome' ),
        'label' => esc_html__( 'Icon', 'dreamhome' ),
        'section' => 'section_options',
        'type' => 'text',
        'priority' => 14,
        'active_callback' => function () use ( $wp_customize ) {
            return 1 == $wp_customize->get_setting( 'header_infor_phone' )->value();
        }
    )
);

// Mail Label
$wp_customize->add_setting(
    'header_info_email_label',
    array(
        'default' => themesflat_customize_default('header_info_email_label'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'header_info_email_label',
    array(
        'label' => esc_html__( 'Label', 'dreamhome' ),
        'section' => 'section_options',
        'type' => 'text',
        'priority' => 15,
        'active_callback' => function () use ( $wp_customize ) {
            return 1 == $wp_customize->get_setting( 'header_infor_phone' )->value();
        }
    )
);

// Email Information
$wp_customize->add_setting(
    'header_info_email',
    array(
        'default' => themesflat_customize_default('header_info_email'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'header_info_email',
    array(
        'label' => esc_html__( 'Email Address', 'dreamhome' ),
        'section' => 'section_options',
        'type' => 'text',
        'priority' => 16,
        'active_callback' => function () use ( $wp_customize ) {
            return 1 == $wp_customize->get_setting( 'header_infor_phone' )->value();
        }
    )
);

$wp_customize->add_control( new themesflat_Info( $wp_customize, 'header_button_label', array(
    'label'    => esc_html__( 'Button', 'dreamhome' ),
    'section'  => 'section_options',
    'settings' => 'themesflat_options[info]',
    'priority' => 17,
    'active_callback' => function () use ( $wp_customize ) {
        return 1 === $wp_customize->get_setting( 'header_button' )->value();
    }, 
) )
);

$wp_customize->add_setting(
    'header_button',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('header_button'),     
      )   
  );
  $wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
      'header_button',
      array(
          'type' => 'checkbox',
          'label' => esc_html__('Header Button ( OFF | ON )', 'dreamhome'),
          'section' => 'section_options',
          'priority' => 7,
      ))
  );


// Button Text
$wp_customize->add_setting(
    'header_button_text',
    array(
        'default' => themesflat_customize_default('header_button_text'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'header_button_text',
    array(
        'label' => esc_html__( 'Button Text', 'dreamhome' ),
        'section' => 'section_options',
        'type' => 'text',
        'priority' => 18,
        'active_callback' => function () use ( $wp_customize ) {
            return 1 === $wp_customize->get_setting( 'header_button' )->value();
        }, 
    )
);

//add setting
$wp_customize->add_setting( 'header_button_url', array(
    'default' => '',
));

//add control
$wp_customize->add_control( 'header_button_url', array(
    'label' => 'Select page for button link to',
    'priority' => 19,
    'active_callback' => function () use ( $wp_customize ) {
        return 1 === $wp_customize->get_setting( 'header_button' )->value();
    }, 
    'type'  => 'dropdown-pages',
    'section' => 'section_options',
    'settings' => 'header_button_url'
));
