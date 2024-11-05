<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if ( is_user_logged_in() ) {
	echo esc_html_e( 'You are logged in!', 'tf-real-estate' );
	return;
}
$show_demo_account = tfre_get_option( 'show_demo_account', 'y' );
?>
<div class="tfre_login-form" id="tfre_login_section">
	<div class="error_message tfre_message"></div>
	<h2><?php esc_html_e( 'Login:', 'tf-real-estate' ); ?></h2>
	<?php if ( $show_demo_account == 'y' ) : ?>
		<ul class="client-account">
			<li><?php esc_html_e( 'Username: ', 'tf-real-estate' ); ?><span><?php esc_html_e( 'agent', 'tf-real-estate' ); ?></span>
			</li>
			<li><?php esc_html_e( 'Password: ', 'tf-real-estate' ); ?><span><?php esc_html_e( 'demo', 'tf-real-estate' ); ?></span>
			</li>
		</ul>
	<?php endif; ?>
	<form class="tfre_login" method="post" enctype="multipart/form-data" id="tfre_custom-login-form">
		<div class="container">
			<div class="form-group">
				<label><?php esc_html_e( 'Account:', 'tf-real-estate' ); ?></label>
				<input type="text" name="username"
					placeholder="<?php esc_attr_e( 'Email or user name', 'tf-real-estate' ); ?>" required>
			</div>
			<div class="form-group">
				<label><?php esc_html_e( 'Password:', 'tf-real-estate' ); ?></label>
				<div class="input-group show_hide_password">
					<input type="password" name="password" class="password"
						placeholder="<?php esc_attr_e( 'Your password', 'tf-real-estate' ); ?>" required>
					<div class="input-group-addon">
						<i class="far fa-eye-slash togglepassword login"
							style="margin-top: 20px; margin-left: -30px; cursor: pointer;"></i>
					</div>
				</div>
			</div>
			<div>
				<a href="javascript:void(0)" class="tfre-reset-password"
					id="tfre-reset-password"><?php esc_html_e( 'Lost password', 'tf-real-estate' ) ?></a>
			</div>
			
			<div class="form-group">
				<button type="submit"><?php esc_html_e( 'Login', 'tf-real-estate' ); ?></button>
				<?php if ( User_Public::tfre_enable_google_login() ) : ?>
					<a class="tfre-login-google tf-btn" href="<?php echo esc_url( $login_google_url ); ?>"><i
							class="fab fa-google"></i><?php esc_html_e( 'Login Google', 'tf-real-estate' ); ?></a>
				<?php endif; ?>
			</div>
		</div>
		<div class="container tfre_register" id="tfre_register_redirect">
			<p><?php esc_html_e( 'Don\'t you have an account?', 'tf-real-estate' ); ?>
				<a href="javascript:void(0)"
					class="tfre_register_button"><?php esc_html_e( 'Register', 'tf-real-estate' ); ?></a>.
			</p>
		</div>
	</form>
</div>
<div id="tfre-reset-password-section" style="display: none">
	<?php echo tfre_get_template_with_arguments( 'account/reset-password.php' ); ?>
	<a href="javascript:void(0)"
		class="tfre_login_redirect"><?php esc_html_e( 'Back to Login', 'tf-real-estate' ) ?></a>
</div>
<div id="tfre_register_section" style="display: none">
	<?php echo do_shortcode( '[custom_register_form]' ); ?>
</div>