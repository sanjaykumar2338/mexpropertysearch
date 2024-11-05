<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$property_id                     = get_the_ID();
$show_personal_custom_section    = is_array( tfre_get_option( 'single_property_panels_manager' ) ) ? tfre_get_option( 'single_property_panels_manager' )['personal-custom-section'] : false;
$title_personal_custom_section   = get_post_meta( $property_id, 'title_custom_section', true );
$content_personal_custom_section = get_post_meta( $property_id, 'content_custom_section', true );
$toggle_custom_section           = get_post_meta( $property_id, 'toggle_custom_section', true );
$title_personal_custom_section   = ! empty( $title_personal_custom_section ) ? $title_personal_custom_section : '';
$content_personal_custom_section = ! empty( $content_personal_custom_section ) ? $content_personal_custom_section : '';
$toggle_custom_section           = ! empty( $toggle_custom_section ) ? $toggle_custom_section : '0';
if ( $show_personal_custom_section == true && $toggle_custom_section == '1' ) : ?>
	<div id="nav-nearby-places" class="single-property-element property-nearby-places">
		<div class="tfre-property-header">
			<h3><?php esc_html_e( $title_personal_custom_section ); ?></h3>
		</div>
		<div class="property-element row">
			<?php echo wp_kses_post( $content_personal_custom_section ); ?>
		</div>
	</div>
<?php endif; ?>