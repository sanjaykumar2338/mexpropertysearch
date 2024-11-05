<?php 
// ADD SECTION BODY
$wp_customize->add_section('section_typo_body',array(
    'title'         => esc_html__( 'Body','dreamhome' ),
    'priority'      => 1,
    'panel'         => 'typography_panel',
));
require THEMESFLAT_DIR . "inc/customizer/typography/body.php";

// ADD SECTION NAVIGATION
$wp_customize->add_section('section_typo_navigation',array(
    'title'         => esc_html__( 'Navigation','dreamhome' ),
    'priority'      => 3,
    'panel'         => 'typography_panel',
));
require THEMESFLAT_DIR . "inc/customizer/typography/navigation.php";

// ADD SECTION PAGE TITLE
$wp_customize->add_section('section_typo_page_title',array(
    'title'         => esc_html__( 'Page Title','dreamhome' ),
    'priority'      => 4,
    'panel'         => 'typography_panel',
));
require THEMESFLAT_DIR . "inc/customizer/typography/page-title.php";

// ADD SECTION BLOG POST
$wp_customize->add_section('panel_typo_blog_post',array(
    'title'         => esc_html__( 'Blog Post','dreamhome' ),
    'priority'      => 5,
    'panel'         => 'typography_panel',
)); 
require THEMESFLAT_DIR . "inc/customizer/typography/blog-post.php";

// ADD SECTION SIDEBAR WIDGET TITLE
$wp_customize->add_section('section_typo_sidebar_widget_title',array(
    'title'         => esc_html__( 'Sidebar Widget Title','dreamhome' ),
    'priority'      => 6,
    'panel'         => 'typography_panel',
)); 
require THEMESFLAT_DIR . "inc/customizer/typography/sidebar-widget-title.php";

// ADD SECTION FOOTER WIDGET TITLE
$wp_customize->add_section('section_typo_footer_widget_title',array(
    'title'         => esc_html__( 'Footer Widget Title','dreamhome' ),
    'priority'      => 7,
    'panel'         => 'typography_panel',
)); 
require THEMESFLAT_DIR . "inc/customizer/typography/footer-widget-title.php";

// ADD SECTION FOOTER WIDGET TITLE
$wp_customize->add_section('section_typo_footer',array(
    'title'         => esc_html__( 'Footer','dreamhome' ),
    'priority'      => 8,
    'panel'         => 'typography_panel',
)); 
require THEMESFLAT_DIR . "inc/customizer/typography/footer.php";

// ADD SECTION BOTTOM
$wp_customize->add_section('section_typo_bottom',array(
    'title'         => esc_html__( 'Bottom','dreamhome' ),
    'priority'      => 9,
    'panel'         => 'typography_panel',
)); 
require THEMESFLAT_DIR . "inc/customizer/typography/bottom.php";

// ADD SECTION BOTTOM
$wp_customize->add_section('section_typo_heading',array(
    'title'         => esc_html__( 'Heading H1 - H6','dreamhome' ),
    'priority'      => 10,
    'panel'         => 'typography_panel',
)); 
require THEMESFLAT_DIR . "inc/customizer/typography/heading.php";

// ADD SECTION BUTTONS
$wp_customize->add_section('section_typo_buttons',array(
    'title'         => esc_html__( 'Buttons','dreamhome' ),
    'priority'      => 11,
    'panel'         => 'typography_panel',
)); 
require THEMESFLAT_DIR . "inc/customizer/typography/button.php";

// ADD SECTION BUTTONS
$wp_customize->add_section('section_typo_pagination',array(
    'title'         => esc_html__( 'Pagination','dreamhome' ),
    'priority'      => 12,
    'panel'         => 'typography_panel',
)); 
require THEMESFLAT_DIR . "inc/customizer/typography/pagination.php";