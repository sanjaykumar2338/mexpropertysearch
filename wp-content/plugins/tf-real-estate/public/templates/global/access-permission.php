<?php
/**
 * @var $type
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="access-permission">
	<div class="alert alert-warning" role="alert">
		<?php
		switch ( $type ) :
			case 'not_login':
				?>
				<p class="account-sign-in"><?php esc_html_e( 'You need login to continue.', 'tf-real-estate' ); ?></p>
				<?php
				break;
			case 'not_permission':
				echo wp_kses_post( __( '<strong>Access Denied!</strong> You can\'t access this feature', 'tf-real-estate' ) );
				break;
			case 'not_allow_submit_property':
				$enable_submit_property_from_frontend = tfre_get_option( 'allow_submit_property_from_fe', 'y' );
				$all_user_can_submit_property = tfre_get_option( 'all_user_can_submit_property', 'y' );
				$is_agent = tfre_is_agent();
				if ( $enable_submit_property_from_frontend != 'y' ) {
					echo wp_kses_post( __( '<strong>Access Denied!</strong> You can\'t access this feature', 'tf-real-estate' ) );
				} else {
					if ( ! current_user_can( 'administrator' ) && ! $is_agent && $all_user_can_submit_property != 'y' ) {
						echo wp_kses_post( __( '<strong>Access Denied!</strong> You need to become an agent to access this feature.', 'tf-real-estate' ) );
					}
				}
				break;
			case 'check_user_package_available':
				if ( $check_package_available != 1 ) {
					if ( $check_package_available == 0 ) {
						echo wp_kses_post( esc_html__( 'You are not yet subscribed package to list a property! Please click the button below to select a new listing package.', 'tf-real-estate' ) );
					} else if ( $check_package_available == -1 ) {
						echo wp_kses_post( esc_html__( 'Your current listing package has expired! Please click the button below to select a new listing package.', 'tf-real-estate' ) );
					} else if ( $check_package_available == -2 ) {
						echo wp_kses_post( esc_html__( 'Your current listing package doesn\'t allow you to publish any more properties! Please click the button below to select a new listing package.', 'tf-real-estate' ) );
					}
				}
				break;
			default:
				break;
		endswitch;
		?>
	</div>
	<?php if ( $type == 'not_login' ) : ?>
		<button title="<?php esc_attr_e( 'Login Or Register', 'tf-real-estate' ); ?>" type="button" class="button"
			data-toggle="modal" data-target="#tfre_login_register_modal">
			<?php esc_html_e( 'Login Or Register', 'tf-real-estate' ); ?>
		</button>
	<?php endif;
	if ( $type == 'not_allow_submit_property' ) : ?>
		<a class="button" href="<?php echo esc_url( tfre_get_permalink( 'my_profile_page' ) ); ?>"
			title="<?php esc_attr_e( 'Go to My Profile to become an agent', 'tf-real-estate' ) ?>"><?php esc_html_e( 'Become an agent', 'tf-real-estate' ) ?></a>
	<?php endif;
	if ( $type == 'not_permission' ) : ?>
		<a class="button" href="<?php echo esc_url( tfre_get_permalink( 'my_profile_page' ) ); ?>"
			title="<?php esc_attr_e( 'Go to Dashboard', 'tf-real-estate' ) ?>"><?php esc_html_e( 'My Profile', 'tf-real-estate' ) ?></a>
	<?php endif; ?>
	<?php if ( $type == 'check_user_package_available' ) :
		$packages_link = tfre_get_permalink( 'package_page' ); ?>
		<?php if ( $check_package_available != 1 ) : ?>
			<?php if ( $check_package_available == 0 ) : ?>
				<a class="button"
					href="<?php echo esc_url( $packages_link ); ?>"><?php esc_html_e( 'Get a Listing Package', 'tf-real-estate' ); ?></a>
			<?php elseif ( $check_package_available == -1 || $check_package_available == -2 ) : ?>
				<a class="button"
					href="<?php echo esc_url( $packages_link ); ?>"><?php esc_html_e( 'Upgrade Listing Package', 'tf-real-estate' ); ?></a>
			<?php endif; ?>
		<?php endif; ?>
	<?php endif; ?>
	<a class="button-outline" href="<?php echo esc_url( home_url() ); ?>"
		title="<?php esc_attr_e( 'Back To Home', 'tf-real-estate' ) ?>"><?php esc_html_e( 'Home Page', 'tf-real-estate' ) ?></a>
</div>