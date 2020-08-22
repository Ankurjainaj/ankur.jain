<?php

namespace WPB_Elementor_Addons\Traits;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;


trait Helper
{
    /**
     * Get all types of post.
     * @return array
     */
    public function wpb_get_all_types_post($post_type = 'any')
    {
        $posts = get_posts([
            'post_type' => $post_type,
            'post_status' => 'publish',
            'numberposts' => -1,
        ]);

        if (!empty($posts)) {
            return wp_list_pluck($posts, 'post_title', 'ID');
        }

        return [];
    }

    /**
     * Post Query Controls
     *
     */
    protected function wpb_post_query_controls()
    {
        $post_types = $this->wpb_get_post_types();
        $post_types['by_id'] = __('Manual Selection', 'wpb-elementor-news-ticker-pro');
        $taxonomies = get_taxonomies([], 'objects');


        $this->start_controls_section(
            'wpb_section_post_filters',
            [
                'label' => __('Query', 'wpb-elementor-news-ticker-pro'),
                'condition' => [
                    'content_source' => 'post',
                ],
            ]
        );

        $this->add_control(
            'post_type',
            [
                'label' => __('Source', 'wpb-elementor-news-ticker-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => $post_types,
                'default' => key($post_types),
            ]
        );

        $this->add_control(
            'posts_ids',
            [
                'label' => __('Search & Select', 'wpb-elementor-news-ticker-pro'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->wpb_get_all_types_post(),
                'label_block' => true,
                'multiple' => true,
                'condition' => [
                    'post_type' => 'by_id',
                ],
            ]
        );

        $this->add_control(
            'authors', [
                'label' => __('Author', 'wpb-elementor-news-ticker-pro'),
                'label_block' => true,
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'default' => [],
                'options' => $this->wpb_get_authors(),
                'condition' => [
                    'post_type!' => 'by_id',
                ],
            ]
        );

        foreach ($taxonomies as $taxonomy => $object) {
            if (!isset($object->object_type[0]) || !in_array($object->object_type[0], array_keys($post_types))) {
                continue;
            }

            $this->add_control(
                $taxonomy . '_ids',
                [
                    'label' => $object->label,
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'object_type' => $taxonomy,
                    'options' => wp_list_pluck(get_terms($taxonomy), 'name', 'term_id'),
                    'condition' => [
                        'post_type' => $object->object_type,
                    ],
                ]
            );
        }

        $this->add_control(
            'post__not_in',
            [
                'label' => __('Exclude', 'wpb-elementor-news-ticker-pro'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->wpb_get_all_types_post(),
                'label_block' => true,
                'post_type' => '',
                'multiple' => true,
                'condition' => [
                    'post_type!' => 'by_id',
                ],
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Posts Per Page', 'wpb-elementor-news-ticker-pro'),
                'type' => Controls_Manager::NUMBER,
                'default' => '4',
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => __('Offset', 'wpb-elementor-news-ticker-pro'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => __('Order By', 'wpb-elementor-news-ticker-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => $this->wpb_get_post_orderby_options(),
                'default' => 'date',

            ]
        );

        $this->add_control(
            'order',
            [
                'label' => __('Order', 'wpb-elementor-news-ticker-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' => __('Ascending', 'wpb-elementor-news-ticker-pro'),
                    'desc' => __('Descending', 'wpb-elementor-news-ticker-pro'),
                ],
                'default' => 'desc',

            ]
        );

        $this->end_controls_section();
    }

    

    /**
     * Category Query Controls
     *
     */
    protected function wpb_category_query_controls()
    {
    	$taxonomies     = $this->wpb_get_taxonomies();
        $all_taxonomies = get_taxonomies([], 'objects');

        $this->start_controls_section(
            'wpb_section_category_filters',
            [
                'label' => __('Category Query', 'wpb-elementor-news-ticker-pro'),
                'condition' => [
                    'content_source' => 'category',
                ],
            ]
        );

        $this->add_control(
            'category_taxonomy',
            [
                'label' => __('Taxonomy', 'wpb-elementor-news-ticker-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => $taxonomies,
                'default' => key($taxonomies),
            ]
        );

        foreach ($all_taxonomies as $taxonomy => $object) {

        	if (!isset($object->object_type[0])) {
                continue;
            }

            $this->add_control(
                $taxonomy . '_ids_for_cat_include',
                [
                    'label' => $object->label . __(' Include', 'wpb-elementor-news-ticker-pro'),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'object_type' => $taxonomy,
                    'options' => wp_list_pluck(get_terms($taxonomy), 'name', 'term_id'),
                    'condition' => [
                        'category_taxonomy' => $object->name,
                    ],
                ]
            );
        }

        foreach ($all_taxonomies as $taxonomy => $object) {

        	if (!isset($object->object_type[0])) {
                continue;
            }

            $this->add_control(
                $taxonomy . '_ids_for_cat_exclude',
                [
                    'label' => $object->label . __(' Exclude', 'wpb-elementor-news-ticker-pro'),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'object_type' => $taxonomy,
                    'options' => wp_list_pluck(get_terms($taxonomy), 'name', 'term_id'),
                    'condition' => [
                        'category_taxonomy' => $object->name,
                    ],
                ]
            );
        }

        $this->add_control(
            'term_orderby',
            [
                'label' => __('Order By', 'wpb-elementor-news-ticker-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => $this->wpb_get_terms_orderby_options(),
                'default' => 'name',

            ]
        );

        $this->add_control(
            'term_order',
            [
                'label' => __('Order', 'wpb-elementor-news-ticker-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => __('Ascending', 'wpb-elementor-news-ticker-pro'),
                    'DESC' => __('Descending', 'wpb-elementor-news-ticker-pro'),
                ],
                'default' => 'ASC',

            ]
        );

        $this->add_control(
			'term_hide_empty',
			[
				'label' => __( 'Hide Empty', 'wpb-elementor-news-ticker-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'wpb-elementor-news-ticker-pro' ),
				'label_off' => __( 'No', 'wpb-elementor-news-ticker-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->end_controls_section();
    }


    /**
     * Menu Query Controls
     *
     */
    protected function wpb_menu_query_controls()
    {

        $this->start_controls_section(
            'wpb_section_menu_filters',
            [
                'label' => __('Menu Query', 'wpb-elementor-news-ticker-pro'),
                'condition' => [
                    'content_source' => 'menu',
                ],
            ]
        );

        $this->add_control(
            'menu_to_show',
            [
                'label' => __('Select a Navigation Menu', 'wpb-elementor-news-ticker-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => wp_list_pluck(wp_get_nav_menus([], 'objects'), 'name', 'term_id'),
                'default' => key(wp_list_pluck(wp_get_nav_menus([], 'objects'), 'name', 'term_id')),
            ]
        );


        $this->end_controls_section();
    }


    public function wpb_get_query_args($settings = [], $requested_post_type = 'post')
    {
        $settings = wp_parse_args($settings, [
            'post_type' => $requested_post_type,
            'posts_ids' => [],
            'orderby' => 'date',
            'order' => 'desc',
            'posts_per_page' => 3,
            'offset' => 0,
            'post__not_in' => [],
        ]);

        $args = [
            'orderby' => $settings['orderby'],
            'order' => $settings['order'],
            'ignore_sticky_posts' => 1,
            'post_status' => 'publish',
            'posts_per_page' => $settings['posts_per_page'],
            'offset' => $settings['offset'],
        ];

        if ('by_id' === $settings['post_type']) {
            $args['post_type'] = 'any';
            $args['post__in'] = empty($settings['posts_ids']) ? [0] : $settings['posts_ids'];
        } else {
            $args['post_type'] = $settings['post_type'];

            if ($args['post_type'] !== 'page') {
                $args['tax_query'] = [];

                $taxonomies = get_object_taxonomies($settings['post_type'], 'objects');

                foreach ($taxonomies as $object) {
                    $setting_key = $object->name . '_ids';

                    if (!empty($settings[$setting_key])) {
                        $args['tax_query'][] = [
                            'taxonomy' => $object->name,
                            'field' => 'term_id',
                            'terms' => $settings[$setting_key],
                        ];
                    }
                }

                if (!empty($args['tax_query'])) {
                    $args['tax_query']['relation'] = 'AND';
                }
            }
        }

        if (!empty($settings['authors'])) {
            $args['author__in'] = $settings['authors'];
        }

        if (!empty($settings['post__not_in'])) {
            $args['post__not_in'] = $settings['post__not_in'];
        }

        return $args;
    }


    /**
     * List Category query args
     *
     * https://developer.wordpress.org/reference/functions/wp_list_categories/
     *
     */

    public function wpb_get_taxonomy_query_args($settings = [])
    {
    	$settings = wp_parse_args($settings, [
            'depth' => 1,
        ]);

        $args = [
            'taxonomy'    => $settings['category_taxonomy'],
            'orderby'     => $settings['term_orderby'],
            'order'       => $settings['term_order'],
            'hide_empty'  => ( $settings['term_hide_empty'] == 'yes' ? true : false ),
        ];

        if (!empty($settings['depth'])) {
            $args['depth'] = $settings['depth'];
        }

        $taxonomy_include_ids = $settings['category_taxonomy'] . '_ids_for_cat_include';

        if (!empty($settings[$taxonomy_include_ids])) {
            $args['include'] = $settings[$taxonomy_include_ids];
        }

        $taxonomy_exclude_ids = $settings['category_taxonomy'] . '_ids_for_cat_exclude';

        if (!empty($settings[$taxonomy_exclude_ids])) {
            $args['exclude'] = $settings[$taxonomy_exclude_ids];
        }

        return $args;
    }


    /**
     * Nav Menu query args
     *
     * https://developer.wordpress.org/reference/functions/wp_nav_menu/
     *
     */

    public function wpb_get_menu_query_args($settings = [])
    {
    	$settings = wp_parse_args($settings, [
            'depth' 	=> 1,
            'echo'  	=> 0,
        ]);

        $args = [
            'menu'    	=> $settings['menu_to_show'],
            'echo'  	=> 0,
            'container'	=> 0,
        ];

        if (!empty($settings['depth'])) {
            $args['depth'] = $settings['depth'];
        }

        return $args;
    }
    

    /**
     * Get All POst Types
     * @return array
     */
    public function wpb_get_post_types()
    {
        $post_types = get_post_types(['public' => true, 'show_in_nav_menus' => true], 'objects');
        $post_types = wp_list_pluck($post_types, 'label', 'name');

        return array_diff_key($post_types, ['elementor_library', 'attachment']);
    }

    /**
     * Get All Taxonomies
     * @return array
     */
    public function wpb_get_taxonomies()
    {
        $taxonomies = get_taxonomies([ 'public' => true, 'show_ui' => true ], 'objects');
        $taxonomies = wp_list_pluck($taxonomies, 'label', 'name');

        return array_diff_key($taxonomies, []);
    }

    /**
     * Get Post Thumbnail Size
     *
     * @return array
     */
    public function wpb_get_thumbnail_sizes()
    {
        $sizes = get_intermediate_image_sizes();
        foreach ($sizes as $s) {
            $ret[$s] = $s;
        }

        return $ret;
    }

    /**
     * POst Orderby Options
     *
     * @return array
     */
    public function wpb_get_post_orderby_options()
    {
        $orderby = array(
            'ID'            => __( 'Post ID', 'wpb-elementor-news-ticker-pro' ),
            'author'        => __( 'Post Author', 'wpb-elementor-news-ticker-pro' ),
            'title'         => __( 'Title', 'wpb-elementor-news-ticker-pro' ),
            'date'          => __( 'Date', 'wpb-elementor-news-ticker-pro' ),
            'modified'      => __( 'Last Modified Date', 'wpb-elementor-news-ticker-pro' ),
            'parent'        => __( 'Parent Id', 'wpb-elementor-news-ticker-pro' ),
            'rand'          => __( 'Random', 'wpb-elementor-news-ticker-pro' ),
            'comment_count' => __( 'Comment Count', 'wpb-elementor-news-ticker-pro' ),
            'menu_order'    => __( 'Menu Order', 'wpb-elementor-news-ticker-pro' ),
        );

        return $orderby;
    }


    /**
     * get_terms Orderby Options
     *
     * @return array
     */
    public function wpb_get_terms_orderby_options()
    {
        $orderby = array(
            'name' 			=> __( 'Name', 'wpb-elementor-news-ticker-pro' ),
            'count' 		=> __( 'Count', 'wpb-elementor-news-ticker-pro' ),
            'slug' 			=> __( 'Slug', 'wpb-elementor-news-ticker-pro' ),
            'term_group' 	=> __( 'Term Group', 'wpb-elementor-news-ticker-pro' ),
            'term_order' 	=> __( 'Term Order', 'wpb-elementor-news-ticker-pro' ),
            'term_id' 		=> __( 'Term ID', 'wpb-elementor-news-ticker-pro' ),
            'include' 		=> __( 'Include', 'wpb-elementor-news-ticker-pro' ),
            'slug__in' 		=> __( 'Slug In', 'wpb-elementor-news-ticker-pro' ),
            'none' 		    => __( 'None', 'wpb-elementor-news-ticker-pro' ),
        );

        return $orderby;
    }


    /**
     * Get Post Categories
     *
     * @return array
     */
    public function wpb_post_type_categories($type = 'term_id', $term_key = 'category')
    {
        $terms = get_terms(array(
            'taxonomy' => $term_key,
            'hide_empty' => true,
        ));

        $options = [];

        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->{$type}] = $term->name;
            }
        }

        return $options;
    }

    /**
     * WooCommerce Product Query
     *
     * @return array
     */
    public function wpb_woocommerce_product_categories()
    {
        $terms = get_terms(array(
            'taxonomy' => 'product_cat',
            'hide_empty' => true,
        ));

        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->slug] = $term->name;
            }
            return $options;
        }
    }

    /**
     * WooCommerce Get Product By Id
     *
     * @return array
     */
    public function wpb_woocommerce_product_get_product_by_id()
    {
        $postlist = get_posts(array(
            'post_type' => 'product',
            'showposts' => 9999,
        ));
        $options = array();

        if (!empty($postlist) && !is_wp_error($postlist)) {
            foreach ($postlist as $post) {
                $options[$post->ID] = $post->post_title;
            }
            return $options;

        }
    }

    /**
     * WooCommerce Get Product Category By Id
     *
     * @return array
     */
    public function wpb_woocommerce_product_categories_by_id()
    {
        $terms = get_terms(array(
            'taxonomy' => 'product_cat',
            'hide_empty' => true,
        ));

        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->term_id] = $term->name;
            }
            return $options;
        }

    }



    /**
     * Get all elementor page templates
     *
     * @return array
     */
    public function wpb_get_page_templates($type = null)
    {
        $args = [
            'post_type' => 'elementor_library',
            'posts_per_page' => -1,
        ];

        if ($type) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'elementor_library_type',
                    'field' => 'slug',
                    'terms' => $type,
                ],
            ];
        }

        $page_templates = get_posts($args);
        $options = array();

        if (!empty($page_templates) && !is_wp_error($page_templates)) {
            foreach ($page_templates as $post) {
                $options[$post->ID] = $post->post_title;
            }
        }
        return $options;
    }

