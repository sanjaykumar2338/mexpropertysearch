<?php 
// ADD SECTION ACTION BOX
$wp_customize->add_section('section_action_box',array(
    'title'         => esc_html__( 'Call To Action (CTA)','dreamhome' ),
    'priority'      => 1,
    'panel'         => 'footer_panel',
));
require THEMESFLAT_DIR . "inc/customizer/footer/action-box.php";

// ADD SECTION INFOR
$wp_customize->add_section('section_info_footer',array(
    'title'         => esc_html__( 'Contact Seller, Sell Property','dreamhome' ),
    'priority'      => 2,
    'panel'         => 'footer_panel',
));
require THEMESFLAT_DIR . "inc/customizer/footer/info.php";

// ADD SECTION FOOTER
$wp_customize->add_section('section_footer',array(
    'title'         => esc_html__( 'Footer','dreamhome' ),
    'priority'      => 3,
    'panel'         => 'footer_panel',
));
require THEMESFLAT_DIR . "inc/customizer/footer/footer.php";

// ADD SECTION NAVIGATION
$wp_customize->add_section('section_navigation_footer',array(
    'title'         => esc_html__( 'Logo, Menu, Social Footer','dreamhome' ),
    'priority'      => 4,
    'panel'         => 'footer_panel',
));
require THEMESFLAT_DIR . "inc/customizer/footer/navigation-ft.php";

// ADD SECTION BOTTOM
$wp_customize->add_section('section_bottom',array(
    'title'         => esc_html__( 'Bottom','dreamhome' ),
    'priority'      => 5,
    'panel'         => 'footer_panel',
)); 
require THEMESFLAT_DIR . "inc/customizer/footer/bottom.php";

