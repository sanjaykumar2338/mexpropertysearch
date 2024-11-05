<?php
class Widget_Properties extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tf_properties_list';
	}

	public function get_title() {
		return esc_html__( 'TF Properties List', 'tf-real-estate' );
	}

	public function get_icon() {
		return 'eicon-archive';
	}

	public function get_categories() {
		return [ 'themesflat_real_estate_addons' ];
	}

	public function get_keywords() {
		return [ 'properties', 'list' ];
	}

	public function get_style_depends() {
		return [ 'owl-carousel', 'properties-styles' ];
	}

	public function get_script_depends() {
		return [ 'owl-carousel', 'properties-script' ];
	}

	protected function register_controls() {
		// Start Properties Query        
		$this->start_controls_section(
			'section_properties_query',
			[ 
				'label' => esc_html__( 'Query', 'tf-real-estate' ),
			]
		);

		$this->add_control(
			'properties_per_page',
			[ 
				'label'   => esc_html__( 'Properties Per Page', 'tf-real-estate' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => '6',
			]
		);

		$this->add_control(
			'order_by',
			[ 
				'label'   => esc_html__( 'Order By', 'tf-real-estate' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [ 
					'date'  => esc_html__( 'Date', 'tf-real-estate' ),
					'ID'    => esc_html__( 'Post ID', 'tf-real-estate' ),
					'title' => esc_html__( 'Title', 'tf-real-estate' ),
				],
			]
		);

		$this->add_control(
			'order',
			[ 
				'label'   => esc_html__( 'Order', 'tf-real-estate' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [ 
					'desc' => esc_html__( 'Descending', 'tf-real-estate' ),
					'asc'  => esc_html__( 'Ascending', 'tf-real-estate' ),
				],
			]
		);

		$this->add_control(
			'property-type',
			[ 
				'label'       => esc_html__( 'Property Type', 'tf-real-estate' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'options'     => tfre_get_taxonomies( 'property-type' ),
				'label_block' => true,
				'multiple'    => true,
			]
		);

		$this->add_control(
			'property-status',
			[ 
				'label'       => esc_html__( 'Property Status', 'tf-real-estate' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'options'     => tfre_get_taxonomies( 'property-status' ),
				'label_block' => true,
				'multiple'    => true,
			]
		);

		$this->add_control(
			'property-feature',
			[ 
				'label'       => esc_html__( 'Property Feature', 'tf-real-estate' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'options'     => tfre_get_taxonomies( 'property-feature' ),
				'label_block' => true,
				'multiple'    => true,
			]
		);

		$this->add_control(
			'property-label',
			[ 
				'label'       => esc_html__( 'Property Label', 'tf-real-estate' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'options'     => tfre_get_taxonomies( 'property-label' ),
				'label_block' => true,
				'multiple'    => true,
			]
		);

		$this->add_control(
			'province-state',
			[ 
				'label'       => esc_html__( 'Property Province State', 'tf-real-estate' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'options'     => tfre_get_taxonomies( 'province-state' ),
				'label_block' => true,
				'multiple'    => true,
			]
		);

		$this->add_control(
			'neighborhood',
			[ 
				'label'       => esc_html__( 'Property Neighborhood', 'tf-real-estate' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'options'     => tfre_get_taxonomies( 'neighborhood' ),
				'label_block' => true,
				'multiple'    => true,
			]
		);

		$this->add_control(
			'exclude',
			[ 
				'label'       => esc_html__( 'Exclude', 'tf-real-estate' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Post Ids Will Be Inorged. Ex: 1,2,3', 'tf-real-estate' ),
				'default'     => '',
				'label_block' => true,
			]
		);

		$this->add_control(
			'sort_by_id',
			[ 
				'label'       => esc_html__( 'Sort By ID', 'tf-real-estate' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Post Ids Will Be Sort. Ex: 1,2,3', 'tf-real-estate' ),
				'default'     => '',
				'label_block' => true,
			]
		);

		$this->add_control(
			'show_label',
			[ 
				'label'        => esc_html__( 'Show Label', 'tf-real-estate' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'tf-real-esate' ),
				'label_off'    => esc_html__( 'Hide', 'tf-real-estate' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'show_address',
			[ 
				'label'        => esc_html__( 'Show Address', 'tf-real-estate' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'tf-real-estate' ),
				'label_off'    => esc_html__( 'Hide', 'tf-real-estate' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_price',
			[ 
				'label'        => esc_html__( 'Show Price', 'tf-real-estate' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'tf-real-estate' ),
				'label_off'    => esc_html__( 'Hide', 'tf-real-estate' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_bedrooms',
			[ 
				'label'        => esc_html__( 'Show Bedrooms', 'tf-real-estate' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'tf-real-estate' ),
				'label_off'    => esc_html__( 'Hide', 'tf-real-estate' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'show_bathrooms',
			[ 
				'label'        => esc_html__( 'Show Bathrooms', 'tf-real-estate' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'tf-real-estate' ),
				'label_off'    => esc_html__( 'Hide', 'tf-real-estate' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'show_size',
			[ 
				'label'        => esc_html__( 'Show Sizes', 'tf-real-estate' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'tf-real-estate' ),
				'label_off'    => esc_html__( 'Hide', 'tf-real-estate' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'show_rooms',
			[ 
				'label'        => esc_html__( 'Show Rooms', 'tf-real-estate' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'tf-real-estate' ),
				'label_off'    => esc_html__( 'Hide', 'tf-real-estate' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'show_land_area',
			[ 
				'label'        => esc_html__( 'Show Land Area', 'tf-real-estate' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'tf-real-estate' ),
				'label_off'    => esc_html__( 'Hide', 'tf-real-estate' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);


		$this->add_control(
			'show_garages',
			[ 
				'label'        => esc_html__( 'Show Garages', 'tf-real-estate' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'tf-real-estate' ),
				'label_off'    => esc_html__( 'Hide', 'tf-real-estate' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'show_garages_size',
			[ 
				'label'        => esc_html__( 'Show Garages Size', 'tf-real-estate' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'tf-real-estate' ),
				'label_off'    => esc_html__( 'Hide', 'tf-real-estate' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'show_agent',
			[ 
				'label'        => esc_html__( 'Show Agent', 'tf-real-estate' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'tf-real-estate' ),
				'label_off'    => esc_html__( 'Hide', 'tf-real-estate' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_year',
			[ 
				'label'        => esc_html__( 'Show Year', 'tf-real-estate' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'tf-real-estate' ),
				'label_off'    => esc_html__( 'Hide', 'tf-real-estate' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_action',
			[ 
				'label'        => esc_html__( 'Show Action', 'tf-real-estate' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'tf-real-estate' ),
				'label_off'    => esc_html__( 'Hide', 'tf-real-estate' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->end_controls_section();
		// /.End Properties Query

		// Start Layout Style
		$this->start_controls_section(
			'section_layout_style',
			[ 
				'label' => esc_html__( 'Layout Style', 'tf-real-estate' ),
			]
		);

		$this->add_control(
			'layout_style',
			[
				'label' => esc_html__( 'Layout Style', 'tf-real-estate' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'grid' => [
						'title' => esc_html__( 'Grid', 'tf-real-estate' ),
						'icon' => 'eicon-posts-grid',
					],
					'list' => [
						'title' => esc_html__( 'List', 'tf-real-estate' ),
						'icon' => 'eicon-post-list',
					],
				],
				'default' => 'grid',
				'toggle' => false,
			]
		);

		$this->add_control(
			'style_grid',
			[ 
				'label'   => esc_html__( 'Styles Grid', 'tf-real-estate' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [ 
					'style1' => esc_html__( 'Grid Style 1', 'tf-real-estate' ),
					'style3' => esc_html__( 'Grid Style 2', 'tf-real-estate' ),
					'style4' => esc_html__( 'Grid Style 3', 'tf-real-estate' ),
				],
				'condition' => [
					'layout_style' => 'grid',
				],
			]
		);

		$this->add_control(
			'style_list',
			[ 
				'label'   => esc_html__( 'Styles List', 'tf-real-estate' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style2',
				'options' => [ 
					'style2' => esc_html__( 'List Style 1', 'tf-real-estate' ),
					'style5' => esc_html__( 'List Style 2', 'tf-real-estate' ),
				],
				'condition' => [
					'layout_style' => 'list',
				],
			]
		);

		$this->add_control(
			'layout_grid',
			[ 
				'label'   => esc_html__( 'Columns', 'tf-real-estate' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'column-4',
				'options' => [ 
					'column-2' => esc_html__( '2', 'tf-real-estate' ),
					'column-3' => esc_html__( '3', 'tf-real-estate' ),
					'column-4' => esc_html__( '4', 'tf-real-estate' ),
				],
				'condition' => [
					'layout_style' => 'grid',
				],
			]
		);

		$this->add_control(
			'layout_list',
			[ 
				'label'   => esc_html__( 'Columns', 'tf-real-estate' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'column-2',
				'options' => [ 
					'column-1' => esc_html__( '1', 'tf-real-estate' ),
					'column-2' => esc_html__( '2', 'tf-real-estate' ),
				],
				'condition' => [
					'layout_style' => 'list',
				],
			]
		);

		$this->end_controls_section();
		// /.End Layout Style

		// Start Taxonomy Tabs
		$this->start_controls_section(
			'section_taxonomy_tabs',
			[ 
				'label' => esc_html__( 'Taxonomy Tabs', 'tf-real-estate' ),
			]
		);

		$this->add_control(
			'taxonomy_tabs',
			[ 
				'label'        => esc_html__( 'Taxonomy Tabs', 'tf-real-estate' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'tf-real-estate' ),
				'label_off'    => esc_html__( 'Off', 'tf-real-estate' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'taxonomy_list',
			[ 
				'label'     => esc_html__( 'Taxonomy', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'property-type',
				'options'   => [ 
					'property-type'   => esc_html__( 'Property Type', 'tf-real-estate' ),
					'property-status' => esc_html__( 'Property Status', 'tf-real-estate' ),
					'property-label'  => esc_html__( 'Property Label', 'tf-real-estate' ),
				],
				'condition' => [ 
					'taxonomy_tabs' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'taxonomy_tabs_align',
			[ 
				'label'       => esc_html__( 'Taxonomy Tabs Alignment', 'tf-real-estate' ),
				'type'        => \Elementor\Controls_Manager::CHOOSE,
				'label_block' => true,
				'options'     => [ 
					'flex-start' => [ 
						'title' => esc_html__( 'Left', 'tf-real-estate' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'     => [ 
						'title' => esc_html__( 'Center', 'tf-real-estate' ),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end'   => [ 
						'title' => esc_html__( 'Right', 'tf-real-estate' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'     => 'center',
				'toggle'      => true,
				'selectors'   => [ 
					'{{WRAPPER}} .tf-properties-wrap .wrap-properties-post .filter-bar' => 'justify-content: {{VALUE}};',
				],
				'condition'   => [ 
					'taxonomy_tabs' => 'yes',
				],
			]
		);

		$this->end_controls_section();
		// /.End Taxonomy Tabs

		// Start Carousel        
		$this->start_controls_section(
			'section_properties_carousel',
			[ 
				'label' => esc_html__( 'Carousel', 'tf-real-estate' ),
			]
		);

		$this->add_control(
			'carousel',
			[ 
				'label'        => esc_html__( 'Carousel', 'tf-real-estate' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'tf-real-estate' ),
				'label_off'    => esc_html__( 'Off', 'tf-real-estate' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'carousel_loop',
			[ 
				'label'        => esc_html__( 'Loop', 'tf-real-estate' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'tf-real-estate' ),
				'label_off'    => esc_html__( 'Off', 'tf-real-estate' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => [ 
					'carousel' => 'yes',
				],
			]
		);

		$this->add_control(
			'carousel_auto',
			[ 
				'label'        => esc_html__( 'Auto Play', 'tf-real-estate' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'tf-real-estate' ),
				'label_off'    => esc_html__( 'Off', 'tf-real-estate' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => [ 
					'carousel' => 'yes',
				],
			]
		);

		$this->add_control(
			'carousel_spacing',
			[ 
				'label'   => esc_html__( 'Spacing', 'tf-real-estate' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => '30',
			]
		);

		$this->add_control(
			'carousel_column_desk',
			[ 
				'label'     => esc_html__( 'Columns Desktop', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '4',
				'options'   => [ 
					'1' => esc_html__( '1', 'tf-real-estate' ),
					'2' => esc_html__( '2', 'tf-real-estate' ),
					'3' => esc_html__( '3', 'tf-real-estate' ),
					'4' => esc_html__( '4', 'tf-real-estate' ),
					'5' => esc_html__( '5', 'tf-real-estate' ),
				],
				'condition' => [ 
						'carousel' => 'yes',
					],
			]
		);

		$this->add_control(
			'carousel_column_laptop',
			[ 
				'label'     => esc_html__( 'Columns Small Desktop', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '3',
				'options'   => [ 
					'1' => esc_html__( '1', 'tf-real-estate' ),
					'2' => esc_html__( '2', 'tf-real-estate' ),
					'3' => esc_html__( '3', 'tf-real-estate' ),
					'4' => esc_html__( '4', 'tf-real-estate' ),
					'5' => esc_html__( '5', 'tf-real-estate' ),
				],
				'condition' => [ 
						'carousel' => 'yes',
					],
			]
		);

		$this->add_control(
			'carousel_column_tablet',
			[ 
				'label'     => esc_html__( 'Columns Tablet', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '2',
				'options'   => [ 
					'1' => esc_html__( '1', 'tf-real-estate' ),
					'2' => esc_html__( '2', 'tf-real-estate' ),
					'3' => esc_html__( '3', 'tf-real-estate' ),
				],
				'condition' => [ 
					'carousel' => 'yes',
				],
			]
		);

		$this->add_control(
			'carousel_column_mobile',
			[ 
				'label'     => esc_html__( 'Columns Mobile', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => [ 
					'1' => esc_html__( '1', 'tf-real-estate' ),
					'2' => esc_html__( '2', 'tf-real-estate' ),
				],
				'condition' => [ 
					'carousel' => 'yes',
				],
			]
		);

		$this->add_control(
			'carousel_bullets',
			[ 
				'label'        => esc_html__( 'Bullets', 'tf-real-estate' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'tf-real-estate' ),
				'label_off'    => esc_html__( 'Hide', 'tf-real-estate' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [ 
					'carousel' => 'yes',
				],
				'separator'    => 'before',
			]
		);

		$this->end_controls_section();
		// /.End Carousel	

		// Start Flex Slider        
		$this->start_controls_section(
			'section_properties_swiper',
			[ 
				'label' => esc_html__( 'Swiper Image Box', 'tf-real-estate' ),
			]
		);

		$this->add_control(
			'swiper_image_box',
			[ 
				'label'        => esc_html__( 'Swiper', 'tf-real-estate' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'tf-real-estate' ),
				'label_off'    => esc_html__( 'Off', 'tf-real-estate' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'limit_swiper_images',
			[ 
				'label'     => esc_html__( 'Limit Swiper Images', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 100,
				'step'      => 1,
				'default'   => 3,
				'condition' => [ 
					'swiper_image_box' => 'yes',
				]
			]
		);

		$this->end_controls_section();
		// /.End Flex Slider	

		// Start general Style       
		$this->start_controls_section(
			'section_style_general',
			[ 
				'label' => esc_html__( 'General', 'tf-real-estate' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_card',
			[ 
				'label'     => esc_html__( 'Card Item', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
            'disable_border_radius_card',
            [
                'label' => esc_html__( 'Disable All Border Radius', 'tf-real-estate' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tf-real-estate' ),
                'label_off' => esc_html__( 'No', 'tf-real-estate' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

		$this->add_control(
			'heading_filter',
			[ 
				'label'     => esc_html__( 'Filter', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[ 
				'name'     => 'filter_typography_title',
				'label'    => esc_html__( 'Typography Filter', 'tf-real-estate' ),
				'selector' => '{{WRAPPER}} .tf-properties-wrap .wrap-properties-post .filter-bar a',
			]
		);

		$this->add_control(
			'filter_typography_title_color',
			[ 
				'label'     => esc_html__( 'Color', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .tf-properties-wrap .wrap-properties-post .filter-bar a' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'filter_typography_title_color_hover',
			[ 
				'label'     => esc_html__( 'Color Hover & Active', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .tf-properties-wrap .wrap-properties-post .filter-bar a:hover, {{WRAPPER}} .tf-properties-wrap .wrap-properties-post .filter-bar a.active' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'filter_typography_title_bg_color',
			[ 
				'label'     => esc_html__( 'Background Color', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .tf-properties-wrap .wrap-properties-post .filter-bar a' => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'filter_typography_title_bg_color_hover',
			[ 
				'label'     => esc_html__( 'Background Color Hover & Active', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .tf-properties-wrap .wrap-properties-post .filter-bar a:hover, {{WRAPPER}} .tf-properties-wrap .wrap-properties-post .filter-bar a.active' => 'background: {{VALUE}} !important;border-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => 'filter_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'tf-real-estate' ),
				'selector' => '{{WRAPPER}} .tf-properties-wrap .wrap-properties-post .filter-bar a',
			]
		);

		$this->add_responsive_control(
			'filter_border_radius',
			[ 
				'label'      => esc_html__( 'Border Radius', 'tf-real-estate' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [ 
						'{{WRAPPER}} .tf-properties-wrap .wrap-properties-post .filter-bar a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
			]
		);

		$this->add_responsive_control(
			'filter_padding_a',
			[ 
				'label'      => esc_html__( 'Padding', 'tf-real-estate' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [ 
					'{{WRAPPER}} .tf-properties-wrap .wrap-properties-post .filter-bar a ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'filter_margin_a',
			[ 
				'label'      => esc_html__( 'Margin', 'tf-real-estate' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [ 
					'{{WRAPPER}} .tf-properties-wrap .wrap-properties-post .filter-bar a ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'filter_padding',
			[ 
				'label'      => esc_html__( 'Padding Over', 'tf-real-estate' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [ 
					'{{WRAPPER}} .tf-properties-wrap .wrap-properties-post .filter-bar ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'filter_margin',
			[ 
				'label'      => esc_html__( 'Margin Over', 'tf-real-estate' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [ 
					'{{WRAPPER}} .tf-properties-wrap .wrap-properties-post .filter-bar ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_title',
			[ 
				'label'     => esc_html__( 'Title', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[ 
				'name'     => 'button_typography_title',
				'label'    => esc_html__( 'Typography', 'tf-real-estate' ),
				'selector' => '{{WRAPPER}} .tf-properties-wrap .wrap-properties-post .item .properties-post .content .heading .title a',
			]
		);

		$this->add_control(
			'content_background_color_title',
			[ 
				'label'     => esc_html__( 'Color', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .tf-properties-wrap .properties-post .content .heading .title a' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'heading_address',
			[ 
				'label'     => esc_html__( 'Address', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[ 
				'name'     => 'button_typography_address',
				'label'    => esc_html__( 'Typography', 'tf-real-estate' ),
				'selector' => '{{WRAPPER}} .properties-post .content .heading .address span',
			]
		);

		$this->add_control(
			'content_background_color_address',
			[ 
				'label'     => esc_html__( 'Color', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .properties-post .content .heading .address span' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'heading_price',
			[ 
				'label'     => esc_html__( 'Price', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[ 
				'name'     => 'button_typography_price',
				'label'    => esc_html__( 'Typography', 'tf-real-estate' ),
				'selector' => '{{WRAPPER}} .tf-properties-wrap .properties-post .featured-property .price',
			]
		);

		$this->add_control(
			'content_background_color_price',
			[ 
				'label'     => esc_html__( 'Color', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .tf-properties-wrap .properties-post .featured-property .price' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_section();
		// /.End general Style 
	}

	protected function render( $instance = [] ) {

		$settings       = $this->get_settings_for_display();
		$has_carousel   = '';
		$taxonomy_query = array();
		if ( $settings['carousel'] == 'yes' ) {
			$has_carousel = 'has-carousel';
		}

		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		$query_args = array(
			'post_type'      => 'real-estate',
			'post_status'    => 'publish',
			'posts_per_page' => $settings['properties_per_page'],
			'paged'          => $paged
		);

		if ( ! empty( $settings['property-type'] ) ) {
			$taxonomy_query[] = array(
				'taxonomy' => 'property-type',
				'field'    => 'slug',
				'terms'    => $settings['property-type']
			);
		}
		if ( ! empty( $settings['property-status'] ) ) {
			$taxonomy_query[] = array(
				'taxonomy' => 'property-status',
				'field'    => 'slug',
				'terms'    => $settings['property-status']
			);
		}
		if ( ! empty( $settings['property-feature'] ) ) {
			$taxonomy_query[] = array(
				'taxonomy' => 'property-feature',
				'field'    => 'slug',
				'terms'    => $settings['property-feature']
			);
		}
		if ( ! empty( $settings['property-label'] ) ) {
			$taxonomy_query[] = array(
				'taxonomy' => 'property-label',
				'field'    => 'slug',
				'terms'    => $settings['property-label']
			);
		}
		if ( ! empty( $settings['province-state'] ) ) {
			$taxonomy_query[] = array(
				'taxonomy' => 'province-state',
				'field'    => 'slug',
				'terms'    => $settings['province-state']
			);
		}
		if ( ! empty( $settings['neighborhood'] ) ) {
			$taxonomy_query[] = array(
				'taxonomy' => 'neighborhood',
				'field'    => 'slug',
				'terms'    => $settings['neighborhood']
			);
		}
		if ( count( $taxonomy_query ) > 0 ) {
			$query_args['tax_query'] = array(
				'relation' => 'AND',
				$taxonomy_query
			);
		}

		if ( ! empty( $settings['exclude'] ) ) {
			if ( ! is_array( $settings['exclude'] ) )
				$exclude = explode( ',', $settings['exclude'] );

			$query_args['post__not_in'] = $exclude;
		}

		$query_args['orderby'] = $settings['order_by'];
		$query_args['order']   = $settings['order'];

		if ( $settings['sort_by_id'] != '' ) {
			$sort_by_id             = array_map( 'trim', explode( ',', $settings['sort_by_id'] ) );
			$query_args['post__in'] = $sort_by_id;
			$query_args['orderby']  = 'post__in';
		}

		$query = new WP_Query( $query_args );

		/* Taxonomy Tabs */
		$show_filter_tabs = '';
		if ( $settings['taxonomy_tabs'] == 'yes' ) {
			$show_filter_tabs = 'show_filter_tabs';
		}
		/* End Taxonomy Tabs */

		/* Style & Layout */
		$style_layout = '';
		$style_layout_column = '';
		if ( $settings['layout_style'] == 'grid' ) {
			$style_layout = $settings['style_grid'];
			$style_layout_column = $settings['layout_grid'];
		} else {
			$style_layout = $settings['style_list'];
			$style_layout_column = $settings['layout_list'];
		}

		$rtl_carousel = '';
		if( is_rtl() ){
			$rtl_carousel = 'yes';
		}

        $disable_border_radius_card = $settings['disable_border_radius_card'] == 'yes' ? 'disable-border-radius-card' : '';

		$this->add_render_attribute( 'tf_properties_wrap', [ 'id' => "tf-properties-{$this->get_id()}", 'class' => [ 'tf-properties-wrap', 'themesflat-properties-taxonomy', $style_layout, $has_carousel, $show_filter_tabs, $disable_border_radius_card ], 'data-tabid' => $this->get_id() ] );

		if ( $query->have_posts() ) : ?>
			<div <?php echo $this->get_render_attribute_string( 'tf_properties_wrap' ); ?>>
				<div class="wrap-properties-post <?php echo esc_attr( $style_layout_column ); ?>">
					<?php if ( $settings['taxonomy_tabs'] == 'yes' ) {
						$taxonomy_selected = $settings['taxonomy_list'];
						$taxonomies        = $settings[ $taxonomy_selected ];
						echo '<div class="filter-bar"> <a class="filter-properties hv-tool active" data-slug="" data-tooltip="' . esc_html__( 'All', 'tf-real-estate' ) . '">' . esc_html__( 'All', 'tf-real-estate' ) . '</a>';
						if ( is_array( $taxonomies ) ) {
							foreach ( $taxonomies as $key => $tax ) {
								$term = get_term_by( 'slug', $tax, $taxonomy_selected );
								if ( $term ) {
									$args_tab_tax             = array(
										'post_type'      => 'real-estate',
										'post_status'    => 'publish',
										'posts_per_page' => $settings['properties_per_page'],
										'tax_query'      => array(
											array(
												'taxonomy' => $taxonomy_selected,
												'field'    => 'slug',
												'terms'    => $term->slug
											)
										),
									);
									$query_properties_tab_tax = new WP_Query( $args_tab_tax );
									?>
									<a class="filter-properties hv-tool" data-slug="<?php echo esc_attr( $term->slug ) ?>"
										data-tooltip="<?php echo sprintf( esc_html( '%s ' . tfre_get_number_text( $query_properties_tab_tax->found_posts, esc_attr__( 'properties', 'tf-real-estate' ), esc_attr__( 'property', 'tf-real-estate' ) ) ), $query_properties_tab_tax->found_posts ); ?>"><?php echo esc_html( $term->name ); ?></a>
									<?php
								}
							}
						}
						echo '</div>';
					} ?>
					<div class="content-tab">
						<div class="content-tab-inner tab-inner-all">
							<div class="properties row">
								<?php if ( $settings['carousel'] == 'yes' ) : ?>
									<div class="owl-carousel" data-loop="<?php echo esc_attr( $settings['carousel_loop'] ); ?>"
										data-auto="<?php echo esc_attr( $settings['carousel_auto'] ); ?>"
										data-column="<?php echo esc_attr( $settings['carousel_column_desk'] ); ?>"
										data-column2="<?php echo esc_attr( $settings['carousel_column_tablet'] ); ?>"
										data-column3="<?php echo esc_attr( $settings['carousel_column_mobile'] ); ?>"
										data-column4="<?php echo esc_attr( $settings['carousel_column_laptop'] ); ?>"
										data-spacing="<?php echo esc_attr( $settings['carousel_spacing'] ) ?>"
										data-rtl="<?php echo esc_attr( $rtl_carousel ) ?>"
										data-bullets="<?php echo esc_attr( $settings['carousel_bullets'] ) ?>">
									<?php endif; ?>
									<?php while ( $query->have_posts() ) :
										$query->the_post(); ?>
										<?php
										$attr['settings']     = $settings;
										$attr['elementor_id'] = $this->get_id();
										tfre_get_template_widget_elementor( "templates/property/{$style_layout}", $attr );
										?>
									<?php endwhile; ?>
									<?php if ( $settings['carousel'] == 'yes' ) : ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<?php if ( $settings['taxonomy_tabs'] == 'yes' ) : ?>
							<?php $taxonomy_selected = $settings['taxonomy_list'];
							$taxonomies        = $settings[ $taxonomy_selected ];
							if ( is_array( $taxonomies ) ) {
								foreach ( $taxonomies as $key => $tax ) {
									$term = get_term_by( 'slug', $tax, $taxonomy_selected );
									if ( $term ) {
										$args_tab_tax             = array(
											'post_type'      => 'real-estate',
											'post_status'    => 'publish',
											'posts_per_page' => -1,
											'tax_query'      => array(
												array(
													'taxonomy' => $taxonomy_selected,
													'field'    => 'slug',
													'terms'    => $term->slug
												)
											),
										);
										$query_properties_tab_tax = new WP_Query( $args_tab_tax );
										?>
										<div class="content-tab-inner tab-inner-<?php echo esc_attr( $term->slug ); ?>" style="display:none">
											<div class="properties row">
												<?php if ( $settings['carousel'] == 'yes' ) : ?>
													<div class="owl-carousel" data-loop="<?php echo esc_attr( $settings['carousel_loop'] ); ?>"
														data-auto="<?php echo esc_attr( $settings['carousel_auto'] ); ?>"
														data-column="<?php echo esc_attr( $settings['carousel_column_desk'] ); ?>"
														data-column2="<?php echo esc_attr( $settings['carousel_column_tablet'] ); ?>"
														data-column3="<?php echo esc_attr( $settings['carousel_column_mobile'] ); ?>"
														data-spacing="<?php echo esc_attr( $settings['carousel_spacing'] ) ?>"
														data-rtl="<?php echo esc_attr( $rtl_carousel ) ?>"
														data-bullets="<?php echo esc_attr( $settings['carousel_bullets'] ) ?>">
													<?php endif; ?>
													<?php while ( $query_properties_tab_tax->have_posts() ) :
														$query_properties_tab_tax->the_post(); ?>
														<?php
														$attr['settings']     = $settings;
														$attr['elementor_id'] = $this->get_id();
														tfre_get_template_widget_elementor( "templates/property/{$style_layout}", $attr );

														?>
													<?php endwhile; ?>
													<?php wp_reset_postdata(); ?>
													<?php if ( $settings['carousel'] == 'yes' ) : ?>
													</div>
												<?php endif; ?>
											</div>
										</div>

								<?php }
								}
							} ?>
						<?php endif; ?>
					</div>
					<?php wp_reset_postdata(); ?>
				</div>
				<?php
				tfre_get_template_with_arguments( 'global/property-quick-view-modal-elementor.php', array( 'elementor_id' => $this->get_id() ) );
				?>
			</div>

			<?php
		else :
			esc_html_e( 'No properties found', 'tf-real-estate' );
		endif;
	}
}