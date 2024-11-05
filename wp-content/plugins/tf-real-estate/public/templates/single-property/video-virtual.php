<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$property_id        = get_the_ID();
$property_meta_data = get_post_custom( $property_id );

$virtual_tour_type_value          = '0';
$virtual_tour_embedded_code_value = '';
$virtual_tour_upload_image_url    = '';
$attachment_postid                = '';

$property_virtual_tour_type = get_post_meta( $property_id, 'virtual_tour_type', false );
$virtual_tour_type_value    = isset( $property_virtual_tour_type[0] ) ? $property_virtual_tour_type[0] : '';

$attachment_postid             = get_post_meta( $property_id, 'virtual_tour_upload_image', false );
$virtual_tour_upload_image_url = isset( $attachment_postid ) ? wp_get_attachment_image_url( $attachment_postid ) : '';

$virtual_tour_embedded_code       = get_post_meta( $property_id, 'virtual_tour_embedded_code', false );
$virtual_tour_embedded_code_value = isset( $virtual_tour_embedded_code[0] ) ? $virtual_tour_embedded_code[0] : '';

$property_video     = get_post_meta( $property_id, 'video_url', false );
$property_video_url = isset( $property_video[0] ) ? $property_video[0] : '';
$show_video         = is_array( tfre_get_option( 'single_property_panels_manager' ) ) ? tfre_get_option( 'single_property_panels_manager' )['video'] : false;
$show_360_virtual   = is_array( tfre_get_option( 'single_property_panels_manager' ) ) ? tfre_get_option( 'single_property_panels_manager' )['virtual-360'] : false;
?>
<?php if ( $show_video == true ) : ?>
	<?php if ( ! empty( $property_video_url ) ) : ?>
		<div id="nav-video" class="single-property-element property-video border">
			<div class="tfre-property-video">
				<div class="tfre-property-header">
					<h3><?php esc_html_e( 'Video', 'tf-real-estate' ); ?></h3>
				</div>
				<div class="tfre-property-info">
					<div class="video">
						<div class="entry-thumb-wrap">
							<?php if ( wp_oembed_get( $property_video_url ) ) : ?>
								<div class="embed-responsive embed-responsive-16by9 embed-responsive-full">
									<?php echo wp_oembed_get( $property_video_url, array( 'wmode' => 'transparent' ) ); ?>
								</div>
							<?php else : ?>
								<div class="embed-responsive embed-responsive-16by9 embed-responsive-full">
									<?php echo wp_kses_post( $property_video_url ); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
<?php endif; ?>

<?php if ( $show_360_virtual == true ) : ?>
	<?php if ( ! empty( $virtual_tour_embedded_code_value ) || ! empty( $virtual_tour_upload_image_url ) ) : ?>
		<div id="nav-virtual-360" class="single-property-element property-virtual border">
			<div class="tfre-property-virtual">
				<div class="tfre-property-header">
					<h3><?php esc_html_e( '360 Virtual Tour', 'tf-real-estate' ); ?></h3>
				</div>
				<div class="tfre-property-info">
					<?php if ( ! empty( $virtual_tour_upload_image_url ) && $virtual_tour_type_value == '1' ) : ?>
						<div id="tfre_virtual_tour_360">
							<iframe loading="lazy" width="100%" height="388" scrolling="no" allowfullscreen
								src="<?php echo esc_url( TF_PLUGIN_URL . "public/assets/third-party/virtual-360/index.html?image=" . esc_url( $virtual_tour_upload_image_url ) ); ?>"></iframe>
							<div class="icon-360">
								<i class="icon-dreamhome-360"></i>
							</div>
						</div>
					<?php elseif ( ! empty( $virtual_tour_embedded_code_value ) && $virtual_tour_type_value == '0' ) : ?>
						<div id="tfre_virtual_tour_360">
							<?php echo ( ! empty( $virtual_tour_embedded_code_value ) ? do_shortcode( $virtual_tour_embedded_code_value ) : '' ) ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
<?php endif; ?>