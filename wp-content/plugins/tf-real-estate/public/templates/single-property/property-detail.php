<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post;
$property_id          = get_the_ID();
$property_title       = get_the_title();
$property_meta_data   = get_post_custom( $property_id );
$property_identity    = isset( $property_meta_data['property_identity'] ) ? $property_meta_data['property_identity'][0] : '';
$property_size        = isset( $property_meta_data['property_size'] ) ? $property_meta_data['property_size'][0] : '';
$property_land_area   = isset( $property_meta_data['property_land'] ) ? $property_meta_data['property_land'][0] : '';
$property_bedrooms    = isset( $property_meta_data['property_bedrooms'] ) ? $property_meta_data['property_bedrooms'][0] : '0';
$property_bathrooms   = isset( $property_meta_data['property_bathrooms'] ) ? $property_meta_data['property_bathrooms'][0] : '0';
$property_rooms       = isset( $property_meta_data['property_rooms'] ) ? $property_meta_data['property_rooms'][0] : '0';
$property_garage      = isset( $property_meta_data['property_garage'] ) ? $property_meta_data['property_garage'][0] : '0';
$property_garage_size = isset( $property_meta_data['property_garage_size'] ) ? $property_meta_data['property_garage_size'][0] : '';
$property_types       = get_the_terms( $property_id, 'property-type' );
$property_type_text   = array();
if ( ! empty( $property_types ) ) {
	foreach ( $property_types as $property_type ) {
		array_push( $property_type_text, $property_type->name );
	}
}
$property_type_text           = implode( ",", $property_type_text );
$property_status              = get_the_terms( $property_id, 'property-status' );
$property_year                = isset( $property_meta_data['property_year'] ) ? $property_meta_data['property_year'][0] : '';
$property_price               = isset( $property_meta_data['property_price_value'] ) ? $property_meta_data['property_price_value'][0] : '';
$prop_enable_short_price_unit = tfre_get_option( 'enable_short_price_unit', 0 ) == 1 ? true : false;
$property_price_unit          = isset( $property_meta_data['property_price_unit'] ) ? $property_meta_data['property_price_unit'][0] : '';
$property_price_prefix        = isset( $property_meta_data['property_price_prefix'] ) ? $property_meta_data['property_price_prefix'][0] : '';
$property_price_postfix       = isset( $property_meta_data['property_price_postfix'] ) ? $property_meta_data['property_price_postfix'][0] : '';
$property_additional_detail   = isset( $property_meta_data['property_additional_detail'] ) ? $property_meta_data['property_additional_detail'][0] : '';
$property_additional_detail   = unserialize( $property_additional_detail );
$show_property_detail         = is_array( tfre_get_option( 'single_property_panels_manager' ) ) ? tfre_get_option( 'single_property_panels_manager' )['property-detail'] : false;
$measurement_units            = tfre_get_option_measurement_units();
?>
<?php if ( $show_property_detail == true ) : ?>
	<div id="nav-property-detail" class="single-property-element property-info-detail border">
		<div class="tfre-property-detail">
			<div class="tfre-property-header">
				<h3><?php echo esc_html__( 'Property details', 'tf-real-estate' ); ?></h3>
			</div>
			<div class="tfre-property-info">
				<div class="row">
					<?php if ( ! empty( $property_id ) ) : ?>
						<div class="col-md-6">
							<div class="inner d-flex">
								<strong class="property-info-title"><?php esc_html_e( 'ID', 'tf-real-estate' ); ?></strong>
								<span class="property-info-title"><?php
								if ( ! empty( $property_identity ) ) {
									echo esc_html( $property_identity );
								} else {
									echo esc_html( $property_id );
								}
								?></span>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $property_bedrooms ) ) : ?>
						<div class="col-md-6">
							<div class="inner d-flex">
								<strong class="property-info-title"><?php esc_html_e( 'Beds', 'tf-real-estate' ); ?></strong>
								<span class="property-info-value"><?php
								echo esc_html( tfre_get_format_number( $property_bedrooms ) );
								?></span>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $property_price ) ) : ?>
						<div class="col-md-6">
							<div class="inner d-flex">
								<strong class="property-info-title"><?php esc_html_e( 'Price', 'tf-real-estate' ); ?></strong>
								<span class="property-info-value">
									<?php echo esc_html( tfre_format_price( $property_price, $property_price_unit, true, $prop_enable_short_price_unit ) ); ?>
								</span>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $property_year ) ) : ?>
						<div class="col-md-6">
							<div class="inner d-flex">
								<strong class="property-info-title"><?php esc_html_e( 'Year Built', 'tf-real-estate' ); ?></strong>
								<span class="property-info-value">
									<?php echo esc_html( empty( tfre_get_option( 'enable_convert_year' ) ) ? $property_year : tfre_get_year_time( $property_year ) ); ?>
								</span>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $property_size ) ) : ?>
						<div class="col-md-6">
							<div class="inner d-flex">
								<strong class="property-info-title"><?php esc_html_e( 'Size', 'tf-real-estate' ); ?></strong>
								<span class="property-info-value">
									<?php echo esc_html( tfre_get_format_number( intval( $property_size ) ) ); ?>
									<span> <?php echo wp_kses( $measurement_units, array( 'sup' => array() ) ); ?></span>
								</span>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $property_types ) ) : ?>
						<div class="col-md-6">
							<div class="inner d-flex">
								<strong class="property-info-title"><?php esc_html_e( 'Type', 'tf-real-estate' ); ?></strong>
								<span class="property-info-value"><?php echo esc_html( $property_type_text ); ?></span>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $property_rooms ) ) : ?>
						<div class="col-md-6">
							<div class="inner d-flex">
								<strong class="property-info-title"><?php esc_html_e( 'Rooms', 'tf-real-estate' ); ?></strong>
								<span class="property-info-value"><?php echo esc_html( tfre_get_format_number( intval( $property_rooms ) ) ); ?></span>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $property_status ) && is_array( $property_status ) ) : ?>
						<div class="col-md-6">
							<div class="inner d-flex">
								<strong class="property-info-title"><?php esc_html_e( 'Status', 'tf-real-estate' ); ?></strong>
								<span class="property-info-value"><?php echo esc_html( $property_status[0]->name ) ?></span>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $property_bathrooms ) ) : ?>
						<div class="col-md-6">
							<div class="inner d-flex">
								<strong class="property-info-title"><?php esc_html_e( 'Baths', 'tf-real-estate' ); ?></strong>
								<span class="property-info-value"><?php echo esc_html( tfre_get_format_number( intval( $property_bathrooms ) ) ); ?></span>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $property_garage ) ) : ?>
						<div class="col-md-6">
							<div class="inner d-flex">
								<strong class="property-info-title"><?php esc_html_e( 'Garage', 'tf-real-estate' ); ?></strong>
								<span class="property-info-value"><?php echo esc_html( tfre_get_format_number( intval( $property_garage ) ) ); ?></span>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $property_garage_size ) ) : ?>
						<div class="col-md-6">
							<div class="inner d-flex">
								<strong class="property-info-title"><?php esc_html_e( 'Garage Size', 'tf-real-estate' ); ?></strong>
								<span class="property-info-value">
									<?php echo esc_html( tfre_get_format_number( intval( $property_garage_size ) ) ); ?>
									<span><?php echo wp_kses( $measurement_units, array( 'sup' => array() ) ); ?></span>
								</span>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $property_land_area ) ) : ?>
						<div class="col-md-6">
							<div class="inner d-flex">
								<strong class="property-info-title"><?php esc_html_e( 'Land Areas', 'tf-real-estate' ); ?></strong>
								<span class="property-info-value">
									<?php echo esc_html( tfre_get_format_number( intval( $property_land_area ) ) ); ?>
									<span><?php echo wp_kses( $measurement_units, array( 'sup' => array() ) ); ?></span>
								</span>
							</div>
						</div>
					<?php endif; ?>

					<?php
					$get_additional_fields = tfre_get_additional_fields();
					if ( is_array( $get_additional_fields ) && count( $get_additional_fields ) > 0 ) {
						foreach ( $get_additional_fields as $key => $field ) {
							$property_field_value = get_post_meta( $property_id, $key, true );
							if ( $field['type'] == 'checkbox' ) {
								$property_field_content = array();
								if ( is_array( $property_field_value ) && count( $property_field_value ) > 0 ) {
									foreach ( $property_field_value as $k => $v ) {
										$property_field_content[] = $field['choices'][ $v ]['label'];
									}
									?>
									<div class="col-md-6">
										<div class="inner d-flex">
											<strong class="property-info-title"><?php esc_html_e( $field['title'], 'tf-real-estate' ); ?></strong>
											<span class="property-info-value"><?php echo esc_html( implode( ', ', $property_field_content ) ); ?></span>
										</div>
									</div>
									<?php
								}
							} else if ( $field['type'] == 'radio' ) {
								$property_field_content = '';
								$property_field_content = $field['choices'][ $property_field_value ]['label'];
								if ( ! empty( $property_field_content ) ) {
									?>
										<div class="col-md-6">
											<div class="inner d-flex">
												<strong class="property-info-title"><?php esc_html_e( $field['title'], 'tf-real-estate' ); ?></strong>
												<span class="property-info-value"><?php echo esc_html( $property_field_content ); ?></span>
											</div>
										</div>
									<?php
								}
							} else if ( $field['type'] == 'select' ) {
								$property_field_content = '';
								$property_field_content = $field['choices'][ $property_field_value ];
								if ( ! empty( $property_field_content ) ) {
									?>
											<div class="col-md-6">
												<div class="inner d-flex">
													<strong class="property-info-title"><?php esc_html_e( $field['title'], 'tf-real-estate' ); ?></strong>
													<span class="property-info-value"><?php echo esc_html( $property_field_content ); ?></span>
												</div>
											</div>
									<?php
								}
							} else if ( $field['type'] == 'textarea' ) {
								$property_field_value = wpautop( $property_field_value );
								if ( ! empty( $property_field_value ) ) {
									?>
												<div class="col-md-6">
													<div class="inner d-flex">
														<strong class="property-info-title"><?php esc_html_e( $field['title'], 'tf-real-estate' ); ?></strong>
														<span class="property-info-value"><?php echo wp_kses_post( $property_field_value ); ?></span>
													</div>
												</div>
									<?php
								}
							} else if ( $field['type'] == 'text' ) {
								if ( ! empty( $property_field_value ) ) {
									?>
													<div class="col-md-6">
														<div class="inner d-flex">
															<strong class="property-info-title"><?php esc_html_e( $field['title'], 'tf-real-estate' ); ?></strong>
															<span class="property-info-value"><?php echo wp_kses_post( is_numeric( $property_field_value ) ? tfre_get_format_number( intval( $property_field_value ) ) : $property_field_value ); ?></span>
														</div>
													</div>
									<?php
								}
							}
						}
					}
					?>

					<?php if ( ! empty( $property_additional_detail ) && count( $property_additional_detail ) > 0 ) :
						foreach ( $property_additional_detail as $key => $value ) :
							if ( ! empty( $value['additional_detail_title'] ) || ! empty( $value['additional_detail_value'] ) ) : ?>
								<div class="col-md-6">
									<div class="inner d-flex">
										<strong class="property-info-title"><?php esc_html_e( $value['additional_detail_title'], 'tf-real-estate' ); ?></strong>
										<span class="property-info-value"><?php echo esc_html( is_numeric( $value['additional_detail_value'] ) ? tfre_get_format_number( intval( $value['additional_detail_value'] ) ) : $value['additional_detail_value'] ); ?></span>
									</div>
								</div>
								<?php
							endif;
						endforeach;
					endif; ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>