<?php
class Widget_Property_Type extends \Elementor\Widget_Base {
	public function get_name() {
		return 'tf_property_type';
	}

	public function get_title() {
		return esc_html__( 'TF Property Type', 'tf-real-estate' );
	}

	public function get_categories() {
		return [ 'themesflat_real_estate_addons' ];
	}

	public function get_style_depends() {
		return [ 'owl-carousel', 'taxonomy-styles' ];
	}

	public function get_script_depends() {
		return [ 'owl-carousel', 'taxonomy-script' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_taxonomy_settings',
			[ 
				'label' => esc_html__( 'Settings', 'tf-real-estate' ),
			]
		);

		$this->add_control(
			'item_per_page',
			[ 
				'label'   => esc_html__( 'Items Per Page', 'tf-real-estate' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => '4',
			]
		);

		$this->add_control(
			'style',
			[ 
				'label'   => esc_html__( 'Styles', 'tf-real-estate' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [ 
					'style1' => esc_html__( 'Style 1', 'tf-real-estate' ),
					'style2' => esc_html__( 'Style 2', 'tf-real-estate' ),
				],
			]
		);

		$this->add_control(
			'order_by',
			[ 
				'label'   => esc_html__( 'Order By', 'tf-real-estate' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'term_id',
				'options' => [ 
					'term_id' => esc_html__( 'ID', 'tf-real-estate' ),
					'name'    => esc_html__( 'Name', 'tf-real-estate' ),
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
			'exclude',
			[ 
				'label'       => esc_html__( 'Exclude', 'tf-real-estate' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Post Ids Will Be Ignored. Ex: 1,2,3', 'tf-real-estate' ),
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
			'show_count_property',
			[ 
				'label'        => esc_html__( 'Show Count Property', 'tf-real-estate' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'tf-real-estate' ),
				'label_off'    => esc_html__( 'Hide', 'tf-real-estate' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [ 
					'style!' => 'style2',
				],
			]
		);

		$this->add_control(
			'layout',
			[ 
				'label'   => esc_html__( 'Columns', 'tf-real-estate' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'column-4',
				'options' => [ 
					'column-1' => esc_html__( '1', 'tf-real-estate' ),
					'column-2' => esc_html__( '2', 'tf-real-estate' ),
					'column-3' => esc_html__( '3', 'tf-real-estate' ),
					'column-4' => esc_html__( '4', 'tf-real-estate' ),
					'column-5' => esc_html__( '5', 'tf-real-estate' ),
					'column-6' => esc_html__( '6', 'tf-real-estate' ),
				],
			]
		);

		$this->add_control(
			'layout_tablet',
			[ 
				'label'   => esc_html__( 'Columns Tablet', 'tf-real-estate' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'column-tablet-3',
				'options' => [ 
					'column-tablet-1' => esc_html__( '1', 'tf-real-estate' ),
					'column-tablet-2' => esc_html__( '2', 'tf-real-estate' ),
					'column-tablet-3' => esc_html__( '3', 'tf-real-estate' ),
					'column-tablet-4' => esc_html__( '4', 'tf-real-estate' ),
				],
			]
		);

		$this->add_control(
			'layout_mobile',
			[ 
				'label'   => esc_html__( 'Columns Mobile', 'tf-real-estate' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'column-mobile-1',
				'options' => [ 
					'column-mobile-1' => esc_html__( '1', 'tf-real-estate' ),
					'column-mobile-2' => esc_html__( '2', 'tf-real-estate' ),
					'column-mobile-3' => esc_html__( '3', 'tf-real-estate' ),
					'column-mobile-4' => esc_html__( '4', 'tf-real-estate' )
				],
			]
		);
		$this->end_controls_section();

		// Start Carousel        
		$this->start_controls_section(
			'section_areas_carousel',
			[ 
				'label'     => esc_html__( 'Carousel', 'tf-real-estate' ),
				'condition' => [ 
					'style!' => 'style2',
				],
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
			'arrow',
			[ 
				'label'        => esc_html__( 'Arrows', 'tf-real-estate' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'tf-real-estate' ),
				'label_off'    => esc_html__( 'Off', 'tf-real-estate' ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_control(
			'bullets',
			[ 
				'label'        => esc_html__( 'Bullets', 'tf-real-estate' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'tf-real-estate' ),
				'label_off'    => esc_html__( 'Off', 'tf-real-estate' ),
				'return_value' => 'yes',
				'default'      => 'no'
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
					'6' => esc_html__( '6', 'tf-real-estate' ),
					'7' => esc_html__( '7', 'tf-real-estate' ),
					'8' => esc_html__( '8', 'tf-real-estate' ),
				],
				'condition' => [ 
					'carousel' => 'yes',
				],
			]
		);

		$this->add_control(
			'carousel_column_laptop',
			[ 
				'label'     => esc_html__( 'Columns Laptop', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '3',
				'options'   => [ 
					'1' => esc_html__( '1', 'tf-real-estate' ),
					'2' => esc_html__( '2', 'tf-real-estate' ),
					'3' => esc_html__( '3', 'tf-real-estate' ),
					'4' => esc_html__( '4', 'tf-real-estate' ),
					'5' => esc_html__( '5', 'tf-real-estate' ),
					'6' => esc_html__( '6', 'tf-real-estate' ),
					'7' => esc_html__( '7', 'tf-real-estate' ),
					'8' => esc_html__( '8', 'tf-real-estate' ),
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
					'4' => esc_html__( '4', 'tf-real-estate' ),
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
			'carousel_spacing',
			[ 
				'label'   => esc_html__( 'Spacing', 'tf-real-estate' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => '30',
			]
		);
		$this->end_controls_section();
		// /.End Carousel	

		$this->start_controls_section(
			'style_section',
			[ 
				'label' => esc_html__( 'General', 'tf-real-estate' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'general_margin',
			[ 
				'label'      => esc_html__( 'Margin', 'tf-real-estate' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors'  => [ 
					'{{WRAPPER}} .tf-taxonomy-wrap.tf-taxonomy .item, {{WRAPPER}} .tf-taxonomy-wrap .tf-taxonomy-inner .item .taxonomy-post .box-card .box-card-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'general_padding',
			[ 
				'label'      => esc_html__( 'Padding', 'tf-real-estate' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors'  => [ 
					'{{WRAPPER}} .tf-taxonomy-wrap.tf-taxonomy .item .taxonomy-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'general_border_radius',
			[ 
				'label'      => esc_html__( 'Border Radius', 'tf-real-estate' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [ 
						'{{WRAPPER}} .tf-taxonomy-wrap .tf-taxonomy-inner .item .taxonomy-post .box-card .box-card-inner, {{WRAPPER}} .tf-taxonomy-wrap .tf-taxonomy-inner .item .taxonomy-post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
			]
		);
		$this->add_responsive_control(
			'general_gap',
			[ 
				'label'          => esc_html__( 'Gap', 'tf-real-estate' ),
				'type'           => \Elementor\Controls_Manager::SLIDER,
				'size_units'     => [ 'px'],
				'range'          => [ 
					'px' => [ 
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'      => [ 
					'{{WRAPPER}} .tf-taxonomy-wrap .tf-taxonomy-inner .item ' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[ 
				'label' => esc_html__( 'Normal', 'tf-real-estate' ),
			]
		);

		$this->add_control(
			'border_color_normal',
			[ 
				'label'     => esc_html__( 'Border Color', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .tf-taxonomy .item .taxonomy-post, {{WRAPPER}} .tf-taxonomy-wrap .tf-taxonomy-inner .item .taxonomy-post .box-card .box-card-inner ' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'bg_color_normal',
			[ 
				'label'     => esc_html__( 'Background Color', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .tf-taxonomy .item .taxonomy-post' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'text_color_normal',
			[ 
				'label'     => esc_html__( 'Color', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .tf-taxonomy .item .taxonomy-post h3.name a,{{WRAPPER}} .tf-taxonomy .item .taxonomy-post .count-property, {{WRAPPER}} .tf-taxonomy-wrap .tf-taxonomy-inner .item .taxonomy-post .box-card .box-card-inner .content .name a ' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[ 
				'label' => esc_html__( 'Hover', 'tf-real-estate' ),
			]
		);

		$this->add_control(
			'text_color_hover',
			[ 
				'label'     => esc_html__( 'Color Hover', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .tf-taxonomy-wrap .tf-taxonomy-inner .item .taxonomy-post .box-card .box-card-inner .content .name a:hover, {{WRAPPER}} .tf-taxonomy-wrap.style1 .item .taxonomy-post .content h3 a:hover ' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {
		$settings     = $this->get_settings_for_display();
		$has_carousel = ( $settings['carousel'] == 'yes' ) ? 'has-carousel' : '';
		$css_class    = 'tf-taxonomy-property-type ';
		if ( ! empty( $settings['layout_tablet'] ) ) {
			$css_class .= $settings['layout_tablet'] . ' ';
		}

		if ( ! empty( $settings['layout_mobile'] ) ) {
			$css_class .= $settings['layout_mobile'];
		}

		$this->add_render_attribute( 'tf_taxonomy_wrap', [ 'id' => "tf-taxonomy-{$this->get_id()}", 'class' => [ 'tf-taxonomy-wrap', 'tf-taxonomy', $css_class, $settings['style'], $has_carousel ], 'data-tabid' => $this->get_id() ] );

		$query_args = array(
			'taxonomy'   => 'property-type',
			'number'     => $settings['item_per_page'],
			'hide_empty' => false,
			'count'      => true,
		);

		$query_args['orderby'] = $settings['order_by'];
		$query_args['order']   = $settings['order'];

		if ( ! empty( $settings['exclude'] ) ) {
			if ( ! is_array( $settings['exclude'] ) ) {
				$exclude = explode( ',', $settings['exclude'] );
			}
			$query_args['exclude'] = $exclude;
		}

		if ( ! empty( $settings['sort_by_id'] ) ) {
			$sort_by_id            = array_map( 'trim', explode( ',', $settings['sort_by_id'] ) );
			$query_args['include'] = $sort_by_id;
			$query_args['orderby'] = 'include';
			$query_args['order']   = 'ASC';
		}

		$rtl_carousel = '';
		if( is_rtl() ){
			$rtl_carousel = 'yes';
		}

		$taxonomies = get_terms( $query_args );
		if ( ! empty( $taxonomies ) && ! is_wp_error( $taxonomies ) ) {
			?>
			<div <?php echo $this->get_render_attribute_string( 'tf_taxonomy_wrap' ); ?>>
				<div class="tf-taxonomy-inner row <?php echo esc_attr( $settings['layout'] ); ?>">
					<?php if ( $settings['carousel'] == 'yes' ) : ?>
						<div class="owl-carousel"
							data-column="<?php echo esc_attr( isset( $settings['carousel_column_desk'] ) ? $settings['carousel_column_desk'] : ' ' ); ?>"
							data-column1="<?php echo esc_attr( isset( $settings['carousel_column_laptop'] ) ? $settings['carousel_column_laptop'] : ' ' ); ?>"
							data-column2="<?php echo esc_attr( isset( $settings['carousel_column_tablet'] ) ? $settings['carousel_column_tablet'] : ' ' ); ?>"
							data-column3="<?php echo esc_attr( isset( $settings['carousel_column_mobile'] ) ? $settings['carousel_column_mobile'] : ' ' ); ?>"
							data-prev_icon="fas fa-arrow-left" data-next_icon="fas fa-arrow-right"
							data-arrow="<?php echo esc_attr($settings['arrow']); ?>"
							data-spacing="<?php echo esc_attr( isset( $settings['carousel_spacing'] ) ? $settings['carousel_spacing'] : '' ); ?>"
                            data-bullets="<?php echo esc_attr($settings['bullets']); ?>" data-rtl="<?php echo esc_attr($rtl_carousel) ?>">
						<?php endif; ?>
						<?php foreach ( $taxonomies as $taxonomy ) : ?>
							<?php $attr['settings'] = $settings;
							$attr['taxonomy'] = $taxonomy;
							tfre_get_template_widget_elementor( "templates/property-type/{$settings['style']}", $attr ); ?>
						<?php endforeach; ?>
						<?php if ( $settings['carousel'] == 'yes' ) : ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<?php
		} else {
			esc_html_e( 'No item found', 'tf-real-estate' );
		}
	}
}