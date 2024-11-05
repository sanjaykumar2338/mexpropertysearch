<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $hide_compare_fields;
$hide_compare_fields = tfre_get_option( 'show_hide_compare_fields', array() );
if ( ! is_array( $hide_compare_fields ) ) {
	$hide_compare_fields = array();
}
TFRE_Compare::tfre_open_session();
$property_ids = $_SESSION['tfre_compare_properties'];

if ( ! empty( $property_ids ) ) {
	$property_ids = array_diff( $property_ids, [ "0" ] );
	$args         = array(
		'post_type'      => 'real-estate',
		'post__in'       => $property_ids,
		'post_status'    => 'publish',
		'orderby'        => 'post__in',
		'posts_per_page' => sizeof( $property_ids )
	);
	$data         = new WP_Query( $args );
	$property_item = $types = $status = $year = $size = $rooms = $bedrooms = $bathrooms = $garage = $garage_size = $land = $feature = $additional = '';
	$empty_field = '<td class="check-no"><i class="icon-dreamhome-minus"></i></td>';
	if ( $data->have_posts() ) :
		while ( $data->have_posts() ) :
			$data->the_post();
			$property_id        = get_the_ID();
			$property_meta_data = get_post_custom( $property_id );
			$property_types     = get_the_terms( $property_id, 'property-type' );
			$property_type_arr  = array();
			if ( $property_types && ! is_wp_error( $property_types ) ) {
				foreach ( $property_types as $property_type ) {
					$property_type_arr[] = $property_type->name;
				}
			}

			$property_status     = get_the_terms( $property_id, 'property-status' );
			$property_status_arr = array();
			if ( $property_status && ! is_wp_error( $property_status ) ) {
				foreach ( $property_status as $s ) {
					$property_status_arr[] = $s->name;
				}
			}

			$property_label     = get_the_terms( $property_id, 'property-label' );
			$property_label_arr = array();
			if ( $property_label && ! is_wp_error( $property_label ) ) {
				foreach ( $property_label as $label ) {
					$property_label_arr[] = $label->name;
				}
			}

			$property_size                = isset( $property_meta_data['property_size'] ) ? $property_meta_data['property_size'][0] : '';
			$property_rooms               = isset( $property_meta_data['property_rooms'] ) ? $property_meta_data['property_rooms'][0] : '';
			$property_bedrooms            = isset( $property_meta_data['property_bedrooms'] ) ? $property_meta_data['property_bedrooms'][0] : '';
			$property_bathrooms           = isset( $property_meta_data['property_bathrooms'] ) ? $property_meta_data['property_bathrooms'][0] : '';
			$property_garage              = isset( $property_meta_data['property_garage'] ) ? $property_meta_data['property_garage'][0] : '';
			$property_garage_size         = isset( $property_meta_data['property_garage_size'] ) ? $property_meta_data['property_garage_size'][0] : '';
			$property_land                = isset( $property_meta_data['property_garage_size'] ) ? $property_meta_data['property_garage_size'][0] : '';
			$property_year                = isset( $property_meta_data['property_year'] ) ? $property_meta_data['property_year'][0] : '';
			$property_feature             = isset( $property_meta_data['property_featured'] ) ? $property_meta_data['property_featured'][0] : '';
			$property_address             = isset( $property_meta_data['property_address'] ) ? $property_meta_data['property_address'][0] : '';
			$property_link                = get_the_permalink();
			$width                        = get_option( 'thumbnail_width', '660' );
			$height                       = get_option( 'thumbnail_height', '360' );
			$no_image_src                 = tfre_get_option( 'default_property_image', '' )['url'] != '' ? tfre_get_option( 'default_property_image', '' )['url'] : TF_PLUGIN_URL . 'includes/elementor-widget/assets/images/no-image.jpg';
			$default_image                = '';
			$attach_id                    = get_post_thumbnail_id();
			$image_src                    = wp_get_attachment_image_url( $attach_id, $width, $height, true );
			$price                        = isset( $property_meta_data['property_price_value'] ) ? $property_meta_data['property_price_value'][0] : '';
			$prop_enable_short_price_unit = tfre_get_option( 'enable_short_price_unit', 0 ) == 1 ? true : false;
			$price_unit                   = isset( $property_meta_data['property_price_unit'] ) ? $property_meta_data['property_price_unit'][0] : '';
			$price_prefix                 = isset( $property_meta_data['property_price_prefix'] ) ? $property_meta_data['property_price_prefix'][0] : '';
			$price_postfix                = isset( $property_meta_data['property_price_postfix'] ) ? $property_meta_data['property_price_postfix'][0] : '';
			$measurement_units            = tfre_get_option_measurement_units();
			$property_item .= '<th><div class="property-inner compare-features">';
			$no_image_src                 = '' . $no_image_src . '';
			$property_item .= '<div class="property-image-wrap">
								<a href="' . esc_url( $property_link ) . '" title="' . esc_attr( get_the_title() ) . '"></a>
								<img loading="lazy" src="' . esc_url( $image_src ) . '" class="tfre-property-image" alt="' . esc_attr( get_the_title() ) . '" title="' . esc_attr( get_the_title() ) . '">
							</div>';
			if ( ! empty( $property_label ) ) {
				$property_item .= '<div class="property-label">';
				foreach ( $property_label as $label_item ) :
					if ( ! empty( $property_label ) ) {
						$label_color   = get_term_meta( $label_item->term_id, 'property_label_color', true );
						$property_item .= '<p class="label-item">
											<span class="property-label-bg">
												' . esc_html( $label_item->name ) . '
											</span>
										</p>';
					}
				endforeach;
				$property_item .= '</div>';
			}
			$property_price = '';
			if ( ! empty( $price ) ) {
				if ( ! empty( $price_prefix ) ) {
					$property_price = '<span class="property-price-prefix">' . esc_html( $price_prefix ) . ' </span>';
				}
				$property_price .= tfre_format_price( $price, $price_unit, true, $prop_enable_short_price_unit );
				if ( ! empty( $price_postfix ) ) {
					$property_price .= '<span class="property-price-postfix"> / ' . esc_html( $price_postfix ) . '</span>';
				}
			}

			$property_item .= '<div class="property-item-content">
								<h3 class="property-title"><a href="' . esc_url( $property_link ) . '" title="' . esc_attr( get_the_title() ) . '">' . esc_html( get_the_title() ) . '</a></h3>
								<div class="property-info">
									' . wp_kses_post( $property_price ) . '
									<div class="property-location" title="' . esc_attr( $property_address ) . '">
										<i class="icon-dreamhome-map2"></i>
										<span>' . esc_html( $property_address ) . '</span>
									</div>
								</div>
							</div>';
			$property_item .= '</div></th>';

			if ( $hide_compare_fields["property-feature"] == 1 ) {
				if ( ! empty( $property_feature ) ) {
					$feature .= '<td><i class="icon-dreamhome-star"></i></td>';
				} else {
					$feature .= $empty_field;
				}
			}
			if ( $hide_compare_fields["property-type"] == 1 ) {
				if ( ! empty( $property_types ) ) {
					$types .= '<td>' . esc_html( join( ', ', $property_type_arr ) ) . '</td>';
				} else {
					$types .= $empty_field;
				}
			}
			if ( $hide_compare_fields["property-status"] == 1 ) {
				if ( ! empty( $property_status ) ) {
					$status .= '<td>' . esc_html( join( ', ', $property_status_arr ) ) . '</td>';
				} else {
					$status .= $empty_field;
				}
			}
			if ( $hide_compare_fields["property_year"] == 1 ) {
				if ( ! empty( $property_year ) ) {
					$year .= '<td>' . esc_html( empty( tfre_get_option( 'enable_convert_year' ) ) ? $property_year : tfre_get_year_time( $property_year ) ) . '</td>';
				} else {
					$year .= $empty_field;
				}
			}
			if ( $hide_compare_fields["property_size"] == 1 ) {
				if ( ! empty( $property_size ) ) {
					$size .= '<td>' . wp_kses( sprintf( '%s %s', tfre_get_format_number( intval( $property_size ) ), $measurement_units ), array( 'sup' => array() ) ) . '</td>';
				} else {
					$size .= $empty_field;
				}
			}
			if ( $hide_compare_fields["property_rooms"] == 1 ) {
				if ( ! empty( $property_rooms ) ) {
					$rooms .= '<td>' . esc_html( $property_rooms ) . '</td>';
				} else {
					$rooms .= $empty_field;
				}
			}
			if ( $hide_compare_fields["property_bedrooms"] == 1 ) {
				if ( ! empty( $property_bedrooms ) ) {
					$bedrooms .= '<td>' . esc_html( $property_bedrooms ) . '</td>';
				} else {
					$bedrooms .= $empty_field;
				}
			}
			if ( $hide_compare_fields["property_bathrooms"] == 1 ) {
				if ( ! empty( $property_bathrooms ) ) {
					$bathrooms .= '<td>' . esc_html( $property_bathrooms ) . '</td>';
				} else {
					$bathrooms .= $empty_field;
				}
			}
			if ( $hide_compare_fields["property_garage"] == 1 ) {
				if ( ! empty( $property_garage ) ) {
					$garage .= '<td>' . esc_html( $property_garage ) . '</td>';
				} else {
					$garage .= $empty_field;
				}
			}
			if ( $hide_compare_fields["property_garage_size"] == 1 ) {
				if ( ! empty( $property_garage_size ) ) {
					$garage_size .= '<td>' . wp_kses( sprintf( '%s %s', $property_garage_size, $measurement_units ), array( 'sup' => array() ) ) . '</td>';
				} else {
					$garage_size .= $empty_field;
				}
			}
			if ( $hide_compare_fields["property_land"] == 1 ) {
				if ( ! empty( $property_land ) ) {
					$measurement_units_land_area = tfre_get_option_measurement_units_land();
					$land .= '<td>' . wp_kses( sprintf( '%s %s', tfre_get_format_number( intval( $property_land ) ), $measurement_units_land_area ), array( 'sup' => array() ) ) . '</td>';
				} else {
					$land .= $empty_field;
				}
			}
		endwhile;
	endif;
	?>
	<div class="row">
		<div class="tfre-compare-table table-responsive col-sm-12">
			<table class="compare-tables table-striped ">
				<thead>
					<tr>
						<th class="title-list-check"></th>
						<?php echo ( $property_item ); ?>
					</tr>
				</thead>
				<tbody>
					<?php if ( ! empty( $feature ) ) { ?>
						<tr>
							<td class="title-list-check"><?php esc_html_e( 'Feature', 'tf-real-estate' ); ?></td>
							<?php echo ( $feature ); ?>
						</tr>
					<?php } ?>
					<?php if ( ! empty( $types ) ) { ?>
						<tr>
							<td class="title-list-check"><?php esc_html_e( 'Type', 'tf-real-estate' ); ?></td>
							<?php echo ( $types ); ?>
						</tr>
					<?php } ?>
					<?php if ( ! empty( $status ) ) { ?>
						<tr>
							<td class="title-list-check"><?php esc_html_e( 'Status', 'tf-real-estate' ); ?></td>
							<?php echo ( $status ); ?>
						</tr>
					<?php } ?>
					<?php if ( ! empty( $size ) ) { ?>
						<tr>
							<td class="title-list-check"><?php esc_html_e( 'Size', 'tf-real-estate' ); ?></td>
							<?php echo ( $size ); ?>
						</tr>
					<?php } ?>
					<?php if ( ! empty( $land ) ) { ?>
						<tr>
							<td class="title-list-check"><?php esc_html_e( 'Land Area', 'tf-real-estate' ); ?></td>
							<?php echo ( $land ); ?>
						</tr>
					<?php } ?>
					<?php if ( ! empty( $rooms ) ) { ?>
						<tr>
							<td class="title-list-check"><?php esc_html_e( 'Rooms', 'tf-real-estate' ); ?></td>
							<?php echo ( $rooms ); ?>
						</tr>
					<?php } ?>
					<?php if ( ! empty( $bedrooms ) ) { ?>
						<tr>
							<td class="title-list-check"><?php esc_html_e( 'Bedrooms', 'tf-real-estate' ); ?></td>
							<?php echo ( $bedrooms ); ?>
						</tr>
					<?php } ?>
					<?php if ( ! empty( $bathrooms ) ) { ?>
						<tr>
							<td class="title-list-check"><?php esc_html_e( 'Bathrooms', 'tf-real-estate' ); ?></td>
							<?php echo ( $bathrooms ); ?>
						</tr>
					<?php } ?>
					<?php if ( ! empty( $garage ) ) { ?>
						<tr>
							<td class="title-list-check"><?php esc_html_e( 'Garages', 'tf-real-estate' ); ?></td>
							<?php echo ( $garage ); ?>
						</tr>
					<?php } ?>
					<?php if ( ! empty( $garage_size ) ) { ?>
						<tr>
							<td class="title-list-check"><?php esc_html_e( 'Garages Size', 'tf-real-estate' ); ?></td>
							<?php echo ( $garage_size ); ?>
						</tr>
					<?php } ?>
					<?php if ( ! empty( $year ) ) { ?>
						<tr>
							<td class="title-list-check"><?php esc_html_e( 'Year Built', 'tf-real-estate' ); ?></td>
							<?php echo ( $year ); ?>
						</tr>
					<?php } ?>
					<?php
					$all_property_feature = tfre_get_categories( 'property-feature' );
					$compare_terms        = array();
					foreach ( $property_ids as $post_id ) {
						$compare_terms[ $post_id ] = wp_get_post_terms( $post_id, 'property-feature', array( 'fields' => 'ids' ) );
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<?php
	wp_reset_postdata();
} else { ?>
	<div class="item-not-found"><?php esc_html_e( 'No item compare', 'tf-real-estate' ); ?></div>
<?php } ?>