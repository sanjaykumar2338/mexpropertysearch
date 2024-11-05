<?php
class TFPosts_Widget extends \Elementor\Widget_Base {

	public function get_name() {
        return 'tfposts';
    }
    
    public function get_title() {
        return esc_html__( 'TF Posts', 'themesflat-core' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }
    
    public function get_categories() {
        return [ 'themesflat_addons' ];
    }

    public function get_style_depends() {
		return ['tf-posts'];
	}

	protected function register_controls() {
        // Start Posts Query        
			$this->start_controls_section( 
				'section_posts_query',
	            [
	                'label' => esc_html__('Query', 'themesflat-core'),
	            ]
	        );	

			$this->add_control( 
				'posts_per_page',
	            [
	                'label' => esc_html__( 'Posts Per Page', 'themesflat-core' ),
	                'type' => \Elementor\Controls_Manager::NUMBER,
	                'default' => '3',
	            ]
	        );

	        $this->add_control( 
	        	'order_by',
				[
					'label' => esc_html__( 'Order By', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'date',
					'options' => [						
			            'date' => esc_html__( 'Date', 'themesflat-core' ),
			            'ID' => esc_html__( 'Post ID', 'themesflat-core' ),			            
			            'title' => esc_html__( 'Title', 'themesflat-core' ),
					],
				]
			);

			$this->add_control( 
				'order',
				[
					'label' => esc_html__( 'Order', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'desc',
					'options' => [						
			            'desc' => esc_html__( 'Descending', 'themesflat-core' ),
			            'asc' => esc_html__( 'Ascending', 'themesflat-core' ),	
					],
				]
			);

			$this->add_control( 
				'posts_categories',
				[
					'label' => esc_html__( 'Categories', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'options' => ThemesFlat_Addon_For_Elementor_dreamhome::tf_get_taxonomies(),
					'label_block' => true,
	                'multiple' => true,
				]
			);

			$this->add_control( 
				'exclude',
				[
					'label' => esc_html__( 'Exclude', 'themesflat-core' ),
					'type'	=> \Elementor\Controls_Manager::TEXT,	
					'description' => esc_html__( 'Post Ids Will Be Inorged. Ex: 1,2,3', 'themesflat-core' ),
					'default' => '',
					'label_block' => true,				
				]
			);

			$this->add_control(
				'disable_border_radius',
				[
					'label' => esc_html__( 'Disable All Border Radius', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Yes', 'themesflat-core' ),
					'label_off' => esc_html__( 'No', 'themesflat-core' ),
					'return_value' => 'yes',
					'default' => 'no',
				]
			);

			$this->end_controls_section();
        // /.End Posts Query

		// Start Layout        
			$this->start_controls_section( 
				'section_posts_layout',
	            [
	                'label' => esc_html__('Layout', 'themesflat-core'),
	            ]
	        );	

			$this->add_control(
				'post_layout_align',
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
					],
					'selectors' => [
						'{{WRAPPER}} .tf-posts' => 'text-align: {{VALUE}}',
						'{{WRAPPER}} .tf-posts .blog-post .meta-post' => 'justify-content: {{VALUE}}',
					],
				]
			);

			$this->add_control( 
				'heading_image',
				[
					'label' => esc_html__( 'Image', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_group_control( 
				\Elementor\Group_Control_Image_Size::get_type(),
				[
					'name' => 'thumbnail',
					'default' => 'full',
				]
			);

			$this->add_responsive_control( 
				'h_image_height',
				[
					'label' => esc_html__( 'Image Height', 'themesflat-core' ),
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
						'{{WRAPPER}} .tf-posts .blog-post .featured-post img' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control( 
				'heading_content',
				[
					'label' => esc_html__( 'Content', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);	

			$this->add_control( 
				'heading_button',
				[
					'label' => esc_html__( 'Button', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control( 
				'button_text',
				[
					'label' => esc_html__( 'Button Text', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Read more', 'themesflat-core' ),
					'condition' => [
	                    'show_button'	=> 'yes',
	                ],
				]
			);		

			$this->add_control(
				'post_icon_readmore',
				[
					'label' => esc_html__( 'Button Icon ', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'icon-dreamhome-arrow-right',
						'library' => 'theme_icon',
					],
				]
			);

			$this->add_control( 
				'heading_meta',
				[
					'label' => esc_html__( 'Meta', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'category_icon',
				[
					'label' => esc_html__( 'Category Icon', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'icon-dreamhome-folder',
						'library' => 'theme_icon',
					],
				]
			);      
			
			$this->end_controls_section();
        // /.End Layout
	}

	protected function render($instance = []) {
		$settings = $this->get_settings_for_display();

		$disable_border_radius = $settings['disable_border_radius'] == 'yes' ? ' disable-border-radius' : '';

		$this->add_render_attribute( 'tf_posts', ['id' => "tf-posts-{$this->get_id()}", 'class' => ['tf-posts no-carousel column-3 tablet-column-1 mobile-column-1',$settings['post_layout_align'], $disable_border_radius ], 'data-tabid' => $this->get_id()] );

		if ( get_query_var('paged') ) {
           $paged = get_query_var('paged');
        } elseif ( get_query_var('page') ) {
           $paged = get_query_var('page');
        } else {
           $paged = 1;
        }
		$query_args = array(
            'post_type' => 'post',
            'posts_per_page' => $settings['posts_per_page'],
            'paged'     => $paged
        );
        if (! empty( $settings['posts_categories'] )) {
        	$query_args['category_name'] = implode(',', $settings['posts_categories']);
        }        
        if ( ! empty( $settings['exclude'] ) ) {				
			if ( ! is_array( $settings['exclude'] ) )
				$exclude = explode( ',', $settings['exclude'] );

			$query_args['post__not_in'] = $exclude;
		}
		$query_args['orderby'] = $settings['order_by'];
		$query_args['order'] = $settings['order'];	
		
		$query = new WP_Query( $query_args );
		if ( $query->have_posts() ) : ?>
			<div <?php echo $this->get_render_attribute_string('tf_posts'); ?> >
				<?php while ( $query->have_posts() ) :
					$query->the_post(); ?>
					<?php
						$get_id_post_thumbnail = get_post_thumbnail_id();
						$post_thumbnail_src    = function_exists( 'tfre_image_resize_id' ) ? tfre_image_resize_id( $get_id_post_thumbnail, '525', '296', true ) : \Elementor\Group_Control_Image_Size::get_attachment_image_src( $get_id_post_thumbnail, 'thumbnail', $settings );
						if ( function_exists( 'tfre_get_option' ) ) {
							if ( tfre_get_option( 'toggle_lazy_load' ) == 'on' ) {
								$featured_image = sprintf( '<img src="" data-src="%s" class="lazy" alt="image">', $post_thumbnail_src );
							} else {
								$featured_image = sprintf( '<img src="%s" alt="image">', $post_thumbnail_src );
							}
					}
					?>
							<div class="item">
								<div class="entry blog-post ">
										<div class="featured-post">
											<a href="<?php echo esc_url( get_permalink() ) ?>">
												<?php echo sprintf( '%s', $featured_image ); ?>
												<span class="blog-plus"></span>
											</a>
												<div class="meta-features">
														<?php
														$archive_year  = get_the_time( 'Y' );
														$archive_month = get_the_time( 'm' );
														$archive_day   = get_the_time( 'd' );
														?>
														<div class="post-meta meta-time">
															<span>
																<?php echo get_the_date( 'M' ); ?>
															</span>
														</div>
														<div class="category-post">
															<?php if ( ! empty( $settings['category_icon'] ) ) : ?>
																<?php echo \Elementor\Addon_Elementor_Icon_manager_dreamhome::render_icon( $settings['category_icon'], [ 'aria-hidden' => 'true' ] ); ?>
															<?php endif; ?>
															<?php the_category( ' ' ); ?>
														</div>
												</div>
										</div>
									<div class="content">
											<h3 class="title"><a href="<?php echo esc_url( get_the_permalink() ); ?>"
													title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo get_the_title(); ?></a></h3>
										<?php if (  $settings['button_text'] != '' ) : ?>
											<div class="tf-button-container">
												<a href="<?php echo esc_url( get_permalink() ) ?>" class="tf-button">
													<span><?php echo esc_attr( $settings['button_text'] ); ?></span>
													<?php echo \Elementor\Addon_Elementor_Icon_manager_dreamhome::render_icon( $settings['post_icon_readmore'], [ 'aria-hidden' => 'true' ] ); ?>
												</a>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		<?php
		else:
			esc_html_e('No posts found', 'themesflat-core');
		endif;		
		
	}

	

	

}