    /**
     * Get all Authors
     *
     * @return array
     */
    public function wpb_get_authors()
    {
        $users = get_users([
            'who' => 'authors',
            'has_published_posts' => true,
            'fields' => [
                'ID',
                'display_name',
            ],
        ]);

        if (!empty($users)) {
            return wp_list_pluck($users, 'display_name', 'ID');
        }

        return [];
    }

    /**
     * Get all Tags
     *
     * @param  array  $args
     *
     * @return array
     */
    public function wpb_get_tags($args = array())
    {
        $options = [];
        $tags = get_tags($args);

        if (is_wp_error($tags)) {
            return [];
        }

        foreach ($tags as $tag) {
            $options[$tag->term_id] = $tag->name;
        }

        return $options;
    }

    /**
     * Get all taxonomies by post
     *
     * @param  array   $args
     *
     * @param  string  $output
     * @param  string  $operator
     *
     * @return array
     */
    public function wpb_get_taxonomies_by_post($args = [], $output = 'names', $operator = 'and')
    {
        global $wp_taxonomies;

        $field = ('names' === $output) ? 'name' : false;

        // Handle 'object_type' separately.
        if (isset($args['object_type'])) {
            $object_type = (array) $args['object_type'];
            unset($args['object_type']);
        }

        $taxonomies = wp_filter_object_list($wp_taxonomies, $args, $operator);

        if (isset($object_type)) {
            foreach ($taxonomies as $tax => $tax_data) {
                if (!array_intersect($object_type, $tax_data->object_type)) {
                    unset($taxonomies[$tax]);
                }
            }
        }

        if ($field) {
            $taxonomies = wp_list_pluck($taxonomies, $field);
        }

        return $taxonomies;
    }

