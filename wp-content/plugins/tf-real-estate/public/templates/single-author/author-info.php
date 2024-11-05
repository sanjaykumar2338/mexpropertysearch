<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$author_id                       = get_the_author_meta( 'ID' );
$author_meta_data                = get_user_meta( $author_id );
$custom_author_image_size_single = tfre_get_option( 'custom_author_image_size_single', '350x210' );
$author_full_name                = get_the_author_meta( 'user_login', $author_id );
$author_website                  = get_the_author_meta( 'user_url', $author_id );
$author_description              = get_the_author_meta( 'description', $author_id );
$author_email                    = get_the_author_meta( 'user_email', $author_id );
$agent_id                        = isset( $author_meta_data['author_agent_id'] ) ? $author_meta_data['author_agent_id'][0] : '';
if ( ! empty( $agent_id ) ) {
	$author_id             = $agent_id;
	$agent_post_meta_data  = get_post_custom( $agent_id );
	$author_full_name      = isset( $agent_post_meta_data['agent_full_name'] ) ? $agent_post_meta_data['agent_full_name'][0] : '';
	$author_full_name      = empty( get_the_title( $agent_id ) ) ? $author_full_name : get_the_title( $agent_id );
	$author_description    = isset( $agent_post_meta_data['agent_des_info'] ) ? $agent_post_meta_data['agent_des_info'][0] : '';
	$author_company        = isset( $agent_post_meta_data['agent_company_name'] ) ? $agent_post_meta_data['agent_company_name'][0] : '';
	$author_job            = isset( $agent_post_meta_data['agent_job'] ) ? $agent_post_meta_data['agent_job'][0] : '';
	$author_email          = isset( $agent_post_meta_data['agent_email'] ) ? $agent_post_meta_data['agent_email'][0] : '';
	$author_phone          = isset( $agent_post_meta_data['agent_phone_number'] ) ? $agent_post_meta_data['agent_phone_number'][0] : '';
	$author_location       = isset( $agent_post_meta_data['agent_location'] ) ? $agent_post_meta_data['agent_location'][0] : '';
	$author_socials        = isset( $agent_post_meta_data['agent_socials'] ) ? $agent_post_meta_data['agent_socials'][0] : '';
	$author_avatar         = isset( $agent_post_meta_data['agent_avatar'] ) ? $agent_post_meta_data['agent_avatar'][0] : '';
	$author_position       = isset( $agent_post_meta_data['agent_position'] ) ? $agent_post_meta_data['agent_position'][0] : '';
	$author_office_number  = isset( $agent_post_meta_data['agent_office_number'] ) ? $agent_post_meta_data['agent_office_number'][0] : '';
	$author_office_address = isset( $agent_post_meta_data['agent_office_address'] ) ? $agent_post_meta_data['agent_office_address'][0] : '';
	$author_location       = empty( $author_office_address ) ? $author_location : $author_office_address;
	$author_licenses       = isset( $agent_post_meta_data['agent_licenses'] ) ? $agent_post_meta_data['agent_licenses'][0] : '';
	$author_facebook       = isset( $agent_post_meta_data['agent_facebook'] ) ? $agent_post_meta_data['agent_facebook'][0] : '';
	$author_twitter        = isset( $agent_post_meta_data['agent_twitter'] ) ? $agent_post_meta_data['agent_twitter'][0] : '';
	$author_linkedin       = isset( $agent_post_meta_data['agent_linkedin'] ) ? $agent_post_meta_data['agent_linkedin'][0] : '';
	$author_website        = isset( $agent_post_meta_data['agent_website'] ) ? $agent_post_meta_data['agent_website'][0] : '';
	$author_instagram      = isset( $agent_post_meta_data['agent_instagram'] ) ? $agent_post_meta_data['agent_instagram'][0] : '';
	$author_pinterest      = isset( $agent_post_meta_data['agent_pinterest'] ) ? $agent_post_meta_data['agent_pinterest'][0] : '';
	$author_vimeo          = isset( $agent_post_meta_data['agent_vimeo'] ) ? $agent_post_meta_data['agent_vimeo'][0] : '';
	$author_youtube        = isset( $agent_post_meta_data['agent_youtube'] ) ? $agent_post_meta_data['agent_youtube'][0] : '';
	$author_tiktok         = isset( $agent_post_meta_data['agent_tiktok'] ) ? $agent_post_meta_data['agent_tiktok'][0] : '';
}
?>

