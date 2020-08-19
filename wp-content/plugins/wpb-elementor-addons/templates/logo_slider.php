<?php
/**
 * @author  WpBean
 * @version 1.0
 */

namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class WPB_EA_Widget_Logo_Slider extends Widget_Base {

    public function get_name() {
        return 'wpb-ea-logo-slider';
    }

    public function get_title() {
        return esc_html__( 'WPB Logo Slider', 'wpb-elementor-addons' );
    }

    public function get_icon() {
        return 'eicon-logo';
    }

    public function get_categories() {
        return [ 'wpb_ea_widgets' ];
    }

    /**
     * Retrieve the list of scripts the counter widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.3.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return [
            'wpb-ea-owl-carousel',
            'wpb-ea-super-js'
        ];
    }

    protected function _register_controls() {
        $wpb_ea_primary_color       = wpb_ea_get_option( 'wpb_ea_primary_color', 'wpb_ea_style', '#3878ff' );
        $wpb_ea_primary_color_light = wpb_ea_get_option( 'wpb_ea_primary_color_light', 'wpb_ea_style', '#7ca6ff' );
        $wpb_ea_primary_color_dark  = wpb_ea_get_option( 'wpb_ea_primary_color_dark', 'wpb_ea_style', '#004dcb' );

        $this->start_controls_section(
            'wpb_ea_logo_slider_section',
            [
                'label' => esc_html__( 'Logo Slider', 'wpb-elementor-addons' )
            ]
        );

        $this->add_control(
            'wpb_ea_logo_slider',
            [
                'label'     => esc_html__( 'Logos', 'wpb-elementor-addons' ),
                'type'      => Controls_Manager::REPEATER,
                'fields'    => [
                    [
                        'name'          => 'image',
                        'label'         => esc_html__( 'Image', 'wpb-elementor-addons' ),
                        'type'          => Controls_Manager::MEDIA,
                        'default'       => [],
                    ],            
                    [
                        'name'          => 'link_to',
                        'type'          => \Elementor\Controls_Manager::URL,
                        'label'         => esc_html__( 'Link to', 'wpb-elementor-addons' )
                    ],                 
                ],               
            ]
        );

        // extra CSS class
        $this->add_control(
            'extra_css',
            [   
                'label'         => esc_html__( 'Extra CSS clss', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::TEXT,
                'description'   => esc_html__('Put your extra CSS class if you need.', 'wpb-elementor-addons'),
                'placeholder'   => esc_html__( 'your-extra-css-class', 'wpb-elementor-addons' )
            ]
        );     

        $this->end_controls_section();

        $this->start_controls_section(
            'wpb_ea_logo_slider_carousel_settings',
            [
                'label'         => esc_html__('Carousel Settings', 'wpb-elementor-addons'),
                'tab'           => Controls_Manager::TAB_SETTINGS,
            ]
        );

        // enable(lightbox)
        $this->add_control(
            'wpb_ea_logo_slider_lightbox_enable',
            [
                'label'        => esc_html__( 'Enale Lightbox', 'wpb-elementor-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes',
                'description'  => esc_html__( 'If you enable lightbox then image link won\'t work.' , 'wpb-elementor-addons' ),
            ]
        );       

        $this->add_control(
            'arrows',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Show Prev/Next Arrows?', 'wpb-elementor-addons' ),
                'show_arrow'   => esc_html__( 'Show', 'wpb-elementor-addons' ),
                'hide_arrow'   => esc_html__( 'Hide', 'wpb-elementor-addons' ),
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'dots',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Show dot indicators for navigation?', 'wpb-elementor-addons' ),
                'show_dot'     => esc_html__( 'Show', 'wpb-elementor-addons' ),
                'hide_dot'     => esc_html__( 'Hide', 'wpb-elementor-addons' ),
                'default'      => 'no',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Pause on Hover?', 'wpb-elementor-addons' ),
                'pause_on'     => esc_html__( 'Yes', 'wpb-elementor-addons' ),
                'pause_off'    => esc_html__( 'No', 'wpb-elementor-addons' ),
                'default'      => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Autoplay?', 'wpb-elementor-addons' ),
                'autoplay_on'  => esc_html__( 'Yes', 'wpb-elementor-addons' ),
                'autoplay_off' => esc_html__( 'No', 'wpb-elementor-addons' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'description'  => esc_html__('Show the carousel autoplay as in a slideshow.', 'wpb-elementor-addons' ),
            ]
        );

        $this->add_control(
            'loop',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Loop?', 'wpb-elementor-addons' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'description'  => esc_html__('Show the carousel loop as in a slideshow.', 'wpb-elementor-addons' ),
            ]
        );

        // margin between two slider items
        $this->add_control(
            'slidergap',
            [
                'label'         => esc_html__('Gap between the slider items', 'wpb-elementor-addons'),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 30
                ],
                'range'         => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 300
                    ],
                ]
            ]
        );     

        // margin below the slider item
        $this->add_control(
            'slider_item_margin_bottom',
            [
                'label'         => esc_html__( 'Gap below the slider item', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::SLIDER,
                'range'         => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 300
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-logo-sliders .wpb-ea-client-logo' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ]
            ]
        ); 

        $this->end_controls_section();

        $this->start_controls_section(
            'section_responsive',
            [
                'label'         => esc_html__('Responsive Options', 'wpb-elementor-addons'),
                'tab'           => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $this->add_control(
            'heading_desktop',
            [
                'label'         => esc_html__( 'Desktop', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING,
                'separator'     => 'after',
            ]
        );

        $this->add_control(
            'desktop_columns',
            [
                'label'         => esc_html__('Columns per row', 'wpb-elementor-addons'),
                'type'          => Controls_Manager::NUMBER,
                'min'           => 1,
                'max'           => 8,
                'step'          => 1,
                'default'       => 5,
            ]
        );

        $this->add_control(
            'small_heading_desktop',
            [
                'label'         => esc_html__( 'Desktop', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING,
                'separator'     => 'after',
            ]
        );

        $this->add_control(
            'small_desktop_columns',
            [
                'label'         => esc_html__('Columns per row', 'wpb-elementor-addons'),
                'type'          => Controls_Manager::NUMBER,
                'min'           => 1,
                'max'           => 7,
                'step'          => 1,
                'default'       => 4,
            ]
        );

        $this->add_control(
            'heading_tablet',
            [
                'label'         => esc_html__( 'Tablet', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING,
                'separator'     => 'after',
            ]
        );

        $this->add_control(
            'tablet_display_columns',
            [
                'label'         => esc_html__('Columns per row', 'wpb-elementor-addons'),
                'type'          => Controls_Manager::NUMBER,
                'min'           => 1,
                'max'           => 5,
                'step'          => 1,
                'default'       => 3,
            ]
        );

        $this->add_control(
            'heading_mobile',
            [
                'label'         => esc_html__( 'Mobile Phone', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING,
                'separator'     => 'after',
            ]
        );

        $this->add_control(
            'mobile_display_columns',
            [
                'label'         => esc_html__('Columns per row', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::NUMBER,
                'min'           => 1,
                'max'           => 3,
                'step'          => 1,
                'default'       => 1,
            ]
        );

        $this->end_controls_section();

        // image style section
        $this->start_controls_section(
            'section_image_style',
            [
                'label'         => esc_html__( 'Image Style', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE,
                'show_label'    => false,
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'          => 'image_size',
                'label'         => esc_html__( 'Image Size', 'wpb-elementor-addons' ),
                'default'       => 'medium',
            ]
        );

        // logo image custom height?
        $this->add_control(
            'wpb_ea_logo_image_custom_image_height',
            [
                'label'         => esc_html__( 'Custom Height?', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,              
                'default'       => 'no',
                'return_value'  => 'yes'                       
            ]
        );

        // logo slider image height
        $this->add_control(
            'wpb_ea_logo_slider_image_height',
            [
                'label'         => esc_html__( 'Image height', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'        => [
                        'min'   => 1,
                        'max'   => 1000,
                        'step'  => 1
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-logo-sliders .wpb-ea-client-logo img' => 'height: {{SIZE}}{{UNIT}};',
                ],  
                'condition'     => [
                    '.wpb_ea_logo_image_custom_image_height' => 'yes'
                ]              
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * logo slider carousel style
         * -------------------------------------------
         */ 
        $this->start_controls_section(
            'wpb_ea_logo_slider_carousel_setting_style_options',
            [
                'label'         => esc_html__( 'Carousel', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );  

        // navigation background color
        $this->add_control(
            'wpb_ea_logo_slider_carousel_navigation_bg_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Navigation Background Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default'       => $wpb_ea_primary_color,
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-logo-sliders.owl-theme .owl-nav > button'      => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .wpb-ea-logo-sliders.owl-theme .owl-nav > button'      => 'background-color: {{VALUE}};',
                ],
                'condition'     => [
                    '.wpb_ea_logo_slider_carousel_settings.arrows!' => ''
                ]
            ]
        );

        // navigation hover background color
        $this->add_control(
            'wpb_ea_logo_slider_carousel_navigation_bg_hover_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Navigation Hover Background Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default'       => $wpb_ea_primary_color_dark,
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-logo-sliders.owl-theme .owl-nav > button:hover'      => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .wpb-ea-logo-sliders.owl-theme .owl-nav > button:focus'      => 'background-color: {{VALUE}};',
                ],
                'condition'     => [
                    '.wpb_ea_logo_slider_carousel_settings.arrows!' => ''
                ]
            ]
        );

        // navigation color
        $this->add_control(
            'wpb_ea_logo_slider_carousel_navigation_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Navigation Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default'       => '#fff',
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-logo-sliders.owl-theme .owl-nav i'      => 'color: {{VALUE}};',
                ],
                'condition'     => [
                    '.wpb_ea_logo_slider_carousel_settings.arrows!' => ''
                ]                
            ]
        );

        // pagination background color
        $this->add_control(
            'wpb_ea_logo_slider_carousel_pagination_bg_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Pagination Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default'       => $wpb_ea_primary_color,
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-logo-sliders.owl-theme .owl-dots .owl-dot span' => 'border-color: {{VALUE}}; background-color: {{VALUE}};'
                ],
                'condition'     => [
                    '.wpb_ea_logo_slider_carousel_settings.dots!' => ''
                ]                
            ]
        );

        $this->end_controls_section();        
    }
    
    // render image function
    private function render_image( $logo, $settings ) {
        $image_id = $logo['image']['id'];
        $image_size = $settings['image_size_size'];
        if ( 'custom' === $image_size ) {
            $image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'image_size', $settings );
        } else {
            $image_src = wp_get_attachment_image_src( $image_id, $image_size );
            $image_src = $image_src[0];
        }

        return sprintf( '<img src="%s"/>', esc_url($image_src) );
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $extra_css     = $settings['extra_css'];            
        $stop          = $settings['pause_on_hover'];
        $autoplay      = $settings['autoplay'];
        $loop          = $settings['loop'];
        $slidergap     = $settings['slidergap']['size'];
        $items         = $settings['desktop_columns'];
        $desktopsmall  = $settings['small_desktop_columns'];
        $tablet        = $settings['tablet_display_columns'];
        $mobile        = $settings['mobile_display_columns'];
        $navigation    = $settings['arrows'];
        $pagination    = $settings['dots'];

        $slider_attr = array(
            'data-stop'          => ( $stop == 'yes' ? 'true' : 'false' ),
            'data-loop'          => ( $loop == 'yes' ? 'true' : 'false' ),
            'data-autoplay'      => ( $autoplay == 'yes' ? 'true' : 'false' ),
            'data-slidergap'     => $slidergap,
            'data-items'         => $items,
            'data-desktopsmall'  => $desktopsmall,
            'data-tablet'        => $tablet,
            'data-mobile'        => $mobile,
            'data-navigation'    => ( $navigation == 'yes' ? 'true' : 'false' ),
            'data-pagination'    => ( $pagination == 'yes' ? 'true' : 'false' ),
            'data-direction'    => ( is_rtl() ? 'true' : '' )
        );

        if( is_array( $settings['wpb_ea_logo_slider'] ) ) : 
            echo '<div class="wpb-ea-logo-sliders owl-carousel owl-theme '. esc_attr($extra_css) .'"'.wpb_ea_owl_carousel_data_attr_implode( $slider_attr ) .'>';
                foreach ( $settings['wpb_ea_logo_slider'] as $logo ) {
                    echo '<div class="item">';
                        if ( ! empty( $logo['image']['url'] ) ) :

                            if ( $logo['link_to']['is_external'] === 'on' ) {
                                $target = 'target= _blank';
                            } else {
                                $target = '';
                            }
                            if ( $logo['link_to']['nofollow'] === 'on' ) {
                                $target .= ' rel= nofollow ';
                            } 

                            if ( ( $logo['link_to']['url'] ) && ( $settings['wpb_ea_logo_slider_lightbox_enable'] != 'yes' ) ) { 
                                echo '<a href="'.esc_url( $logo['link_to']['url'] ).'" '. esc_attr( $target ) .'>'; 
                            }

                            if ( ( $settings['wpb_ea_logo_slider_lightbox_enable'] == 'yes' ) ) { 
                                echo '<a href="'.esc_url( $logo['image']['url'] ).'" class="elementor-clickable">'; 
                            }

                            echo '<div class="wpb-ea-client-logo">' . $this->render_image( $logo, $settings ) . '</div>';

                            if ( ( $logo['link_to']['url'] ) || ( $settings['wpb_ea_logo_slider_lightbox_enable'] == 'yes' ) ) { 
                                echo '</a>'; 
                            }

                        endif;
                    echo '</div>';          
                } 
            echo '</div>';
        endif;
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new WPB_EA_Widget_Logo_Slider() );