<?php 
// Customize Blog Featured Title
$wp_customize->add_setting (
    'blog_featured_title',
    array(
        'default' => themesflat_customize_default('blog_featured_title'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'blog_featured_title',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Customize Blog Featured Title', 'dreamhome'),
        'section'   => 'section_content_blog_single',
        'priority'  => 1
    )
);   


//Blog Single Layout
$wp_customize->add_setting(
    'blog_layout_single',
    array(
        'default'           => themesflat_customize_default('blog_layout_single'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'blog_layout_single',
    array (
        'type'      => 'select',           
        'section'   => 'section_content_blog_single',
        'priority'  => 1,
        'label'         => esc_html__('Sidebar Single Position', 'dreamhome'),
        'choices'   => array (
            'sidebar-right'     => esc_html__( 'Sidebar Right','dreamhome' ),
            'sidebar-left'      =>  esc_html__( 'Sidebar Left','dreamhome' ),
            'fullwidth'         =>   esc_html__( 'Full Width','dreamhome' ),
            'fullwidth-small'   =>   esc_html__( 'Full Width Small','dreamhome' ),
            'fullwidth-center'  =>   esc_html__( 'Full Width Center','dreamhome' ),
        ),
    )
);

// Show Post Navigator
$wp_customize->add_setting (
    'show_post_navigator',
    array (
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('show_post_navigator'),     
    )
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_post_navigator',
    array(
        'type'      => 'checkbox',
        'label'     => esc_html__('Post Navigator ( OFF | ON )', 'dreamhome'),
        'section'   => 'section_content_blog_single',
        'priority'  => 2
    ))
);

// Social Share
$wp_customize->add_setting(
    'show_social_share',
      array(
          'sanitize_callback' => 'themesflat_sanitize_checkbox',
          'default' => themesflat_customize_default('show_social_share'),     
      )   
  );
  $wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
      'show_social_share',
      array(
          'type' => 'checkbox',
          'label' => esc_html__('Social Share Blog  ( OFF | ON )', 'dreamhome'),
          'section'   => 'section_content_blog_single',
          'priority' => 3,
      ))
  );

// Enable Entry Footer Content
$wp_customize->add_setting(
  'show_entry_footer_content',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('show_entry_footer_content'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_entry_footer_content',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Entry Footer ( OFF | ON )', 'dreamhome'),
        'section' => 'section_content_blog_single',
        'priority' => 4,
    ))
);
