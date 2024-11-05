<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
wp_enqueue_style( 'agent-style' );

global $post;
$agent_id                       = get_the_ID();
$agent_post_meta_data           = get_post_custom( $agent_id );
$custom_agent_image_size_single = tfre_get_option( 'custom_agent_image_size_single', '350x210' );
$agent_full_name                = isset( $agent_post_meta_data['agent_full_name'] ) ? $agent_post_meta_data['agent_full_name'][0] : '';
$agent_full_name                = empty( get_the_title( $agent_id ) ) ? $agent_full_name : get_the_title( $agent_id );
$agent_description              = isset( $agent_post_meta_data['agent_des_info'] ) ? $agent_post_meta_data['agent_des_info'][0] : '';
$agent_company                  = isset( $agent_post_meta_data['agent_company_name'] ) ? $agent_post_meta_data['agent_company_name'][0] : '';
$agent_job                      = isset( $agent_post_meta_data['agent_job'] ) ? $agent_post_meta_data['agent_job'][0] : '';
$agent_email                    = isset( $agent_post_meta_data['agent_email'] ) ? $agent_post_meta_data['agent_email'][0] : '';
$agent_phone                    = isset( $agent_post_meta_data['agent_phone_number'] ) ? $agent_post_meta_data['agent_phone_number'][0] : '';
$agent_location                 = isset( $agent_post_meta_data['agent_location'] ) ? $agent_post_meta_data['agent_location'][0] : '';
$agent_socials                  = isset( $agent_post_meta_data['agent_socials'] ) ? $agent_post_meta_data['agent_socials'][0] : '';
$agent_avatar                   = isset( $agent_post_meta_data['agent_avatar'] ) ? $agent_post_meta_data['agent_avatar'][0] : '';
$agent_position                 = isset( $agent_post_meta_data['agent_position'] ) ? $agent_post_meta_data['agent_position'][0] : '';
$agent_office_number            = isset( $agent_post_meta_data['agent_office_number'] ) ? $agent_post_meta_data['agent_office_number'][0] : '';
$agent_office_address           = isset( $agent_post_meta_data['agent_office_address'] ) ? $agent_post_meta_data['agent_office_address'][0] : '';
$agent_location                 = empty( $agent_office_address ) ? $agent_location : $agent_office_address;
$agent_licenses                 = isset( $agent_post_meta_data['agent_licenses'] ) ? $agent_post_meta_data['agent_licenses'][0] : '';
$agent_facebook                 = isset( $agent_post_meta_data['agent_facebook'] ) ? $agent_post_meta_data['agent_facebook'][0] : '';
$agent_twitter                  = isset( $agent_post_meta_data['agent_twitter'] ) ? $agent_post_meta_data['agent_twitter'][0] : '';
$agent_linkedin                 = isset( $agent_post_meta_data['agent_linkedin'] ) ? $agent_post_meta_data['agent_linkedin'][0] : '';
$agent_website                  = isset( $agent_post_meta_data['agent_website'] ) ? $agent_post_meta_data['agent_website'][0] : '';
$agent_instagram                = isset( $agent_post_meta_data['agent_instagram'] ) ? $agent_post_meta_data['agent_instagram'][0] : '';
$agent_pinterest                = isset( $agent_post_meta_data['agent_pinterest'] ) ? $agent_post_meta_data['agent_pinterest'][0] : '';
$agent_vimeo                    = isset( $agent_post_meta_data['agent_vimeo'] ) ? $agent_post_meta_data['agent_vimeo'][0] : '';
$agent_youtube                  = isset( $agent_post_meta_data['agent_youtube'] ) ? $agent_post_meta_data['agent_youtube'][0] : '';
$agent_tiktok                   = isset( $agent_post_meta_data['agent_tiktok'] ) ? $agent_post_meta_data['agent_tiktok'][0] : '';
$agent_user_id                  = isset( $agent_post_meta_data['agent_user_id'] ) ? $agent_post_meta_data['agent_user_id'][0] : '';
$user                           = get_user_by( 'id', $agent_user_id );
if ( empty( $user ) ) {
	$agent_user_id = 0;
}
?>

