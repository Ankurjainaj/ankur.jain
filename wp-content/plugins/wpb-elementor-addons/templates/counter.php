<?php
/**
 * @author  WpBean
 * @version 1.0
 */

namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class WPB_EA_CounterUp extends Widget_Base {

    public function get_name() {
        return 'wpb-ea-counterup-settings';
    }

    public function get_title() {
        return esc_html__( 'WPB CounterUp', 'wpb-elementor-addons' );
    }

    public function get_icon() {
        return 'eicon-counter';
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
            'wpb-ea-counterup',
            'wpb-ea-waypoints',
            'wpb-ea-super-js'
        ];
    }

    protected function _register_controls() {
        $wpb_ea_primary_color = wpb_ea_get_option( 'wpb_ea_primary_color', 'wpb_ea_style', '#3878ff' );
        
        $this->start_controls_section(
            'wpb_ea_counterup_details',
            [
                'label' => esc_html__( 'CounterUp Details', 'wpb-elementor-addons' )
            ]
        );

        $this->add_control(
            'wpb_ea_counterup_lists',
            [
                'label'       => esc_html__( 'CounterUp Items', 'wpb-elementor-addons' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'default'     => [
                    [
                        'number'    => 6000,
                        'icon'      => ['value' => 'far fa-thumbs-up', 'library'  => 'regular'],
                        'title'     => esc_html__( 'Happy Clients', 'wpb-elementor-addons' ),
                    ],
                    [
                        'number'    => 9560,
                        'icon'      => ['value' => 'far fa-check-circle', 'library'  => 'regular'],
                        'title'     => esc_html__( 'Completed Projects', 'wpb-elementor-addons' ),
                    ],
                    [
                        'number'    => 165893,
                        'icon'      => ['value' => 'fas fa-coffee', 'library'  => 'solid'],
                        'title'     => esc_html__( 'Cups of Coffee', 'wpb-elementor-addons' ),
                    ],
                    [
                        'number'    => 12356789,
                        'icon'      => ['value' => 'fas fa-code', 'library'  => 'solid'],
                        'title'     => esc_html__( 'Lines of Code', 'wpb-elementor-addons' ),
                    ],
                ],
                'fields'            => [
                    [
                        'type'          => Controls_Manager::CHOOSE,
                        'name'          => 'icon_type',
                        'label_block'   => true,
                        'label'         => esc_html__( 'Type', 'wpb-elementor-addons' ),
                        'default'       => 'icon',
                        'options'       => [                            
                            'icon'      => [
                                'title' => esc_html__( 'Icon', 'wpb-elementor-addons' ),
                                'icon'  => 'fa fa-diamond',
                            ],
                            'custom'    => [
                                'title' => esc_html__( 'Image', 'wpb-elementor-addons' ),
                                'icon'  => 'fa fa-photo',
                            ],
                        ]
                    ],
                    [
                        'name'          => 'icon',
                        'label'         => esc_html__( 'Icon', 'wpb-elementor-addons' ),
                        'type'          => \Elementor\Controls_Manager::ICONS,
                        'default'       => [
                            'value'     => 'fas fa-star',
                            'library'   => 'solid',
                        ],
                        'condition'     => [
                            'icon_type' => 'icon',
                        ],
                    ],
                    [
                        'name'          => 'custom',
                        'label'         => esc_html__( 'Image', 'wpb-elementor-addons' ),
                        'label_block'   => true,
                        'type'          => Controls_Manager::MEDIA,                       
                        'condition'     => [
                            'icon_type' => 'custom',
                        ],
                    ],
                    [
                        'type'          => Controls_Manager::TEXT,
                        'name'          => 'title',
                        'label_block'   => true,
                        'label'         => esc_html__( 'Title', 'wpb-elementor-addons' ),
                        'default'       => 'Type your title',
                    ],
                    [
                        'type'          => Controls_Manager::NUMBER,
                        'name'          => 'number',
                        'label'         => esc_html__( 'Number', 'wpb-elementor-addons' ),
                        'default'       => 123456,
                    ],
                ],
                'title_field' => '{{title}}',
            ]
        );

        $this->add_control(
            'column',
            [
                'label'         => esc_html__( 'Column', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 4,
                'options'       => [
                    6           => esc_html__( '6 Columns', 'wpb-elementor-addons' ),
                    4           => esc_html__( '4 Columns', 'wpb-elementor-addons' ),
                    3           => esc_html__( '3 Columns', 'wpb-elementor-addons' ),
                    2           => esc_html__( '2 Columns', 'wpb-elementor-addons' ),
                    1           => esc_html__( '1 Columns', 'wpb-elementor-addons' ),
                ],
            ]
        );

        // counnterup icon align
        $this->add_control(
            'wpb_ea_counterup_icon_align',
            [
                'label'         => '<i class="fa fa-arrows"></i> ' . esc_html__( 'Icon/Image Position', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::CHOOSE,
                'options'       => [
                    'left'      => [
                        'title' => esc_html__( 'Left', 'wpb-elementor-addons' ),
                        'icon'  => 'fa fa-angle-left',
                    ],
                    'center'    => [
                        'title' => esc_html__( 'Top', 'wpb-elementor-addons' ),
                        'icon'  => 'fa fa-angle-up',
                    ],
                    'right'     => [
                        'title' => esc_html__( 'Right', 'wpb-elementor-addons' ),
                        'icon'  => 'fa fa-angle-right',
                    ],
                ],
                'default'       => 'center',
            ]
        );

        // counnterup icon size
        $this->add_control(
            'icon_size',
            [
                'label'     => esc_html__( 'Icon Font Size', 'wpb-elementor-addons' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px'    => [
                        'min'   => 6,
                        'max'   => 300,
                    ],
                ],
                'default'   => [
                    'size'  => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpb-ea-counterup .wpb-ea-counterup-icon i'     => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wpb-ea-counterup .wpb-ea-counterup-icon img'   => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label'     => esc_html__( 'Icon Circle or Image Size', 'wpb-elementor-addons' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px'    => [
                        'min'   => 6,
                        'max'   => 300,
                    ],
                ],
                'default'   => [
                    'size'  => 70,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpb-ea-counterup .wpb-ea-counterup-icon i'     => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wpb-ea-counterup i'     => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wpb-ea-counterup .wpb-ea-counterup-icon img'   => 'max-width: {{SIZE}}{{UNIT}};',
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


        /**
         * -------------------------------------------
         * counterup style
         * -------------------------------------------
         */
        $this->start_controls_section(
            'wpb_ea_counterup_box_style_section',
            [
                'label'         => esc_html__('counterup Box Style', 'wpb-elementor-addons'),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );
        
        // counterup background color
        $this->add_control(
            'wpb_ea_counterup_bg_color',
            [
                'label'         => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::COLOR, 
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-counterup' => 'background-color: {{VALUE}};'
                ],               
            ]
        );

        // counterup box padding
        $this->add_control(
            'wpb_ea_counterup_padding',
            [
                'label'         => esc_html__( 'Padding', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-counterup' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // counterup margin
        $this->add_control(
            'wpb_ea_counterup_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],                           
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-counterup' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );      

        // counterup border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'wpb_ea_counterup_border',
                'label'         => esc_html__( 'Border Type', 'wpb-elementor-addons' ),
                'selector'      => '{{WRAPPER}} .wpb-ea-counterup',
            ]
        );

        // counterup border radius
        $this->add_control(
            'wpb_ea_counterup_border_radius',
            [
                'label'         => esc_html__( 'Border Radius', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'        => [
                        'max'   => 50,
                    ],
                ],
                'default'       => [
                    'unit'      => 'px',
                    'size'      => 5,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-counterup' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        // counterup box shadow
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'wpb_ea_counterup_box_shadow',
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-counterup',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * color & typography
         * -------------------------------------------
         */
        $this->start_controls_section(
            'wpb_ea_counterup_typography_section',
            [
                'label'         => esc_html__( 'Content Style', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );

        // counterup icon style
        $this->add_control(
            'wpb_ea_counterup_icon_style',
            [
                'label'         => esc_html__( 'Icon Style', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING
            ]
        );

        // counterup icon color
        $this->add_control(
            'wpb_ea_counterup_icon_color',
            [
                'label'         => esc_html__( 'Color', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::COLOR,              
                'default'       => '#fff',  
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-counterup i' => 'color: {{VALUE}};',
                ],               
            ]
        ); 

        // counterup icon color
        $this->add_control(
            'wpb_ea_counterup_icon_bg_color',
            [
                'label'         => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::COLOR,              
                'default'       => $wpb_ea_primary_color,  
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-counterup-icon i' => 'background-color: {{VALUE}};',
                ],               
            ]
        );    

        // counterup number style
        $this->add_control(
            'wpb_ea_counterup_number_style',
            [
                'label'         => esc_html__( 'Number Style', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING,
                'separator'     => 'before'
            ]
        );

        //  counterup number color
        $this->add_control(
            'wpb_ea_counterup_number_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default'       => '#333',
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-counterup h3.wpb-ea-counterup-number'      => 'color: {{VALUE}};'
                ],
            ]
        );

        //  counterup number typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_counterup_number_typography',
                'scheme'        => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .wpb-ea-counterup h3.wpb-ea-counterup-number',
                'exclude'       => [
                    'text_transform', // font_family, font_size, font_weight, text_transform, font_style, text_decoration, line_height, letter_spacing
                ]                
            ]
        );

        // counterup number margin
        $this->add_control(
            'wpb_ea_counterup_number_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],                             
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-counterup h3.wpb-ea-counterup-number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // counterup title style
        $this->add_control(
            'wpb_ea_counterup_title_style',
            [
                'label'         => esc_html__( 'Title Style', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING,
                'separator'     =>  'before'
            ]
        );

        //  counterup title color
        $this->add_control(
            'wpb_ea_counterup_title_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Title color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default'       => '#525151',
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-counterup-title'      => 'color: {{VALUE}};'
                ],
            ]
        );

        //  counterup title typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_counterup_title_typography',
                'scheme'        => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .wpb-ea-counterup-title'
            ]
        );

        // counterup title margin
        $this->add_control(
            'wpb_ea_counterup_title_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],                             
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-counterup-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $extra_css = $settings['extra_css'];
        if($extra_css){
            $extra_css = $extra_css.' ';
        }

        if( is_array( $settings['wpb_ea_counterup_lists'] ) ): 
            $column         = 12/$settings['column'];
            $column_class   = apply_filters( 'wpb_ea_counterup_column_class', 'col-lg-'.esc_attr( $column ). ' col-md-6' );;

            echo '<div class="'.esc_attr( $extra_css ).'wpb-ea-counterup-items ea-row">';
                foreach ( $settings['wpb_ea_counterup_lists'] as $list ) : 
                    echo '<div class="'.esc_attr($column_class).'">';
                        echo '<div class="wpb-ea-counterup wpb-ea-counterup-icon-'.esc_attr($settings['wpb_ea_counterup_icon_align']).'">';
                            echo '<span class="wpb-ea-counterup-icon counterup-icon-text-'.esc_attr($settings['wpb_ea_counterup_icon_align']).'">';
                                if ( ! empty( $list['icon'] ) && ( $list['icon_type'] == 'icon' ) ) :
                                    \Elementor\Icons_Manager::render_icon( $list['icon'], [ 'aria-hidden' => 'true' ] );
                                endif;
                                if ( ! empty( $list['custom'] ) && ( $list['icon_type'] == 'custom' ) ) :
                                    echo wp_get_attachment_image( $list['custom']['id'], 'thumbnail' );
                                endif;
                            echo '</span>';
                            if ( ! empty( $list['number'] ) || ( $list['title'] ) ) :
                                echo '<div class="wpb-ea-counterup-content">';
                                    $list['number'] ? printf('<h3 class="wpb-ea-counterup-number">%s</h3>', esc_html($list['number']) ) : '';
                                    $list['title'] ? printf('<span class="wpb-ea-counterup-title">%s</span>', esc_html($list['title']) ) : '';
                                echo '</div>';
                            endif;
                        echo '</div>';
                    echo '</div>';
                endforeach; 
            echo '</div>';
        endif;
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new WPB_EA_CounterUp() );
