<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$property_id        = get_the_ID();
$property_meta_data = get_post_custom( $property_id );
$property_size      = isset( $property_meta_data['property_size'] ) ? $property_meta_data['property_size'][0] : '';
$property_bedrooms  = isset( $property_meta_data['property_bedrooms'] ) ? $property_meta_data['property_bedrooms'][0] : '0';
$property_bathrooms = isset( $property_meta_data['property_bathrooms'] ) ? $property_meta_data['property_bathrooms'][0] : '0';
$property_rooms     = isset( $property_meta_data['property_rooms'] ) ? $property_meta_data['property_rooms'][0] : '0';
$property_types     = get_the_terms( $property_id, 'property-type' );
$property_type_text = array();
if ( ! empty( $property_types ) ) {
	foreach ( $property_types as $property_type ) {
		array_push( $property_type_text, $property_type->name );
	}
}
;
$property_type_text = implode( ",", $property_type_text );
$property_garage    = isset( $property_meta_data['property_garage'] ) ? $property_meta_data['property_garage'][0] : '0';
$property_year      = isset( $property_meta_data['property_year'] ) ? $property_meta_data['property_year'][0] : '';
$show_overview      = is_array( tfre_get_option( 'single_property_panels_manager' ) ) ? tfre_get_option( 'single_property_panels_manager' )['overview'] : false;
?>
<?php if ( $show_overview == true ) : ?>
	<div id="nav-overview" class="single-property-element property-info-overview border">
		<div class="tfre-property-overview">
			<div class="tfre-property-header">
				<h3><?php echo esc_html__( 'Overview', 'tf-real-estate' ); ?></h3>
			</div>
			<div class="tfre-property-info">
				<div class="row">
					<?php if ( ! empty( $property_rooms ) ) : ?>
						<div class="col-xl-3 col-md-6 col-6 property-rooms">
							<div class="inner d-flex">
								<div class="icon icon-flex">
									<i class="icon-dreamhome-door"></i>
								</div>
								<div class="content-property-info">
									<span class="property-info-title"><?php echo esc_html( tfre_get_number_text( $property_rooms, esc_html__( 'Rooms', 'tf-real-estate' ), esc_html__( 'Room', 'tf-real-estate' ) ) ); ?></span>
									<p class="property-info-value"><?php echo esc_html( $property_rooms ); ?></p>
								</div>
							</div>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $property_bathrooms ) ) : ?>
						<div class="col-xl-3 col-md-6 col-6 property-bathrooms">
							<div class="inner d-flex">
								<div class="icon icon-flex">
									<i class="icon-dreamhome-bath1"></i>
								</div>
								<div class="content-property-info">
									<span class="property-info-title"><?php echo esc_html( tfre_get_number_text( $property_bathrooms, esc_html__( 'Baths', 'tf-real-estate' ), esc_html__( 'Bath', 'tf-real-estate' ) ) ); ?></span>
									<p class="property-info-value"><?php echo esc_html( $property_bathrooms ); ?></p>
								</div>
							</div>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $property_bedrooms ) ) : ?>
						<div class="col-xl-3 col-md-6 col-6 property-bedrooms">
							<div class="inner d-flex">
								<div class="icon icon-flex">
									<i class="icon-dreamhome-bed"></i>
								</div>
								<div class="content-property-info">
									<span class="property-info-title"><?php echo esc_html( tfre_get_number_text( $property_bedrooms, esc_html__( 'Beds', 'tf-real-estate' ), esc_html__( 'Bed', 'tf-real-estate' ) ) ); ?></span>
									<p class="property-info-value"><?php echo esc_html( $property_bedrooms ); ?></p>
								</div>
							</div>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $property_size ) ) : ?>
						<div class="col-xl-3 col-md-6 col-6 property-size">
							<div class="inner d-flex">
								<div class="icon icon-flex">
									<i class="icon-dreamhome-size1"></i>
								</div>
								<div class="content-property-info">
									<span class="property-info-title"><?php echo esc_html__( 'Size', 'tf-real-estate' ); ?></span>
									<p class="property-info-value">
										<?php echo esc_html( tfre_get_format_number( intval( $property_size ) ) ); ?> 
										<span><?php $measurement_units = tfre_get_option_measurement_units(); echo wp_kses( $measurement_units, array( 'sup' => array() ) ); ?></span>
									</p>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>
				<div class="row">
					<?php if ( ! empty( $property_year ) ) : ?>
						<div class="col-xl-3 col-md-6 col-6 property-year-built">
							<div class="inner d-flex">
								<div class="icon icon-flex">
									<i class="icon-dreamhome-date"></i>
								</div>
								<div class="content-property-info">
									<span class="property-info-title"><?php echo esc_html__( 'Year Built', 'tf-real-estate' ); ?></span>
									<p class="property-info-value">
										<?php echo esc_html( empty( tfre_get_option( 'enable_convert_year' ) ) ? $property_year : tfre_get_year_time( $property_year ) ); ?>
									</p>
								</div>
							</div>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $property_garage ) ) : ?>
						<div class="col-xl-3 col-md-6 col-6 property-garage">
							<div class="inner d-flex">
								<div class="icon icon-flex">
									<i class="icon-dreamhome-garage"></i>
								</div>
								<div class="content-property-info">
									<span class="property-info-title"><?php echo esc_html( tfre_get_number_text( $property_garage, esc_html__( 'Garages', 'tf-real-estate' ), esc_html__( 'Garage', 'tf-real-estate' ) ) ); ?></span>
									<p class="property-info-value"><?php echo esc_html( $property_garage ); ?></p>
								</div>
							</div>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $property_types ) ) : ?>
						<div class="col-xl-6 col-md-12 col-12 property-type">
							<div class="inner d-flex">
								<div class="icon icon-flex">
									<i class="icon-dreamhome-shapes"></i>
								</div>
								<div class="content-property-info">
									<span class="property-info-title"><?php echo esc_html__( 'Property Type', 'tf-real-estate' ); ?></span>
									<p class="property-info-value"><?php echo esc_html( $property_type_text ); ?></p>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>