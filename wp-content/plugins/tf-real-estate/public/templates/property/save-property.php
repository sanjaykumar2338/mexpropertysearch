<?php
/**
 * @var $property_id
 * @var $mode
 * @var $action
 * @var $submit_button_text
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! is_user_logged_in() ) {
	tfre_get_template_with_arguments( 'global/access-permission.php', array( 'type' => 'not_login' ) );
	return;
}
$tfre_allow_submit_property = tfre_allow_submit_property();
if ( ! $tfre_allow_submit_property ) {
	tfre_get_template_with_arguments( 'global/access-permission.php', array( 'type' => 'not_allow_submit_property' ) );
	return;
}

global $property_data, $current_user;
wp_get_current_user();
$user_id = $current_user->ID;
if ( $mode == 'property-edit' ) {
	$property_data = get_post( $property_id );
	if ( $user_id != 1 && $property_data->post_author != $user_id ) {
		tfre_get_template_with_arguments( 'global/access-permission.php', array( 'type' => 'not_permission' ) );
		return;
	}
} else {
	$user_package_public     = new User_Package_Public();
	$check_package_available = $user_package_public->tfre_check_user_package_available( $user_id );
	if ( $check_package_available == 0 || $check_package_available == -1 || $check_package_available == -2 ) {
		tfre_get_template_with_arguments( 'global/access-permission.php', array( 'type' => 'check_user_package_available', 'check_package_available' => $check_package_available ) );
		return;
	}
}
$property_public = new Property_Public();
$panels          = tfre_get_option( 'add_property_panels_manager', array( 'upload-media' => 1, 'information' => 1, 'price' => 1, 'additional-information' => 1, 'amenities' => 1, 'file-attachment' => 1, 'virtual-360' => 1, 'video' => 1, 'floors' => 1, 'agent' => 1 ) );
$keys            = array_keys( $panels );
?>

<form action="<?php echo esc_url( $action ); ?>" method="post" id="submit_property_form" class="tfre-property-form"
	enctype="multipart/form-data">
	<div class="tfre_message"></div>
	<?php foreach ( $panels as $key => $value ) { ?>
		<?php if ( $panels[ $key ] == 1 ) : ?>
			<fieldset id="<?php echo esc_attr( $key ); ?>">
				<?php
				tfre_get_template_with_arguments( 'property/property-template-parts/' . $key . '.php', array( 'property_data' => $property_data ) ); ?>
			</fieldset>
		<?php endif; ?>
	<?php } ?>
	<button type="submit"
		class="button button-save-property btn-big-spacing"><?php esc_html_e($submit_button_text, 'tf-real-estate'); ?></button>
	<input type="hidden" name="property_mode" value="<?php echo esc_attr( $mode ); ?>" />
	<input type="hidden" name="property_id" value="<?php echo esc_attr( $property_id ); ?>" />
	<?php if ( $mode == 'property-edit' ) : ?>
		<input type="hidden" name="property_author" value="<?php echo esc_attr( $property_data->post_author ); ?>" />
	<?php endif; ?>
</form>