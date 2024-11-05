<div class="item">
	<?php
	$property_id                  = get_the_ID();
	$prop_price_value             = get_post_meta( $property_id, 'property_price_value', true );
	$prop_price_unit              = get_post_meta( $property_id, 'property_price_unit', true );
	$prop_price_prefix            = get_post_meta( $property_id, 'property_price_prefix', true );
	$prop_price_postfix           = get_post_meta( $property_id, 'property_price_postfix', true );
	$prop_enable_short_price_unit = tfre_get_option( 'enable_short_price_unit', 0 ) == 1 ? true : false;
	$prop_address                 = get_post_meta( $property_id, 'property_address', true );
	$prop_size                    = get_post_meta( $property_id, 'property_size', true ) ? get_post_meta( $property_id, 'property_size', true ) : 0;
	$prop_land_area               = get_post_meta( $property_id, 'property_land', true ) ? get_post_meta( $property_id, 'property_land', true ) : 0;
	$prop_rooms                   = get_post_meta( $property_id, 'property_rooms', true ) ? get_post_meta( $property_id, 'property_rooms', true ) : 0;
	$prop_bedrooms                = get_post_meta( $property_id, 'property_bedrooms', true ) ? get_post_meta( $property_id, 'property_bedrooms', true ) : 0;
	$prop_bathrooms               = get_post_meta( $property_id, 'property_bathrooms', true ) ? get_post_meta( $property_id, 'property_bathrooms', true ) : 0;
	$prop_garages                 = get_post_meta( $property_id, 'property_garage', true ) ? get_post_meta( $property_id, 'property_garage', true ) : 0;
	$prop_garages_size            = get_post_meta( $property_id, 'property_garage_size', true ) ? get_post_meta( $property_id, 'property_garage_size', true ) : 0;
	$prop_year                    = get_post_meta( $property_id, 'property_year', true ) ? get_post_meta( $property_id, 'property_year', true ) : 0;
	$prop_featured                = get_post_meta( $property_id, 'property_featured', true ) ? get_post_meta( $property_id, 'property_featured', true ) : false;
	$prop_label                   = get_the_terms( $property_id, 'property-label' );
	$prop_gallery_images          = get_post_meta( $property_id, 'gallery_images', true ) ? get_post_meta( $property_id, 'gallery_images', true ) : '';
	$width_image                  = '425';
	$height_image                 = '338';
	$property_thumb               = tfre_image_resize_id( get_post_thumbnail_id( $property_id ), $width_image, $height_image, true );
	$list_gallery_images          = get_sources_property_gallery_images( $prop_gallery_images, true );
	if ( is_array( $list_gallery_images ) ) {
		if ( attachment_url_to_postid( $property_thumb ) != attachment_url_to_postid( $list_gallery_images[0] ) ) {
			array_unshift( $list_gallery_images, $property_thumb );
		}
	}
	$prop_agent_info      = get_post_meta( $property_id, 'property_agent_info', true );
	$agent_post_meta_data = get_post_custom( $prop_agent_info );
	$user_name            = $prop_agent_info ? ( isset( $agent_post_meta_data['agent_full_name'] ) ? $agent_post_meta_data['agent_full_name'][0] : '' ) : get_the_author();
	$user_avatar          = $prop_agent_info ? ( isset( $agent_post_meta_data['agent_avatar'] ) ? $agent_post_meta_data['agent_avatar'][0] : '' ) : get_the_author_meta( 'profile_image_id', get_the_author_meta( 'ID' ) );
	$no_avatar            = get_avatar_url( get_the_author_meta( 'ID' ) );
	$default_image_src    = tfre_get_option( 'default_user_avatar', '' )['url'] != '' ? tfre_get_option( 'default_user_avatar', '' )['url'] : $no_avatar;

	//setting favorite
	global $current_user;
	wp_get_current_user();
	$check_is_favorite = false;
	$user_id           = $current_user->ID;
	$my_favorites      = get_user_meta( $user_id, 'favorites_property', true );

	if ( ! empty( $my_favorites ) ) {
		$check_is_favorite = array_search( $property_id, $my_favorites );
	}
	$title_not_favorite = $title_favorited = '';
	$icon_favorite     = apply_filters( 'tfre_icon_favorite', 'far fa-bookmark' );
	$icon_not_favorite = apply_filters( 'tfre_icon_not_favorite', 'far fa-bookmark' );

	if ( $check_is_favorite !== false ) {
		$css_class = $icon_favorite;
		$title     = esc_attr__( 'It is your favorite', 'tf-real-estate' );
	} else {
		$css_class = $icon_not_favorite;
		$title     = esc_attr__( 'Add to Favorite', 'tf-real-estate' );
	}
	$toggle_lazy_load  = tfre_get_option( 'toggle_lazy_load' );
	$measurement_units = tfre_get_option( 'measurement_units' );
	?>
	<div class="properties-post properties-post-<?php the_ID(); ?>">
		<div class="featured-property">
			<?php if ( $settings['swiper_image_box'] == 'yes' ) : ?>
				<?php if ( is_array( $list_gallery_images ) && count( $list_gallery_images ) > 1 ) : ?>
					<div class="swiper-container carousel-image-box img-style">
						<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="icon-plus" data-mfp-event
							data-gallery="<?php echo esc_attr( json_encode( $list_gallery_images ) ); ?>"></a>
						<div class="swiper-wrapper ">
							<?php foreach ( $list_gallery_images as $key => $value ) : ?>
								<?php if ( $key < $settings['limit_swiper_images'] ) : ?>
									<?php if ( $key === 0 ) : ?>
										<div class="swiper-slide"><img loading="lazy" src="<?php echo esc_attr( $value ); ?>"
												class="swiper-image" alt="images"></div>
									<?php else : ?>
										<?php if ( $toggle_lazy_load == 'on' ) : ?>
											<div class="swiper-slide"><img loading="lazy" src="" data-src="<?php echo esc_attr( $value ); ?>"
													class="swiper-image lazy" alt="images"></div>
										<?php else : ?>
											<div class="swiper-slide"><img loading="lazy" src="<?php echo esc_attr( $value ); ?>"
													class="swiper-image" alt="images"></div>
										<?php endif; ?>
									<?php endif; ?>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
						<div class="swiper-button-next2"><i class="far fa-arrow-right"></i></div>
						<div class="swiper-button-prev2"><i class="far fa-arrow-left"></i> </div>
					</div>
				<?php else : ?>
					<a class="view-gallery" href="<?php echo esc_url( get_the_permalink() ); ?>">
						<?php
						$get_id_post_thumbnail = get_post_thumbnail_id( $property_id );
						if ( $toggle_lazy_load == 'on' ) {
							echo sprintf( '<img loading="lazy" class="lazy" src="" data-src="%s" alt="image">', empty( $get_id_post_thumbnail ) ? TF_PLUGIN_URL . "includes/elementor-widget/assets/images/no-image-314-225.jpg" : tfre_image_resize_id( $get_id_post_thumbnail, $width_image, $height_image, true ) );
						} else {
							echo sprintf( '<img loading="lazy" src="%s" alt="image">', empty( $get_id_post_thumbnail ) ? TF_PLUGIN_URL . "includes/elementor-widget/assets/images/no-image-314-225.jpg" : tfre_image_resize_id( $get_id_post_thumbnail, $width_image, $height_image, true ) );
						}
						?>
					</a>
				<?php endif; ?>
			<?php else : ?>
				<a class="view-gallery" data-gallery="<?php echo esc_attr( json_encode( $list_gallery_images ) ); ?>"
					href="<?php echo esc_url( get_the_permalink() ); ?>">
					<?php
					$get_id_post_thumbnail = get_post_thumbnail_id( $property_id );
					if ( $toggle_lazy_load == 'on' ) {
						echo sprintf( '<img loading="lazy" class="lazy" src="" data-src="%s" alt="image">', empty( $get_id_post_thumbnail ) ? TF_PLUGIN_URL . "includes/elementor-widget/assets/images/no-image-314-225.jpg" : tfre_image_resize_id( $get_id_post_thumbnail, $width_image, $height_image, true ) );
					} else {
						echo sprintf( '<img loading="lazy" src="%s" alt="image">', empty( $get_id_post_thumbnail ) ? TF_PLUGIN_URL . "includes/elementor-widget/assets/images/no-image-314-225.jpg" : tfre_image_resize_id( $get_id_post_thumbnail, $width_image, $height_image, true ) );
					}
					?>
				</a>
			<?php endif; ?>
			<?php if ( $settings['show_price'] == 'yes' ) : ?>
				<span class="price">
					<?php if ( $prop_price_prefix != '' ) : ?>
						<?php echo esc_html__( $prop_price_prefix ); ?>
					<?php endif; ?>
					<?php echo esc_html__( tfre_format_price( $prop_price_value, $prop_price_unit, true, $prop_enable_short_price_unit ) ); ?>
					<?php if ( $prop_price_postfix != '' ) : ?>
						<span><?php echo esc_html__( $prop_price_postfix ); ?></span>
					<?php endif; ?>
				</span>
			<?php endif; ?>
			<?php if ( $settings['show_action'] == 'yes' ) : ?>
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
						<div class="bookmark">
							<div class="bg-bookmark">
								<a href="javascript:void(0)"
									class="tfre-property-favorite hv-tool <?php esc_attr_e( $check_is_favorite !== false ? 'active' : '' ); ?>"
									data-tfre-data-property-id="<?php echo esc_attr( intval( $property_id ) ); ?>"
									data-toggle="tooltip" data-tooltip="<?php echo esc_attr( $title ) ?>"
									data-tfre-data-title-not-favorite="<?php echo esc_attr_e( 'Add to Favorite', 'tf-real-estate' ); ?>"
									data-tfre-data-title-favorited="<?php echo esc_attr_e( 'It is your favorite', 'tf-real-estate' ); ?>"
									data-tfre-data-icon-not-favorite="<?php echo esc_attr( $icon_not_favorite ); ?>"
									data-tfre-data-icon-favorited="<?php echo esc_attr( $icon_favorite ); ?>">
									<i class="<?php echo esc_attr( $css_class ); ?>"></i>
								</a>
							</div>
						</div>
					</li>
					<li>
						<a class="property-quick-view zoomGallery hv-tool"
							data-gallery="<?php echo esc_attr( json_encode( $list_gallery_images ) ); ?>"
							href="javascript:void(0)"
							data-tooltip="<?php echo esc_attr_e( 'Quick View', 'tf-real-estate' ); ?>" data-toggle="modal"
							data-target="#property_quick_view_modal_<?php esc_attr_e( $elementor_id ); ?>"
							data-property-id="<?php esc_attr_e( $property_id ); ?>"
							data-elementor-id="<?php esc_attr_e( $elementor_id ); ?>">
							<i class="icon-dreamhome-search"></i>
						</a>
					</li>
				</ul>
			<?php endif; ?>
			<?php if ( $settings['show_label'] == 'yes' ) : ?>
				<ul class="list-text">
					<?php if ( $prop_featured == true ) : ?>
						<li>
							<span class="featured-text"><?php esc_html_e( 'Featured', 'tf-real-estate' ); ?></span>
						</li>
					<?php endif; ?>
					<?php if ( is_array( $prop_label ) ) : ?>
						<?php foreach($prop_label as $prop_label_attr) :?>
							<?php
							$label_text = $prop_label_attr->name;
							$label_color = get_term_meta( $prop_label_attr->term_id, 'label_color', true ); ?>
							<li>
								<span class="sale-text" style="background: <?php echo esc_attr($label_color); ?>;"><?php echo esc_html( $label_text, 'tf-real-estate' ); ?></span>
							</li>
						<?php endforeach; ?>
					<?php endif; ?>
				</ul>
			<?php endif; ?>
		</div>
		<div class="content">
			<div class="heading">
				<h3 class="title">
					<a
						href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html__( get_the_title() ); ?></a>
				</h3>
				<?php if ( $settings['show_address'] == 'yes' ) : ?>
					<div class="address">
						<i class="icon-dreamhome-location"></i>
						<span><?php echo esc_html__( $prop_address ); ?></span>
					</div>
				<?php endif; ?>
			</div>
			<div class="description">
				<?php if ( $settings['show_bedrooms'] == 'yes' ) : ?>
					<div class="property-information">
						<i class="icons icon-bed"></i>
						<?php echo sprintf( esc_html( tfre_get_number_text( $prop_bedrooms, esc_html__( 'Beds', 'tf-real-estate' ), esc_html__( 'Bed', 'tf-real-estate' ) ) . ' %s', 'tf-real-estate' ), '<span class="value">' . $prop_bedrooms . '</span>' ); ?>
					</div>
				<?php endif; ?>
				<?php if ( $settings['show_bathrooms'] == 'yes' ) : ?>
					<div class="property-information">
						<i class="icon-dreamhome-bath1"></i>
						<?php echo sprintf( esc_html( tfre_get_number_text( $prop_bathrooms, esc_html__( 'Baths', 'tf-real-estate' ), esc_html__( 'Bath', 'tf-real-estate' ) ) . ' %s', 'tf-real-estate' ), '<span class="value">' . $prop_bathrooms . '</span>' ); ?>
					</div>
				<?php endif; ?>
				<?php if ( $settings['show_size'] == 'yes' ) : ?>
					<div class="property-information">
						<i class="icon-dreamhome-size1"></i>
						<?php echo sprintf( esc_html( $measurement_units . ' %s', 'tf-real-estate' ), '<span class="value">' . tfre_get_format_number( intval( $prop_size ) ) . '</span>' ); ?>
					</div>
				<?php endif; ?>
				<?php if ( $settings['show_rooms'] == 'yes' ) : ?>
					<div class="property-information">
						<i class="icon-dreamhome-door"></i>
						<?php echo sprintf( esc_html( tfre_get_number_text( $prop_rooms, esc_html__( 'Rooms', 'tf-real-estate' ), esc_html__( 'Room', 'tf-real-estate' ) ) . ' %s', 'tf-real-estate' ), '<span class="value">' . $prop_rooms . '</span>' ); ?>
					</div>
				<?php endif; ?>
				<?php if ( $settings['show_land_area'] == 'yes' ) : ?>
					<div class="property-information">
						<i class="icon-dreamhome-size1"></i>
						<?php echo sprintf( esc_html__( 'Land ', 'tf-real-estate' ) . $measurement_units . ' %s', '<span class="value">' . tfre_get_format_number( intval( $prop_land_area ) ) . '</span>' ); ?>
					</div>
				<?php endif; ?>
				<?php if ( $settings['show_garages'] == 'yes' ) : ?>
					<div class="property-information">
						<i class="icon-dreamhome-garage"></i>
						<?php echo sprintf( esc_html( tfre_get_number_text( $prop_garages, esc_html__( 'Garages', 'tf-real-estate' ), esc_html__( 'Garage', 'tf-real-estate' ) ) . ' %s', 'tf-real-estate' ), '<span class="value">' . $prop_garages . '</span>' ); ?>
					</div>
				<?php endif; ?>
				<?php if ( $settings['show_garages_size'] == 'yes' ) : ?>
					<div class="property-information">
						<i class="icon-dreamhome-size1"></i>
						<?php echo sprintf( esc_html__( 'Garage ', 'tf-real-estate' ) . $measurement_units . ' %s', '<span class="value">' . tfre_get_format_number( intval( $prop_garages_size ) ) . '</span>' ); ?>
					</div>
				<?php endif; ?>
			</div>
			<?php if ( $settings['show_agent'] == 'yes' ) : ?>
				<div class="line"></div>
				<div class="bottom">
					<a href="<?php echo esc_url( get_permalink( $prop_agent_info ) ); ?>" class="avatar">
						<img alt="<?php echo esc_attr( $user_name ); ?>"
							src="<?php echo esc_attr( tfre_image_resize_id( $user_avatar, '50', '50', true ) ); ?>"
							onerror="this.src = '<?php echo esc_url( $default_image_src ) ?>';"
							class="avatar avatar-96 photo" loading="lazy"><span><?php echo esc_attr( $user_name ); ?></span>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>