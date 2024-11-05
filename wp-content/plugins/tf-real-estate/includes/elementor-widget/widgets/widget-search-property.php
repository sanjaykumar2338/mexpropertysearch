<?php
class Widget_Search_Property extends \Elementor\Widget_Base
{
    protected $fields_search_advanced;
    protected $search_advanced_top_default;
    protected $search_advanced_bottom_default;
    protected $search_advanced_bottom_mobile_default;
    public function get_name() {
        return 'tf_search_property';
    }

    public function get_title() {
        return esc_html__('TF Search Property', 'tf-real-estate');
    }

    public function get_icon() {
        return 'eicon-search';
    }

    public function get_categories() {
        return [ 'themesflat_real_estate_addons' ];
    }

    public function get_keywords() {
        return [ 'search', 'property' ];
    }

    public function get_style_depends() {
        return [ 'search-property-styles', 'swiper-min-style' ];
    }

    public function get_script_depends() {
        return [ 'search-property-script', 'swiper-min-script' ];
    }

    protected function register_controls() {
        $this->fields_search_advanced = array(
            'keyword'               => esc_html__('Keyword', 'tf-real-estate'),
            'property-type'         => esc_html__('Property type', 'tf-real-estate'),
            'property-country'      => esc_html__('Property country', 'tf-real-estate'),
            'property-title'        => esc_html__('Property title', 'tf-real-estate'),
            'property-address'      => esc_html__('Property Address', 'tf-real-estate'),
            'property-label'        => esc_html__('Property label', 'tf-real-estate'),
            'province-state'        => esc_html__('Property province state', 'tf-real-estate'),
            'property-neighborhood' => esc_html__('Property neighborhood', 'tf-real-estate'),
            'property-rooms'        => esc_html__('Property rooms', 'tf-real-estate'),
            'property-bathrooms'    => esc_html__('Property bathrooms', 'tf-real-estate'),
            'property-bedrooms'     => esc_html__('Property bedrooms', 'tf-real-estate'),
            'property-garage'       => esc_html__('Property garage', 'tf-real-estate'),
            'property-garage-size'  => esc_html__('Property garage size', 'tf-real-estate'),
            'property-price'        => esc_html__('Property Price', 'tf-real-estate'),
            'property-size'         => esc_html__('Property Size', 'tf-real-estate'),
            'property-land-size'    => esc_html__('Property land size', 'tf-real-estate'),
            'property-feature'      => esc_html__('Property feature', 'tf-real-estate'),
        );

        $this->search_advanced_top_default    = array(
            'keyword',
            'property-type',
            'property-country'
        );

        $this->search_advanced_bottom_default = $this->search_advanced_bottom_mobile_default = array(
            'province-state',
            'property-neighborhood',
            'property-rooms',
            'property-bathrooms',
            'property-bedrooms',
            'property-price',
            'property-size',
            'property-feature',
        );

        // Start Settings        
        $this->start_controls_section(
            'section_search_settings',
            [
                'label' => esc_html__('Settings', 'tf-real-estate'),
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
                ],
            ]
        );

        $this->add_control(
            'heading_search',
            [
                'label' => esc_html__( 'Heading', 'tf-real-estate' ),
                'type' => \Elementor\Controls_Manager::TEXT,				
                'label_block' => true,
                'condition' => [
                    'style'	=> 'style2',
                ],
            ]
        );

