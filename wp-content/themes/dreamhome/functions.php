<?php
/**
 * themesflat functions and definitions
 *
 * @package dreamhome
 */
// remove_theme_mods();

define( 'THEMESFLAT_DIR', trailingslashit( get_template_directory() )) ;
define( 'THEMESFLAT_LINK', trailingslashit( get_template_directory_uri() ) );
define( 'THEMESFLAT_PROTOCOL' , (is_ssl()) ? 'https' : 'http' );
if ( ! function_exists( 'themesflat_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function themesflat_setup() {

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on burger, use a find and replace
     * to change 'dreamhome' to the name of your theme in all the template files
     */
    load_theme_textdomain( 'dreamhome', THEMESFLAT_DIR . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Content width
    global $content_width;
    if ( ! isset( $content_width ) ) {
        $content_width = 1200; /* pixels */
    }

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    add_theme_support( 'post-thumbnails' ); 
    add_image_size( 'themesflat-blog', 1170, 684, true );
    add_image_size( 'themesflat-blog-grid', 750, 446, true );    

    //Get thumbnail url
    function themesflat_thumbnail_url($size){
        global $post;
        if( $size== '' ) {
            $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
            return esc_url($url);
        } else {
            $url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $size);
            return esc_url($url[0]);
        }
    }

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'dreamhome' ),
        'bottom' => esc_html__( 'Bottom Menu', 'dreamhome' )
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
    ) );

    /*
     * Enable support for Post Formats.
     * See http://codex.wordpress.org/Post_Formats
     */
    add_theme_support( 'post-formats', array(
        'aside', 'image', 'link'
    ) );

    // Set up the WordPress core custom background feature.
    $args = array(
        'default-color' => 'ffffff',
        'default-image' => '',
    );

    add_theme_support( 'custom-background', $args );
    add_theme_support( 'custom-header', $args );

    // Custom stylesheet to the TinyMCE visual editor
    function themesflat_add_editor_styles() {
        add_editor_style( 'css/editor-style.css' );
    }
    add_action( 'admin_init', 'themesflat_add_editor_styles' );

}
endif; // themesflat_setup

add_action( 'after_setup_theme', 'themesflat_setup' );

function themesflat_wpfilesystem() {
    include_once (ABSPATH . '/wp-admin/includes/file.php');
    WP_Filesystem();
}

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function themesflat_widgets_init() {

    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar Blog', 'dreamhome' ),
        'id'            => 'blog-sidebar',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar Blog Sidebar.', 'dreamhome' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );     

    //Widget footer
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area 1', 'dreamhome' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar Footer area 1.', 'dreamhome' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area 2', 'dreamhome' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar Footer area 2.', 'dreamhome' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area 3', 'dreamhome' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar Footer area 3.', 'dreamhome' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area 4', 'dreamhome' ),
        'id'            => 'footer-4',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar Footer widget area 4.', 'dreamhome' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Properties Sidebar', 'dreamhome' ),
        'id'            => 'themesflat-custom-sidebar-propertysidebar',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar toggler.', 'dreamhome' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
        
}
add_action( 'widgets_init', 'themesflat_widgets_init' );

// Add theme support for selective refresh for widgets.
add_theme_support('customize-selective-refresh-widgets');

function themesflat_get_style($style) {
    return str_replace('italic', 'i', $style);
}

