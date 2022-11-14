<?php
/**
 * @author  WpBean
 * @version 1.0
 */

namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class WPB_EA_Widget_Image_Gallery extends Widget_Base {

    public function get_name() {
        return 'wpb-ea-image-gallery';
    }

    public function get_title() {
        return esc_html__( 'WPB Gallery', 'wpb-elementor-addons' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
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
            'imagesloaded',
            'fancybox',
            'isotope',
            'wpb-ea-super-js'
        ];
    }

    protected function _register_controls() {

        $wpb_ea_primary_color = wpb_ea_get_option( 'wpb_ea_primary_color', 'wpb_ea_style', '#3878ff' );

        $this->start_controls_section(
            'wpb_ea_image_gallery',
            [
                'label' => esc_html__( 'Gallery Items', 'wpb-elementor-addons' )
            ]
        );        

        $this->add_control(
            'wpb_ea_image_gallery_items',
            [
                'label'       => esc_html__( 'All Items', 'wpb-elementor-addons' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'default'     => [

                    [
                        'title'                 => esc_html__( 'Travel and Aviation Consulting', 'wpb-elementor-addons' ),
                        'subtitle'              => esc_html__( 'drone photography', 'wpb-elementor-addons' ),
                        'gallery_category_name' => esc_html__( 'Photography', 'wpb-elementor-addons' )
                    ],
                    [ 
                        'title'                 => esc_html__( 'Business Services Consulting', 'wpb-elementor-addons' ),
                        'subtitle'              => esc_html__( 'first time free', 'wpb-elementor-addons' ),
                        'gallery_category_name' => esc_html__( 'Branding,Design', 'wpb-elementor-addons' )
                    ],
                    [ 
                        'title'                 => esc_html__( 'Consumer Products Consulting', 'wpb-elementor-addons' ),
                        'subtitle'              => esc_html__( 'quality product', 'wpb-elementor-addons' ),
                        'gallery_category_name' => esc_html__( 'Technology,Photography', 'wpb-elementor-addons' )
                    ],
                    [ 
                        'title'                 => esc_html__( 'Awesome Design', 'wpb-elementor-addons' ),
                        'subtitle'              => esc_html__( 'perfect finishing', 'wpb-elementor-addons' ),
                        'gallery_category_name' => esc_html__( 'Design,Technology', 'wpb-elementor-addons' )
                    ],
                    [ 
                        'title'                 => esc_html__( 'Charming Technology', 'wpb-elementor-addons' ),
                        'subtitle'              => esc_html__( 'quadcopter', 'wpb-elementor-addons' ),
                        'gallery_category_name' => esc_html__( 'Technology,Branding', 'wpb-elementor-addons' )
                    ],
                    [ 
                        'title'                 => esc_html__( 'Studio Photography Lighting', 'wpb-elementor-addons' ),
                        'subtitle'              => esc_html__( 'photography and graphic', 'wpb-elementor-addons' ),
                        'gallery_category_name' => esc_html__( 'Photography', 'wpb-elementor-addons' )
                    ],
                    [ 
                        'title'                 => esc_html__( 'Refreshing Drinks', 'wpb-elementor-addons' ),
                        'subtitle'              => esc_html__( 'coffee', 'wpb-elementor-addons' ),
                        'gallery_category_name' => esc_html__( 'Branding', 'wpb-elementor-addons' )
                    ],
                    [ 
                        'title'                 => esc_html__( 'Software Testing', 'wpb-elementor-addons' ),
                        'subtitle'              => esc_html__( 'debug finder', 'wpb-elementor-addons' ),
                        'gallery_category_name' => esc_html__( 'Design,Branding', 'wpb-elementor-addons' )
                    ],
                    [ 
                        'title'                 => esc_html__( 'Aerial Photography', 'wpb-elementor-addons' ),
                        'subtitle'              => esc_html__( 'drone capture', 'wpb-elementor-addons' ),
                        'gallery_category_name' => esc_html__( 'Photography', 'wpb-elementor-addons' )
                    ]
                ],
                'fields'          => [
                    [
                        'name'    => 'wpb_ea_gallery_img',
                        'label'   => esc_html__( 'Image', 'wpb-elementor-addons' ),
                        'type'    => Controls_Manager::MEDIA,
                    ],
                    [
                        'type'          => \Elementor\Controls_Manager::TEXT,
                        'name'          => 'title',
                        'label_block'   => true,
                        'label'         => esc_html__( 'Title', 'wpb-elementor-addons' ),
                        'default'       => esc_html__( 'Item Title', 'wpb-elementor-addons' )
                    ],
                    [
                        'type'          => \Elementor\Controls_Manager::TEXT,
                        'name'          => 'subtitle',
                        'label'         => esc_html__( 'Subtitle', 'wpb-elementor-addons' ),
                        'default'       => esc_html__( 'item sub-title', 'wpb-elementor-addons' )
                    ],
                    [
                        'name'          => 'gallery_category_name',
                        'label'         => esc_html__( 'Gallery Category', 'wpb-elementor-addons' ),
                        'type'          => Controls_Manager::TEXT,
                        'description'   => esc_html__( 'Comma separate gallery categories. Example - Design,Branding,Technology.', 'wpb-elementor-addons' )
                    ],                 
                ],
                'title_field' => '{{title}}'
            ]
        );

        $this->add_control(
            'wpb_ea_gallery_cat_all_text',
            [
                'label'             => esc_html__( 'Text for all categories', 'wpb-elementor-addons' ),
                'type'              => \Elementor\Controls_Manager::TEXT,
                'placeholder'       => esc_html__( 'All Categories', 'wpb-elementor-addons' ),
                'default'           => esc_html__( 'All Categories', 'wpb-elementor-addons' ),
                'seperator'         => 'before'
            ]
        );

        $this->end_controls_section();

        // gallery settings
        $this->start_controls_section(
            'wpb_ea_image_gallery_settings_options',
            [
                'label'     => esc_html__( 'Gallery Settings', 'wpb-elementor-addons' )
            ]
        );

        $this->add_control(
            'wpb_ea_image_gallery_column_number',
            [
                'label'     => esc_html__( 'Number of Columns', 'wpb-elementor-addons' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 3,
                'options'   => [
                    1       => esc_html__( 'Single Column', 'wpb-elementor-addons' ),
                    2       => esc_html__( 'Two Columns',   'wpb-elementor-addons' ),
                    3       => esc_html__( 'Three Columns', 'wpb-elementor-addons' ),
                    4       => esc_html__( 'Four Columns',  'wpb-elementor-addons' ),
                    6       => esc_html__( 'Six Columns',  'wpb-elementor-addons' )
                ]
            ]
        );        

        $this->add_control(
            'wpb_ea_image_gallery_column_zero',
            [
                'label'        => esc_html__( 'Zero Padding between columns?', 'wpb-elementor-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes'
            ]
        );

        // image size
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'          => 'image_size',
                'default'       => 'medium_large',
            ]
        );

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
         * styles
         * -------------------------------------------
         */

        // gallery style
        $this->start_controls_section(
            'wpb_ea_image_gallery_style_section',
            [
                'label'         => esc_html__('Gallery Style', 'wpb-elementor-addons'),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );
        
        // image gallery background color
        $this->add_control(
            'wpb_ea_image_gallery_bg_color',
            [
                'label'         => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::COLOR,             
                'selectors'     => [
                    '{{WRAPPER}} .xt-project-gallery-wrapper' => 'background-color: {{VALUE}};'
                ]              
            ]
        );

        // image gallery padding
        $this->add_control(
            'wpb_ea_image_gallery_padding',
            [
                'label'         => esc_html__( 'Padding', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .xt-project-gallery-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        // image gallery margin
        $this->add_control(
            'wpb_ea_image_gallery_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],                           
                'selectors'     => [
                    '{{WRAPPER}} .xt-project-gallery-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        // image gallery border type
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'wpb_ea_image_gallery_border_type',
                'label'         => esc_html__( 'Border Type', 'wpb-elementor-addons' ),
                'selector'      => '{{WRAPPER}} .xt-project-gallery-wrapper'
            ]
        );       

        // image gallery border radius
        $this->add_control(
            'wpb_ea_image_gallery_border_radius',
            [
                'label'         => esc_html__( 'Border Radius', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'        => [
                        'max'   => 50
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .xt-project-gallery-wrapper' => 'border-radius: {{SIZE}}px;'
                ]
            ]
        );

        // image gallery box shadow
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'wpb_ea_image_gallery_shadow',
                'selectors'     => [
                    '{{WRAPPER}} .xt-project-gallery-wrapper'
                ],
            ]
        );

        $this->end_controls_section();

        // image gallery control section style
        $this->start_controls_section(
            'wpb_ea_image_gallery_control_section_style',
            [
                'label'         => esc_html__( 'Gallery Control Style', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_responsive_control(
            'wpb_ea_image_gallery_control_padding',
            [
                'label'         => esc_html__( 'Padding', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                        '{{WRAPPER}} .xt-project-gallery-nav ul li span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'wpb_ea_image_gallery_control_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                        '{{WRAPPER}} .xt-project-gallery-nav ul li span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
             'name'             => 'wpb_ea_image_gallery_control_typography',
                'selector'      => '{{WRAPPER}} .xt-project-gallery-nav ul li span',
            ]
        );

        // tabs
        $this->start_controls_tabs( 'wpb_ea_image_gallery_control_tabs' );

            // normal state tab
            $this->start_controls_tab( 'wpb_ea_image_gallery_control_btn_normal', [ 'label' => esc_html__( 'Normal', 'wpb-elementor-addons' ) ] );

            // image gallery control(normal) color
            $this->add_control(
                'wpb_ea_image_gallery_control_normal_text_color',
                [
                    'label'     => esc_html__( 'Text Color', 'wpb-elementor-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#3C4858',
                    'selectors' => [
                        '{{WRAPPER}} .xt-project-gallery-nav ul li span' => 'color: {{VALUE}};',
                    ]
                ]
            );

            // image gallery control(normal) background color
            $this->add_control(
                'wpb_ea_image_gallery_control_normal_bg_color',
                [
                    'label'     => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .xt-project-gallery-nav ul li span' => 'background: {{VALUE}};'
                    ]
                ]
            );

            // image gallery control(normal) border
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'      => 'wpb_ea_image_gallery_control_normal_border',
                    'label'     => esc_html__( 'Border', 'wpb-elementor-addons' ),
                    'selector'  => '{{WRAPPER}} .xt-project-gallery-nav ul li span',
                ]
            );

            // image gallery control(normal) border radius
            $this->add_control(
                'wpb_ea_image_gallery_control_normal_border_radius',
                [
                    'label'     => esc_html__( 'Border Radius', 'wpb-elementor-addons' ),
                    'type'      => Controls_Manager::SLIDER,
                    'range'     => [
                        'px'    => [
                            'max'   => 30
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .xt-project-gallery-nav ul li span' => 'border-radius: {{SIZE}}px;'
                    ]
                ]
            );

            // image gallery control(normal) box shadow
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'      => 'wpb_ea_image_gallery_control_shadow',
                    'selector'  => '{{WRAPPER}} .xt-project-gallery-nav ul li span',
                    'separator' => 'before'
                ]
            );

            $this->end_controls_tab();

            // active state tab
            $this->start_controls_tab( 'wpb_ea_gallery_control_btn_active', [ 'label' => esc_html__( 'Active', 'wpb-elementor-addons' ) ] );

            // image gallery control(active) color
            $this->add_control(
                'wpb_ea_image_gallery_control_active_text_color',
                [
                    'label'         => esc_html__( 'Text Color', 'wpb-elementor-addons' ),
                    'type'          => Controls_Manager::COLOR,
                    'default'       => '#3C4858',
                    'selectors'     => [
                        '{{WRAPPER}} .xt-project-gallery-nav ul li.current span' => 'color: {{VALUE}};'
                    ]
                ]
            );

            // image gallery control(active) background color
            $this->add_control(
                'wpb_ea_image_gallery_control_active_bg_color',
                [
                    'label'         => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
                    'type'          => Controls_Manager::COLOR,
                    'selectors'     => [
                        '{{WRAPPER}} .xt-project-gallery-nav ul li.current span' => 'background: {{VALUE}};'
                    ]
                ]
            );

            // image gallery control(active) border bottom?
            $this->add_control(
                'wpb_ea_image_gallery_control_active_border_bottom_enabled',
                [
                    'label'         => esc_html__( 'Border Bottom?', 'wpb-elementor-addons' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'return_value'  => 'yes',
                    'default'       => 'yes'
                ]
            );   

            // image gallery control(active) border bottom color
            $this->add_control(
                'wpb_ea_image_gallery_control_active_border_bottom_color',
                [
                    'label'         => esc_html__( 'Border Bottom Color', 'wpb-elementor-addons' ),
                    'type'          => Controls_Manager::COLOR,
                    'default'       => $wpb_ea_primary_color,
                    'condition'     => [
                        '.wpb_ea_image_gallery_control_active_border_bottom_enabled!' => ''
                    ],                       
                    'selectors'     => [
                        '{{WRAPPER}} .xt-project-gallery-nav.has-border-bottom ul li.current span' => 'border-bottom: 4px solid {{VALUE}};'
                    ]
                ]
            );

            // image gallery control(active) border
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'          => 'wpb_ea_image_gallery_control_active_border',
                    'label'         => esc_html__( 'Border', 'wpb-elementor-addons' ),
                    'selector'      => '{{WRAPPER}} .xt-project-gallery-nav ul li.current span'
                ]
            );

            // image gallery control(active) border radius
            $this->add_control(
                'wpb_ea_image_gallery_control_active_border_radius',
                [
                    'label'         => esc_html__( 'Border Radius', 'wpb-elementor-addons' ),
                    'type'          => Controls_Manager::SLIDER,
                    'range'         => [
                        'px'        => [
                            'max'   => 30
                        ],
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .xt-project-gallery-nav ul li.current span' => 'border-radius: {{SIZE}}px;'
                    ]
                ]
            );

            // image gallery control(active) text box shadow
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'          => 'wpb_ea_image_gallery_control_active_shadow',
                    'selector'      => '{{WRAPPER}} .xt-project-gallery-nav ul li.current span',
                    'separator'     => 'before'
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // image gallery item style
        $this->start_controls_section(
            'wpb_ea_image_gallery_item_style_settings',
            [
                'label'         => esc_html__( 'Gallery Item Style', 'wpb_ea_image_gallery_shadow' ),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'wpb_ea_image_gallery_item_container_padding',
            [
                'label'         => esc_html__( 'Padding', 'wpb_ea_image_gallery_shadow' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                        '{{WRAPPER}} .xt-project-gallery .xt-project-gallery-grid-item figure img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'wpb_ea_image_gallery_item_container_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb_ea_image_gallery_shadow' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                        '{{WRAPPER}} .xt-project-gallery .xt-project-gallery-grid-item figure img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'wpb_ea_image_gallery_item_border',
                'label'         => esc_html__( 'Border', 'wpb_ea_image_gallery_shadow' ),
                'selector'      => '{{WRAPPER}} .xt-project-gallery .xt-project-gallery-grid-item figure img'
            ]
        );

        $this->add_control(
            'wpb_ea_image_gallery_item_border_radius',
            [
                'label'         => esc_html__( 'Border Radius', 'wpb_ea_image_gallery_shadow' ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 0
                ],
                'range'         => [
                    'px'        => [
                        'max'   => 500
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .xt-project-gallery .xt-project-gallery-grid-item figure img' => 'border-radius: {{SIZE}}px;'
                ]
            ]
        );

        $this->end_controls_section();

        // image gallery colo & typography style
        $this->start_controls_section(
            'wpb_ea_image_gallery_typography_style',
            [
                'label'         => esc_html__('Color &amp; Typography', 'wpb-elementor-addons'),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );

        // image gallery image style
        $this->add_control(
            'wpb_ea_image_gallery_image_style',
            [
                'label'         => esc_html__( 'Image Style', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING
            ]
        );

        // image hover overlay rgba color
        $this->add_control(
            'wpb_ea_image_gallery_image_hover_overlay_color',
            [
                'label'         => esc_html__( 'Hover Overlay Color', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::COLOR,
                'default'       => 'rgba(84,89,95,0.7)',
                'selectors'     => [
                    '{{WRAPPER}} .xt-project-gallery .xt-project-gallery-grid-item figure:hover figcaption, .xt-project-gallery .xt-project-gallery-grid-item figure:focus figcaption, .xt-project-gallery .xt-project-gallery-grid-item figure.xt-item-touchend figcaption' => 'background-color: {{VALUE}}'
                ]

            ]
        );

        // image caption title style
        $this->add_control(
            'wpb_ea_image_gallery_title_style',
            [
                'label'         => esc_html__( 'Caption Title Style', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING,
                'separator'     =>  'before'
            ]
        );

        // image caption title color
        $this->add_control(
            'wpb_ea_image_gallery_image_caption_title_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1
                ],
                'default'       => '#ffffff',
                'selectors'     => [
                    '{{WRAPPER}} .xt-project-gallery .xt-project-gallery-grid-item figure figcaption h3' => 'color: {{VALUE}};'
                ]
            ]
        );

       // image caption title typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_image_gallery_image_caption_title_typography',
                'selector'      => '{{WRAPPER}} .xt-project-gallery .xt-project-gallery-grid-item figure figcaption h3',
            ]
        );

        // image caption subtitle style
        $this->add_control(
            'wpb_ea_image_gallery_sub_title_style',
            [
                'label'         => esc_html__( 'Caption Subtitle Style', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING,
                'separator'     =>  'before'
            ]
        );

        // image caption title color
        $this->add_control(
            'wpb_ea_image_gallery_image_caption_subtitle_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default'       => '#ffffff',
                'selectors'     => [
                    '{{WRAPPER}} .xt-project-gallery .xt-project-gallery-grid-item figure figcaption .sub-title' => 'color: {{VALUE}};'
                ]
            ]
        );

       // image caption title typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_image_gallery_image_caption_subtitle_typography',
                'selector'      => '{{WRAPPER}} .xt-project-gallery .xt-project-gallery-grid-item figure figcaption .sub-title'
            ]
        );        

        // image hover icon style
        $this->add_control(
            'wpb_ea_image_gallery_hover_icon_style',
            [
                'label'         => esc_html__( 'Icon Style', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING,
                'separator'     =>  'before'
            ]
        );

        // image caption title color
        $this->add_control(
            'wpb_ea_image_gallery_hover_icon_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1
                ],
                'default'       => '#ffffff',
                'selectors'     => [
                    '{{WRAPPER}} .xt-project-gallery .xt-project-gallery-grid-item figure figcaption i' => 'color: {{VALUE}};'
                ]
            ]
        );    

        $this->end_controls_section();
    }

    private function render_image( $image_id, $settings ) {
        $image_size = $settings['image_size_size'];
        if ( 'custom' === $image_size ) {
            $image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'image_size', $settings );
        } else {
            $image_src = wp_get_attachment_image_src( $image_id, $image_size );
            $image_src = $image_src[0];
        }

        return sprintf( '<img src="%s" alt="%s" />', esc_url($image_src), esc_html( get_post_meta( $image_id, '_wp_attachment_image_alt', true) ) );
    }

    protected function render() {
        $settings       = $this->get_settings_for_display();
        $extra_css      = $settings['extra_css'];
        $gallery_init   = '';

        if ( !\Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            $gallery_init = 'xt-project-gallery-init';
        }

        if($extra_css){
            $extra_css = $extra_css.' ';
        }

        $gallery_classes = array();
        
        if( function_exists('wpb_ea_gallery_categories') ){
           $gallery_categories = wpb_ea_gallery_categories( $settings['wpb_ea_image_gallery_items'] );
        }

        echo '<div class="'.esc_attr( $extra_css ).'xt-project-gallery-wrapper">';

            if( is_array( $gallery_categories ) && !empty( $gallery_categories ) ):      
                echo '<div class="xt-project-gallery-nav'. ( $settings['wpb_ea_image_gallery_control_active_border_bottom_enabled'] == 'yes' ? ' has-border-bottom' : ' no-border-bottom' ) .'">';
                    echo '<ul>';
                        echo '<li data-filter="*" class="current"> <span>'. esc_html( $settings['wpb_ea_gallery_cat_all_text'] ) .' </span></li>';

                        foreach ($gallery_categories as $gallery_category ) {
                            printf( '<li data-filter=".%s"><span>%s</span></li>', esc_attr( sanitize_title( $gallery_category ) . '-' . $this->get_id() ) , esc_html( $gallery_category ) );
                        }

                    echo '</ul>';
                echo '</div>';
            endif;

            if( is_array( $settings['wpb_ea_image_gallery_items'] ) ): 
                $column = 12/$settings['wpb_ea_image_gallery_column_number'];        
                echo '<div class="xt-project-gallery">';
                    echo '<div class="'. ( $gallery_init ? esc_attr( $gallery_init ) . ' ' : '' ) .'xt-project-gallery-items ea-row">';

                        foreach ( $settings['wpb_ea_image_gallery_items'] as $item ) :
                            if( $item['wpb_ea_gallery_img']['id'] ):

                                echo '<div class="xt-project-gallery-grid-item col-lg-'. esc_attr($column). ' col-md-6 '. esc_attr( wpb_ea_gallery_item_category_classes( $item['gallery_category_name'] , $this->get_id() ) ) . ( $settings['wpb_ea_image_gallery_column_zero'] == 'yes' ? ' padding-o' : '' ) . '">';
                                    echo '<figure>';
                                        echo $this->render_image( $item['wpb_ea_gallery_img']['id'], $settings );
                                        echo '<figcaption class="fig-caption">';
                                            echo apply_filters( 'wpb_ea_image_gallery_popup_icon', '<i class="lni-search"></i>' );
                                            echo '<h3>'. esc_html( $item['title'] ) .'</h3>';
                                            echo '<span class="sub-title">'. esc_html( $item['subtitle'] ) .'</span>';
                                            echo '<a class="xt-project-lightbox elementor-clickable" href="'. esc_url( $item['wpb_ea_gallery_img']['url'] ) .'" data-fancybox="gallery-'. esc_attr( $this->get_id() ) .'"></a>';
                                        echo '</figcaption>';
                                    echo '</figure>';
                                echo '</div>';

                            endif;
                        endforeach; 

                    echo '</div>';
                echo '</div>';
            endif;
        echo '</div>';
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new WPB_EA_Widget_Image_Gallery() );