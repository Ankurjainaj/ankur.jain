<?php
/**
 * @author  WpBean
 * @version 1.0
 */

namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class WPB_EA_Post_Grid_Slider extends Widget_Base {

    public function get_name() {
        return 'wpb-ea-post-grid-slider';
    }

    public function get_title() {
        return esc_html__( 'WPB Post Grid/Slider', 'wpb-elementor-addons' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
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

    /**
     * get post type categories
     */
    private function wpb_ea_get_all_post_type_categories( $post_type ) {

        $options = array();

        if ( $post_type == 'post' ) {
            $taxonomy = 'category';
        } elseif ( $post_type == 'product' ) {
            $taxonomy = 'product_cat';
        }

        if ( ! empty( $taxonomy ) ) {
            // Get categories for post type.
            $terms = get_terms(
                array(
                    'taxonomy'   => $taxonomy,
                    'hide_empty' => false,
                )
            );
            if ( ! empty( $terms ) ) {
                $options = ['' => ''];
                foreach ( $terms as $term ) {
                    if ( isset( $term ) ) {
                        if ( isset( $term->slug ) && isset( $term->name ) ) {
                            $options[ $term->slug ] = $term->name;
                        }
                    }
                }
            }
        }

        return $options;
    }

    /**
     * Post categories
     */
    protected function wpb_ea_get_post_category($text){
        $settings                  = $this->get_settings_for_display();
        $wpb_ea_post_type_category = get_the_category();
        $number_of_cat             = $settings['wpb_ea_post_cat_number'] ? $settings['wpb_ea_post_cat_number'] : '-1';
        $i                         = 0;

        if ( $wpb_ea_post_type_category ) {
            echo '<span class="wpb-ea-post-cats">';
                echo esc_html( $text );
                foreach ( $wpb_ea_post_type_category as $category ) {
                    if ( $i == $number_of_cat ) {
                        break;
                    }
                    echo '<span class="wpb-ea-post-cat-item">';
                        echo '<a href="'.get_category_link( $category->term_id ).'" title="'.$category->name.'">'.$category->name.'</a> ';
                    echo '</span>';
                    $i ++;
                }
            echo '</span>';
        }
    }


    /**
     * Post Tag
     */
    protected function wpb_ea_get_post_tag($text) {
        $settings              = $this->get_settings_for_display();
        $wpb_ea_post_type_tags = get_the_tags();
        $number_of_tag         = $settings['wpb_ea_post_tag_number'] ? $settings['wpb_ea_post_tag_number'] : '-1';
        $i                     = 0;

        if ( $wpb_ea_post_type_tags ) { 
            echo '<span class="wpb-ea-post-tags">'. esc_html( $text );

                foreach ( $wpb_ea_post_type_tags as $tag ) {
                    if ( $i == $number_of_tag ) {
                        break;
                    }
                    echo '<span class="wpb-ea-post-tag-item">';
                        echo '<a href="'.get_tag_link( $tag->term_id ).'" title="'.$tag->name.'">'.$tag->name.'</a> ';     
                    echo '</span>';
                    $i ++;
                }

            echo '</span>';
        }
    }

    /**
     * show price if post type is product
     */
    protected function wpb_ea_product_price() {

        if ( ! function_exists( 'wc_get_product' ) ) {
            return null;
        }

        $settings = $this->get_settings_for_display();
        $product  = wc_get_product( get_the_ID() );

        if ( $settings['post_types'] == 'product' && $settings['wpb_ea_product_price_enable'] == 'yes' ) {
            echo '<div class="wpb-ea-product-price">';
                $price = $product->get_price_html();
                if ( ! empty( $price ) ) {
                    echo wp_kses(
                        $price, array(
                            'span' => array(
                                'class' => array(),
                            ),
                            'del'  => array(),
                        )
                    );
                }
            echo '</div>';
        }
    }

    /**
     * show add to cart button if post type is product
     */
    protected function wpb_ea_add_to_cart_button() {

        if ( ! function_exists( 'wc_get_product' ) ) {
            return null;
        }

        $product = wc_get_product( get_the_ID() );

        echo apply_filters(
            'woocommerce_loop_add_to_cart_link',
            sprintf(
                '<a href="%s" class="read-more" title="%s" rel="nofollow">%s</a>',
                esc_url( $product->add_to_cart_url() ),
                esc_attr( $product->add_to_cart_text() ),
                esc_html( $product->add_to_cart_text() )
            ), $product
        );
    }

    protected function _register_controls() {

        // content
        $this->wpb_ea_post_options_section();
        $this->wpb_ea_post_image_section();
        $this->wpb_ea_post_date_section();
        $this->wpb_ea_post_title_section();
        $this->wpb_ea_post_meta_section();
        $this->wpb_ea_post_content_section();

        // carousel
        $this->wpb_ea_post_grid_slider_section();

        // responsive
        $this->wpb_ea_post_grid_slider_responsive_section();

        // style
        $this->wpb_ea_post_style_section();
        $this->wpb_ea_post_grid_slider_image_style_section();
        $this->wpb_ea_post_grid_slider_date_style_section();
        $this->wpb_ea_post_grid_slider_title_style_section();
        $this->wpb_ea_post_grid_slider_meta_style_section();
        $this->wpb_ea_post_grid_slider_content_style_section();
        $this->wpb_ea_post_grid_slider_setting_style_section();
    }

    // post options 
    private function wpb_ea_post_options_section() {
        $this->start_controls_section(
            'wpb_ea_post_query',
            [
                'label' => esc_html__( 'Post Options', 'wpb-elementor-addons' )
            ]
        );

        // post type conent type
        $this->add_control(
            'wpb_ea_post_content_type',
            [
                'label'     => esc_html__( 'Content Type', 'wpb-elementor-addons' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'slider',
                'options'   => [
                    'slider'        => esc_html__( 'Slider',   'wpb-elementor-addons' ),
                    'grid'          => esc_html__( 'Grid', 'wpb-elementor-addons' )
                ]
            ]
        );

        // get all post types
        $this->add_control(
            'post_types',
            [
                'label'    => esc_html__('Post Type', 'wpb-elementor-addons' ),
                'type'     => Controls_Manager::SELECT,
                'default'  => 'post',
                'options'  => wpb_ea_get_all_post_type_options()
                // 'multiple' => true
            ]
        );  

        // Post categories.
        $this->add_control(
            'wpb_ea_post_categories',
            [
                'label'     => esc_html__( 'Category', 'wpb-elementor-addons' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $this->wpb_ea_get_all_post_type_categories( 'post' ),
                'condition' => [
                    'post_types' => 'post'
                ]
            ]
        );

        // Product categories.
        $this->add_control(
            'wpb_ea_product_categories',
            [
                'label'     => esc_html__( 'Category', 'wpb-elementor-addons' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $this->wpb_ea_get_all_post_type_categories( 'product' ),
                'condition' => [
                    'post_types' => 'product'
                ]
            ]
        );

        // order by
        $this->add_control(
            'wpb_ea_order_by',
            [
                'type'    => Controls_Manager::SELECT,
                'label'   => esc_html__( 'Order by', 'wpb-elementor-addons' ),
                'default' => 'date',
                'options' => [
                    'none'          => esc_html__('No order', 'wpb-elementor-addons' ),
                    'ID'            => esc_html__('Post ID', 'wpb-elementor-addons' ),
                    'author'        => esc_html__('Author', 'wpb-elementor-addons' ),
                    'title'         => esc_html__('Title', 'wpb-elementor-addons' ),
                    'date'          => esc_html__('Published date', 'wpb-elementor-addons' ),
                    'modified'      => esc_html__('Modified date', 'wpb-elementor-addons' ),
                    'parent'        => esc_html__('By parent', 'wpb-elementor-addons' ),
                    'rand'          => esc_html__('Random order', 'wpb-elementor-addons' ),
                    'comment_count' => esc_html__('Comment count', 'wpb-elementor-addons' ),
                    'menu_order'    => esc_html__('Menu order', 'wpb-elementor-addons' ),
                    'post__in'      => esc_html__('By include order', 'wpb-elementor-addons' )
                ]
            ]
        );

        // order
        $this->add_control(
            'wpb_ea_order',
            [
                'type'          => Controls_Manager::SELECT,
                'label'         => esc_html__( 'Order', 'wpb-elementor-addons' ),
                'default'       => 'DESC',
                'options'       => [
                    'ASC'       => esc_html__( 'Ascending', 'wpb-elementor-addons' ),
                    'DESC'      => esc_html__( 'Descending', 'wpb-elementor-addons' )
                ]
            ]
        );

        // number of posts
        $this->add_control(
            'posts_per_page',
            [
                'label'         => esc_html__('Number of posts to show', 'wpb-elementor-addons'),
                'type'          => Controls_Manager::NUMBER,
                'default'       => 6
            ]
        );  

        // selected id to show post
        $this->add_control(
            'post_in_ids',
            [
                'label'         => esc_html__('Post In', 'wpb-elementor-addons' ),
                'description'   => esc_html__('Provide a comma separated list of Post IDs to display spacific post.', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true
            ]
        );

        // specific id to exclude post
        $this->add_control(
            'post_not_in_ids',
            [   
                'label'         => esc_html__( 'Exclude', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::TEXT,
                'description'   => esc_html__('Provide a comma separated list of Post IDs to exclude specific post.', 'wpb-elementor-addons' )
            ]
        );   

        // show feature image?
        $this->add_control(
            'only_post_has_image',
            [
                'label'         => esc_html__( 'Show only post has feature image. Default: Yes.', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'no',
                'return_value'  => 'yes'
            ]
        );    

        // post content alignment
        $this->add_responsive_control(
            'wpb_ea_post_content_align',
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
                    '{{WRAPPER}} .wpb-ea-post-carousel .post-info' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .wpb-ea-post-carousel.content-alignment-center ul.wpb-ea-product-rating' => 'width: 100%; display: inline-block;',
                    '{{WRAPPER}} .wpb-ea-post-carousel.content-alignment-center .wpb-ea-product-rating .wpb-ea-product-star-rating' => 'margin: 0 auto;',
                    '{{WRAPPER}} .wpb-ea-post-carousel.content-alignment-right ul.wpb-ea-product-rating' => 'width: 100%; float: right;',
                    '{{WRAPPER}} .wpb-ea-post-carousel.content-alignment-right .wpb-ea-product-rating .wpb-ea-product-star-rating' => 'float: right;',
                ]
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
    }    

    // image options
    private function wpb_ea_post_image_section() {
        $this->start_controls_section(
            'wpb_ea_post_grid_slider_image_options',
            [
                'label'         => esc_html__( 'Image', 'wpb-elementor-addons' )
            ]
        );

        // show image?
        $this->add_control(
            'wpb_ea_show_post_image',
            [
                'label'         => esc_html__( 'Show Image?', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
                'return_value'  => 'yes'
            ]
        ); 

        // image size
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'          => 'image_size',
                'default'       => 'medium_large',
                'condition'     => [
                    'wpb_ea_show_post_image' => 'yes'
                ]
            ]
        );

        // image custom height
        $this->add_control(
            'wpb_ea_post_image_custom_fixed_height',
            [
                'label'         => esc_html__( 'Custom Height?', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'no',
                'return_value'  => 'yes',
                'condition'     => [
                    'wpb_ea_show_post_image' => 'yes'

                ]                
            ]
        );

        // image height
        $this->add_control(
            'wpb_ea_post_image_height',
            [
                'label'         => esc_html__( 'Image height', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 300
                ],
                'range'         => [
                    'px'        => [
                        'min'   => 1,
                        'max'   => 1000,
                        'step'  => 5
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-post-carousel .post-thumbnail img' => 'height: {{SIZE}}{{UNIT}};'
                ],
                'condition'     => [
                    'wpb_ea_show_post_image' => 'yes',
                    'wpb_ea_post_image_custom_fixed_height' => 'yes'

                ]                
            ]
        );

        // image link
        $this->add_control(
            'wpb_ea_post_image_link',
            [
                'label'         => esc_html__( 'Link', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
                'condition'     => [
                    'wpb_ea_show_post_image' => 'yes'

                ]                
            ]
        );

        $this->end_controls_section();
    }

    // date options
    private function wpb_ea_post_date_section(){
        $this->start_controls_section(
            'wpb_ea_post_grid_slider_date_options',
            [
                'label'         => esc_html__( 'Date', 'wpb-elementor-addons' )
            ]
        );

        // show date?
        $this->add_control(
            'wpb_ea_show_post_date',
            [
                'label'         => esc_html__( 'Show Date?', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
                'return_value'  => 'yes'
            ]
        );

        $this->end_controls_section();
    }

    // title options
    private function wpb_ea_post_title_section(){
        $this->start_controls_section(
            'wpb_ea_post_grid_slider_title_options',
            [
                'label'         => esc_html__( 'Title', 'wpb-elementor-addons' )
            ]
        );

        // show title?
        $this->add_control(
            'wpb_ea_show_post_title',
            [
                'label'         => esc_html__( 'Show Title?', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
                'return_value'  => 'yes'
            ]
        );

        // title link
        $this->add_control(
            'wpb_ea_show_post_title_link',
            [
                'label'         => esc_html__( 'Link', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
                'condition'     => [
                    'wpb_ea_show_post_title' => 'yes'

                ]                 
            ]
        );

        $this->end_controls_section();
    }

    // meta options
    private function wpb_ea_post_meta_section(){
        $this->start_controls_section(
            'wpb_ea_post_grid_slider_meta_options',
            [
                'label'     => esc_html__( 'Meta', 'wpb-elementor-addons' )
            ]
        );

        // show product reviews?
        $this->add_control(
            'wpb_ea_product_review',
            [
                'label'         => esc_html__( 'Show Reviews?', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'default'       => 'yes',
                'return_value'  => 'yes',
                'condition'     => [
                    '.wpb_ea_post_query.post_types' => 'product',
                ]
            ]
        );

        // show tag for featured product?
        $this->add_control(
            'wpb_ea_show_tag_for_featured_product',
            [
                'label'         => esc_html__( 'Show Tag For Featured Product?', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
                'return_value'  => 'yes',
                'condition'     => [
                    '.wpb_ea_post_query.post_types' => 'product'
                ]
            ]
        );

        // featured product tag
        $this->add_control(
            'wpb_ea_featured_product_tag_text',
            [
                'type'          => Controls_Manager::TEXT,
                'label'         => esc_html__( 'Featured Product Tag', 'wpb-elementor-addons' ),
                'default'       => esc_html__( 'Sale', 'wpb-elementor-addons' ),
                'condition'     => [
                    '.wpb_ea_show_tag_for_featured_product' => 'yes',
                    '.wpb_ea_post_query.post_types' => 'product'
                ]
            ]
        );  

        // show meta?
        $this->add_control(
            'wpb_ea_show_post_meta',
            [
                'label'         => esc_html__( 'Show Meta?', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
                'return_value'  => 'yes'
            ]
        );

        // select post meta
        $this->add_control(
            'wpb_ea_post_meta_options',
            [
                'label'         => esc_html__( 'Display', 'wpb-elementor-addons' ),
                'label_block'   => true,
                'type'          => Controls_Manager::SELECT2,
                'default'       => [ 'author', 'category' ],
                'multiple'      => true,
                'options'       => [
                    'author'    => esc_html__( 'Author', 'wpb-elementor-addons' ),
                    'category'  => esc_html__( 'Category', 'wpb-elementor-addons' ),
                    'tags'      => esc_html__( 'Tags', 'wpb-elementor-addons' ),
                    'comments'  => esc_html__( 'Comments', 'wpb-elementor-addons' )
                ],  
                'condition'     => [
                    'wpb_ea_show_post_meta' => 'yes',
                    'post_types' => 'post'
                ]                            
            ]
        );

        // no. of categories
        $this->add_control(
            'wpb_ea_post_cat_number',
            [
                'type'          => \Elementor\Controls_Manager::NUMBER,
                'label'         => esc_html__( 'No. Of Categories', 'wpb-elementor-addons' ),
                'placeholder'   => esc_html__( 'How many categories to display?', 'wpb-elementor-addons' ),
                'default'       => esc_html__( '1', 'wpb-elementor-addons' ),
                'condition'     => [
                    'wpb_ea_post_meta_options' => 'category',
                    'post_types' => 'post'
                ]
            ]
        );

        // no. of tags
        $this->add_control(
            'wpb_ea_post_tag_number',
            [
                'type'          => \Elementor\Controls_Manager::NUMBER,
                'label'         => esc_html__( 'No. of Tags', 'wpb-elementor-addons' ),
                'placeholder'   => esc_html__( 'How many tags to display?', 'wpb-elementor-addons' ),
                'default'       => esc_html__( '1', 'wpb-elementor-addons' ),
                'condition'     => [
                    'wpb_ea_post_meta_options' => 'tags',
                    'post_types' => 'post'
                ]
            ]
        );

        $this->add_control(
            'wpb_ea_text_author',
            [
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label'         => esc_html__( 'Text Before Author', 'wpb-elementor-addons' ),
                'default'       => esc_html__( 'by ', 'wpb-elementor-addons' ),
                'condition'     => [
                    'wpb_ea_post_meta_options' => 'author',
                    'post_types' => 'post'
                ]
            ]
        );

        $this->add_control(
            'wpb_ea_text_category',
            [
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label'         => esc_html__( 'Text Before Category', 'wpb-elementor-addons' ),
                'default'       => esc_html__( 'in ', 'wpb-elementor-addons' ),
                'condition'     => [
                    'wpb_ea_post_meta_options' => 'category',
                    'post_types' => 'post'
                ]
            ]
        );

        $this->add_control(
            'wpb_ea_text_tags',
            [
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label'         => esc_html__( 'Text Before Tags', 'wpb-elementor-addons' ),
                'default'       => esc_html__( 'at ', 'wpb-elementor-addons' ),
                'condition'     => [
                    'wpb_ea_post_meta_options' => 'tags',
                    'post_types' => 'post'
                ]
            ]
        );

        $this->end_controls_section();
    }

    // content options
    private function wpb_ea_post_content_section() {
        $this->start_controls_section(
            'wpb_ea_post_grid_slider_content_options',
            [
                'label'        => esc_html__( 'Content', 'wpb-elementor-addons' )
            ]
        );

        // display excerpt?
        $this->add_control(
            'wpb_ea_show_excerpt',
            [
                'label'        => esc_html__('Display Excerpt?', 'wpb-elementor-addons'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );  

        // post excerpt length
        $this->add_control(
            'wpb_ea_excerpt_length',
            [
                'label'         => esc_html__('Excerpt Length', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => 20,
                'condition'     => [
                    '.wpb_ea_post_query.wpb_ea_show_excerpt' => 'yes'
                ]
            ]
        );  

        // price
        $this->add_control(
            'wpb_ea_product_price_enable',
            [
                'label'         => esc_html__( 'Price', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'default'       => 'yes',
                'condition'     => [
                    'post_types'    => 'product'
                ]
            ]
        );

        // show read more button?
        $this->add_control(
            'wpb_ea_read_more_btn',
            [
                'label'        => esc_html__( 'Button', 'wpb-elementor-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
                'condition'    => [
                    '.wpb_ea_post_query.post_types!' => 'product'
                ],
            ]
        );  

        // read more button text
        $this->add_control(
            'wpb_ea_read_more_btn_text',
            [   
                'label'         => esc_html__( 'Button Text', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Continue Reading', 'wpb-elementor-addons'),
                'default'       => esc_html__('Continue Reading', 'wpb-elementor-addons' ),
                'condition'     => [
                    '.wpb_ea_post_query.post_types!' => 'product',
                    '.wpb_ea_read_more_btn'          => 'yes'

                ]
            ]
        );

        // add to cart button?
        $this->add_control(
            'wpb_ea_product_btn',
            [
                'label'         => esc_html__( 'Show Add To Cart Button?', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'default'       => 'yes',
                'return_value'  => 'yes',
                'condition'     => [
                    '.wpb_ea_post_query.post_types' => 'product'
                ]
            ]
        );

        $this->end_controls_section();
    }

    // post carousel settings
    private function wpb_ea_post_grid_slider_section() {
        $this->start_controls_section(
            'section_carousel_settings',
            [
                'label'         => esc_html__('Carousel Settings', 'wpb-elementor-addons'),
                'tab'           => Controls_Manager::TAB_SETTINGS,
                'condition'     => [
                    '.wpb_ea_post_query.wpb_ea_post_content_type' => 'slider'
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
                'label'         => esc_html__( 'Loop?', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'wpb-elementor-addons' ),
                'label_off'     => esc_html__( 'No', 'wpb-elementor-addons' ),
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
                    '{{WRAPPER}} .wpb-ea-posts-slider .wpb-ea-post-carousel' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ]
            ]
        );   

        $this->end_controls_section();
    }

    // responsive options
    private function wpb_ea_post_grid_slider_responsive_section() {
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

        // post type grid desktop column
        $this->add_control(
            'post_type_grid_desktop_column',
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
                    '.wpb_ea_post_query.wpb_ea_post_content_type' => 'grid'
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
                    '.wpb_ea_post_query.wpb_ea_post_content_type' => 'slider'
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
                    '.wpb_ea_post_query.wpb_ea_post_content_type' => 'slider'
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
                    '.wpb_ea_post_query.wpb_ea_post_content_type' => 'slider'
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
                    '.wpb_ea_post_query.wpb_ea_post_content_type' => 'slider'
                ]                
            ]
        );

        // post type grid tablet column
        $this->add_control(
            'post_type_grid_tablet_column',
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
                    '.wpb_ea_post_query.wpb_ea_post_content_type' => 'grid'
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
                    '.wpb_ea_post_query.wpb_ea_post_content_type' => 'slider'
                ]
            ]
        );

        $this->end_controls_section();  
    }

    // post carousel style settings
    private function wpb_ea_post_style_section() {
        $this->start_controls_section(
            'section_carousel_item_style',
            [
                'label'         => esc_html__('Post Item', 'wpb-elementor-addons'),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );  

        // item internal padding
        $this->add_control(
            'wpb_ea_post_item_padding',
            [
                'label'         => esc_html__( 'Padding', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'default'       => [
                    'top'       => 25,
                    'right'     => 25,
                    'bottom'    => 25,
                    'left'      => 25
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-post-carousel .post-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        // item internal margin
        $this->add_control(
            'wpb_ea_post_item_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'default'       => [
                    'bottom'    => 30
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-posts-grid .wpb-ea-posts-item-column' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'     => [
                    '.wpb_ea_post_query.wpb_ea_post_content_type' => 'grid'
                ]
            ]
        );

        // item border radius
        $this->add_control(
            'wpb_ea_post_item_border_radius',
            [
                'label'         => esc_html__( 'Border Radius', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-posts-slider .wpb-ea-post-carousel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .wpb-ea-posts-grid .wpb-ea-post-carousel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        // item background color
        $this->add_control(
            'wpb_ea_post_item_bg_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default'       => '#ffffff',                
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-post-carousel' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();  
    }

    // image style options
    private function wpb_ea_post_grid_slider_image_style_section() {
        $this->start_controls_section(
            'section_carousel_item_image_style',
            [
                'label'         => esc_html__('Image', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    '.wpb_ea_post_grid_slider_image_options.wpb_ea_show_post_image!' => ''
                ]
            ]
        );

        // image hover overlay gradient color
        $this->add_control(
            'wpb_ea_post_image_overlay_color',
            [
                'label'         => esc_html__( 'Hover Overlay Color', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::COLOR,
                'description'   => esc_html__('Leave blank or Clear to use default gradient overlay', 'wpb-elementor-addons'),
                'default'       => 'linear-gradient(180deg,#000 2%,rgba(0,0,0,0) 100%) repeat scroll 0 0 rgba(0, 0, 0, 0)',
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-post-carousel .post-thumbnail a:before' => 'background: {{VALUE}}'
                ]

            ]
        );

        // image hover overlay gradient color opacity
        $this->add_control(
            'wpb_ea_post_image_overlay_color_opacity',
            [
                'label'         => esc_html__('Hover Overlay Color Opacity.', 'wpb-elementor-addons'),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => .4
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-post-carousel .post-thumbnail a:before' => 'opacity: {{SIZE}};'
                ],                
                'range'         => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 1,
                        'step'  => 0.01
                    ]
                ]
            ]
        );  

        // image border radius
        $this->add_control(
            'wpb_ea_post_image_border_radius_style',
            [
                'label'         => esc_html__( 'Border Radius', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-post-carousel .post-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        // image box shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'wpb_ea_post_image_box_shadow_style',
                'selector'      => '{{WRAPPER}} .wpb-ea-post-carousel .post-thumbnail',
                'separator'     => ''
            ]
        );

        // image margin
        $this->add_control(
            'wpb_ea_post_image_margin_style',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-post-carousel .post-thumbnail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );        

        $this->end_controls_section();
    }

    // date style options
    private function wpb_ea_post_grid_slider_date_style_section() {
        $wpb_ea_primary_color = wpb_ea_get_option( 'wpb_ea_primary_color', 'wpb_ea_style', '#3878ff' );        
        $this->start_controls_section(
            'wpb_ea_post_item_date_style_options',
            [
                'label'         => esc_html__( 'Date', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    '.wpb_ea_post_grid_slider_date_options.wpb_ea_show_post_date!' => ''
                ]
            ]
        );  

        // date typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_post_item_date_typography',
                'scheme'        => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-content .post-date a'
            ]
        );

        // date color
        $this->add_control(
            'wpb_ea_post_item_date_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default'       => '#ffffff',                
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-content .post-date a' => 'color: {{VALUE}};'
                ]
            ]
        );

        // date bg color
        $this->add_control(
            'wpb_ea_post_item_date_bg_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default'       => $wpb_ea_primary_color,                
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-content .post-date a' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        // date margin
        $this->add_control(
            'wpb_ea_post_item_date_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'default'       => [
                    'top'       => 30
                ],                
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-content .post-date a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    // title style options
    private function wpb_ea_post_grid_slider_title_style_section() {
        $this->start_controls_section(
            'wpb_ea_post_item_title_style_options',
            [
                'label'         => esc_html__( 'Title', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    '.wpb_ea_post_grid_slider_title_options.wpb_ea_show_post_title!' => ''
                ]
            ]
        );  

        // title typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_post_item_title_typography',
                'scheme'        => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-content h3.post-heading'
            ]
        );

        // title color
        $this->add_control(
            'wpb_ea_post_item_title_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1
                ],
                'default'       => '#000000',                
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-content h3.post-heading' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-content > a.post-link'   => 'color: {{VALUE}};'
                ]
            ]
        );

        // title margin
        $this->add_control(
            'wpb_ea_post_item_title_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],              
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-content h3.post-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    // meta style options
    private function wpb_ea_post_grid_slider_meta_style_section() {
        $wpb_ea_primary_color = wpb_ea_get_option( 'wpb_ea_primary_color', 'wpb_ea_style', '#3878ff' );
        $this->start_controls_section(
            'wpb_ea_post_item_meta_style_options',
            [
                'label'         => esc_html__( 'Meta', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );  

        // featured product tag style
        $this->add_control(
            'wpb_ea_featured_product_item_tag_style',
            [
                'label'         => esc_html__( 'Tag', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING, 
                'condition'     => [
                    '.wpb_ea_show_tag_for_featured_product!' => '',
                    '.wpb_ea_post_query.post_types' => 'product'
                ]          
            ]
        );

        // featured product tag typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_featured_product_item_tag_typography',
                'separator'     => 'before',
                'scheme'        => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .wpb-ea-post-carousel .post-thumbnail .featured-product-text',
                'condition'     => [
                    '.wpb_ea_show_tag_for_featured_product!' => '',
                    '.wpb_ea_post_query.post_types' => 'product'
                ]
            ]
        );

        // featured product tag padding
        $this->add_control(
            'wpb_ea_featured_product_item_tag_padding',
            [
                'label'      => esc_html__( 'Padding', 'wpb-elementor-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .wpb-ea-post-carousel .post-thumbnail .featured-product-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'     => [
                    '.wpb_ea_show_tag_for_featured_product!' => '',
                    '.wpb_ea_post_query.post_types' => 'product'
                ]                  
            ]
        );

        // featured product tag color
        $this->add_control(
            'wpb_ea_featured_product_item_tag_color',
            [
                'label'         => esc_html__( 'Color', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::COLOR,  
                'condition'     => [
                    '.wpb_ea_show_tag_for_featured_product!' => '',
                    '.wpb_ea_post_query.post_types' => 'product'
                ],             
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-post-carousel .post-thumbnail .featured-product-text' => 'color: {{VALUE}};',
                ],               
            ]
        );

        // featured product tag background color
        $this->add_control(
            'wpb_ea_featured_product_item_tag_bg_color',
            [
                'label'         => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::COLOR, 
                'default'       => $wpb_ea_primary_color, 
                'condition'     => [
                    '.wpb_ea_show_tag_for_featured_product!' => '',
                    '.wpb_ea_post_query.post_types' => 'product'
                ],             
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-post-carousel .post-thumbnail .featured-product-text' => 'background-color: {{VALUE}};',
                ],               
            ]
        );

        // product review style
        $this->add_control(
            'wpb_ea_product_item_review_style',
            [
                'label'         => esc_html__( 'Review', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING, 
                'condition'     => [
                    '.wpb_ea_product_review!' => '',
                    '.wpb_ea_post_query.post_types' => 'product'
                ]          
            ]
        );

        // product reviews font size
        $this->add_control(
            'wpb_ea_product_item_review_font_size',
            [
                'label'         => esc_html__('Font Size', 'wpb-elementor-addons'),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 14
                ],
                'condition'     => [
                    '.wpb_ea_product_review!' => '',
                    '.wpb_ea_post_query.post_types' => 'product'
                ],   
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-product-rating .wpb-ea-product-star-rating' => 'font-size: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
                ],                
                'range'         => [
                    'px'        => [
                        'min'   => 8,
                        'max'   => 20,
                        'step'  => 1
                    ]
                ]
            ]
        );  

        // product reviews color
        $this->add_control(
            'wpb_ea_product_item_review_color',
            [
                'label'         => esc_html__( 'Color', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::COLOR,  
                'condition'     => [
                    '.wpb_ea_product_review!' => '',
                    '.wpb_ea_post_query.post_types' => 'product'
                ],      
                'default'       => $wpb_ea_primary_color,       
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-product-rating .wpb-ea-product-star-rating' => 'color: {{VALUE}};',
                ],               
            ]
        );

        // meta margin
        $this->add_control(
            'wpb_ea_product_item_review_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'condition'     => [
                    '.wpb_ea_product_review!' => '',
                    '.wpb_ea_post_query.post_types' => 'product'
                ],
                'selectors'     => [
                    '{{WRAPPER}} ul.wpb-ea-product-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        // product meta style
        $this->add_control(
            'wpb_ea_product_item_meta_style',
            [
                'label'         => esc_html__( 'Meta', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING, 
                'condition'     => [
                    '.wpb_ea_post_grid_slider_meta_options.wpb_ea_show_post_meta!' => ''
                ]                        
            ]
        );

        // meta typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_post_item_meta_typography',
                'separator'     => 'before',
                'scheme'        => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .wpb-ea-post-carousel .post-content .post-meta, {{WRAPPER}} .wpb-ea-post-carousel .post-content .post-meta a',
                'condition'     => [
                    '.wpb_ea_post_grid_slider_meta_options.wpb_ea_show_post_meta!' => ''
                ]
            ]
        );

        // meta color
        $this->add_control(
            'wpb_ea_post_item_meta_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1
                ],
                'default'       => '#999',
                'condition'     => [
                    '.wpb_ea_post_grid_slider_meta_options.wpb_ea_show_post_meta!' => ''
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-post-carousel .post-content .post-meta'      => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wpb-ea-post-carousel .post-content .post-meta span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wpb-ea-post-carousel .post-content .post-meta a'    => 'color: {{VALUE}};'
                ]
            ]
        );

        // meta margin
        $this->add_control(
            'wpb_ea_post_item_meta_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'condition'     => [
                    '.wpb_ea_post_grid_slider_meta_options.wpb_ea_show_post_meta!' => ''
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-post-carousel .post-content .post-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    // content style options
    private function wpb_ea_post_grid_slider_content_style_section() {
        $wpb_ea_primary_color = wpb_ea_get_option( 'wpb_ea_primary_color', 'wpb_ea_style', '#3878ff' );
        $this->start_controls_section(
            'wpb_ea_post_item_content_style_options',
            [
                'label'         => esc_html__( 'Content', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE              
            ]
        );  

        // content style heading
        $this->add_control(
            'wpb_ea_post_item_excerpt_style_heading',
            [
                'label'         => esc_html__( 'Excerpt', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING,   
                'condition'     => [
                    '.wpb_ea_post_grid_slider_content_options.wpb_ea_show_excerpt!' => ''
                ]                         
            ]
        );

        // content typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_post_item_content_typography',
                'selector'      => '{{WRAPPER}} .wpb-ea-post-carousel .post-content .post-details p',
                'condition'     => [
                    '.wpb_ea_post_grid_slider_content_options.wpb_ea_show_excerpt!' => ''
                ]
            ]
        );

        // content color
        $this->add_control(
            'wpb_ea_post_item_content_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1
                ],
                'default'       => '#777777',
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-post-carousel .post-content .post-details p' => 'color: {{VALUE}};'
                ],
                'condition'     => [
                    '.wpb_ea_post_grid_slider_content_options.wpb_ea_show_excerpt!' => ''
                ]
            ]
        );

        // content margin
        $this->add_control(
            'wpb_ea_post_item_content_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-post-carousel .post-content .post-details' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'     => [
                    '.wpb_ea_post_grid_slider_content_options.wpb_ea_show_excerpt!' => ''
                ]                
            ]
        );

        // product price style heading
        $this->add_control(
            'wpb_ea_product_item_price_style_heading',
            [
                'label'         => esc_html__( 'Price', 'wpb-elementor-addons' ),
                'type'          => Controls_Manager::HEADING, 
                'separator'     => 'before',
                'condition'     => [
                    '.wpb_ea_post_query.wpb_ea_product_price_enable!' => '',
                    '.wpb_ea_post_query.post_types' => 'product'
                ]                        
            ]
        );

        // product regular price color
        $this->add_control(
            'wpb_ea_product_item_price_regular_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Regular Price Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default'       => '#777777',
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-product-price del' => 'color: {{VALUE}};'
                ],
                'condition'     => [
                    '.wpb_ea_post_query.wpb_ea_product_price_enable!' => '',
                    '.wpb_ea_post_query.post_types' => 'product'
                ]
            ]
        );

        // product offer price color
        $this->add_control(
            'wpb_ea_product_item_price_offer_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Offer Price Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1
                ],
                'default'       => $wpb_ea_primary_color,
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-product-price'      => 'color: {{VALUE}};'
                ],
                'condition'     => [
                    '.wpb_ea_post_query.wpb_ea_product_price_enable!' => '',
                    '.wpb_ea_post_query.post_types' => 'product'
                ]
            ]
        );

        // product price typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_product_item_price_typography',
                'selector'      => '{{WRAPPER}} .wpb-ea-product-price',
                'condition'     => [
                    '.wpb_ea_post_query.wpb_ea_product_price_enable!' => '',
                    '.wpb_ea_post_query.post_types' => 'product'
                ]
            ]
        );

        // product price margin
        $this->add_control(
            'wpb_ea_product_item_price_margin',
            [
                'label'         => esc_html__( 'Margin', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px' ],
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-product-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'     => [
                    '.wpb_ea_post_query.wpb_ea_product_price_enable!' => '',
                    '.wpb_ea_post_query.post_types' => 'product'
                ]                
            ]
        );

        // content button options function
        $this->wpb_ea_post_content_button_style_section();

        // add to cart button options function
        $this->wpb_ea_product_add_to_cart_button_style_section();

        $this->end_controls_section();
    }

    // content button style options
    private function wpb_ea_post_content_button_style_section() {

        // heading for content button options
        $this->add_control(
            'wpb_ea_content_button_style_heading',
            [
                'label'         => esc_html__( 'Button', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::HEADING,
                'separator'     => 'before',
                'condition'     => [
                    '.wpb_ea_post_grid_slider_content_options.wpb_ea_read_more_btn!' => '',
                    '.wpb_ea_post_query.post_types!'                              => 'product'
                ]              
            ]
        );

        // content button typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'      => 'wpb_ea_content_button_typography',
                'scheme'    => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector'  => '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-footer a.read-more',
                'condition'     => [
                    '.wpb_ea_post_grid_slider_content_options.wpb_ea_read_more_btn!' => '',
                    '.wpb_ea_post_query.post_types!'                              => 'product'
                ]                 
            ]
        );

        $this->start_controls_tabs( 'wpb_ea_content_button' );

            // content button normal tab
            $this->start_controls_tab(
                'wpb_ea_content_button_normal',
                [
                    'label'     => esc_html__( 'Normal', 'wpb-elementor-addons' ),
                    'condition'     => [
                        '.wpb_ea_post_grid_slider_content_options.wpb_ea_read_more_btn!' => '',
                        '.wpb_ea_post_query.post_types!'                              => 'product'
                    ]  
                ]
            );

            // content button normal text color
            $this->add_control(
                'wpb_ea_content_button_normal_text_color',
                [
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'label'     => esc_html__( 'Text Color', 'wpb-elementor-addons' ),
                    'scheme'    => [
                        'type'  => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1
                    ],
                    'separator' => '',
                    'selectors' => [
                        '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-footer a.read-more' => 'color: {{VALUE}};'
                    ],
                    'default'       => '#333',
                    'condition'     => [
                        '.wpb_ea_post_grid_slider_content_options.wpb_ea_read_more_btn!' => '',
                        '.wpb_ea_post_query.post_types!'                              => 'product'
                    ]                               
                ]
            );

            // content button background color
            $this->add_control(
                'wpb_ea_content_button_normal_bg_color',
                [
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'label'     => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
                    'scheme'    => [
                        'type'  => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1
                    ],
                    'separator' => '',
                    'selectors' => [
                        '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-footer a.read-more' => 'background-color: {{VALUE}};'
                    ],
                    'default'       => 'transparent',
                    'condition'     => [
                        '.wpb_ea_post_grid_slider_content_options.wpb_ea_read_more_btn!' => '',
                        '.wpb_ea_post_query.post_types!'                              => 'product'
                    ]                              
                ]
            );

            // content button box shadow
            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name'      => 'wpb_ea_content_button_normal_box_shadow',
                    'selector'  => '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-footer a.read-more',
                    'separator' => '',
                    'condition'     => [
                        '.wpb_ea_post_grid_slider_content_options.wpb_ea_read_more_btn!' => '',
                        '.wpb_ea_post_query.post_types!'                              => 'product'
                    ],            
                ]
            );

            // content button padding
            $this->add_control(
                'wpb_ea_content_button_padding',
                [
                    'label'      => esc_html__( 'Button padding', 'wpb-elementor-addons' ),
                    'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'selectors'  => [
                        '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-footer a.read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ],
                    'condition'     => [
                        '.wpb_ea_post_grid_slider_content_options.wpb_ea_read_more_btn!' => '',
                        '.wpb_ea_post_query.post_types!'                              => 'product'
                    ]                  
                ]
            );

            //  content button border radius
            $this->add_control(
                'wpb_ea_content_button_border_radius',
                [
                    'label'      => esc_html__( 'Button border radius', 'wpb-elementor-addons' ),
                    'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-footer a.read-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ],
                    'condition'     => [
                        '.wpb_ea_post_grid_slider_content_options.wpb_ea_read_more_btn!' => '',
                        '.wpb_ea_post_query.post_types!'                              => 'product'
                    ]                  
                ]
            );

            $this->end_controls_tab();

            //  content button hover tab
            $this->start_controls_tab(
                'wpb_ea_content_button_hover',
                [
                    'label'     => esc_html__( 'Hover', 'wpb-elementor-addons' ),
                    'condition'     => [
                        '.wpb_ea_post_grid_slider_content_options.wpb_ea_read_more_btn!' => '',
                        '.wpb_ea_post_query.post_types!'                              => 'product'
                    ]       
                ]
            );

            //  content button hover text color
            $this->add_control(
                'wpb_ea_content_button_hover_text_color',
                [
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'label'     => esc_html__( 'Text Color666', 'wpb-elementor-addons' ),
                    'scheme'    => [
                        'type'  => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1
                    ],
                    'separator' => '',
                    'selectors' => [
                        '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-footer a.read-more:hover' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-footer a.read-more:hover i' => 'color: {{VALUE}};'
                    ],
                    'default'       => '#333',
                    'condition'     => [
                        '.wpb_ea_post_grid_slider_content_options.wpb_ea_read_more_btn!' => '',
                        '.wpb_ea_post_query.post_types!'                              => 'product'
                    ]                  
                ]
            );

            //  content button hover background color
            $this->add_control(
                'wpb_ea_content_button_hover_bg_color',
                [
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'label'     => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
                    'scheme'    => [
                        'type'  => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1
                    ],
                    'separator' => '',
                    'selectors' => [
                        '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-footer a.read-more:hover' => 'background-color: {{VALUE}};'
                    ],
                    'default'       => 'transparent',
                    'condition'     => [
                        '.wpb_ea_post_grid_slider_content_options.wpb_ea_read_more_btn!' => '',
                        '.wpb_ea_post_query.post_types!'                              => 'product'
                    ]                          
                ]
            );

            //  content button hover box shadow
            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name'      => 'wpb_ea_content_button_hover_box_shadow',
                    'selector'  => '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-footer a.read-more:hover',
                    'separator' => '',
                    'condition'     => [
                        '.wpb_ea_post_grid_slider_content_options.wpb_ea_read_more_btn!' => '',
                        '.wpb_ea_post_query.post_types!'                              => 'product'
                    ]                  
                ]
            );

            //  content button hover padding
            $this->add_control(
                'wpb_ea_content_button_hover_padding',
                [
                    'label'      => esc_html__( 'Button padding', 'wpb-elementor-addons' ),
                    'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'selectors'  => [
                        '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-footer a.read-more:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ],
                    'condition'     => [
                        '.wpb_ea_post_grid_slider_content_options.wpb_ea_read_more_btn!' => '',
                        '.wpb_ea_post_query.post_types!'                              => 'product'
                    ]                  
                ]
            );

            //  content button hover border radius
            $this->add_control(
                'wpb_ea_content_button_hover_border_radius',
                [
                    'label'      => esc_html__( 'Button border radius', 'wpb-elementor-addons' ),
                    'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-footer a.read-more:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ],
                    'condition'     => [
                        '.wpb_ea_post_grid_slider_content_options.wpb_ea_read_more_btn!' => '',
                        '.wpb_ea_post_query.post_types!'                              => 'product'
                    ]                  
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

    }

    // add to cart button style options
    private function wpb_ea_product_add_to_cart_button_style_section() {

        // heading for add to cart button options
        $this->add_control(
            'wpb_ea_add_to_cart_button_style_heading',
            [
                'label'         => esc_html__( 'Button', 'wpb-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::HEADING,
                'separator'     => 'before',
                'condition'     => [
                    '.wpb_ea_post_grid_slider_content_options.wpb_ea_product_btn!' => '',
                    '.wpb_ea_post_query.post_types' => 'product'
                ]              
            ]
        );

        // add to cart button typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'wpb_ea_add_to_cart_button_typography',
                'scheme'        => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-footer a.read-more',
                'condition'     => [
                    '.wpb_ea_post_grid_slider_content_options.wpb_ea_product_btn!' => '',
                    '.wpb_ea_post_query.post_types' => 'product'
                ]                 
            ]
        );

        $this->start_controls_tabs( 'wpb_ea_add_to_cart_button' );

            // add to cart normal tab
            $this->start_controls_tab(
                'wpb_ea_add_to_cart_button_normal',
                [
                    'label'         => esc_html__( 'Normal', 'wpb-elementor-addons' ),
                    'condition'     => [
                        '.wpb_ea_post_grid_slider_content_options.wpb_ea_product_btn!' => '',
                        '.wpb_ea_post_query.post_types' => 'product'
                    ]  
                ]
            );

            // add to cart normal text color
            $this->add_control(
                'wpb_ea_add_to_cart_button_normal_text_color',
                [
                    'type'          => \Elementor\Controls_Manager::COLOR,
                    'label'         => esc_html__( 'Text Color', 'wpb-elementor-addons' ),
                    'scheme'        => [
                        'type'      => \Elementor\Scheme_Color::get_type(),
                        'value'     => \Elementor\Scheme_Color::COLOR_1
                    ],
                    'separator'     => '',
                    'selectors'     => [
                        '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-footer a.read-more' => 'color: {{VALUE}};'
                    ],
                    'default'       => '#333',
                    'condition'     => [
                        '.wpb_ea_post_grid_slider_content_options.wpb_ea_product_btn!' => '',
                        '.wpb_ea_post_query.post_types' => 'product'
                    ]                               
                ]
            );

            // add to cart normal background color
            $this->add_control(
                'wpb_ea_add_to_cart_button_normal_bg_color',
                [
                    'type'          => \Elementor\Controls_Manager::COLOR,
                    'label'         => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
                    'scheme'        => [
                        'type'      => \Elementor\Scheme_Color::get_type(),
                        'value'     => \Elementor\Scheme_Color::COLOR_1
                    ],
                    'separator'     => '',
                    'selectors'     => [
                        '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-footer a.read-more' => 'background-color: {{VALUE}};'
                    ],
                    'default'       => 'transparent',
                    'condition'     => [
                        '.wpb_ea_post_grid_slider_content_options.wpb_ea_product_btn!' => '',
                        '.wpb_ea_post_query.post_types' => 'product'
                    ]                              
                ]
            );

            // add to cart normal box shadow
            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name'          => 'wpb_ea_add_to_cart_button_normal_box_shadow',
                    'selector'      => '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-footer a.read-more',
                    'separator'     => '',
                    'condition'     => [
                        '.wpb_ea_post_grid_slider_content_options.wpb_ea_product_btn!' => '',
                        '.wpb_ea_post_query.post_types' => 'product'
                    ]          
                ]
            );

            // add to cart button padding
            $this->add_control(
                'wpb_ea_add_to_cart_button_padding',
                [
                    'label'         => esc_html__( 'Button padding', 'wpb-elementor-addons' ),
                    'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px' ],
                    'selectors'     => [
                        '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-footer a.read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ],
                    'condition'     => [
                        '.wpb_ea_post_grid_slider_content_options.wpb_ea_product_btn!' => '',
                        '.wpb_ea_post_query.post_types' => 'product'
                    ]                  
                ]
            );

            // add to cart button border radius
            $this->add_control(
                'wpb_ea_add_to_cart_button_border_radius',
                [
                    'label'         => esc_html__( 'Button border radius', 'wpb-elementor-addons' ),
                    'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', '%' ],
                    'selectors'     => [
                        '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-footer a.read-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ],
                    'condition'     => [
                        '.wpb_ea_post_grid_slider_content_options.wpb_ea_product_btn!' => '',
                        '.wpb_ea_post_query.post_types' => 'product'
                    ]                  
                ]
            );

            $this->end_controls_tab();

            // add to cart button hover tab
            $this->start_controls_tab(
                'wpb_ea_add_to_cart_button_hover',
                [
                    'label'         => esc_html__( 'Hover', 'wpb-elementor-addons' ),
                    'condition'     => [
                        '.wpb_ea_post_grid_slider_content_options.wpb_ea_product_btn!' => '',
                        '.wpb_ea_post_query.post_types' => 'product'
                    ]         
                ]
            );

            // add to cart button hover text color
            $this->add_control(
                'wpb_ea_add_to_cart_button_hover_text_color',
                [
                    'type'          => \Elementor\Controls_Manager::COLOR,
                    'label'         => esc_html__( 'Text Color', 'wpb-elementor-addons' ),
                    'scheme'        => [
                        'type'      => \Elementor\Scheme_Color::get_type(),
                        'value'     => \Elementor\Scheme_Color::COLOR_1
                    ],
                    'separator'     => '',
                    'selectors'     => [
                        '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-footer a.read-more:hover' => 'color: {{VALUE}};'
                    ],
                    'default'       => '#333',
                    'condition'     => [
                        '.wpb_ea_post_grid_slider_content_options.wpb_ea_product_btn!' => '',
                        '.wpb_ea_post_query.post_types' => 'product'
                    ]                  
                ]
            );

            // add to cart button hover background color
            $this->add_control(
                'wpb_ea_add_to_cart_button_hover_bg_color',
                [
                    'type'          => \Elementor\Controls_Manager::COLOR,
                    'label'         => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
                    'scheme'        => [
                        'type'      => \Elementor\Scheme_Color::get_type(),
                        'value'     => \Elementor\Scheme_Color::COLOR_1
                    ],
                    'separator'     => '',
                    'selectors'     => [
                        '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-footer a.read-more:hover' => 'background-color: {{VALUE}};'
                    ],
                    'default'       => 'transparent',
                    'condition'     => [
                        '.wpb_ea_post_grid_slider_content_options.wpb_ea_product_btn!' => '',
                        '.wpb_ea_post_query.post_types' => 'product'
                    ]                          
                ]
            );

            // add to cart button hover box shadow
            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name'          => 'wpb_ea_add_to_cart_button_hover_box_shadow',
                    'selector'      => '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-footer a.read-more:hover',
                    'separator'     => '',
                    'condition'     => [
                        '.wpb_ea_post_grid_slider_content_options.wpb_ea_product_btn!' => '',
                        '.wpb_ea_post_query.post_types' => 'product'
                    ]                  
                ]
            );

            // add to cart button hover padding
            $this->add_control(
                'wpb_ea_add_to_cart_button_hover_padding',
                [
                    'label'         => esc_html__( 'Button padding', 'wpb-elementor-addons' ),
                    'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px' ],
                    'selectors'     => [
                        '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-footer a.read-more:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ],
                    'condition'     => [
                        '.wpb_ea_post_grid_slider_content_options.wpb_ea_product_btn!' => '',
                        '.wpb_ea_post_query.post_types' => 'product'
                    ]                  
                ]
            );

            // add to cart button hover border radius
            $this->add_control(
                'wpb_ea_add_to_cart_button_border_hover_radius',
                [
                    'label'         => esc_html__( 'Button border radius', 'wpb-elementor-addons' ),
                    'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', '%' ],
                    'selectors'     => [
                        '{{WRAPPER}} .wpb-ea-post-carousel .post-info .post-footer a.read-more:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ],
                    'condition'     => [
                        '.wpb_ea_post_grid_slider_content_options.wpb_ea_product_btn!' => '',
                        '.wpb_ea_post_query.post_types' => 'product'
                    ]                  
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();
    }

    // carousel style options
    private function wpb_ea_post_grid_slider_setting_style_section() {
        $wpb_ea_primary_color = wpb_ea_get_option( 'wpb_ea_primary_color', 'wpb_ea_style', '#3878ff' );
        $this->start_controls_section(
            'wpb_ea_post_grid_slider_setting_style_options',
            [
                'label'         => esc_html__( 'Carousel', 'wpb-elementor-addons' ),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    '.wpb_ea_post_query.wpb_ea_post_content_type' => 'slider'
                ]
            ]
        );  

        // navigation background color
        $this->add_control(
            'wpb_ea_post_grid_slider_navigation_bg_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Navigation Background Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1
                ],
                'default'       => $wpb_ea_primary_color,
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-posts-slider.owl-theme .owl-nav [class*=owl-]'      => 'background: {{VALUE}};'
                ],
                'condition'     => [
                    '.section_carousel_settings.arrows!' => ''
                ]                
            ]
        );

        // navigation color
        $this->add_control(
            'wpb_ea_post_grid_slider_navigation_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Navigation Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1
                ],
                'default'       => '#ffffff',
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-posts-slider .owl-prev .fa' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wpb-ea-posts-slider .owl-next .fa' => 'color: {{VALUE}};'
                ],
                'condition'     => [
                    '.section_carousel_settings.arrows!' => ''
                ]                
            ]
        );

        // pagination background color
        $this->add_control(
            'wpb_ea_post_grid_slider_pagination_bg_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Pagination Color', 'wpb-elementor-addons' ),
                'scheme'        => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1
                ],
                'default'       => $wpb_ea_primary_color,
                'selectors'     => [
                    '{{WRAPPER}} .wpb-ea-posts-slider.owl-theme .owl-dots .owl-dot span' => 'border-color: {{VALUE}}; background-color: {{VALUE}};'
                ],
                'condition'     => [
                    '.section_carousel_settings.dots!' => ''
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
        $settings = $this->get_settings_for_display();
        $orderby                   = $settings['wpb_ea_order_by'];
        $order                     = $settings['wpb_ea_order'];
        $post_type                 = $settings['post_types'];
        $posts_per_page            = $settings['posts_per_page'];
        $post_in_ids               = $settings['post_in_ids'] ? explode( ',', $settings['post_in_ids'] ) : null;
        $post_not_in_ids           = $settings['post_not_in_ids'] ? explode( ',', $settings['post_not_in_ids'] ) : null;
        $wpb_ea_excerpt_length     = $settings['wpb_ea_excerpt_length'];
        $wpb_ea_read_more_btn_text = $settings['wpb_ea_read_more_btn_text'];
        $wpb_ea_post_content_align = $settings['wpb_ea_post_content_align'];
        $extra_css                 = $settings['extra_css'];
        if($extra_css){
            $extra_css = $extra_css . ' ';
        }
        $stop                      = $settings['pause_on_hover'];
        $autoplay                  = $settings['autoplay'];
        $loop                      = $settings['loop'];
        $slidergap                 = $settings['slidergap']['size'];
        $items                     = $settings['desktop_columns'];
        $desktopsmall              = $settings['small_desktop_columns'];
        $tablet                    = $settings['tablet_display_columns'];
        $mobile                    = $settings['mobile_display_columns'];
        $navigation                = $settings['arrows'];
        $pagination                = $settings['dots'];

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
            'data-direction'     => ( is_rtl() ? 'true' : '' )
        );

        $args = array(
            'post_type'          => $post_type,
            'post_status'        => 'publish',
            'orderby'            => $orderby,
            'order'              => $order,
            'posts_per_page'     => $posts_per_page,
            'post__in'           => $post_in_ids,
            'post__not_in'       => $post_not_in_ids
        );

        // post type grid column options    
        if( $settings['wpb_ea_post_content_type'] == 'grid' ){
            $grid_desktop_column = 12/$settings['post_type_grid_desktop_column'];
            $grid_tablet_column  = 12/$settings['post_type_grid_tablet_column'];
            $grid_column         = 'col-lg-'.esc_attr( $grid_desktop_column ). ' col-md-'.esc_attr( $grid_tablet_column );   
        }        

        // show only post has feature image
        if( $settings['only_post_has_image'] == 'yes' ){
            $args['meta_query'][] = array( 'key' => '_thumbnail_id');
        }

        // display posts in category.
        if ( ! empty( $settings['wpb_ea_post_categories'] ) && $settings['post_types'] == 'post' ) {
            $args['category_name'] = $settings['wpb_ea_post_categories'];
        }

        // display products in category.
        if ( ! empty( $settings['wpb_ea_product_categories'] ) && $settings['post_types'] == 'product' ) {
            $args['tax_query'] = array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug',
                    'terms'    => $settings['wpb_ea_product_categories'],
                ),
            );
        }

        $wp_query = new \WP_Query( $args );
        if ( $wp_query->have_posts() ) : 
            echo '<div class="'. esc_attr($extra_css) .'wpb-ea-posts-items wpb-ea-posts-' .( $settings['wpb_ea_post_content_type'] == 'slider' ? 'slider owl-carousel owl-theme" '.wpb_ea_owl_carousel_data_attr_implode( $slider_attr ) : 'grid ea-row"' ).'>';  
                while ( $wp_query->have_posts() ) : $wp_query->the_post();

                    global $post, $product;

                    echo $settings['wpb_ea_post_content_type'] == 'grid' ? '<div class="wpb-ea-posts-item-column '. esc_attr( $grid_column ) .'">' : '';
                        echo '<div class="wpb-ea-post-carousel content-alignment-'. esc_attr( $wpb_ea_post_content_align ) .'">';

                            if( $settings['wpb_ea_show_post_image'] == 'yes' && has_post_thumbnail() ) :  
                                                      
                                echo '<div class="post-thumbnail">';
                                    echo $settings['wpb_ea_post_image_link'] == 'yes' ? '<a href="'. esc_url( get_the_permalink() ) .'" title="'. esc_html( get_the_title() ) .'">' : '';
                                        echo $this->render_image( get_post_thumbnail_id( get_the_id() ), $settings );
                                    echo $settings['wpb_ea_post_image_link'] == 'yes' ? '</a>' : '';
                                    if ( $settings['post_types'] == 'product' && $settings['wpb_ea_show_tag_for_featured_product'] == 'yes' && !empty($settings['wpb_ea_featured_product_tag_text']) ) {
                                        if( $product->is_featured() ) {
                                            echo '<span class="featured-product-text">'. esc_html( $settings['wpb_ea_featured_product_tag_text'] ) .'</span>';
                                        }
                                    }
                                echo '</div>';

                            endif;

                            echo '<div class="post-info">';
                                echo '<div class="post-content">';
                                    $icon_type = is_rtl() ? 'left' : 'right';
                                    
                                    if( $settings['wpb_ea_show_post_date'] == 'yes' ) :
                                        echo '<div class="post-date"><a href="'. esc_url( get_the_permalink() ) .'">'. get_the_date( get_option( 'date_format' ) ) .'</a></div>';
                                    endif;

                                    if( $settings['wpb_ea_show_post_title'] == 'yes' && $settings['wpb_ea_show_post_title_link'] == 'yes' ) {
                                        the_title( '<a href="'. esc_url( get_the_permalink() ) .'" class="post-link"><h3 class="post-heading">', '</h3></a>' );
                                    } elseif( $settings['wpb_ea_show_post_title'] == 'yes' && $settings['wpb_ea_show_post_title_link'] != 'yes' ) {
                                        the_title( '<h3 class="post-heading">', '</h3>' ); 
                                    }

                                    if ( $settings['post_types'] == 'product' && $settings['wpb_ea_product_review'] == 'yes' ) :
                                        $average = $product->get_average_rating();
                                        echo '<ul class="wpb-ea-product-rating">';
                                            echo '<div class="wpb-ea-product-star-rating" title="'. sprintf(__( 'Rated %s out of 5', 'woocommerce' ), $average) .'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'woocommerce' ).'</span></div>';
                                        echo '</ul>';
                                    endif;

                                    if ( $settings['wpb_ea_show_post_meta'] == 'yes' && ! empty( $settings['wpb_ea_post_meta_options'] ) ) :
                                        echo '<div class="post-meta">';
                                            foreach ( $settings['wpb_ea_post_meta_options'] as $post_meta ) :
                                                switch ( $post_meta ) :

                                                    // author
                                                    case 'author':
                                                        echo '<span class="wpb-ea-post-author">';
                                                            echo esc_html( $settings['wpb_ea_text_author'] ) . get_the_author_posts_link();
                                                        echo '</span>';                            
                                                        break;

                                                    // category
                                                    case 'category':
                                                        $this->wpb_ea_get_post_category(esc_html( $settings['wpb_ea_text_category'] ));
                                                        break;

                                                    // tags
                                                    case 'tags':
                                                        $this->wpb_ea_get_post_tag(esc_html( $settings['wpb_ea_text_tags'] ));
                                                        break;

                                                    // comments/reviews
                                                    case 'comments': 
                                                        echo '<i class="fa fa-comment"></i> ';
                                                        if( comments_open() ) :
                                                            echo '<span class="wpb-ea-post-comments">';
                                                                if ( $settings['post_types'] == 'product' ) {
                                                                    echo comments_number( esc_html__( 'No reviews', 'wpb-elementor-addons' ), esc_html__( '1 review', 'wpb-elementor-addons' ), esc_html__( '% reviews', 'wpb-elementor-addons' ) );
                                                                } else {
                                                                    echo comments_number( esc_html__( 'No comments', 'wpb-elementor-addons' ), esc_html__( '1 comment', 'wpb-elementor-addons' ), esc_html__( '% comments', 'wpb-elementor-addons' ) );
                                                                }
                                                            echo '</span>';
                                                        elseif( $settings['post_types'] == 'product' ) :
                                                            echo esc_html__('Reviews Disabled', 'wpb-elementor-addons');
                                                        else :
                                                            echo esc_html__('Comments Disabled', 'wpb-elementor-addons');
                                                        endif;
                                                    break;

                                                endswitch;
                                            endforeach;
                                        echo '</div>';
                                    endif;

                                    if( $settings['wpb_ea_show_excerpt'] == 'yes' ) :
                                        echo '<div class="post-details">'.wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $wpb_ea_excerpt_length ) ) ).'</div>';
                                    endif;

                                    // price
                                    if ( class_exists( 'WooCommerce' ) ) {
                                        $this->wpb_ea_product_price();
                                    }

                                echo '</div>';

                                if( !empty($settings['wpb_ea_read_more_btn_text']) && $settings['wpb_ea_read_more_btn'] == 'yes' && $settings['post_types'] != 'product' ) :
                                    echo '<div class="post-footer"><a href="'. esc_url( get_the_permalink() ) .'" class="read-more">'.esc_html( $settings['wpb_ea_read_more_btn_text'] ).' <i class="fa fa-arrow-'.$icon_type.'"></i></a></div>';
                                endif;

                                if ( $settings['post_types'] == 'product' && $settings['wpb_ea_product_btn'] == 'yes' ) :
                                    echo '<div class="post-footer">';
                                        $this->wpb_ea_add_to_cart_button();
                                    echo '</div>';
                                endif;

                            echo '</div>';
                        echo '</div>';
                    echo $settings['wpb_ea_post_content_type'] == 'grid' ? '</div>' : '';
                endwhile;
            echo '</div>';
        endif;
        wp_reset_postdata();
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new WPB_EA_Post_Grid_Slider() );