function themesflat_fonts_url() {
    $fonts_url = '';
    $typography_body =  themesflat_get_json('typography_body');
    $typography_headings = themesflat_get_json('typography_headings');
    $typography_menu = themesflat_get_json('typography_menu');
    $typography_sub_menu =  themesflat_get_json('typography_sub_menu');
    $typography_blockquote =  themesflat_get_json('typography_blockquote');
    $typography_blog_post_title =  themesflat_get_json('typography_blog_post_title');
    $typography_blog_post_meta = themesflat_get_json('typography_blog_post_meta');
    $typography_blog_post_buttons = themesflat_get_json('typography_blog_post_buttons');
    $typography_blog_single_title = themesflat_get_json('typography_blog_single_title');
    $typography_blog_single_comment_title = themesflat_get_json('typography_blog_single_comment_title');
    $typography_sidebar_widget_title = themesflat_get_json('typography_sidebar_widget_title');
    $typography_footer_widget_title = themesflat_get_json('typography_footer_widget_title');
    $typography_page_title = themesflat_get_json('typography_page_title');
    $typography_breadcrumb = themesflat_get_json('typography_breadcrumb');
    $typography_buttons = themesflat_get_json('typography_buttons');
    $typography_pagination = themesflat_get_json('typography_pagination');
    $typography_bottom_menu = themesflat_get_json('typography_bottom_menu');   
    $typography_footer = themesflat_get_json('typography_footer');
    $typography_bottom_copyright = themesflat_get_json('typography_bottom_copyright');

    $font_families = array(); 

    if ( '' != $typography_body ) {
        $font_families[] = $typography_body['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_body['style']);
    } else {
        $font_families[] = 'Poppins:400,400i,700,700i,900';
    }
    if ( '' != $typography_headings ) {
        $font_families[] = $typography_headings['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_headings['style']);
    } 
    if ( '' != $typography_menu ) {
        $font_families[] = $typography_menu['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_menu['style']);
    }
    if ( '' != $typography_sub_menu ) {
        $font_families[] = $typography_sub_menu['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_sub_menu['style']);
    }
    if ( '' != $typography_blockquote ) {
        $font_families[] = $typography_blockquote['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_blockquote['style']);
    }
    if ( '' != $typography_blog_post_title ) {
        $font_families[] = $typography_blog_post_title['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_blog_post_title['style']);
    }
    if ( '' != $typography_blog_post_meta ) {
        $font_families[] = $typography_blog_post_meta['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_blog_post_meta['style']);
    }
    if ( '' != $typography_blog_post_buttons ) {
        $font_families[] = $typography_blog_post_buttons['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_blog_post_buttons['style']);
    }
    if ( '' != $typography_blog_single_title ) {
        $font_families[] = $typography_blog_single_title['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_blog_single_title['style']);
    }
    if ( '' != $typography_blog_single_comment_title ) {
        $font_families[] = $typography_blog_single_comment_title['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_blog_single_comment_title['style']);
    }
    if ( '' != $typography_sidebar_widget_title ) {
        $font_families[] = $typography_sidebar_widget_title['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_sidebar_widget_title['style']);
    }
    if ( '' != $typography_footer_widget_title ) {
        $font_families[] = $typography_footer_widget_title['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_footer_widget_title['style']);
    }
    if ( '' != $typography_page_title ) {
        $font_families[] = $typography_page_title['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_page_title['style']);
    }
    if ( '' != $typography_breadcrumb ) {
        $font_families[] = $typography_breadcrumb['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_breadcrumb['style']);
    }
    if ( '' != $typography_buttons ) {
        $font_families[] = $typography_buttons['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_buttons['style']);
    }
    if ( '' != $typography_pagination ) {
        $font_families[] = $typography_pagination['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_pagination['style']);
    }
    if ( '' != $typography_bottom_menu ) {
        $font_families[] = $typography_bottom_menu['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_bottom_menu['style']);
    }
    if ( '' != $typography_footer ) {
        $font_families[] = $typography_footer['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_footer['style']);
    }
    if ( '' != $typography_bottom_copyright ) {
        $font_families[] = $typography_bottom_copyright['family'].':100,200,300,400,500,600,700,900,'.themesflat_get_style($typography_bottom_copyright['style']);
    }   
    
    $query_args = array(
        'family' => urlencode( implode( '|', $font_families ) ),        
    );

    $fonts_url = add_query_arg( $query_args, THEMESFLAT_PROTOCOL . '://fonts.googleapis.com/css' );

    return esc_url_raw( $fonts_url );
}

function themesflat_scripts_styles() {
    wp_enqueue_style( 'themesflat-theme-slug-fonts', themesflat_fonts_url(), array(), null );
}

add_action( 'wp_enqueue_scripts', 'themesflat_scripts_styles' );

/**
 * Enqueue scripts and styles.
 */

function themesflat_scripts() {    
    // Theme stylesheet.    
    wp_enqueue_style( 'icon-dreamhome', THEMESFLAT_LINK . 'css/icon-dreamhome.css' );
    wp_enqueue_style( 'icon-dreamhome2', THEMESFLAT_LINK . 'css/icon-dreamhome2.css' );
    wp_enqueue_style( 'themesflat-animated', THEMESFLAT_LINK . 'css/animated.css' );
    wp_enqueue_style( 'themesflat-main', THEMESFLAT_LINK . 'css/main.css' );
    wp_enqueue_style( 'themesflat-shortcode', THEMESFLAT_LINK . 'css/shortcode.css' );
    wp_enqueue_style( 'themesflat-inline-css', THEMESFLAT_LINK . 'css/inline-css.css' );  

    if( is_rtl() ){
        wp_enqueue_style( 'themesflat-main-rtl', THEMESFLAT_LINK . 'css/main-rtl.css' );
    }  

    
    // Load the html5 shiv..    
    wp_enqueue_script( 'html5shiv', THEMESFLAT_LINK . 'js/html5shiv.js', array('jquery'), '3.7.0' ,true);   
    wp_enqueue_script( 'matchmedia', THEMESFLAT_LINK . 'js/matchMedia.js', array('jquery'),'1.2',true);    
    wp_enqueue_script( 'nice-select', THEMESFLAT_LINK . 'js/nice-select.min.js', array('jquery'),'1.1.0',true);  

    if ( themesflat_get_opt('enable_smooth_scroll') == 1 ) {
       wp_enqueue_script( 'smoothscroll', THEMESFLAT_LINK . 'js/smoothscroll.min.js', array(),'1.2.1',true);
    }
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply', array(),'2.0.4',true );
    }    

    wp_enqueue_style( 'themesflat-responsive', THEMESFLAT_LINK . 'css/responsive.css' );

    // Load the main js    
    wp_enqueue_script( 'themesflat-main', THEMESFLAT_LINK . 'js/main.js', array(),'2.0.4',true);

}

add_action( 'wp_enqueue_scripts', 'themesflat_scripts' );


/**
 * Enqueue Bootstrap
 */
function themesflat_enqueue_bootstrap() {
    wp_enqueue_style( 'bootstrap', THEMESFLAT_LINK . 'css/bootstrap.css', array(), true );
}
add_action( 'wp_enqueue_scripts', 'themesflat_enqueue_bootstrap', 9 );

// Customizer additions.
require THEMESFLAT_DIR . 'inc/customizer.php';

// Helpers
require THEMESFLAT_DIR . 'inc/helpers.php';

// Struct
require THEMESFLAT_DIR . 'inc/structure.php';

// Breadcrumbs additions.
require THEMESFLAT_DIR . 'inc/breadcrumb.php';

// Custom template tags for this theme.
require THEMESFLAT_DIR . 'inc/template-tags.php';

// Custom Sidebar Dynamic for this theme.
require THEMESFLAT_DIR . 'inc/sidebar_manage.php';

// Style.
require THEMESFLAT_DIR . 'inc/styles.php';

// Required plugins
require_once THEMESFLAT_DIR . 'inc/plugins/class-tgm-plugin-activation.php';

// Plugin Activation
require_once THEMESFLAT_DIR . 'inc/plugins/plugins.php';

require THEMESFLAT_DIR . "inc/options/options-definition.php";
require_once( THEMESFLAT_DIR . 'inc/options/controls/social_icons.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/number.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/dropdown-sidebars.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/dropdown-pages.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/box-control.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/typography.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/radio-images.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/check-box.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/color_overlay.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/multi-images.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/styler_slider.php');
require_once( THEMESFLAT_DIR . 'inc/options/controls/draganddrop-controls.php');
require_once( THEMESFLAT_DIR . 'inc/elementor-options/elementor-options.php');
require_once( THEMESFLAT_DIR . 'inc/elementor-options/elementor-functions.php');
require_once( THEMESFLAT_DIR . 'demo/import-demo.php');


// Load Customizer Style
function themesflat_load_customizer_style() { 
    wp_enqueue_style( 'plugin-install' ); 
    wp_register_style('themesflat-customizer', THEMESFLAT_LINK .'css/admin/customizer.min.css', false, '1.0.0' );
    wp_enqueue_style('themesflat-customizer' ); 
    wp_enqueue_style( 'icon-dreamhome', THEMESFLAT_LINK . 'css/icon-dreamhome.css' );
    wp_enqueue_style( 'icon-dreamhome2', THEMESFLAT_LINK . 'css/icon-dreamhome2.css' );
    wp_enqueue_style('themesflat-alpha-color-picker', THEMESFLAT_LINK .'css/admin/alpha-color-picker.min.css', false, '1.0.0' );    
    wp_enqueue_script('jquery-ui');
    wp_enqueue_script('themesflat-alpha-color-picker', THEMESFLAT_LINK . 'js/admin/alpha-color-picker.min.js', array('wp-color-picker'),'2.1.2',true);
    wp_enqueue_script('themesflat-customizer', THEMESFLAT_LINK .'js/admin/customizer.min.js', array( 'jquery','customize-preview' ), '', true );
    wp_enqueue_script('themesflat-multi-image', THEMESFLAT_LINK . 'js/admin/multi-image.min.js', array('jquery','customize-preview'),'', true );
    wp_enqueue_script( 'wp-plupload' );
}
add_action( 'customize_controls_enqueue_scripts', 'themesflat_load_customizer_style' );
add_action( 'admin_enqueue_scripts', 'themesflat_load_customizer_style' ); 

// Load Admin Style
function themesflat_load_admin_style() {
    wp_enqueue_style( 'themesflat-admin', THEMESFLAT_LINK .'css/admin/admin.css', false, '1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'themesflat_load_admin_style', 999 );

// rewritebase wpml
function themesflat_fix_rewritebase($rules){
    $home_root = parse_url(home_url());
    if ( isset( $home_root['path'] ) ) {
        $home_root = trailingslashit($home_root['path']);
    } else {
        $home_root = '/';
    }
 
    $wpml_root = parse_url(get_option('home'));
    if ( isset( $wpml_root['path'] ) ) {
        $wpml_root = trailingslashit($wpml_root['path']);
    } else {
        $wpml_root = '/';
    }
 
    $rules = str_replace("RewriteBase $home_root", "RewriteBase $wpml_root", $rules);
    $rules = str_replace("RewriteRule . $home_root", "RewriteRule . $wpml_root", $rules);
 
    return $rules;
}
add_filter('mod_rewrite_rules', 'themesflat_fix_rewritebase');