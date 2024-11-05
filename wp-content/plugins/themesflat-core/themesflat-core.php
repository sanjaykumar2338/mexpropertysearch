<?php
/*
Plugin Name: Themesflat Core
Description: The theme's components
Author: Themesflat
Version: 1.0.2
Text Domain: themesflat-core
Domain Path: /languages
*/

define( 'THEMESFLAT_VERSION', '1.0.1' );
define( 'THEMESFLAT_PATH', plugin_dir_path( __FILE__ ) );
define( 'THEMESFLAT_URL', plugin_dir_url( __FILE__ ) );
define( 'THEMESFLAT_ICON', plugin_dir_url( __FILE__ ).'assets/img/logo.png' );

$theme = wp_get_theme();
if ( 'dreamhome' == $theme->name || 'dreamhome' == $theme->parent_theme ) {
    require_once THEMESFLAT_PATH . '/includes/options.php';
    require_once THEMESFLAT_PATH . '/includes/metabox-options.php';
    require THEMESFLAT_PATH . "/widgets/themesflat_recent_post.php";
    require THEMESFLAT_PATH . "/widgets/themesflat_socials.php";
}

function themesflat_shortcode_register_assets() {
	wp_enqueue_style( 'iziModal', plugins_url('assets/css/iziModal.css', __FILE__), array(), true );
	wp_enqueue_script( 'iziModal', plugins_url('assets/js/iziModal.js', __FILE__), array(), '1.0', true );
	wp_enqueue_style( 'tf-main-post-type', plugins_url('assets/css/tf-main-post-type.css', __FILE__), array(), true );
	wp_enqueue_script( 'tf-main-post-type', plugins_url('assets/js/tf-main-post-type.js', __FILE__), array(), '1.0', true );
    wp_enqueue_script( 'imagesloaded-pkgd' );
}
add_action( 'wp_enqueue_scripts', 'themesflat_shortcode_register_assets', 999999 );

function themesflat_admin_script_meta_box() {
    $screen = get_current_screen(); 
    wp_enqueue_script( 'themesflat-meta-box', plugins_url('assets/js/meta-boxes.js', __FILE__), array(), true );
    
}
add_action( 'admin_enqueue_scripts', 'themesflat_admin_script_meta_box' );

// Add image sizes post type
add_action( 'after_setup_theme', 'add_image_sizes' );
function add_image_sizes() {
    add_image_size( 'themesflat-post-archive', 350, 197, true );
}

function themesflat_mime_types_svg($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'themesflat_mime_types_svg');
add_filter('mime_types', 'themesflat_mime_types_svg');

if (!defined('ABSPATH'))
    exit;

final class ThemesFlat_Addon_For_Elementor_dreamhome {

    const VERSION = '1.0.0';
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
    const MINIMUM_PHP_VERSION = '5.2';

