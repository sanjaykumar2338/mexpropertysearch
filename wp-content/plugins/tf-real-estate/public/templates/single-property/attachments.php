<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$property_id               = get_the_ID();
$property_attachment_meta  = get_post_meta( $property_id, 'attachments_file', false );
$property_attachments_file = ( isset( $property_attachment_meta ) && is_array( $property_attachment_meta ) && count( $property_attachment_meta ) > 0 ) ? $property_attachment_meta[0] : '';
$property_attachments_file = ! empty( $property_attachments_file ) ? json_decode( $property_attachments_file ) : array();
$property_attachments_file = array_unique( $property_attachments_file );
$show_file_attachments     = is_array( tfre_get_option( 'single_property_panels_manager' ) ) ? tfre_get_option( 'single_property_panels_manager' )['file-attachment'] : false;
if ( $show_file_attachments == true ) :
	if ( $property_attachment_meta && ! empty( $property_attachments_file[0] ) ) : ?>
		<div id="nav-file-attachment" class="single-property-element property-attachments">
			<div class="tfre-property-header">
				<h3><?php esc_html_e( 'File Attachments', 'tf-real-estate' ); ?></h3>
			</div>
			<div class="property-element row">
				<?php
				foreach ( $property_attachments_file as $attach_id ) :
					$attach_url     = isset($attach_id) ? wp_get_attachment_url( $attach_id ) : '';
					$file_type      = wp_check_filetype( $attach_url );
					$file_type_name = isset( $file_type['ext'] ) ? $file_type['ext'] : '';

					if ( ! empty( $file_type_name ) && $attach_url ) :
						$thumb_url = TF_PLUGIN_URL . 'public/assets/image/attachment/attach-' . $file_type_name . '.png';
						$file_name = basename( $attach_url );
						?>
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="media-thumb-wrap">
								<figure class="media-thumb">
									<img loading="lazy" src="<?php echo esc_url( $thumb_url ); ?>"
										alt="<?php echo esc_html( $file_name ) ?>">
								</figure>
								<div class="media-info">
									<p><?php echo esc_html( $file_name ) ?></p>
									<a target="_blank" href="<?php echo esc_url( $attach_url ); ?>"
										class="button"><?php esc_html_e( 'Download', 'tf-real-estate' ); ?></a>
								</div>
							</div>
						</div>
						<?php
					endif;
				endforeach;
				?>
			</div>
		</div>
	<?php endif; ?>
<?php endif; ?>