<div class="single-agent-element agent-single">
	<div class="agent-single-inner row">
		<?php
		$avatar_id      = get_post_thumbnail_id( $author_id );
		$no_avatar      = get_avatar_url( $author_id );
		$width          = 350;
		$height         = 210;
		$no_avatar_src  = TF_PLUGIN_URL . 'includes/elementor-widget/assets/images/no-image.jpg';
		$default_avatar = tfre_get_option( 'default_user_avatar', '' );
		if ( is_array( $default_avatar ) && $default_avatar['url'] != '' ) {
			$no_avatar_src = tfre_image_resize_url( $default_avatar['url'], $width, $height, true )['url'];
		} else {
			$no_avatar_src = $no_avatar;
		}
		$avatar_src = tfre_image_resize_id( $avatar_id, $width, $height, true );
		?>
		<div class="col-md-12">
			<div class="agent-author">
				<div class="agent-avatar">
					<img loading="lazy" width="<?php echo esc_attr( $width ) ?>" height="<?php echo esc_attr( $height ) ?>"
						src="<?php echo esc_url( $avatar_src ) ?>"
						onerror="this.src = '<?php echo esc_url( $no_avatar_src ) ?>';"
						alt="<?php echo esc_attr( $author_full_name ) ?>"
						title="<?php echo esc_attr( $author_full_name ) ?>">
				</div>
				<div class="agent-content">
					<?php if ( ! empty( $author_full_name ) ) : ?>
						<div class="agent-content-title">
							<h2 class="agent-title"><?php echo esc_html( $author_full_name ) ?></h2>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $author_company ) && ! empty( $author_position ) ) : ?>
						<div class="agent-content-company">
							<span class="agent-company">
								<?php echo sprintf( __( '%s at %s', 'tf-real-estate' ), $author_position, $author_company ) ?>
							</span>
						</div>
					<?php elseif ( ! empty( $author_company ) ) : ?>
						<div class="agent-content-company">
							<span class="agent-company">
								<?php echo sprintf( __( 'Company author at <b>%s</b>', 'tf-real-estate' ), $author_company ) ?>
							</span>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $author_phone ) ) : ?>
						<div class="agent-content-phone">
							<i class="icon-dreamhome-incoming-call"></i>
							<a class="agent-title" href="<?php echo 'tel:' . esc_attr( $author_phone ); ?>" target="_blank">
								<?php echo esc_html( $author_phone ) ?>
							</a>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $author_email ) ) : ?>
						<div class="agent-content-email">
							<i class="icon-dreamhome-email"></i>
							<a class="agent-title" href="<?php echo 'mailto:' . esc_attr( $author_email ); ?>"
								target="_blank">
								<?php echo esc_html( $author_email ) ?>
							</a>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $author_location ) ) : ?>
						<div class="agent-content-address">
							<i class="icon-dreamhome-pin"></i>
							<span class="agent-title"><?php echo esc_html( $author_location ) ?></span>
						</div>
					<?php endif; ?>
					<div class="agent-social d-flex">
						<?php if ( ! empty( $author_website ) ) : ?>
							<div class="agent-content-website item">
								<a title="Website" href="<?php echo esc_url( $author_website ); ?>" target="_blank">
									<i class="far fa-globe"></i>
								</a>
							</div>
						<?php endif; ?>
						<?php if ( ! empty( $author_facebook ) ) : ?>
							<div class="agent-content-facebook item">
								<a title="Facebook" href="<?php echo esc_url( $author_facebook ); ?>">
									<i class="fab fa-facebook-f"></i>
								</a>
							</div>
						<?php endif; ?>
						<?php if ( ! empty( $author_twitter ) ) : ?>
							<div class="agent-content-twitter item">
								<a title="Twitter" href="<?php echo esc_url( $author_twitter ); ?>">
									<i class="fab fa-twitter"></i>
								</a>
							</div>
						<?php endif; ?>
						<?php if ( ! empty( $author_linkedin ) ) : ?>
							<div class="agent-content-linkedin item">
								<a title="Linkedin" href="<?php echo esc_url( $author_linkedin ); ?>">
									<i class="fab fa-linkedin"></i>
								</a>
							</div>
						<?php endif; ?>
						<?php if ( ! empty( $author_instagram ) ) : ?>
							<div class="agent-content-instagram item">
								<a title="Instagram" href="<?php echo esc_url( $author_instagram ); ?>">
									<i class="fab fa-instagram"></i>
								</a>
							</div>
						<?php endif; ?>
						<?php if ( ! empty( $author_pinterest ) ) : ?>
							<div class="agent-content-pinterest item">
								<a title="Pinterest" href="<?php echo esc_url( $author_pinterest ); ?>">
									<i class="fab fa-pinterest"></i>
								</a>
							</div>
						<?php endif; ?>
						<?php if ( ! empty( $author_vimeo ) ) : ?>
							<div class="agent-content-vimeo item">
								<a title="Vimeo" href="<?php echo esc_url( $author_vimeo ); ?>">
									<i class="fab fa-vimeo"></i>
								</a>
							</div>
						<?php endif; ?>
						<?php if ( ! empty( $author_youtube ) ) : ?>
							<div class="agent-content-youtube item">
								<a title="Youtube" href="<?php echo esc_url( $author_youtube ); ?>">
									<i class="fab fa-youtube"></i>
								</a>
							</div>
						<?php endif; ?>
						<?php if ( ! empty( $author_tiktok ) ) : ?>
							<div class="agent-content-tiktok item">
								<a title="Tiktok" href="<?php echo esc_url( $author_tiktok ); ?>">
									<i class="fab fa-tiktok"></i>
								</a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php if ( ! empty( $author_description ) ) : ?>
		<div class="agent-description">
			<h3 class="agent-title"><?php echo sprintf( __( 'About %s ', 'tf-real-estate' ), $author_full_name ) ?></h3>
			<p><?php echo wp_kses_post( $author_description ) ?></p>
		</div>
	<?php endif; ?>
</div>