<?php
$term_link        = get_term_link( $taxonomy->term_id, $taxonomy->taxonomy );
$term_icon_id     = get_term_meta( $taxonomy->term_id, 'type_icon', true );
$toggle_lazy_load = tfre_get_option( 'toggle_lazy_load' );
?>
<div class="item">
	<div class="taxonomy-post taxonomy-post-<?php echo esc_attr( $taxonomy->term_id ); ?>">
		<div class="box-card">
			<div class="box-card-inner">
				<div class="feature-image">
					<a href="<?php echo esc_url( $term_link ); ?>" class="image-wrap">
						<?php
						if ( $toggle_lazy_load == 'on' ) {
							echo sprintf( '<img loading="lazy" class="image-taxonomy lazy" src="" data-src="%s" alt="image" />', empty( $term_icon_id ) ? TF_PLUGIN_URL . 'includes/elementor-widget/assets/images/no-image.jpg' : wp_get_attachment_image_src( $term_icon_id, 'full' )[0] );
						} else {
							echo sprintf( '<img loading="lazy" class="image-taxonomy" src="%s" alt="image" />', empty( $term_icon_id ) ? TF_PLUGIN_URL . "includes/elementor-widget/assets/images/no-image.jpg" : wp_get_attachment_image_src( $term_icon_id, 'full' )[0] );
						}
						?>
					</a>
				</div>
				<div class="content">
					<p class="name">
						<a href="<?php echo esc_url($term_link); ?>"><?php echo __( $taxonomy->name ); ?></a>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>