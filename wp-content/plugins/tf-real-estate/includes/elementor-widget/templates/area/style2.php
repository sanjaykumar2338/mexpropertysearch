<div class="item">
	<?php
	$term_link = get_term_link( $taxonomy->term_id, $taxonomy->taxonomy );
	if ( $settings['taxonomy'] == 'province-state' ) {
		$term_image_id = get_term_meta( $taxonomy->term_id, 'province_state_image', true );
	} else {
		$term_image_id = get_term_meta( $taxonomy->term_id, 'neighborhood_image', true );
	}
	$toggle_lazy_load = tfre_get_option( 'toggle_lazy_load' );
	$width_image = $height_image = '174';
	?>
	<div class="area-post area-post-<?php echo esc_attr($taxonomy->term_id); ?>">
		<div class="featured-post">
			<a href="<?php echo esc_url( $term_link ) ?>" class="image-wrap">
				<?php
				if ( $toggle_lazy_load == 'on' ) {
					echo sprintf( '<img loading="lazy" class="image-area lazy" src="" data-src="%s" alt="image">', empty( $term_image_id ) ? TF_PLUGIN_URL . "includes/elementor-widget/assets/images/no-image.jpg" : tfre_image_resize_id( $term_image_id, $width_image, $height_image, true ) );
				} else {
					echo sprintf( '<img loading="lazy" class="image-area" src="%s" alt="image">', empty( $term_image_id ) ? TF_PLUGIN_URL . "includes/elementor-widget/assets/images/no-image.jpg" : tfre_image_resize_id( $term_image_id, $width_image, $height_image, true ) );
				}
				?>
			</a>
			<div class="content">
				<div class="info">
					<h3 class="name">
						<a href="<?php echo esc_url( $term_link ) ?>">
							<?php echo __( $taxonomy->name ); ?>
						</a>
					</h3>
					<?php if ( $settings['show_count_listing'] == 'yes' ) : ?>
						<span class="count-listing"><?php echo sprintf( '%s ' . tfre_get_number_text( $taxonomy->count, esc_html__( 'Properties', 'tf-real-estate' ), esc_html__( 'Property', 'tf-real-estate' ) ), $taxonomy->count ); ?></span>
					<?php endif; ?>
				</div>
				<?php if ( $settings['show_link_listing'] == 'yes' ) : ?>
					<a href="<?php echo esc_url( $term_link ) ?>" class="link-listing"><span><?php echo esc_html__( 'View all listing', 'tf-real-estate' ) ?></span><i class="icon-dreamhome-right-arrow"></i></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>