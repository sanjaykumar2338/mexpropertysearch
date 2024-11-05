<?php 
// ADD SECTION BLOG ARCHIVE
$wp_customize->add_section('section_content_blog_archive',array(
    'title'         => esc_html__( 'Blog Archive','dreamhome' ),
    'priority'      => 1,
    'panel'         => 'content_panel',
));
require THEMESFLAT_DIR . "inc/customizer/content/blog-archive.php";

// ADD SECTION BLOG SINGLE
$wp_customize->add_section('section_content_blog_single',array(
    'title'         => esc_html__( 'Blog Single','dreamhome' ),
    'priority'      => 2,
    'panel'         => 'content_panel',
));
require THEMESFLAT_DIR . "inc/customizer/content/blog-single.php";

// ADD SECTION POST TYPE
$wp_customize->add_section('section_content_post_type',array(
    'title'         => esc_html__( 'Extra Post Type','dreamhome' ),
    'priority'      => 3,
    'panel'         => 'content_panel',
));
require THEMESFLAT_DIR . "inc/customizer/content/post-type.php";
