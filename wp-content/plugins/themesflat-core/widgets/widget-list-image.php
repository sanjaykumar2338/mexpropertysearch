<?php
class TFListImage_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tf-list-image';
	}

	public function get_title() {
		return esc_html__( 'TF Partner', 'themesflat-core' );
	}

	public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_categories() {
		return [ 'themesflat_addons' ];
	}

	public function get_style_depends() {
		return [ 'tf-list-image' ];
	}

	protected function register_controls() {
		// Start List Setting        
		$this->start_controls_section( 'section_setting',
			[ 
				'label' => esc_html__( 'Setting', 'themesflat-core' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[ 
				'label'   => esc_html__( 'Choose Image', 'themesflat-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [ 
					'url' => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME . "assets/img/partner.png",
				],
			]
		);

		$repeater->add_control(
			'link_image',
			[ 
				'label'       => esc_html__( 'Link', 'themesflat-core' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'themesflat-core' ),
				'default'     => [ 
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => false,
				],
			]
		);

		$this->add_control(
			'list',
			[ 
				'label'   => esc_html__( 'List', 'themesflat-core' ),
				'type'    => \Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [ 
					[ 
						'image' => esc_html__( '', 'themesflat-core' ),
						'link'  => esc_html__( '#', 'themesflat-core' ),
					],
					[ 
						'image' => esc_html__( '', 'themesflat-core' ),
						'link'  => esc_html__( '#', 'themesflat-core' ),
					],
					[ 
						'image' => esc_html__( '', 'themesflat-core' ),
						'link'  => esc_html__( '#', 'themesflat-core' ),
					],
					[ 
						'image' => esc_html__( '', 'themesflat-core' ),
						'link'  => esc_html__( '#', 'themesflat-core' ),
					],
					[ 
						'image' => esc_html__( '', 'themesflat-core' ),
						'link'  => esc_html__( '#', 'themesflat-core' ),
					],
					[ 
						'image' => esc_html__( '', 'themesflat-core' ),
						'link'  => esc_html__( '#', 'themesflat-core' ),
					],
					[ 
						'image' => esc_html__( '', 'themesflat-core' ),
						'link'  => esc_html__( '#', 'themesflat-core' ),
					],
					[ 
						'image' => esc_html__( '', 'themesflat-core' ),
						'link'  => esc_html__( '#', 'themesflat-core' ),
					],
				],
			]
		);

		$this->add_control(
			'hover_ani',
			[ 
				'label'        => esc_html__( 'Enable Animation', 'themesflat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'themesflat-core' ),
				'label_off'    => esc_html__( 'Off', 'themesflat-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'hover_image',
			[ 
				'label'        => esc_html__( 'Enable Hover Images', 'themesflat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'themesflat-core' ),
				'label_off'    => esc_html__( 'Off', 'themesflat-core' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'hover_stop',
			[ 
				'label'        => esc_html__( 'Hover Stop', 'themesflat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'themesflat-core' ),
				'label_off'    => esc_html__( 'Off', 'themesflat-core' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);


		$this->end_controls_section();
		// /.End List Setting              

		// Start Style
		$this->start_controls_section( 'section_style',
			[ 
				'label' => esc_html__( 'Style', 'themesflat-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'h_image',
			[ 
				'label' => esc_html__( 'Image', 'themesflat-core' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'image_size',
			[ 
				'label'      => esc_html__( 'Width', 'themesflat-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [ 
					'px' => [ 
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [ 
					'{{WRAPPER}} .tf-list-image .box-item .item  ' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_size_h',
			[ 
				'label'      => esc_html__( 'Height', 'themesflat-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [ 
					'px' => [ 
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [ 
					'{{WRAPPER}} .tf-list-image .box-item .item  ' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_size_spc',
			[ 
				'label'      => esc_html__( 'Spacing', 'themesflat-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [ 
					'px' => [ 
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [ 
					'{{WRAPPER}} .tf-list-image .box-item .item' => 'padding-left: {{SIZE}}{{UNIT}};padding-right: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();
		// /.End Style 
	}

	protected function render( $instance = [] ) {
		$settings = $this->get_settings_for_display();

		$hover_image = $settings['hover_image'] == 'yes' ? 'hover-image' : '';
		$hover_stop  = $settings['hover_stop'] == 'yes' ? 'hover-stop' : '';
		$hover_ani  = $settings['hover_ani'] == 'yes' ? 'animation-image' : '';

		$this->add_render_attribute( 'tf_list-image', [ 'id' => "tf-list-image-{$this->get_id()}", 'class' => [ 'tf-list-image', $hover_image, $hover_stop, $hover_ani ], 'data-tabid' => $this->get_id() ] );

		$content = $title = $before_title = $hover_image = '';



		foreach ( $settings['list'] as $index => $item ) {
			$link_image = $item['link_image']['url'];
			$target     = $item['link_image']['is_external'] ? ' target="_blank"' : '';
			$nofollow   = $item['link_image']['nofollow'] ? ' rel="nofollow"' : '';
			$image_thumb =  \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item, 'thumbnail','image' );
			if ( $item['image'] != '' ) {
					
						$image = sprintf( '<div class="image">
						<a href="%2$s" %3$s %4$s>%1$s</a>
					</div>', $image_thumb, $link_image, $target, $nofollow );
			}

			$content .= sprintf( '<div class="item">
										%1$s
									</div>
								', $image );
		}

		echo sprintf(
			'<div %1$s> 
				<div class="box-item">
				%2$s   
				</div>
				<div class="box-item">
				%2$s   
				</div>	
            </div>',
			$this->get_render_attribute_string( 'tf_list-image' ),
			$content
		);
	}
}