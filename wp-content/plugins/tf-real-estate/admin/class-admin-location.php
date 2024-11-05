<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if (!class_exists('Admin_Location')) {
    class Admin_Location {
        // Countries submenu page settings
        public function tfre_create_submenu_country() {
            add_submenu_page(
                'edit.php?post_type=real-estate',
                esc_html__('Country', 'tf-real-estate'),
                esc_html__('Country', 'tf-real-estate'),
                'manage_options',
                'country-submenu-page',
                array( $this, 'tfre_countries_page' )
            );
        }

        public function tfre_country_register_settings() {
            register_setting('country-settings-group', 'country_list');
        }

        public function tfre_hanlde_reset_option_country_list(){
            delete_option('country_list');
        }

        public function tfre_countries_page() {
            ?>
            <div class="wrap countries">
                <h1>
                    <?php esc_html_e('Countries', 'tf-real-estate'); ?>
                </h1>
                <p>
                    <?php esc_html_e('Please Choose Country', 'tf-real-estate'); ?>
                </p>
                <button id="reset-option-country"><?php esc_html_e('Reset', 'tf-real-estate'); ?></button>
                <form method="post" action="options.php">
                    <?php settings_fields('country-settings-group'); ?>
                    <?php do_settings_sections('country-settings-group'); ?>
                    <?php
                    $countries_selected = get_option('country_list');
                    $countries_list = tfre_list_countries();
                    ?>
                    <div class="form-group">
                        <?php
                        foreach ($countries_list as $key => $value):
                            ?>
                            <div class="form-control">
                                <input type="checkbox" name="country_list[]" <?php if ($countries_selected) {
                                    echo esc_attr(in_array($key, $countries_selected) ? 'checked' : '');
                                } ?> value="<?php echo esc_attr($key); ?>"
                                    id="<?php echo esc_attr($key); ?>" />
                                <label for="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php submit_button(); ?>
                </form>
            </div>
        <?php
        }
    }
}