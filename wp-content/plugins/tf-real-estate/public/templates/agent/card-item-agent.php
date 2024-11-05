<?php
/**
 * @var $agent
 * @var $view
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wp_enqueue_style( 'agent-style' );

$agent_full_name    = get_post_meta( $agent->ID, 'agent_full_name', true );
$agent_email        = get_post_meta( $agent->ID, 'agent_email', true );
$agent_phone_number = get_post_meta( $agent->ID, 'agent_phone_number', true );
$agent_user_id      = get_post_meta( $agent->ID, 'agent_user_id', true );
$agent_position     = get_post_meta( $agent->ID, 'agent_position', true );
$agent_website      = get_post_meta( $agent->ID, 'agent_website', true );
$agent_vimeo        = get_post_meta( $agent->ID, 'agent_vimeo', true );
$agent_facebook     = get_post_meta( $agent->ID, 'agent_facebook', true );
$agent_twitter      = get_post_meta( $agent->ID, 'agent_twitter', true );
$agent_linkedin     = get_post_meta( $agent->ID, 'agent_linkedin', true );
$agent_pinterest    = get_post_meta( $agent->ID, 'agent_pinterest', true );
$agent_instagram    = get_post_meta( $agent->ID, 'agent_instagram', true );
$agent_youtube      = get_post_meta( $agent->ID, 'agent_youtube', true );
$agent_tiktok       = get_post_meta( $agent->ID, 'agent_tiktok', true );
$width              = get_option( 'thumbnail_width', '350' );
$height             = get_option( 'thumbnail_height', '200' );
$default_poster     = tfre_get_option( 'default_user_avatar', '' );
$no_poster_src      = TF_PLUGIN_URL . 'includes/elementor-widget/assets/images/no-image.jpg';
if ( is_array( $default_poster ) && $default_poster['url'] != '' ) {
	$no_poster_src = tfre_image_resize_url( $default_poster['url'], $width, $height, true )['url'];
}
$agent_poster = get_the_post_thumbnail_url( $agent->ID ) ? get_the_post_thumbnail_url( $agent->ID ) : $no_poster_src;
?>
<?php if ( $view == 'list' ) : ?>
	<div class="infor-agent">
		<div class="agent-avatar">
			<img loading="lazy" width="<?php echo esc_attr( $width ) ?>" height="<?php echo esc_attr( $height ) ?>"
				src="<?php echo esc_url( $agent_poster ) ?>" alt="<?php echo esc_attr( $agent->post_name ) ?>"
				title="<?php echo esc_attr( $agent->post_name ) ?>">
		</div>
		<div class="agent-content">
			<div class="agent-content-title">
				<h3 class="agent-title"><a
						href="<?php echo esc_url( get_permalink( $agent->ID ) ); ?>"><?php echo esc_html( $agent_full_name ? $agent_full_name : $agent->post_title ) ?></a>
				</h3>
			</div>
			<?php if ( ! empty( $agent_position ) ) : ?>
				<div class="agent-content-position">
					<p class="agent-position"><?php echo esc_html( $agent_position ) ?></p>
				</div>
			<?php endif; ?>
			<?php if ( tfre_get_option( 'show_hide_agent_information' )['user_phone'] == 1 && ( ! empty( $agent_phone_number ) ) ) : ?>
				<div class="agent-content-phone">
					<i class="icon-dreamhome-incoming-call"></i>
					<span class="agent-phone"><?php echo esc_html( $agent_phone_number ) ?></span>
				</div>
			<?php endif; ?>
			<?php if ( tfre_get_option( 'show_hide_agent_information' )['user_email'] == 1 && ( ! empty( $agent_email ) ) ) : ?>
				<div class="agent-content-email">
					<i class="icon-dreamhome-email"></i>
					<span class="agent-email"><?php echo esc_html( $agent_email ) ?></span>
				</div>
			<?php endif; ?>
			<?php if ( tfre_get_option( 'show_hide_agent_information' )['user_socials'] == 1 ) : ?>
				<div class="agent-social d-flex">
					<?php if ( ! empty( $agent_website ) ) : ?>
						<div class="agent-content-website d-inline-block">
							<a class="agent-website" href="<?php echo esc_url( $agent_website ); ?>" target="_blank">
								<i class="far fa-globe"></i>
							</a>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $agent_facebook ) ) : ?>
						<div class="agent-content-facebook d-inline-block">
							<a title="Facebook" href="<?php echo esc_url( $agent_facebook ); ?>">
								<i class="fab fa-facebook-f"></i>
							</a>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $agent_twitter ) ) : ?>
						<div class="agent-content-twitter d-inline-block">
							<a title="Twitter" href="<?php echo esc_url( $agent_twitter ); ?>">
								<i class="fab fa-twitter"></i>
							</a>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $agent_linkedin ) ) : ?>
						<div class="agent-content-linkedin d-inline-block">
							<a title="Linkedin" href="<?php echo esc_url( $agent_linkedin ); ?>">
								<i class="fab fa-linkedin"></i>
							</a>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php else : ?>
	<div class="agent-wrapper grid col-md-6">
		<div class="inner">
			<?php if ( ! empty( $agent_poster ) ) :
				list( $width, $height ) = getimagesize( $agent_poster ); ?>
				<div class="agent-wrap-info">
					<div class="agent-image">
						<img loading="lazy" width="<?php echo esc_attr( $width ) ?>" height="<?php echo esc_attr( $height ) ?>"
							src="<?php echo esc_url( $agent_poster ) ?>" alt="<?php echo esc_attr( $agent->post_name ) ?>"
							title="<?php echo esc_attr( $agent->post_name ) ?>">
					</div>
				</div>
			<?php endif; ?>
			<div class="agent-content">
				<?php if ( ! empty( $agent->post_name ) ) : ?>
					<div class="agent-content-title">
						<h3 class="agent-title"><a
								href="<?php echo esc_url( get_permalink( $agent->ID ) ); ?>"><?php echo esc_html( $agent->post_name ) ?></a>
						</h3>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $agent_position ) ) : ?>
					<div class="agent-content-position">
						<p class="agent-position"><?php echo esc_html( $agent_position ) ?></p>
					</div>
				<?php endif; ?>
				<?php if ( tfre_get_option( 'show_hide_agent_information' )['user_phone'] == 1 && ( ! empty( $agent_phone_number ) ) ) : ?>
					<div class="agent-content-phone">
						<i class="icon-dreamhome-incoming-call"></i>
						<span class="agent-phone"><?php echo esc_html( $agent_phone_number ) ?></span>
					</div>
				<?php endif; ?>
				<?php if ( tfre_get_option( 'show_hide_agent_information' )['user_email'] == 1 && ( ! empty( $agent_email ) ) ) : ?>
					<div class="agent-content-email">
						<i class="icon-dreamhome-email"></i>
						<span class="agent-email"><?php echo esc_html( $agent_email ) ?></span>
					</div>
				<?php endif; ?>
				<?php if ( tfre_get_option( 'show_hide_agent_information' )['user_socials'] == 1 ) : ?>
					<div class="agent-social">
						<?php if ( ! empty( $agent_website ) ) : ?>
							<div class="agent-content-website d-inline-block">
								<a href="<?php echo esc_url( $agent_website ); ?>" target="_blank">
									<i class="far fa-globe"></i>
								</a>
							</div>
						<?php endif; ?>
						<?php if ( ! empty( $agent_facebook ) ) : ?>
							<div class="agent-content-facebook d-inline-block">
								<a title="Facebook" href="<?php echo esc_url( $agent_facebook ); ?>">
									<i class="fab fa-facebook-f"></i>
								</a>
							</div>
						<?php endif; ?>
						<?php if ( ! empty( $agent_twitter ) ) : ?>
							<div class="agent-content-twitter d-inline-block">
								<a title="Twitter" href="<?php echo esc_url( $agent_twitter ); ?>">
									<i class="fab fa-twitter"></i>
								</a>
							</div>
						<?php endif; ?>
						<?php if ( ! empty( $agent_linkedin ) ) : ?>
							<div class="agent-content-linkedin d-inline-block">
								<a title="Linkedin" href="<?php echo esc_url( $agent_linkedin ); ?>">
									<i class="fab fa-linkedin"></i>
								</a>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>