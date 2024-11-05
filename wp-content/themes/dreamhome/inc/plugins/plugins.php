<?php
// Register action to declare required plugins
add_action('tgmpa_register', 'themesflat_recommend_plugin');
function themesflat_recommend_plugin() {
    
    $plugins = array(
        array(
            'name' => esc_html__('Elementor', 'dreamhome'),
            'slug' => 'elementor',
            'required' => true
        ),
        array(
            'name' => esc_html__('ThemesFlat Core', 'dreamhome'),
            'slug' => 'themesflat-core',
            'source' => THEMESFLAT_DIR . 'inc/plugins/themesflat-core.zip',
            'required' => true
        ),
        array(
            'name' => esc_html__('TF Real Estate', 'dreamhome'),
            'slug' => 'tf-real-estate',
            'source' => 'https://themesflat.co/3rdplugins/tf-real-estate-plugin.zip',
            'required' => true
        ),
        array(
            'name' => esc_html__('Redux Framework', 'dreamhome'),
            'slug' => 'redux-framework',
            'required' => true
        ),
        array(
            'name' => esc_html__('Contact Form 7', 'dreamhome'),
            'slug' => 'contact-form-7',
            'required' => false
        ),    
        array(
            'name' => esc_html__('Mailchimp', 'dreamhome'),
            'slug' => 'mailchimp-for-wp',
            'required' => false
        ),     
        array(
            'name' => esc_html__('WP Mail SMTP', 'dreamhome'),
            'slug' => 'wp-mail-smtp',
            'required' => false
        ),   
        array(
            'name' => esc_html__('One Click Demo Import', 'dreamhome'),
            'slug' => 'one-click-demo-import',
            'required' => false
        )   
    );
    
    tgmpa($plugins);
}

