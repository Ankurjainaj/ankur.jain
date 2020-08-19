<?php
/**
 * Plugin Name:       WPB Elementor Addons
 * Plugin URI:        https://wpbean.com/
 * Description:       Highly customizable addons for Elementor page builder. 
 * Version:           1.0.7.6
 * Author:            wpbean
 * Author URI:        https://wpbean.com
 * Text Domain:       wpb-elementor-addons
 * Domain Path:       /languages
 *
 * WC requires at least: 3.5
 * WC tested up to: 4.3.1
 */


// don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;


// Define WPB_EA_Version.
if ( ! defined( 'WPB_EA_Version' ) ) {
	define( 'WPB_EA_Version', '1.0.7.6' );
}

// Define WPB_EA_URL.
if ( ! defined( 'WPB_EA_URL' ) ) {
	define( 'WPB_EA_URL', plugins_url( '/', __FILE__ ) );
}

// Define WPB_EA_PATH.
if ( ! defined( 'WPB_EA_PATH' ) ) {
	define( 'WPB_EA_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
}

// Define WPB_EA_PREFIX.
if ( ! defined( 'WPB_EA_PREFIX' ) ) {
    define( 'WPB_EA_PREFIX', 'wpb_ea_' );
}

/**
 * Plugin main class
 */

class WPB_Elementor_Addons {

    /**
     * The plugin path
     *
     * @var string
     */
    public $plugin_path;


    /**
     * The theme directory path
     *
     * @var string
     */
    public $theme_dir_path;


    /**
     * Initializes the WPB_Elementor_Addons() class
     *
     * Checks for an existing WPB_Elementor_Addons() instance
     * and if it doesn't find one, creates it.
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new WPB_Elementor_Addons();

            $instance->plugin_init();
        }

        return $instance;
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    function plugin_init() {
    	$this->theme_dir_path = add_filter( 'wpb_elementor_addons_dir_path', 'wpb-elementor-addons/' );

    	$this->file_includes();

        add_action( 'init', array( $this, 'localization_setup' ) );
        add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'plugin_actions_links' ));
        add_action( 'admin_notices', array( $this, 'wpb_ea_check_elementor_installed' ) );
    }


    /**
     * Load the required files
     *
     * @return void
     */
    function file_includes() {
        require_once dirname( __FILE__ ) . '/inc/wpb_functions.php';
        require_once dirname( __FILE__ ) . '/inc/wpb_scripts.php';
        require_once dirname( __FILE__ ) . '/admin/admin-page.php';
        require_once dirname( __FILE__ ) . '/admin/class.settings-api.php';
        require_once dirname( __FILE__ ) . '/admin/plugin-settings.php';
    }


    /**
     * Plugin action links
     */
    
    function plugin_actions_links( $links ) {
        if( is_admin() ){
            $links[] = '<a href="https://wpbean.com/support/" target="_blank">'. esc_html__( 'Support', 'wpb-elementor-addons' ) .'</a>';
            $links[] = '<a href="http://docs.wpbean.com/docs/wpb-ea-elementor-addons/" target="_blank">'. esc_html__( 'Documentation', 'wpb-elementor-addons' ) .'</a>';
        }
        return $links;
    }

    /**
     * Initialize plugin for localization
     *
     * @uses load_plugin_textdomain()
     */
    public function localization_setup() {
        load_plugin_textdomain( 'wpb-elementor-addons', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }


    /**
     * Check Elementor Installed
     */
    
    function wpb_ea_check_elementor_installed(){
    	if ( !is_plugin_active( 'elementor/elementor.php' ) ) {
    		printf( '<div class="notice notice-warning is-dismissible"><p>%s</p></div>', esc_html__( 'This plugin required Elementor Page Builder installed to function.', 'wpb-elementor-addons' ) );
    	}
    }


    /**
     * Get the plugin path.
     *
     * @return string
     */
    public function plugin_path() {
        if ( $this->plugin_path ) return $this->plugin_path;

        return $this->plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ) );
    }

    /**
     * Get the template path.
     *
     * @return string
     */
    public function template_path() {
        return $this->plugin_path() . '/templates/';
    }

}

/**
 * Initialize the plugin
 */

function wpb_elementor_addons() {
    if( defined('ELEMENTOR_VERSION') ){
        return WPB_Elementor_Addons::init();
    }else{
        add_action( 'admin_notices', 'wpb_ea_admin_notice__error' );
    }
}

// kick it off
wpb_elementor_addons();


/**
 * Admin Notice
 */

function wpb_ea_admin_notice__error() {
    $class      = 'notice notice-warning';
    $message    = esc_html__( 'WPB Elementor Addons requires the Elementor plugin.', 'wpb-elementor-addons' );
    
    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
}