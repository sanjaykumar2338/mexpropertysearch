<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor_Widget_Addon class.
 *
 * The main class that initiates and runs the addon.
 *
 * @since 1.0.0
 */
final class TF_Elementor_Widget_Addon {

	/**
	 * Addon Version
	 *
	 * @since 1.0.0
	 * @var string The addon version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the addon.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.7.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the addon.
	 */
	const MINIMUM_PHP_VERSION = '5.2';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var \Elementor_Test_Addon\Elementor_Widget_Addon The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return \Elementor_Test_Addon\Elementor_Widget_Addon An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * Perform some compatibility checks to make sure basic requirements are meet.
	 * If all compatibility checks pass, initialize the functionality.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		if ( $this->is_compatible() ) {
			add_action( 'elementor/init', [ $this, 'init' ] );
		}
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'widget_styles' ], 100 );
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ], 100 );
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'widget_styles_editor' ], 100 );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ], 100 );
	}

	/**
	 * Compatibility Checks
	 *
	 * Checks whether the site meets the addon requirement.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function is_compatible() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return false;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return false;
		}

		return true;

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) )
			unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'tf-real-estate' ),
			'<strong>' . esc_html__( 'Themesflat Addons For Elementor', 'tf-real-estate' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'tf-real-estate' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) )
			unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'tf-real-estate' ),
			'<strong>' . esc_html__( 'Themesflat Addons For Elementor', 'tf-real-estate' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'tf-real-estate' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) )
			unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'tf-real-estate' ),
			'<strong>' . esc_html__( 'Themesflat Addons For Elementor', 'tf-real-estate' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'tf-real-estate' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Initialize
	 *
	 * Load the addons functionality only after Elementor is initialized.
	 *
	 * Fired by `elementor/init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {
		add_action( 'elementor/elements/categories_registered', function () {
			$elementsManager = \Elementor\Plugin::instance()->elements_manager;
			$elementsManager->add_category(
				'themesflat_real_estate_addons',
				array (
					'title' => 'Themesflat Real Estate Addons',
					'icon'  => 'fonts',
				) );
		} );
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
		add_action( 'wp_ajax_tfre_get_properties_by_taxonomy', [ $this, 'tfre_get_properties_by_taxonomy' ], 100 );
		add_action( 'wp_ajax_nopriv_tfre_get_properties_by_taxonomy', [ $this, 'tfre_get_properties_by_taxonomy' ], 100 );
	}

	public function widget_scripts() {
		// 3rd
		wp_register_script( 'owl-carousel', TF_PLUGIN_URL . 'public/assets/third-party/owl-carousel/owl.carousel.min.js', [ 'jquery' ], false, true );
		wp_register_script( 'magnific-popup', TF_PLUGIN_URL . 'public/assets/third-party/magnific-popup/jquery.magnific-popup.min.js', [ 'jquery' ], false, true );
		wp_enqueue_script( 'magnific-popup' );
		wp_register_script( 'swiper-min-script', TF_PLUGIN_URL . 'public/assets/third-party/swiper/swiper-bundle.min.js', [ 'jquery' ], false, true );
		wp_enqueue_script( 'swiper-min-script' );
		// widget
		wp_enqueue_script( 'jquery' );
		wp_register_script( 'properties-script', TF_PLUGIN_URL . 'includes/elementor-widget/assets/js/properties.js', array( 'jquery' ), false, true );
		$tf_properties_vars = array(
			'ajax_url'   => TF_AJAX_URL,
			'ajax_nonce' => wp_create_nonce( 'nonce_filter_properties' ),
		);
		wp_localize_script( 'properties-script', 'tf_properties_vars', $tf_properties_vars );
		wp_register_script( 'agents-script', TF_PLUGIN_URL . 'includes/elementor-widget/assets/js/agents.js', array( 'jquery' ), false, true );
		wp_register_script( 'areas-script', TF_PLUGIN_URL . 'includes/elementor-widget/assets/js/areas.js', array( 'jquery' ), false, true );
		$tfre_property_advanced_search_vars = array(
			'ajaxUrl'          => TF_AJAX_URL,
			'currencySign'     => tfre_get_option( 'currency_sign', esc_html__( '$', 'tf-real-estate' ) ),
			'currencyPosition' => tfre_get_option( 'currency_sign_position', esc_html__( 'before', 'tf-real-estate' ) ),
			'inElementor'      => true,
			'country_default'  => is_array( get_option( 'country_list' ) ) ? get_option( 'country_list' )[0] : ''
		);
		wp_register_script( 'search-property-script', TF_PLUGIN_URL . 'public/assets/js/advanced-search.js', array( 'jquery' ), false, true );
		wp_localize_script( 'search-property-script', 'advancedSearchVars', $tfre_property_advanced_search_vars );
		wp_register_script( 'taxonomy-script', TF_PLUGIN_URL . 'includes/elementor-widget/assets/js/taxonomy.js', array( 'jquery' ), false, true );
	}

	public function widget_styles() {
		if ( did_action( 'elementor/loaded' ) ) {
			wp_enqueue_style( 'tf_font_awesome', ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/all.min.css', __FILE__ );
			wp_enqueue_style( 'tf_regular', ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/regular.min.css', __FILE__ );
		}

		// 3rd
		wp_register_style( 'owl-carousel', TF_PLUGIN_URL . 'public/assets/third-party/owl-carousel/owl.carousel.min.css' );
		wp_register_style( 'magnific-popup', TF_PLUGIN_URL . 'public/assets/third-party/magnific-popup/magnific-popup.min.css' );
		wp_enqueue_style( 'magnific-popup' );
		wp_register_style( 'swiper-min-style', TF_PLUGIN_URL . 'public/assets/third-party/swiper/swiper-bundle.min.css' );
		wp_enqueue_style( 'swiper-min-style' );
		wp_register_style( 'icon-moon', TF_PLUGIN_URL . 'public/assets/third-party/fonts-awesome/fonts/style.css' );
		wp_enqueue_style( 'icon-moon' );
		// widget
		wp_register_style( 'properties-styles', TF_PLUGIN_URL . 'includes/elementor-widget/assets/css/properties.css' );
		wp_register_style( 'agents-styles', TF_PLUGIN_URL . 'includes/elementor-widget/assets/css/agents.css' );
		wp_register_style( 'areas-styles', TF_PLUGIN_URL . 'includes/elementor-widget/assets/css/areas.css' );
		wp_register_style( 'search-property-styles', TF_PLUGIN_URL . 'includes/elementor-widget/assets/css/search-property.css' );
		wp_register_style( 'taxonomy-styles', TF_PLUGIN_URL . 'includes/elementor-widget/assets/css/taxonomy.css' );
	}

	public function widget_styles_editor() {
		if ( did_action( 'elementor/loaded' ) ) {
			wp_enqueue_style( 'tf_font_awesome', ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/all.min.css', __FILE__ );
			wp_enqueue_style( 'tf_regular', ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/regular.min.css', __FILE__ );
		}
	}

	public function admin_scripts() {
		wp_enqueue_style( 'select2_css', TF_PLUGIN_URL . 'public/assets/third-party/select2/css/select2.min.css', array(), null, 'all' );
		wp_enqueue_script( 'select2_js', TF_PLUGIN_URL . 'public/assets/third-party/select2/js/select2.full.min.js', array( 'jquery' ), null, true );
	}

	/**
	 * Register Widgets
	 *
	 * Load widgets files and register new Elementor widgets.
	 *
	 * Fired by `elementor/widgets/register` action hook.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {

		require_once( TF_PLUGIN_PATH . '/includes/elementor-widget/widgets/widget-properties.php' );
		$widgets_manager->register( new Widget_Properties() );

		require_once( TF_PLUGIN_PATH . '/includes/elementor-widget/widgets/widget-agents.php' );
		$widgets_manager->register( new Widget_Agents() );

		require_once( TF_PLUGIN_PATH . '/includes/elementor-widget/widgets/widget-areas.php' );
		$widgets_manager->register( new Widget_Areas() );

		require_once( TF_PLUGIN_PATH . '/includes/elementor-widget/widgets/widget-search-property.php' );
		$widgets_manager->register( new Widget_Search_Property() );

		require_once( TF_PLUGIN_PATH . '/includes/elementor-widget/widgets/widget-property-type.php' );
		$widgets_manager->register( new Widget_Property_Type() );

		require_once( TF_PLUGIN_PATH . '/includes/elementor-widget/widgets/widget-featured-single-property.php' );
		$widgets_manager->register( new Widget_Featured_Single_Property() );
	}
}