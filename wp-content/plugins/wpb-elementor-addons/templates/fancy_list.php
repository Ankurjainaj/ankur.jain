<?php
/**
 * @author  WpBean
 * @version 1.0
 */

namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class WPB_EA_Fancy_List extends Widget_Base {

    public function get_name() {
        return 'wpb-ea-fany-list';
    }

    public function get_title() {
        return esc_html__( 'WPB Fancy List', 'wpb-elementor-addons' );
    }

    public function get_icon() {
        return 'eicon-editor-list-ul';
    }

    public function get_categories() {
        return [ 'wpb_ea_widgets' ];
    }

    protected function _register_controls() {
        $wpb_ea_primary_color = wpb_ea_get_option( 'wpb_ea_primary_color', 'wpb_ea_style', '#3878ff' );

        $this->start_controls_section(
            'wpb_ea_fancy_list_details',
            [
                'label' => esc_html__( 'Fancy List', 'wpb-elementor-addons' )
            ]
        );

        $this->add_control(
            'wpb_ea_fancy_lists_type',
            [
                'label'     => esc_html__( 'List Type', 'wpb-elementor-addons' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'default',
                'options'   => [
                    'default'     => esc_html__( 'Default', 'wpb-elementor-addons' ),
                    'boxed'       => esc_html__( 'Boxed', 'wpb-elementor-addons' ),
                ],
            ]
        );

        $this->add_control(
            'wpb_ea_fancy_lists',
            [
                'label'       => esc_html__( 'Lists', 'wpb-elementor-addons' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'default'     => [
                    [ 'title' => esc_html__( 'Travel and Aviation Consulting', 'wpb-elementor-addons' ) ],
                    [ 'title' => esc_html__( 'Business Services Consulting', 'wpb-elementor-addons' ) ],
                    [ 'title' => esc_html__( 'Consumer Products Consulting', 'wpb-elementor-addons' ) ]
                ],
                'fields'      => [
                    [
                        'type'          => \Elementor\Controls_Manager::TEXT,
                        'name'          => 'title',
                        'label_block'   => true,
                        'label'         => esc_html__( 'Content', 'wpb-elementor-addons' ),
                        'default'       => esc_html__( 'List title', 'wpb-elementor-addons' )
                    ],
                    [
                        'type'        => \Elementor\Controls_Manager::ICONS,
                        'name'        => 'fancy_list_icon',
                        'label'       => esc_html__( 'Icon', 'wpb-elementor-addons' ),
                        'label_block' => true,
                        'default'     => [
                            'value'     => 'far fa-check-circle',
                            'library'   => 'regular',
                        ],
                    ],                    
                    [
                        'type'          => \Elementor\Controls_Manager::URL,
                        'name'          => 'link',
                        'label'         => esc_html__( 'Link', 'wpb-elementor-addons' ),
                        'placeholder'   => esc_html__( 'https://yoursite.com', 'wpb-elementor-addons' )
                    ]
                ],
                'title_field' => '{{title}}',
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
         * color & typography
         * -------------------------------------------
         */
        // fancy list style
        $this->start_controls_section(
            'wpb_ea_fancy_list_typography_section',
            [
                'label'         => esc_html__( 'List', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );

        // space between fancy list items
        $this->add_responsive_control(
            'wpb_ea_fancy_list_space_between',
            [
                'label'         => esc_html__( 'Space Between', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'        => [
                        'max'   => 50
                    ]
                ],
                'default'       => [
                    'size'      => 20
                ],                
                'selectors'     => [
                    '{{WRAPPER}} ul.wpb_ea_fancy_lists li:not(:first-child)' => 'margin: calc({{SIZE}}{{UNIT}}/2) 0',
                    '{{WRAPPER}} ul.wpb_ea_fancy_lists.wpb_ea_fancy_lists_type_default li:not(:last-child)'  => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)'
                ]
            ]
        );

        // fancy list items align
        $this->add_responsive_control(
            'wpb_ea_fancy_list_items_align',
            [
                'label'         => esc_html__( 'Alignment', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'left'      => [
                        'title' => esc_html__( 'Start', 'wpb-elementor-addons' ),
                        'icon'  => 'eicon-h-align-left'
                    ],
                    'center'    => [
                        'title' => esc_html__( 'Center', 'wpb-elementor-addons' ),
                        'icon'  => 'eicon-h-align-center'
                    ],
                    'right'     => [
                        'title' => esc_html__( 'End', 'wpb-elementor-addons' ),
                        'icon'  => 'eicon-h-align-right'
                    ]
                ],
                'prefix_class'  => 'elementor%s-align-',
                'classes'       => 'elementor-control-start-end'
            ]
        );

        $this->end_controls_section();

        // fancy list icon style
        $this->start_controls_section(
            'wpb_ea_fancy_list_icon_style',
            [
                'label'         => esc_html__( 'Icon', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );

        // fancy list text indent
        $this->add_control(
            'wpb_ea_fancy_list_text_indent',
            [
                'label'         => esc_html__( 'Space Between Icon and Text', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'        => [
                        'max'   => 50
                    ],
                ],
                'default'       => [
                    'size'      => 15
                ],                
                'selectors'     => [
                    '{{WRAPPER}} ul.wpb_ea_fancy_lists li span.wpb-ea-fancy-list-text' => is_rtl() ? 'padding-right: {{SIZE}}{{UNIT}};' : 'padding-left: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        // fancy list icon color
        $this->add_control(
            'wpb_ea_fancy_list_icon_color',
            [
                'label'         => esc_html__( 'Icon Color', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'default'       => $wpb_ea_primary_color,                 
                'selectors'     => [
                    '{{WRAPPER}} ul.wpb_ea_fancy_lists.wpb_ea_fancy_lists_type_default li i' => 'color: {{VALUE}};'
                ],
                'condition'     => [
                    '.wpb_ea_content_box.wpb_ea_fancy_lists_type' => 'default'
                ]
            ]
        );

        // fancy list icon bg color
        $this->add_control(
            'wpb_ea_fancy_list_icon_bg_color',
            [
                'label'         => esc_html__( 'Icon Background Color', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'default'       => $wpb_ea_primary_color,                 
                'selectors'     => [
                    '{{WRAPPER}} ul.wpb_ea_fancy_lists.wpb_ea_fancy_lists_type_boxed li i' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} ul.wpb_ea_fancy_lists.wpb_ea_fancy_lists_type_boxed li i:after' => 'background-color: {{VALUE}};'
                ],
                'condition'     => [
                    '.wpb_ea_content_box.wpb_ea_fancy_lists_type' => 'boxed'
                ]
            ]
        );

        // fancy list icon size
        $this->add_responsive_control(
            'wpb_ea_fancy_list_icon_size',
            [
                'label'         => esc_html__( 'Size', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 14
                ],
                'range'         => [
                    'px'        => [
                        'min'   => 6
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} ul.wpb_ea_fancy_lists li i' => 'font-size: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        // fancy list text style
        $this->start_controls_section(
            'wpb_ea_fancy_list_text_style',
            [
                'label'         => esc_html__( 'Text', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );

        // fancy list text color
        $this->add_control(
            'wpb_ea_fancy_list_text_color',
            [
                'label'         => esc_html__( 'Text Color', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::COLOR,
                'default'       => '',
                'selectors'     => [
                    '{{WRAPPER}} ul.wpb_ea_fancy_lists li' => 'color: {{VALUE}};'
                ],
                'default'       => '#3c4858'
            ]
        );

        // fancy list text link color
        $this->add_control(
            'wpb_ea_fancy_list_text_link_color',
            [
                'label'         => esc_html__( 'Link Color', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::COLOR,
                'default'       => '',
                'selectors'     => [
                    '{{WRAPPER}} ul.wpb_ea_fancy_lists li a' => 'color: {{VALUE}};'
                ],
                'default'       => '#3c4858'
            ]
        );

        // fancy list text hover color
        $this->add_control(
            'wpb_ea_fancy_list_text_link_hover_color',
            [
                'label'         => esc_html__( 'Link Hover Color', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::COLOR,
                'default'       => '',
                'selectors'     => [
                    '{{WRAPPER}} ul.wpb_ea_fancy_lists li a:hover' => 'color: {{VALUE}};'
                ],
                'default'       => $wpb_ea_primary_color
            ]
        );

        //fancy list text typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'fancy_list_typography',
                'scheme'        => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} ul.wpb_ea_fancy_lists li'            
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings                   = $this->get_settings_for_display();
        $wpb_ea_fancy_lists_type    = $settings['wpb_ea_fancy_lists_type'];
        $extra_css                  = $settings['extra_css'];

        if($extra_css){
            $extra_css = $extra_css.' ';
        }

        if( is_array( $settings['wpb_ea_fancy_lists'] ) ) : 
            echo '<ul class="'. esc_attr( $extra_css ) .'wpb_ea_fancy_lists wpb_ea_fancy_lists_type_'. esc_attr( $wpb_ea_fancy_lists_type ) .'">'; 
                foreach ( $settings['wpb_ea_fancy_lists'] as $list ) : 

                    $icon = '';
                    if($list['fancy_list_icon']['value']){
                        ob_start();
                        \Elementor\Icons_Manager::render_icon( $list['fancy_list_icon'] );
                        $icon = ob_get_clean();
                    }


                    if ( $list['link']['url'] ) :
                        if ( $list['link']['is_external'] === 'on' ) {
                            $target = 'target= _blank';
                        } else {
                            $target = '';
                        }
                        if ( $list['link']['nofollow'] === 'on' ) {
                            $target .= ' rel= nofollow ';
                        }      
                        echo '<li><a href="'. esc_url( $list['link']['url'] ) .'" '. esc_attr( $target ) .'>'.$icon.'<span class="wpb-ea-fancy-list-text">'. esc_html( $list['title'] ) .'</span></a></li>';
                    else :
                        echo '<li>'.$icon. '<span class="wpb-ea-fancy-list-text">'.esc_html( $list['title'] ) .'</span></li>';
                    endif;               
                endforeach; 
            echo '</ul>';
        endif; 
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new WPB_EA_Fancy_List() );

