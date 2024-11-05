<?php
/*
Plugin Name: TF Real Estate
Description: Manage custom post type real estate
Author: Themesflat
Version: 1.0.5
Text Domain: tf-real-estate
Domain Path: /languages
*/


if ( ! defined( 'WPINC' ) ) {
	die;
}

// Global PATH

if ( ! defined( 'TF_THEME_PATH' ) ) {
	define( 'TF_THEME_PATH', dirname( __FILE__ ) . '/public/templates' );
}

if ( ! defined( 'TF_PLUGIN_PROTOCOL' ) ) {
	define( 'TF_PLUGIN_PROTOCOL', ( is_ssl() ) ? 'https' : 'http' );
}

if ( ! defined( 'TF_PLUGIN_PATH' ) ) {
	$plugin_dir = plugin_dir_path( __FILE__ );

	define( 'TF_PLUGIN_PATH', $plugin_dir );
}

if ( ! defined( 'TF_PLUGIN_URL' ) ) {
	$plugin_url = plugins_url( '/', __FILE__ );

	define( 'TF_PLUGIN_URL', $plugin_url );
}

if ( ! defined( 'TF_AJAX_URL' ) ) {
	$ajax_url = admin_url( 'admin-ajax.php' );

	define( 'TF_AJAX_URL', $ajax_url );
}

// Init helper functions

require_once( TF_PLUGIN_PATH . 'includes/helper.php' );

// Init Loader hooks

require_once( TF_PLUGIN_PATH . 'includes/class-loader.php' );

$loader = new Loader();

// Translate plugin
$loader->tfre_add_action( 'init', @$loader, 'i18n' );

// Widget Sidebar

require_once( TF_PLUGIN_PATH . '/includes/class-widgets.php' );

$widgets = new Register_Widgets();

$loader->tfre_add_action( 'widgets_init', $widgets, 'register_widgets' );

