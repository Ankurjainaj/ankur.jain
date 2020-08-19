<?php
/**
 * @author  WpBean
 * @version 1.0
 */

namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class WPB_EA_Videos_Grid extends Widget_Base {

    public function get_name() {
        return 'wpb-ea-videos-grid';
    }

    public function get_title() {
        return esc_html__( 'WPB Videos Grid', 'wpb-elementor-addons' );
    }

    public function get_icon() {
        return 'eicon-youtube';
    }

    public function get_categories() {
        return [ 'wpb_ea_widgets' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'wpb_ea_videos_grid',
            [
                'label' => esc_html__( 'Vides Grid', 'wpb-elementor-addons' )
            ]
        );

        $this->add_control(
            'column',
            [
                'label'         => esc_html__( 'Number of Columns', 'wpb-elementor-addons' ),
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

        $this->add_control(
            'details_text',
            [
                'label'         => esc_html__('Details Text', 'wpb-elementor-addons' ),
                'description'   => esc_html__('Details link text.', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => esc_html__('Details', 'wpb-elementor-addons' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'video_type', [
				'label' 		=> esc_html__( 'Video Type', 'wpb-elementor-addons' ),
				'type' 			=> \Elementor\Controls_Manager::CHOOSE,
				'label_block'   => true,
                'default'       => 'youtube',
                'options'       => [                            
                    'youtube'      => [
                        'title' => esc_html__( 'YouTube', 'wpb-elementor-addons' ),
                        'icon'  => 'fa fa-youtube',
                    ],
                    'self_hosted'    => [
                        'title' => esc_html__( 'Self Hosted', 'wpb-elementor-addons' ),
                        'icon'  => 'fa fa-upload',
                    ],
                ]
			]
		);

        $repeater->add_control(
			'youtube_url', [
				'label' 		=> esc_html__( 'YouTube Video Link', 'wpb-elementor-addons' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'condition'     => [
                    'video_type' => 'youtube',
                ],
			]
		);

		$repeater->add_control(
			'self_hosted', [
				'label' 		=> esc_html__( 'Upload Your Video', 'wpb-elementor-addons' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
				'media_type' 	=> 'video',
				'condition'     => [
                    'video_type' => 'self_hosted',
                ],
			]
		);

		$repeater->add_control(
			'video_thumbnail',
			[
				'label' => esc_html__( 'Video Poster', 'wpb-elementor-addons' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'video_title', [
				'label' 		=> esc_html__( 'Video Title', 'wpb-elementor-addons' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Video Title' , 'wpb-elementor-addons' ),
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'video_content', [
				'label' 		=> esc_html__( 'Video Content', 'wpb-elementor-addons' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
			]
		);

		$repeater->add_control(
			'details_link', [
				'label' 		=> esc_html__( 'Video Details Link', 'wpb-elementor-addons' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
			]
		);

		$this->add_control(
			'video_items',
			[
				'label' 	=> esc_html__( 'Video Items', 'wpb-elementor-addons' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
                        'video_type'    => 'youtube',
                        'youtube_url'   => array('url' => 'https://www.youtube.com/watch?v=wtOuQx8Ko7U'),
						'video_title' 	=> esc_html__( 'Elementor Post Grid', 'wpb-elementor-addons' ),
						'video_content'	=> esc_html__( 'Item content. Click the edit button to change this text.', 'wpb-elementor-addons' ),
					],
					[
						'video_type'    => 'youtube',
                        'youtube_url'   => array('url' => 'https://www.youtube.com/watch?v=_qK1ovtRGbw'),
                        'video_title' 	=> esc_html__( 'Elementor News Ticker', 'wpb-elementor-addons' ),
						'video_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'wpb-elementor-addons' ),
					],
                    [
                        'video_type'    => 'youtube',
                        'youtube_url'   => array('url' => 'https://www.youtube.com/watch?v=hKOY6iikbMk'),
                        'video_title'   => esc_html__( 'Elementor TimeLine', 'wpb-elementor-addons' ),
                        'video_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'wpb-elementor-addons' ),
                    ],
				],
				'title_field' => '{{{ video_title }}}',
			]
		);
		
		$this->end_controls_section();	           


        $this->start_controls_section(
            'wpb_ea_video_grid_style_section',
            [
                'label'         => esc_html__('Style Settings', 'wpb-elementor-addons'),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );
        
        $this->add_control(
            'wpb_ea_video_grid_bg_color',
            [
                'label'         => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::COLOR,             
                'default'       => '#ffffff',  
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-videos-grid-item-inner' => 'background-color: {{VALUE}};',
                ],               
            ]
        );

        $this->add_control(
            'wpb_ea_video_grid_padding',
            [
                'label'         => esc_html__( 'Padding', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'default'       => [
                    'top'       => 20,
                    'right'     => 20,
                    'bottom'    => 20,
                    'left'      => 20
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-video-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'wpb_ea_video_grid_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'default'       => [
                    'top'       => 0,
                    'right'     => 0,
                    'bottom'    => 30,
                    'left'      => 0
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-videos-grid-item-column' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'wpb_ea_video_grid_title_color',
            [
                'label'         => esc_html__( 'Title Color', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::COLOR,             
                'default'       => '#292929',  
                'selectors'     => [
                    '{{WRAPPER}} .wpb-video-content h3' => 'color: {{VALUE}};',
                ],               
            ]
        );

        $this->add_control(
            'wpb_ea_video_grid_content_color',
            [
                'label'         => esc_html__( 'Content Color', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::COLOR,             
                'default'       => '#333333',  
                'selectors'     => [
                    '{{WRAPPER}} .wpb-video-content p' => 'color: {{VALUE}};',
                ],               
            ]
        );

        $this->add_control(
            'wpb_ea_video_grid_link_color',
            [
                'label'         => esc_html__( 'Details Link Color', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::COLOR,             
                'default'       => '#2d2d2d',  
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-vg-details-link' => 'color: {{VALUE}};',
                ],               
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings    	= $this->get_settings_for_display();

        $column 		= 12/$settings['column'];
        $column_class 	= apply_filters( 'wpb_ea_videos_grid_column_class', 'col-lg-'.esc_attr( $column ). ' col-md-6' );

        $video_items 	= $settings['video_items'];
        $yt_args 			= array(
        	'height'	=> 146,
        	'width'		=> 260,
        );

        $hosted_args['controlsList'] = 'nodownload';
        //$hosted_args['muted'] = 'muted';
        $hosted_args['controls'] = '';

        if( isset($video_items) && !empty($video_items) ){
	        ?>
	        <div class="wpb-ea-videos-grid">
	        	<div class="ea-row">
		        	<?php foreach ($video_items as $video_item): ?>

		        		<?php 
		        			$target 			= $video_item['details_link']['is_external'] ? ' target="_blank"' : '';
							$nofollow 			= $video_item['details_link']['nofollow'] ? ' rel="nofollow"' : '';
							$video_type     	= $video_item['video_type'];
							
							if( $video_type == 'self_hosted' ){
		
								if( $video_item['video_thumbnail']['url'] ){
									$hosted_args['poster'] = $video_item['video_thumbnail']['url'];
								}else{
									$hosted_args['poster'] = '';
								}
							}
		        		?>

		        		<div class="wpb-ea-videos-grid-item-column <?php echo esc_attr( $column_class ); ?>">
			        		<div class="wpb-ea-videos-grid-item">
			        			<div class="wpb-ea-videos-grid-item-inner">
				        			<?php 
				        				if( $video_type == 'youtube' ){
				        					echo ( $video_item['youtube_url']['url'] ? wp_oembed_get( $video_item['youtube_url']['url'], $yt_args ) : '' );
				        				}elseif( $video_type == 'self_hosted' ){
				        					if( $video_item['self_hosted']['url'] ){
				        						echo '<video class="elementor-video" src="'. esc_url( $video_item['self_hosted']['url'] ) .'" '. Utils::render_html_attributes( $hosted_args ) .'></video>';
				        					}
				        				}
				        			?>
				        			<div class="wpb-video-content">
					        			<?php echo ( $video_item['video_title'] ? sprintf('<h3>%s</h3>', esc_html( $video_item['video_title'] )) : '' ); ?>
					        			<?php echo ( $video_item['video_content'] ? wpautop( $video_item['video_content'] ) : '' ); ?>
					        			<?php
					        				if( $video_item['details_link']['url'] ){
					        					echo '<a class="wpb-ea-vg-details-link" href="' . $video_item['details_link']['url'] . '"' . $target . $nofollow . '>'. apply_filters( 'wpb_ea_videos_grid_details_text', esc_html( $settings['details_text'] ) ) .'</a>';
					        				}
					        			?>
				        			</div>
			        			</div>
			        		</div>
		        		</div>
		        	<?php endforeach; ?>
	        	</div>
	        </div>
	        <?php
    	}
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new WPB_EA_Videos_Grid() );