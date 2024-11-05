<?php 
$wp_customize->add_setting(
    'sidebar_layout',
    array(
        'default'           => themesflat_customize_default('sidebar_layout'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'sidebar_layout',
    array (
        'type'      => 'select',           
        'section'   => 'section_content_blog_archive',
        'priority'  => 1,
        'label'         => esc_html__('Sidebar Position', 'dreamhome'),
        'choices'   => array (
            'sidebar-right'     => esc_html__( 'Sidebar Right','dreamhome' ),
            'sidebar-left'      =>  esc_html__( 'Sidebar Left','dreamhome' ),
            'fullwidth'         =>   esc_html__( 'Full Width','dreamhome' ),
        ),
    )
);

$wp_customize->add_setting (
    'blog_sidebar_list',
    array(
        'default'           => themesflat_customize_default('blog_sidebar_list'),
        'sanitize_callback' => 'esc_html',
    )
);
$wp_customize->add_control( new themesflat_DropdownSidebars($wp_customize,
    'blog_sidebar_list',
    array(
        'type'      => 'dropdown',           
        'section'   => 'section_content_blog_archive',
        'priority'  => 4,
        'label'         => esc_html__('List Sidebar', 'dreamhome'),
        
    ))
);

// Entry Content Elements
$wp_customize->add_setting (
    'post_content_elements',
    array (
        'sanitize_callback' => 'themesflat_sanitize_text',
        'default' => themesflat_customize_default('post_content_elements'),     
    )
);
$wp_customize->add_control( new themesflat_Control_Drag_And_Drop( $wp_customize,
    'post_content_elements',
    array(
        'type'      => 'draganddrop-controls',
        'label'     => esc_html__('Post Content Elements', 'dreamhome'),
        'description' => esc_html__( 'Drag and drop elements to re-order.', 'dreamhome' ),
        'section'   => 'section_content_blog_archive',
        'priority'  => 5,
        'choices' => array(
            'meta'            => esc_html__( 'Meta', 'dreamhome' ),
            'title'           => esc_html__( 'Title', 'dreamhome' ),
            'excerpt_content' => esc_html__( 'Excerpt', 'dreamhome' ),
            'readmore'        => esc_html__( 'Read More', 'dreamhome' ),
        ),        
    ))
); 

// Excerpt
$wp_customize->add_setting(
    'blog_archive_post_excepts_length',
    array(
        'default'   =>  themesflat_customize_default('blog_archive_post_excepts_length'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new themesflat_Slide_Control( $wp_customize,
    'blog_archive_post_excepts_length',
        array(
            'type'      =>  'slide-control',
            'section'   =>  'section_content_blog_archive',
            'label'     =>  esc_html__( 'Post Excepts Length', 'dreamhome' ),
            'priority'  => 6,
            'input_attrs' => array(
                'min' => 0,
                'max' => 500,
                'step' => 1,
            ),
        )

    )
); 

// Read More Text
$wp_customize->add_setting (
    'blog_archive_readmore_text',
    array(
        'default' => themesflat_customize_default('blog_archive_readmore_text'),
        'sanitize_callback' => 'themesflat_sanitize_text'
    )
);
$wp_customize->add_control(
    'blog_archive_readmore_text',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Read More Text', 'dreamhome'),
        'section'   => 'section_content_blog_archive',
        'priority'  => 7
    )
);

// Meta Elements
$wp_customize->add_setting (
    'meta_elements',
    array (
        'sanitize_callback' => 'themesflat_sanitize_text',
        'default' => themesflat_customize_default('meta_elements'),     
    )
);
$wp_customize->add_control( new themesflat_Control_Drag_And_Drop( $wp_customize,
    'meta_elements',
    array(
        'type'      => 'draganddrop-controls',
        'label'     => esc_html__('Meta Elements', 'dreamhome'),
        'description' => esc_html__( 'Drag and drop elements to re-order.', 'dreamhome' ),
        'section'   => 'section_content_blog_archive',
        'priority'  => 8,
        'choices' => array(
            'category'    => esc_html__( 'Category', 'dreamhome' ),
            'author'    => esc_html__( 'Author', 'dreamhome' ),
            'date'      => esc_html__( 'Date', 'dreamhome' ),
            'comment'   => esc_html__( 'Comment', 'dreamhome' ),
        ),        
    ))
); 

// Pagination
$wp_customize->add_setting(
    'blog_archive_pagination_style',
    array(
        'default'           => themesflat_customize_default('blog_archive_pagination_style'),
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    'blog_archive_pagination_style',
    array(
        'type'      => 'select',           
        'section'   => 'section_content_blog_archive',
        'priority'  => 9,
        'label'         => esc_html__('Pagination Style', 'dreamhome'),
        'choices'   => array(
            'numeric'         =>  esc_html__('Numeric','dreamhome'),
            'pager-numeric'         =>  esc_html__('Page & Numeric','dreamhome'),
        ),
    )
);