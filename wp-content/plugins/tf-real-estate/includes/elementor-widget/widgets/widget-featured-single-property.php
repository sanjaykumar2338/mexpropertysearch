<?php
class Widget_Featured_Single_Property extends \Elementor\Widget_Base {
	public function get_name() {
		return 'tf_featured_single_property';
	}

	public function get_title() {
		return esc_html__( 'TF Featured Single Property', 'tf-real-estate' );
	}

	public function get_icon() {
		return 'eicon-single-page';
	}

	public function get_categories() {
		return [ 'themesflat_real_estate_addons' ];
	}

	public function get_keywords() {
		return [ 'property', 'single' ];
	}

	public function get_style_depends() {
		return [ 'owl-carousel', 'properties-styles' ];
	}

	public function get_script_depends() {
		return [ 'owl-carousel', 'properties-script' ];
	}

	protected function register_controls() {
		// Start property Query        
		$this->start_controls_section(
			'section_property_query',
			[ 
				'label' => esc_html__( 'Query', 'tf-real-estate' ),
			]
		);

		$this->add_control(
			'style',
			[ 
				'label'   => esc_html__( 'Style', 'tf-real-estate' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [ 
					'style1' => esc_html__( 'Style 1', 'tf-real-estate' ),
					'style2' => esc_html__( 'Style 2', 'tf-real-estate' ),
				],
			]
		);

		$this->add_control(
			'property_id',
			[ 
				'label'       => esc_html__( 'Property ID', 'tf-real-estate' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Property Id Will Be Display. Ex: 123', 'tf-real-estate' ),
				'default'     => '',
				'label_block' => true,
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
	}

	protected function render( $instance = [] ) {
		$settings         = $this->get_settings_for_display();
		$attr['settings'] = $settings;
		?>
		<div class="tf-property-wrap widget-single-property">
			<div class="wrap-property-post">
				<?php tfre_get_template_widget_elementor( "templates/single-property/{$settings['style']}", $attr ); ?>
			</div>
		</div>
		<?php
	}
}