// Register Sidebar
function tfre_register_sidebar() {
	register_sidebar( array(
		'name'          => __( 'Sidebar Archive Properties', 'tf-real-estate' ),
		'id'            => 'archive-properties-sidebar',
		'description'   => __( 'Sidebar widgets in this archive properties page.', 'tf-real-estate' ),
		'before_widget' => '<ul class="tfre-sidebar"><li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li></ul>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar Archive Agent', 'tf-real-estate' ),
		'id'            => 'archive-agent-sidebar',
		'description'   => __( 'Sidebar widgets in this archive agent page.', 'tf-real-estate' ),
		'before_widget' => '<ul class="tfre-sidebar"><li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li></ul>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar Agency List', 'tf-real-estate' ),
		'id'            => 'agency-list-sidebar',
		'description'   => __( 'Sidebar widgets in this agency list page.', 'tf-real-estate' ),
		'before_widget' => '<ul class="tfre-sidebar"><li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li></ul>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}

// Activation plugin 
add_action( 'after_setup_theme', 'tfre_image_size_setup' );

function tfre_image_size_setup() {
	add_image_size( 'themesflat-property-thumbnail', 425, 338, true ); // (cropped)
	add_image_size( 'themesflat-property-thumbnail-vertical', 338, 428, true ); // (cropped)
	add_image_size( 'themesflat-property-thumbnail-style3', 495, 495, true);
}

function tfre_activation() {
	require_once( TF_PLUGIN_PATH . '/includes/class-activation.php' );
	Activation::activate();
	add_action( 'widgets_init', 'tfre_register_sidebar' );
}

register_activation_hook( __FILE__, 'tfre_activation' );

add_action( 'after_setup_theme', 'tfre_activation', 5 );

// Deactivation plugin 
function tfre_deactivation() {
	require_once( TF_PLUGIN_PATH . '/includes/class-deactivation.php' );
	Deactivation::deactivate();
}

register_deactivation_hook( __FILE__, 'tfre_deactivation' );

// Init Cron Job 

require_once( TF_PLUGIN_PATH . 'includes/class-cron-job.php' );

$cron_job = new Cron_Job();

$loader->tfre_add_filter( 'cron_schedules', $cron_job, 'custom_cron_schedules' );

$loader->tfre_add_action( 'init', $cron_job, 'activate_cron_job' );

// Template Loader

require_once( TF_PLUGIN_PATH . 'includes/class-template-loader.php' );

$template_loader = new Template_Loader();

$loader->tfre_add_filter( 'template_include', $template_loader, 'template_loader' );

// Admin enqueue common styles and scripts

function tfre_add_admin_styles() {
	if ( tfre_get_option( "map_service" ) == 'map-box' ) {
		wp_enqueue_style( 'mapbox-gl', 'https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css', array(), '2.15.0' );
		wp_enqueue_style( 'mapbox-gl-geocoder', 'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css', array(), '5.0.0' );
	}

	wp_enqueue_style( 'ui-tabs', TF_PLUGIN_URL . 'admin/assets/css/jquery-ui.min.css' );
	wp_enqueue_style( 'main', TF_PLUGIN_URL . 'admin/assets/css/main.css' );
	wp_enqueue_style( 'wp-color-picker' );
}

add_action( 'admin_enqueue_scripts', 'tfre_add_admin_styles' );

function tfre_add_admin_script() {
	global $typenow;

	if ( ! did_action( 'wp_enqueue_media' ) ) {
		wp_enqueue_media();
	}

	wp_enqueue_script( 'controls', TF_PLUGIN_URL . '/admin/assets/js/controls.js', array( 'jquery' ), null, false );
	wp_enqueue_script( 'awscript', TF_PLUGIN_URL . '/admin/assets/js/awscript.js', array( 'jquery' ), null, false );
	wp_enqueue_script( 'admin-main', TF_PLUGIN_URL . '/admin/assets/js/main.js', array( 'wp-color-picker', 'jquery-ui-tabs' ), false, true );

	$tfre_main_vars = array(
		'ajax_url'           => TF_AJAX_URL,
		'confirm_reset_text' => __( 'Are you sure?', 'tf-real-estate' ),
		'post_type_now'      => $typenow,
	);

	wp_localize_script( 'admin-main', 'tfre_main_vars', $tfre_main_vars );


	if ( tfre_get_option( "map_service" ) == 'google-map' ) {
		// google map
		$api_key        = tfre_get_option( 'google_map_api_key', 'AIzaSyBtUFP8EwyrVM8aOMNahK3619QG5ikA83A' );
		$google_map_url = 'https://maps.googleapis.com/maps/api/js?key=' . $api_key;
		wp_enqueue_script( 'google_map', esc_url_raw( $google_map_url ), array(), false, true );
		wp_enqueue_script( 'field_map', TF_PLUGIN_URL . '/admin/assets/js/google-map.js', array(), false, true );
	}

	if ( tfre_get_option( "map_service" ) == 'map-box' ) {
		// mapbox
		wp_enqueue_script( 'mapbox-gl', 'https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js', array(), '2.15.0', true );
		wp_enqueue_script( 'mapbox-gl-geocoder', 'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js', array(), '5.0.0', true );
		wp_enqueue_script( 'map-box-script', TF_PLUGIN_URL . '/admin/assets/js/map-box.js', array( 'jquery' ), false, true );

		$map_box_variables = array(
			'plugin_url'           => TF_PLUGIN_URL,

			'ajax_url'             => TF_AJAX_URL,

			'map_service'          => tfre_get_option( 'map_service' ),

			'api_key_google_map'   => tfre_get_option( 'google_map_api_key' ),

			'api_key_map_box'      => tfre_get_option( 'map_box_api_key' ),

			'map_box_style'        => tfre_get_option( 'map_box_style' ),

			'map_zoom'             => tfre_get_option( 'map_zoom' ),

			'default_marker_image' => tfre_get_option( 'default_marker_image' )['url'] != '' ? tfre_get_option( 'default_marker_image' )['url'] : '',

			'marker_image_width'   => tfre_get_option( 'marker_image_width' ) != '' ? tfre_get_option( 'marker_image_width' ) : '90px',

			'marker_image_height'  => tfre_get_option( 'marker_image_height' ) != '' ? tfre_get_option( 'marker_image_height' ) : '119px',

		);

		wp_localize_script( 'map-box-script', 'map_box_variables', $map_box_variables );
	}
}

add_action( 'admin_enqueue_scripts', 'tfre_add_admin_script' );


// Enqueue common public styles and scripts

function tfre_add_public_styles() {

	if ( ! is_front_page() ) {

		if ( tfre_get_option( "map_service" ) == 'map-box' ) {
			wp_enqueue_style( 'mapbox-gl', 'https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css', array(), '2.15.0' );

			wp_enqueue_style( 'mapbox-gl-geocoder', 'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css', array(), '5.0.0' );
		}

		wp_enqueue_style( 'map-styles', TF_PLUGIN_URL . 'public/assets/css/map.css' );
	}

	wp_enqueue_style( 'jquery-ui', TF_PLUGIN_URL . 'public/assets/third-party/jquery-ui/jquery-ui.min.css', array(), '1.11.4', 'all' );

	wp_enqueue_style( 'fonts-awesome-min', TF_PLUGIN_URL . 'public/assets/third-party/fonts-awesome/css/font-awesome.min.css', array(), '4.7.0', 'all' );

	wp_enqueue_style( 'select2', TF_PLUGIN_URL . 'public/assets/third-party/select2/css/select2.min.css', array(), null, 'all' );

	wp_register_style( 'bootstrap-datepicker', TF_PLUGIN_URL . 'public/assets/third-party/bootstrap-datepicker/css/bootstrap-datepicker.min.css', array(), 'v1.9.0' );

	wp_enqueue_style( 'advanced-search-styles', TF_PLUGIN_URL . 'public/assets/css/advanced-search.css', array(), null, 'all' );

	wp_enqueue_style( 'styles', TF_PLUGIN_URL . 'public/assets/css/styles.css', array(), null, 'all' );

	// Left To Right
	if( is_rtl() ){
		wp_enqueue_style( 'plugin-rtl', TF_PLUGIN_URL . 'public/assets/css/rtl.css', array(), null, 'all' );
    }  

}

add_action( 'wp_enqueue_scripts', 'tfre_add_public_styles' );

function tfre_add_public_script() {
	if ( ! is_front_page() ) {

		if ( tfre_get_option( "map_service" ) == 'google-map' ) {
			// google map

			$api_key = tfre_get_option( 'google_map_api_key', 'AIzaSyC-eRjtKRTyp34H0DgKKHHWGDxj0sT-vqE' );

			$google_map_url = 'https://maps.googleapis.com/maps/api/js?libraries=geometry,places,marker&key=' . $api_key;

			wp_enqueue_script( 'google_map', esc_url_raw( $google_map_url ), array(), false, true );

			wp_enqueue_script( 'google-map-js', TF_PLUGIN_URL . 'public/assets/js/google-map.js', array( 'jquery' ), false, true );
			
			wp_enqueue_script( 'google_marker_cluster', esc_url_raw( 'https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js' ), array(), false, true );
		}

		if ( tfre_get_option( "map_service" ) == 'map-box' ) {
			// mapbox

			wp_enqueue_script( 'mapbox-gl', 'https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js', array(), '2.15.0', true );

			wp_enqueue_script( 'mapbox-gl-geocoder', 'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js', array(), '5.0.0', true );
		}

		wp_enqueue_script( 'chart', TF_PLUGIN_URL . 'public/assets/third-party/chart/js/chart.js', array(), null, true );

		wp_enqueue_script( 'star-rating', TF_PLUGIN_URL . 'public/assets/js/star-rating.min.js', array( 'jquery' ), null, true );
	}

	wp_enqueue_script( 'jquery-ui-datepicker' );

	wp_enqueue_script( 'jquery-ui-min', TF_PLUGIN_URL . 'public/assets/third-party/jquery-ui/jquery-ui.min.js', array( 'jquery' ), '1.12.1', true );

	wp_enqueue_script( 'jquery-ui-touch-punch', TF_PLUGIN_URL . 'public/assets/third-party/jquery-ui/jquery.ui.touch-punch.min.js', array( 'jquery' ), '0.2.3', true );

	wp_enqueue_script( 'jquery-validate', TF_PLUGIN_URL . 'public/assets/js/jquery.validate.min.js', array( 'jquery' ), null, true );

	wp_enqueue_script( 'bootstrap-bundle-min', TF_PLUGIN_URL . 'public/assets/third-party/bootstrap/js/bootstrap.bundle.min.js', array( 'jquery' ), '4.6.2', true );

	wp_enqueue_script( 'select2', TF_PLUGIN_URL . 'public/assets/third-party/select2/js/select2.full.min.js', array( 'jquery' ), null, true );

	wp_register_script( 'bootstrap-datepicker', TF_PLUGIN_URL . 'public/assets/third-party/bootstrap-datepicker/js/bootstrap-datepicker.min.js', array( 'jquery' ), 'v1.9.0', true );

	wp_register_script( 'stripe-checkout', 'https://checkout.stripe.com/checkout.js', array(), null, true );

	wp_register_script( 'stripe-v3', 'https://js.stripe.com/v3', array(), null, true );

	$main_variables = array(
		'toggle_lazy_load' => tfre_get_option( 'toggle_lazy_load' ),
	);
	
	wp_enqueue_script( 'public-main', TF_PLUGIN_URL . 'public/assets/js/main.js', array( 'jquery' ), false, true );

	wp_localize_script( 'public-main', 'main_variables', $main_variables );
}

add_action( 'wp_enqueue_scripts', 'tfre_add_public_script' );

// Init Admin plugin options

require_once( TF_PLUGIN_PATH . '/admin/class-admin-plugin-options.php' );

$admin_plugin_options = new Admin_Plugin_Options();

$loader->tfre_add_action( 'after_setup_theme', @$admin_plugin_options, 'tfre_init_plugin_options' );

// Init custom post type

require_once( TF_PLUGIN_PATH . '/admin/class-admin-custom-post-type.php' );

$admin_custom_post_type = new Admin_Custom_Post_Type();

$loader->tfre_add_action( 'init', @$admin_custom_post_type, 'tfre_register_custom_post_type' );

// Init Admin Taxonomies

require_once( TF_PLUGIN_PATH . '/admin/class-admin-taxonomies.php' );

$admin_taxonomies = new Admin_Taxonomies();

// Create Taxonomy for Property of Custom Post Type "real-estate"

$loader->tfre_add_action( 'init', $admin_taxonomies, 'tfre_register_taxonomies', 0 );

// Remove parent dropdown in Taxonomy

$loader->tfre_add_action( 'admin_head-edit-tags.php', $admin_taxonomies, 'tfre_remove_tax_parent_dropdown' );
$loader->tfre_add_action( 'admin_head-term.php', $admin_taxonomies, 'tfre_remove_tax_parent_dropdown' );
$loader->tfre_add_action( 'admin_head-post.php', $admin_taxonomies, 'tfre_remove_tax_parent_dropdown' );
$loader->tfre_add_action( 'admin_head-post-new.php', $admin_taxonomies, 'tfre_remove_tax_parent_dropdown' );

// Term meta

require_once( TF_PLUGIN_PATH . '/admin/term-meta/class-term-meta.php' );

$loader->tfre_add_action( 'init', $admin_taxonomies, 'tfre_register_term_meta', 0 );

// Init Admin Location

require_once( TF_PLUGIN_PATH . '/admin/class-admin-location.php' );

$admin_location = new Admin_Location();

// Countries

$loader->tfre_add_action( 'admin_menu', $admin_location, 'tfre_create_submenu_country' );

$loader->tfre_add_action( 'admin_init', $admin_location, 'tfre_country_register_settings' );

$loader->tfre_add_action( 'wp_ajax_tfre_reset_option_country', $admin_location, 'tfre_hanlde_reset_option_country_list' );

// Init meta box

require_once( TF_PLUGIN_PATH . '/admin/meta-box/class-meta-boxes.php' );

require_once( TF_PLUGIN_PATH . '/admin/class-admin-meta-boxes.php' );

$admin_meta_boxes = new Admin_Meta_Boxes();

$loader->tfre_add_action( 'admin_init', @$admin_meta_boxes, 'tfre_register_meta_boxes' );

// Init User Public hooks

require_once( TF_PLUGIN_PATH . 'includes/libraries/Google-Client/class-google-client.php' );

$google_client = new TF_Google_Client();

$loader->tfre_add_action( 'init', $google_client, 'get_instance' );

require_once( TF_PLUGIN_PATH . '/public/partials/account/class-user.php' );

$class_public = new User_Public( $google_client );

$loader->tfre_add_action( 'wp_enqueue_scripts', @$class_public, 'tfre_enqueue_user_scripts' );

$loader->tfre_add_action( 'wp_footer', $class_public, 'tfre_login_register_modal' );

// Register

$loader->tfre_add_action( 'wp_ajax_custom_register', @$class_public, 'tfre_custom_register_ajax_handler' );

$loader->tfre_add_action( 'wp_ajax_nopriv_custom_register', @$class_public, 'tfre_custom_register_ajax_handler' );

$loader->tfre_add_shortcode( 'custom_register_form', @$class_public, 'tfre_custom_register_form_shortcode' );

// Login

$loader->tfre_add_action( 'wp_ajax_custom_login', @$class_public, 'tfre_custom_login_ajax_handler' );

$loader->tfre_add_action( 'wp_ajax_nopriv_custom_login', @$class_public, 'tfre_custom_login_ajax_handler' );

$loader->tfre_add_action( 'wp_ajax_set_access_token_google', @$class_public, 'tfre_set_access_token_google' );

$loader->tfre_add_action( 'wp_ajax_nopriv_set_access_token_google', @$class_public, 'tfre_set_access_token_google' );

$loader->tfre_add_action( 'wp_ajax_handle_google_login', @$class_public, 'tfre_handle_google_login' );

$loader->tfre_add_action( 'wp_ajax_nopriv_handle_google_login', @$class_public, 'tfre_handle_google_login' );

$loader->tfre_add_shortcode( 'custom_login_form', $class_public, 'tfre_custom_login_form_shortcode' );

// Reset password

$loader->tfre_add_action( 'wp_ajax_tfre_reset_password_ajax', $class_public, 'tfre_reset_password_ajax' );

$loader->tfre_add_action( 'wp_ajax_nopriv_tfre_reset_password_ajax', $class_public, 'tfre_reset_password_ajax' );

// Profile

$loader->tfre_add_action( 'wp_ajax_profile_update', @$class_public, 'tfre_profile_update_ajax_handler' );

$loader->tfre_add_action( 'wp_ajax_avatar_upload', @$class_public, 'tfre_upload_avatar_ajax_handler' );

$loader->tfre_add_action( 'wp_ajax_agent_poster_upload', @$class_public, 'tfre_upload_agent_poster_ajax_handler' );

$loader->tfre_add_shortcode( 'my_profile', @$class_public, 'tfre_my_profile_shortcode' );

$loader->tfre_add_action( 'wp_ajax_tfre_change_password_ajax', $class_public, 'tfre_change_password_ajax' );

// Agent

$loader->tfre_add_action( 'wp_ajax_leave_agent', @$class_public, 'tfre_leave_agent_ajax' );

$loader->tfre_add_action( 'wp_ajax_become_agent', @$class_public, 'tfre_become_agent_ajax' );

function tfre_do_output_buffer() {
	ob_start();
}

add_action( 'init', 'tfre_do_output_buffer' );

// Agent Post Type

require_once( TF_PLUGIN_PATH . 'admin/class-admin-agent.php' );

$admin_agent = new Admin_Agent();

$loader->tfre_add_filter( 'parse_query', $admin_agent, 'tfre_agent_filter' );

$loader->tfre_add_filter( 'admin_init', $admin_agent, 'tfre_approve_agent' );

$post_type = isset( $_GET['post_type'] ) ? sanitize_text_field( wp_unslash( $_GET['post_type'] ) ) : '';

// Agent custom columns

if ( ( $pagenow == 'edit.php' ) && ( $post_type == 'agent' ) ) {
	$loader->tfre_add_filter( 'post_row_actions', $admin_agent, 'modify_list_row_actions', 10, 2 );

	$loader->tfre_add_filter( 'page_row_actions', $admin_agent, 'modify_list_row_actions', 10, 2 );
}

// Real-estate post type

require_once( TF_PLUGIN_PATH . 'admin/class-admin-real-estate.php' );

$admin_real_estate = new Admin_Real_Estate();

$loader->tfre_add_action( 'after_setup_theme', $admin_real_estate, 'tfre_remove_admin_bar' );

$loader->tfre_add_action( 'admin_init', $admin_real_estate, 'tfre_allow_only_admin_access_wpadmin' );

$loader->tfre_add_filter( 'admin_init', $admin_real_estate, 'tfre_approve_property' );

$loader->tfre_add_filter( 'admin_init', $admin_real_estate, 'tfre_hidden_property' );

$loader->tfre_add_filter( 'admin_init', $admin_real_estate, 'tfre_show_property' );

if ( ( $pagenow == 'edit.php' ) && ( $post_type == 'real-estate' ) ) {

	$loader->tfre_add_filter( 'page_row_actions', $admin_real_estate, 'modify_list_row_actions', 10, 2 );

}

$loader->tfre_add_action( 'restrict_manage_posts', $admin_real_estate, 'tfre_filter_restrict_manage_properties_list' );

$loader->tfre_add_filter( 'parse_query', $admin_real_estate, 'tfre_handle_filter_properties_list' );

$loader->tfre_add_action( 'init', $admin_real_estate, 'tfre_register_new_post_status' );

// Init DashBoard hooks

require_once( TF_PLUGIN_PATH . '/public/partials/dashboard/class-dashboard.php' );

$class_dashboard = new Dashboard();

$loader->tfre_add_shortcode( 'dashboard', @$class_dashboard, 'tfre_dashboard_shortcode' );

$loader->tfre_add_action( 'wp_enqueue_scripts', @$class_dashboard, 'tfre_enqueue_dashboard_scripts' );

$loader->tfre_add_action( 'wp_ajax_action_property_dashboard', @$class_dashboard, 'tfre_handle_actions_properties_dashboard' );

$loader->tfre_add_action( 'wp_ajax_dashboard_insight_chart_ajax', $class_dashboard, 'tfre_dashboard_insight_chart_ajax' );

// Init Advanced Search hooks

require_once( TF_PLUGIN_PATH . '/public/partials/advanced-search/class-advanced-search.php' );

$advanced_search = new Advanced_Search();

$loader->tfre_add_action( 'wp_enqueue_scripts', @$advanced_search, 'tfre_enqueue_advanced_search_scripts' );

$loader->tfre_add_action( 'wp_ajax_get_province_states_by_country_ajax', $advanced_search, 'get_province_states_by_country_ajax' );

$loader->tfre_add_action( 'wp_ajax_nopriv_get_province_states_by_country_ajax', $advanced_search, 'get_province_states_by_country_ajax' );

$loader->tfre_add_action( 'wp_ajax_get_neighborhoods_by_province_state_ajax', $advanced_search, 'get_neighborhoods_by_province_state_ajax' );

$loader->tfre_add_action( 'wp_ajax_nopriv_get_neighborhoods_by_province_state_ajax', $advanced_search, 'get_neighborhoods_by_province_state_ajax' );

// Check matching new property with save advanced search

$loader->tfre_add_action( 'check_matching_saved_search', $cron_job, 'tfre_check_matching_saved_search' );

$loader->tfre_add_shortcode( 'advanced_search', @$advanced_search, 'tfre_advanced_search_shortcode' );

$loader->tfre_add_action( 'property_advanced_search_form', $advanced_search, 'property_advanced_search_form' );

$loader->tfre_add_shortcode('advanced_search_form', $advanced_search, 'property_advanced_search_form');

// Init save advanced search hooks

require_once( TF_PLUGIN_PATH . '/public/partials/advanced-search/class-save-advanced-search.php' );

$save_advanced_search = new Save_Advanced_Search();

$loader->tfre_add_action( 'wp_ajax_tfre_save_advanced_search_ajax', @$save_advanced_search, 'tfre_save_advanced_search_ajax' );

$loader->tfre_add_action( 'wp', @$save_advanced_search, 'tfre_handle_action_my_saved_advanced_search' );

$loader->tfre_add_shortcode( 'my_saved_advanced_search', @$save_advanced_search, 'tfre_my_saved_advanced_search_shortcode' );

// Init Property Public hooks

require_once( TF_PLUGIN_PATH . '/public/partials/property/class-property.php' );

$property_public = new Property_Public();

$loader->tfre_add_action( 'wp_enqueue_scripts', @$property_public, 'tfre_enqueue_property_scripts' );

$loader->tfre_add_action( 'wp_enqueue_scripts', @$property_public, 'tfre_enqueue_property_styles' );

$loader->tfre_add_action( 'wp_ajax_img_upload', @$property_public, 'tfre_property_image_upload_ajax' );

$loader->tfre_add_action( 'wp_ajax_file_attachment_upload', @$property_public, 'tfre_property_attachment_upload_ajax' );

$loader->tfre_add_action( 'wp_ajax_delete_img_or_file', @$property_public, 'tfre_delete_property_image_or_file_ajax' );

$loader->tfre_add_action( 'wp_ajax_save_property', @$property_public, 'tfre_handle_save_property_ajax' );

$loader->tfre_add_action( 'wp', @$property_public, 'tfre_handle_actions_my_properties' );

$loader->tfre_add_action( 'tfre_favorite_action', @$property_public, 'tfre_property_favorite', 10, 2 );

$loader->tfre_add_action( 'tfre_compare_action', @$property_public, 'tfre_property_compare', 10, 2 );

$loader->tfre_add_action( 'wp_ajax_get_property_detail', $property_public, 'tfre_get_property_detail' );

$loader->tfre_add_action( 'wp_ajax_nopriv_get_property_detail', $property_public, 'tfre_get_property_detail' );

$loader->tfre_add_action( 'template_redirect', @$property_public, 'tfre_set_views', 99999 );

$loader->tfre_add_shortcode( 'my_property', @$property_public, 'tfre_my_properties_shortcode' );

$loader->tfre_add_shortcode( 'save_property', @$property_public, 'tfre_save_property_shortcode' );

$loader->tfre_add_shortcode( 'listing_property', @$property_public, 'tfre_listing_property' );

// Search Ajax
$loader->tfre_add_action( 'wp_ajax_filter_property_ajax', @$property_public, 'tfre_filter_property_ajax' );
$loader->tfre_add_action( 'wp_ajax_nopriv_filter_property_ajax', @$property_public, 'tfre_filter_property_ajax' );

// Load More Properties Ajax
$loader->tfre_add_action( 'wp_ajax_load_more_property_ajax', @$property_public, 'tfre_load_more_property_ajax' );
$loader->tfre_add_action( 'wp_ajax_nopriv_load_more_property_ajax', @$property_public, 'tfre_load_more_property_ajax' );

// Shortcode popup filter
$loader->tfre_add_action( 'popup_filter_form', @$property_public, 'tfre_popup_filter_shortcode' );
$loader->tfre_add_shortcode( 'popup_filter', @$property_public, 'tfre_popup_filter_shortcode' );
$loader->tfre_add_action( 'popup_filter_modal_form', @$property_public, 'tfre_popup_filter_modal_shortcode' );
$loader->tfre_add_shortcode( 'popup_filter_modal', @$property_public, 'tfre_popup_filter_modal_shortcode' );

// Shortcode related properties

$loader->tfre_add_shortcode( 'related_properties', @$property_public, 'tfre_related_properties_shortcode' );

// Shortcode author property

$loader->tfre_add_shortcode( 'author_property_info', @$property_public, 'tfre_author_property_shortcode' );

// Shortcode loan calculator

$loader->tfre_add_shortcode( 'loan_calculator', @$property_public, 'tfre_loan_calculator_shortcode' );

// Shortcode nearby places

$loader->tfre_add_shortcode( 'nearby_places', @$property_public, 'tfre_nearby_places_shortcode' );

// Single Property

$loader->tfre_add_action( 'tfre_single_property_summary_header', @$property_public, 'tfre_single_property_header', 5 );

$loader->tfre_add_action( 'tfre_single_property_summary_gallery', @$property_public, 'tfre_single_property_gallery', 10 );

$loader->tfre_add_action( 'tfre_single_property_summary', @$property_public, 'tfre_single_property_overview', 15 );

$loader->tfre_add_action( 'tfre_single_property_summary', @$property_public, 'tfre_single_property_description', 20 );

$loader->tfre_add_action( 'tfre_single_property_summary', @$property_public, 'tfre_single_property_detail', 25 );

$loader->tfre_add_action( 'tfre_single_property_summary', @$property_public, 'tfre_single_property_features', 30 );

$loader->tfre_add_action( 'tfre_single_property_summary', @$property_public, 'tfre_single_property_location', 35 );

$loader->tfre_add_action( 'tfre_single_property_summary', @$property_public, 'tfre_single_property_floors', 45 );

$loader->tfre_add_action( 'tfre_single_property_summary', @$property_public, 'tfre_single_property_attachments', 50 );

$loader->tfre_add_action( 'tfre_single_property_summary', @$property_public, 'tfre_single_property_video_virtual', 55 );

$loader->tfre_add_action( 'tfre_single_property_summary', @$property_public, 'tfre_single_property_loan_calculator', 60 );

$loader->tfre_add_action( 'tfre_single_property_summary', @$property_public, 'tfre_single_property_nearby_places', 65 );

$loader->tfre_add_action( 'tfre_single_property_summary', @$property_public, 'tfre_single_property_global_custom_section', 70 );

$loader->tfre_add_action( 'tfre_single_property_summary', @$property_public, 'tfre_single_property_personal_custom_section', 75 );

// Favorites

$loader->tfre_add_action( 'wp_ajax_tfre_favorite_ajax', $property_public, 'tfre_favorite_ajax' );

$loader->tfre_add_action( 'wp_ajax_nopriv_tfre_favorite_ajax', $property_public, 'tfre_favorite_ajax' );

// Properties with map

$loader->tfre_add_shortcode( 'properties_listing_with_map', @$property_public, 'tfre_properties_map_shortcode' );

// Properties switch to map

$loader->tfre_add_shortcode( 'properties_listing_switch_map', @$property_public, 'tfre_properties_switch_map_shortcode' );

// Init Agent Public hooks

require_once( TF_PLUGIN_PATH . '/public/partials/agent/class-agent.php' );

$agent_public = new Agent_Public();

// List Agent

$loader->tfre_add_shortcode( 'listing_agent', @$agent_public, 'tfre_listing_agent' );

// Single Agent

$loader->tfre_add_action( 'wp_enqueue_scripts', @$agent_public, 'tfre_enqueue_agent_scripts' );

$loader->tfre_add_action( 'wp_enqueue_scripts', @$agent_public, 'tfre_enqueue_agent_styles' );

$loader->tfre_add_action( 'tfre_single_agent_summary', @$agent_public, 'tfre_single_agent_info', 5 );

$loader->tfre_add_action( 'tfre_single_agent_summary', @$agent_public, 'tfre_single_agent_property', 10 );

// Single Author

$loader->tfre_add_action( 'tfre_single_author_summary', @$agent_public, 'tfre_single_author_info', 5 );

$loader->tfre_add_action( 'tfre_single_author_summary', @$agent_public, 'tfre_single_author_property', 10 );

// Agency

$loader->tfre_add_action( 'tfre_taxonomy_agency_summary', @$agent_public, 'tfre_taxonomy_agency_detail', 10 );

$loader->tfre_add_action( 'tfre_taxonomy_agency_summary', @$agent_public, 'tfre_taxonomy_agency_property', 15 );

$loader->tfre_add_shortcode( 'listing_agency', @$agent_public, 'tfre_listing_agency' );

require_once( TF_PLUGIN_PATH . '/public/partials/favorite/class-favorite.php' );

$class_favorite = new MyFavorite();

$loader->tfre_add_shortcode( 'my_favorite', @$class_favorite, 'tfre_my_favorite_shortcode' );

require_once( TF_PLUGIN_PATH . '/public/partials/review/class-review.php' );

$class_review = new Review();

$loader->tfre_add_action( 'wp_enqueue_scripts', @$class_review, 'tfre_enqueue_review_scripts' );

$loader->tfre_add_action( 'tfre_single_review', @$class_review, 'tfre_property_review', 10, 2 );

$loader->tfre_add_shortcode( 'my_review', @$class_review, 'tfre_my_review_shortcode' );

$loader->tfre_add_action( 'wp_ajax_tfre_update_review_ajax', $class_review, 'tfre_update_review_ajax' );

// Compare

require_once( TF_PLUGIN_PATH . '/public/partials/property/class-compare.php' );

$compare = TFRE_Compare::getInstance();

$loader->tfre_add_action( 'wp_logout', $compare, 'tfre_close_session' );

$loader->tfre_add_action( 'tfre_show_compare', $compare, 'tfre_show_compare_listings', 5 );

$loader->tfre_add_action( 'wp_ajax_tfre_compare_add_remove_property_ajax', $compare, 'tfre_compare_add_remove_property_ajax' );

$loader->tfre_add_action( 'wp_ajax_nopriv_tfre_compare_add_remove_property_ajax', $compare, 'tfre_compare_add_remove_property_ajax' );

$loader->tfre_add_action( 'wp_footer', $compare, 'tfre_template_compare_listing' );

$loader->tfre_add_action( 'wp_enqueue_scripts', @$compare, 'tfre_enqueue_compare_scripts' );

$loader->tfre_add_shortcode( 'tfre_compare', @$compare, 'tfre_compare_shortcode' );

$loader->tfre_add_action( 'wp_ajax_tfre_property_submit_review_ajax', $class_review, 'tfre_submit_review_ajax' );

$loader->tfre_add_action( 'wp_ajax_nopriv_tfre_property_submit_review_ajax', $class_review, 'tfre_submit_review_ajax' );

$loader->tfre_add_action( 'tfre_property_rating_meta', $class_review, 'tfre_rating_meta_filter', 4, 9 );

// Init Admin Invoice

require_once( TF_PLUGIN_PATH . '/admin/class-admin-invoice.php' );

$admin_invoice = new Admin_Invoice();

// Invoice custom columns

if ( ( $pagenow == 'edit.php' ) && ( $post_type == 'invoice' ) ) {
	$loader->tfre_add_filter( 'manage_edit-invoice_columns', $admin_invoice, 'tfre_register_column_titles' );
	$loader->tfre_add_action( 'manage_invoice_posts_custom_column', $admin_invoice, 'tfre_display_column_value' );
	$loader->tfre_add_action( 'restrict_manage_posts', $admin_invoice, 'tfre_filter_restrict_manage_invoices' );
	$loader->tfre_add_filter( 'parse_query', $admin_invoice, 'tfre_handle_filter_restrict_manage_invoices' );
	$loader->tfre_add_filter( 'pre_get_posts', $admin_invoice, 'tfre_set_page_order_in_admin' );
}

// Init Invoice public

require_once( TF_PLUGIN_PATH . '/public/partials/invoice/class-invoice.php' );

$invoice_public = new Invoice_Public();

$loader->tfre_add_shortcode( 'tfre_my_invoice', $invoice_public, 'tfre_my_invoice_shortcode' );
$loader->tfre_add_action( 'wp_enqueue_scripts', $invoice_public, 'tfre_register_invoice_scripts' );
$loader->tfre_add_action( 'wp_ajax_tfre_handle_print_invoice', $invoice_public, 'tfre_handle_print_invoice' );
$loader->tfre_add_action( 'wp_ajax_nopriv_tfre_handle_print_invoice', $invoice_public, 'tfre_handle_print_invoice' );

// Init Admin User Package

require_once( TF_PLUGIN_PATH . '/admin/class-admin-user-package.php' );

$admin_user_package = new Admin_User_Package();

// User package custom columns

if ( ( $pagenow == 'edit.php' ) && ( $post_type == 'user-package' ) ) {
	$loader->tfre_add_filter( 'manage_edit-user-package_columns', $admin_user_package, 'tfre_register_custom_column_titles' );
	$loader->tfre_add_action( 'manage_user-package_posts_custom_column', $admin_user_package, 'tfre_display_column_value' );
	$loader->tfre_add_action( 'restrict_manage_posts', $admin_user_package, 'tfre_filter_restrict_manage_user_package' );
	$loader->tfre_add_filter( 'parse_query', $admin_user_package, 'tfre_handle_filter_restrict_manage_user_package' );
	$loader->tfre_add_action( 'before_delete_post', $admin_user_package, 'tfre_delete_user_package' );
}

// Init User Package public

require_once( TF_PLUGIN_PATH . 'public/partials/user-package/class-user-package.php' );

$user_package_public = new User_Package_Public();

// Init Transaction Log public

require_once( TF_PLUGIN_PATH . 'public/partials/transaction-logs/class-transaction-logs.php' );

$transaction_log_public = new Transaction_Logs_Public();

// Init Admin Transaction Log

require_once( TF_PLUGIN_PATH . '/admin/class-admin-transaction-log.php' );

$admin_transaction_log = new Admin_Transaction_Log();

if ( ( $pagenow == 'edit.php' ) && ( $post_type == 'transaction-log' ) ) {
	$loader->tfre_add_filter( 'manage_edit-transaction-log_columns', $admin_transaction_log, 'tfre_register_custom_column_titles' );
	$loader->tfre_add_action( 'manage_transaction-log_posts_custom_column', $admin_transaction_log, 'tfre_display_column_value' );
	$loader->tfre_add_action( 'restrict_manage_posts', $admin_transaction_log, 'tfre_filter_restrict_manage_transaction_log' );
	$loader->tfre_add_filter( 'parse_query', $admin_transaction_log, 'tfre_handle_filter_restrict_manage_transaction_log' );
	$loader->tfre_add_filter( 'pre_get_posts', $admin_transaction_log, 'tfre_set_page_order_in_admin' );
}

// Init package public

require_once( TF_PLUGIN_PATH . 'public/partials/package/class-package.php' );

$package_public = new Package_Public();

$loader->tfre_add_shortcode( 'tfre_package_list', @$package_public, 'tfre_package_list_shortcode' );
$loader->tfre_add_shortcode( 'tfre_my_package', @$package_public, 'tfre_my_package_shortcode' );
$loader->tfre_add_action( 'admin_menu', @$package_public, 'tfre_remove_excerpt', 999 );
add_action( 'edit_form_after_title', 'post_excerpt_meta_box' );

// Init payment public

require_once( TF_PLUGIN_PATH . 'public/partials/payment/class-payment.php' );

$payment_public = new Payment_Public();

$loader->tfre_add_shortcode( 'tfre_payment_invoice', @$payment_public, 'tfre_payment_invoice_shortcode' );
$loader->tfre_add_shortcode( 'tfre_payment_completed', @$payment_public, 'tfre_payment_completed_shortcode' );
$loader->tfre_add_action( 'wp_enqueue_scripts', @$payment_public, 'tfre_register_payment_scripts' );
$loader->tfre_add_action( 'wp_ajax_tfre_handle_payment_invoice_by_paypal', @$payment_public, 'tfre_handle_payment_invoice_by_paypal' );
$loader->tfre_add_action( 'wp_ajax_nopriv_tfre_handle_payment_invoice_by_paypal', @$payment_public, 'tfre_handle_payment_invoice_by_paypal' );
$loader->tfre_add_action( 'wp_ajax_tfre_handle_payment_invoice_by_wire_transfer', @$payment_public, 'tfre_handle_payment_invoice_by_wire_transfer' );
$loader->tfre_add_action( 'wp_ajax_nopriv_tfre_handle_payment_invoice_by_wire_transfer', @$payment_public, 'tfre_handle_payment_invoice_by_wire_transfer' );
$loader->tfre_add_action( 'wp_ajax_tfre_handle_free_package', @$payment_public, 'tfre_handle_free_package' );
$loader->tfre_add_action( 'wp_ajax_nopriv_tfre_handle_free_package', @$payment_public, 'tfre_handle_free_package' );

// Elementor Widgets

function tf_elementor_addon() {
	// Load plugin file

	require_once( TF_PLUGIN_PATH . '/includes/elementor-widget/elementor-widget-addon.php' );

	// Run the plugin

	$tf_elementor_widget_addon = new TF_Elementor_Widget_Addon();

	$tf_elementor_widget_addon::instance();
}

add_action( 'plugins_loaded', 'tf_elementor_addon' );

// run hooks

$loader->tfre_run();