<div class="item">
	<?php
	$agent_id           = get_the_ID();
	$agent_position     = get_post_meta( $agent_id, 'agent_position', true ) ? get_post_meta( $agent_id, 'agent_position', true ) : esc_html( 'N/A', 'tf-real-estate' );
	$agent_email        = get_post_meta( $agent_id, 'agent_email', true ) ? get_post_meta( $agent_id, 'agent_email', true ) : '';
	$agent_phone_number = get_post_meta( $agent_id, 'agent_phone_number', true ) ? get_post_meta( $agent_id, 'agent_phone_number', true ) : '';
	$social_1           = $social_2 = $social_3 = $social_4 = '';
	$icon_1           = $icon_2 = $icon_3 = $icon_4 = '';
	$link_1           = $link_2 = $link_3 = $link_4 = '';
	$icon_1           = '<i class="fab fa-facebook-f"></i>';
	$icon_2           = '<i class="fab fa-twitter"></i>';
	$icon_3           = '<i class="fab fa-linkedin-in"></i>';
	$icon_4           = '<i class="fab fa-instagram"></i>';
	$link_1           = get_post_meta( $agent_id, 'agent_facebook', true ) ? get_post_meta( $agent_id, 'agent_facebook', true ) : '#';
	$link_2           = get_post_meta( $agent_id, 'agent_twitter', true ) ? get_post_meta( $agent_id, 'agent_twitter', true ) : '#';
	$link_3           = get_post_meta( $agent_id, 'agent_linkedin', true ) ? get_post_meta( $agent_id, 'agent_linkedin', true ) : '#';
	$link_4           = get_post_meta( $agent_id, 'agent_instagram', true ) ? get_post_meta( $agent_id, 'agent_instagram', true ) : '#';
	$social_1 .= '<a href="' . $link_1 . '" target="_blank" rel="nofollow">' . $icon_1 . '</a><span class="line"></span>';
	$social_2 .= '<a href="' . $link_2 . '" target="_blank" rel="nofollow">' . $icon_2 . '</a><span class="line"></span>';
	$social_3 .= '<a href="' . $link_3 . '" target="_blank" rel="nofollow">' . $icon_3 . '</a><span class="line"></span>';
	$social_4 .= '<a href="' . $link_4 . '" target="_blank" rel="nofollow">' . $icon_4 . '</a>';
	$toggle_lazy_load = tfre_get_option( 'toggle_lazy_load' );
	$width_image      = '350';
	$height_image     = '411';
	?>
	<div class="agent-post agent-post-<?php the_ID(); ?> <?php echo esc_attr( $settings['show_social'] == 'yes' ? 'has-social' : 'no-social' ); ?>">
		<div class="content-wrap">
			<div class="image-wrap">
				<a href="<?php echo esc_url( get_the_permalink() ); ?>">
					<?php
					$get_id_post_thumbnail = get_post_thumbnail_id();
					if ( $toggle_lazy_load == 'on' ) {
						echo sprintf( '<img loading="lazy" class="image-agent lazy" src="" data-src="%s" alt="image">', empty( $get_id_post_thumbnail ) ? TF_PLUGIN_URL . "includes/elementor-widget/assets/images/no-image.jpg" : tfre_image_resize_id( $get_id_post_thumbnail, $width_image, $height_image, true ) );
					} else {
						echo sprintf( '<img loading="lazy" class="image-agent" src="%s" alt="image">', empty( $get_id_post_thumbnail ) ? TF_PLUGIN_URL . "includes/elementor-widget/assets/images/no-image.jpg" : tfre_image_resize_id( $get_id_post_thumbnail, $width_image, $height_image, true ) );
					}
					?>
				</a>
			</div>
			<div class="content">
				<div class="info">
					<h3 class="title">
						<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_attr( get_the_title() ); ?></a>
					</h3>
					<?php if ( $settings['show_position'] == 'yes' ) : ?>
						<?php if ( $agent_position != '' ) : ?>
							<span class="position"><?php echo esc_attr( $agent_position ); ?></span>
						<?php endif; ?>
					<?php endif; ?>
				</div>
				<?php if ( $settings['show_contact'] == 'yes' ) : ?>
					<div class="contact">
						<a href="tel:<?php echo esc_attr( $agent_phone_number ); ?>" class="phone"><i class="icon-dreamhome-incoming-call"></i> <?php echo esc_attr( $agent_phone_number ); ?></a>
						<a href="mailto:<?php echo esc_attr( $agent_email ); ?>" class="mail"><i class="fas fa-envelope"></i> <?php echo esc_attr( $agent_email ); ?></a>
					</div>
				<?php endif; ?>
				<?php if ( $settings['show_social'] == 'yes' ) : ?>
					<?php
					if ( $icon_1 != '' || $icon_2 != '' || $icon_3 != '' || $icon_4 != '' ) {
						echo '<div class="social">' . ( $social_1 ) . ( $social_2 ) . ( $social_3 ) . ( $social_4 ) . '</div>';
					}
					?>
				<?php endif; ?>
				<?php if ( $settings['show_button'] == 'yes' ) : ?>
					<div class="tf-button">
						<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_attr( $settings['button_text'] ); ?>
							<i class="icon-dreamhome-right-arrow"></i></a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>