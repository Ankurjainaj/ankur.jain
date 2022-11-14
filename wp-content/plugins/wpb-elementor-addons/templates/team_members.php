<?php
/**
 * @author  WpBean
 * @version 1.0
 */

namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class WPB_EA_Widget_Team_Member extends Widget_Base {

	public function get_name() {
		return 'wpb-ea-team-members';
	}

	public function get_title() {
		return esc_html__( 'WPB Team Member', 'wpb-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-person';
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

		// team member section
  		$this->start_controls_section(
  			'wpb_ea_team_member_section',
  			[
  				'label' => esc_html__( 'Team Members', 'wpb-elementor-addons' )
  			]
  		);

        // team member conent type
        $this->add_control(
            'wpb_ea_team_member_content_type',
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

        // team member conent type
        $this->add_control(
            'wpb_ea_team_member_enable_social_info',
            [
                'label'             => esc_html__( 'Display Social Profiles?', 'wpb-elementor-addons' ),
                'type'              => Controls_Manager::SWITCHER,
                'return_value'      => 'yes',
                'default'           => 'yes'  
            ]
        );

        // team member field options
        $this->add_control(
            'wpb_ea_team_member_items',
            [
                'label'         => esc_html__('Member Items', 'wpb-elementor-addons'),
                'type'          => Controls_Manager::REPEATER,
                'default'       => [
                    [
                        'wpb_ea_member_name' => esc_html__( 'John Doe', 'wpb-elementor-addons' )
                    ],
                    [
                        'wpb_ea_member_name' => esc_html__( 'Aaron Sylvester', 'wpb-elementor-addons' )
                    ],
                    [
                        'wpb_ea_member_name' => esc_html__( 'Sherry Hernandez', 'wpb-elementor-addons' )
                    ]
                ],
                'fields'        => [
                    [
                        'name'          => 'image',
                        'label'         => esc_html__( 'Image', 'wpb-elementor-addons' ),
                        'type'          => Controls_Manager::MEDIA,
                        'default'       => []
                    ],               
                    [
                        'name'              => 'wpb_ea_member_name',
                        'label'             => esc_html__( 'Name', 'wpb-elementor-addons' ),
                        'type'              => Controls_Manager::TEXT,
                        'placeholder'       => esc_html__( 'Name', 'wpb-elementor-addons' ),       
                        'default'           => esc_html__( 'John Doe', 'wpb-elementor-addons' )             
                    ],  
                    [
                        'name'              => 'wpb_ea_member_designation',
                        'label'             => esc_html__( 'Designation', 'wpb-elementor-addons' ),
                        'type'              => Controls_Manager::TEXT,
                        'placeholder'       => esc_html__( 'Place member designation here.', 'wpb-elementor-addons' ),       
                        'default'           => esc_html__( 'Developer', 'wpb-elementor-addons' )           
                    ],  
                    [
                        'name'              => 'wpb_ea_member_details',
                        'label'             => esc_html__( 'Details', 'wpb-elementor-addons' ),
                        'type'              => Controls_Manager::TEXTAREA,
                        'placeholder'       => esc_html__( 'Place member description here.', 'wpb-elementor-addons' ),       
                        'default'           => esc_html__( 'Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries.', 'wpb-elementor-addons' )           
                    ], 
                    [
                        'name'              => 'wpb_ea_member_social_info_heading',
                        'label'             => esc_html__( 'Social Profile', 'wpb-elementor-addons' ),
                        'type'              => Controls_Manager::HEADING
                    ],
                    [
                        'type'              => Controls_Manager::TEXT,
                        'name'              => 'member_email',
                        'label'             => esc_html__( 'Email Address', 'wpb-elementor-addons' ),
                        'description'       => esc_html__( 'Enter the email address of the team member.', 'wpb-elementor-addons' )
                    ],
                    [
                        'type'              => Controls_Manager::TEXT,
                        'name'              => 'facebook_url',
                        'label'             => esc_html__( 'Facebook Page URL', 'wpb-elementor-addons' ),
                        'default'           => '#', 
                        'description'       => esc_html__( 'URL of the Facebook page of the team member.', 'wpb-elementor-addons' )
                    ],
                    [
                        'type'              => Controls_Manager::TEXT,
                        'name'              => 'twitter_url',
                        'label'             => esc_html__( 'Twitter Profile URL', 'wpb-elementor-addons' ),
                        'default'           => '#', 
                        'description'       => esc_html__( 'URL of the Twitter page of the team member.', 'wpb-elementor-addons' )
                    ],
                    [
                        'type'              => Controls_Manager::TEXT,
                        'name'              => 'linkedin_url',
                        'label'             => esc_html__( 'LinkedIn Page URL', 'wpb-elementor-addons' ),
                        'default'           => '#', 
                        'description'       => esc_html__( 'URL of the LinkedIn profile of the team member.', 'wpb-elementor-addons' )
                    ],
                    [
                        'type'              => Controls_Manager::TEXT,
                        'name'              => 'pinterest_url',
                        'label'             => esc_html__( 'Pinterest Page URL', 'wpb-elementor-addons' ),
                        'default'           => '#', 
                        'description'       => esc_html__( 'URL of the Pinterest page for the team member.', 'wpb-elementor-addons' )
                    ],
                    [
                        'type'              => Controls_Manager::TEXT,
                        'name'              => 'dribbble_url',
                        'label'             => esc_html__( 'Dribbble Profile URL', 'wpb-elementor-addons' ),
                        'default'           => '#', 
                        'description'       => esc_html__( 'URL of the Dribbble profile of the team member.', 'wpb-elementor-addons' )
                    ],
                    [
                        'type'              => Controls_Manager::TEXT,
                        'name'              => 'google_plus_url',
                        'label'             => esc_html__( 'GooglePlus Page URL', 'wpb-elementor-addons' ),
                        'description'       => esc_html__( 'URL of the Google Plus page of the team member.', 'wpb-elementor-addons' )
                    ],
                    [
                        'type'              => Controls_Manager::TEXT,
                        'name'              => 'skype_url',
                        'label'             => esc_html__( 'Skype Profile URL', 'wpb-elementor-addons' ),
                        'description'       => esc_html__( 'URL of the Skype profile of the team member.', 'wpb-elementor-addons' )
                    ],
                    [
                        'type'              => Controls_Manager::TEXT,
                        'name'              => 'instagram_url',
                        'label'             => esc_html__( 'Instagram Page URL', 'wpb-elementor-addons' ),
                        'description'       => esc_html__( 'URL of the Instagram feed for the team member.', 'wpb-elementor-addons' )
                    ]
                ],
                'title_field' => '{{{ wpb_ea_member_name }}}'              
            ]
        );	        

        // team member extra CSS heading
        $this->add_control(
            'wpb_ea_team_member_extra_css_heading',
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
                'description'   => esc_html__('Put your extra CSS class if you need.', 'wpb-elementor-addons'),
                'placeholder'   => esc_html__( 'your-extra-css-class', 'wpb-elementor-addons' )
            ]
        );

		$this->end_controls_section();


        /**
         * -------------------------------------------
         * team member settings tab starts here
         * -------------------------------------------
         */   
        
        /**
         * -------------------------------------------
         * team member item's carousel section
         * -------------------------------------------
         */    
        $this->start_controls_section(
            'wpb_ea_team_member_carousel_settings',
            [
                'label'         => esc_html__('Carousel Settings', 'wpb-elementor-addons'),
                'tab'           => Controls_Manager::TAB_SETTINGS,
                'condition'     => [
                    '.wpb_ea_team_member.wpb_ea_team_member_content_type' => 'slider'
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
                    '{{WRAPPER}} .wpb-ea-member-items-slider .wpb-ea-team-member' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ]
            ]
        );   

        $this->end_controls_section();  

        /**
         * -------------------------------------------
         * team member item's responsive section
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

        // team member type grid desktop column
        $this->add_control(
            'team_member_type_grid_desktop_column',
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
                    '.wpb_ea_team_member.wpb_ea_team_member_content_type' => 'grid'
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
                    '.wpb_ea_team_member.wpb_ea_team_member_content_type' => 'slider'
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
                    '.wpb_ea_team_member.wpb_ea_team_member_content_type' => 'slider'
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
                    '.wpb_ea_team_member.wpb_ea_team_member_content_type' => 'slider'
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
                    '.wpb_ea_team_member.wpb_ea_team_member_content_type' => 'slider'
                ]                
            ]
        );

        // team member type grid tablet column
        $this->add_control(
            'team_member_type_grid_tablet_column',
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
                    '.wpb_ea_team_member.wpb_ea_team_member_content_type' => 'grid'
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
                    '.wpb_ea_team_member.wpb_ea_team_member_content_type' => 'slider'
                ]
            ]
        );

        $this->end_controls_section();  

        /**
         * -------------------------------------------
         * team member settings tab ends here
         * -------------------------------------------
         */   

        /**
         * -------------------------------------------
         * team member style tab starts here
         * -------------------------------------------
         */ 
        
        /**
         * -------------------------------------------
         * team member box style
         * -------------------------------------------
         */
        $this->start_controls_section(
            'wpb_ea_team_member_style_section',
            [
                'label'         => esc_html__('Member Box Style', 'wpb-elementor-addons'),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );
        
        // team member background color
        $this->add_control(
            'wpb_ea_team_member_bg_color',
            [
                'label'         => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::COLOR,             
                'default'       => '#ffffff',  
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-team-member' => 'background-color: {{VALUE}};'
                ]               
            ]
        );

        $this->add_control(
            'wpb_ea_team_member_shadow',
            [
                'label'         => esc_html__( 'Box Shadow', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'wpb-elementor-addons' ),
                'label_off'     => esc_html__( 'No', 'wpb-elementor-addons' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
            ]
        );

        // team member padding
        $this->add_control(
            'wpb_ea_team_member_padding',
            [
                'label'         => esc_html__( 'Padding', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-team-member .person-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        // team member margin
        $this->add_control(
            'wpb_ea_team_member_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'default'       => [
                    'bottom'    => 30
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-team-member' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'     => [
                    '.wpb_ea_team_member.wpb_ea_team_member_content_type' => 'grid'
                ]
            ]
        );

        // team member border type
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'wpb_ea_team_member_border_type',
                'label'         => esc_html__( 'Border Type', 'wpb-elementor-addons' ),
                'selector'      => '{{WRAPPER}} .wpb-ea-team-member'
            ]
        );       

        // team member border radius
        $this->add_control(
            'wpb_ea_team_member_border_radius',
            [
                'label'         => esc_html__( 'Border Radius', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'        => [
                        'max'   => 50
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-team-member' => 'border-radius: {{SIZE}}px;'
                ]
            ]
        );

        // team member box shadow
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'wpb_ea_team_member_shadow',
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-team-member'
                ]
            ]
        );

        // team member alignment
        $this->add_responsive_control(
            'wpb_ea_team_member_align',
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
                    '{{WRAPPER}} .wpb-ea-team-member .person-info' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * team member image style
         * -------------------------------------------
         */ 
        $this->start_controls_section(
            'wpb_ea_team_member_image_style',
            [
                'label'         => esc_html__('Image', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );

        // team member image enable(lightbox)
        $this->add_control(
            'wpb_ea_team_member_image_lightbox_enable',
            [
                'label'        => esc_html__( 'Enale Lightbox', 'wpb-elementor-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes'
            ]
        );     

        // team member image type
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'          => 'image_size',
                'label'         => esc_html__( 'Image Type', 'wpb-elementor-addons' ),
                'default'       => 'medium_large'
            ]
        );

        // team member image custom height?
        $this->add_control(
            'wpb_ea_team_member_custom_image_height',
            [
                'label'         => esc_html__( 'Custom Height?', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,              
                'default'       => 'no',
                'return_value'  => 'yes'                       
            ]
        );

        // team member image height
        $this->add_control(
            'wpb_ea_team_member_image_height',
            [
                'label'         => esc_html__( 'Image height', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 400
                ],
                'range'         => [
                    'px'        => [
                        'min'   => 1,
                        'max'   => 1000,
                        'step'  => 1
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-team-member .person_image_wrapper img' => 'height: {{SIZE}}{{UNIT}};'
                ],
                'condition'     => [
                    '.wpb_ea_team_member_custom_image_height' => 'yes'
                ]              
            ]
        );     

        // team member image padding
        $this->add_control(
            'wpb_ea_team_member_image_padding_style',
            [
                'label'         => esc_html__( 'Padding', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-team-member .person_image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );    

        // team member image margin
        $this->add_control(
            'wpb_ea_team_member_image_margin_style',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-team-member .person_image img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        ); 

        // team member image border type
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'wpb_ea_team_member_image_border_type',
                'label'         => esc_html__( 'Border Type', 'wpb-elementor-addons' ),
                'selector'      => '{{WRAPPER}} .wpb-ea-team-member .person_image img'
            ]
        );  

        // team member image border radius
        $this->add_control(
            'wpb_ea_team_member_image_border_radius_style',
            [
                'label'         => esc_html__( 'Border Radius', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-team-member .person_image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        // team member image box shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'wpb_ea_team_member_image_box_shadow_style',
                'selector'      => '{{WRAPPER}} .wpb-ea-team-member .person_image img',
                'separator'     => ''
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * team member content style
         * -------------------------------------------
         */ 
        $this->start_controls_section(
            'wpb_ea_team_member_content_style',
            [
                'label'         => esc_html__('Content', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );

        // team member name style
        $this->add_control(
            'wpb_ea_team_member_name_style',
            [
                'label'         => esc_html__( 'Member Name', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING           
            ]
        );

        // team member name color
        $this->add_control(
            'wpb_ea_team_member_name_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],  
                'default'       => '#000000',                             
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-team-member .person-info h3' => 'color: {{VALUE}};'
                ]
            ]
        );

        // team member name typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_team_member_name_typography',
                'selector'      => '{{WRAPPER}} .wpb-ea-team-member .person-info h3'
            ]
        );

        // team member name margin
        $this->add_control(
            'wpb_ea_team_member_name_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-team-member .person-info h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        // team member name padding
        $this->add_control(
            'wpb_ea_team_member_name_padding',
            [
                'label'         => esc_html__( 'Padding', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-team-member .person-info h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        // team member designation style
        $this->add_control(
            'wpb_ea_team_member_designation_style',
            [
                'label'         => esc_html__( 'Member Designation', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING,
                'separator'     => 'before'
            ]
        );

        // team member designation color
        $this->add_control(
            'wpb_ea_team_member_designation_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],  
                'default'       => 'rgba(49,50,51,0.5)',                             
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-team-member .person-info .wpb-ea-team-designation' => 'color: {{VALUE}};'
                ]
            ]
        );

        // team member designation typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_team_member_designation_typography',
                'selector'      => '{{WRAPPER}} .wpb-ea-team-member .person-info .wpb-ea-team-designation'
            ]
        );

        // team member designation margin
        $this->add_control(
            'wpb_ea_team_member_designation_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-team-member .person-info .wpb-ea-team-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        // team member designation padding
        $this->add_control(
            'wpb_ea_team_member_designation_padding',
            [
                'label'         => esc_html__( 'Padding', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-team-member .person-info .wpb-ea-team-designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        // team member details style
        $this->add_control(
            'wpb_ea_team_member_details_style',
            [
                'label'         => esc_html__( 'Member Details', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING,
                'separator'     => 'before'
            ]
        );

        // team member details color
        $this->add_control(
            'wpb_ea_team_member_details_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],  
                'default'       => '#333',            
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-team-member .person-info .wpb-ea-team-bio p' => 'color: {{VALUE}};'
                ]
            ]
        );

        // team member details typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_team_member_details_typography',
                'selector'      => '{{WRAPPER}} .wpb-ea-team-member .person-info .wpb-ea-team-bio p'
            ]
        );

        // team member details margin
        $this->add_control(
            'wpb_ea_team_member_details_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'default'       => [
                    'top'    => 15
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-team-member .person-info .wpb-ea-team-bio' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * team member social info style
         * -------------------------------------------
         */ 

        $this->start_controls_section(
            'wpb_ea_team_member_social_info_style',
            [
                'label'         => esc_html__('Social Info', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'wpb_ea_team_member_enable_social_info!' => ''
				]                
            ]
        );

        // team member social info icon typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_team_member_social_info_icon_typography',
                'selector'      => '{{WRAPPER}} .wpb-ea-team-member .social-buttons ul.social-links li a i',
                // font_family, font_size, font_weight, text_transform, font_style, text_decoration, line_height, letter_spacing
                'exclude' => [
                    'text_transform', 'font_family', 'font_weight', 'text_decoration'
                ]
            ]
        );
  

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * team member carousel style
         * -------------------------------------------
         */ 
        $this->start_controls_section(
            'wpb_ea_team_member_carousel_setting_style_options',
            [
                'label'         => esc_html__( 'Carousel', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    '.wpb_ea_team_member_section.wpb_ea_team_member_content_type' => 'slider'
                ]
            ]
        );  

        // navigation background color
        $this->add_control(
            'wpb_ea_team_member_carousel_navigation_bg_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Navigation Background Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default'       => $wpb_ea_primary_color,
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-member-items-slider.owl-theme .owl-nav [class*=owl-]'      => 'background: {{VALUE}};'
                ],
                'condition'     => [
                    '.wpb_ea_team_member_carousel_settings.arrows!' => ''
                ]
            ]
        );

        // navigation color
        $this->add_control(
            'wpb_ea_team_member_carousel_navigation_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Navigation Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default'       => '#ffffff',
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-member-items-slider .owl-prev .fa' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wpb-ea-member-items-slider .owl-next .fa' => 'color: {{VALUE}};'
                ],
                'condition'     => [
                    '.wpb_ea_team_member_carousel_settings.arrows!' => ''
                ]                
            ]
        );

        // pagination background color
        $this->add_control(
            'wpb_ea_team_member_carousel_pagination_bg_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Pagination Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default'       => $wpb_ea_primary_color,
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-member-items-slider.owl-theme .owl-dots .owl-dot span' => 'border-color: {{VALUE}}; background-color: {{VALUE}};'
                ],
                'condition'     => [
                    '.wpb_ea_team_member_carousel_settings.dots!' => ''
                ]                
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * team member style tab ends here
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

        return sprintf( '<img src="%s" alt="%s" />', esc_url($image_src), esc_html($item['wpb_ea_member_name']) );
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

        // team member type grid column options
        if( $settings['wpb_ea_team_member_content_type'] == 'grid' ){
            $grid_desktop_column = 12/$settings['team_member_type_grid_desktop_column'];
            $grid_tablet_column  = 12/$settings['team_member_type_grid_tablet_column'];
            $grid_column         = 'col-lg-'.esc_attr( $grid_desktop_column ). ' col-md-'.esc_attr( $grid_tablet_column );
        }
	
        if( is_array( $settings['wpb_ea_team_member_items'] ) ) : 	
            echo '<div class="'.esc_attr($extra_css).'wpb-ea-member-items-' . ( $settings['wpb_ea_team_member_content_type'] == 'slider' ? 'slider owl-carousel owl-theme" '.wpb_ea_owl_carousel_data_attr_implode( $slider_attr ) : 'grid ea-row"' ).'>';   
                foreach ( $settings['wpb_ea_team_member_items'] as $item ) : 
                    // social profiles
                    $mail            = $item['member_email'];
                    $facebook_url    = $item['facebook_url'];
                    $twitter_url     = $item['twitter_url'];
                    $linkedin_url    = $item['linkedin_url'];
                    $pinterest_url   = $item['pinterest_url'];
                    $dribbble_url    = $item['dribbble_url'];
                    $google_plus_url = $item['google_plus_url'];
                    $skype_url       = $item['skype_url'];
                    $instagram_url   = $item['instagram_url'];

                    echo $settings['wpb_ea_team_member_content_type'] == 'grid' ? '<div class="'.esc_attr($grid_column).'">' : '';
                		echo '<div class="wpb-ea-team-member wpb-ea-team-member-shadow-'. esc_attr( $settings['wpb_ea_team_member_shadow'] ) .'">';
                            if ( ! empty( $item['image']['url'] ) ) {
                                if ( ( $settings['wpb_ea_team_member_image_lightbox_enable'] == 'yes' ) ) { 
                                    echo '<a href="'.esc_url( $item['image']['url'] ).'" class="elementor-clickable">'; 
                                }
                                echo '<div class="person_image">';
                                    echo '<div class="person_image_wrapper">';
                                        echo $this->render_image( $item, $settings );
                                    echo '</div>';

                                    if( ($settings['wpb_ea_team_member_enable_social_info'] == 'yes') && ($mail || $facebook_url || $twitter_url || $linkedin_url || $pinterest_url || $dribbble_url || $google_plus_url || $skype_url || $instagram_url ) ) :
                                        echo '<div class="social-buttons">';
                                            echo '<ul class="social-links">';
                                                if ( $mail )
                                                    echo '<li><a href="mailto:'.esc_url($mail). '" title="' . esc_html__( "Send an email", 'wpb-elementor-addons' ) . '"><i class="fa fa-envelope"></i></a></li>';
                                                if ( $facebook_url )
                                                    echo '<li><a href="'.esc_url($facebook_url). '" target="_blank" title="' . esc_html__( "Follow on Facebook", 'wpb-elementor-addons' ) . '"><i class="fa fa-facebook"></i></a></li>';
                                                if ( $twitter_url )
                                                    echo '<li><a href="'.esc_url($twitter_url). '" target="_blank" title="' . esc_html__( "Subscribe to Twitter Feed", 'wpb-elementor-addons' ) . '"><i class="fa fa-twitter"></i></a></li>';
                                                if ( $linkedin_url )
                                                    echo '<li><a href="'.esc_url($linkedin_url). '" target="_blank" title="' . esc_html__( "View LinkedIn Profile", 'wpb-elementor-addons' ) . '"><i class="fa fa-linkedin"></i></a></li>';
                                                if ( $pinterest_url )
                                                    echo '<li><a href="'.esc_url($pinterest_url). '" target="_blank" title="' . esc_html__( "Subscribe to Pinterest Feed", 'wpb-elementor-addons' ) . '"><i class="fa fa-pinterest"></i></a></li>';
                                                if ( $dribbble_url )
                                                    echo '<li><a href="'.esc_url($dribbble_url). '" target="_blank" title="' . esc_html__( "View Dribbble Portfolio", 'wpb-elementor-addons' ) . '"><i class="fa fa-dribbble"></i></a></li>';
                                                if ( $google_plus_url )
                                                    echo '<li><a href="'.esc_url($google_plus_url). '" target="_blank" title="' . esc_html__( "Follow on Google Plus", 'wpb-elementor-addons' ) . '"><i class="fa fa-google-plus"></i></a></li>';
                                                if ( $skype_url )
                                                    echo '<li><a href="'.esc_url($skype_url). '" target="_blank" title="' . esc_html__( "Skype", 'wpb-elementor-addons' ) . '"><i class="fa fa-skype"></i></a></li>';
                                                if ( $instagram_url )
                                                    echo '<li><a href="'.esc_url($instagram_url). '" target="_blank" title="' . esc_html__( "View Instagram Feed", 'wpb-elementor-addons' ) . '"><i class="fa fa-facebook"></i></a></li>';
                                            echo '</ul>';
                                        echo '</div>';
                                    endif;
                                echo '</div>';
                                if ( $settings['wpb_ea_team_member_image_lightbox_enable'] == 'yes' ){ 
                                    echo '</a>'; 
                                }                                      
                            }
                			echo '<div class="person-info">';
                				$item['wpb_ea_member_name'] ? printf('<h3 class="wpb-ea-team-name">%s</h3>', esc_html($item['wpb_ea_member_name']) ) : '';
                				$item['wpb_ea_member_designation'] ? printf('<span class="wpb-ea-team-designation">%s</span>', esc_html($item['wpb_ea_member_designation']) ) : '';
                				$item['wpb_ea_member_details'] ? printf('<div class="wpb-ea-team-bio">%s</div>', wpautop( wp_kses_post($item['wpb_ea_member_details']) ) ) : '';
                			echo '</div>';
                        echo '</div>';
                    echo $settings['wpb_ea_team_member_content_type'] == 'grid' ? '</div>' : '';
                endforeach;
    		echo '</div>';
        endif;
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new WPB_EA_Widget_Team_Member() );