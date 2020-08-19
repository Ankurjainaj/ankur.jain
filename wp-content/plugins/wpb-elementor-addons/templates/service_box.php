<?php
/**
 * @author  WpBean
 * @version 1.0
 */

namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class WPB_EA_Widget_Service_Box extends Widget_Base {

	public function get_name() {
		return 'wpb-service-box';
	}

	public function get_title() {
		return esc_html__( 'WPB Service Box', 'wpb-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-editor-italic';
	}

	public function get_categories() {
		return [ 'wpb_ea_widgets' ];
	}

	protected function _register_controls() {
        $wpb_ea_primary_color = wpb_ea_get_option( 'wpb_ea_primary_color', 'wpb_ea_style', '#3878ff' );

  		$this->start_controls_section(
  			'wpb_ea_service_box_content',
  			[
  				'label' => esc_html__( 'Service Box', 'wpb-elementor-addons' )
  			]
  		);

        $this->add_control(
            'wpb_ea_service_box_icon_type',
            [
                'type'          => Controls_Manager::CHOOSE,
                'label_block'   => true,
                'label'         => esc_html__( 'Type', 'wpb-elementor-addons' ),
                'default'       => 'icon',
                'options'       => [
                    'icon'  => [
                        'title'             => esc_html__( 'Icon', 'wpb-elementor-addons' ),
                        'icon'              => 'fa fa-diamond',
                    ],
                    'image' => [
                        'title'             => esc_html__( 'Image', 'wpb-elementor-addons' ),
                        'icon'              => 'fa fa-photo',
                    ]
                ],
            ]
        );

        $this->add_control(
            'wpb_ea_service_box_icon',
            [
                'label'             => esc_html__( 'Icon', 'wpb-elementor-addons' ),
                'type'              => \Elementor\Controls_Manager::ICONS,
                'default'           => [
                    'value'     => 'lni-layers',
                    'library'   => 'lineicons',
                ],
                'condition'         => [
                    'wpb_ea_service_box_icon_type' => "icon",  
                ]
            ]
        );

        $this->add_control(
            'wpb_ea_service_box_icon_style',
            [
                'label'             => esc_html__( 'Service Icon Style', 'wpb-elementor-addons' ),
                'type'              => Controls_Manager::SELECT,
                'default'           => 'default',
                'options'           => [
                    'default'        => esc_html__( 'Default',   'wpb-elementor-addons' ),
                    'grid'           => esc_html__( 'Grid', 'wpb-elementor-addons' )
                ],
                'condition'         => [
                    'wpb_ea_service_box_icon_type' => "icon",  
                ]
            ]
        );

        $this->add_control(
            'wpb_ea_service_box_icon_position',
            [
                'label'             => esc_html__( 'Icon Position', 'wpb-elementor-addons' ),
                'type'              => Controls_Manager::SELECT,
                'default'           => 'left',
                'options'           => [
                    'left'        => esc_html__( 'Left',   'wpb-elementor-addons' ),
                    'right'       => esc_html__( 'Right', 'wpb-elementor-addons' )
                ],
                'condition'         => [
                    'wpb_ea_service_box_icon_type'  => "icon",
                    'wpb_ea_service_box_icon_style' => "default",
                ]
            ]
        );

        $this->add_control(
            'image',
            [
                'label'             => esc_html__( 'Image', 'wpb-elementor-addons' ),
                'type'              => Controls_Manager::MEDIA,
                'default'           => [],
                'condition'         => [
                    'wpb_ea_service_box_icon_type' => "image",
                ]
            ]
        );

        $this->add_control(
            'wpb_ea_service_box_title',
            [
                'label'             => esc_html__( 'Title', 'wpb-elementor-addons' ),
                'placeholder'       => esc_html__( 'Place your title text here.', 'wpb-elementor-addons' ),
                'type'              => Controls_Manager::TEXT,
                'default'           => esc_html__( 'Lorem Ipsum is dummy', 'wpb-elementor-addons' ) 
            ]
        );

        $this->add_control(
            'wpb_ea_service_box_text',
            [
                'label'             => esc_html__( 'Description', 'wpb-elementor-addons' ),
                'type'              => Controls_Manager::TEXTAREA,
                'placeholder'       => esc_html__( 'Place your description text here.', 'wpb-elementor-addons' ),       
                'default'           => esc_html__( 'Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries.', 'wpb-elementor-addons' ), 
            ]
        );

        $this->add_control(
            'wpb_ea_service_box_btn_text',
            [
                'label'             => esc_html__( 'Button Text', 'wpb-elementor-addons' ),
                'placeholder'       => esc_html__( 'Details button text.', 'wpb-elementor-addons' ),
                'type'              => Controls_Manager::TEXT,
                'default'           => esc_html__( 'Read More', 'wpb-elementor-addons' ) 
            ]
        );

        $this->add_control(
            'wpb_ea_service_box_btn_link',
            [
                'label'         => esc_html__( 'Button Link', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::URL,
                'label'         => esc_html__( 'Link', 'wpb-elementor-addons' ),
            ]
        );

        $this->add_control(
            'wpb_ea_service_title_link',
            [
                'label'         => esc_html__( 'Title Link?', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,              
                'default'       => 'no',
                'return_value'  => 'yes',                      
            ]
        );

        $this->end_controls_section();	           


        $this->start_controls_section(
            'wpb_ea_service_box_style_section',
            [
                'label'         => esc_html__('General Style Settings', 'wpb-elementor-addons'),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );
        
        // service box background color
        $this->add_control(
            'wpb_ea_service_box_bg_color',
            [
                'label'         => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::COLOR,             
                'default'       => '#ffffff',  
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-service-box.wpb-ea-service-box-icon-style-grid' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .wpb-ea-service-box.wpb-ea-service-box-type-image .wpb-ea-service-box-content' => 'background-color: {{VALUE}};',
                ],               
            ]
        );

        // service box padding
        $this->add_control(
            'wpb_ea_service_box_padding',
            [
                'label'         => esc_html__( 'Padding', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'default'       => [
                    'top'       => 35,
                    'right'     => 30,
                    'bottom'    => 35,
                    'left'      => 30
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-service-box.wpb-ea-service-box-type-image .wpb-ea-service-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'         => [
                    'wpb_ea_service_box_icon_type' => "image",  
                ]
            ]
        );

        // service box padding icon grid
        $this->add_control(
            'wpb_ea_service_box_icon_grid_padding',
            [
                'label'         => esc_html__( 'Padding', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'default'       => [
                    'top'       => 40,
                    'right'     => 40,
                    'bottom'    => 40,
                    'left'      => 40
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-service-box.wpb-ea-service-box-type-icon.wpb-ea-service-box-icon-style-grid' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'         => [
                    'wpb_ea_service_box_icon_type'  => "icon",
                    'wpb_ea_service_box_icon_style' => "grid",
                ]
            ]
        );

        // service box margin
        $this->add_control(
            'wpb_ea_service_box_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'default'       => [
                    'bottom'    => 30
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-service-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        // service box border radius
        $this->add_control(
            'wpb_ea_service_box_border_radius',
            [
                'label'         => esc_html__( 'Border Radius', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'        => [
                        'max'   => 50,
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-service-box' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        // service box alignment
        $this->add_responsive_control(
            'wpb_ea_service_box_align',
            [
                'label'         => esc_html__( 'Alignment', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::CHOOSE,
                'options'       => [
                    'left'      => [
                        'title' => esc_html__( 'Left', 'wpb-elementor-addons' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'    => [
                        'title' => esc_html__( 'Center', 'wpb-elementor-addons' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'     => [
                        'title' => esc_html__( 'Right', 'wpb-elementor-addons' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'justify'   => [
                        'title' => esc_html__( 'Justified', 'wpb-elementor-addons' ),
                        'icon'  => 'fa fa-align-justify',
                    ],
                ],
                'default'       => 'center',
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-service-box' => 'text-align: {{VALUE}};',
                ],
                'condition'         => [
                    'wpb_ea_service_box_icon_type' => 'image',
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * service box icon style
         * -------------------------------------------
         */
        $this->start_controls_section(
            'wpb_ea_service_box_icon_style_section',
            [
                'label'         => esc_html__( 'Icon Style', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );

        // service box icon color
        $this->add_control(
            'wpb_ea_service_box_icon_color',
            [
                'label'         => esc_html__( 'Color', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-service-box i' => 'color: {{VALUE}};',
                ],
                'default'       => $wpb_ea_primary_color,
                'condition'         => [
                    'wpb_ea_service_box_icon_type'  => "icon",
                ]         
            ]
        );

        $this->add_control(
            'wpb_ea_service_box_icon_grid_bg_color',
            [
                'label'         => esc_html__( 'Icon Background Color', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-service-box-icon-style-grid i' => 'background-color: {{VALUE}};',
                ],
                'default'       => 'rgba(72, 146, 248, 0.2)',
                'condition'         => [
                    'wpb_ea_service_box_icon_type'  => "icon",
                    'wpb_ea_service_box_icon_style' => "grid",
                ]        
            ]
        );
        
        // service box icon typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_service_box_typography',
                'selector'      => '{{WRAPPER}} .wpb-ea-service-box i',                
                'exclude' => [
                    'text_transform', 'font_family' // font_size, font_weight, text_transform, font_style, text_decoration, line_height, letter_spacing
                ]
            ]
        );

        // service box icon margin
        $this->add_control(
            'wpb_ea_service_box_icon_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-service-box i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],               
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * service box image style
         * -------------------------------------------
         */
        $this->start_controls_section(
            'wpb_ea_service_box_image_style_section',
            [
                'label'         => esc_html__( 'Image Style', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );

        // service box image enable(lightbox)
        $this->add_control(
            'wpb_ea_service_box_image_lightbox_enable',
            [
                'label'        => esc_html__( 'Enable Lightbox', 'wpb-elementor-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes'
            ]
        );  

        // service box image type
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'          => 'image_size',
                'label'         => esc_html__( 'Image Type', 'wpb-elementor-addons' ),
                'default'       => 'medium_large',
            ]
        );

        // service box image custom height?
        $this->add_control(
            'wpb_ea_service_box_custom_image_height',
            [
                'label'         => esc_html__( 'Custom Height?', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,              
                'default'       => 'no',
                'return_value'  => 'yes'                       
            ]
        );

        // service box image height
        $this->add_control(
            'wpb_ea_service_box_image_height',
            [
                'label'         => esc_html__( 'Image height', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 270,
                ],                
                'range'         => [
                    'px'        => [
                        'min'   => 1,
                        'max'   => 1000,
                        'step'  => 1
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-service-box img' => 'height: {{SIZE}}{{UNIT}};',
                ],    
                'condition'     => [
                    '.wpb_ea_service_box_custom_image_height' => 'yes'
                ]            
            ]
        );    

        // service box image border radius
        $this->add_control(
            'wpb_ea_service_box_image_border_radius_style',
            [
                'label'         => esc_html__( 'Border Radius', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-service-box img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]          
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * service box content style
         * -------------------------------------------
         */
        $this->start_controls_section(
            'wpb_ea_service_box_content_style_section',
            [
                'label'         => esc_html__( 'Content Style', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );

        // service box title style
        $this->add_control(
            'wpb_ea_service_box_title_style',
            [
                'label'         => esc_html__( 'Title', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING,            
				'separator'     => 'before'
			]
        );

        // service box title color
        $this->add_control(
            'wpb_ea_service_box_title_color',
            [
                'label'         => esc_html__( 'Color', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-service-box h3' => 'color: {{VALUE}};',
                ],
                'default'       => '#000000'
            ]
        );

        // service box title typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_service_box_title_typography',
                'selector'      => '{{WRAPPER}} .wpb-ea-service-box h3',
            ]
        );

        // service box title margin
        $this->add_control(
            'wpb_ea_service_box_title_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-service-box h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // service box description style
        $this->add_control(
            'wpb_ea_service_box_description_style',
            [
                'label'         => esc_html__( 'Description', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING, 
                'separator'     => 'before'
            ]
        );

        // service box description color
        $this->add_control(
            'wpb_ea_service_box_description_color',
            [
                'label'         => esc_html__( 'Color', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-service-box span.wpb-ea-service-box-text p' => 'color: {{VALUE}};',
                ],
                'default'       => '#777777'
            ]
        );

        // service box description typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_service_box_description_typography',
                'selector'      => '{{WRAPPER}} .wpb-ea-service-box span.wpb-ea-service-box-text p',
            ]
        );

        // service box description margin
        $this->add_control(
            'wpb_ea_service_box_description_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-service-box span.wpb-ea-service-box-text p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'wpb_ea_service_box_btn_color',
            [
                'label'         => esc_html__( 'Button Color', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-service-box-btn' => 'color: {{VALUE}};',
                ],
                'default'       => '#2d2d2d'
            ]
        );

        $this->add_control(
            'wpb_ea_service_box_btn_color_hover',
            [
                'label'         => esc_html__( 'Button Color Hover', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-service-box-btn:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wpb-ea-service-box-btn:focus' => 'color: {{VALUE}};',
                ],
                'default'       => '#2d2d2d'
            ]
        );

        $this->end_controls_section();       
       
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

        return sprintf( '<img src="%s" alt="%s" />', esc_url($image_src), esc_html($item['wpb_ea_service_box_title']) );
    }    

	protected function render() {
		$settings  = $this->get_settings_for_display();

        if ( $settings['wpb_ea_service_box_btn_link']['is_external'] === 'on' ) {
            $target = 'target= _blank';
        } else {
            $target = '';
        }
        if ( $settings['wpb_ea_service_box_btn_link']['nofollow'] === 'on' ) {
            $target .= ' rel= nofollow ';
        }

        $icon_style = '';
        $icon_position = '';
        if( $settings['wpb_ea_service_box_icon_type'] == 'icon' ){
            $icon_style     = ' wpb-ea-service-box-icon-style-' . $settings['wpb_ea_service_box_icon_style'];

            if( $settings['wpb_ea_service_box_icon_style'] == 'default' ){
                $icon_position  = ' wpb-ea-service-box-icon-position-' . $settings['wpb_ea_service_box_icon_position'];
            }
        }

        echo '<div class="wpb-ea-service-box wpb-ea-service-box-type-'. esc_attr( $settings['wpb_ea_service_box_icon_type'] ) .''. esc_attr( $icon_style ) .''. esc_attr( $icon_position ) .'">';
            if ( ! empty( $settings['image']['url'] ) && ( $settings['wpb_ea_service_box_icon_type'] == 'image' ) ) {
                if ( ( $settings['wpb_ea_service_box_image_lightbox_enable'] == 'yes' ) ) { 
                    echo '<a href="'. esc_url( $settings['image']['url'] ) .'" class="elementor-clickable">'; 
                }
                echo '<div class="wpb-ea-service-box-image">';                                
                    echo $this->render_image( $settings, $settings );
                echo '</div>';                                                    
                if ( $settings['wpb_ea_service_box_image_lightbox_enable'] == 'yes' ){ 
                    echo '</a>'; 
                }
            }
			if ( ! empty( $settings['wpb_ea_service_box_icon'] ) && ( $settings['wpb_ea_service_box_icon_type'] == 'icon' ) ) :
                echo '<div class="wpb-ea-service-box-icon">';
                    \Elementor\Icons_Manager::render_icon( $settings['wpb_ea_service_box_icon'], [ 'aria-hidden' => 'true' ] );
                echo '</div>';
			endif;

            echo '<div class="wpb-ea-service-box-content">';   
    			if ( ! empty( $settings['wpb_ea_service_box_title'] ) ) :
                    if( $settings['wpb_ea_service_title_link'] == 'yes' ){
                        echo '<a href="'. esc_url($settings['wpb_ea_service_box_btn_link']['url']) .'" '. esc_attr($target) .'>';
                    }
    				    echo '<h3 class="wpb-ea-service-box-title">'. esc_html( $settings['wpb_ea_service_box_title'] ) .'</h3>';
                    if( $settings['wpb_ea_service_title_link'] == 'yes' ){
                        echo '</a>';
                    }
    			endif;
    			if ( ! empty( $settings['wpb_ea_service_box_text'] ) ) : 
    				echo '<span class="wpb-ea-service-box-text">'. wpautop( wp_kses_post( ($settings['wpb_ea_service_box_text'] ) ) ) .'</span>';
    			endif;
                if ( ! empty( $settings['wpb_ea_service_box_btn_text'] ) ) :
                    echo '<a class="wpb-ea-service-box-btn" href="'. esc_url($settings['wpb_ea_service_box_btn_link']['url']) .'" '. esc_attr($target) .'>'. esc_html( $settings['wpb_ea_service_box_btn_text'] ) .'</a>';
                endif;
            echo '</div>';
        echo '</div>';

        
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new WPB_EA_Widget_Service_Box() );