<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post;
$property_id                  = get_the_ID();
$property_meta_data           = get_post_custom( $property_id );
$property_title               = get_the_title();
$property_size                = isset( $property_meta_data['property_size'] ) ? $property_meta_data['property_size'][0] : '';
$property_bedrooms            = isset( $property_meta_data['property_bedrooms'] ) ? $property_meta_data['property_bedrooms'][0] : '0';
$property_bathrooms           = isset( $property_meta_data['property_bathrooms'] ) ? $property_meta_data['property_bathrooms'][0] : '0';
$property_address             = isset( $property_meta_data['property_address'] ) ? $property_meta_data['property_address'][0] : '';
$property_status              = get_the_terms( $property_id, 'property-status' );
$property_year                = isset( $property_meta_data['property_year'] ) ? $property_meta_data['property_year'][0] : '';
$property_price               = isset( $property_meta_data['property_price_value'] ) ? $property_meta_data['property_price_value'][0] : '';
$property_price_unit          = isset( $property_meta_data['property_price_unit'] ) ? $property_meta_data['property_price_unit'][0] : '';
$property_price_prefix        = isset( $property_meta_data['property_price_prefix'] ) ? $property_meta_data['property_price_prefix'][0] : '';
$property_price_postfix       = isset( $property_meta_data['property_price_postfix'] ) ? $property_meta_data['property_price_postfix'][0] : '';
$prop_enable_short_price_unit = tfre_get_option( 'enable_short_price_unit', 0 ) == 1 ? true : false;
// Show Hide Actions Button 
global $show_hide_actions_button;
$show_hide_actions_button = tfre_get_option( 'show_hide_actions_button', array() );
if ( ! is_array( $show_hide_actions_button ) ) {
	$show_hide_actions_button = array();
}
?>
<div class="single-property-element property-info-header property-info-action">
	<div class="tfre-property-floor">
		<div class="row">
			<div class="col-md-8">
				<div class="infor-header-left">
					<?php if ( ! empty( $property_title ) ) : ?>
						<h2><?php the_title(); ?></h2>
					<?php endif; ?>
					<div class="property-info-block-inline">
						<div class="d-inline-block ">
							<?php if ( ! empty( $property_status ) && is_array( $property_status ) ) : ?>
								<span class="property-status">
									<?php echo esc_html( $property_status[0]->name ); ?>
								</span>
							<?php endif; ?>
							<?php if ( ! empty( $property_address ) ) :
								$property_location = get_post_meta( $property_id, 'property_location', true );
								if ( $property_location && is_array( $property_location ) ) {
									$google_map_address_url = "http://maps.google.com/?q=" . $property_location[0];
								} else {
									$google_map_address_url = "http://maps.google.com/?q=" . $property_address;
								}
								?>
								<div class="property-location d-inline-block" title="<?php echo esc_attr( $property_address ) ?>">
									<i class="icon-dreamhome-map2"></i>
									<a target="_blank"
										href="<?php echo esc_url( $google_map_address_url ); ?>"><span><?php echo esc_attr( $property_address ) ?></span></a>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $property_year ) ) : ?>
								<span class="property-year">
									<i class="icon-dreamhome-date"></i>
									<?php echo wp_kses_post( esc_html( empty( tfre_get_option( 'enable_convert_year' ) ) ? $property_year : tfre_get_year_time( $property_year ) ) ); ?>
								</span>
							<?php endif; ?>
						</div>
					</div>
					<div class="tfre-property-info">
						<div class="d-inline-block ">
							<?php if ( ! empty( $property_bedrooms ) ) : ?>
								<div class="property-bedrooms d-inline-block">
									<div class="content-property-info">
										<i class="icon-dreamhome-bed"></i>
										<span class="property-info-title"><?php
										echo esc_html( tfre_get_number_text( $property_bedrooms, esc_html__( 'Beds: ', 'tf-real-estate' ), esc_html__( 'Bed: ', 'tf-real-estate' ) ) );
										?></span>
										<span class="property-info-value"><?php echo esc_html( $property_bedrooms ) ?></span>
									</div>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $property_bathrooms ) ) : ?>
								<div class="property-bathrooms d-inline-block">
									<div class="content-property-info">
										<i class="icon-dreamhome-bath1"></i>
										<span class="property-info-title"><?php
										echo esc_html( tfre_get_number_text( $property_bathrooms, esc_html__( 'Baths: ', 'tf-real-estate' ), esc_html__( 'Bath: ', 'tf-real-estate' ) ) );
										?></span>
										<span class="property-info-value"><?php echo esc_html( $property_bathrooms ) ?></span>
									</div>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $property_size ) ) : ?>
								<div class="property-area d-inline-block">
									<div class="content-property-info">
										<i class="icon-dreamhome-size1"></i>
										<span class="property-info-title"><?php
										$measurement_units = tfre_get_option_measurement_units();
										echo wp_kses( $measurement_units, array( 'sup' => array() ) ); ?></span>
										<span class="property-info-value"><?php
										echo esc_html( tfre_get_format_number( intval( $property_size ) ) ); ?>
										</span>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="infor-header-right">
					<div class="property-action">
						<div class="property-action-inner clearfix">
							<?php
							if ( $show_hide_actions_button["favorite-actions-button"] == 1 ) {
								tfre_get_template_with_arguments( 'property/favorite.php' );
							}
							if ( $show_hide_actions_button["compare-actions-button"] == 1 ) {
								tfre_get_template_with_arguments( 'property/compare-button.php' );
							}
							if ( $show_hide_actions_button["social-actions-button"] == 1 ) {
								tfre_get_template_with_arguments( 'property/share-property.php' );
							}
							?>
							<?php if ( $show_hide_actions_button["print-actions-button"] == 1 ) :?>
							<a href="#" class="tfre-property-print hv-tool" data-toggle="tooltip"
								data-tooltip="<?php esc_attr_e( 'Print', 'tf-real-estate' ); ?>"><i
									class="far fa-print"></i></a>
							<?php endif; ?>
						</div>
					</div>
					<?php if ( ! empty( $property_price ) ) : ?>
						<h2 class="property-year">
							<?php if ( $property_price_prefix != '' ) : ?>
								<?php echo esc_html( $property_price_prefix ); ?>
							<?php endif; ?>
							<?php echo esc_html( tfre_format_price( $property_price, $property_price_unit, true, $prop_enable_short_price_unit ) ); ?>
							<?php if ( $property_price_postfix != '' ) : ?>
								<?php echo esc_html( $property_price_postfix ); ?>
							<?php endif; ?>
						</h2>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>