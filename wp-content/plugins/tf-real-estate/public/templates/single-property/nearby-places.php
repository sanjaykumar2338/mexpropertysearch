<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$show_nearby_places = is_array( tfre_get_option( 'single_property_panels_manager' ) ) ? tfre_get_option( 'single_property_panels_manager' )['nearby-places'] : false;
$show_map_address   = is_array( tfre_get_option( 'single_property_panels_manager' ) ) ? tfre_get_option( 'single_property_panels_manager' )['map-location'] : false;

if ( $show_map_address != true ) :
	$property_id       = get_the_ID();
	$property_location = get_post_meta( $property_id, 'property_location', true );
	?>
	<div class="map-container" hidden>
		<input data-field-control="" class="latlng_searching" type="hidden" class="tfre-map-latlng-field"
			name="property_location[]"
			value="<?php echo esc_attr( is_array( $property_location ) ? $property_location[0] : '' ); ?>" />
		<div class="tfre-map-address-field">
			<div class="tfre-map-address-field-input">
				<input data-field-control="" class="address_searching" type="hidden" name="property_location[]"
					value="<?php echo esc_attr( is_array( $property_location ) ? $property_location[1] : '' ); ?>" />
			</div>
		</div>
	</div>
	<?php
endif;

if ( $show_nearby_places == true ) : ?>
	<div id="nav-nearby-places" class="single-property-element property-nearby-places">
		<div class="tfre-property-header">
			<h3><?php esc_html_e( 'What\'s nearby?', 'tf-real-estate' ); ?></h3>
		</div>
		<div class="property-element row">
			<?php echo do_shortcode( '[nearby_places]' ); ?>
		</div>
	</div>
<?php endif; ?>