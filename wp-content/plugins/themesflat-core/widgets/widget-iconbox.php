<?php
class TFIconBox_Widget extends \Elementor\Widget_Base {

	public function get_name() {
        return 'tficonbox';
    }
    
    public function get_title() {
        return esc_html__( 'TF Icon Box', 'themesflat-core' );
    }

    public function get_icon() {
        return 'eicon-icon-box';
    }
    
    public function get_categories() {
        return [ 'themesflat_addons' ];
    }

    public function get_style_depends() {
		return ['tf-iconbox'];
	}

	protected function _register_controls() {
        // Start Icon Box Setting        
			$this->start_controls_section( 
				'section_tficonbox',
	            [
	                'label' => esc_html__('Icon Box', 'themesflat-core'),
	            ]
	        );

	        $this->add_control(
				'icon_style',
				[
					'label' => esc_html__( 'Icon Style', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'none' => [
							'title' => esc_html__( 'None', 'themesflat-core' ),
							'icon' => 'fa fa-ban',
						],
						'icon' => [
							'title' => esc_html__( 'Icon', 'themesflat-core' ),
							'icon' => 'fa fa-paint-brush',
						],
					],
					'default' => 'icon',
					'toggle' => false,
				]
			);

			$this->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'fa4compatibility' => 'icon_',
					'default' => [
						'value' => 'icon-dreamhome-price-house',
						'library' => 'theme_icon',
					],
					'condition' => [
						'icon_style' => 'icon',
					],
				]
			);			

			$this->add_control(
				'enable_circle_icon',
				[
					'label' => esc_html__( 'Enable Circle Icon & Text', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'On', 'themesflat-core' ),
					'label_off' => esc_html__( 'Off', 'themesflat-core' ),
					'description'	=> 'Only Show Button & Heading',
					'return_value' => 'yes',
					'default' => 'no',
				]
			);

			$this->add_control(
				'title_text',
				[
					'label' => esc_html__( 'Title', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'label_block' => true,
					'default' => esc_html__( 'Find Your Dreams Real Estate', 'themesflat-core' ),
				]
			);

			$this->add_control(
				'description_text',
				[
					'label' => esc_html__( 'Description', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::WYSIWYG,
					'default' => esc_html__( 'Experience the convenience of banking with easy access to your accounts anytime, anywhere.', 'themesflat-core' ),
				]
			);		

			$this->add_control(
				'position',
				[
					'label' => esc_html__( 'Icon Position', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'default' => 'top',
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'themesflat-core' ),
							'icon' => 'eicon-h-align-left',
						],
						'top' => [
							'title' => esc_html__( 'Top', 'themesflat-core' ),
							'icon' => 'eicon-v-align-top',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'themesflat-core' ),
							'icon' => 'eicon-h-align-right',
						],
					],
				]
			);
			
	        $this->end_controls_section();
        // /.End Icon Box Setting

        // Start Read More        
			$this->start_controls_section( 
				'section_button',
	            [
	                'label' => esc_html__('Read More', 'themesflat-core'),
	            ]
	        );
	        $this->add_control(
				'show_button',
				[
					'label' => esc_html__( 'Show Button', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'themesflat-core' ),
					'label_off' => esc_html__( 'Hide', 'themesflat-core' ),
					'return_value' => 'yes',
					'default' => 'no',
				]
			);
			$this->add_control( 
				'icon_button',
				[
					'label' => esc_html__( 'Icon Button', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'fa4compatibility' => 'icon_bt',
					'default' => [
						'value' => 'icon-dreamhome-arrow-right',
						'library' => 'theme_icon',
					],				
				]
			);
			$this->add_control( 
				'button_text',
				[
					'label' => esc_html__( 'Button Text', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Read More', 'themesflat-core' ),
					'condition' => [
	                    'show_button'	=> 'yes',
	                ],
				]
			);
	        $this->add_control(
				'link',
				[
					'label' => esc_html__( 'Link', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::URL,
					'placeholder' => esc_html__( 'https://your-link.com', 'themesflat-core' ),
					'default' => [
						'url' => '#',
						'is_external' => false,
						'nofollow' => false,
					],
					'condition' => [
						'show_button' => 'yes'
					]
				]
			);
	        $this->end_controls_section();
        // /.End Read More	    

		// Start Circle Text
		$this->start_controls_section( 
			'section_Circle_style_general',
			[
				'label' => esc_html__( 'Circle Text', 'themesflat-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_circle_icon' => 'yes'
				]
			]
		); 

		$this->add_responsive_control( 
			'h_over_height',
			[
				'label' => esc_html__( 'Height & Width', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .group-circle-icon' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control( 
			'over_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .group-circle-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control( 
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'over_border_border',
				'label' => esc_html__( 'Border', 'themesflat-core' ),
				'selector' => '{{WRAPPER}} .group-circle-icon',
			]
		);

		$this->add_control( 
			'over_bg',
			[
				'label' => esc_html__( 'Over Background Color', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .group-circle-icon ' => 'background-color: {{VALUE}}',				
				],
			]
		);

		$this->add_control( 
			'inner_bg_color',
			[
				'label' => esc_html__( 'Text Circle', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control( 
			'h_text_height',
			[
				'label' => esc_html__( 'Width', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .group-circle-icon .textcircle' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control( 
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'inner_typography',
				'label' => esc_html__( 'Typography', 'themesflat-core' ),
				
				'selector' => '{{WRAPPER}} .group-circle-icon text',
			]
		);

		$this->add_control( 
			'typo_inner_color',
			[
				'label' => esc_html__( 'Color', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .group-circle-icon .textcircle' => 'fill: {{VALUE}}',				
				],
			]
		);

		$this->add_control( 
			'inner_button',
			[
				'label' => esc_html__( 'Button', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control( 
			'h_button_size',
			[
				'label' => esc_html__( 'Size', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .group-circle-icon .tf-button-circle' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control( 
			'button_inner_color',
			[
				'label' => esc_html__( 'Color', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .group-circle-icon .tf-button-circle a' => 'color: {{VALUE}}',				
				],
			]
		);

		$this->add_control( 
			'button_inner_color_hover',
			[
				'label' => esc_html__( 'Color Hover', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .group-circle-icon .tf-button-circle a:hover' => 'color: {{VALUE}}',				
				],
			]
		);

		$this->end_controls_section();
        // /.End Circle Text	 

		// Start General
		$this->start_controls_section( 
			'section_style_general',
			[
				'label' => esc_html__( 'General', 'themesflat-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		); 

		$this->add_responsive_control(
			'text_align',
			[
				'label' => esc_html__( 'Alignment', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'themesflat-core' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'themesflat-core' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'themesflat-core' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'themesflat-core' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tficonbox' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control( 
			'general_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tficonbox' => 'background-color: {{VALUE}}',				
				],
			]
		);

		$this->add_control( 
			'general_bg_color_hover',
			[
				'label' => esc_html__( 'Background Color Hover', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tficonbox:hover' => 'background-color: {{VALUE}}',				
				],
			]
		);

		$this->add_control( 
			'general_bg_item_color',
			[
				'label' => esc_html__( 'Hover Elements Color', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tficonbox:hover .wrap-icon-inner, {{WRAPPER}} .tficonbox:hover .content .title, {{WRAPPER}} .tficonbox:hover .content .description, {{WRAPPER}} .tficonbox:hover .tf-button' => 'color: {{VALUE}}',				
				],
			]
		);

		$this->add_responsive_control( 
			'general_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tficonbox' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control( 
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'general_border_border',
				'label' => esc_html__( 'Border', 'themesflat-core' ),
				'selector' => '{{WRAPPER}} .tficonbox',
			]
		);

		$this->add_group_control( 
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'general_border_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'themesflat-core' ),
				'selector' => '{{WRAPPER}} .tficonbox',
			]
		);

		$this->add_responsive_control( 
			'padding_general',
			[
				'label' => esc_html__( 'Padding', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tficonbox' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],					
			]
		);	

		$this->add_responsive_control( 
			'margin_general',
			[
				'label' => esc_html__( 'Margin', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tficonbox' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);  
		


		$this->end_controls_section();
        // /.End General 

	    // Start Icon Style 
		    $this->start_controls_section( 
		    	'section_style_icon',
	            [
	                'label' => esc_html__( 'Icon', 'themesflat-core' ),
	                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
	                'condition' => [
						'icon_style' => 'icon',
					],
	            ]
	        ); 

			$this->add_control(
				'icon_vertical_style',
				[
					'label' => esc_html__( 'Vertical Align', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'start' => esc_html__( 'Top', 'themesflat-core' ),
						'center' => esc_html__( 'Center', 'themesflat-core' ),
						'end' => esc_html__( 'Bottom', 'themesflat-core' ),
					],
					'selectors' => [
						'{{WRAPPER}} .tficonbox' => '-webkit-box-align: {{VALUE}};',
						'{{WRAPPER}} .tficonbox' => '-webkit-align-items: {{VALUE}};',
						'{{WRAPPER}} .tficonbox' => '-ms-flex-align: {{VALUE}};',
						'{{WRAPPER}} .tficonbox' => 'align-items: {{VALUE}};',
					],
					'condition' => [
						'position!' => 'top',
					],
				]
			);

			$this->add_control(
				'icon_line',
				[
					'label' => esc_html__( 'Line', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'block' => esc_html__( 'Show', 'themesflat-core' ),
						'none' => esc_html__( 'Hide', 'themesflat-core' ),
					],
					'default' => 'none',
					'selectors' => [
						'{{WRAPPER}} .tficonbox .wrap-icon::after ' => 'display: {{VALUE}};',
					],
					'condition' => [
						'position!' => 'top',
					],
				]
			);

			$this->add_control( 
	        	'icon_line_size_height',
				[
					'label' => esc_html__( 'Height', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 300,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .tficonbox .wrap-icon::after ' => 'height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'icon_line' => 'block',
					],
				]
			);

			$this->add_control( 
	        	'icon_line_size',
				[
					'label' => esc_html__( 'Line Spacing', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => -300,
							'max' => 300,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .tficonbox .wrap-icon::after ' => 'right: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'icon_line' => 'block',
					],
				]
			);

			$this->add_control(
				'icon_line_color',
				[
					'label' => esc_html__( 'Color', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tficonbox .wrap-icon::after' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'icon_line' => 'block',
					],
				]
			);

		

	        $this->add_control(
				'icon_showcase',
				[
					'label' => esc_html__( 'Type', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'default' => esc_html__( 'Default', 'themesflat-core' ),
						'circle' => esc_html__( 'Circle', 'themesflat-core' ),
						'square' => esc_html__( 'Square', 'themesflat-core' ),
						'circle-outline' => esc_html__( 'Circle Outline', 'themesflat-core' ),
						'square-outline' => esc_html__( 'Square Outline', 'themesflat-core' ),
					],
					'default' => 'default',
					'condition' => [
						'icon[value]!' => '',
					],
				]
			);

	        $this->add_control( 
	        	'icon_size',
				[
					'label' => esc_html__( 'Size', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 300,
							'step' => 1,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 55,
					],
					'selectors' => [
						'{{WRAPPER}} .tficonbox .wrap-icon-inner i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .tficonbox .wrap-icon-inner svg,{{WRAPPER}} .tficonbox .wrap-icon-inner img' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control( 
	        	'wrap_icon_size',
				[
					'label' => esc_html__( 'Wrap Icon Size', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 300,
							'step' => 1,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 100,
					],
					'selectors' => [
						'{{WRAPPER}} .tficonbox .wrap-icon-inner' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .tficonbox .wrap-icon.square .wrap-icon-inner, {{WRAPPER}} .tficonbox .wrap-icon.square-outline .wrap-icon-inner' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'icon_showcase!' => 'default'
					],
				]
			);

			$this->add_control(
				'rotate',
				[
					'label' => esc_html__( 'Rotate', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'default' => [
						'size' => 0,
						'unit' => 'deg',
					],
					'selectors' => [
						'{{WRAPPER}} .tficonbox .wrap-icon-inner' => 'transform: rotate({{SIZE}}{{UNIT}});',
					],
				]
			);

			$this->add_control(
				'rotate_icon',
				[
					'label' => esc_html__( 'Rotate Icon', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'default' => [
						'size' => 0,
						'unit' => 'deg',
					],
					'selectors' => [
						'{{WRAPPER}} .tficonbox .wrap-icon-inner i, {{WRAPPER}} .tficonbox .wrap-icon-inner svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
						'{{WRAPPER}} .tficonbox .wrap-icon-inner img' => 'transform: rotate({{SIZE}}{{UNIT}});',
					],
				]
			);

			$this->add_control(
				'icon_border_width',
				[
					'label' => esc_html__( 'Border Width', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 20,
							'step' => 1,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 3,
					],
					'selectors' => [
						'{{WRAPPER}} .tficonbox .wrap-icon-inner' => 'border-width: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .tficonbox .wrap-icon-spin-around:before' => 'width: calc(100% + 2 * {{SIZE}}{{UNIT}}); height: calc(100% + 2 * {{SIZE}}{{UNIT}}); border-width: {{SIZE}}{{UNIT}}; top: -{{SIZE}}{{UNIT}}; left: -{{SIZE}}{{UNIT}};',

					],
					'condition' => [
						'icon_showcase' => array('circle-outline','square-outline')
					],
				]
			);

			$this->add_control(
				'border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .tficonbox .wrap-icon-inner, {{WRAPPER}} .tficonbox .wrap-icon-spin-around:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'icon_showcase!' => 'default',
					],
				]
			);

			$this->add_responsive_control(
				'icon_margin',
				[
					'label' => esc_html__( 'Margin', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .tficonbox .wrap-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs( 'icon_tabs' );				

				$this->start_controls_tab( 
					'icon_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'themesflat-core' ),						
					]
				);

				$this->add_control( 
					'icon_color',
					[
						'label' => esc_html__( 'Icon Color', 'themesflat-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'default' => '#FFA920',
						'selectors' => [
							'{{WRAPPER}} .tficonbox .wrap-icon-inner, {{WRAPPER}} .tficonbox .wrap-icon-inner svg' => 'color: {{VALUE}}; fill: {{VALUE}}',
							'{{WRAPPER}} .tficonbox .wrap-icon .wrap-icon-inner svg path' => 'stroke: {{VALUE}};',
							'{{WRAPPER}} .tficonbox .wrap-icon .wrap-icon-inner svg path.fill' => 'fill: {{VALUE}};',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'icon_background',
						'label' => esc_html__( 'Background', 'themesflat-core' ),
						'types' => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} .tficonbox .wrap-icon.circle .wrap-icon-inner, {{WRAPPER}} .tficonbox .wrap-icon.square .wrap-icon-inner, {{WRAPPER}} .tficonbox .wrap-icon-spin-around:before',
						'condition' => [
							'icon_showcase' => ['circle','square']
						]
					]
				);

				$this->add_control( 
					'border_icon_color',
					[
						'label' => esc_html__( 'Border Color', 'themesflat-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .tficonbox .wrap-icon.circle-outline .wrap-icon-inner, {{WRAPPER}} .tficonbox .wrap-icon.square-outline .wrap-icon-inner, {{WRAPPER}} .tficonbox .wrap-icon-spin-around:before' => 'border-color: {{VALUE}}',
						],
						'condition' => [
							'icon_showcase' => ['circle-outline','square-outline']
						]
					]
				);

				$this->add_control(
					'border_style_icon',
					[
						'label' => esc_html__( 'Border Type', 'themesflat-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'solid',
						'options' => [
							'solid' => esc_html__( 'Solid', 'themesflat-core' ),
							'double' => esc_html__( 'Double', 'themesflat-core' ),
							'dotted' => esc_html__( 'Dotted', 'themesflat-core' ),
							'dashed' => esc_html__( 'Dashed', 'themesflat-core' ),
							'groove' => esc_html__( 'Groove', 'themesflat-core' ),
						],
						'selectors' => [
							'{{WRAPPER}} .tficonbox .wrap-icon.circle-outline .wrap-icon-inner, {{WRAPPER}} .tficonbox .wrap-icon.square-outline .wrap-icon-inner, {{WRAPPER}} .tficonbox .wrap-icon-spin-around:before' => 'border-style: {{VALUE}}',
						],
						'condition' => [
							'icon_showcase' => ['circle-outline','square-outline']
						]
					]
				);	

				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'icon_box_shadow',
						'label' => esc_html__( 'Box Shadow', 'themesflat-core' ),
						'selector' => '{{WRAPPER}} .tficonbox .wrap-icon .wrap-icon-inner',
					]
				);
		
				
				$this->end_controls_tab();

				$this->start_controls_tab( 
			    	'icon_hover_tab',
					[
						'label' => esc_html__( 'Hover', 'themesflat-core' ),
					]
				);

				$this->add_control( 
					'icon_color_hover',
					[
						'label' => esc_html__( 'Icon Color', 'themesflat-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tficonbox:hover .wrap-icon-inner' => 'color: {{VALUE}}; fill: {{VALUE}}',
							'{{WRAPPER}} .tficonbox:hover .wrap-icon .wrap-icon-inner svg path' => 'stroke: {{VALUE}};',
							'{{WRAPPER}} .tficonbox:hover .wrap-icon .wrap-icon-inner svg path.fill' => 'fill: {{VALUE}};',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'icon_background_hover',
						'label' => esc_html__( 'Background', 'themesflat-core' ),
						'types' => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} .tficonbox:hover .wrap-icon.circle .wrap-icon-inner, {{WRAPPER}} .tficonbox:hover .wrap-icon.square .wrap-icon-inner, {{WRAPPER}} .tficonbox:hover .wrap-icon-spin-around:before',
						'condition' => [
							'icon_showcase' => ['circle','square']
						]
					]
				);				

				$this->add_control( 
					'border_icon_color_hover',
					[
						'label' => esc_html__( 'Border Color', 'themesflat-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .tficonbox:hover .wrap-icon.circle-outline .wrap-icon-inner, {{WRAPPER}} .tficonbox:hover .wrap-icon.square-outline .wrap-icon-inner, {{WRAPPER}} .tficonbox:hover .wrap-icon-spin-around:before' => 'border-color: {{VALUE}}',
						],
						'condition' => [
							'icon_showcase' => ['circle-outline','square-outline']
						]
					]
				);	

				$this->add_control(
					'border_style_icon_hover',
					[
						'label' => esc_html__( 'Border Type', 'themesflat-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'solid',
						'options' => [
							'solid' => esc_html__( 'Solid', 'themesflat-core' ),
							'double' => esc_html__( 'Double', 'themesflat-core' ),
							'dotted' => esc_html__( 'Dotted', 'themesflat-core' ),
							'dashed' => esc_html__( 'Dashed', 'themesflat-core' ),
							'groove' => esc_html__( 'Groove', 'themesflat-core' ),
						],
						'selectors' => [
							'{{WRAPPER}} .tficonbox:hover .wrap-icon.circle-outline .wrap-icon-inner, {{WRAPPER}} .tficonbox:hover .wrap-icon.square-outline .wrap-icon-inner, {{WRAPPER}} .tficonbox .wrap-icon-spin-around:before' => 'border-style: {{VALUE}}',
						],
						'condition' => [
							'icon_showcase' => ['circle-outline','square-outline']
						]
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'icon_hover_box_shadow',
						'label' => esc_html__( 'Box Shadow', 'themesflat-core' ),
						'selector' => '{{WRAPPER}} .tficonbox:hover .wrap-icon .wrap-icon-inner',
					]
				);

				$this->add_control(
					'icon_animation',
					[
						'label' => esc_html__( 'Hover Animation', 'themesflat-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'default',
						'options' => [
							'default' => esc_html__( 'Default', 'themesflat-core' ),
							'right-to-left' => esc_html__( 'Right To Left', 'themesflat-core' ),
							'left-to-right' => esc_html__( 'Left To Right', 'themesflat-core' ),
							'top-to-bottom' => esc_html__( 'Top To Bottom', 'themesflat-core' ),
							'bottom-to-top' => esc_html__( 'Bottom To Top', 'themesflat-core' ),
							'spin-around' => esc_html__( 'Spin Around', 'themesflat-core' ),
							'wrap-icon-spin-around' => esc_html__( 'Wrap Icon Spin Around', 'themesflat-core' ),
							'wrap-icon-pop' => esc_html__( 'Wrap Icon Pop', 'themesflat-core' ),
						]
					]
				);		
				
				$this->end_controls_tab();

	        $this->end_controls_tabs();

		    $this->end_controls_section();
	    // /.End Icon Style

	    // Start Content Style 
		    $this->start_controls_section( 
		    	'section_style_content',
	            [
	                'label' => esc_html__( 'Content', 'themesflat-core' ),
	                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
	            ]
	        );  

			$this->add_control(
				'heading_title',
				[
					'label' => esc_html__( 'Title', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::HEADING,					
					'separator' => 'before',
				]
			);		

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .tficonbox .content .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' => esc_html__( 'Color', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#121212',
					'selectors' => [
						'{{WRAPPER}} .tficonbox .content .title, {{WRAPPER}} .tficonbox .content .title a' => 'color: {{VALUE}};',
					],
				]
			);	

			$this->add_control(
				'title_tag',
				[
					'label' => esc_html__( 'Title Tag', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'h3',
					'options' => [
						'h1'  => esc_html__( 'H1', 'themesflat-core' ),
						'h2'  => esc_html__( 'H2', 'themesflat-core' ),
						'h3'  => esc_html__( 'H3', 'themesflat-core' ),
						'h4'  => esc_html__( 'H4', 'themesflat-core' ),
						'h5'  => esc_html__( 'H5', 'themesflat-core' ),
						'h6'  => esc_html__( 'H6', 'themesflat-core' ),
					],
				]
			);

			$this->add_control(
				'title_margin',
				[
					'label' => esc_html__( 'Margin', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em' ],
					'default' => [
						'top' => '0',
						'right' => '0',
						'bottom' => '4',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => 'false',
					],
					'selectors' => [
						'{{WRAPPER}} .tficonbox .content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'title_color_hover',
				[
					'label' => esc_html__( 'Color Hover', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .tficonbox .content .title a:hover' => 'color: {{VALUE}};',
					],
					'condition' => [
						'link[url]!' => ''
					],
				]
			);	

			$this->add_control(
				'heading_description',
				[
					'label' => esc_html__( 'Description', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::HEADING,					
					'separator' => 'before',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'description_typography',
					'selector' => '{{WRAPPER}} .tficonbox .content .description',
				]
			);

			$this->add_control(
				'description_color',
				[
					'label' => esc_html__( 'Color', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#64666C',
					'selectors' => [
						'{{WRAPPER}} .tficonbox .content .description' => 'color: {{VALUE}};',
					]
				]
			);		 
			
			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'desc_border',
					'label' => esc_html__( 'Border', 'themesflat-core' ),
					'selector' => '{{WRAPPER}} .tficonbox .content .description',
				]
			);

			$this->add_responsive_control( 
				'desc_padding',
				[
					'label' => esc_html__( 'Padding', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .tficonbox .content .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control( 
				'desc_margin',
				[
					'label' => esc_html__( 'Margin', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .tficonbox .content .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		    $this->end_controls_section();
    	// /.End Content Style

		// Start Button Style 
		    $this->start_controls_section( 
		    	'section_style_button',
	            [
	                'label' => esc_html__( 'Button', 'themesflat-core' ),
	                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
	            ]
	        );

	        $this->add_control(
				'button_align',
				[
					'label' => esc_html__( 'Alignment', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'left'    => [
							'title' => esc_html__( 'Left', 'themesflat-core' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'themesflat-core' ),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'themesflat-core' ),
							'icon' => 'eicon-text-align-right',
						],
						'justify' => [
							'title' => esc_html__( 'Justified', 'themesflat-core' ),
							'icon' => 'eicon-text-align-justify',
						],
					],
				]
			);

	        $this->add_group_control( 
	        	\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'button_typography',
					'label' => esc_html__( 'Typography', 'themesflat-core' ),
					'selector' => '{{WRAPPER}} .tficonbox .tf-button',
				]
			);

			$this->add_responsive_control( 
				'button_padding',
				[
					'label' => esc_html__( 'Padding', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em' ],
					'default' => [
						'top' => '0',
						'right' => '0',
						'bottom' => '0',
						'left' => '0',
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .tficonbox .tf-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'btn_line',
				[
					'label' => esc_html__( 'Line Button', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'themesflat-core' ),
					'label_off' => esc_html__( 'Hide', 'themesflat-core' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);	

			$this->add_responsive_control( 
				'button_margin',
				[
					'label' => esc_html__( 'Margin', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em' ],
					'default' => [
						'top' => '20',
						'right' => '0',
						'bottom' => '0',
						'left' => '0',
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .tficonbox .tf-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs( 
				'button_style_tabs' 
				);

	        	$this->start_controls_tab( 'button_style_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'themesflat-core' ),
					] );	
	        		$this->add_control( 
						'button_color',
						[
							'label' => esc_html__( 'Color', 'themesflat-core' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .tficonbox .tf-button' => 'color: {{VALUE}}',
								'{{WRAPPER}} .tficonbox .tf-button i' => 'color: {{VALUE}}',
								'{{WRAPPER}} .tficonbox .tf-button svg' => 'fill: {{VALUE}}',
								'{{WRAPPER}} .tficonbox .tf-button.has-line:after' => 'background-color: {{VALUE}}',
							],
						]
					);

					$this->add_control( 
						'button_bg_color',
						[
							'label' => esc_html__( 'Background Color', 'themesflat-core' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .tficonbox .tf-button' => 'background-color: {{VALUE}}',
							],
						]
					);

					$this->add_group_control( 
						\Elementor\Group_Control_Border::get_type(),
						[
							'name' => 'button_border',
							'label' => esc_html__( 'Border', 'themesflat-core' ),
							'selector' => '{{WRAPPER}} .tficonbox .tf-button',
						]
					);

					$this->add_control( 
						'button_border_radius',
						[
							'label' => esc_html__( 'Border Radius', 'themesflat-core' ),
							'type' => \Elementor\Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', 'em', '%' ],
							'selectors' => [
								'{{WRAPPER}} .tficonbox .tf-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

					$this->add_control( 
						'heading_button_icon',
						[
							'label' => esc_html__( 'Icon', 'themesflat-core' ),
							'type' => \Elementor\Controls_Manager::HEADING,
							'separator' => 'before',
						]
					); 

					$this->add_control( 
						'button_icon_size',
						[
							'label' => esc_html__( 'Icon Size', 'themesflat-core' ),
							'type' => \Elementor\Controls_Manager::SLIDER,
							'size_units' => [ 'px' ],
							'range' => [
								'px' => [
									'min' => 0,
									'max' => 50,
									'step' => 1,
								],
							],
							'default' => [
								'unit' => 'px',
								'size' => 15,
							],
							'selectors' => [
								'{{WRAPPER}} .tficonbox .tf-button i' => 'font-size: {{SIZE}}{{UNIT}};',
								'{{WRAPPER}} .tficonbox .tf-button svg' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					); 

					$this->add_control( 
						'button_icon_position',
						[
							'label' => esc_html__( 'Icon Position', 'themesflat-core' ),
							'type' => \Elementor\Controls_Manager::SELECT,
							'default' => 'bt_icon_after',
							'options' => [
								'bt_icon_before'  => esc_html__( 'Before', 'themesflat-core' ),
								'bt_icon_after' => esc_html__( 'After', 'themesflat-core' ),
							],
						]
					);

					$this->add_control( 
						'button_icon_spacer',
						[
							'label' => esc_html__( 'Icon Spacer', 'themesflat-core' ),
							'type' => \Elementor\Controls_Manager::SLIDER,
							'size_units' => [ 'px' ],
							'range' => [
								'px' => [
									'min' => 0,
									'max' => 50,
									'step' => 1,
								],
							],
							'default' => [
								'unit' => 'px',
								'size' => 7,
							],
							'selectors' => [
								'{{WRAPPER}} .tficonbox .tf-button.bt_icon_before i' => 'margin-right: {{SIZE}}{{UNIT}};',
								'{{WRAPPER}} .tficonbox .tf-button.bt_icon_before svg' => 'margin-right: {{SIZE}}{{UNIT}};',
								'{{WRAPPER}} .tficonbox .tf-button.bt_icon_after i' => 'margin-left: {{SIZE}}{{UNIT}};',
								'{{WRAPPER}} .tficonbox .tf-button.bt_icon_after svg' => 'margin-left: {{SIZE}}{{UNIT}};',
								'.rtl {{WRAPPER}} .tficonbox .tf-button.bt_icon_before i' => 'margin-left: {{SIZE}}{{UNIT}};margin-right:0;',
								'.rtl {{WRAPPER}} .tficonbox .tf-button.bt_icon_before svg' => 'margin-left: {{SIZE}}{{UNIT}};margin-right:0;',
								'.rtl {{WRAPPER}} .tficonbox .tf-button.bt_icon_after i' => 'margin-right: {{SIZE}}{{UNIT}};margin-left:0;',
								'.rtl {{WRAPPER}} .tficonbox .tf-button.bt_icon_after svg' => 'margin-right: {{SIZE}}{{UNIT}};margin-left:0;',
							],
						]
					);
					
				$this->end_controls_tab();

				$this->start_controls_tab( 'button_style_hover_tab',
					[
						'label' => esc_html__( 'Hover', 'themesflat-core' ),
					] );

					$this->add_control( 
						'button_color_hover',
						[
							'label' => esc_html__( 'Color Hover', 'themesflat-core' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '#FFA920',
							'selectors' => [
								'{{WRAPPER}} .tficonbox .tf-button:hover' => 'color: {{VALUE}}',
								'{{WRAPPER}} .tficonbox .tf-button:hover i' => 'color: {{VALUE}}',
								'{{WRAPPER}} .tficonbox .tf-button:hover svg' => 'fill: {{VALUE}}',
								'{{WRAPPER}} .tficonbox .tf-button.has-line:hover:after' => 'background-color: {{VALUE}}',
							],
						]
					);

					$this->add_control( 
						'button_bg_color_hover',
						[
							'label' => esc_html__( 'Background Color Hover', 'themesflat-core' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .tficonbox .tf-button:hover, {{WRAPPER}} .tficonbox .btn-overlay:after' => 'background-color: {{VALUE}}',
							],
						]
					);

					$this->add_group_control( 
						\Elementor\Group_Control_Border::get_type(),
						[
							'name' => 'button_border_hover',
							'label' => esc_html__( 'Border', 'themesflat-core' ),
							'selector' => '{{WRAPPER}} .tficonbox .tf-button:hover',
						]
					);

					$this->add_control( 
						'button_border_radius_hover',
						[
							'label' => esc_html__( 'Border Radius', 'themesflat-core' ),
							'type' => \Elementor\Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', 'em', '%' ],
							'selectors' => [
								'{{WRAPPER}} .tficonbox .tf-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

					$this->add_control(
						'button_animation_options',
						[
							'label' => esc_html__( 'Effect Type', 'themesflat-core' ),
							'type' => \Elementor\Controls_Manager::SELECT,
							'default' => 'default',
							'options' => [
								'default' => esc_html__( 'Default', 'themesflat-core' ),
								'button' => esc_html__( 'Elementor Button Effect', 'themesflat-core' ),
								'button-overlay' => esc_html__( 'TF Effect', 'themesflat-core' ),
							]
						]
					);

					$this->add_control(
						'button_animation_overlay',
						[
							'label' => esc_html__( 'Style', 'themesflat-core' ),
							'type' => \Elementor\Controls_Manager::SELECT,
							'default' => 'from-top',
							'options' => [								
								'from-top' => esc_html__( 'From Top', 'themesflat-core' ),
								'from-bottom' => esc_html__( 'From Bottom', 'themesflat-core' ),
								'from-left' => esc_html__( 'From Left', 'themesflat-core' ),
								'from-right' => esc_html__( 'From Right', 'themesflat-core' ),
								'from-center' => esc_html__( 'From Center', 'themesflat-core' ),
								'skew' => esc_html__( 'Skew', 'themesflat-core' ),								
							],
							'condition'=> [
								'button_animation_options' => 'button-overlay',
							],
						]
					);	

					$this->add_control(
						'button_animation',
						[
							'label' => esc_html__( 'Hover Animation', 'themesflat-core' ),
							'type' => \Elementor\Controls_Manager::SELECT,
							'default' => 'elementor-animation-push',
							'options' => [
								'elementor-animation-grow' => esc_html__( 'Grow', 'themesflat-core' ),
								'elementor-animation-shrink' => esc_html__( 'Shrink', 'themesflat-core' ),
								'elementor-animation-pulse' => esc_html__( 'Pulse', 'themesflat-core' ),
								'elementor-animation-pulse-grow' => esc_html__( 'Pulse Grow', 'themesflat-core' ),
								'elementor-animation-pulse-shrink' => esc_html__( 'Pulse Shrink', 'themesflat-core' ),
								'elementor-animation-push' => esc_html__( 'Push', 'themesflat-core' ),
								'elementor-animation-pop' => esc_html__( 'Pop', 'themesflat-core' ),
								'elementor-animation-bob' => esc_html__( 'Bob', 'themesflat-core' ),
								'elementor-animation-hang' => esc_html__( 'Hang', 'themesflat-core' ),
								'elementor-animation-skew' => esc_html__( 'Skew', 'themesflat-core' ),
								'elementor-animation-wobble-vertical' => esc_html__( 'Wobble Vertical', 'themesflat-core' ),
								'elementor-animation-wobble-horizontal' => esc_html__( 'Wobble Horizontal', 'themesflat-core' ),

							],
							'condition'=> [
								'button_animation_options' => 'button',
							],
						]
					);	
					
				$this->end_controls_tab();

			$this->end_controls_tabs();

		    $this->end_controls_section();
	    // /.End Button Style


	}

	protected function render($instance = []) {
		$settings = $this->get_settings_for_display();

		if (!empty($settings['link'])) {
			$target = $settings['link']['is_external'] ? ' target="_blank"' : '';
			$nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
		}


		$migrated = isset( $settings['__fa4_migrated']['icon_button'] );	
		$is_new = empty( $settings['icon_bt'] );

		$btn_animation = 'hover-default';
		if ($settings['button_animation_options'] == 'button') {
			$btn_animation = 'hover-default ' . $settings['button_animation'];
		}elseif ($settings['button_animation_options'] == 'button-overlay') {
			$btn_animation = 'btn-overlay ' . $settings['button_animation_overlay'];
		}

		$btn_line = '';
		if ($settings['btn_line'] == 'yes') {
			$btn_line = 'has-line';
		}

		$icon_button = '';

		if ( isset( $settings['icon']['value'] ) ) {
			if ( !empty( $settings['icon']['value']['url'] ) ) {
				$icon_button .= sprintf(
		           '<img class="logo_svg" src="%1$s" alt="%2$s"/>',
		             $settings['icon']['value']['url'],
		             $settings['icon']['value']['id']
		         ); 
			} else {
				$icon_button .= sprintf(
		             '<i class="%1$s"></i>',
		            $settings['icon']['value']
		        );  
			}
		}

		
		?>
		<?php if( $settings['enable_circle_icon'] == 'yes') : ?>
			<div class="group-circle-icon">
				<svg class="textcircle" viewBox="0 0 500 500">
					<defs>
						<path id="textcircle" d="M250,400 a150,150 0 0,1 0,-300a150,150 0 0,1 0,300Z">
						</path>
					</defs>
					<text>
						<textPath xlink:href="#textcircle" textLength="900"><?php echo esc_attr($settings['title_text']); ?></textPath>
					</text>
				</svg>
				<?php if ( $settings['show_button'] == 'yes' ): ?>
				<div class="tf-button-circle">
							<a href="<?php echo esc_url( $settings['link']['url'] ) ?>" class="tf-button-inner" <?php echo $target; echo $nofollow; ?> >
								<?php
									if ( $is_new || $migrated ) {
										if ( isset($settings['icon_button']['value']['url']) ) {
											\Elementor\Icons_Manager::render_icon( $settings['icon_button'], [ 'aria-hidden' => 'true' ] );
										}else {
											echo '<i class="' . esc_attr($settings['icon_button']['value']) . '" aria-hidden="true"></i>';
										}									
									} else {
										echo '<i class="' . esc_attr($settings['icon_bt']) . ' aria-hidden="true""></i>';
									}
								?> 
							</a>
				</div>
				<?php endif; ?>
			</div>
		<?php else: ?>
			<div class="tficonbox <?php echo esc_attr($settings['position']); ?>">
				<?php if ($settings['icon_style'] == 'icon'): ?>
					<div class="wrap-icon <?php echo esc_attr($settings['icon_showcase']); ?>">
						<div class="wrap-icon-inner <?php echo esc_attr($settings['icon_style']); ?> <?php echo esc_attr($settings['icon_animation']); ?>">
							<?php echo $icon_button; ?>
						</div>
					</div>
				<?php endif; ?>	

				<div class="content">
					<div class="inner">
						<<?php echo esc_attr($settings['title_tag']);?> class="title"><?php echo esc_attr($settings['title_text']); ?></<?php echo esc_attr($settings['title_tag']);?>>
						<?php echo sprintf('<div class="description">%s</div>', $settings['description_text']); ?>
					</div>
					
					<?php if ( $settings['show_button'] == 'yes' ): ?>
						<div class="tf-button-container <?php echo esc_attr($settings['button_align']); ?>">
							<a href="<?php echo esc_url( $settings['link']['url'] ) ?>" class="tf-button <?php echo esc_attr($settings['button_icon_position']); ?> <?php echo esc_attr($btn_animation); ?> <?php echo esc_attr($btn_line); ?>" <?php echo $target; echo $nofollow; ?> >
								<?php
								if ($settings['button_icon_position'] == 'bt_icon_before' ) {
									if ( $is_new || $migrated ) {
										if ( isset($settings['icon_button']['value']['url']) ) {
											\Elementor\Icons_Manager::render_icon( $settings['icon_button'], [ 'aria-hidden' => 'true' ] );
										}else {
											echo '<i class="' . esc_attr($settings['icon_button']['value']) . '" aria-hidden="true"></i>';
										}									
									} else {
										echo '<i class="' . esc_attr($settings['icon_bt']) . ' aria-hidden="true""></i>';
									}
								}

								if ( $settings['button_text'] != '' ) {
									echo esc_attr( $settings['button_text'] );
								}

								if ($settings['button_icon_position'] == 'bt_icon_after' ) {
									if ( $is_new || $migrated ) {
										if ( isset($settings['icon_button']['value']['url']) ) {
											\Elementor\Icons_Manager::render_icon( $settings['icon_button'], [ 'aria-hidden' => 'true' ] );
										}else {
											echo '<i class="' . esc_attr($settings['icon_button']['value']) . '" aria-hidden="true"></i>';
										}									
									} else {
										echo '<i class="' . esc_attr($settings['icon_bt']) . ' aria-hidden="true""></i>';
									}
								}

								?> 
							</a>
						</div>
					<?php endif; ?>

				</div>
			</div>
		<?php
			endif;
	}	

}