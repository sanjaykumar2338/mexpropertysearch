<?php 
 // ADD SECTION GENERAL
$wp_customize->add_section('color_general',array(
    'title'         => esc_html__( 'General','dreamhome' ),
    'priority'      => 1,
    'panel'         => 'color_panel',
));
require THEMESFLAT_DIR . "inc/customizer/color/general.php";

// ADD SECTION HEADER
$wp_customize->add_section('color_header',array(
    'title'=> esc_html__( 'Header','dreamhome' ),
    'priority'=> 3,
    'panel'=>'color_panel',
));  
require THEMESFLAT_DIR . "inc/customizer/color/header.php";

// ADD SECTION ACTION BOX
$wp_customize->add_section('color_action_box',array(
    'title'=> esc_html__( 'Call To Action','dreamhome' ),
    'priority'=> 4,
    'panel'=>'color_panel',
));
require THEMESFLAT_DIR . "inc/customizer/color/action-box.php";

// ADD SECTION FOOTER
$wp_customize->add_section('color_footer',array(
    'title'=> esc_html__( 'Footer','dreamhome' ),
    'priority'=> 5,
    'panel'=>'color_panel',
));
require THEMESFLAT_DIR . "inc/customizer/color/footer.php";

// ADD SECTION COLOR BOTTOM
$wp_customize->add_section('color_bottom',array(
    'title'=> esc_html__( 'Bottom','dreamhome' ),
    'priority'=> 6,
    'panel'=>'color_panel',
));
require THEMESFLAT_DIR . "inc/customizer/color/bottom.php";