    /**
     * Get all Posts
     *
     * @return array
     */
    public function wpb_get_posts()
    {
        $post_list = get_posts(array(
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => -1,
        ));

        $posts = array();

        if (!empty($post_list) && !is_wp_error($post_list)) {
            foreach ($post_list as $post) {
                $posts[$post->ID] = $post->post_title;
            }
        }

        return $posts;
    }

    /**
     * Get all Pages
     *
     * @return array
     */
    public function wpb_get_pages()
    {
        $page_list = get_posts(array(
            'post_type' => 'page',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => -1,
        ));

        $pages = array();

        if (!empty($page_list) && !is_wp_error($page_list)) {
            foreach ($page_list as $page) {
                $pages[$page->ID] = $page->post_title;
            }
        }

        return $pages;
    }



    /**
     * WPB News Ticker Attr
     */
    
    public function wpb_get_news_ticker_attr($settings)
    {
        $direction       = $settings['wpb_ea_pro_news_ticker_animation_direction'];
        $ticker_height   = $settings['wpb_ea_pro_news_ticker_height'];
        $autoplay        = $settings['wpb_ea_pro_news_ticker_autoplay'];
        $bottom_fixed    = $settings['wpb_ea_pro_news_ticker_set_bottom_fixed'];
        $animation_type  = $settings['wpb_ea_pro_news_ticker_animation_type'];

        ( $animation_type == 'scroll' ) ? $animation_speed = $settings['wpb_ea_pro_news_ticker_animation_speed'] : $animation_speed = '';
        ( $animation_type != 'scroll' ) ? $autoplay_interval = $settings['wpb_ea_pro_news_ticker_autoplay_interval'] : $autoplay_interval = '';
        ( $autoplay == 'yes' ) ? $pause_on_hover = $settings['wpb_ea_pro_news_ticker_pause_on_hover'] : $pause_on_hover = '';


        $data_attr    = array(
            'data-autoplay'          => esc_attr( $autoplay == 'yes' ? 'true' : 'false' ),
            'data-bottom_fixed'      => esc_attr( $bottom_fixed == 'yes' ? 'fixed-bottom' : 'false' ),
            'data-pause_on_hover'    => esc_attr( $pause_on_hover == 'yes' ? 'true' : 'false' ),
            'data-autoplay_interval' => esc_attr( $autoplay_interval ),
            'data-direction'         => ( (is_rtl() || $direction == 'rtl') ? 'rtl' : 'ltr' ),
            'data-animation_speed'   => esc_attr( $animation_speed ),
            'data-ticker_height'     => esc_attr( $ticker_height ),
            'data-animation'         => esc_attr( $animation_type )
        );

        return $data_attr;
    }

}