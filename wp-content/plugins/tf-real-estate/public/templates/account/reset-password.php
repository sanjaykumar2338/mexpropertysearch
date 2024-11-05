<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$show_demo_account    = tfre_get_option('show_demo_account', 'y');
?>
<div class="tfre-resset-password container">
	<div class="tfre_messages message tfre_messages_reset_password"></div>
	<form method="post" enctype="multipart/form-data">
        <h4><?php esc_html_e( 'Forgot your password?', 'tf-real-estate' ); ?></h4>
		<?php if ($show_demo_account == 'y'):?>
    		<ul class="client-account">
    		    <li><?php esc_html_e( 'Username: ', 'tf-real-estate' ); ?><span><?php esc_html_e( 'agent', 'tf-real-estate' ); ?></span></li>
    		    <li><?php esc_html_e( 'Password: ', 'tf-real-estate' ); ?><span><?php esc_html_e( 'demo', 'tf-real-estate' ); ?></span></li>
    		</ul>
    	<?php endif;?>
		<div class="form-group control-username">
			<input name="user_login" class="form-control control-icon reset_password_user_login"
			       placeholder="<?php esc_attr_e( 'Enter your username or email', 'tf-real-estate' ); ?>">
			<input type="hidden" name="tfre_security_reset_password"
			       value="<?php echo esc_attr(wp_create_nonce( 'tfre_reset_password_ajax_nonce' )); ?>"/>
			<input type="hidden" name="action" value="tfre_reset_password_ajax">
			<button type="submit"
			        class=" tfre_forgetpass"><?php esc_html_e( 'Get new password', 'tf-real-estate' ); ?></button>
		</div>
	</form>
</div>
