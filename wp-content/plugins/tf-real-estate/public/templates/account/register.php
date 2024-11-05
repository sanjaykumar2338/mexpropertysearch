<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if ( is_user_logged_in() ) {
    echo esc_html_e( 'You are logged in!', 'tf-real-estate' );
    return;
}
?>
<div class="tfre_registration-form">
    <div class="error_message tfre_message"></div>
    <h2><?php esc_html_e( 'Register:', 'tf-real-estate' ); ?></h2>
    <form class="tfre_register" method="post" enctype="multipart/form-data" id="tfre_custom-register-form">
        <div class="container">
            <div class="form-group">
                <label><?php esc_html_e( 'User Name:', 'tf-real-estate' ); ?></label>
                <input type="text" name="username"  
                    placeholder="<?php esc_attr_e( 'User name', 'tf-real-estate' ); ?>" required>
            </div>
            <div class="form-group">
                <label for="email"><?php esc_html_e( 'Email:', 'tf-real-estate' ); ?></label>
                <input type="email" name="email" id="email" 
                    placeholder="<?php esc_attr_e( 'Email', 'tf-real-estate' ); ?>" required>
            </div>
            <div class="form-group">
                <label><?php esc_html_e('Password:', 'tf-real-estate'); ?></label>
                <div class="input-group show_hide_password" >
                    <input type="password" name="password" class="password"
                        placeholder="<?php esc_attr_e('Your passsword', 'tf-real-estate'); ?>" required>
                    <div class="input-group-addon">
                        <i class="far fa-eye-slash togglepassword register" 
                            style="margin-top: 20px; margin-left: -30px; cursor: pointer;"></i>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="confirm_password"><?php esc_html_e('Confirm Password:', 'tf-real-estate'); ?></label>
                <div class="input-group" id="show_hide_confirm_password">
                    <input type="password" name="confirm_password" id="confirm_password"
                        placeholder="<?php esc_attr_e('Confirm password', 'tf-real-estate'); ?>" required>
                    <div class="input-group-addon">
                        <i class="far fa-eye-slash confirmpassword" id="toggleConfirmPassword" style="margin-top: 20px; margin-left: -30px; cursor: pointer;"></i>
                    </div>
                </div>
            </div>
            <button type="submit"><?php esc_html_e( 'Sign Up', 'tf-real-estate' ); ?></button>
        </div>
        <div class="container tfre_signin tfre_login_redirect" id ="tfre_login_redirect">
            <p><?php esc_html_e( 'Already have an account?', 'tf-real-estate' ); ?>
            <a href="#" class="tfre_login_redirect_button"><?php esc_html_e( 'Sign in', 'tf-real-estate' ); ?></a>.</p>
        </div>
	</form>
</div>
