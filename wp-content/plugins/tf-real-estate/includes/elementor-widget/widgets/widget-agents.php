<?php
class Widget_Agents extends \Elementor\Widget_Base {
    public function get_name() {
        return 'tf_agents_list';
    }
    
    public function get_title() {
        return esc_html__( 'TF Agents List', 'tf-real-estate' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }
    
    public function get_categories() {
        return [ 'themesflat_real_estate_addons' ];
    }

    public function get_keywords()
	{
		return [ 'agent', 'list' ];
	}

	public function get_style_depends(){
		return ['owl-carousel', 'agents-styles'];
	}

	public function get_script_depends() {
		return ['owl-carousel', 'agents-script'];
	}

	protected function register_controls() {
        // Start Posts Query        
			$this->start_controls_section( 
				'section_agents_query',
	            [
	                'label' => esc_html__('Query', 'tf-real-estate'),
	            ]
	        );

	        $this->add_control( 
					'agents_per_page',
		            [
		                'label' => esc_html__( 'Agents Per Page', 'tf-real-estate' ),
		                'type' => \Elementor\Controls_Manager::NUMBER,
		                'default' => '3',
		            ]
		        );

		        $this->add_control( 
		        	'order_by',
					[
						'label' => esc_html__( 'Order By', 'tf-real-estate' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'date',
						'options' => [						
				            'date' => esc_html__( 'Date', 'tf-real-estate' ),
				            'ID' => esc_html__( 'Post ID', 'tf-real-estate' ),			            
				            'title' => esc_html__( 'Title', 'tf-real-estate' ),
						],
					]
				);

				$this->add_control( 
					'order',
					[
						'label' => esc_html__( 'Order', 'tf-real-estate' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'desc',
						'options' => [						
				            'desc' => esc_html__('Descending', 'tf-real-estate'),
							'asc'  => esc_html__('Ascending', 'tf-real-estate'),
						],
					]
				);

				$this->add_control( 
					'agent_agencies',
					[
						'label' => esc_html__( 'Agencies', 'tf-real-estate' ),
						'type' => \Elementor\Controls_Manager::SELECT2,
						'options' => tfre_get_taxonomies('agencies'),
						'label_block' => true,
		                'multiple' => true,
					]
				);

				$this->add_control( 
					'exclude',
					[
						'label' => esc_html__( 'Exclude', 'tf-real-estate' ),
						'type'	=> \Elementor\Controls_Manager::TEXT,	
						'description' => esc_html__( 'Post Ids Will Be Inorged. Ex: 1,2,3', 'tf-real-estate' ),
						'default' => '',
						'label_block' => true,				
					]
				);

				$this->add_control( 
					'sort_by_id',
					[
						'label' => esc_html__( 'Sort By ID', 'tf-real-estate' ),
						'type'	=> \Elementor\Controls_Manager::TEXT,	
						'description' => esc_html__( 'Post Ids Will Be Sort. Ex: 1,2,3', 'tf-real-estate' ),
						'default' => '',
						'label_block' => true,				
					]
				);

				$this->add_control(
					'show_position',
					[
						'label' => esc_html__( 'Show Position', 'tf-real-estate' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_on' => esc_html__( 'Show', 'tf-real-estate' ),
						'label_off' => esc_html__( 'Hide', 'tf-real-estate' ),
						'return_value' => 'yes',
						'default' => 'yes',
					]
				);

				$this->add_control(
					'show_contact',
					[
						'label' => esc_html__( 'Show Contact', 'tf-real-estate' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_on' => esc_html__( 'Show', 'tf-real-estate' ),
						'label_off' => esc_html__( 'Hide', 'tf-real-estate' ),
						'return_value' => 'yes',
						'default' => 'yes',
					]
				);

				$this->add_control(
					'show_button',
					[
						'label' => esc_html__( 'Show Button', 'tf-real-estate' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_on' => esc_html__( 'Show', 'tf-real-estate' ),
						'label_off' => esc_html__( 'Hide', 'tf-real-estate' ),
						'return_value' => 'yes',
						'default' => 'no',
					]
				);

				$this->add_control( 
					'button_text',
					[
						'label' => esc_html__( 'Button Text', 'tf-real-estate' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Contact seller', 'tf-real-estate' ),
						'condition' => [
							'show_button'	=> 'yes',
						],
					]
				);

				$this->add_control(
					'show_social',
					[
						'label' => esc_html__( 'Show Social', 'tf-real-estate' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_on' => esc_html__( 'Show', 'tf-real-estate' ),
						'label_off' => esc_html__( 'Hide', 'tf-real-estate' ),
						'return_value' => 'yes',
						'default' => 'yes',
					]
				);

				$this->add_group_control( 
					\Elementor\Group_Control_Image_Size::get_type(),
					[
						'name' => 'thumbnail',
						'default' => 'themesflat-agent-image',
					]
				);

				$this->add_control( 
		        	'layout',
					[
						'label' => esc_html__( 'Columns', 'tf-real-estate' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'column-3',
						'options' => [
							'column-1' => esc_html__( '1', 'tf-real-estate' ),
							'column-2' => esc_html__( '2', 'tf-real-estate' ),
							'column-3' => esc_html__( '3', 'tf-real-estate' ),
							'column-4' => esc_html__( '4', 'tf-real-estate' ),
						],
					]
				);	

				$this->add_control( 
		        	'style',
					[
						'label' => esc_html__( 'Styles', 'tf-real-estate' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'style1',
						'options' => [
							'style1' => esc_html__( 'Style 1', 'tf-real-estate' ),
							'style2' => esc_html__( 'Style 2', 'tf-real-estate' ),
							'style3' => esc_html__( 'Style 3', 'tf-real-estate' ),
							'style4' => esc_html__( 'Style 4', 'tf-real-estate' ),
						],
					]
				);

				$this->add_control(
					'disable_border_radius',
					[
						'label' => esc_html__( 'Disable All Border Radius', 'tf-real-estate' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_on' => esc_html__( 'Yes', 'tf-real-estate' ),
						'label_off' => esc_html__( 'No', 'tf-real-estate' ),
						'return_value' => 'yes',
						'default' => 'no',
					]
				);
			
			$this->end_controls_section();
        // /.End Posts Query

		// Start Carousel        
			$this->start_controls_section( 
				'section_agents_carousel',
	            [
	                'label' => esc_html__('Carousel', 'tf-real-estate'),
	            ]
	        );	

	        $this->add_control( 
				'carousel',
				[
					'label' => esc_html__( 'Carousel', 'tf-real-estate' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'On', 'tf-real-estate' ),
					'label_off' => esc_html__( 'Off', 'tf-real-estate' ),
					'return_value' => 'yes',
					'default' => 'no',
				]
			);        

			$this->add_control( 
				'carousel_loop',
				[
					'label' => esc_html__( 'Loop', 'tf-real-estate' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'On', 'tf-real-estate' ),
					'label_off' => esc_html__( 'Off', 'tf-real-estate' ),
					'return_value' => 'yes',
					'default' => 'no',
					'condition' => [
						'carousel' => 'yes',
					],
				]
			);

			$this->add_control( 
				'carousel_auto',
				[
					'label' => esc_html__( 'Auto Play', 'tf-real-estate' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'On', 'tf-real-estate' ),
					'label_off' => esc_html__( 'Off', 'tf-real-estate' ),
					'return_value' => 'yes',
					'default' => 'no',
					'condition' => [
						'carousel' => 'yes',
					],
				]
			);

			$this->add_control( 
	        	'carousel_column_desk',
				[
					'label' => esc_html__( 'Columns Desktop', 'tf-real-estate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '3',
					'options' => [
						'1' => esc_html__( '1', 'tf-real-estate' ),
						'2' => esc_html__( '2', 'tf-real-estate' ),
						'3' => esc_html__( '3', 'tf-real-estate' ),
						'4' => esc_html__( '4', 'tf-real-estate' ),
						'5' => esc_html__( '5', 'tf-real-estate' ),
						'6' => esc_html__( '6', 'tf-real-estate' ),
					],
					'condition' => [
						'carousel' => 'yes',
					],
				]
			);

			$this->add_control( 
	        	'carousel_column_tablet',
				[
					'label' => esc_html__( 'Columns Tablet', 'tf-real-estate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '2',
					'options' => [
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
					'label' => esc_html__( 'Columns Mobile', 'tf-real-estate' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '1',
					'options' => [
						'1' => esc_html__( '1', 'tf-real-estate' ),
						'2' => esc_html__( '2', 'tf-real-estate' ),
					],
					'condition' => [
						'carousel' => 'yes',
					],
				]
			);	

			$this->add_control( 
				'carousel_arrow',
				[
					'label' => esc_html__( 'Arrow', 'tf-real-estate' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'tf-real-estate' ),
					'label_off' => esc_html__( 'Hide', 'tf-real-estate' ),
					'return_value' => 'yes',
					'default' => 'yes',
					'condition' => [
						'carousel' => 'yes',
					],
					'description'	=> 'Just show when you have two slide',
					'separator' => 'before',
				]
			);

			$this->add_control( 
				'carousel_bullets',
	            [
	                'label'         => esc_html__( 'Bullets', 'tf-real-estate' ),
	                'type'          => \Elementor\Controls_Manager::SWITCHER,
	                'label_on'      => esc_html__( 'Show', 'tf-real-estate' ),
	                'label_off'     => esc_html__( 'Hide', 'tf-real-estate' ),
	                'return_value'  => 'yes',
	                'default'       => 'yes',
	                'condition' => [
						'carousel' => 'yes',
	                ],
	                'separator' => 'before',
	            ]
	        );	

			$this->add_responsive_control(
				'w_size_carousel_bullets',
				[
					'label'      => esc_html__('Width', 'tf-real-estate'),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						]
					],
					'default'    => [
						'unit' => 'px',
						'size' => 50,
					],
					'selectors'  => [
						'{{WRAPPER}} .tf-agent-wrap .owl-dots .owl-dot' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition'  => [
						'carousel'         => 'yes',
						'carousel_bullets' => 'yes',
					]
				]
			);
	
			$this->add_responsive_control(
				'h_size_carousel_bullets',
				[
					'label'      => esc_html__('Height', 'tf-real-estate'),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						]
					],
					'default'    => [
						'unit' => 'px',
						'size' => 4,
					],
					'selectors'  => [
						'{{WRAPPER}} .tf-agent-wrap .owl-dots .owl-dot' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
					],
					'condition'  => [
						'carousel'         => 'yes',
						'carousel_bullets' => 'yes',
					]
				]
			);
	
			$this->add_responsive_control(
				'carousel_bullets_horizontal_position',
				[
					'label'      => esc_html__('Horizonta Offset', 'tf-real-estate'),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 2000,
							'step' => 1,
						],
						'%'  => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default'    => [
						'unit' => '%',
						'size' => 45,
					],
					'selectors'  => [
						'{{WRAPPER}} .tf-agent-wrap .owl-dots' => 'left: {{SIZE}}{{UNIT}};',
					],
					'condition'  => [
						'carousel'         => 'yes',
						'carousel_bullets' => 'yes',
					]
				]
			);
	
			$this->add_responsive_control(
				'carousel_bullets_vertical_position',
				[
					'label'      => esc_html__('Vertical Offset', 'tf-real-estate'),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => -200,
							'max'  => 1000,
							'step' => 1,
						],
						'%'  => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default'    => [
						'unit' => '%',
						'size' => -10,
					],
					'selectors'  => [
						'{{WRAPPER}} .tf-agent-wrap .owl-dots' => 'bottom: {{SIZE}}{{UNIT}};',
					],
					'condition'  => [
						'carousel'         => 'yes',
						'carousel_bullets' => 'yes',
					]
				]
			);
	
			$this->start_controls_tabs(
				'carousel_bullets_tabs',
				[
					'condition' => [
						'carousel'         => 'yes',
						'carousel_bullets' => 'yes',
					]
				]
			);
			$this->start_controls_tab(
				'carousel_bullets_normal_tab',
				[
					'label' => esc_html__('Normal', 'tf-real-estate'),
				]
			);
			$this->add_control(
				'carousel_bullets_bg_color',
				[
					'label'     => esc_html__('Background Color', 'tf-real-estate'),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'default'   => '#ffffff',
					'selectors' => [
						'{{WRAPPER}} .tf-agent-wrap .owl-dots .owl-dot' => 'background-color: {{VALUE}}',
					],
					'condition' => [
						'carousel_bullets' => 'yes',
					]
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name'      => 'carousel_bullets_border',
					'label'     => esc_html__('Border', 'tf-real-estate'),
					'selector'  => '{{WRAPPER}} .tf-agent-wrap .owl-dots .owl-dot',
					'condition' => [
						'carousel_bullets' => 'yes',
					]
				]
			);
			$this->add_responsive_control(
				'carousel_bullets_border_radius',
				[
					'label'      => esc_html__('Border Radius', 'tf-real-estate'),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'default'    => [
						'top'      => '0',
						'right'    => '0',
						'bottom'   => '0',
						'left'     => '0',
						'unit'     => 'px',
						'isLinked' => true,
					],
					'selectors'  => [
						'{{WRAPPER}} .tf-agent-wrap .owl-dots .owl-dot' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'  => [
						'carousel_bullets' => 'yes',
					]
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'carousel_bullets_hover_tab',
				[
					'label' => esc_html__('Hover', 'tf-real-estate'),
				]
			);
			$this->add_control(
				'carousel_bullets_hover_bg_color',
				[
					'label'     => esc_html__('Background Color', 'tf-real-estate'),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-agent-wrap .owl-dots .owl-dot:hover, {{WRAPPER}} .tf-agent-wrap .owl-dots .owl-dot.active' => 'background-color: {{VALUE}}',
					],
					'condition' => [
						'carousel_bullets' => 'yes',
					]
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name'      => 'carousel_bullets_border_hover',
					'label'     => esc_html__('Border', 'tf-real-estate'),
					'selector'  => '{{WRAPPER}} .tf-agent-wrap .owl-dots .owl-dot:hover, {{WRAPPER}} .tf-agent-wrap .owl-dots .owl-dot.active',
					'condition' => [
						'carousel_bullets' => 'yes',
					]
				]
			);
			$this->add_responsive_control(
				'carousel_bullets_border_radius_hover',
				[
					'label'      => esc_html__('Border Radius', 'tf-real-estate'),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .tf-agent-wrap .owl-dots .owl-dot:hover, {{WRAPPER}} .tf-agent-wrap .owl-dots .owl-dot.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'  => [
						'carousel_bullets' => 'yes',
					]
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();

	        $this->end_controls_section();
        // /.End Carousel	

		 // Start general Style       
		 $this->start_controls_section( 
			'section_style_general',
			[
				'label' => esc_html__('Style', 'tf-real-estate'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .tf-agent-wrap .image-wrap img' => 'height: {{SIZE}}{{UNIT}} !important; min-height: {{SIZE}}{{UNIT}} !important; max-height: {{SIZE}}{{UNIT}} !important; width: 100%;',
				],
			]
		);

		$this->add_responsive_control(
			'image-object-fit',
			[
				'label' => esc_html__( 'Object Fit', 'tf-real-estate' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'condition' => [
					'image_height[size]!' => '',
				],
				'options' => [
					'' => esc_html__( 'Default', 'tf-real-estate' ),
					'fill' => esc_html__( 'Fill', 'tf-real-estate' ),
					'cover' => esc_html__( 'Cover', 'tf-real-estate' ),
					'contain' => esc_html__( 'Contain', 'tf-real-estate' ),
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tf-agent-wrap .image-wrap img' => 'object-fit: {{VALUE}};',
				],
			]
		);

		$this->add_control( 
			'heading_title',
			[
				'label' => esc_html__( 'Title', 'tf-real-estate' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control( 
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'typography_title',
				'label' => esc_html__( 'Typography', 'tf-real-estate' ),
				'selector' => '{{WRAPPER}} .tf-agent-wrap .content .title a, {{WRAPPER}} .tf-agent-wrap .content .title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'tf-real-estate'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-agent-wrap .content .title a' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label'     => esc_html__('Color Hover', 'tf-real-estate'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-agent-wrap .content .title a:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control( 
			'heading_title_desc',
			[
				'label' => esc_html__( 'Position', 'tf-real-estate' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control( 
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography_position',
				'label' => esc_html__( 'Typography', 'tf-real-estate' ),
				'selector' => '{{WRAPPER}} .tf-agent-wrap .info .position',
			]
		);

		$this->add_control(
			'position_color',
			[
				'label'     => esc_html__('Color', 'tf-real-estate'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-agent-wrap .info .position' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control( 
			'heading_social',
			[
				'label' => esc_html__( 'Social', 'tf-real-estate' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'size_social',
			[
				'label'      => esc_html__('Size', 'tf-real-estate'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-agent-wrap .social a' => 'font-size: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'social_color',
			[
				'label'     => esc_html__('Color', 'tf-real-estate'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-agent-wrap .social a' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'social_color_hover',
			[
				'label'     => esc_html__('Color Hover', 'tf-real-estate'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-agent-wrap .social a:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'bg_social_color',
			[
				'label'     => esc_html__('Background Color', 'tf-real-estate'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-agent-wrap .social a' => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'bg_social_color_hover',
			[
				'label'     => esc_html__('Background Color Hover', 'tf-real-estate'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-agent-wrap .social a:hover' => 'background: {{VALUE}} !important',
				],
			]
		);


		$this->add_control( 
			'heading_view_all',
			[
				'label' => esc_html__( 'Button', 'tf-real-estate' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control( 
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'view_all_typography',
				'label' => esc_html__( 'Typography', 'tf-real-estate' ),
				
				'selector' => '{{WRAPPER}} .tf-agent-wrap .tf-button a',
			]
		);

		$this->add_control(
			'button_color',
			[
				'label'     => esc_html__('Color', 'tf-real-estate'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-agent-wrap .tf-button a' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'button_color_hover',
			[
				'label'     => esc_html__('Color Hover', 'tf-real-estate'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-agent-wrap .tf-button a:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_section();
        // /.End general Style 
	}

    protected function render($instance = []) {
        $settings = $this->get_settings_for_display();

        $has_carousel = '';
		if ( $settings['carousel'] == 'yes' ) {
			$has_carousel = 'has-carousel';
		}

		$rtl_carousel = '';
		if( is_rtl() ){
			$rtl_carousel = 'yes';
		}

		$disable_border_radius = $settings['disable_border_radius'] == 'yes' ? ' disable-border-radius' : '';

        $this->add_render_attribute( 'tf_agent_wrap', ['id' => "tf-agent-{$this->get_id()}", 'class' => ['tf-agent-wrap', 'themesflat-agent-taxonomy', $settings['style'], $has_carousel, $disable_border_radius ], 'data-tabid' => $this->get_id()] );

        if ( get_query_var('paged') ) {
            $paged = get_query_var('paged');
         } elseif ( get_query_var('page') ) {
            $paged = get_query_var('page');
         } else {
            $paged = 1;
         }
         $query_args = array(
             'post_type' => 'agent',
             'posts_per_page' => $settings['agents_per_page'],
             'paged'     => $paged,
             'post_status' => 'publish'
         );
 
         if (! empty( $settings['agent_agencies'] )) {
            $query_args['tax_query'] = array(
                array(
                    'taxonomy' => 'agencies',
                    'field'    => 'slug',
                    'terms'    => $settings['agent_agencies']
                ),
            );
         }        
         if ( ! empty( $settings['exclude'] ) ) {				
             if ( ! is_array( $settings['exclude'] ) )
                 $exclude = explode( ',', $settings['exclude'] );
 
             $query_args['post__not_in'] = $exclude;
         }
 
         $query_args['orderby'] = $settings['order_by'];
         $query_args['order'] = $settings['order'];
 
         if ( $settings['sort_by_id'] != '' ) {	
             $sort_by_id = array_map( 'trim', explode( ',', $settings['sort_by_id'] ) );
             $query_args['post__in'] = $sort_by_id;
             $query_args['orderby'] = 'post__in';
         } 
         $query = new WP_Query( $query_args );
         if ( $query->have_posts() ) : ?>
         <div <?php echo $this->get_render_attribute_string('tf_agent_wrap'); ?>>
             <div class="wrap-agent-post row <?php echo esc_attr($settings['layout']); ?>">
 
                 <?php if ( $settings['carousel'] == 'yes' ): ?>
                 <div class="owl-carousel" data-loop="<?php echo esc_attr($settings['carousel_loop']); ?>" data-auto="<?php echo esc_attr($settings['carousel_auto']); ?>" data-column="<?php echo esc_attr($settings['carousel_column_desk']); ?>" data-column2="<?php echo esc_attr($settings['carousel_column_tablet']); ?>" data-column3="<?php echo esc_attr($settings['carousel_column_mobile']); ?>" data-prev_icon="fas fa-arrow-left"
				data-next_icon="fas fa-arrow-right" data-arrow="<?php echo esc_attr($settings['carousel_arrow']) ?>" data-bullets="<?php echo esc_attr($settings['carousel_bullets']) ?>" data-rtl="<?php echo esc_attr($rtl_carousel) ?>">
                 <?php endif; ?>
 
                 <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                     <?php 
                     $attr['settings'] = $settings; 
                     tfre_get_template_widget_elementor("templates/agent/{$settings['style']}", $attr); 
                     ?>
                 <?php endwhile; ?>
 
                 <?php if ( $settings['carousel'] == 'yes' ): ?>
                 </div>
                 <?php endif; ?>
 
                 <?php wp_reset_postdata(); ?>
             </div>
         </div>
         <?php
         else:
             esc_html_e('No posts found', 'tf-real-estate');
         endif;
    }
}