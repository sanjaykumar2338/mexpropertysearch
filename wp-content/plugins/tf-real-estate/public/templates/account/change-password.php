<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if (!is_user_logged_in()) {
    tfre_get_template_with_arguments('global/access-permission.php', array( 'type' => 'not_login' ));
    return;
}
?>
<div class="change-password-container">
    <h3 class="heading"><?php esc_html_e('Change password', 'tf-real-estate'); ?></h3>
    <div class="profile-wrap change-password">
        <form action="#" class="tfre-change-password">
            <div id="password_reset_msgs" class="tfre_message message"></div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="old_pass"><?php esc_html_e('Old Password', 'tf-real-estate'); ?></label>
                        <div class="input-group" id="show_hide_old_pass">
                            <input id="old_pass" value="" class="form-control" name="old_pass" type="password">
                            <div class="input-group-addon">
                                <i class="far fa-eye-slash" id="toggleOldPass"
                                    style="margin-top: 20px; margin-left: -30px; cursor: pointer; position: absolute;z-index:3"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="new_pass"><?php esc_html_e('New Password ', 'tf-real-estate'); ?></label>
                        <div class="input-group" id="show_hide_new_pass">
                            <input id="new_pass" value="" class="form-control" name="new_pass" type="password">
                            <div class="input-group-addon">
                                <i class="far fa-eye-slash" id="toggleNewPass"
                                    style="margin-top: 20px; margin-left: -30px; cursor: pointer; position: absolute;z-index:3"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="confirm_pass"><?php esc_html_e('Confirm Password', 'tf-real-estate'); ?></label>
                        <div class="input-group" id="show_hide_confirm_password">
                            <input id="confirm_pass" value="" class="form-control" name="confirm_pass" type="password">
                            <div class="input-group-addon">
                                <i class="far fa-eye-slash confirmpassword" id="toggleConfirmPassword"
                                    style="margin-top: 20px; margin-left: -30px; cursor: pointer; position: absolute;z-index:3"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <?php wp_nonce_field('tfre_change_password_ajax_nonce', 'tfre_security_change_password'); ?>
            <button type="button" class="button display-block" id="tfre_change_pass"><?php esc_html_e('Update Password', 'tf-real-estate'); ?></button>
        </form>
    </div>
</div>