        $this->add_control(
            'show_input_icon',
            [
                'label' => esc_html__( 'Show Input Icon', 'tf-real-estate' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tf-real-estate' ),
                'label_off' => esc_html__( 'Hide', 'tf-real-estate' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'search_advanced_top',
            [
                'label'       => esc_html__('Search Advanced Field Top', 'tf-real-estate'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'options'     => $this->fields_search_advanced,
                'label_block' => true,
                'multiple'    => true,
                'default'     => $this->search_advanced_top_default,
            ]
        );

        $this->add_control(
            'search_advanced_bottom',
            [
                'label'       => esc_html__('Search Advanced Field Bottom', 'tf-real-estate'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'options'     => $this->fields_search_advanced,
                'label_block' => true,
                'multiple'    => true,
                'default'     => $this->search_advanced_bottom_default
            ]
        );

        $this->add_control(
            'align_search_bottom',
            [
                'label' => esc_html__( 'Alignment Absolute Search Bottom', 'tf-real-estate' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'unset'    => [
                        'title' => esc_html__( 'Left', 'tf-real-estate' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    '0' => [
                        'title' => esc_html__( 'Right', 'tf-real-estate' ),
                        'icon' => 'eicon-text-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .tf-search-wrap.style2 .search-properties-form .tf-search-form .tf-search-form-bottom.desktop' => 'left: {{VALUE}}; right: unset;',
                ],
                'condition' => [
                    'style'	=> 'style2',
                ],
            ]
        );

        $this->add_control(
            'search_advanced_mobile',
            [
                'label'       => esc_html__('Search Advanced Field Mobile', 'tf-real-estate'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'options'     => $this->fields_search_advanced,
                'label_block' => true,
                'multiple'    => true,
                'default'     => $this->search_advanced_bottom_mobile_default
            ]
        );

        $this->end_controls_section();
        // /.End Settings

        // Start general Style       
        $this->start_controls_section(
            'section_style_general',
            [
                'label' => esc_html__('General', 'tf-real-estate'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'disable_border_radius_input',
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
            'heading_status_tab',
            [
                'label'     => esc_html__('Status Tab', 'tf-real-estate'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
			'status_tab_align',
			[
				'label' => esc_html__( 'Alignment', 'tf-real-estate' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Left', 'tf-real-estate' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'tf-real-estate' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__( 'Right', 'tf-real-estate' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'start',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .tf-search-wrap .search-properties-form' => 'align-items: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs('status_tabs');
		$this->start_controls_tab(
			'status_normal_tab',
			[ 
				'label' => esc_html__( 'Normal', 'tf-real-estate' ),
			]
		);

        $this->add_control(
			'status_tab_color',
			[ 
				'label'     => esc_html__( 'Color Button', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .tf-search-wrap .search-properties-form .tf-search-status-tab .btn-status-filter' => 'color: {{VALUE}} !important',
				],
			]
		);

        $this->add_control(
			'status_tab_background',
			[ 
				'label'     => esc_html__( 'Background Button', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .tf-search-wrap .search-properties-form .tf-search-status-tab .btn-status-filter, {{WRAPPER}} .disable-border-radius-input .tf-search-status-tab .btn-status-filter::after' => 'background-color: {{VALUE}} !important',
				],
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
			'status_hover_tab',
			[ 
				'label' => esc_html__( 'Hover', 'tf-real-estate' ),
			]
		);

        $this->add_control(
			'status_tab_color_active',
			[ 
				'label'     => esc_html__( 'Color Button Hover & Active', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .tf-search-wrap .search-properties-form .tf-search-status-tab .btn-status-filter.active, {{WRAPPER}} .tf-search-wrap .search-properties-form .tf-search-status-tab .btn-status-filter:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

        $this->add_control(
			'status_tab_background_active',
			[ 
				'label'     => esc_html__( 'Background Button Hover & Active', 'tf-real-estate' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .tf-search-wrap .search-properties-form .tf-search-status-tab .btn-status-filter.active, {{WRAPPER}} .tf-search-wrap .search-properties-form .tf-search-status-tab .btn-status-filter:hover, {{WRAPPER}} .disable-border-radius-input .tf-search-status-tab .btn-status-filter.active::after' => 'background-color: {{VALUE}} !important',
				],
			]
		);

        $this->end_controls_tab();
		$this->end_controls_tabs();

        $this->add_control(
            'heading_search_form',
            [
                'label'     => esc_html__('Search Form', 'tf-real-estate'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
			'search_form_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'tf-real-estate'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '0',
					'right'    => '10',
					'bottom'   => '10',
					'left'     => '10',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .tf-search-wrap .search-properties-form .tf-search-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

        $this->end_controls_section();
        // /.End general Style 
    }

    protected function render($instance = []) {
        $settings = $this->get_settings_for_display();
        
        $this->add_render_attribute('tf_search_wrap', [ 'id' => "tf-search-{$this->get_id()}", 'class' => [ 'tf-search-wrap', $settings['style'] ], 'data-tabid' => $this->get_id() ]);

        $attrs = array(
            'layout'                   => "tab",
            'column'                   => 3,
            'color_scheme'             => "color-dark",
            'status_enable'            => tfre_get_show_hide_field('property-status', 'advanced_search_fields'),
        );

        $status_enable = $color_scheme = '';

        extract(
            shortcode_atts(
                array(
                    'layout'                   => 'tab',
                    'column'                   => '3',
                    'color_scheme'             => 'color-light',
                    'status_enable'            => 'true',
                ),
                $attrs
            )
        );
        $status_default = '';
        $value_status           = isset($_GET['status']) ? (wp_unslash($_GET['status'])) : $status_default;

        $options              = array(
            'ajax_url' => esc_url(TF_AJAX_URL),
        );
        $wrapper_class        = 'tfre-property-advanced-search widget-elementor-advanced-search clearfix';
        $wrapper_classes      = array(
            $wrapper_class,
            $layout,
            $color_scheme,
        );
        $show_input_icon = $settings['show_input_icon'] == 'yes' ? 'has-input-icon' : '';
        $disable_border_radius_input = $settings['disable_border_radius_input'] == 'yes' ? ' disable-border-radius-input' : '';
        ?>
        <div data-options="<?php echo esc_attr(json_encode($options)); ?>"
            class="<?php echo esc_attr(join(' ', $wrapper_classes)) ?> <?php echo $show_input_icon; echo $disable_border_radius_input; ?>">
            <div class="form-search-wrap">
                <div class="form-search-inner">
                    <div <?php echo $this->get_render_attribute_string('tf_search_wrap'); ?>>
                        <?php
                        $attr['settings'] = $settings;
                        $attr['status_enable'] = $status_enable;
                        $attr['value_status'] = $value_status;
                        $attr['layout'] = $layout;
                        tfre_get_template_widget_elementor("templates/search/{$settings['style']}", $attr); 
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}