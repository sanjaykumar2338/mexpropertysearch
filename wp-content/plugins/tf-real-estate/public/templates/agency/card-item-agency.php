<?php
/**
 * @var $terms
 * @var $view
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
wp_enqueue_style( 'agency-style' );

$agency_content     = term_description( $term->term_id );
$agency_content     = wpautop( $agency_content );
$agency_address     = get_term_meta( $term->term_id, 'agency_address', true );
$agency_map_address = get_term_meta( $term->term_id, 'agency_map_address', true );
$agency_logo        = get_term_meta( $term->term_id, 'agency_logo', true );
$agency_banner      = get_term_meta( $term->term_id, 'agency_banner', true );
$agency_location    = get_term_meta( $term->term_id, 'agency_location', true );

$agency_email        = get_term_meta( $term->term_id, 'agency_email', true );
$agency_phone_number = get_term_meta( $term->term_id, 'agency_phone_number', true );
$agency_fax_number   = get_term_meta( $term->term_id, 'agency_fax_number', true );
$agency_licenses     = get_term_meta( $term->term_id, 'agency_licenses', true );

$agency_office_number = get_term_meta( $term->term_id, 'agency_office_number', true );
$agency_website       = get_term_meta( $term->term_id, 'agency_website', true );
$agency_vimeo         = get_term_meta( $term->term_id, 'agency_vimeo', true );
$agency_facebook      = get_term_meta( $term->term_id, 'agency_facebook', true );
$agency_twitter       = get_term_meta( $term->term_id, 'agency_twitter', true );
$agency_linkedin      = get_term_meta( $term->term_id, 'agency_linkedin', true );
$agency_pinterest     = get_term_meta( $term->term_id, 'agency_pinterest', true );
$agency_instagram     = get_term_meta( $term->term_id, 'agency_instagram', true );
$agency_skype         = get_term_meta( $term->term_id, 'agency_skype', true );
$agency_youtube       = get_term_meta( $term->term_id, 'agency_youtube', true );
$agency_tiktok        = get_term_meta( $term->term_id, 'agency_tiktok', true );
$width                = get_option( 'thumbnail_width', '190' );
$height               = get_option( 'thumbnail_height', '190' );
$width2               = get_option( 'thumbnail_width', '350' );
$height2              = get_option( 'thumbnail_height', '202' );
$logo                 = wp_get_attachment_image_url( $agency_logo, 'full' ) ? wp_get_attachment_image_url( $agency_logo, 'full' ) : $agency_logo;
$banner               = wp_get_attachment_image_url( $agency_banner, 'full' ) ? wp_get_attachment_image_url( $agency_banner, 'full' ) : $agency_banner;
?>
<?php if ( $view == 'list' ) : ?>
	<div class="tfre-agency-card-item">
		<div class="agency-avatar">
			<img loading="lazy" width="<?php echo esc_attr( $width ) ?>" height="<?php echo esc_attr( $height ) ?>"
				src="<?php echo esc_url( $logo ) ?>" alt="<?php echo esc_attr( $term->name ) ?>"
				title="<?php echo esc_attr( $term->name ) ?>">

		</div>
		<div class="agency-content">
			<?php if ( ! empty( $term->name ) ) : ?>
				<div class="agency-content-title">
					<h3 class="agency-title"><a
							href="<?php echo esc_url( get_term_link( $term->term_id ) ); ?>"><?php echo esc_html( $term->name ) ?></a>
					</h3>
				</div>
			<?php endif; ?>
			<?php if ( ! empty( $agency_address ) ) : ?>
				<div class="agency-content-address">
					<img loading="lazy" src="<?php echo esc_url( TF_PLUGIN_URL . 'public/assets/image/icon/map.svg' ); ?>"
						alt="icon-map">
					<span class="agency-title"><?php echo esc_html( $agency_address ) ?></span>
				</div>
			<?php endif; ?>
			<?php if ( ! empty( $agency_content ) ) : ?>
				<div class="agency-content-title">
					<?php echo wp_kses_post( sprintf( $agency_content ) ); ?>
				</div>
			<?php endif; ?>
			<div class="card-bottom">
				<div class="content-left d-flex">
					<?php if ( tfre_get_option( 'show_hide_agency_information' )['user_phone'] == 1 && ! empty( $agency_phone_number ) ) : ?>
						<div class="agency-userlink agency-content-phone">
							<a class="agency-title" href="<?php echo 'tel:' . esc_url( $agency_phone_number ); ?>"
								target="_blank">
								<i class="icon-dreamhome-phone-cal"></i>
							</a>
						</div>
					<?php endif; ?>
					<?php if ( tfre_get_option( 'show_hide_agency_information' )['user_email'] == 1 && ! empty( $agency_email ) ) : ?>
						<div class="agency-userlink agency-content-email">
							<a class="agency-title" href="<?php echo 'mailto:' . esc_attr( $agency_email ); ?>" target="_blank">
								<i class="icon-dreamhome-mail2"></i>
							</a>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $agency_website ) ) : ?>
						<div class="agency-userlink agency-content-website">
							<a class="agency-title" href="<?php echo esc_url( $agency_website ); ?>" target="_blank">
								<i class="far fa-globe"></i>
							</a>
						</div>
					<?php endif; ?>
				</div>
				<?php if ( tfre_get_option( 'show_hide_agency_information' )['user_socials'] == 1 ) : ?>
					<div class="content-right">
						<div class="agency-social d-flex  ">
							<?php if ( ! empty( $agency_facebook ) ) : ?>
								<div class="agency-content-facebook d-inline-block">
									<a title="Facebook" href="<?php echo esc_url( $agency_facebook ); ?>">
										<i class="fab fa-facebook-f"></i>
									</a>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $agency_twitter ) ) : ?>
								<div class="agency-content-twitter d-inline-block">
									<a title="Twitter" href="<?php echo esc_url( $agency_twitter ); ?>">
										<i class="fab fa-twitter"></i>
									</a>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $agency_linkedin ) ) : ?>
								<div class="agency-content-linkedin d-inline-block">
									<a title="Linkedin" href="<?php echo esc_url( $agency_linkedin ); ?>">
										<i class="icon-dreamhome-linkedin"></i>
									</a>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php else : ?>
	<div class="tfre-agency-card-item grid">
		<div class="agency-wrapper">
			<?php if ( ! empty( $banner ) ) :
				list( $width, $height ) = getimagesize( $banner ); ?>
				<div class="cover-photo">
					<img loading="lazy" width="<?php echo esc_attr( $width2 ) ?>" height="<?php echo esc_attr( $height2 ) ?>"
						src="<?php echo esc_url( $banner ) ?>" alt="<?php echo esc_attr( $term->name ) ?>"
						title="<?php echo esc_attr( $term->name ) ?>">
				</div>
			<?php endif; ?>
			<?php if ( ! empty( $logo ) ) :
				list( $width, $height ) = getimagesize( $logo ); ?>
				<div class="agency-image">
					<img loading="lazy" width="<?php echo esc_attr( $width ) ?>" height="<?php echo esc_attr( $height ) ?>"
						src="<?php echo esc_url( $logo ) ?>" alt="<?php echo esc_attr( $term->name ) ?>"
						title="<?php echo esc_attr( $term->name ) ?>">
				</div>
			<?php endif; ?>
		</div>
		<div class="agency-content">
			<?php if ( ! empty( $term->name ) ) : ?>
				<div class="agency-content-title">
					<h3 class="agency-title">
						<a
							href="<?php echo esc_url( get_term_link( $term->term_id ) ); ?>"><?php echo esc_html( $term->name ) ?></a>
					</h3>
				</div>
			<?php endif; ?>
			<?php if ( ! empty( $agency_address ) ) : ?>
				<div class="agency-content-address">
					<span class="agency-address"><?php echo esc_html( $agency_address ) ?></span>
				</div>
			<?php endif; ?>
			<?php if ( ! empty( $total_property ) ) : ?>
				<div class="agency-infor-list">
					<strong class="agent-info-title"><?php esc_html_e( 'Listing:', 'tf-real-estate' ); ?></strong>
					<span class="agent-info-value"><?php echo esc_html( $total_property ); ?></span>
				</div>
			<?php endif; ?>
			<?php if ( tfre_get_option( 'show_hide_agency_information' )['user_hotline'] == 1 && ! empty( $agency_phone_number ) ) : ?>
				<div class="agency-infor-list">
					<strong class="agent-info-title"><?php esc_html_e( 'Hotline:', 'tf-real-estate' ); ?></strong>
					<span class="agent-info-value"><?php echo esc_html( $agency_phone_number ); ?></span>
				</div>
			<?php endif; ?>
			<?php if ( tfre_get_option( 'show_hide_agency_information' )['user_phone'] == 1 && ! empty( $agency_phone_number ) ) : ?>
				<div class="agency-infor-list">
					<strong class="agent-info-title"><?php esc_html_e( 'Phone:', 'tf-real-estate' ); ?></strong>
					<span class="agent-info-value"><?php echo esc_html( $agency_phone_number ); ?></span>
				</div>
			<?php endif; ?>
			<?php if ( tfre_get_option( 'show_hide_agency_information' )['user_fax'] == 1 && ! empty( $agency_fax_number ) ) : ?>
				<div class="agency-infor-list">
					<strong class="agent-info-title"><?php esc_html_e( 'Fax:', 'tf-real-estate' ); ?></strong>
					<span class="agent-info-value"><?php echo esc_html( $agency_fax_number ); ?></span>
				</div>
			<?php endif; ?>
			<?php if ( tfre_get_option( 'show_hide_agency_information' )['user_email'] == 1 && ! empty( $agency_email ) ) : ?>
				<div class="agency-infor-list">
					<strong class="agent-info-title"><?php esc_html_e( 'Email:', 'tf-real-estate' ); ?></strong>
					<span class="agent-info-value"><?php echo esc_html( $agency_email ); ?></span>
				</div>
			<?php endif; ?>
			<?php if ( tfre_get_option( 'show_hide_agency_information' )['user_socials'] == 1 ) : ?>
				<div class="agency-social d-flex  ">
					<?php if ( ! empty( $agency_facebook ) ) : ?>
						<div class="agency-content-facebook d-inline-block">
							<a title="Facebook" href="<?php echo esc_url( $agency_facebook ); ?>">
								<i class="fab fa-facebook-f"></i>
							</a>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $agency_twitter ) ) : ?>
						<div class="agency-content-twitter d-inline-block">
							<a title="Twitter" href="<?php echo esc_url( $agency_twitter ); ?>">
								<i class="fab fa-twitter"></i>
							</a>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $agency_linkedin ) ) : ?>
						<div class="agency-content-linkedin d-inline-block">
							<a title="Linkedin" href="<?php echo esc_url( $agency_linkedin ); ?>">
								<i class="icon-dreamhome-linkedin"></i>
							</a>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>