<?php
class Widget_Areas extends \Elementor\Widget_Base
{
	public function get_name() {
		return 'tf_areas_list';
	}

	public function get_title() {
		return esc_html__('TF Areas List', 'tf-real-estate');
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'themesflat_real_estate_addons' ];
	}

	public function get_keywords() {
		return [ 'area', 'list' ];
	}

	public function get_style_depends() {
		return [ 'owl-carousel', 'areas-styles' ];
	}

	public function get_script_depends() {
		return [ 'owl-carousel', 'areas-script' ];
	}

	protected function register_controls() {
		// Start Posts Query        
		$this->start_controls_section(
			'section_areas_query',
			[
				'label' => esc_html__('Query', 'tf-real-estate'),
			]
		);

		$this->add_control(
			'areas_per_page',
			[
				'label'   => esc_html__('Areas Per Page', 'tf-real-estate'),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => '4',
			]
		);

		$this->add_control(
			'order_by',
			[
				'label'   => esc_html__('Order By', 'tf-real-estate'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'term_id',
				'options' => [
					'term_id' => esc_html__('ID', 'tf-real-estate'),
					'count'   => esc_html__('Count', 'tf-real-estate'),
					'name'    => esc_html__('Name', 'tf-real-estate'),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => esc_html__('Order', 'tf-real-estate'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'desc' => esc_html__('Descending', 'tf-real-estate'),
					'asc'  => esc_html__('Ascending', 'tf-real-estate'),
				],
			]
		);

		$this->add_control(
			'taxonomy',
			[
				'label'   => esc_html__('Taxonomy', 'tf-real-estate'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'province-state',
				'options' => [
					'province-state' => esc_html__('Province/State', 'tf-real-estate'),
					'neighborhood'   => esc_html__('Neighborhood', 'tf-real-estate'),
				],
			]
		);

		$this->add_control(
			'area_province_state',
			[
				'label'       => esc_html__('Province/State', 'tf-real-estate'),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'options'     => tfre_get_taxonomies('province-state'),
				'label_block' => true,
				'multiple'    => true,
				'condition'   => [
					'taxonomy' => "province-state",
				],
			]
		);

		$this->add_control(
			'area_neighborhood',
			[
				'label'       => esc_html__('Neighborhood', 'tf-real-estate'),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'options'     => tfre_get_taxonomies('neighborhood'),
				'label_block' => true,
				'multiple'    => true,
				'condition'   => [
					'taxonomy' => "neighborhood",
				],
			]
		);

		$this->add_control(
			'exclude',
			[
				'label'       => esc_html__('Exclude', 'tf-real-estate'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Post Ids Will Be Inorged. Ex: 1,2,3', 'tf-real-estate'),
				'default'     => '',
				'label_block' => true,
			]
		);

		$this->add_control(
			'sort_by_id',
			[
				'label'       => esc_html__('Sort By ID', 'tf-real-estate'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Post Ids Will Be Sort. Ex: 1,2,3', 'tf-real-estate'),
				'default'     => '',
				'label_block' => true,
			]
		);

		$this->add_control(
			'show_count_listing',
			[
				'label'        => esc_html__('Show Count Listing', 'tf-real-estate'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'tf-real-estate'),
				'label_off'    => esc_html__('Hide', 'tf-real-estate'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_link_listing',
			[
				'label'        => esc_html__('Show View All Listing', 'tf-real-estate'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'tf-real-estate'),
				'label_off'    => esc_html__('Hide', 'tf-real-estate'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__('Columns', 'tf-real-estate'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'column-4',
				'options' => [
					'column-1' => esc_html__('1', 'tf-real-estate'),
					'column-2' => esc_html__('2', 'tf-real-estate'),
					'column-3' => esc_html__('3', 'tf-real-estate'),
					'column-4' => esc_html__('4', 'tf-real-estate'),
				],
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__('Styles', 'tf-real-estate'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => esc_html__('Style 1', 'tf-real-estate'),
					'style2' => esc_html__('Style 2', 'tf-real-estate'),
					'style3' => esc_html__('Style 3', 'tf-real-estate'),
					'style4' => esc_html__('Style 4', 'tf-real-estate'),
				],
			]
		);

		$this->add_control(
            'style_masonry',
            [
                'label' => esc_html__( 'Enable Style Masonry', 'tf-real-estate' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tf-real-estate' ),
                'label_off' => esc_html__( 'No', 'tf-real-estate' ),
                'return_value' => 'yes',
                'default' => 'no',
				'condition' => [
					'style' => 'style1',
				],
            ]
        );

		$this->add_control(
			'item_masonry',
			[
				'label'   => esc_html__('Layout Masonry With Areas Per Page', 'tf-real-estate'),
				'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'masonry6',
				'options' => [
					'masonry6' => esc_html__('6 Post', 'tf-real-estate'),
					'masonry8' => esc_html__('8 Post', 'tf-real-estate'),
				],
				'condition' => [
					'style' => 'style1',
					'style_masonry' => 'yes',
				],
			]
		);

		$this->end_controls_section();
		// /.End Posts Query

		// Start Carousel        
		$this->start_controls_section(
			'section_areas_carousel',
			[
				'label' => esc_html__('Carousel', 'tf-real-estate'),
				'condition'   => [
					'style_masonry!' => 'yes',
				],
			]
		);

		$this->add_control(
			'carousel',
			[
				'label'        => esc_html__('Carousel', 'tf-real-estate'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('On', 'tf-real-estate'),
				'label_off'    => esc_html__('Off', 'tf-real-estate'),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'carousel_loop',
			[
				'label'        => esc_html__('Loop', 'tf-real-estate'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('On', 'tf-real-estate'),
				'label_off'    => esc_html__('Off', 'tf-real-estate'),
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
				'label'        => esc_html__('Auto Play', 'tf-real-estate'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('On', 'tf-real-estate'),
				'label_off'    => esc_html__('Off', 'tf-real-estate'),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => [
					'carousel' => 'yes',
				],
			]
		);

		$this->add_control(
			'carousel_column_desk',
			[
				'label'     => esc_html__('Columns Desktop', 'tf-real-estate'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '3',
				'options'   => [
					'1' => esc_html__('1', 'tf-real-estate'),
					'2' => esc_html__('2', 'tf-real-estate'),
					'3' => esc_html__('3', 'tf-real-estate'),
					'4' => esc_html__('4', 'tf-real-estate'),
					'5' => esc_html__('5', 'tf-real-estate'),
					'6' => esc_html__('6', 'tf-real-estate'),
					'7' => esc_html__('7', 'tf-real-estate'),
					'8' => esc_html__('8', 'tf-real-estate'),
				],
				'condition' => [
					'carousel' => 'yes',
				],
			]
		);

		$this->add_control(
			'carousel_column_laptop',
			[
				'label'     => esc_html__('Columns Laptop', 'tf-real-estate'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '3',
				'options'   => [
					'1' => esc_html__('1', 'tf-real-estate'),
					'2' => esc_html__('2', 'tf-real-estate'),
					'3' => esc_html__('3', 'tf-real-estate'),
					'4' => esc_html__('4', 'tf-real-estate'),
					'5' => esc_html__('5', 'tf-real-estate'),
					'6' => esc_html__('6', 'tf-real-estate'),
					'7' => esc_html__('7', 'tf-real-estate'),
					'8' => esc_html__('8', 'tf-real-estate'),
				],
				'condition' => [
					'carousel' => 'yes',
				],
			]
		);

		$this->add_control(
			'carousel_column_tablet',
			[
				'label'     => esc_html__('Columns Tablet', 'tf-real-estate'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '2',
				'options'   => [
					'1' => esc_html__('1', 'tf-real-estate'),
					'2' => esc_html__('2', 'tf-real-estate'),
					'3' => esc_html__('3', 'tf-real-estate'),
					'4' => esc_html__('4', 'tf-real-estate'),
				],
				'condition' => [
					'carousel' => 'yes',
				],
			]
		);

		$this->add_control(
			'carousel_column_mobile',
			[
				'label'     => esc_html__('Columns Mobile', 'tf-real-estate'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => [
					'1' => esc_html__('1', 'tf-real-estate'),
					'2' => esc_html__('2', 'tf-real-estate'),
				],
				'condition' => [
					'carousel' => 'yes',
				],
			]
		);

		$this->add_control(
			'carousel_spacing',
			[
				'label'   => esc_html__('Spacing', 'tf-real-estate'),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => '30',
			]
		);

		$this->add_control(
			'carousel_arrow',
			[
				'label'        => esc_html__('Arrow', 'tf-real-estate'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'tf-real-estate'),
				'label_off'    => esc_html__('Hide', 'tf-real-estate'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'carousel' => 'yes',
				],
				'description'  => 'Just show when you have two slide',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'carousel_bullets',
			[
				'label'        => esc_html__('Bullets', 'tf-real-estate'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'tf-real-estate'),
				'label_off'    => esc_html__('Hide', 'tf-real-estate'),
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

		// Start general Style       
		$this->start_controls_section(
			'section_style_general',
			[
				'label' => esc_html__('General', 'tf-real-estate'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
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

		$this->add_responsive_control(
			'general_column_gap',
			[ 
				'label'          => esc_html__( 'Column Gap', 'tf-real-estate' ),
				'type'           => \Elementor\Controls_Manager::SLIDER,
				'size_units'     => [ 'px'],
				'range'          => [ 
					'px' => [ 
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'      => [ 
					'{{WRAPPER}} .tf-area-wrap .wrap-area-post .item ' => 'padding-left: {{SIZE}}{{UNIT}};padding-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'general_row_gap',
			[ 
				'label'          => esc_html__( 'Rows Gap', 'tf-real-estate' ),
				'type'           => \Elementor\Controls_Manager::SLIDER,
				'size_units'     => [ 'px'],
				'range'          => [ 
					'px' => [ 
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'      => [ 
					'{{WRAPPER}} .tf-area-wrap .wrap-area-post .item ' => 'padding-top: {{SIZE}}{{UNIT}};padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control( 
			'heading_images',
			[
				'label' => esc_html__( 'Images', 'tf-real-estate' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label' => esc_html__( 'Height', 'tf-real-estate' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => [ 'px', 'vh' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tf-area-wrap .wrap-area-post .featured-post .image-area' => 'height: {{SIZE}}{{UNIT}} !important; width: 100%;',
				],
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label'     => esc_html__('Title', 'tf-real-estate'),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'typography_title',
				'label'    => esc_html__('Typography', 'tf-real-estate'),
				'selector' => '{{WRAPPER}} .tf-area-wrap .wrap-area-post .item .area-post .featured-post .content .info .name',
			]
		);

		$this->add_control(
			'color_title',
			[
				'label'     => esc_html__('Color', 'tf-real-estate'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-area-wrap .wrap-area-post .item .area-post .featured-post .content .info .name a' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'color_title_hover',
			[
				'label'     => esc_html__('Color Hover', 'tf-real-estate'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-area-wrap .wrap-area-post .item .area-post .featured-post .content .info .name a:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'heading_title_count_listing',
			[
				'label'     => esc_html__('Count Listing', 'tf-real-estate'),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'typography_count_listing',
				'label'    => esc_html__('Typography', 'tf-real-estate'),
				'selector' => '{{WRAPPER}} .tf-area-wrap .wrap-area-post .item .area-post .featured-post .content .info .count-listing',
			]
		);

		$this->add_control(
			'background_color_count_listing',
			[
				'label'     => esc_html__('Color', 'tf-real-estate'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-area-wrap .wrap-area-post .item .area-post .featured-post .content .info .count-listing' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'heading_title_link_listing',
			[
				'label'     => esc_html__('Link Listing', 'tf-real-estate'),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'typography_link_listing',
				'label'    => esc_html__('Typography', 'tf-real-estate'),
				'selector' => '{{WRAPPER}} .tf-area-wrap .wrap-area-post .item .area-post .featured-post .content .link-listing span',
			]
		);

		$this->add_control(
			'background_color_link_listing',
			[
				'label'     => esc_html__('Color', 'tf-real-estate'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-area-wrap .wrap-area-post .item .area-post .featured-post .content a.link-listing' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'color_hover_link_listing',
			[
				'label'     => esc_html__('Color Hover', 'tf-real-estate'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-area-wrap .wrap-area-post .item .area-post .featured-post .content .link-listing:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_section();
		// /.End general Style 
	}

	protected function render($instance = []) {
		$settings = $this->get_settings_for_display();

		$has_carousel = '';
		if ($settings['carousel'] == 'yes') {
			$has_carousel = 'has-carousel';
		}

		$style_masonry = '';
		if ($settings['style_masonry'] == 'yes') {
			$style_masonry = 'style-masonry';
		}

        $disable_border_radius_card = $settings['disable_border_radius_card'] == 'yes' ? 'disable-border-radius-card' : '';

		$this->add_render_attribute('tf_area_wrap', [ 'id' => "tf-area-{$this->get_id()}", 'class' => [ 'tf-area-wrap', 'tf-area-taxonomy', $settings['style'], $has_carousel, $style_masonry, $settings['item_masonry'], $disable_border_radius_card ], 'data-tabid' => $this->get_id() ]);

		$query_args = array(
			'taxonomy'   => $settings['taxonomy'],
			'number'     => $settings['areas_per_page'],
			'hide_empty' => false,
			'count'      => true,
		);

		if (!empty($settings['area_province_state'])) {
			$query_args['slug'] = $settings['area_province_state'];
		}

		if (!empty($settings['area_neighborhood'])) {
			$query_args['slug'] = $settings['area_neighborhood'];
		}

		if (!empty($settings['exclude'])) {
			if (!is_array($settings['exclude']))
				$exclude = explode(',', $settings['exclude']);

			$query_args['exclude'] = $exclude;
		}

		$query_args['orderby'] = $settings['order_by'];
		$query_args['order']   = $settings['order'];

		if ($settings['sort_by_id'] != '') {
			$sort_by_id            = array_map('trim', explode(',', $settings['sort_by_id']));
			$query_args['include'] = $sort_by_id;
			$query_args['orderby'] = 'include';
			$query_args['order']   = 'ASC';
		}

		$rtl_carousel = '';
		if( is_rtl() ){
			$rtl_carousel = 'yes';
		}

		$taxonomies = get_terms($query_args);
		if (!empty($taxonomies) && !is_wp_error($taxonomies)): ?>
			<div <?php echo $this->get_render_attribute_string('tf_area_wrap'); ?>>
				<div class="wrap-area-post row <?php echo esc_attr($settings['layout']); ?> ">

					<?php if ($settings['carousel'] == 'yes'): ?>
						<div class="owl-carousel" data-loop="<?php echo esc_attr($settings['carousel_loop']); ?>"
							data-auto="<?php echo esc_attr($settings['carousel_auto']); ?>"
							data-column="<?php echo esc_attr($settings['carousel_column_desk']); ?>"
							data-column1="<?php echo esc_attr($settings['carousel_column_laptop']); ?>"
							data-column2="<?php echo esc_attr($settings['carousel_column_tablet']); ?>"
							data-column3="<?php echo esc_attr($settings['carousel_column_mobile']); ?>"
							data-prev_icon="fas fa-arrow-left" data-next_icon="fas fa-arrow-right"
							data-arrow="<?php echo esc_attr($settings['carousel_arrow']) ?>"
							data-spacing="<?php echo esc_attr($settings['carousel_spacing']) ?>"
							data-rtl="<?php echo esc_attr( $rtl_carousel ) ?>"
							data-bullets="<?php echo esc_attr($settings['carousel_bullets']) ?>">
						<?php endif; ?>

						<?php foreach ($taxonomies as $index => $taxonomy): {
							# code...
						} ?>
							<?php
							$attr['settings'] = $settings;
							$attr['taxonomy'] = $taxonomy;
							$attr['index']    = $index;
							tfre_get_template_widget_elementor("templates/area/{$settings['style']}", $attr);
							?>
						<?php endforeach; ?>

						<?php if ($settings['carousel'] == 'yes'): ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<?php
		else:
			esc_html_e('No areas found', 'tf-real-estate');
		endif;
	}
}