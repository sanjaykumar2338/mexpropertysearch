<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
wp_enqueue_style('agency-style');
wp_enqueue_style('agent-style');
$agency_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

$agency_content       = term_description($agency_term->term_id);
$agency_content       = wpautop($agency_content);
$agency_address       = get_term_meta($agency_term->term_id, 'agency_address', true);
$agency_map_address   = get_term_meta($agency_term->term_id, 'agency_map_address', true);
$agency_banner        = get_term_meta($agency_term->term_id, 'agency_banner', true);
$agency_logo          = get_term_meta($agency_term->term_id, 'agency_logo', true);
$agency_location      = get_term_meta($agency_term->term_id, 'agency_location', true);
$agency_email         = get_term_meta($agency_term->term_id, 'agency_email', true);
$agency_phone_number  = get_term_meta($agency_term->term_id, 'agency_phone_number', true);
$agency_fax_number    = get_term_meta($agency_term->term_id, 'agency_fax_number', true);
$agency_licenses      = get_term_meta($agency_term->term_id, 'agency_licenses', true);
$agency_office_number = get_term_meta($agency_term->term_id, 'agency_office_number', true);
$agency_website       = get_term_meta($agency_term->term_id, 'agency_website', true);
$agency_vimeo         = get_term_meta($agency_term->term_id, 'agency_vimeo', true);
$agency_facebook      = get_term_meta($agency_term->term_id, 'agency_facebook', true);
$agency_twitter       = get_term_meta($agency_term->term_id, 'agency_twitter', true);
$agency_linkedin      = get_term_meta($agency_term->term_id, 'agency_linkedin', true);
$agency_pinterest     = get_term_meta($agency_term->term_id, 'agency_pinterest', true);
$agency_instagram     = get_term_meta($agency_term->term_id, 'agency_instagram', true);
$agency_skype         = get_term_meta($agency_term->term_id, 'agency_skype', true);
$agency_youtube       = get_term_meta($agency_term->term_id, 'agency_youtube', true);
$agency_tiktok        = get_term_meta($agency_term->term_id, 'agency_tiktok', true);

$agent_id             = get_the_ID();
$agent_post_meta_data = get_post_custom($agent_id);

$agent_user_id = isset($agent_post_meta_data['agent_user_id']) ? $agent_post_meta_data['agent_user_id'][0] : '';

// Get Property of Agency
$args       = array(
    'post_type'   => 'agent',
    'post_status' => 'publish',
    'tax_query'   => array(
        'relation' => 'OR',
        array(
            'taxonomy' => 'agencies',
            'field'    => 'slug',
            'terms'    => $agency_term->slug,
            'operator' => 'IN'
        ),
    ),
);
$agent_data = new WP_Query($args);
$agent_id_arr = array();

if ($agent_data->have_posts()) {
    while ($agent_data->have_posts()):
        $agent_data->the_post();
        $agent_id       = get_the_ID();
        $agent_id_arr[] = $agent_id;
    endwhile;
    wp_reset_postdata();
    $agent_id_arr = array_unique($agent_id_arr);
    $agent_id_arr = join(',', $agent_id_arr);
}

if (empty($agent_id_arr)) {
    $agent_id_arr = '-1';
}

