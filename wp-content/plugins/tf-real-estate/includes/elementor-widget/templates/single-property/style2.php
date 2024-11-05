<div class="single-property-element property-gallery-wrap">
	<?php
	wp_enqueue_style( 'owl.carousel' );
	wp_enqueue_script( 'owl.carousel' );
	$latest_post_query            = get_posts( "post_type=real-estate&post_status=publish&numberposts=1&order=DESC" );
	$latest_post_id               = is_array( $latest_post_query ) ? $latest_post_query[0]->ID : 0;
	$property_id                  = ! empty( $settings['property_id'] ) ? $settings['property_id'] : $latest_post_id;
	$prop_address                 = get_post_meta( $property_id, 'property_address', true );
	$prop_size                    = get_post_meta( $property_id, 'property_size', true ) ? get_post_meta( $property_id, 'property_size', true ) : 0;
	$prop_land_area               = get_post_meta( $property_id, 'property_land', true ) ? get_post_meta( $property_id, 'property_land', true ) : 0;
	$prop_rooms                   = get_post_meta( $property_id, 'property_rooms', true ) ? get_post_meta( $property_id, 'property_rooms', true ) : 0;
	$prop_bedrooms                = get_post_meta( $property_id, 'property_bedrooms', true ) ? get_post_meta( $property_id, 'property_bedrooms', true ) : 0;
	$prop_bathrooms               = get_post_meta( $property_id, 'property_bathrooms', true ) ? get_post_meta( $property_id, 'property_bathrooms', true ) : 0;
	$prop_garages                 = get_post_meta( $property_id, 'property_garage', true ) ? get_post_meta( $property_id, 'property_garage', true ) : 0;
	$prop_garages_size            = get_post_meta( $property_id, 'property_garage_size', true ) ? get_post_meta( $property_id, 'property_garage_size', true ) : 0;
	$prop_status                  = get_the_terms( $property_id, 'property-status' );
	$prop_type                    = get_the_terms( $property_id, 'property-type' );
	$prop_gallery_images          = get_post_meta( $property_id, 'gallery_images', true ) ? get_post_meta( $property_id, 'gallery_images', true ) : '';
	$property_gallery             = json_decode( $prop_gallery_images, true );
	$prop_agent_info              = get_post_meta( $property_id, 'property_agent_info', true );
	$agent_post_meta_data         = get_post_custom( $prop_agent_info );
	$user_name                    = $prop_agent_info ? ( isset( $agent_post_meta_data['agent_full_name'] ) ? $agent_post_meta_data['agent_full_name'][0] : '' ) : get_the_author();
	$user_email                   = $prop_agent_info ? ( isset( $agent_post_meta_data['agent_email'] ) ? $agent_post_meta_data['agent_email'][0] : '' ) : '';
	$user_phone_number            = $prop_agent_info ? ( isset( $agent_post_meta_data['agent_phone_number'] ) ? $agent_post_meta_data['agent_phone_number'][0] : '' ) : '';
	$user_position                = $prop_agent_info ? ( isset( $agent_post_meta_data['agent_position'] ) ? $agent_post_meta_data['agent_position'][0] : '' ) : '';
	$user_avatar                  = $prop_agent_info ? ( isset( $agent_post_meta_data['agent_avatar'] ) ? $agent_post_meta_data['agent_avatar'][0] : '' ) : get_the_author_meta( 'profile_image_id', get_the_author_meta( 'ID' ) );
	$no_avatar                    = get_avatar_url( get_the_author_meta( 'ID' ) );
	$default_image_src            = tfre_get_option( 'default_user_avatar', '' )['url'] != '' ? tfre_get_option( 'default_user_avatar', '' )['url'] : $no_avatar;
	$toggle_lazy_load             = tfre_get_option( 'toggle_lazy_load' );
	$measurement_units            = tfre_get_option( 'measurement_units' );
	?>
	<div class="single-property-post <?php echo esc_attr( $settings['style'] ); ?> single-property-post-<?php the_ID(); ?>">
		<?php if ( is_array( $property_gallery ) && count( $property_gallery ) > 1 ) : ?>
			<div class="featured-single-property">
				<div class="tfre-property-gallery-style2">
					<div class="tfre-property-info slider-style2">
						<div class="single-property-image-main slider-style2 owl-carousel manual tfre-carousel-manual">
							<?php
							$gallery_id       = 'tfre-' . rand();
							$property_gallery = array_slice( $property_gallery, 0, 3 );
							foreach ( $property_gallery as $image ) :
								$image_src      = tfre_image_resize_id( $image, 664, 515, true );
								$image_full_src = wp_get_attachment_image_src( $image, 'full' );
								if ( ! empty( $image_full_src ) && is_array( $image_full_src ) ) {
									?>
									<div class="item property-gallery-item tfre-light-gallery">
										<img loading="lazy" src="<?php echo esc_url( $image_src ) ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
									</div>
								<?php } ?>
							<?php endforeach; ?>
						</div>
						<div class="single-property-image-thumb slider-style2 owl-carousel manual tfre-carousel-manual" data-item="4">
							<?php
							foreach ( $property_gallery as $image ) :
								$image_src = tfre_image_resize_id( $image, 225, 126, true );
								if ( ! empty( $image_src ) ) { ?>
									<div class="item property-gallery-item">
										<img loading="lazy" src="<?php echo esc_url( $image_src ) ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
									</div>
								<?php } ?>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="top">
					<?php if ( is_array( $prop_type ) ) : ?>
						<div class="prop-type">
							<?php $term_icon_id = get_term_meta( $prop_type[0]->term_id, 'type_icon', true ); ?>
							<?php
							if ( $toggle_lazy_load == 'on' ) {
								echo sprintf( '<img loading="lazy" class="image-prop-type lazy" src="" data-src="%s" alt="image" />', empty( $term_icon_id ) ? TF_PLUGIN_URL . 'includes/elementor-widget/assets/images/no-image.jpg' : wp_get_attachment_image_src( $term_icon_id, 'full' )[0] );
							} else {
								echo sprintf( '<img loading="lazy" class="image-prop-type" src="%s" alt="image" />', empty( $term_icon_id ) ? TF_PLUGIN_URL . "includes/elementor-widget/assets/images/no-image.jpg" : wp_get_attachment_image_src( $term_icon_id, 'full' )[0] );
							}
							?>
							<span class="type-text"><?php echo esc_html( $prop_type[0]->name, 'tf-real-estate' ); ?></span>
						</div>
					<?php endif; ?>
					<?php if ( is_array( $prop_status ) ) : ?>
						<span class="status-text"><?php echo esc_html( $prop_status[0]->name, 'tf-real-estate' ); ?></span>
					<?php endif; ?>
				</div>
				<div class="main">
					<div class="heading">
						<h3 class="title">
							<a href="<?php echo esc_url( get_the_permalink( $property_id ) ); ?>"><?php echo esc_attr( get_the_title( $property_id ) ); ?></a>
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
								<?php echo sprintf( esc_html(esc_html__( 'Land ', 'tf-real-estate' ) . $measurement_units . ' %s', 'tf-real-estate' ), '<span class="value">' . tfre_get_format_number( intval( $prop_land_area ) ) . '</span>' ); ?>
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
								<?php echo sprintf( esc_html(esc_html__( 'Garage ', 'tf-real-estate' ) . $measurement_units . ' %s', 'tf-real-estate' ), '<span class="value">' . tfre_get_format_number( intval( $prop_garages_size ) ) . '</span>' ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<?php if ( $settings['show_agent'] == 'yes' || $settings['show_action'] == 'yes' ) : ?>
					<div class="bottom">
						<p class="title"><?php esc_html_e( 'Contact Seller', 'tf-real-estate' ); ?></p>
						<div class="contact-agent">
							<?php if ( $settings['show_agent'] == 'yes' ) : ?>
								<div class="agent">
									<img class="avatar" alt="<?php echo esc_attr( $user_name ); ?>"
										src="<?php echo esc_attr( tfre_image_resize_id( $user_avatar, '50', '50', true ) ); ?>"
										onerror="this.src = '<?php echo esc_url( $default_image_src ) ?>';"
										class="avatar avatar-96 photo" loading="lazy">
									<div class="agent-information">
										<a href="<?php echo esc_url( get_permalink( $prop_agent_info ) ); ?>">
											<p class="agent-name"><?php echo esc_html( $user_name ); ?></p>
										</a>
										<p class="agent-position"><?php echo esc_html( $user_position ); ?></p>
									</div>
								</div>
							<?php endif; ?>
							<?php if ( $settings['show_action'] == 'yes' ) : ?>
								<div class="agent-contact-information">
									<a class="agent-phone" href="<?php echo 'tel:' . esc_url( $user_phone_number ); ?>" target="_blank">
										<i class="icon-dreamhome-phone-cal"></i>
									</a>
									<a class="agent-mail" href="<?php echo 'mailto:' . esc_attr( $user_email ); ?>" target="_blank">
										<i class="icon-dreamhome-mail2"></i>
									</a>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		<?php else : ?>
			<?php echo esc_html__( 'You need add an images in gallery for this property.', 'tf-real-estate' ); ?>
		<?php endif; ?>
	</div>
</div>