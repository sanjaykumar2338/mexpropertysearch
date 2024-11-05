<?php
/**
 * @var $property_data
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$virtual_tour_type_value          = '0';
$virtual_tour_embedded_code_value = '';
$virtual_tour_upload_image_url    = '';
$attachment_postid                = '';
if ( $property_data ) {
	$virtual_tour_type             = get_post_meta( $property_data->ID, 'virtual_tour_type', false );
	$virtual_tour_type_value       = is_array( $virtual_tour_type ) && isset( $virtual_tour_type[0] ) ? $virtual_tour_type[0] : '';
	$attachment_postid             = get_post_meta( $property_data->ID, 'virtual_tour_upload_image', true );
	$virtual_tour_upload_image_url = isset( $attachment_postid ) ? wp_get_attachment_image_url( $attachment_postid ) : '';

	$virtual_tour_embedded_code       = get_post_meta( $property_data->ID, 'virtual_tour_embedded_code', false );
	$virtual_tour_embedded_code_value = is_array( $virtual_tour_embedded_code ) && isset( $virtual_tour_embedded_code[0] ) ? $virtual_tour_embedded_code[0] : '';
}
$show_hide_property_fields = tfre_get_option( 'show_hide_property_fields', array() );
?>
<div class="tfre-field-wrap tfre-virtual-360">
	<div class="tfre-field-title">
		<h3><?php esc_html_e( 'Virtual Tour 360 ', 'tf-real-estate' ); ?></h3>
	</div>
	<div class="tfre-field tfre-property-virtual-tour-type">
		<?php if ( $show_hide_property_fields['virtual_360'] == 1 ) : ?>
			<div class="form-group">
				<label><?php echo esc_html__( 'Virtual Tour Type', 'tf-real-estate' ) ?></label>
				<div class="group-checkbox">
					<input class="tfre-embedded-code-virtual-360-option" id="property_embedded_code" value="0" type="radio"
						name="virtual_tour_type" <?php checked( $virtual_tour_type_value, '0' ); ?>>
					<label class="form-check-label"
						for="property_embedded_code"><?php esc_html_e( 'Embedded code', 'tf-real-estate' ); ?></label>
				</div>
				<div class="group-checkbox">
					<input class="tfre-upload-image-virtual-360-option" id="property_360_option" value="1" type="radio"
						name="virtual_tour_type" <?php checked( $virtual_tour_type_value, '1' ); ?>>
					<label class="form-check-label"
						for="property_360_option"><?php esc_html_e( 'Upload image', 'tf-real-estate' ); ?></label>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<div class="tfre-field tfre-property-virtual-360">
		<?php if ( $show_hide_property_fields['virtual_360'] == 1 ) : ?>
			<div class="form-group tfre-upload-image-virtual-360" style="display:none;">
				<label class="virtual-360-title"><?php esc_html_e( 'Upload Image Virtual 360', 'tf-real-estate' ); ?></label>
				<div id="tfre_virtual_360_plupload_container">
					<div class="icon-upload-media">
						<img loading="lazy" src="<?php bloginfo( 'template_url' ); ?>/images/svg-theme/icon-upload.svg"
							alt="icon">
					</div>
					<button type="button" id="tfre_choose_image_360"
						title="<?php esc_attr_e( 'Choose image', 'tf-real-estate' ) ?>"><?php esc_html_e( 'Choose image', 'tf-real-estate' ); ?></button>
					<h5>
						<?php esc_html_e( 'or drop image here to upload', 'tf-real-estate' ); ?>
					</h5>
				</div>
				<div id="tfre_virtual_360_errors"></div>
				<div id="tfre_property_virtual_360_view" data-plugin-url="<?php echo esc_url( TF_PLUGIN_URL ); ?>">
					<?php if ( ! empty( $attachment_postid ) && ! empty( $virtual_tour_upload_image_url ) ) {
						?>
						<a class="icon icon-delete" data-property-id="0"
							data-img-id="<?php echo esc_attr( $attachment_postid ) ?>" href="javascript:;"><i
								class="fa fa-times"></i></a>
						<iframe loading="lazy" width="100%" height="200" scrolling="no" allowfullscreen
							src="<?php echo esc_url( TF_PLUGIN_URL . "public/assets/third-party/virtual-360/index.html?image=" . esc_url( $virtual_tour_upload_image_url ) ); ?>"></iframe>
						<input name="virtual_tour_upload_image" type="text" id="image_360_url"
							class="tfre_image_360_url form-control" value="<?php echo esc_attr( $attachment_postid ) ?>">
						<?php
					} ?>
				</div>
			</div>

			<div class="form-group tfre-embedded-code-virtual-360">
				<label
					for="virtual_tour_embedded_code"><?php esc_html_e( 'Embedded Code Virtual 360', 'tf-real-estate' ); ?></label>
				<textarea rows="5" id="virtual_tour_embedded_code"
					name="virtual_tour_embedded_code"><?php echo esc_attr( $virtual_tour_embedded_code_value ); ?></textarea>
			</div>
		<?php endif; ?>
	</div>
</div>