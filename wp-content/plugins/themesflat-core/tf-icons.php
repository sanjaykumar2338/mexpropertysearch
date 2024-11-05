<?php 
add_filter( 'elementor/icons_manager/additional_tabs', 'themesflat_iconpicker_register' );

function themesflat_iconpicker_register( $icons = array() ) {
	
	$icons['theme_icon'] = array(
		'name'          => 'theme_icon',
		'label'         => esc_html__( 'Theme Icons DreamHome', 'themesflat-core' ),
		'labelIcon'     => 'icon-dreamhome-price-house',
		'prefix'        => '',
		'displayPrefix' => '',
		'url'           => URL_THEMESFLAT_THEME . 'css/icon-dreamhome.css',
		'fetchJson'     => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME . 'assets/css/dreamhome_fonts_default.json',
		'ver'           => '1.0.0',
	);

	return $icons;
}