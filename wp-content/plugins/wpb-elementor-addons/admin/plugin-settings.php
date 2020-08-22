<?php

// don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * WordPress settings API class
 */

if ( !class_exists('WPB_EA_Plugin_Settings' ) ):
class WPB_EA_Plugin_Settings {

    private $settings_api;

    function __construct() {
        $this->settings_api = new WPB_EA_WeDevs_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        
        add_submenu_page( 
	        'wpb-ea-about', 
	        esc_html__( 'WPB Elementor Addons Settings', 'wpb-elementor-addons' ),
	        esc_html__( 'Settings', 'wpb-elementor-addons' ),
	        apply_filters( 'wpb_ea_admin_user_role', 'manage_options' ),
	        'wpb_ea_settings',
	        array( $this, 'plugin_page' )
	    );
    }

    function get_settings_sections() {

        $sections = apply_filters( 'wpb_ea_settings_sections', array(
            array(
                'id'        => 'wpb_ea_addons',
                'title'     => esc_html__( 'Elements', 'wpb-elementor-addons' ),
                'addons'    => true,
                'icon'      => 'dashicons dashicons-admin-tools',
            ),
            array(
                'id'        => 'wpb_ea_style',
                'title'     => esc_html__( 'Style Settings', 'wpb-elementor-addons' ),
                'icon'      => 'dashicons dashicons-admin-site-alt3',
            ),
        ) );

        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {

        $settings_fields = apply_filters( 'wpb_ea_settings_fields', array(
            'wpb_ea_addons' => apply_filters( 'wpb_ea_required_addons', array(
                array(
                    'name'      => WPB_EA_PREFIX . 'basic_addons',
                    'label'     => esc_html__( 'Mostly Used Elements', 'wpb-elementor-addons' ),
                    'type'      => 'section_title',
                ),
                array(
                    'name'      => WPB_EA_PREFIX . 'content_box',
                    'label'     => esc_html__( 'Content Box', 'wpb-elementor-addons' ),
                    'desc'      => esc_html__( 'Content Box Grid/Slider can present any static content with an image.', 'wpb-elementor-addons' ),
                    'icon'      => 'eicon-type-tool',
                    'type'      => 'toggle',
                    'default'   => 'on',
                ),
                array(
                    'name'      => WPB_EA_PREFIX . 'counter',
                    'label'     => esc_html__( 'Counter Up', 'wpb-elementor-addons' ),
                    'desc'      => esc_html__( 'Counter Up can show your statics in a nice counter.', 'wpb-elementor-addons' ),
                    'icon'      => 'eicon-counter',
                    'type'      => 'toggle',
                    'default'   => 'on',
                ),
                array(
                    'name'      => WPB_EA_PREFIX . 'fancy_list',
                    'label'     => esc_html__( 'Fancy List', 'wpb-elementor-addons' ),
                    'desc'      => esc_html__( 'Fancy List can show your list items in a beautiful way.', 'wpb-elementor-addons' ),
                    'icon'      => 'eicon-editor-list-ul',
                    'type'      => 'toggle',
                    'default'   => 'on',
                ),
                array(
                    'name'      => WPB_EA_PREFIX . 'image_gallery',
                    'label'     => esc_html__( 'Filterable Image Gallery', 'wpb-elementor-addons' ),
                    'desc'      => esc_html__( 'Filterable Image Gallery to showcase your images with filtering options.', 'wpb-elementor-addons' ),
                    'icon'      => 'eicon-gallery-grid',
                    'type'      => 'toggle',
                    'default'   => 'on',
                ),
                array(
                    'name'      => WPB_EA_PREFIX . 'logo_slider',
                    'label'     => esc_html__( 'Logo Slider', 'wpb-elementor-addons' ),
                    'desc'      => esc_html__( 'Logo Slider can showcase your sponsors/featured logos in a slider.', 'wpb-elementor-addons' ),
                    'icon'      => 'eicon-logo',
                    'type'      => 'toggle',
                    'default'   => 'on',
                ),
                array(
                    'name'      => WPB_EA_PREFIX . 'news_ticker',
                    'label'     => esc_html__( 'News Ticker', 'wpb-elementor-addons' ),
                    'desc'      => esc_html__( 'This news ticker can scroll/slide content in a different style.', 'wpb-elementor-addons' ),
                    'icon'      => 'eicon-document-file',
                    'type'      => 'toggle',
                    'default'   => 'on',
                ),
                array(
                    'name'      => WPB_EA_PREFIX . 'post_grid_slider',
                    'label'     => esc_html__( 'Post Grid and Slider', 'wpb-elementor-addons' ),
                    'desc'      => esc_html__( 'Post Grid/Slider that displays any post types posts in a nice grid or slider.', 'wpb-elementor-addons' ),
                    'icon'      => 'eicon-posts-grid',
                    'type'      => 'toggle',
                    'default'   => 'on',
                ),
                array(
                    'name'      => WPB_EA_PREFIX . 'pricing_tables',
                    'label'     => esc_html__( 'Pricing Table', 'wpb-elementor-addons' ),
                    'desc'      => esc_html__( 'Pricing Table to increases your sales.', 'wpb-elementor-addons' ),
                    'icon'      => 'eicon-price-table',
                    'type'      => 'toggle',
                    'default'   => 'on',
                ),
                array(
                    'name'      => WPB_EA_PREFIX . 'service_box',
                    'label'     => esc_html__( 'Service Box', 'wpb-elementor-addons' ),
                    'desc'      => esc_html__( 'Service Box for showing your offer for your customers.', 'wpb-elementor-addons' ),
                    'icon'      => 'eicon-editor-italic',
                    'type'      => 'toggle',
                    'default'   => 'on',
                ),
                array(
                    'name'      => WPB_EA_PREFIX . 'slider',
                    'label'     => esc_html__( 'Hero Slider', 'wpb-elementor-addons' ),
                    'desc'      => esc_html__( 'Hero Slider can show a slideshow of images, contents and buttons.', 'wpb-elementor-addons' ),
                    'icon'      => 'eicon-slideshow',
                    'type'      => 'toggle',
                    'default'   => 'on',
                ),
                array(
                    'name'      => WPB_EA_PREFIX . 'team_members',
                    'label'     => esc_html__( 'Team Members', 'wpb-elementor-addons' ),
                    'desc'      => esc_html__( 'Team Members Grid/Slider for showing all of your team members.', 'wpb-elementor-addons' ),
                    'icon'      => 'eicon-person',
                    'type'      => 'toggle',
                    'default'   => 'on',
                ),
                array(
                    'name'      => WPB_EA_PREFIX . 'testimonials',
                    'label'     => esc_html__( 'Clients Testimonials', 'wpb-elementor-addons' ),
                    'desc'      => esc_html__( 'Testimonials Grid/Slider can show your clients feedbacks.', 'wpb-elementor-addons' ),
                    'icon'      => 'eicon-testimonial-carousel',
                    'type'      => 'toggle',
                    'default'   => 'on',
                ),
                array(
                    'name'      => WPB_EA_PREFIX . 'video_popup',
                    'label'     => esc_html__( 'Video Popup', 'wpb-elementor-addons' ),
                    'desc'      => esc_html__( 'Video Popup that displays a video in a popup, can be used for video call to action.', 'wpb-elementor-addons' ),
                    'icon'      => 'eicon-play',
                    'type'      => 'toggle',
                    'default'   => 'on',
                ),
                array(
                    'name'      => WPB_EA_PREFIX . 'timeline',
                    'label'     => esc_html__( 'Content Timeline', 'wpb-elementor-addons' ),
                    'desc'      => esc_html__( 'Content Timeline to show any type of content in a timeline. Support for image, iframe, ShortCode, icon, date etc.', 'wpb-elementor-addons' ),
                    'icon'      => 'eicon-time-line',
                    'type'      => 'toggle',
                    'default'   => 'on',
                ),
                array(
                    'name'      => WPB_EA_PREFIX . 'videos_grid',
                    'label'     => esc_html__( 'Videos Grid', 'wpb-elementor-addons' ),
                    'desc'      => esc_html__( 'Videos Grid with title, content, and details link and self-hosted/ YouTube Videos.', 'wpb-elementor-addons' ),
                    'icon'      => 'eicon-youtube',
                    'type'      => 'toggle',
                    'default'   => 'on',
                ),

            ) ),

            'wpb_ea_style' => array(
                array(
                    'name'      => 'wpb_ea_primary_color',
                    'label'     => esc_html__( 'Primary color', 'wpb-elementor-addons' ),
                    'desc'      => esc_html__( 'Select your primary color. Default: #3878ff', 'wpb-elementor-addons' ),
                    'type'      => 'color',
                    'default'   => '#3878ff'
                ),
                array(
                    'name'      => 'wpb_ea_primary_color_light',
                    'label'     => esc_html__( 'Primary color light', 'wpb-elementor-addons' ),
                    'desc'      => esc_html__( 'Select your primary color. Default: #7ca6ff', 'wpb-elementor-addons' ),
                    'type'      => 'color',
                    'default'   => '#7ca6ff'
                ),
                array(
                    'name'      => 'wpb_ea_primary_color_dark',
                    'label'     => esc_html__( 'Primary color dark', 'wpb-elementor-addons' ),
                    'desc'      => esc_html__( 'Select your primary color. Default: #004dcb', 'wpb-elementor-addons' ),
                    'type'      => 'color',
                    'default'   => '#004dcb'
                ),
            )
            
        ) );

        return $settings_fields;
    }

    function plugin_page() {
        if ( isset( $_GET['settings-updated'] ) ) {
            printf( '<div class="updated"><p>%s</p></div>', esc_html__( 'Plugin settings updated successfully', 'wpb-elementor-addons' ) );
        }

        $count = count( $this->get_settings_sections() );
        if( $count <= 1 ){
            $class = 'wpb-ea-settings-sections-no';
        }else{
            $class = 'wpb-ea-settings-sections-yes';
        }

        echo '<div class="wpb-wrap about-wrap wpb-ea-settings-wrap '. esc_attr( $class ) .'">';
        
        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;


new WPB_EA_Plugin_Settings();


//--------- trigger setting api class---------------- //



function wpb_ea_get_option( $option, $section, $default = '' ) {
 
    $options = get_option( $section );

    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }
 
    return $default;
}

