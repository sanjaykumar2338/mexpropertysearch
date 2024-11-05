<?php
/**
 * @var $property_id
 * @var $attach_id
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
wp_enqueue_style( 'properties-styles' );
$prop_address                 = get_post_meta( $property_id, 'property_address', true );
$prop_price_value             = get_post_meta( $property_id, 'property_price_value', true );
$prop_price_unit              = get_post_meta( $property_id, 'property_price_unit', true );
$prop_enable_short_price_unit = tfre_get_option( 'enable_short_price_unit', 0 ) == 1 ? true : false;
$prop_price_prefix            = get_post_meta( $property_id, 'property_price_prefix', true );
$prop_price_postfix           = get_post_meta( $property_id, 'property_price_postfix', true );
$prop_zipcode                 = get_post_meta( $property_id, 'property_zip', true );
$prop_bedrooms                = get_post_meta( $property_id, 'property_bedrooms', true ) ? get_post_meta( $property_id, 'property_bedrooms', true ) : 0;
$prop_bathrooms               = get_post_meta( $property_id, 'property_bathrooms', true ) ? get_post_meta( $property_id, 'property_bathrooms', true ) : 0;
$prop_size                    = get_post_meta( $property_id, 'property_size', true ) ? get_post_meta( $property_id, 'property_size', true ) : 0;
$prop_land_area               = get_post_meta( $property_id, 'property_land', true ) ? get_post_meta( $property_id, 'property_land', true ) : 0;
$prop_room                    = get_post_meta( $property_id, 'property_rooms', true ) ? get_post_meta( $property_id, 'property_rooms', true ) : 0;
$prop_garage                  = get_post_meta( $property_id, 'property_garage', true ) ? get_post_meta( $property_id, 'property_garage', true ) : 0;
$prop_garage_size             = get_post_meta( $property_id, 'property_garage_size', true ) ? get_post_meta( $property_id, 'property_garage_size', true ) : 0;
$prop_year                    = get_post_meta( $property_id, 'property_year', true ) ? get_post_meta( $property_id, 'property_year', true ) : '';
$prop_location                = $property_id ? get_post_meta( $property_id, 'property_location', true ) : '';
$prop_featured                = get_post_meta( $property_id, 'property_featured', true ) ? get_post_meta( $property_id, 'property_featured', true ) : false;
$prop_label                   = get_the_terms( $property_id, 'property-label' );
$prop_gallery_images          = get_post_meta( $property_id, 'gallery_images', true ) ? get_post_meta( $property_id, 'gallery_images', true ) : '';
$list_gallery_images          = get_sources_property_gallery_images( $prop_gallery_images );
$property_thumb               = get_the_post_thumbnail_url( $property_id, 'medium' );
if ( is_array( $list_gallery_images ) ) {
	if ( attachment_url_to_postid( $property_thumb ) != attachment_url_to_postid( $list_gallery_images[0] ) ) {
		array_unshift( $list_gallery_images, $property_thumb );
	}
}
$prop_agent_info      = get_post_meta( $property_id, 'property_agent_info', true );
$agent_post_meta_data = get_post_custom( $prop_agent_info );
$image_src            = wp_get_attachment_image_url( $attach_id );
$user_name            = $prop_agent_info ? ( isset( $agent_post_meta_data['agent_full_name'] ) ? $agent_post_meta_data['agent_full_name'][0] : '' ) : get_the_author();
$user_avatar          = $prop_agent_info ? ( isset( $agent_post_meta_data['agent_avatar'] ) ? $agent_post_meta_data['agent_avatar'][0] : '' ) : get_the_author_meta( 'profile_image_id', get_the_author_meta( 'ID' ) );
$no_avatar            = get_avatar_url( get_the_author_meta( 'ID' ) );
$default_avatar_src   = tfre_get_option( 'default_user_avatar', '' )['url'] != '' ? tfre_get_option( 'default_user_avatar', '' )['url'] : $no_avatar;
$width                = tfre_get_option( 'image_width_property', '425' );
$height               = tfre_get_option( 'image_height_property', '338' );
$no_image_src         = tfre_get_option( 'default_property_image', '' )['url'] != '' ? tfre_get_option( 'default_property_image', '' )['url'] : TF_PLUGIN_URL . 'includes/elementor-widget/assets/images/no-image.jpg';
$image_src            = tfre_image_resize_id( $attach_id, $width, $height, true );
$enable_compare       = tfre_get_option( 'enable_compare', 'y' );
$enable_favorite      = tfre_get_option( 'enable_favorite', 'y' );
$measurement_units    = tfre_get_option( 'measurement_units' );
$class                = isset( $class ) ? $class : '';
?>
<div class="tfre-property-card cards-item <?php echo esc_attr( $css_class_col ); ?>" data-col="<?php echo esc_attr( $css_class_col ); ?>">
	<div class="card property-inner">
		<div class="card-image">
			<a href="<?php echo esc_url( get_permalink( $property_id ) ); ?>" class="property-thumb">
				<img loading="lazy" width="<?php echo esc_attr( $width ) ?>" height="<?php echo esc_attr( $height ) ?>"
					src="<?php echo esc_url( $image_src ) ?>"
					onerror="this.src = '<?php echo esc_url( $no_image_src ) ?>';" alt="<?php the_title() ?>"
					title="<?php the_title() ?>" class="<?php echo esc_attr( $class_image_map ) ?>"
					data-image="<?php echo esc_url( $image_src ? $image_src : $no_image_src ) ?>"
					data-location="<?php echo esc_attr( ! empty( $prop_address ) ? $prop_address : '' ) ?>"
					data-id="<?php echo esc_attr( $property_id ) ?>"
					data-price="<?php echo esc_attr( tfre_format_price( $prop_price_value, $prop_price_unit, true, $prop_enable_short_price_unit ) ); ?>"
					data-price-prefix="<?php echo esc_attr( $prop_price_prefix ) ?>"
					data-price-postfix="<?php echo esc_attr( $prop_price_postfix ) ?>">
			</a>
			<?php if ( ! empty( tfre_get_option( 'enable_card_label' ) ) ) : ?>
				<ul class="list-text">
					<?php if ( $prop_featured == true ) : ?>
						<li>
							<span class="featured-text"><?php esc_html_e( 'Featured', 'tf-real-estate' ); ?></span>
						</li>
					<?php endif; ?>
					<?php if ( is_array( $prop_label ) ) : ?>
						<li>
							<span class="sale-text"><?php echo esc_html( $prop_label[0]->name, 'tf-real-estate' ); ?></span>
						</li>
					<?php endif; ?>
				</ul>
			<?php endif; ?>
			<div class="bottom-infor-features">
				<?php if ( ! empty( tfre_get_option( 'enable_card_price' ) ) && $prop_price_value !== '' ) : ?>
					<span class="tfre-property-price">
						<?php if ( $prop_price_prefix !== '' ) : ?>
							<span class="tfre-prop-price-postfix"><?php echo esc_html( $prop_price_prefix ) ?></span>
						<?php endif; ?>
						<span class="tfre-prop-price-value"><?php echo esc_html( tfre_format_price( $prop_price_value, $prop_price_unit, true, $prop_enable_short_price_unit ) ) ?></span>
						<?php if ( $prop_price_postfix !== '' ) : ?>
							<span class="tfre-prop-price-postfix"> <?php echo esc_html( $prop_price_postfix ) ?></span>
						<?php endif; ?>
					</span>
				<?php endif; ?>
				<?php if ( ! empty( tfre_get_option( 'enable_card_action' ) ) ) : ?>
					<ul class="list-controller">
						<li>
							<a class="compare tfre-compare-property hv-tool" href="javascript:void(0)"
								data-property-id="<?php the_ID() ?>" data-toggle="tooltip"
								data-tooltip="<?php echo esc_attr_e( 'Add Compare', 'tf-real-estate' ); ?>"
								title="<?php echo esc_attr_e( 'Compare', 'tf-real-estate' ); ?>">
								<i class="far fa-plus"></i>
							</a>
						</li>
						<li>
							<?php if ( $enable_favorite == 'y' ) : ?>
								<div class="bookmark">
									<div class="bg-bookmark">
										<?php do_action( 'tfre_favorite_action' ); ?>
									</div>
								</div>
							<?php endif; ?>
						</li>
						<li>
							<a class="property-quick-view zoomGallery hv-tool"
								data-gallery="<?php echo esc_attr( json_encode( $list_gallery_images ) ); ?>"
								href="javascript:void(0)"
								data-tooltip="<?php echo esc_attr_e( 'Quick View', 'tf-real-estate' ); ?>"
								data-toggle="modal" data-target="#property_quick_view_modal"
								data-property-id="<?php esc_attr_e( $property_id ); ?>">
								<img src="<?php echo esc_url( TF_PLUGIN_URL . 'public/assets/image/icon/look.svg' ); ?>"
									alt="icon-map">
							</a>
						</li>
					</ul>
				<?php endif; ?>
			</div>
		</div>
		<div class="card-content">
			<h3 class="tfre-property-title">
				<a target="_blank" title="<?php the_title() ?>" href="<?php echo esc_url( get_permalink( $property_id ) ); ?>"><?php the_title() ?></a>
			</h3>
			<?php if ( ! empty( tfre_get_option( 'enable_card_address' ) ) ) : ?>
				<p class="tfre-property-address">
					<a title="<?php echo esc_attr( $prop_address ) ?>" target="_blank" href="<?php echo esc_url( "//maps.google.com/?q=" . $prop_address . '+' . $prop_zipcode ); ?>">
						<img loading="lazy" src="<?php echo esc_url( TF_PLUGIN_URL . 'public/assets/image/icon/map2.svg' ); ?>" class="icon-property" alt="icon-map"><?php echo esc_html( $prop_address ) ?>
					</a>
				</p>
			<?php endif; ?>
			<div class="description">
				<?php if ( ! empty( tfre_get_option( 'enable_card_bedroom' ) ) ) : ?>
					<div class="property-information">
						<i class="icons icon-bed"></i>
						<?php echo sprintf( esc_html( tfre_get_number_text( $prop_bedrooms, esc_html__( 'Beds', 'tf-real-estate' ), esc_html__( 'Bed', 'tf-real-estate' ) ) . ' %s', 'tf-real-estate' ), '<span class="value">' . $prop_bedrooms . '</span>' ); ?>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( tfre_get_option( 'enable_card_bathroom' ) ) ) : ?>
					<div class="property-information">
						<img loading="lazy" src="<?php echo esc_url( TF_PLUGIN_URL . 'public/assets/image/icon/bath2.svg' ); ?>" class="icon-property" alt="icon-bath">
						<?php echo sprintf( esc_html( tfre_get_number_text( $prop_bathrooms, esc_html__( 'Baths', 'tf-real-estate' ), esc_html__( 'Bath', 'tf-real-estate' ) ) . ' %s', 'tf-real-estate' ), '<span class="value">' . $prop_bathrooms . '</span>' ); ?>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( tfre_get_option( 'enable_card_size' ) ) ) : ?>
					<div class="property-information">
						<img loading="lazy" src="<?php echo esc_url( TF_PLUGIN_URL . 'public/assets/image/icon/size2.svg' ); ?>" class="icon-property" alt="icon-size">
						<?php echo sprintf( esc_html( $measurement_units . ' %s', 'tf-real-estate' ), '<span class="value">' . tfre_get_format_number( intval( $prop_size ) ) . '</span>' ); ?>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( tfre_get_option( 'enable_card_room' ) ) ) : ?>
					<div class="property-information">
						<i class="fal fa-door-closed"></i>
						<?php echo sprintf( esc_html( tfre_get_number_text( $prop_room, esc_html__( 'Rooms', 'tf-real-estate' ), esc_html__( 'Room', 'tf-real-estate' ) ) . ' %s', 'tf-real-estate' ), '<span class="value">' . tfre_get_format_number( intval( $prop_room ) ) . '</span>' ); ?>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( tfre_get_option( 'enable_card_land_area' ) ) ) : ?>
					<div class="property-information">
						<i class="icons icon-size"></i>
						<?php echo sprintf( esc_html__( 'Land ', 'tf-real-estate' ) . $measurement_units . ' %s', '<span class="value">' . tfre_get_format_number( intval( $prop_land_area ) ) . '</span>' ); ?>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( tfre_get_option( 'enable_card_garage' ) ) ) : ?>
					<div class="property-information">
						<i class="fal fa-warehouse"></i>
						<?php echo sprintf( esc_html( tfre_get_number_text( $prop_garage, esc_html__( 'Garages', 'tf-real-estate' ), esc_html__( 'Garage', 'tf-real-estate' ) ) . ' %s', 'tf-real-estate' ), '<span class="value">' . tfre_get_format_number( intval( $prop_garage ) ) . '</span>' ); ?>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( tfre_get_option( 'enable_card_garage_size' ) ) ) : ?>
					<div class="property-information">
						<i class="icons icon-size"></i>
						<?php echo sprintf( esc_html__( 'Garage ', 'tf-real-estate' ) . $measurement_units . ' %s', '<span class="value">' . tfre_get_format_number( intval( $prop_garage_size ) ) . '</span>' ); ?>
					</div>
				<?php endif; ?>
			</div>
			<?php if ( ! empty( tfre_get_option( 'enable_card_agent' ) ) || ! empty( tfre_get_option( 'enable_card_year' ) ) ) : ?>
				<div class="card-bottom">
					<?php if ( ! empty( tfre_get_option( 'enable_card_agent' ) ) ) : ?>
						<a href="<?php echo esc_url( get_permalink( $prop_agent_info ) ); ?>" class="avatar">
							<img alt="<?php echo esc_attr( $user_name ); ?>"
								src="<?php echo esc_attr( tfre_image_resize_id( $user_avatar, '50', '50', true ) ); ?>"
								onerror="this.src = '<?php echo esc_url( $default_avatar_src ) ?>';"
								class="avatar avatar-96 photo" loading="lazy">
							<span class="user-name"><?php echo sprintf( esc_html( '%s' ), $user_name ); ?></span>
						</a>
					<?php endif; ?>
					<?php if ( ! empty( tfre_get_option( 'enable_card_year' ) ) && ! empty( $prop_year ) ) : ?>
						<span class="year"><?php echo wp_kses_post( empty( tfre_get_option( 'enable_convert_year' ) ) ? esc_html__( 'Built in: ', 'tf-real-estate' ) . $prop_year : tfre_get_year_time( $prop_year ) ); ?></span>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>