<?php
/**
 * @author  WpBean
 * @version 1.0
 */

namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class WPB_EA_Widget_Content_Box extends Widget_Base {

	public function get_name() {
		return 'wpb-our-content-box';
	}

	public function get_title() {
		return esc_html__( 'WPB Content Box', 'wpb-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-info-box';
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
        
		// content box section
  		$this->start_controls_section(
  			'wpb_ea_content_box_content',
  			[
  				'label' => esc_html__( 'Content Box', 'wpb-elementor-addons' )
  			]
  		);

        // content box conent type
        $this->add_control(
            'wpb_ea_content_box_content_type',
            [
                'label'             => esc_html__( 'Content Type', 'wpb-elementor-addons' ),
                'type'              => Controls_Manager::SELECT,
                'default'           => 'slider',
                'options'           => [
                    'slider'        => esc_html__( 'Slider',   'wpb-elementor-addons' ),
                    'grid'          => esc_html__( 'Grid', 'wpb-elementor-addons' )
                ],
                'separator'         =>  'after'
            ]
        );

        // content box field options
        $this->add_control(
            'wpb_ea_content_box_items',
            [
                'label'         => esc_html__( 'Content Items', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::REPEATER,
                'default'       => [
                    [
                        'wpb_ea_content_box_title'  => esc_html__( 'Content Box 1', 'wpb-elementor-addons' ),
                        'wpb_ea_content_box_text'   => esc_html__( 'Lorem Ipsum is placeholder text commonly used in the graphic, print.', 'wpb-elementor-addons' ),
                    ],
                    [
                        'wpb_ea_content_box_title'  => esc_html__( 'Content Box 2', 'wpb-elementor-addons' ),
                        'wpb_ea_content_box_text'   => esc_html__( 'Lorem Ipsum is placeholder text commonly used in the graphic, print.', 'wpb-elementor-addons' ),
                    ],
                    [
                        'wpb_ea_content_box_title'  => esc_html__( 'Content Box 3', 'wpb-elementor-addons' ),
                        'wpb_ea_content_box_text'   => esc_html__( 'Lorem Ipsum is placeholder text commonly used in the graphic, print.', 'wpb-elementor-addons' ),
                    ],
                    [
                        'wpb_ea_content_box_title'  => esc_html__( 'Content Box 4', 'wpb-elementor-addons' ),
                        'wpb_ea_content_box_text'   => esc_html__( 'Lorem Ipsum is placeholder text commonly used in the graphic, print.', 'wpb-elementor-addons' ),
                    ],
                    [
                        'wpb_ea_content_box_title'  => esc_html__( 'Content Box 5', 'wpb-elementor-addons' ),
                        'wpb_ea_content_box_text'   => esc_html__( 'Lorem Ipsum is placeholder text commonly used in the graphic, print.', 'wpb-elementor-addons' ),
                    ],
                    [
                        'wpb_ea_content_box_title'  => esc_html__( 'Content Box 6', 'wpb-elementor-addons' ),
                        'wpb_ea_content_box_text'   => esc_html__( 'Lorem Ipsum is placeholder text commonly used in the graphic, print.', 'wpb-elementor-addons' ),
                    ]
                ],
                'fields'        => [
                    [
                        'name'              => 'image',
                        'label'             => esc_html__( 'Image', 'wpb-elementor-addons' ),
                        'type'              => Controls_Manager::MEDIA,
                    ],               
                    [
                        'name'              => 'wpb_ea_content_box_title',
                        'label'             => esc_html__( 'Title', 'wpb-elementor-addons' ),
                        'type'              => Controls_Manager::TEXT,
                        'placeholder'       => esc_html__( 'Place your title text here.', 'wpb-elementor-addons' ),       
                        'default'           => esc_html__( 'Lorem Ipsum is placeholder text commonly used in the graphic, print.', 'wpb-elementor-addons' )        
                    ],  
                    [
                        'name'              => 'wpb_ea_content_box_text',
                        'label'             => esc_html__( 'Description', 'wpb-elementor-addons' ),
                        'type'              => Controls_Manager::TEXTAREA,
                        'placeholder'       => esc_html__( 'Place your description text here.', 'wpb-elementor-addons' ),       
                        'default'           => esc_html__( 'Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries.', 'wpb-elementor-addons' )          
                    ],
                    [
                        'name'              => 'wpb_ea_content_box_item_bg',
                        'label'             => esc_html__( 'Item Background', 'wpb-elementor-addons' ),
                        'type'              => Controls_Manager::SELECT,      
                        'default'           => 'default',
                        'options'           => [
                            'default'         => esc_html__( 'White',   'wpb-elementor-addons' ),
                            'blue'            => esc_html__( 'Blue', 'wpb-elementor-addons' ),
                            'purple'          => esc_html__( 'Purple', 'wpb-elementor-addons' ),
                            'red'             => esc_html__( 'Red', 'wpb-elementor-addons' ),
                            'orange'          => esc_html__( 'Orange', 'wpb-elementor-addons' ),
                            'coral'          => esc_html__( 'Coral', 'wpb-elementor-addons' ),
                            'sky_blue'           => esc_html__( 'Sky blue', 'wpb-elementor-addons' ),
                            'wet_asphalt'     => esc_html__( 'Grey', 'wpb-elementor-addons' ),
                            'tomato'       => esc_html__( 'Bruschetta Tomato', 'wpb-elementor-addons' ),
                        ],       
                    ]                    
                ],
                'title_field' => '{{{ wpb_ea_content_box_title }}}'              
            ]
        );  

        // content box extra CSS heading
        $this->add_control(
            'wpb_ea_content_box_extra_css_heading',
            [
                'label'         => esc_html__( 'Extra CSS', 'wpb-elementor-addons' ),
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
                'description'   => esc_html__( 'Put your extra CSS class if you need.', 'wpb-elementor-addons' ),
                'placeholder'   => esc_html__( 'your-extra-css-class', 'wpb-elementor-addons' )
            ]
        );

		$this->end_controls_section();

        /**
         * -------------------------------------------
         * content box settings tab starts here
         * -------------------------------------------
         */   
        
        /**
         * -------------------------------------------
         * content box item's carousel section
         * -------------------------------------------
         */    
        $this->start_controls_section(
            'wpb_ea_content_box_carousel_settings',
            [
                'label'         => esc_html__('Carousel Settings', 'wpb-elementor-addons'),
                'tab'           => Controls_Manager::TAB_SETTINGS,
                'condition'     => [
                    '.wpb_ea_content_box.wpb_ea_content_box_content_type' => 'slider'
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
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-content-items-slider .wpb-ea-content-box' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ]
            ]
        );   

        $this->end_controls_section();  

        /**
         * -------------------------------------------
         * content box item's responsive section
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

        // content box type grid desktop column
        $this->add_control(
            'content_box_type_grid_desktop_column',
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
                    '.wpb_ea_content_box.wpb_ea_content_box_content_type' => 'grid'
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
                    '.wpb_ea_content_box.wpb_ea_content_box_content_type' => 'slider'
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
                    '.wpb_ea_content_box.wpb_ea_content_box_content_type' => 'slider'
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
                    '.wpb_ea_content_box.wpb_ea_content_box_content_type' => 'slider'
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
                    '.wpb_ea_content_box.wpb_ea_content_box_content_type' => 'slider'
                ]                
            ]
        );

        // content box type grid tablet column
        $this->add_control(
            'content_box_type_grid_tablet_column',
            [
                'label'         => esc_html__( 'Column', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 2,
                'options'       => [
                    6           => esc_html__( '6 Columns', 'wpb-elementor-addons' ),
                    4           => esc_html__( '4 Columns', 'wpb-elementor-addons' ),
                    3           => esc_html__( '3 Columns', 'wpb-elementor-addons' ),
                    2           => esc_html__( '2 Columns', 'wpb-elementor-addons' ),
                    1           => esc_html__( '1 Columns', 'wpb-elementor-addons' ),
                ],
                'condition'     => [
                    '.wpb_ea_content_box.wpb_ea_content_box_content_type' => 'grid'
                ]   
            ]
        );

        $this->add_control(
            'heading_mobile',
            [
                'label'         => esc_html__( 'Mobile Phone', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING,
                'separator'     => 'before',
                'condition'     => [
                    '.wpb_ea_content_box.wpb_ea_content_box_content_type' => 'slider'
                ]
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
                    '.wpb_ea_content_box.wpb_ea_content_box_content_type' => 'slider'
                ]
            ]
        );

        $this->end_controls_section();  

        /**
         * -------------------------------------------
         * content box settings tab ends here
         * -------------------------------------------
         */   

        /**
         * -------------------------------------------
         * content box style tab starts here
         * -------------------------------------------
         */
        
        /**
         * -------------------------------------------
         * content box style
         * -------------------------------------------
         */        
        $this->start_controls_section(
            'wpb_ea_content_box_style_section',
            [
                'label'         => esc_html__('Content Box Style', 'wpb-elementor-addons'),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );
        
        // content box background color
        $this->add_control(
            'wpb_ea_content_box_bg_color',
            [
                'label'         => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::COLOR,             
                'default'       => '#ffffff', 
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-content-box' => 'background-color: {{VALUE}};'
                ]               
            ]
        );

        // content box padding
        $this->add_control(
            'wpb_ea_content_box_padding',
            [
                'label'         => esc_html__( 'Padding', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'default'       => [
                    'top'       => 27,
                    'bottom'    => 27,
                    'left'      => 30,
                    'right'     => 30,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-content-box .wpb-ea-content-box-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        // content box margin
        $this->add_control(
            'wpb_ea_content_box_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'default'       => [
                    'bottom'    => 30
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-content-items-grid .wpb-ea-content-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'     => [
                    '.wpb_ea_content_box_content.wpb_ea_content_box_content_type' => 'grid'
                ]
            ]
        );

        // content box border type
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'wpb_ea_content_box_border_type',
                'label'         => esc_html__( 'Border Type', 'wpb-elementor-addons' ),
                'selector'      => '{{WRAPPER}} .wpb-ea-content-box'
            ]
        );       

        // content box border radius
        $this->add_control(
            'wpb_ea_content_box_border_radius',
            [
                'label'         => esc_html__( 'Border Radius', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'        => [
                        'max'   => 50
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-content-box' => 'border-radius: {{SIZE}}px;'
                ]
            ]
        );

        // content box box shadow
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'wpb_ea_custom_content_box_shadow',
                'label'         => esc_html__( 'Box Shadow', 'wpb-elementor-addons' ),
                'selector'      => '{{WRAPPER}} .wpb-ea-content-items-grid .wpb-ea-content-box',
            ]
        );


        // content box alignment
        $this->add_responsive_control(
            'wpb_ea_content_box_align',
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
                    ],
                ],
                'default'       => 'left',
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-content-box-inner' => 'text-align: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * content box image style
         * -------------------------------------------
         */ 
        $this->start_controls_section(
            'wpb_ea_content_box_image_style',
            [
                'label'         => esc_html__('Image', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        // content box image enable(lightbox)
        $this->add_control(
            'wpb_ea_content_box_image_lightbox_enable',
            [
                'label'        => esc_html__( 'Enable Lightbox', 'wpb-elementor-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes'
            ]
        );     

        // content box image type
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'          => 'image_size',
                'label'         => esc_html__( 'Image Size', 'wpb-elementor-addons' ),
                'default'       => 'medium_large'
            ]
        );

        // content box image custom height?
        $this->add_control(
            'wpb_ea_content_box_custom_image_height',
            [
                'label'         => esc_html__( 'Custom Height?', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,              
                'default'       => 'no',
                'return_value'  => 'yes'                       
            ]
        );

        // content box image height
        $this->add_control(
            'wpb_ea_content_box_image_height',
            [
                'label'         => esc_html__( 'Image height', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 270
                ],
                'range'         => [
                    'px'        => [
                        'min'   => 1,
                        'max'   => 1000,
                        'step'  => 1
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-content-box img' => 'height: {{SIZE}}{{UNIT}};'
                ],  
                'condition'     => [
                    '.wpb_ea_content_box_custom_image_height' => 'yes'
                ]   
            ]
        );     

        // content box image padding
        $this->add_control(
            'wpb_ea_content_box_image_padding_style',
            [
                'label'         => esc_html__( 'Padding', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-content-box img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );    

        // content box image margin
        $this->add_control(
            'wpb_ea_content_box_image_margin_style',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-content-box img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        ); 

        // content box image border type
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'wpb_ea_content_box_image_border_type',
                'label'         => esc_html__( 'Border Type', 'wpb-elementor-addons' ),
                'selector'      => '{{WRAPPER}} .wpb-ea-content-box img'
            ]
        );  

        // content box image border radius
        $this->add_control(
            'wpb_ea_content_box_image_border_radius_style',
            [
                'label'         => esc_html__( 'Border Radius', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-content-box img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        // content box image box shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'wpb_ea_content_box_image_box_shadow_style',
                'selector'      => '{{WRAPPER}} .wpb-ea-content-box img',
                'separator'     => ''
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * content box content style
         * -------------------------------------------
         */ 
        $this->start_controls_section(
            'wpb_ea_content_box_typography_section',
            [
                'label'         => esc_html__( 'Content Style', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );

        // content box title style
        $this->add_control(
            'wpb_ea_content_box_title_style',
            [
                'label'         => esc_html__( 'Title', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING
            ]
        );

        // content box title color
        $this->add_control(
            'wpb_ea_content_box_title_color',
            [
                'label'         => esc_html__( 'Color', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::COLOR,              
                'default'       => '#000000',  
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-content-box-inner h3' => 'color: {{VALUE}};'
                ]         
            ]
        );

        // content box title typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_content_box_title_typography',
                'selector'      => '{{WRAPPER}} .wpb-ea-content-box-inner h3'
            ]
        );

        // content box title margin
        $this->add_control(
            'wpb_ea_content_box_title_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-content-box-inner h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        // content box description style
        $this->add_control(
            'wpb_ea_content_box_description_style',
            [
                'label'         => esc_html__( 'Description Style', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING,
                'separator'     => 'before'
            ]
        );

        // content box description color
        $this->add_control(
            'wpb_ea_content_box_description_color',
            [
                'label'         => esc_html__( 'Description Color', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::COLOR,              
                'default'       => '#777777',  
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-content-box-inner span.wpb-ea-content-box-text p' => 'color: {{VALUE}};'
                ]
            ]
        );

        // content box description typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_content_box_description_typography',
                'selector'      => '{{WRAPPER}} .wpb-ea-content-box-inner span.wpb-ea-content-box-text p'
            ]
        );

        // content box description margin
        $this->add_control(
            'wpb_ea_content_box_description_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-content-box-text p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->end_controls_section();	

        /**
         * -------------------------------------------
         * content box carousel style
         * -------------------------------------------
         */ 
        $this->start_controls_section(
            'wpb_ea_content_box_carousel_setting_style_options',
            [
                'label'         => esc_html__( 'Carousel', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    '.wpb_ea_content_box_content.wpb_ea_content_box_content_type' => 'slider'
                ]
            ]
        );  

        // navigation background color
        $this->add_control(
            'wpb_ea_content_box_carousel_navigation_bg_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Navigation Background Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1
                ],
                'default'       => $wpb_ea_primary_color,
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-content-items-slider.owl-theme .owl-nav [class*=owl-]'      => 'background: {{VALUE}};'
                ],              
                'condition'     => [
                    '.wpb_ea_content_box_carousel_settings.arrows!' => ''
                ]

            ]
        );

        // navigation color
        $this->add_control(
            'wpb_ea_content_box_carousel_navigation_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Navigation Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1
                ],
                'default'       => '#ffffff',
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-content-items-slider .owl-prev .fa' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wpb-ea-content-items-slider .owl-next .fa' => 'color: {{VALUE}};'
                ],
                'condition'     => [
                    '.wpb_ea_content_box_carousel_settings.arrows!' => ''
                ]                
            ]
        );

        // pagination background color
        $this->add_control(
            'wpb_ea_content_box_carousel_pagination_bg_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Pagination Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1
                ],
                'default'       => $wpb_ea_primary_color,
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-content-items-slider.owl-theme .owl-dots .owl-dot span' => 'border-color: {{VALUE}}; background-color: {{VALUE}};'
                ],
                'condition'     => [
                    '.wpb_ea_content_box_carousel_settings.dots!' => ''
                ]                
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * content box style tab ends here
         * -------------------------------------------
         */        
	}

    // render image function
    private function render_image( $item, $settings ) {
        $image_id = $item['image']['id'];
        $image_size = $settings['image_size_size'];
        if ( 'custom' === $image_size ) {
            $image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'image_size', $settings );
        } else {
            $image_src = wp_get_attachment_image_src( $image_id, $image_size );
            $image_src = $image_src[0];
        }

        return sprintf( '<img src="%s" alt="%s" />', esc_url($image_src), esc_html($item['wpb_ea_content_box_text']) );
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
        
        // content box type grid column options
        if( $settings['wpb_ea_content_box_content_type'] == 'grid' ){
            $grid_desktop_column = 12/$settings['content_box_type_grid_desktop_column'];
            $grid_tablet_column  = 12/$settings['content_box_type_grid_tablet_column'];
            $grid_column         = 'col-lg-'.esc_attr( $grid_desktop_column ). ' col-md-'.esc_attr( $grid_tablet_column );  
        } 
        
        if( is_array( $settings['wpb_ea_content_box_items'] ) ) :  
            echo '<div class="'.esc_attr($extra_css).'wpb-ea-content-items-' . ( $settings['wpb_ea_content_box_content_type'] == 'slider' ? 'slider owl-carousel owl-theme" '.wpb_ea_owl_carousel_data_attr_implode( $slider_attr ) : 'grid ea-row"' ).'>';  
                foreach ( $settings['wpb_ea_content_box_items'] as $item ) : 
                    echo $settings['wpb_ea_content_box_content_type'] == 'grid' ? '<div class="'.esc_attr($grid_column).'">' : '';
                		echo '<div class="wpb-ea-content-box wpb-ea-content-box-bg-'. esc_attr( $item['wpb_ea_content_box_item_bg'] ) .'">';
                            if ( ! empty( $item['image']['url'] ) ) {
                                echo '<div class="wpb-ea-content-box-image">';
                                    if ( ( $settings['wpb_ea_content_box_image_lightbox_enable'] == 'yes' ) ) { 
                                        echo '<a href="'. esc_url( $item['image']['url'] ) .'" class="elementor-clickable">'; 
                                    }
                                        echo $this->render_image( $item, $settings );
                                    if ( $settings['wpb_ea_content_box_image_lightbox_enable'] == 'yes' ){ 
                                        echo '</a>'; 
                                    }
                                echo '</div>';                                  
                            }

                			echo '<div class="wpb-ea-content-box-inner">';
                				if ( ! empty( $item['wpb_ea_content_box_title'] ) ) :
                					echo '<h3 class="wpb-ea-content-box-title">'. esc_html( $item['wpb_ea_content_box_title'] ). '</h3>';
                				endif;

                				if ( ! empty( $item['wpb_ea_content_box_text'] ) ) :
                                    echo '<span class="wpb-ea-content-box-text">'. wpautop( wp_kses_post( ($item['wpb_ea_content_box_text'] ), true ) ) .'</span>';
                				endif;
                            echo '</div>';
                        echo '</div>';

        			echo $settings['wpb_ea_content_box_content_type'] == 'grid' ? '</div>' : '';
                endforeach;
		    echo '</div>';
        endif;

	}


    /**
     * Retrieve image widget link URL.
     *
     * @since 1.0.0
     * @access private
     *
     * @param array $settings
     *
     * @return array|string|false An array/string containing the link URL, or false if no link.
     */
    private function get_link_url( $settings ) {
        if ( 'none' === $settings['link_to'] ) {
            return false;
        }

        if ( 'custom' === $settings['link_to'] ) {
            if ( empty( $settings['link']['url'] ) ) {
                return false;
            }
            return $settings['link'];
        }

        return [
            'url' => $settings['image']['url'],
        ];
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new WPB_EA_Widget_Content_Box() );