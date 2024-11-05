<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$content          = get_the_content();
$show_description = is_array( tfre_get_option( 'single_property_panels_manager' ) ) ? tfre_get_option( 'single_property_panels_manager' )['description'] : false;
if ( $show_description == true ) :
	if ( isset( $content ) && ! empty( $content ) ) : ?>
		<div id="nav-description" class="single-property-element property-description border">
			<div class="tfre-property-header">
				<h4><?php esc_html_e( 'Description', 'tf-real-estate' ); ?></h4>
			</div>
			<div class="tfre-property-info show-hide" data-show="<?php esc_attr_e( 'Show More', 'tf-real-estate' ); ?>" data-hide="<?php esc_attr_e( 'Hide Less', 'tf-real-estate' ); ?>">
				<?php the_content(); ?>
			</div>
		</div>
	<?php endif;
endif; ?>