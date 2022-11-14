<?php
/**
 * @author  WpBean
 * @version 1.0
 */

namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class WPB_EA_Widget_Content_Timeline extends Widget_Base {

    public function get_name() {
        return 'wpb-ea-timeline';
    }

    public function get_title() {
        return esc_html__( 'WPB Content Timeline', 'wpb-elementor-addons' );
    }

    public function get_icon() {
        return 'eicon-time-line';
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
        return ['wpb-ea-super-js'];
    }

    protected function _register_controls() {
        $wpb_ea_primary_color = wpb_ea_get_option( 'wpb_ea_primary_color', 'wpb_ea_style', '#3878ff' );

        // timeline section
        $this->start_controls_section(
            'wpb_ea_testimonial',
            [
                'label' => esc_html__( 'Content Timeline', 'wpb-elementor-addons' )
            ]
        );

        $this->add_control(
            'wpb_ea_timeline_type',
            [
                'label'     => esc_html__( 'Timeline Type', 'wpb-elementor-addons' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'left-right',
                'options'   => [
                    'left-right'    => esc_html__( 'Left and Right', 'wpb-elementor-addons' ),
                    'left'       	=> esc_html__( 'Left Side Only', 'wpb-elementor-addons' ),
                    'right'       	=> esc_html__( 'Right Side Only', 'wpb-elementor-addons' ),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'          => 'image_size',
                'label'         => esc_html__( 'Image Size', 'wpb-elementor-addons' ),
                'default'       => 'medium_large'
            ]
        );

        $this->add_control(
            'wpb_ea_disable_date',
            [
                'label'         => esc_html__( 'Disable date?', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,              
                'default'       => 'no',
                'return_value'  => 'yes',                      
            ]
        );

        $this->add_control(
            'wpb_ea_timeline_items',
            [
                'label'       => esc_html__( 'Timeline Items', 'wpb-elementor-addons' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'default'     => [
                    [ 
                        'date'      => esc_html__( 'March 23, 2020', 'wpb-elementor-addons' ),
                    	'icon' 		=> ['value' => 'fas fa-file', 'library'  => 'solid'],
                    	'title' 	=> esc_html__( 'Lorem ipsum dolor sit amet', 'wpb-elementor-addons' ),
                    	'content' 	=> esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.', 'wpb-elementor-addons' ),
                    ],
                    [ 
                    	'date' 		=> esc_html__( 'March 23, 2020', 'wpb-elementor-addons' ),
                        'icon'      => ['value' => 'far fa-calendar', 'library'  => 'regular'],
                    	'title' 	=> esc_html__( 'Donec nec justo eget felis', 'wpb-elementor-addons' ),
                    	'content' 	=> esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.', 'wpb-elementor-addons' ),
                    ],
                    [ 
                    	'date' 		=> esc_html__( 'March 23, 2020', 'wpb-elementor-addons' ),
                        'icon'      => ['value' => 'fas fa-cloud', 'library'  => 'solid'],
                    	'title' 	=> esc_html__( 'Morbi in sem quis dui placerat', 'wpb-elementor-addons' ),
                    	'content' 	=> esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.', 'wpb-elementor-addons' ),
                    ]
                ],
                'fields'      => [
                	[
                        'type'        => \Elementor\Controls_Manager::ICONS,
                        'name'        => 'icon',
                        'label'       => esc_html__( 'Icon', 'wpb-elementor-addons' ),
                        'label_block' => true,
                        'default'     => [
                            'value'     => 'fas fa-file',
                            'library'   => 'solid',
                        ],
                    ],
                    [
                        'type'          	=> \Elementor\Controls_Manager::DATE_TIME,
                        'name'          	=> 'date',
                        'label_block'  		=> true,
                        'label'         	=> esc_html__( 'Date', 'wpb-elementor-addons' ),
                        'default'       	=> esc_html__( 'March 23, 2020', 'wpb-elementor-addons' ),
                        'picker_options'	=> array(
                        	'enableTime' => false,
                        ),
                    ],   
                    [
                        'type'          => \Elementor\Controls_Manager::TEXT,
                        'name'          => 'title',
                        'label_block'   => true,
                        'label'         => esc_html__( 'Title', 'wpb-elementor-addons' ),
                        'default'       => esc_html__( 'Timeline item title', 'wpb-elementor-addons' )
                    ],                   
                    [
                        'type'          => \Elementor\Controls_Manager::TEXTAREA,
                        'name'          => 'content',
                        'label'         => esc_html__( 'Content', 'wpb-elementor-addons' ),
                    ],
                    [
                        'name'              => 'image',
                        'label'             => esc_html__( 'Image', 'wpb-elementor-addons' ),
                        'type'              => Controls_Manager::MEDIA,
                    ],
                    [
                        'type'          => \Elementor\Controls_Manager::TEXT,
                        'name'          => 'shortcode',
                        'label_block'   => true,
                        'label'         => esc_html__( 'ShortCode', 'wpb-elementor-addons' ),
                        'placeholder'   => esc_html__( '[products]', 'wpb-elementor-addons' )
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


        $this->end_controls_section();


        /**
         * style settings
         */

        $this->start_controls_section(
            'wpb_ea_timeline_style',
            [
                'label'         => esc_html__( 'Style', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'wpb_ea_timeline_bg_color',
            [
                'label'         => esc_html__( 'Timeline Background', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::COLOR,
                'default'       => '',
                'selectors'     => [
                    '{{WRAPPER}} .wpb-timeline-content' 		=> 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .wpb-timeline-area .wpb-timeline-content::before' => 'background-color: {{VALUE}};',
                ],
                'default'       => '#fff'
            ]
        );

        $this->add_control(
            'wpb_ea_timeline_icon_bg_color',
            [
                'label'         => esc_html__( 'Icon Background', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::COLOR,
                'default'       => '',
                'selectors'     => [
                    '{{WRAPPER}} .wpb-timeline-icon' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .wpb-timeline-date span' => 'background-color: {{VALUE}};'
                ],
                'default'       => '#3878ff'
            ]
        );

        $this->add_control(
            'wpb_ea_timeline_icon_color',
            [
                'label'         => esc_html__( 'Icon Color', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::COLOR,
                'default'       => '',
                'selectors'     => [
                    '{{WRAPPER}} .wpb-timeline-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wpb-timeline-date span' => 'color: {{VALUE}};'
                ],
                'default'       => '#fff'
            ]
        );

        $this->add_control(
            'wpb_ea_timeline_bar_bg_color',
            [
                'label'         => esc_html__( 'Timeline Bar Background', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::COLOR,
                'default'       => '',
                'selectors'     => [
                    '{{WRAPPER}} .wpb-timeline-area::before' => 'background-color: {{VALUE}};'
                ],
                'default'       => '#d7e4ed'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_timeline_title_typography',
                'selector'      => '{{WRAPPER}} .wpb-timeline-block h3'
            ]
        );

        $this->add_control(
			'wpb_ea_timeline_shadow',
			[
				'label' 		=> esc_html__( 'Timeline Shadow', 'wpb-elementor-addons' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> esc_html__( 'Yes', 'your-plugin' ),
				'label_off' 	=> esc_html__( 'No', 'your-plugin' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
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

        return sprintf( '<img src="%s" alt="%s" />', esc_url($image_src), esc_html($item['title']) );
    }

    protected function render() {
        $settings  					= $this->get_settings_for_display(); 
        $wpb_ea_timeline_items    	= $settings['wpb_ea_timeline_items'];
        $wpb_ea_timeline_type 		= $settings['wpb_ea_timeline_type'];
        $wpb_ea_timeline_shadow 	= $settings['wpb_ea_timeline_shadow'];
        
        if( is_array( $settings['wpb_ea_timeline_items'] ) ) : ?>
	        <div class="wpb-timeline-area wpb-timeline-<?php echo esc_attr( $wpb_ea_timeline_type ); ?> wpb-timeline-shadow-<?php echo esc_attr( $wpb_ea_timeline_shadow ); ?>">

	        	<?php foreach ( $settings['wpb_ea_timeline_items'] as $item ) : ?>

					<div class="wpb-timeline-block">
						<?php do_action( 'wpb_ea_before_timeline_item', $item ); ?>
						<?php if( $item['icon'] ): ?>
							<div class="wpb-timeline-icon">
                                <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </div>
						<?php endif; ?>
						<div class="wpb-timeline-content">
							<?php if( $item['date'] && $settings['wpb_ea_disable_date'] != 'yes' ): ?>
								<div class="wpb-timeline-date"><span><?php echo date_i18n( apply_filters( 'wpb_ea_timeline_date_format', get_option( 'date_format' ) ) , strtotime( $item['date']) ); ?></span></div>
							<?php endif; ?>

							<?php  
								if ( $item['link']['url'] ) {
			                        if ( $item['link']['is_external'] === 'on' ) {
			                            $target = 'target= _blank';
			                        } else {
			                            $target = '';
			                        }
			                        if ( $item['link']['nofollow'] === 'on' ) {
			                            $target .= ' rel= nofollow ';
			                        }

			                        ( $item['title'] ? printf( '<h3><a href="%s" %s>%s</a></h3>', esc_url( $item['link']['url'] ),esc_attr( $target ), esc_html( $item['title'] )) : '' );

		                        }else {
		                        	( $item['title'] ? printf( '<h3>%s</h3>', esc_html( $item['title'] )) : '' ); 
		                    	}
							?>

							<?php echo wpautop( $item['content'] ); ?>

                            <?php 
                                if( $item['shortcode'] ){
                                    echo do_shortcode( $item['shortcode'] );
                                }
                            ?>

							<?php
	                            echo ( ! empty( $item['image']['url'] ) ? '<div class="wpb-timeline-image">'. $this->render_image( $item, $settings ) .'</div>' : '' );
							?>
						</div>
						<?php do_action( 'wpb_ea_after_timeline_item', $item ); ?>
					</div>

			  	<?php endforeach; ?>

			</div>
		<?php endif; ?>

        <?php
    }   
}

Plugin::instance()->widgets_manager->register_widget_type( new WPB_EA_Widget_Content_Timeline() );