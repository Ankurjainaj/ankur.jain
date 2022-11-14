<?php

/**
 * Plugin: WPB Elementor Addons
 *
 * Author: WpBean
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 


/**
 * Front End Scripts
 */

function wpb_ea_register_scripts(){

    $load_line_icons = apply_filters( 'wpb_ea_load_line_icons', 'on' );

	wp_enqueue_style('wpb-ea-bootstrap-grid', plugins_url('../assets/css/grid.min.css', __FILE__ ), '', '4.0.0', false);
	wp_enqueue_style('wpb-ea-owl-carousel', plugins_url('../assets/css/owl.carousel.css', __FILE__ ), '', '2.3.4', false);
	wp_enqueue_style('fancybox', plugins_url('../assets/css/jquery.fancybox.min.css', __FILE__ ), '', '3.0.47', false);
    if($load_line_icons == 'on'){
        wp_enqueue_style('wpb-lineicons-css', plugins_url('../assets/icons/lineicons/lineicons.min.css', __FILE__ ), '', '1.0', false);
    }
	wp_enqueue_style('wpb_ea_main_css', plugins_url('../assets/css/main.css', __FILE__ ), '', '1.0', false);
	if( is_rtl() ){
		wp_enqueue_style( 'wpb-ea-rtl', plugins_url('../assets/css/wpb-ea-rtl.css', __FILE__ ), '', '1.0', false );
	}    
}
add_action( 'wp_enqueue_scripts', 'wpb_ea_register_scripts' ); 


/**
 * Admin Scripts
 */

function wpb_ea_register_admin_scripts(){

    wp_register_style('wpb-ea-settings', plugins_url('../admin/assets/css/settings.css', __FILE__ ), '', '1.0', false);

    $screen = get_current_screen();

    if( is_object($screen) ){
        if( $screen->base == 'toplevel_page_wpb-ea-about' || $screen->base == 'wpb-ea-addons_page_wpb_ea_settings' || $screen->base == 'wpb-ea-addons_page_wpb_woo_ea_settings'){
            wp_enqueue_style('wpb-ea-settings');
        }
    }
}
add_action( 'admin_enqueue_scripts', 'wpb_ea_register_admin_scripts' ); 


/**
 * Register CSS for Elementor frontend
 */

add_action( 'elementor/frontend/after_register_styles', function() {
    wp_register_style('breaking-news-ticker-css', plugins_url('../assets/css/breaking-news-ticker.css', __FILE__ ), '', '1.0', false); 
} );

/**
 * Enqueing CSS file for Elementor live preview
 */

add_action( 'elementor/preview/enqueue_styles', function() {
    wp_enqueue_style( 'breaking-news-ticker-css' );
} );



/**
 * Add  WPB EA essential scripts
 */
class WPB_Elementor_Plugin {

    /**
     * Instance
     *
     * @since 1.2.0
     * @access private
     * @static
     *
     * @var Plugin The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.2.0
     * @access public
     *
     * @return Plugin An instance of the class.
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * widget_scripts
     *
     * Load required plugin core files.
     *
     * @since 1.2.0
     * @access public
     */
    public function widget_scripts() {
        wp_register_script('wpb-ea-counterup', plugins_url('../assets/js/jquery.counterup.min.js', __FILE__ ), array('jquery'), '1.0', true); 
        wp_register_script('wpb-ea-waypoints', plugins_url('../assets/js/waypoints.min.js', __FILE__ ), array('jquery'), '1.6.2', true); 
        wp_register_script('wpb-ea-owl-carousel', plugins_url('../assets/js/owl.carousel.min.js', __FILE__ ), array('jquery'), '2.3.4', true);  
        wp_register_script('isotope', plugins_url('../assets/js/isotope.pkgd.js', __FILE__ ), array('jquery'), '3.0.1', true);          
        wp_register_script('fancybox', plugins_url('../assets/js/jquery.fancybox.min.js', __FILE__ ), array('jquery'), '3.0.47', true); 
        wp_register_script( 'breaking-news-ticker', plugins_url( '../assets/js/breaking-news-ticker.min.js', __FILE__ ), [ 'jquery' ], false, true );
        wp_register_script('wpb-ea-super-js', plugins_url( '../assets/js/super.js', __FILE__ ), [ 'jquery' ], '1.0', true ); 
    }

    /**
     *  Plugin class constructor
     *
     * Register plugin action hooks and filters
     *
     * @since 1.2.0
     * @access public
     */
    public function __construct() {
        // Register widget scripts
        add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
    }
}

// Instantiate Plugin Class
WPB_Elementor_Plugin::instance();



/**
 * Add custom CSS
 */
if(!function_exists('wpb_ea_add_inline_styles')){
    function wpb_ea_add_inline_styles() {
    
        $wpb_ea_primary_color = wpb_ea_get_option( 'wpb_ea_primary_color', 'wpb_ea_style', '#3878ff' );

        $custom_css = ''; 

        $custom_css .= "
        .wpb-ea-team-member .social-buttons,
        .wpb-ea-service-box-image .wpb-ea-service-box-btn:hover {
            background: {$wpb_ea_primary_color};
        }
        .wpb-ea-service-box-icon .wpb-ea-service-box-btn:hover {
            color: {$wpb_ea_primary_color};
        }
        .wpb-ea-service-box-image .wpb-ea-service-box-btn:hover {
            border-color: {$wpb_ea_primary_color};
        }
        ";

        wp_add_inline_style( 'wpb_ea_main_css', $custom_css );

    }
}
add_action( 'wp_enqueue_scripts', 'wpb_ea_add_inline_styles' );