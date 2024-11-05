<?php 
// ADD SECTION LOGO
$wp_customize->add_section('section_logo',array(
    'title'         => esc_html__( 'Logo','dreamhome' ),
    'priority'      => 1,
    'panel'         => 'header_panel',
));
require THEMESFLAT_DIR . "inc/customizer/header/logo.php";

// ADD SECTION NAVIGATION
$wp_customize->add_section('section_navigation',array(
    'title'         => esc_html__( 'Navigation','dreamhome' ),
    'priority'      => 2,
    'panel'         => 'header_panel',
)); 
require THEMESFLAT_DIR . "inc/customizer/header/navigation.php";

// ADD SECTION HEADER OPTION
$wp_customize->add_section('section_options',array(
    'title'         => esc_html__( 'Header Options','dreamhome' ),
    'priority'      => 3,
    'panel'         => 'header_panel',
)); 
require THEMESFLAT_DIR . "inc/customizer/header/header-options.php";