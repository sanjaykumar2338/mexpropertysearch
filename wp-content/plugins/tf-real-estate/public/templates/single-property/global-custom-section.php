<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$show_global_custom_section    = is_array( tfre_get_option( 'single_property_panels_manager' ) ) ? tfre_get_option( 'single_property_panels_manager' )['global-custom-section'] : false;
$title_global_custom_section   = tfre_get_option( 'title_global_custom_section', 'Global Custom section' );
$content_global_custom_section = tfre_get_option( 'content_global_custom_section', '' );
if ( $show_global_custom_section == true ) : ?>
	<div id="nav-global-custom-section" class="single-property-element property-global-custom-section">
		<div class="tfre-property-header">
			<h3><?php esc_html_e( $title_global_custom_section ); ?></h3>
		</div>
		<div class="property-element row">
			<?php echo wp_kses_post( $content_global_custom_section ); ?>
		</div>
	</div>
<?php endif; ?>