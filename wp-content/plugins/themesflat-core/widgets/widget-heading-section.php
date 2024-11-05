<?php
class TFHeadingSection_Widget extends \Elementor\Widget_Base {

	public function get_name() {
        return 'tf-heading-section';
    }
    
    public function get_title() {
        return esc_html__( 'TF Heading Section', 'themesflat-core' );
    }

    public function get_icon() {
        return 'eicon-t-letter';
    }
    
    public function get_categories() {
        return [ 'themesflat_addons' ];
    }

    public function get_style_depends() {
		return ['tf-heading-section'];
	}

	protected function register_controls() {
		// Start Tab Heading Section        
			$this->start_controls_section( 'section_title_section',
	            [
	                'label' => esc_html__('Heading Section', 'themesflat-core'),
	            ]
	        );

	        $this->add_control(
                'style',
                [
                    'label' => esc_html__( 'Style', 'themesflat-core' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'style1',
                    'options' => [
                        'style1'  => esc_html__( 'Style 1', 'themesflat-core' ),
                        'style2' => esc_html__( 'Style 2', 'themesflat-core' ),
                    ],
                ]
            );        

			$this->add_control( 
	        	'html_tag',
				[
					'label' => esc_html__( 'HTML Tag', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'h2',
					'options' => [
						'h1' => esc_html__( 'H1', 'themesflat-core' ),
						'h2' => esc_html__( 'H2', 'themesflat-core' ),
						'h3' => esc_html__( 'H3', 'themesflat-core' ),
						'h4' => esc_html__( 'H4', 'themesflat-core' ),
						'h5' => esc_html__( 'H5', 'themesflat-core' ),
						'h6' => esc_html__( 'H6', 'themesflat-core' ),
						'span' => esc_html__( 'span', 'themesflat-core' ),
						'p' => esc_html__( 'p', 'themesflat-core' ),
						'div' => esc_html__( 'div', 'themesflat-core' ),
					],
				]
			);	

			$this->add_control(
				'before_title',
				[
					'label' => esc_html__( 'Before Heading', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'About Company', 'themesflat-core' ),
					'label_block' => true,
				]
			);		

			$this->add_control(
				'heading',
				[
					'label' => esc_html__( 'Heading', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::WYSIWYG,					
					'default' => esc_html__( 'Professional Solar Enery solutions comapny', 'themesflat-core' ),
					'label_block' => true,
				]
			);		

			$this->add_control(
				'align',
				[
					'label' => esc_html__( 'Alignment', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'default' => 'left',
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
						]
					],
					'selectors' => [
						'{{WRAPPER}} .tf-heading-section .heading-section' => 'text-align: {{VALUE}}',
					],
				]
			);
	        
			$this->end_controls_section();
        // /.End Tab Heading Section    

        // Start Tab Blurred Text        
			$this->start_controls_section( 'section_blurred_text',
	            [
	                'label' => esc_html__('Blurred Text', 'themesflat-core'),
	            ]
	        ); 
	        $this->add_control(
				'blurred_text',
				[
					'label' => esc_html__( 'Blurred Text', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'About Company', 'themesflat-core' ),
					'label_block' => true,
				]
			);
			$this->add_control(
				'align_blurred_text',
				[
					'label' => esc_html__( 'Alignment Blurred Text', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'default' => 'left',
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
						]
					],
					'selectors' => [
						'{{WRAPPER}} .tf-heading-section .blurred-text' => 'text-align: {{VALUE}}',
					],
				]
			);
	    	$this->end_controls_section();
        // /.End Tab Blurred Text     

	    // Start Style
	        $this->start_controls_section( 'section_style',
	            [
	                'label' => esc_html__( 'Style', 'themesflat-core' ),
	                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
	            ]
	        );

	        $this->add_control(
				'h_before_title',
				[
					'label' => esc_html__( 'Before Heading', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]
			);
			$this->add_group_control( 
	        	\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'typography_before_title',
					'label' => esc_html__( 'Typography', 'themesflat-core' ),
					'fields_options' => [
				        'typography' => ['default' => 'yes'],
				        'font_family' => [
				            'default' => 'Rubik',
				        ],
				        'font_size' => [
				            'default' => [
				                'unit' => 'px',
				                'size' => '16',
				            ],
				        ],
				        'font_weight' => [
				            'default' => '500',
				        ],
				        'line_height' => [
				            'default' => [
				                'unit' => 'em',
				                'size' => '1',
				            ],
				        ],
				        'text_transform' => [
							'default' => 'uppercase',
						],
				    ],
					'selector' => '{{WRAPPER}} .tf-heading-section .before-title',
				]
			);
			$this->add_control( 
				'color_before_title',
				[
					'label' => esc_html__( 'Color', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#ffffff',
					'selectors' => [
						'{{WRAPPER}} .tf-heading-section .before-title' => 'color: {{VALUE}}',
						'{{WRAPPER}} .tf-heading-section.style2 .before-title:before' => 'background-color: {{VALUE}}',					
					],
				]
			);
			$this->add_control( 
				'bg_color_before_title',
				[
					'label' => esc_html__( 'Background Color', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#ff7029',
					'selectors' => [
						'{{WRAPPER}} .tf-heading-section .before-title' => 'background-color: {{VALUE}}',
					],
					'condition' => [
						'style' => 'style1',
					],
				]
			);
			$this->add_responsive_control(
				'margin_before_title',
				[
					'label' => esc_html__( 'Margin', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'default' => [
						'top' => '0',
						'right' => '0',
						'bottom' => '0',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => false,
					],
					'selectors' => [
						'{{WRAPPER}} .tf-heading-section .before-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);	

	        $this->add_control(
				'h_heading',
				[
					'label' => esc_html__( 'Heading', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_group_control( 
	        	\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'typography',
					'label' => esc_html__( 'Typography', 'themesflat-core' ),
					'fields_options' => [
				        'typography' => ['default' => 'yes'],
				        'font_family' => [
				            'default' => 'Teko',
				        ],
				        'font_size' => [
				            'default' => [
				                'unit' => 'px',
				                'size' => '45',
				            ],
				        ],
				        'font_weight' => [
				            'default' => '500',
				        ],
				        'line_height' => [
				            'default' => [
				                'unit' => 'em',
				                'size' => '1',
				            ],
				        ],
				        'text_transform' => [
							'default' => 'uppercase',
						],
						'letter_spacing' => [
				            'default' => [
				                'unit' => 'px',
				                'size' => '0',
				            ],
				        ],
				    ],
					'selector' => '{{WRAPPER}} .tf-heading-section .heading',
				]
			); 
			$this->add_control( 
				'heading_color',
				[
					'label' => esc_html__( 'Color', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#1F242C',
					'selectors' => [
						'{{WRAPPER}} .tf-heading-section .heading' => 'color: {{VALUE}}',					
					],
				]
			);
			$this->add_responsive_control(
				'heading_margin',
				[
					'label' => esc_html__( 'Margin', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'default' => [
						'top' => '30',
						'right' => '0',
						'bottom' => '0',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => false,
					],
					'selectors' => [
						'{{WRAPPER}} .tf-heading-section .heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);			

			$this->add_control(
				'h_blurred_text',
				[
					'label' => esc_html__( 'Blurred Text', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_group_control( 
	        	\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'blurred_text_typography',
					'label' => esc_html__( 'Typography', 'themesflat-core' ),
					'fields_options' => [
				        'typography' => ['default' => 'yes'],				        
				        'font_family' => [
				            'default' => 'Teko',
				        ],
				        'font_size' => [
				            'default' => [
				                'unit' => 'px',
				                'size' => '250',
				            ],
				        ],
				        'font_weight' => [
				            'default' => '700',
				        ],
				        'line_height' => [
				            'default' => [
				                'unit' => 'em',
				                'size' => '1',
				            ],
				        ],
				        'text_transform' => [
							'default' => '',
						],
						'letter_spacing' => [
				            'default' => [
				                'unit' => 'px',
				                'size' => '0',
				            ],
				        ],
				    ],

					'selector' => '{{WRAPPER}} .tf-heading-section .blurred-text',
				]
			);
			$this->add_control( 
				'blurred_text_color',
				[
					'label' => esc_html__( 'Stroke color', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => 'rgba(31,36,44,0.07)',
					'selectors' => [
						'{{WRAPPER}} .tf-heading-section .blurred-text' => '-webkit-text-stroke-color: {{VALUE}}',					
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'blurred_text_background',
					'label' => esc_html__( 'Background', 'plugin-domain' ),
					'types' => [ 'gradient' ],
					'selector' => '{{WRAPPER}} .tf-heading-section .blurred-text',
				]
			);

			$this->add_responsive_control(
				'blurred_text_margin',
				[
					'label' => esc_html__( 'Margin', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'default' => [
						'top' => '-132',
						'right' => '0',
						'bottom' => '0',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => false,
					],
					'selectors' => [
						'{{WRAPPER}} .tf-heading-section .blurred-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'blurred_text_padding',
				[
					'label' => esc_html__( 'Padding', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'default' => [
						'top' => '0',
						'right' => '0',
						'bottom' => '0',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => false,
					],
					'selectors' => [
						'{{WRAPPER}} .tf-heading-section .blurred-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);					
			        
        	$this->end_controls_section();    
	    // /.End Style 
	}

	protected function render($instance = []) {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'tf_heading_section', ['id' => "tf-heading-section-{$this->get_id()}", 'class' => ['tf-heading-section' ,$settings['style']], 'data-tabid' => $this->get_id()] );

		$animation = ! empty( $settings['hover_animation'] ) ? 'elementor-animation-' . esc_attr( $settings['hover_animation'] . ' inline-block' ) : '';

		$heading = $blurred_text = $before_title = '';		

		if ($settings['heading'] != '') {
			$heading = sprintf( '<%1$s class="heading">%2$s</%1$s>',$settings['html_tag'], $settings['heading'] );
		}

		if ($settings['blurred_text'] != '') {
			$blurred_text = sprintf( '<div class="blurred-text">%1$s</div>', $settings['blurred_text'] );
		}		

		if ($settings['before_title'] != '') {
			$before_title = sprintf( '<div class="before-title">%1$s</div>', $settings['before_title'] );
		}
		
		$content = sprintf( '
			<div class="heading-section">
				%2$s
				%1$s
				%3$s
			</div>' , $heading, $before_title, $blurred_text );

		echo sprintf ( 
			'<div %1$s> 
				%2$s                
            </div>',
            $this->get_render_attribute_string('tf_heading_section'),
            $content
        );	
		
	}

}