<div class="single-agent-element agent-single">
	<div class="agent-single-inner row">
		<?php
		$width          = 350;
		$height         = 210;
		$no_poster_src  = TF_PLUGIN_URL . 'includes/elementor-widget/assets/images/no-image.jpg';
		$default_avatar = tfre_get_option( 'default_user_avatar', '' );
		if ( is_array( $default_avatar ) && $default_avatar['url'] != '' ) {
			$no_poster_src = tfre_image_resize_url( $default_avatar['url'], $width, $height, true )['url'];
		}
		$poster_id  = get_post_thumbnail_id( $agent_id );
		$poster_src = tfre_image_resize_id( $poster_id, $width, $height, true );
		?>
		<div class="col-md-12">
			<div class="agent-author">
				<div class="agent-avatar">
					<img loading="lazy" width="<?php echo esc_attr( $width ) ?>"
						height="<?php echo esc_attr( $height ) ?>" src="<?php echo esc_url( $poster_src ) ?>"
						onerror="this.src = '<?php echo esc_url( $no_poster_src ) ?>';"
						alt="<?php echo esc_attr( $agent_full_name ) ?>"
						title="<?php echo esc_attr( $agent_full_name ) ?>">
				</div>
				<div class="agent-content">
					<?php if ( ! empty( $agent_full_name ) ) : ?>
						<div class="agent-content-title">
							<h2 class="agent-title"><?php echo esc_html( $agent_full_name, 'tf-real-estate' ) ?></h2>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $agent_company ) && ! empty( $agent_position ) ) : ?>
						<div class="agent-content-company">
							<span class="agent-company">
								<?php echo sprintf( __( '%s at %s', 'tf-real-estate' ), $agent_position, $agent_company ) ?>
							</span>
						</div>
					<?php elseif ( ! empty( $agent_company ) ) : ?>
						<div class="agent-content-company">
							<span class="agent-company">
								<?php echo sprintf( __( 'Company Agent at <b>%s</b>', 'tf-real-estate' ), $agent_company ) ?>
							</span>
						</div>
					<?php endif; ?>
					<?php if ( tfre_get_option( 'show_hide_agent_information' )['user_phone'] == 1 && ! empty( $agent_phone ) ) : ?>
						<div class="agent-content-phone">
							<i class="icon-dreamhome-incoming-call"></i>
							<a class="agent-title" href="<?php echo 'tel:' . esc_attr( $agent_phone ); ?>" target="_blank">
								<?php echo esc_html( $agent_phone ) ?>
							</a>
						</div>
					<?php endif; ?>
					<?php if ( tfre_get_option( 'show_hide_agent_information' )['user_email'] == 1 && ! empty( $agent_email ) ) : ?>
						<div class="agent-content-email">
							<i class="icon-dreamhome-email"></i>
							<a class="agent-title" href="<?php echo 'mailto:' . esc_attr( $agent_email ); ?>"
								target="_blank">
								<?php echo esc_html( $agent_email ) ?>
							</a>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $agent_location ) ) : ?>
						<div class="agent-content-address">
							<i class="icon-dreamhome-pin"></i>
							<span class="agent-title"><?php echo esc_html( $agent_location ) ?></span>
						</div>
					<?php endif; ?>
					<?php if ( tfre_get_option( 'show_hide_agent_information' )['user_socials'] == 1 ) : ?>
						<div class="agent-social d-flex">
							<?php if ( ! empty( $agent_website ) ) : ?>
								<div class="agent-content-website item">
									<a title="Website" href="<?php echo esc_url( $agent_website ); ?>" target="_blank">
										<i class="far fa-globe"></i>
									</a>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $agent_facebook ) ) : ?>
								<div class="agent-content-facebook item">
									<a title="Facebook" href="<?php echo esc_url( $agent_facebook ); ?>">
										<i class="fab fa-facebook-f"></i>
									</a>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $agent_twitter ) ) : ?>
								<div class="agent-content-twitter item">
									<a title="Twitter" href="<?php echo esc_url( $agent_twitter ); ?>">
										<i class="fab fa-twitter"></i>
									</a>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $agent_linkedin ) ) : ?>
								<div class="agent-content-linkedin item">
									<a title="Linkedin" href="<?php echo esc_url( $agent_linkedin ); ?>">
										<i class="fab fa-linkedin"></i>
									</a>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $agent_instagram ) ) : ?>
								<div class="agent-content-instagram item">
									<a title="Instagram" href="<?php echo esc_url( $agent_instagram ); ?>">
										<i class="fab fa-instagram"></i>
									</a>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $agent_pinterest ) ) : ?>
								<div class="agent-content-pinterest item">
									<a title="Pinterest" href="<?php echo esc_url( $agent_pinterest ); ?>">
										<i class="fab fa-pinterest"></i>
									</a>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $agent_vimeo ) ) : ?>
								<div class="agent-content-vimeo item">
									<a title="Vimeo" href="<?php echo esc_url( $agent_vimeo ); ?>">
										<i class="fab fa-vimeo"></i>
									</a>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $agent_youtube ) ) : ?>
								<div class="agent-content-youtube item">
									<a title="Youtube" href="<?php echo esc_url( $agent_youtube ); ?>">
										<i class="fab fa-youtube"></i>
									</a>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $agent_tiktok ) ) : ?>
								<div class="agent-content-tiktok item">
									<a title="Tiktok" href="<?php echo esc_url( $agent_tiktok ); ?>">
										<i class="fab fa-tiktok"></i>
									</a>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php if ( ! empty( $agent_description ) ) : ?>
		<div class="agent-description">
			<h3 class="agent-title"><?php echo sprintf( __( 'About %s ', 'tf-real-estate' ), $agent_full_name ) ?></h3>
			<p><?php echo nl2br( wp_kses_post( esc_html( $agent_description ) ) ); ?></p>
		</div>
	<?php endif; ?>
</div>