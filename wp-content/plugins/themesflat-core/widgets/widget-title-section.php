<?php
class TFTitle_Section_Widget extends \Elementor\Widget_Base {

	public function get_name() {
        return 'tf-title-section';
    }
    
    public function get_title() {
        return esc_html__( 'TF Title Section', 'themesflat-core' );
    }

    public function get_icon() {
        return 'eicon-t-letter';
    }
    
    public function get_categories() {
        return [ 'themesflat_addons' ];
    }

    public function get_style_depends() {
		return ['tf-title-section'];
	}

	public function get_script_depends() {
		return ['split', 'tf-title'];
	}

	protected function register_controls() {
		// Start Tab Setting        
			$this->start_controls_section( 'section_tabs',
	            [
	                'label' => esc_html__('Title Section', 'themesflat-core'),
	            ]
	        );	 
			
			$this->add_control( 
				'animation_heading',
				[
					'label' => esc_html__( 'Enable Animation Heading', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Enable', 'themesflat-core' ),
					'label_off' => esc_html__( 'Disable', 'themesflat-core' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control( 
				'enable_divider',
				[
					'label' => esc_html__( 'Enable Divider Line', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Enable', 'themesflat-core' ),
					'label_off' => esc_html__( 'Disable', 'themesflat-core' ),
					'return_value' => 'yes',
					'default' => 'no',
				]
			);

			$this->add_control( 
	        	'html_tag',
				[
					'label' => esc_html__( 'HTML Tag', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'h3',
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
				'heading',
				[
					'label' => esc_html__( 'Heading', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,					
					'default' => esc_html__( 'A highly trusted wealth management firm', 'themesflat-core' ),
					'label_block' => true,
				]
			);

			$this->add_control(
				'description',
				[
					'label' => esc_html__( 'Description', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::WYSIWYG,					
					'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis.', 'themesflat-core' ),
					'label_block' => true,
				]
			);	

			$this->add_responsive_control(
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
						'{{WRAPPER}} .tf-title-section .title-section' => 'text-align: {{VALUE}}',
					],
				]
			);
	        
			$this->end_controls_section();
        // /.End Tab Setting         

	    // Start Style
	        $this->start_controls_section( 'section_style',
	            [
	                'label' => esc_html__( 'Style', 'themesflat-core' ),
	                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
					'selector' => '{{WRAPPER}} .tf-title-section .title-section .heading',
				]
			); 

			$this->add_control( 
				'heading_color',
				[
					'label' => esc_html__( 'Color', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-title-section .title-section .heading' => 'color: {{VALUE}}',					
					],
				]
			);			

			$this->add_responsive_control(
				'heading_margin',
				[
					'label' => esc_html__( 'Margin', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .tf-title-section .title-section .heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'h_description',
				[
					'label' => esc_html__( 'Description', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			

			$this->add_group_control( 
	        	\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'typography_desc',
					'label' => esc_html__( 'Typography', 'themesflat-core' ),
					'selector' => '{{WRAPPER}} .tf-title-section .title-section .description',
				]
			); 

			$this->add_control( 
				'description_color_desc',
				[
					'label' => esc_html__( 'Color', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-title-section .title-section .description' => 'color: {{VALUE}}',					
					],
				]
			);	
			
			$this->add_responsive_control(
				'description_padding_desc',
				[
					'label' => esc_html__( 'Padding', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .tf-title-section .title-section .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'description_margin_desc',
				[
					'label' => esc_html__( 'Margin', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .tf-title-section .title-section .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);



			        
        	$this->end_controls_section();    
	    // /.End Style 
	}

	protected function render($instance = []) {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'tf_title_section', ['id' => "tf-title-section-{$this->get_id()}", 'class' => ['tf-title-section tf-split-text style1'], 'data-tabid' => $this->get_id()] );

		$animation_heading = $settings['animation_heading'] == 'yes' ? 'data-splitting' : '';

		$heading = $description = $enable_divider = '';		

		if ($settings['heading'] != '') {
			$heading = sprintf( '<%1$s class="heading" %3$s>%2$s</%1$s>',$settings['html_tag'], $settings['heading'], $animation_heading );
		}	
		
		if ($settings['enable_divider'] == 'yes') {
			$enable_divider = sprintf( '<div class="divider-line"></div>');
		}

		if ($settings['description'] != '') {
			$description = sprintf( '<div class="description">%1$s</div>', $settings['description'] );
		}
		


			$content = sprintf( '
				<div class="title-section">
					%1$s
					%3$s
					%2$s
				</div>' , $heading, $description, $enable_divider );

		echo sprintf ( 
			'<div %1$s> 
				%2$s                
            </div>',
            $this->get_render_attribute_string('tf_title_section'),
            $content
        );	
		
	}

}