$total_property = tfre_get_total_properties_by_user($agent_id_arr);
?>
<div class="agency-single-info">
    <?php
    if (!empty($agency_logo)):
        $logo = wp_get_attachment_image_url($agency_logo, 'full') ? wp_get_attachment_image_url($agency_logo, 'full') : $agency_logo;
        $banner = wp_get_attachment_image_url($agency_banner, 'full') ? wp_get_attachment_image_url($agency_banner, 'full'): $agency_banner;
        list( $width, $height ) = getimagesize($logo); ?>
        <div class="agency-wrapper">
            <div class="cover-photo">
                <img loading="lazy" width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>"
                    src="<?php echo esc_url($banner) ?>" alt="<?php echo esc_attr($agency_term->name) ?>"
                    title="<?php echo esc_attr($agency_term->name) ?>">
            </div>
            <div class="agency-wrap-info">
                <div class="agency-image">
                    <img loading="lazy" width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>"
                        src="<?php echo esc_url($logo) ?>" alt="<?php echo esc_attr($agency_term->name) ?>"
                        title="<?php echo esc_attr($agency_term->name) ?>">
                </div>
                <div class="agency-info">
                    <?php if (!empty($agency_term->name)): ?>
                        <h2><?php echo esc_html($agency_term->name) ?></h2>
                    <?php endif; ?>
                    <?php if (!empty($agency_address)): ?>
                        <div class="agent-content-address">
                            <img loading="lazy" src="<?php echo esc_url(TF_PLUGIN_URL . 'public/assets/image/icon/map.svg'); ?>" alt="icon-map">
                            <span class="agent-title"><?php echo esc_html($agency_address) ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="agent-contact-information">
        <h3 class="agency-title"><?php esc_html_e('Contact Information', 'tf-real-estate'); ?></h3>
        <div class="agency-info-detail">
            <div class="group-infor">
                <div class="agency-infor-list">
                    <strong class="agent-info-title"><?php esc_html_e('Listing:', 'tf-real-estate'); ?></strong>
                    <span class="agent-info-value"><?php echo esc_html(!empty($total_property) ? $total_property : 0); ?></span>
                </div>
                <?php if (tfre_get_option( 'show_hide_agency_information' )['user_hotline'] == 1 && !empty($agency_office_number)): ?>
                    <div class="agency-infor-list">
                        <strong class="agent-info-title"><?php esc_html_e('Hotline:', 'tf-real-estate'); ?></strong>
                        <span class="agent-info-value"><?php echo esc_html($agency_office_number); ?></span>
                    </div>
                <?php endif; ?>
                <?php if (tfre_get_option( 'show_hide_agency_information' )['user_phone'] == 1 && !empty($agency_phone_number)): ?>
                    <div class="agency-infor-list">
                        <strong class="agent-info-title"><?php esc_html_e('Phone:', 'tf-real-estate'); ?></strong>
                        <span class="agent-info-value"><?php echo esc_html($agency_phone_number); ?></span>
                    </div>
                <?php endif; ?>
                <?php if (tfre_get_option( 'show_hide_agency_information' )['user_fax'] == 1 && !empty($agency_fax_number)): ?>
                    <div class="agency-infor-list">
                        <strong class="agent-info-title"><?php esc_html_e('Fax:', 'tf-real-estate'); ?></strong>
                        <span class="agent-info-value"><?php echo esc_html($agency_fax_number); ?></span>
                    </div>
                <?php endif; ?>
                <?php if (tfre_get_option( 'show_hide_agency_information' )['user_email'] == 1 && !empty($agency_email)): ?>
                    <div class="agency-infor-list">
                        <strong class="agent-info-title"><?php esc_html_e('Email:', 'tf-real-estate'); ?></strong>
                        <span class="agent-info-value"><?php echo esc_html($agency_email); ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <?php if (!empty($agency_content)): ?>
                <div class="agent-content">
                    <h3 class="agent-info-title agency-title">
                        <?php echo sprintf(__('<b>About %s</b>', 'tf-real-estate'), $agency_term->name) ?></h3>
                    <span class="agent-info-value"><?php echo sprintf($agency_content); ?></span>
                </div>
            <?php endif; ?>
            <div class="agent-location">
                <h3 class="agent-info-title agency-title"><?php esc_html_e('Location', 'tf-real-estate'); ?></h3>
                <div class="map-container">
                    <input data-field-control="" class="latlng_searching" type="hidden" class="tfre-map-latlng-field"
                        name="agent_location[]"
                        value="<?php echo esc_attr(is_array($agency_location) ? $agency_location[0] : ''); ?>" />
                    <div class="tfre-map-address-field">
                        <div class="tfre-map-address-field-input">
                            <input data-field-control="" class="address_searching" type="hidden"
                                name="agent_location[]"
                                value="<?php echo esc_attr(is_array($agency_location) ? $agency_location[1] : ''); ?>" />
                        </div>
                    </div>
                    <div id="map-agency"></div>
                </div>
            </div>
        </div>
    </div>
</div>