    private static $_instance = null;
    private static $meta_option;
    private static $current_page_type = null;
    private static $current_page_data = array();
    private static $user_selection;
    private static $location_selection;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {        
        add_action( 'init', [ $this, 'i18n' ] );
        add_action( 'plugins_loaded', [ $this, 'init' ] );
        define('URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME', plugins_url('/', __FILE__));

        define( 'URL_THEMESFLAT_THEME', trailingslashit( get_template_directory_uri() ) );
        
        add_action( 'elementor/frontend/after_register_styles', [ $this, 'widget_styles' ] , 100 );
        add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ], 100 );            

        add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] , 100 );  
        add_action( 'admin_action_edit', array( $this, 'initialize_options' ) );
        add_action( 'wp_ajax_tfhf_get_posts_by_query', array( $this, 'tfhf_get_posts_by_query' ) );  
        if ( ! function_exists('is_plugin_active') ){ include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); }    
    }

    public function i18n() {
        load_plugin_textdomain( 'themesflat-core', false, basename( dirname( __FILE__ ) ) . '/languages' );
    }

    public function init() {
        // Check if Elementor installed and activated        
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'tf_admin_notice_missing_main_plugin' ] );
            return;
        }

        // Check for required Elementor version
        if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
            return;
        }

        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            return;
        }      

        // Add Plugin actions
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
        add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ] );

        add_action( 'elementor/elements/categories_registered', function () {
            $elementsManager = \Elementor\Plugin::instance()->elements_manager;
            $elementsManager->add_category(
                'themesflat_addons',
                array(
                  'title' => 'THEMESFLAT ADDONS',
                  'icon'  => 'fonts',
            ));
        });
        
        require_once plugin_dir_path( __FILE__ ).'/pagination.php';
        require_once plugin_dir_path( __FILE__ ).'/tf-function.php';
        require_once plugin_dir_path( __FILE__ ).'/addon-elementor-icon-manager.php';
        require_once plugin_dir_path( __FILE__ ).'/tf-post-format.php';
        require_once plugin_dir_path( __FILE__ ).'/tf-icons.php';
    }    

    public function tf_admin_notice_missing_main_plugin() {
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'themesflat-core' ),
            '<strong>' . esc_html__( 'Themesflat Addons For Elementor', 'themesflat-core' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'themesflat-core' ) . '</strong>'
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    public function admin_notice_minimum_elementor_version() {
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'themesflat-core' ),
            '<strong>' . esc_html__( 'Themesflat Addons For Elementor', 'themesflat-core' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'themesflat-core' ) . '</strong>',
             self::MINIMUM_ELEMENTOR_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    public function admin_notice_minimum_php_version() {

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'themesflat-core' ),
            '<strong>' . esc_html__( 'Themesflat Addons For Elementor', 'themesflat-core' ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', 'themesflat-core' ) . '</strong>',
             self::MINIMUM_PHP_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    public function init_widgets() {

        require_once( __DIR__ . '/widgets/widget-imagebox.php' );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \TFImageBox_Widget() );

        require_once( __DIR__ . '/widgets/widget-title-section.php' );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \TFTitle_Section_Widget() ); 

        require_once( __DIR__ . '/widgets/widget-counter.php' );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \TFCounter_Widget() );

        require_once( __DIR__ . '/widgets/widget-testimonial-carousel.php' );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \TFTestimonialCarousel_Widget() );

        require_once( __DIR__ . '/widgets/widget-posts.php' );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \TFPosts_Widget() );

        require_once( __DIR__ . '/widgets/widget-accordion.php' );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \TFAccordion_Widget() );

        require_once( __DIR__ . '/widgets/widget-iconbox.php' );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \TFIconBox_Widget() );

        require_once( __DIR__ . '/widgets/widget-animation-item.php' );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \TFAnimationitem_Widget() );

        require_once( __DIR__ . '/widgets/widget-price-table.php' );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \TFPriceTable_Widget() );

        require_once( __DIR__ . '/widgets/widget-video.php' );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \TFVideo_Widget() );   

        require_once( __DIR__ . '/widgets/widget-list-image.php' );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \TFListImage_Widget() ); 

    }

    public function init_controls() {}    

    public function widget_styles() {
        if ( did_action( 'elementor/loaded' ) ) {
            wp_register_style('tf-font-awesome', ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/all.min.css', __FILE__);
            wp_register_style('tf-regular', ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/regular.min.css', __FILE__);
        }

        //widget
        wp_register_style( 'tf-title-section', plugins_url( '/assets/css/title-section/tf-title-section.css', __FILE__ ) );
        wp_register_style( 'tf-counter', plugins_url( '/assets/css/counter/tf-counter.css', __FILE__ ) );
        wp_register_style( 'tf-imagebox', plugins_url( '/assets/css/imagebox/tf-imagebox.css', __FILE__ ) );
        wp_register_style( 'tf-testimonial', plugins_url( '/assets/css/testimonial/tf-testimonial.css', __FILE__ ) );
        wp_register_style( 'tf-posts', plugins_url( '/assets/css/posts/tf-posts.css', __FILE__ ) );
        wp_register_style( 'tf-pricetable', plugins_url( '/assets/css/pricetable/tf-pricetable.css', __FILE__ ) );
        wp_register_style( 'tf-accordion', plugins_url( '/assets/css/accordion/tf-accordion.css', __FILE__ ) );
        wp_register_style( 'tf-iconbox', plugins_url( '/assets/css/iconbox/tf-iconbox.css', __FILE__ ) );
        wp_register_style( 'tf-list-image', plugins_url( '/assets/css/list-image/tf-list-image.css', __FILE__ ) );
        wp_register_style( 'tf-heading-section', plugins_url( '/assets/css/heading-section/tf-heading-section.css', __FILE__ ) );
        wp_register_style( 'tf-video', plugins_url( '/assets/css/video/tf-video.css', __FILE__ ) );
        wp_register_style( 'jquery-justified', plugins_url( '/assets/css/jquery.justified.css', __FILE__ ) );

        if( is_rtl() ){
            wp_enqueue_style( 'themesflat-core-rtl', plugins_url( '/assets/css/rtl-core.css', __FILE__ ) );
        }      
    }

    public function widget_scripts() {

        //3rd
        wp_register_script( 'jquery-easing', plugins_url( '/assets/js/jquery.easing.js', __FILE__ ), [ 'jquery' ], false, true );
        wp_register_script( 'imagesloaded-pkgd', plugins_url( '/assets/js/imagesloaded.pkgd.min.js', __FILE__ ), [ 'jquery' ], false, true );
        wp_register_script( 'owl-carousel', plugins_url( '/assets/js/owl.carousel.min.js', __FILE__ ), [ 'jquery' ], false, true );
        wp_register_script( 'appear', plugins_url( '/assets/js/appear.js', __FILE__ ), [ 'jquery' ], false, true );
        wp_register_script( 'magnific-popup', plugins_url( '/assets/js/magnific.popup.min.js', __FILE__ ), [ 'jquery' ], false, true );
        wp_enqueue_script( 'split', plugins_url( '/assets/js/split.js', __FILE__ ), [ 'jquery' ], false, true );

        wp_register_script( 'anime', plugins_url( '/assets/js/anime.js', __FILE__ ), [ 'jquery' ], false, true );
        
        //widget
        wp_register_script( 'tf-counter', plugins_url( '/assets/js/counter/tf-counter.js', __FILE__ ), [ 'jquery' ], false, true ); 
        wp_register_script( 'tf-testimonial', plugins_url( '/assets/js/testimonial/tf-testimonial.js', __FILE__ ), [ 'jquery' ], false, true );
        wp_register_script( 'tf-posts', plugins_url( '/assets/js/posts/tf-posts.js', __FILE__ ), [ 'jquery' ], false, true );
        wp_register_script( 'tf-accordion', plugins_url( '/assets/js/accordion/tf-accordion.js', __FILE__ ), [ 'jquery' ], false, true );
        wp_register_script( 'tf-video', plugins_url( '/assets/js/video/tf-video.js', __FILE__ ), [ 'jquery' ], false, true );
        wp_register_script( 'tf-title', plugins_url( '/assets/js/title/tf-title.js', __FILE__ ), [ 'jquery' ], false, true );
        
        wp_register_style( 'jquery-justified', plugins_url( '/assets/js/jquery.justified.min.js', __FILE__ ), [ 'jquery' ], false, true );
    }

    public function admin_scripts() {
        wp_register_style( 'tf-admin', plugins_url( '/assets/css/admin/admin.css', __FILE__ ) );
        wp_enqueue_style( 'tf-admin' );
        wp_register_script( 'tf-admin', plugins_url( '/assets/js/admin/admin.js', __FILE__ ), [ 'jquery' ], false, true );
        wp_enqueue_script( 'tf-admin' );
        wp_register_script( 'tf-admin-rule', plugins_url( '/assets/js/admin/admin-rule.js', __FILE__ ), [ 'jquery' ], false, true );
        wp_enqueue_script( 'tf-admin-rule' );
        $tfhf_localize_vars = array(
            'ajaxurl' =>    admin_url('admin-ajax.php'),
            'search'        => esc_html__( 'Search pages / post / categories', 'themesflat-core' ),
            'ajax_nonce'    => wp_create_nonce( 'tfhf-get-posts-by-query' ),
        );
        wp_localize_script( 'tf-admin-rule', 'tfhf_localize_vars', $tfhf_localize_vars );        
    }

    static function tf_get_template_elementor($type = null) {
        $args = [
            'post_type' => 'elementor_library',
            'posts_per_page' => -1,
        ];
        if ($type) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'elementor_library_type',
                    'field' => 'slug',
                    'terms' => $type,
                ],
            ];
        }
        $template = get_posts($args);
        $tpl = array();
        if (!empty($template) && !is_wp_error($template)) {
            foreach ($template as $post) {
                $tpl[$post->post_name] = $post->post_title;
            }
        }
        return $tpl;
    }  

    /*========================================= 
    post 
    ======================================== */
        static function tf_get_post_types() {
            $post_type_args = [
                'show_in_nav_menus' => true,
            ];
            $post_types = get_post_types($post_type_args, 'objects');

            foreach ( $post_types as $post_type ) {
                $post_type_name[$post_type->name] = $post_type->label;      
            }
            return $post_type_name;
        }

        static function tf_get_taxonomies( $category = 'category' ){
            $category_posts = get_terms( 
                array(
                    'taxonomy' => $category,
                )
            );
            
            foreach ( $category_posts as $category_post ) {
                $category_posts_name[$category_post->slug] = $category_post->name;      
            }
            return $category_posts_name;
        }  

    /*========================================= 
    Rule Template
    ======================================== */
        public function initialize_options() {
            self::$location_selection = self::get_location_selections();
        }

        public static function get_location_selections() {
            $args = array(
                'public'   => true,
                '_builtin' => true,
            );

            $post_types = get_post_types( $args, 'objects' );
            unset( $post_types['attachment'] );

            $args['_builtin'] = false;
            $custom_post_type = get_post_types( $args, 'objects' );

            $post_types = apply_filters( 'tfhf_location_rule_post_types', array_merge( $post_types, $custom_post_type ) );

            $special_pages = array(
                'special-404'    => esc_html__( '404 Page', 'themesflat-core' ),
                'special-search' => esc_html__( 'Search Page', 'themesflat-core' ),
                'special-blog'   => esc_html__( 'Blog / Posts Page', 'themesflat-core' ),
                'special-front'  => esc_html__( 'Front Page', 'themesflat-core' ),
                'special-date'   => esc_html__( 'Date Archive', 'themesflat-core' ),
                'special-author' => esc_html__( 'Author Archive', 'themesflat-core' ),
            );

            $selection_options = array(
                'basic'         => array(
                    'label' => esc_html__( 'Basic', 'themesflat-core' ),
                    'value' => array(
                        'basic-global'    => esc_html__( 'Entire Website', 'themesflat-core' ),
                        'basic-singulars' => esc_html__( 'All Singulars', 'themesflat-core' ),
                        'basic-archives'  => esc_html__( 'All Archives', 'themesflat-core' ),
                    ),
                ),

                'special-pages' => array(
                    'label' => esc_html__( 'Special Pages', 'themesflat-core' ),
                    'value' => $special_pages,
                ),
            );

            $args = array(
                'public' => true,
            );

            $taxonomies = get_taxonomies( $args, 'objects' );

            if ( ! empty( $taxonomies ) ) {
                foreach ( $taxonomies as $taxonomy ) {

                    if ( 'post_format' == $taxonomy->name ) {
                        continue;
                    }

                    foreach ( $post_types as $post_type ) {
                        $post_opt = self::get_post_target_rule_options( $post_type, $taxonomy );

                        if ( isset( $selection_options[ $post_opt['post_key'] ] ) ) {
                            if ( ! empty( $post_opt['value'] ) && is_array( $post_opt['value'] ) ) {
                                foreach ( $post_opt['value'] as $key => $value ) {
                                    if ( ! in_array( $value, $selection_options[ $post_opt['post_key'] ]['value'] ) ) {
                                        $selection_options[ $post_opt['post_key'] ]['value'][ $key ] = $value;
                                    }
                                }
                            }
                        } else {
                            $selection_options[ $post_opt['post_key'] ] = array(
                                'label' => $post_opt['label'],
                                'value' => $post_opt['value'],
                            );
                        }
                    }
                }
            }

            $selection_options['specific-target'] = array(
                'label' => esc_html__( 'Specific Target', 'themesflat-core' ),
                'value' => array(
                    'specifics' => esc_html__( 'Specific Pages / Posts / Taxonomies, etc.', 'themesflat-core' ),
                ),
            );

            return apply_filters( 'tfhf_display_on_list', $selection_options );
        }

        public static function get_location_by_key( $key ) {
            if ( ! isset( self::$location_selection ) || empty( self::$location_selection ) ) {
                self::$location_selection = self::get_location_selections();
            }
            $location_selection = self::$location_selection;

            foreach ( $location_selection as $location_grp ) {
                if ( isset( $location_grp['value'][ $key ] ) ) {
                    return $location_grp['value'][ $key ];
                }
            }

            if ( strpos( $key, 'post-' ) !== false ) {
                $post_id = (int) str_replace( 'post-', '', $key );
                return get_the_title( $post_id );
            }

            if ( strpos( $key, 'tax-' ) !== false ) {
                $tax_id = (int) str_replace( 'tax-', '', $key );
                $term   = get_term( $tax_id );

                if ( ! is_wp_error( $term ) ) {
                    $term_taxonomy = ucfirst( str_replace( '_', ' ', $term->taxonomy ) );
                    return $term->name . ' - ' . $term_taxonomy;
                } else {
                    return '';
                }
            }

            return $key;
        }

        public static function target_rule_settings_field( $name, $settings, $value ) {
            $input_name     = $name;
            $type           = isset( $settings['type'] ) ? $settings['type'] : 'target_rule';
            $class          = isset( $settings['class'] ) ? $settings['class'] : '';
            $rule_type      = isset( $settings['rule_type'] ) ? $settings['rule_type'] : 'target_rule';
            $add_rule_label = isset( $settings['add_rule_label'] ) ? $settings['add_rule_label'] : esc_html__( 'Add Rule', 'themesflat-core' );
            $saved_values   = $value;
            $output         = '';

            if ( isset( self::$location_selection ) || empty( self::$location_selection ) ) {
                self::$location_selection = self::get_location_selections();
            }
            $selection_options = self::$location_selection;

            $output .= '<script type="text/html" id="tmpl-tfhf-target-rule-' . $rule_type . '-condition">';
            $output .= '<div class="tfhf-target-rule-condition tfhf-target-rule-{{data.id}}" data-rule="{{data.id}}" >';
            $output .= '<span class="target_rule-condition-delete dashicons dashicons-dismiss"></span>';

            $output .= '<div class="target_rule-condition-wrap" >';
            $output .= '<select name="' . esc_attr( $input_name ) . '[rule][{{data.id}}]" class="target_rule-condition form-control tfhf-input">';
            $output .= '<option value="">' . esc_html__( 'Select', 'themesflat-core' ) . '</option>';

            foreach ( $selection_options as $group => $group_data ) {
                $output .= '<optgroup label="' . $group_data['label'] . '">';
                foreach ( $group_data['value'] as $opt_key => $opt_value ) {
                    $output .= '<option value="' . $opt_key . '">' . $opt_value . '</option>';
                }
                $output .= '</optgroup>';
            }
            $output .= '</select>';
            $output .= '</div>';

            $output .= '</div>';

            $output .= '<div class="target_rule-specific-page-wrap" style="display:none">';
            $output .= '<select name="' . esc_attr( $input_name ) . '[specific][]" class="target-rule-select2 target_rule-specific-page form-control tfhf-input " multiple="multiple">';
            $output .= '</select>';
            $output .= '</div>';

            $output .= '</script>';

            $output .= '<div class="tfhf-target-rule-wrapper tfhf-target-rule-' . $rule_type . '-on-wrap" data-type="' . $rule_type . '">';
            $output .= '<div class="tfhf-target-rule-selector-wrapper tfhf-target-rule-' . $rule_type . '-on">';
            $output .= self::generate_target_rule_selector( $rule_type, $selection_options, $input_name, $saved_values, $add_rule_label );
            $output .= '</div>';

            $output .= '</div>';

            echo $output;
        }

        public static function get_post_target_rule_options( $post_type, $taxonomy ) {
            $post_key    = str_replace( ' ', '-', strtolower( $post_type->label ) );
            $post_label  = ucwords( $post_type->label );
            $post_name   = $post_type->name;
            $post_option = array();

            $all_posts                          = sprintf( esc_html__( 'All %s', 'themesflat-core' ), $post_label );
            $post_option[ $post_name . '|all' ] = $all_posts;

            if ( 'pages' != $post_key ) {

                $all_archive                                = sprintf( esc_html__( 'All %s Archive', 'themesflat-core' ), $post_label );
                $post_option[ $post_name . '|all|archive' ] = $all_archive;
            }

            if ( in_array( $post_type->name, $taxonomy->object_type ) ) {
                $tax_label = ucwords( $taxonomy->label );
                $tax_name  = $taxonomy->name;

                $tax_archive = sprintf( esc_html__( 'All %s Archive', 'themesflat-core' ), $tax_label );

                $post_option[ $post_name . '|all|taxarchive|' . $tax_name ] = $tax_archive;
            }

            $post_output['post_key'] = $post_key;
            $post_output['label']    = $post_label;
            $post_output['value']    = $post_option;

            return $post_output;
        }

        public static function generate_target_rule_selector( $type, $selection_options, $input_name, $saved_values, $add_rule_label ) {
            $output = '<div class="target_rule-builder-wrap">';

            if ( ! is_array( $saved_values ) || ( is_array( $saved_values ) && empty( $saved_values ) ) ) {
                $saved_values                = array();
                $saved_values['rule'][0]     = '';
                $saved_values['specific'][0] = '';
            }

            $index = 0;
           
            foreach ( $saved_values['rule'] as $index => $data ) {            
                $output .= '<div class="tfhf-target-rule-condition tfhf-target-rule-' . $index . '" data-rule="' . $index . '" >';

                $output .= '<span class="target_rule-condition-delete dashicons dashicons-dismiss"></span>';
                $output .= '<div class="target_rule-condition-wrap" >';
                $output .= '<select name="' . esc_attr( $input_name ) . '[rule][' . $index . ']" class="target_rule-condition form-control tfhf-input">';
                $output .= '<option value="">' . esc_html__( 'Select', 'themesflat-core' ) . '</option>';

                foreach ( $selection_options as $group => $group_data ) {                
                    $output .= '<optgroup label="' . $group_data['label'] . '">';
                    foreach ( $group_data['value'] as $opt_key => $opt_value ) {

                        $selected = '';
                        
                        if ( $data == $opt_key ) {
                            $selected = 'selected="selected"';
                        }

                        $output .= '<option value="' . $opt_key . '" ' . $selected . '>' . $opt_value . '</option>';
                    }
                    $output .= '</optgroup>';
                }
                $output .= '</select>';
                $output .= '</div>';

                $output .= '</div>';

                $output .= '<div class="target_rule-specific-page-wrap" style="display:none">';
                $output .= '<select name="' . esc_attr( $input_name ) . '[specific][]" class="target-rule-select2 target_rule-specific-page form-control tfhf-input " multiple="multiple">';

                if ( 'specifics' == $data && isset( $saved_values['specific'] ) && null != $saved_values['specific'] && is_array( $saved_values['specific'] ) ) {
                    foreach ( $saved_values['specific'] as $data_key => $sel_value ) {

                        if ( strpos( $sel_value, 'post-' ) !== false ) {
                            $post_id    = (int) str_replace( 'post-', '', $sel_value );
                            $post_title = get_the_title( $post_id );
                            $output    .= '<option value="post-' . $post_id . '" selected="selected" >' . $post_title . '</option>';
                        }

                        if ( strpos( $sel_value, 'tax-' ) !== false ) {
                            $tax_data = explode( '-', $sel_value );

                            $tax_id    = (int) str_replace( 'tax-', '', $sel_value );
                            $term      = get_term( $tax_id );
                            $term_name = '';

                            if ( ! is_wp_error( $term ) ) {
                                $term_taxonomy = ucfirst( str_replace( '_', ' ', $term->taxonomy ) );

                                if ( isset( $tax_data[2] ) && 'single' === $tax_data[2] ) {
                                    $term_name = 'All singulars from ' . $term->name;
                                } else {
                                    $term_name = $term->name . ' - ' . $term_taxonomy;
                                }
                            }

                            $output .= '<option value="' . $sel_value . '" selected="selected" >' . $term_name . '</option>';                        
                        }
                    }
                }
                $output .= '</select>';
                $output .= '</div>';
            }

            $output .= '</div>';

            $output .= '<div class="target_rule-add-rule-wrap">';
            $output .= '<a href="#" class="button" data-rule-id="' . absint( $index ) . '" data-rule-type="' . $type . '">' . $add_rule_label . '</a>';
            $output .= '</div>';

            if ( 'display' == $type ) {

                $output .= '<div class="target_rule-add-exclusion-rule">';
                $output .= '<a href="#" class="button">' . esc_html__( 'Add Exclusion Rule Group', 'themesflat-core' ) . '</a>';
                $output .= '</div>';
            }

            return $output;
        }

        public static function get_format_rule_value( $save_data, $key ) {
            $meta_value = array();

            if ( isset( $save_data[ $key ]['rule'] ) ) {
                $save_data[ $key ]['rule'] = array_unique( $save_data[ $key ]['rule'] );
                if ( isset( $save_data[ $key ]['specific'] ) ) {
                    $save_data[ $key ]['specific'] = array_unique( $save_data[ $key ]['specific'] );
                }

                $index = array_search( '', $save_data[ $key ]['rule'] );
                if ( false !== $index ) {
                    unset( $save_data[ $key ]['rule'][ $index ] );
                }
                $index = array_search( 'specifics', $save_data[ $key ]['rule'] );
                if ( false !== $index ) {
                    unset( $save_data[ $key ]['rule'][ $index ] );

                    if ( isset( $save_data[ $key ]['specific'] ) && is_array( $save_data[ $key ]['specific'] ) ) {
                        array_push( $save_data[ $key ]['rule'], 'specifics' );
                    }
                }

                foreach ( $save_data[ $key ] as $meta_key => $value ) {
                    if ( ! empty( $value ) ) {
                        $meta_value[ $meta_key ] = array_map( 'esc_attr', $value );
                    }
                }
                if ( ! isset( $meta_value['rule'] ) || ! in_array( 'specifics', $meta_value['rule'] ) ) {
                    $meta_value['specific'] = array();
                }

                if ( empty( $meta_value['rule'] ) ) {
                    $meta_value = array();
                }
            }

            return $meta_value;
        }

        public function get_current_page_type() {
            if ( null === self::$current_page_type ) {
                $page_type  = '';
                $current_id = false;

                if ( is_404() ) {
                    $page_type = 'is_404';
                } elseif ( is_search() ) {
                    $page_type = 'is_search';
                } elseif ( is_archive() ) {
                    $page_type = 'is_archive';

                    if ( is_category() || is_tag() || is_tax() ) {
                        $page_type = 'is_tax';
                    } elseif ( is_date() ) {
                        $page_type = 'is_date';
                    } elseif ( is_author() ) {
                        $page_type = 'is_author';
                    }
                } elseif ( is_home() ) {
                    $page_type = 'is_home';
                } elseif ( is_front_page() ) {
                    $page_type  = 'is_front_page';
                    $current_id = get_the_id();
                } elseif ( is_singular() ) {
                    $page_type  = 'is_singular';
                    $current_id = get_the_id();
                } else {
                    $current_id = get_the_id();
                }

                self::$current_page_data['ID'] = $current_id;
                self::$current_page_type       = $page_type;
            }

            return self::$current_page_type;
        }

        public static function get_meta_option_post( $post_type, $option ) {
            $page_meta = ( isset( $option['page_meta'] ) && '' != $option['page_meta'] ) ? $option['page_meta'] : false;

            if ( false !== $page_meta ) {
                $current_post_id = isset( $option['current_post_id'] ) ? $option['current_post_id'] : false;
                $meta_id         = get_post_meta( $current_post_id, $option['page_meta'], true );

                if ( false !== $meta_id && '' != $meta_id ) {
                    self::$current_page_data[ $post_type ][ $meta_id ] = array(
                        'id'       => $meta_id,
                        'location' => '',
                    );

                    return self::$current_page_data[ $post_type ];
                }
            }

            return false;
        }

        function tfhf_get_posts_by_query() {

            check_ajax_referer( 'tfhf-get-posts-by-query', 'nonce' );

            $search_string = isset( $_POST['q'] ) ? sanitize_text_field( $_POST['q'] ) : '';
            $data          = array();
            $result        = array();

            $args = array(
                'public'   => true,
                '_builtin' => false,
            );

            $output     = 'names';
            $operator   = 'and';
            $post_types = get_post_types( $args, $output, $operator );

            unset( $post_types['tf_header_footer'] );

            $post_types['Posts'] = 'post';
            $post_types['Pages'] = 'page';

            foreach ( $post_types as $key => $post_type ) {
                $data = array();

                add_filter( 'posts_search', array( $this, 'search_only_titles' ), 10, 2 );

                $query = new \WP_Query(
                    array(
                        's'              => $search_string,
                        'post_type'      => $post_type,
                        'posts_per_page' => - 1,
                    )
                );

                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        $title  = get_the_title();
                        $title .= ( 0 != $query->post->post_parent ) ? ' (' . get_the_title( $query->post->post_parent ) . ')' : '';
                        $id     = get_the_id();
                        $data[] = array(
                            'id'   => 'post-' . $id,
                            'text' => $title,
                        );
                    }
                }

                if ( is_array( $data ) && ! empty( $data ) ) {
                    $result[] = array(
                        'text'     => $key,
                        'children' => $data,
                    );
                }
            }

            $data = array();

            wp_reset_postdata();

            $args = array(
                'public' => true,
            );

            $output     = 'objects';
            $operator   = 'and';
            $taxonomies = get_taxonomies( $args, $output, $operator );

            foreach ( $taxonomies as $taxonomy ) {
                $terms = get_terms(
                    $taxonomy->name,
                    array(
                        'orderby'    => 'count',
                        'hide_empty' => 0,
                        'name__like' => $search_string,
                    )
                );

                $data = array();

                $label = ucwords( $taxonomy->label );

                if ( ! empty( $terms ) ) {
                    foreach ( $terms as $term ) {
                        $term_taxonomy_name = ucfirst( str_replace( '_', ' ', $taxonomy->name ) );

                        $data[] = array(
                            'id'   => 'tax-' . $term->term_id,
                            'text' => $term->name . ' archive page',
                        );

                        $data[] = array(
                            'id'   => 'tax-' . $term->term_id . '-single-' . $taxonomy->name,
                            'text' => 'All singulars from ' . $term->name,
                        );
                    }
                }

                if ( is_array( $data ) && ! empty( $data ) ) {
                    $result[] = array(
                        'text'     => $label,
                        'children' => $data,
                    );
                }
            }

            wp_send_json( $result );
        }

        function search_only_titles( $search, $wp_query ) {
            if ( ! empty( $search ) && ! empty( $wp_query->query_vars['search_terms'] ) ) {
                global $wpdb;

                $q = $wp_query->query_vars;
                $n = ! empty( $q['exact'] ) ? '' : '%';

                $search = array();

                foreach ( (array) $q['search_terms'] as $term ) {
                    $search[] = $wpdb->prepare( "$wpdb->posts.post_title LIKE %s", $n . $wpdb->esc_like( $term ) . $n );
                }

                if ( ! is_user_logged_in() ) {
                    $search[] = "$wpdb->posts.post_password = ''";
                }

                $search = ' AND ' . implode( ' AND ', $search );
            }

            return $search;
        }

        public function parse_layout_display_condition( $post_id, $rules ) {
            $display           = false;
            $current_post_type = get_post_type( $post_id );

            if ( isset( $rules['rule'] ) && is_array( $rules['rule'] ) && ! empty( $rules['rule'] ) ) {
                foreach ( $rules['rule'] as $key => $rule ) {
                    if ( strrpos( $rule, 'all' ) !== false ) {
                        $rule_case = 'all';
                    } else {
                        $rule_case = $rule;
                    }

                    switch ( $rule_case ) {
                        case 'basic-global':
                            $display = true;
                            break;

                        case 'basic-singulars':
                            if ( is_singular() ) {
                                $display = true;
                            }
                            break;

                        case 'basic-archives':
                            if ( is_archive() ) {
                                $display = true;
                            }
                            break;

                        case 'special-404':
                            if ( is_404() ) {
                                $display = true;
                            }
                            break;

                        case 'special-search':
                            if ( is_search() ) {
                                $display = true;
                            }
                            break;

                        case 'special-blog':
                            if ( is_home() ) {
                                $display = true;
                            }
                            break;

                        case 'special-front':
                            if ( is_front_page() ) {
                                $display = true;
                            }
                            break;

                        case 'special-date':
                            if ( is_date() ) {
                                $display = true;
                            }
                            break;

                        case 'special-author':
                            if ( is_author() ) {
                                $display = true;
                            }
                            break;

                        case 'all':
                            $rule_data = explode( '|', $rule );

                            $post_type     = isset( $rule_data[0] ) ? $rule_data[0] : false;
                            $archieve_type = isset( $rule_data[2] ) ? $rule_data[2] : false;
                            $taxonomy      = isset( $rule_data[3] ) ? $rule_data[3] : false;
                            if ( false === $archieve_type ) {
                                $current_post_type = get_post_type( $post_id );

                                if ( false !== $post_id && $current_post_type == $post_type ) {
                                    $display = true;
                                }
                            } else {
                                if ( is_archive() ) {
                                    $current_post_type = get_post_type();
                                    if ( $current_post_type == $post_type ) {
                                        if ( 'archive' == $archieve_type ) {
                                            $display = true;
                                        } elseif ( 'taxarchive' == $archieve_type ) {
                                            $obj              = get_queried_object();
                                            $current_taxonomy = '';
                                            if ( '' !== $obj && null !== $obj ) {
                                                $current_taxonomy = $obj->taxonomy;
                                            }

                                            if ( $current_taxonomy == $taxonomy ) {
                                                $display = true;
                                            }
                                        }
                                    }
                                }
                            }
                            break;

                        case 'specifics':
                            if ( isset( $rules['specific'] ) && is_array( $rules['specific'] ) ) {
                                foreach ( $rules['specific'] as $specific_page ) {
                                    $specific_data = explode( '-', $specific_page );

                                    $specific_post_type = isset( $specific_data[0] ) ? $specific_data[0] : false;
                                    $specific_post_id   = isset( $specific_data[1] ) ? $specific_data[1] : false;
                                    if ( 'post' == $specific_post_type ) {
                                        if ( $specific_post_id == $post_id ) {
                                            $display = true;
                                        }
                                    } elseif ( isset( $specific_data[2] ) && ( 'single' == $specific_data[2] ) && 'tax' == $specific_post_type ) {
                                        if ( is_singular() ) {
                                            $term_details = get_term( $specific_post_id );

                                            if ( isset( $term_details->taxonomy ) ) {
                                                $has_term = has_term( (int) $specific_post_id, $term_details->taxonomy, $post_id );

                                                if ( $has_term ) {
                                                    $display = true;
                                                }
                                            }
                                        }
                                    } elseif ( 'tax' == $specific_post_type ) {
                                        $tax_id = get_queried_object_id();
                                        if ( $specific_post_id == $tax_id ) {
                                            $display = true;
                                        }
                                    }
                                }
                            }
                            break;

                        default:
                            break;
                    }

                    if ( $display ) {
                        break;
                    }
                }
            }

            return $display;
        }

        public function get_posts_by_conditions( $post_type, $option ) {
            global $wpdb;
            global $post;

            $post_type = $post_type ? esc_sql( $post_type ) : esc_sql( $post->post_type );

            if ( is_array( self::$current_page_data ) && isset( self::$current_page_data[ $post_type ] ) ) {
                return apply_filters( 'tfhf_get_display_posts_by_conditions', self::$current_page_data[ $post_type ], $post_type );
            }

            $current_page_type = $this->get_current_page_type();

            self::$current_page_data[ $post_type ] = array();

            $option['current_post_id'] = self::$current_page_data['ID'];
            $meta_header               = self::get_meta_option_post( $post_type, $option );

            if ( false === $meta_header ) {
                $current_post_type = esc_sql( get_post_type() );
                $current_post_id   = false;
                $q_obj             = get_queried_object();

                $location = isset( $option['location'] ) ? esc_sql( $option['location'] ) : '';

                $query = "SELECT p.ID, pm.meta_value FROM {$wpdb->postmeta} as pm
                            INNER JOIN {$wpdb->posts} as p ON pm.post_id = p.ID
                            WHERE pm.meta_key = '{$location}'
                            AND p.post_type = '{$post_type}'
                            AND p.post_status = 'publish'";

                $orderby = ' ORDER BY p.post_date DESC';

                $meta_args = "pm.meta_value LIKE '%\"basic-global\"%'";

                switch ( $current_page_type ) {
                    case 'is_404':
                        $meta_args .= " OR pm.meta_value LIKE '%\"special-404\"%'";
                        break;
                    case 'is_search':
                        $meta_args .= " OR pm.meta_value LIKE '%\"special-search\"%'";
                        break;
                    case 'is_archive':
                    case 'is_tax':
                    case 'is_date':
                    case 'is_author':
                        $meta_args .= " OR pm.meta_value LIKE '%\"basic-archives\"%'";
                        $meta_args .= " OR pm.meta_value LIKE '%\"{$current_post_type}|all|archive\"%'";

                        if ( 'is_tax' == $current_page_type && ( is_category() || is_tag() || is_tax() ) ) {
                            if ( is_object( $q_obj ) ) {
                                $meta_args .= " OR pm.meta_value LIKE '%\"{$current_post_type}|all|taxarchive|{$q_obj->taxonomy}\"%'";
                                $meta_args .= " OR pm.meta_value LIKE '%\"tax-{$q_obj->term_id}\"%'";
                            }
                        } elseif ( 'is_date' == $current_page_type ) {
                            $meta_args .= " OR pm.meta_value LIKE '%\"special-date\"%'";
                        } elseif ( 'is_author' == $current_page_type ) {
                            $meta_args .= " OR pm.meta_value LIKE '%\"special-author\"%'";
                        }
                        break;
                    case 'is_home':
                        $meta_args .= " OR pm.meta_value LIKE '%\"special-blog\"%'";
                        break;
                    case 'is_front_page':
                        $current_id      = esc_sql( get_the_id() );
                        $current_post_id = $current_id;
                        $meta_args      .= " OR pm.meta_value LIKE '%\"special-front\"%'";
                        $meta_args      .= " OR pm.meta_value LIKE '%\"{$current_post_type}|all\"%'";
                        $meta_args      .= " OR pm.meta_value LIKE '%\"post-{$current_id}\"%'";
                        break;
                    case 'is_singular':
                        $current_id      = esc_sql( get_the_id() );
                        $current_post_id = $current_id;
                        $meta_args      .= " OR pm.meta_value LIKE '%\"basic-singulars\"%'";
                        $meta_args      .= " OR pm.meta_value LIKE '%\"{$current_post_type}|all\"%'";
                        $meta_args      .= " OR pm.meta_value LIKE '%\"post-{$current_id}\"%'";

                        $taxonomies = get_object_taxonomies( $q_obj->post_type );
                        $terms      = wp_get_post_terms( $q_obj->ID, $taxonomies );

                        foreach ( $terms as $key => $term ) {
                            $meta_args .= " OR pm.meta_value LIKE '%\"tax-{$term->term_id}-single-{$term->taxonomy}\"%'";
                        }

                        break;
                    case '':
                        $current_post_id = get_the_id();
                        break;
                }

                $posts  = $wpdb->get_results( $query . ' AND (' . $meta_args . ')' . $orderby );            

                foreach ( $posts as $local_post ) {
                    self::$current_page_data[ $post_type ][ $local_post->ID ] = array(
                        'id'       => $local_post->ID,
                        'location' => unserialize( $local_post->meta_value ),
                    );
                }

                $option['current_post_id'] = $current_post_id;

                $this->remove_exclusion_rule_posts( $post_type, $option );
            }

            return apply_filters( 'tfhf_get_display_posts_by_conditions', self::$current_page_data[ $post_type ], $post_type );
        }

        public function remove_exclusion_rule_posts( $post_type, $option ) {
            $exclusion       = isset( $option['exclusion'] ) ? $option['exclusion'] : '';
            $current_post_id = isset( $option['current_post_id'] ) ? $option['current_post_id'] : false;

            foreach ( self::$current_page_data[ $post_type ] as $c_post_id => $c_data ) {
                $exclusion_rules = get_post_meta( $c_post_id, $exclusion, true );
                $is_exclude      = $this->parse_layout_display_condition( $current_post_id, $exclusion_rules );

                if ( $is_exclude ) {
                    unset( self::$current_page_data[ $post_type ][ $c_post_id ] );
                }
            }
        }
}
ThemesFlat_Addon_For_Elementor_dreamhome::instance();

