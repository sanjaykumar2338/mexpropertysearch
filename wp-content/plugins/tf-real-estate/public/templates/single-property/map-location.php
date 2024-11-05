<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$property_id        = get_the_ID();
$property_meta_data = get_post_custom( $property_id );

$property_location       = get_post_meta( $property_id, 'property_location', true );
$property_address        = isset( $property_meta_data['property_address'] ) ? $property_meta_data['property_address'][0] : '';
$property_country        = isset( $property_meta_data['property_country'] ) ? $property_meta_data['property_country'][0] : '';
$property_country        = tfre_get_countries_name( $property_country );
$property_zip            = isset( $property_meta_data['property_zip'] ) ? $property_meta_data['property_zip'][0] : '';
$property_province_state = isset( $property_meta_data['property_province_state'] ) ? $property_meta_data['property_province_state'][0] : '';
$show_map_address        = is_array( tfre_get_option( 'single_property_panels_manager' ) ) ? tfre_get_option( 'single_property_panels_manager' )['map-location'] : false;
?>
<?php if ( $show_map_address == true ) : ?>
	<div id="nav-map-location" class="single-property-element property-location border">
		<div class="tfre-property-location">
			<div class="tfre-property-header">
				<h3><?php esc_html_e( 'Address', 'tf-real-estate' ); ?></h3>
			</div>
			<div class="tfre-property-info">
				<div class="row">
					<?php if ( ! empty( $property_address ) ) : ?>
						<div class="col-md-6">
							<div class="property-address inner d-flex">
								<strong class="property-info-title"><?php esc_html_e( 'Address', 'tf-real-estate' ); ?></strong>
								<span class="property-info-value"><?php echo esc_html( $property_address ); ?></span>
							</div>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $property_zip ) ) : ?>
						<div class="col-md-6">
							<div class="inner d-flex">
								<strong
									class="property-info-title"><?php esc_html_e( 'Postal code', 'tf-real-estate' ); ?></strong>
								<span
									class="property-info-value"><?php echo esc_html( tfre_get_format_number( intval( $property_zip ) ) ); ?></span>
							</div>
						</div>
					<?php endif; ?>
				</div>
				<div class="row">
					<?php if ( ! empty( $property_province_state ) ) : ?>
						<div class="col-md-6">
							<div class="property-address inner d-flex">
								<strong
									class="property-info-title"><?php esc_html_e( 'State/country', 'tf-real-estate' ); ?></strong>
								<span class="property-info-value"><?php echo esc_html( $property_province_state ); ?></span>
							</div>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $property_country ) ) : ?>
						<div class="col-md-6">
							<div class="inner d-flex">
								<strong class="property-info-title"><?php esc_html_e( 'Country', 'tf-real-estate' ); ?></strong>
								<span class="property-info-value"><?php echo esc_html( $property_country ); ?></span>
							</div>
						</div>
					<?php endif; ?>
				</div>
				<div class="map-container">
					<input data-field-control="" class="latlng_searching" type="hidden" class="tfre-map-latlng-field"
						name="property_location[]"
						value="<?php echo esc_attr( is_array( $property_location ) ? $property_location[0] : '' ); ?>" />
					<div class="tfre-map-address-field">
						<div class="tfre-map-address-field-input">
							<input data-field-control="" class="address_searching" type="hidden" name="property_location[]"
								value="<?php echo esc_attr( is_array( $property_location ) ? $property_location[1] : '' ); ?>" />
						</div>
					</div>
					<div id="map-single"></div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>