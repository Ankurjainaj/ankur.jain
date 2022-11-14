<?php
/**
 * @author  WpBean
 * @version 1.0
 */

namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class WPB_EA_Widget_Testimonial extends Widget_Base {

    public function get_name() {
        return 'wpb-ea-testimonial';
    }

    public function get_title() {
        return esc_html__( 'WPB Testimonial', 'wpb-elementor-addons' );
    }

    public function get_icon() {
        return 'eicon-testimonial-carousel';
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
        $wpb_ea_primary_color = wpb_ea_get_option( 'wpb_ea_primary_color', 'wpb_ea_style', '#3878ff' );

        // testimonial section
        $this->start_controls_section(
            'wpb_ea_testimonial',
            [
                'label' => esc_html__( 'Testimonials', 'wpb-elementor-addons' )
            ]
        );

        // testimonial conent type
        $this->add_control(
            'wpb_ea_testimonial_content_type',
            [
                'label'     => esc_html__( 'Content Type', 'wpb-elementor-addons' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'slider',
                'options'   => [
                    'slider'        => esc_html__( 'Slider',   'wpb-elementor-addons' ),
                    'grid'          => esc_html__( 'Grid', 'wpb-elementor-addons' )
                ],
                'separator' =>  'after'
            ]
        );

        // testimonial field options
        $this->add_control(
            'wpb_ea_testimonial_items',
            [
                'label'         => esc_html__('Testimonial Items', 'wpb-elementor-addons'),
                'type'          => Controls_Manager::REPEATER,
                'default'       => [
                    [
                        'wpb_ea_testimonial_title'                  => esc_html__( 'Professional Team', 'wpb-elementor-addons' ),
                        'wpb_ea_testimonial_content'                => esc_html__( 'Nullam a ultrices ex, quis finibus neque. Etiam facilisis consectetur ante ac bibendum. Sed pretium lacinia sollicitudin.', 'wpb-elementor-addons' ),
                        'wpb_ea_testimonial_client_name'            => esc_html__( 'John Doe', 'wpb-elementor-addons' ),
                        'wpb_ea_testimonial_client_designation'     => esc_html__( 'Developer', 'wpb-elementor-addons' ),
                        'wpb_ea_testimonial_client_company'         => esc_html__( 'ABC Company', 'wpb-elementor-addons' )
                    ],
                    [
                        'wpb_ea_testimonial_title'                  => esc_html__( 'Awesome Support', 'wpb-elementor-addons' ),
                        'wpb_ea_testimonial_content'                => esc_html__( 'Nullam a ultrices ex, quis finibus neque. Etiam facilisis consectetur ante ac bibendum. Sed pretium lacinia sollicitudin.', 'wpb-elementor-addons' ),
                        'wpb_ea_testimonial_client_name'            => esc_html__( 'Aaron Sylvester', 'wpb-elementor-addons' ),
                        'wpb_ea_testimonial_client_designation'     => esc_html__( 'Designer', 'wpb-elementor-addons' ),
                        'wpb_ea_testimonial_client_company'         => esc_html__( 'Romp', 'wpb-elementor-addons' )
                    ],
                    [
                        'wpb_ea_testimonial_title'                  => esc_html__( 'Excellenet Service', 'wpb-elementor-addons' ),
                        'wpb_ea_testimonial_content'                => esc_html__( 'Nullam a ultrices ex, quis finibus neque. Etiam facilisis consectetur ante ac bibendum. Sed pretium lacinia sollicitudin.', 'wpb-elementor-addons' ),
                        'wpb_ea_testimonial_client_name'            => esc_html__( 'Sherry Hernandez', 'wpb-elementor-addons' ),
                        'wpb_ea_testimonial_client_designation'     => esc_html__( 'C.E.O', 'wpb-elementor-addons' ),
                        'wpb_ea_testimonial_client_company'         => esc_html__( 'Ransohoffs', 'wpb-elementor-addons' )
                    ]
                ],
                'fields' => [
                    [
                        'name'              => 'wpb_ea_testimonial_title',
                        'label'             => esc_html__( 'Title', 'wpb-elementor-addons' ),
                        'type'              => Controls_Manager::TEXT,
                        'placeholder'       => esc_html__( 'Testimonial Title', 'wpb-elementor-addons' ),       
                        'default'           => esc_html__( 'Professional Team', 'wpb-elementor-addons' )          
                    ],  
                    [
                        'name'              => 'wpb_ea_testimonial_content',
                        'label'             => esc_html__( 'Content', 'wpb-elementor-addons' ),
                        'type'              => Controls_Manager::TEXTAREA,
                        'placeholder'       => esc_html__( 'Testimonial Details.', 'wpb-elementor-addons' ),       
                        'default'           => esc_html__( 'Nullam a ultrices ex, quis finibus neque. Etiam facilisis consectetur ante ac bibendum. Sed pretium lacinia sollicitudin.', 'wpb-elementor-addons' )             
                    ], 
                    [
                        'name'              => 'wpb_ea_testimonial_client_name',
                        'label'             => esc_html__( 'Name', 'wpb-elementor-addons' ),
                        'type'              => Controls_Manager::TEXT,
                        'placeholder'       => esc_html__( 'Client\'s Name', 'wpb-elementor-addons' ),       
                        'default'           => esc_html__( 'John Doe', 'wpb-elementor-addons' )        
                    ],  
                    [
                        'name'              => 'wpb_ea_testimonial_client_designation',
                        'label'             => esc_html__( 'Designation', 'wpb-elementor-addons' ),
                        'type'              => Controls_Manager::TEXT,
                        'placeholder'       => esc_html__( 'Client\'s Designation', 'wpb-elementor-addons' ),       
                        'default'           => esc_html__( 'Developer', 'wpb-elementor-addons' )            
                    ], 
                    [
                        'name'              => 'wpb_ea_testimonial_client_company',
                        'label'             => esc_html__( 'Company', 'wpb-elementor-addons' ),
                        'type'              => Controls_Manager::TEXT,
                        'placeholder'       => esc_html__( 'Client\'s Company', 'wpb-elementor-addons' ),       
                        'default'           => esc_html__( 'ABC Company', 'wpb-elementor-addons' )        
                    ],    
                    [
                        'name'          => 'image',
                        'label'         => esc_html__( 'Image', 'wpb-elementor-addons' ),
                        'type'          => Controls_Manager::MEDIA,
                        'default'       => []
                    ]                  
                ],
                'title_field' => '{{{ wpb_ea_testimonial_title }}}'              
            ]
        );

        // testimonial extra CSS heading
        $this->add_control(
            'wpb_ea_test_extra_css_heading',
            [
                'type'          => Controls_Manager::HEADING,
                'separator'     => 'before'
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

        /**
         * -------------------------------------------
         * testimonial settings tab starts here
         * -------------------------------------------
         */   
        
        /**
         * -------------------------------------------
         * testimonial item's carousel section
         * -------------------------------------------
         */    
        $this->start_controls_section(
            'wpb_ea_testimonial_carousel_settings',
            [
                'label'         => esc_html__('Carousel Settings', 'wpb-elementor-addons'),
                'tab'           => Controls_Manager::TAB_SETTINGS,
                'condition'     => [
                    '.wpb_ea_testimonial.wpb_ea_testimonial_content_type' => 'slider'
                ]
            ]
        );

        // show navigation?
        $this->add_control(
            'arrows',
            [
                'type'          => Controls_Manager::SWITCHER,
                'label'         => esc_html__( 'Show Prev/Next Arrows?', 'wpb-elementor-addons' ),
                'default'       => 'yes',
                'return_value'  => 'yes'
            ]
        );

        // show pagination?
        $this->add_control(
            'dots',
            [
                'type'          => Controls_Manager::SWITCHER,
                'label'         => esc_html__( 'Show dot indicators for navigation?', 'wpb-elementor-addons' ),
                'default'       => 'no',
                'return_value'  => 'yes'
            ]
        );

        // pause on hover?
        $this->add_control(
            'pause_on_hover',
            [
                'type'          => Controls_Manager::SWITCHER,
                'label'         => esc_html__( 'Pause on Hover?', 'wpb-elementor-addons' ),
                'default'       => 'no',
                'return_value'  => 'yes'
            ]
        );

        // slider autoplay?
        $this->add_control(
            'autoplay',
            [
                'type'          => Controls_Manager::SWITCHER,
                'label'         => esc_html__( 'Autoplay?', 'wpb-elementor-addons' ),
                'default'       => 'no',
                'return_value'  => 'yes',
                'description'   => esc_html__('Show the carousel autoplay as in a slideshow.', 'wpb-elementor-addons')
            ]
        );

        // slider loop?
        $this->add_control(
            'loop',
            [
                'type'          => Controls_Manager::SWITCHER,
                'label'         => esc_html__( 'Loop?', 'wpb-elementor-addons' ),
                'default'       => 'no',
                'return_value'  => 'yes',
                'description'   => esc_html__('Show the carousel loop as in a slideshow.', 'wpb-elementor-addons')
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
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-items-slider .wpb-ea-testimonial-item' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ]
            ]
        );   

        $this->end_controls_section();  

        /**
         * -------------------------------------------
         * testimonial item's responsive section
         * -------------------------------------------
         */  
        $this->start_controls_section(
            'section_responsive',
            [
                'label'         => esc_html__('Responsive Options', 'wpb-elementor-addons'),
                'tab'           => Controls_Manager::TAB_SETTINGS
            ]
        );

        $this->add_control(
            'heading_desktop',
            [
                'label'         => esc_html__( 'Desktop', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING            
            ]
        );

        // testimonial type grid desktop column
        $this->add_control(
            'testimonial_type_grid_desktop_column',
            [
                'label'     => esc_html__( 'Number of Columns', 'wpb-elementor-addons' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 3,
                'options'   => [
                    6           => esc_html__( '6 Columns', 'wpb-elementor-addons' ),
                    4           => esc_html__( '4 Columns', 'wpb-elementor-addons' ),
                    3           => esc_html__( '3 Columns', 'wpb-elementor-addons' ),
                    2           => esc_html__( '2 Columns', 'wpb-elementor-addons' ),
                    1           => esc_html__( '1 Columns', 'wpb-elementor-addons' )
                ],
                'condition'     => [
                    '.wpb_ea_testimonial.wpb_ea_testimonial_content_type' => 'grid'
                ]
            ]
        );  

        // number of items in desktop
        $this->add_control(
            'desktop_columns',
            [
                'label'         => esc_html__('Columns per row', 'wpb-elementor-addons'),
                'type'          => Controls_Manager::NUMBER,
                'min'           => 1,
                'max'           => 8,
                'step'          => 1,
                'default'       => 3,
                'condition'     => [
                    '.wpb_ea_testimonial.wpb_ea_testimonial_content_type' => 'slider'
                ]
            ]
        );

        $this->add_control(
            'small_heading_desktop',
            [
                'label'         => esc_html__( 'Desktop Small', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING,
                'separator'     => 'before',
                'condition'     => [
                    '.wpb_ea_testimonial.wpb_ea_testimonial_content_type' => 'slider'
                ]
            ]
        );

        // number of items in small desktop
        $this->add_control(
            'small_desktop_columns',
            [
                'label'         => esc_html__('Columns per row', 'wpb-elementor-addons'),
                'type'          => Controls_Manager::NUMBER,
                'min'           => 1,
                'max'           => 7,
                'step'          => 1,
                'default'       => 3,
                'condition'     => [
                    '.wpb_ea_testimonial.wpb_ea_testimonial_content_type' => 'slider'
                ]                
            ]
        );

        $this->add_control(
            'heading_tablet',
            [
                'label'         => esc_html__( 'Tablet', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING,
                'separator'     => 'before'
            ]
        );

        // number of items in tablet
        $this->add_control(
            'tablet_display_columns',
            [
                'label'         => esc_html__('Columns per row', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::NUMBER,
                'min'           => 1,
                'max'           => 5,
                'step'          => 1,
                'default'       => 2,
                'condition'     => [
                    '.wpb_ea_testimonial.wpb_ea_testimonial_content_type' => 'slider'
                ]                
            ]
        );

        // testimonial type grid tablet column
        $this->add_control(
            'testimonial_type_grid_tablet_column',
            [
                'label'         => esc_html__( 'Column', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 2,
                'options'       => [
                    6           => esc_html__( '6 Columns', 'wpb-elementor-addons' ),
                    4           => esc_html__( '4 Columns', 'wpb-elementor-addons' ),
                    3           => esc_html__( '3 Columns', 'wpb-elementor-addons' ),
                    2           => esc_html__( '2 Columns', 'wpb-elementor-addons' ),
                    1           => esc_html__( '1 Columns', 'wpb-elementor-addons' )
                ],
                'condition'     => [
                    '.wpb_ea_testimonial.wpb_ea_testimonial_content_type' => 'grid'
                ]   
            ]
        );

        $this->add_control(
            'heading_mobile',
            [
                'label'         => esc_html__( 'Mobile Phone', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING,
                'separator'     => 'before'
            ]
        );

        // number of items in mobile
        $this->add_control(
            'mobile_display_columns',
            [
                'label'         => esc_html__('Columns per row', 'wpb-elementor-addons'),
                'type'          => Controls_Manager::NUMBER,
                'min'           => 1,
                'max'           => 3,
                'step'          => 1,
                'default'       => 1,
                'condition'     => [
                    '.wpb_ea_testimonial.wpb_ea_testimonial_content_type' => 'slider'
                ]
            ]
        );

        $this->end_controls_section();  

        /**
         * -------------------------------------------
         * testimonial settings tab ends here
         * -------------------------------------------
         */   

        /**
         * -------------------------------------------
         * testimonial box style tab starts here
         * -------------------------------------------
         */ 

        /**
         * -------------------------------------------
         * testimonial box style
         * -------------------------------------------
         */

        $this->start_controls_section(
            'wpb_ea_testimonial_style_section',
            [
                'label'         => esc_html__('Testimonial Box Style', 'wpb-elementor-addons'),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );
        
        // testimonial background color
        $this->add_control(
            'wpb_ea_testimonial_bg_color',
            [
                'label'         => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::COLOR,             
                'default'       => '#ffffff',  
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-item' => 'background-color: {{VALUE}};'
                ]               
            ]
        );

        // testimonial padding
        $this->add_control(
            'wpb_ea_testimonial_padding',
            [
                'label'         => esc_html__( 'Padding', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        // testimonial margin
        $this->add_control(
            'wpb_ea_testimonial_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'default'       => [
                    'bottom'    => 30
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-items-grid .wpb-ea-testimonial-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'     => [
                    '.wpb_ea_testimonial.wpb_ea_testimonial_content_type' => 'grid'
                ]
            ]
        );

        // testimonial border type
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'wpb_ea_testimonial_border_type',
                'label'         => esc_html__( 'Border Type', 'wpb-elementor-addons' ),
                'selector'      => '{{WRAPPER}} .wpb-ea-testimonial-item'
            ]
        );       

        // testimonial border radius
        $this->add_control(
            'wpb_ea_testimonial_border_radius',
            [
                'label'         => esc_html__( 'Border Radius', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'        => [
                        'max'   => 50
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-item' => 'border-radius: {{SIZE}}px;',
                ]
            ]
        );

        // testimonial box shadow
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'wpb_ea_testimonial_box_shadow',
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-item'
                ]
            ]
        );

        // testimonial alignment
        $this->add_responsive_control(
            'wpb_ea_testimonial_align',
            [
                'label'         => esc_html__( 'Alignment', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::CHOOSE,
                'options'       => [
                    'left'      => [
                        'title' => esc_html__( 'Left', 'wpb-elementor-addons' ),
                        'icon'  => 'fa fa-align-left'
                    ],
                    'center'    => [
                        'title' => esc_html__( 'Center', 'wpb-elementor-addons' ),
                        'icon'  => 'fa fa-align-center'
                    ],
                    'right'     => [
                        'title' => esc_html__( 'Right', 'wpb-elementor-addons' ),
                        'icon'  => 'fa fa-align-right'
                    ],
                    'justify'   => [
                        'title' => esc_html__( 'Justified', 'wpb-elementor-addons' ),
                        'icon'  => 'fa fa-align-justify'
                    ]
                ],
                'default'       => 'center',
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-item' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * testimonial image style
         * -------------------------------------------
         */ 

        // testimonial image style
        $this->start_controls_section(
            'wpb_ea_testimonial_image_style',
            [
                'label'         => esc_html__('Image', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );

        // testimonial image enable(lightbox)
        $this->add_control(
            'wpb_ea_testimonial_image_lightbox_enable',
            [
                'label'        => esc_html__( 'Enale Lightbox', 'wpb-elementor-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes'
            ]
        );     

        // testimonial client image size
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'          => 'image_size',
                'label'         => esc_html__( 'Image Type', 'wpb-elementor-addons' ),
                'default'       => 'thumbnail'
            ]
        );

        // testimonial client image width
        $this->add_control(
            'wpb_ea_testimonial_image_width',
            [
                'label'         => esc_html__( 'Image Width', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 80
                ],
                'range'         => [
                    'px'        => [
                        'max'   => 150
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-item .client-details .client-image img' => 'max-width: {{SIZE}}px;'
                ]
            ]
        );         

        // testimonial image border color deep
        $this->add_control(
            'wpb_ea_testimonial_image_border_color_deep',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,     
                'label'         => esc_html__( 'Border Color( Deep )', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],                        
                'default'       => $wpb_ea_primary_color,  
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-item .client-details .client-image.default-border-style img' => 'border-bottom-color: {{VALUE}}; border-left-color: {{VALUE}};'
                ]               
            ]
        );

        // testimonial image border color deep
        $this->add_control(
            'wpb_ea_testimonial_image_border_color_light',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,     
                'label'         => esc_html__( 'Border Color( Light )', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],                        
                'default'       => '#e8e8e8',  
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-item .client-details .client-image.default-border-style img' => 'border-top-color: {{VALUE}}; border-right-color: {{VALUE}};'
                ],           
            ]
        );

        // testimonial image border radius
        $this->add_control(
            'wpb_ea_testimonial_image_border_radius_style',
            [
                'label'         => esc_html__( 'Border Radius', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 2
                    ],
                    '%'         => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 2
                    ],                    
                ],
                'size_units'    => [ 'px', '%' ],
                'default'       => [
                    'size'      => 100,
                    'unit'      => '%'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-item .client-details .client-image' => 'border-radius: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wpb-ea-testimonial-item .client-details .client-image img' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        // testimonial image box shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'wpb_ea_testimonial_image_box_shadow_style',
                'selector'      => '{{WRAPPER}} .wpb-ea-testimonial-item .client-details .client-image',
                'separator'     => ''
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * testimonial content style
         * -------------------------------------------
         */         
        $this->start_controls_section(
            'wpb_ea_testimonial_content_style',
            [
                'label'         => esc_html__('Content', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );

        // testimonial quotes icon style
        $this->add_control(
            'wpb_ea_testimonial_quotes_icon_style',
            [
                'label'         => esc_html__( 'Quote Icon', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING      
            ]
        );

        // testimonial quotes icon
        $this->add_control(
            'wpb_ea_testimonial_quotes_icon',
            [
                'type'          => \Elementor\Controls_Manager::ICONS,
                'default'       => [
                    'value' => 'fas fa-quote-left',
                    'library' => 'solid',
                ],
            ]
        );

        // testimonial quotes icon color
        $this->add_control(
            'wpb_ea_testimonial_quotes_icon_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],  
                'default'       => $wpb_ea_primary_color,                             
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-item .description .quote' => 'color: {{VALUE}};'
                ],
                'condition'     => [
                    'wpb_ea_testimonial_quotes_icon!' => ''
                ]                
            ]
        );

        // testimonial quotes icon typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_testimonial_quotes_icon_typography',
                'selector'      => '{{WRAPPER}} .wpb-ea-testimonial-item .description .quote',
                // font_family, font_size, font_weight, text_transform, font_style, text_decoration, line_height, letter_spacing
                'exclude' => [
                    'text_transform', 'font_family', 'font_weight', 'text_decoration'
                ],
                'condition'     => [
                    'wpb_ea_testimonial_quotes_icon!' => ''
                ]                               
            ]
        );

        // testimonial title style
        $this->add_control(
            'wpb_ea_testimonial_title_style',
            [
                'label'         => esc_html__( 'Title', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING,      
                'separator'     => 'before'      
            ]
        );

        // testimonial title color
        $this->add_control(
            'wpb_ea_testimonial_title_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],  
                'default'       => '#000000',                             
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-item .description h5.testimonial-title' => 'color: {{VALUE}};'
                ],
            ]
        );

        // testimonial title typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_testimonial_title_typography',
                'selector'      => '{{WRAPPER}} .wpb-ea-testimonial-item .description h5.testimonial-title',
            ]
        );

        // testimonial title margin
        $this->add_control(
            'wpb_ea_testimonial_title_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-item .description h5.testimonial-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        // testimonial title padding
        $this->add_control(
            'wpb_ea_testimonial_title_padding',
            [
                'label'         => esc_html__( 'Padding', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-item .description h5.testimonial-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        // testimonial content style
        $this->add_control(
            'wpb_ea_testimonial_content_text_style',
            [
                'label'         => esc_html__( 'Content', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING,
                'separator'     => 'before'
            ]
        );

        // testimonial content color
        $this->add_control(
            'wpb_ea_testimonial_content_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],  
                'default'       => '#777777',            
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-item .description p.testimonial-content' => 'color: {{VALUE}};'
                ]
            ]
        );

        // testimonial content typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_testimonial_content_typography',
                'selector'      => '{{WRAPPER}} .wpb-ea-testimonial-item .description p.testimonial-content'
            ]
        );

        // testimonial content margin
        $this->add_control(
            'wpb_ea_testimonial_content_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-item .description p.testimonial-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        // testimonial content padding
        $this->add_control(
            'wpb_ea_testimonial_content_padding',
            [
                'label'         => esc_html__( 'Padding', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-item .description p.testimonial-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        // testimonial name style
        $this->add_control(
            'wpb_ea_testimonial_name_style',
            [
                'label'         => esc_html__( 'Name', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING,
                'separator'     => 'before'
            ]
        );

        // testimonial name color
        $this->add_control(
            'wpb_ea_testimonial_name_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],  
                'default'       => '#000000',                             
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-item .client-details .client-info h6.client-name' => 'color: {{VALUE}};'
                ]
            ]
        );

        // testimonial name typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_testimonial_name_typography',
                'selector'      => '{{WRAPPER}} .wpb-ea-testimonial-item .client-details .client-info h6.client-name'
            ]
        );

        // testimonial name margin
        $this->add_control(
            'wpb_ea_testimonial_name_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-item .client-details .client-info h6.client-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        // testimonial name padding
        $this->add_control(
            'wpb_ea_testimonial_name_padding',
            [
                'label'         => esc_html__( 'Padding', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-item .client-details .client-info h6.client-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        // testimonial designation & company style
        $this->add_control(
            'wpb_ea_testimonial_desig_company_style',
            [
                'label'         => esc_html__( 'Designation and Company', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING,
                'separator'     => 'before'
            ]
        );

        // testimonial designation & company color
        $this->add_control(
            'wpb_ea_testimonial_desig_company_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],  
                'default'       => '#777',                             
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-item .client-details .client-info .client-desig-company' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wpb-ea-testimonial-item .client-details .client-info .company:before' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        // testimonial designation & company typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_testimonial_desig_company_typography',
                'selector'      => '{{WRAPPER}} .wpb-ea-testimonial-item .client-details .client-info .client-desig-company'
            ]
        );

        // testimonial designation & company margin
        $this->add_control(
            'wpb_ea_testimonial_desig_company_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-item .client-details .client-info .client-desig-company' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        // testimonial designation & company padding
        $this->add_control(
            'wpb_ea_testimonial_desig_company_padding',
            [
                'label'         => esc_html__( 'Padding', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-item .client-details .client-info .client-desig-company' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * testimonial carousel style
         * -------------------------------------------
         */ 
        $this->start_controls_section(
            'wpb_ea_testimonial_carousel_setting_style_options',
            [
                'label'         => esc_html__( 'Carousel', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    '.wpb_ea_testimonial.wpb_ea_testimonial_content_type' => 'slider'
                ]
            ]
        );  

        // navigation background color
        $this->add_control(
            'wpb_ea_testimonial_carousel_navigation_bg_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Navigation Background Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default'       => $wpb_ea_primary_color,
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-items-slider.owl-theme .owl-nav [class*=owl-]'      => 'background: {{VALUE}};'
                ],
                'condition'     => [
                    '.wpb_ea_testimonial_carousel_settings.arrows!' => ''
                ]                   
            ]
        );

        // navigation color
        $this->add_control(
            'wpb_ea_testimonial_carousel_navigation_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Navigation Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default'       => '#ffffff',
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-items-slider .owl-prev .fa' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wpb-ea-testimonial-items-slider .owl-next .fa' => 'color: {{VALUE}};'
                ],
                'condition'     => [
                    '.wpb_ea_testimonial_carousel_settings.arrows!' => ''
                ]
            ]
        );

        // pagination background color
        $this->add_control(
            'wpb_ea_testimonial_carousel_pagination_bg_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Pagination Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default'       => $wpb_ea_primary_color,
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-testimonial-items-slider.owl-theme .owl-dots .owl-dot span' => 'border-color: {{VALUE}}; background-color: {{VALUE}};'
                ],
                'condition'     => [
                    '.wpb_ea_testimonial_carousel_settings.dots!' => ''
                ]                
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * testimonial style tab ends here
         * -------------------------------------------
         */ 
    }

    // render image function
    private function render_image( $item, $settings ) {
        $image_id   = $item['image']['id'];
        $image_size = $settings['image_size_size'];
        if ( 'custom' === $image_size ) {
            $image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'image_size', $settings );
        } else {
            $image_src = wp_get_attachment_image_src( $image_id, $image_size );
            $image_src = $image_src[0];
        }

        return sprintf( '<img src="%s" alt="%s" />', esc_url($image_src), esc_html($item['wpb_ea_testimonial_client_name']) );
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $extra_css = $settings['extra_css'];
        if($extra_css){
            $extra_css = $extra_css.' ';
        }

        // slider attributes
        $stop                   = $settings['pause_on_hover'];
        $autoplay               = $settings['autoplay'];
        $loop                   = $settings['loop'];
        $slidergap              = $settings['slidergap']['size'];
        $items                  = $settings['desktop_columns'];
        $desktopsmall           = $settings['small_desktop_columns'];
        $tablet                 = $settings['tablet_display_columns'];
        $mobile                 = $settings['mobile_display_columns'];
        $navigation             = $settings['arrows'];
        $pagination             = $settings['dots'];        
        $slider_attr            = array(
            'data-stop'         => ( $stop == 'yes' ? 'true' : 'false' ),
            'data-loop'         => ( $loop == 'yes' ? 'true' : 'false' ),
            'data-autoplay'     => ( $autoplay == 'yes' ? 'true' : 'false' ),
            'data-slidergap'    => $slidergap,
            'data-items'        => $items,
            'data-desktopsmall' => $desktopsmall,
            'data-tablet'       => $tablet,
            'data-mobile'       => $mobile,
            'data-navigation'   => ( $navigation == 'yes' ? 'true' : 'false' ),
            'data-pagination'   => ( $pagination == 'yes' ? 'true' : 'false' ),
            'data-direction'    => ( is_rtl() ? 'true' : '' )
        );

        // testimonial type grid column options   
        if( $settings['wpb_ea_testimonial_content_type'] == 'grid' ){
            $grid_desktop_column = 12/$settings['testimonial_type_grid_desktop_column'];
            $grid_tablet_column  = 12/$settings['testimonial_type_grid_tablet_column'];
            $grid_column         = 'col-lg-'.esc_attr( $grid_desktop_column ). ' col-md-'.esc_attr( $grid_tablet_column ); 
        }   
        if( is_array( $settings['wpb_ea_testimonial_items'] ) ) : 
            echo '<div class="'.esc_attr($extra_css).'wpb-ea-testimonial-items-' . ( $settings['wpb_ea_testimonial_content_type'] == 'slider' ? 'slider owl-carousel owl-theme" '.wpb_ea_owl_carousel_data_attr_implode( $slider_attr ) : 'grid ea-row"' ).'>';           
                foreach ( $settings['wpb_ea_testimonial_items'] as $item ) : 
                    echo $settings['wpb_ea_testimonial_content_type'] == 'grid' ? '<div class="'.esc_attr($grid_column).'">' : '';
                        echo '<div class="wpb-ea-testimonial-item">';
                            echo '<div class="description">';
                                if( $settings['wpb_ea_testimonial_quotes_icon']['value'] ){
                                    echo '<span class="quote">';
                                        \Elementor\Icons_Manager::render_icon( $settings['wpb_ea_testimonial_quotes_icon'], [ 'aria-hidden' => 'true' ] );
                                    echo '</span>';
                                }
                                $item['wpb_ea_testimonial_title'] ? printf('<h5 class="testimonial-title">%s</h5>', esc_html($item['wpb_ea_testimonial_title']) ) : '';
                                $item['wpb_ea_testimonial_content'] ? printf('<p class="testimonial-content">%s</p>', wp_kses_post($item['wpb_ea_testimonial_content']) ) : ''; 
                            echo '</div>';
                            echo '<div class="client-details">';
                                if ( ! empty( $item['image']['url'] ) ) {
                                    if ( ( $settings['wpb_ea_testimonial_image_lightbox_enable'] == 'yes' ) ) { 
                                        echo '<a href="'.esc_url( $item['image']['url'] ).'" class="elementor-clickable">'; 
                                    }
                                    echo '<div class="client-image default-border-style">';
                                        echo $this->render_image( $item, $settings );
                                    echo '</div>';
                                    if ( $settings['wpb_ea_testimonial_image_lightbox_enable'] == 'yes' ){ 
                                        echo '</a>'; 
                                    }                                      
                                }
                                echo '<div class="client-info">';
                                    $item['wpb_ea_testimonial_client_name'] ? printf( '<h6 class="client-name">%s</h6>', esc_html($item['wpb_ea_testimonial_client_name']) ) : '';                            
                                    echo '<div class="client-desig-company">';
                                        $item['wpb_ea_testimonial_client_designation'] ? printf('<span class="designation">%s</span>', esc_html($item['wpb_ea_testimonial_client_designation']) ) : '';
                                        $item['wpb_ea_testimonial_client_company'] ? printf('<span class="company">%s</span>', esc_html($item['wpb_ea_testimonial_client_company']) ) : ''; 
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo $settings['wpb_ea_testimonial_content_type'] == 'grid' ? '</div>' : '';
                endforeach;
            echo '</div>';
        endif;
    }   
}

Plugin::instance()->widgets_manager->register_widget_type( new WPB_EA_Widget_Testimonial() );
