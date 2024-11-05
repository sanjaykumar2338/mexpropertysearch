<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$address_enable = $keyword_enable = $title_enable = $city_enable = $type_enable = $status_enable = $rooms_enable = $bedrooms_enable = $bathrooms_enable = $price_enable = $price_is_slider = $size_enable = $size_is_slider = $land_size_enable = $land_size_is_slider = $country_enable = $state_enable = $neighborhood_enable = $label_enable = $garage_enable = $garage_size_enable = $garage_size_is_slider = $property_identity_enable = $features_enable = $color_scheme = '';

$attrs = array(
    'layout'                   => "tab",
    'column'                   => 3,
    'color_scheme'             => "color-dark",
    'status_enable'            => tfre_get_show_hide_field('property-status', 'advanced_search_fields'),
    'type_enable'              => tfre_get_show_hide_field('property-type', 'advanced_search_fields'),
    'keyword_enable'           => tfre_get_show_hide_field('keyword', 'advanced_search_fields'),
    'title_enable'             => tfre_get_show_hide_field('property-title', 'advanced_search_fields'),
    'label_enable'             => tfre_get_show_hide_field('property-label', 'advanced_search_fields'),
    'address_enable'           => tfre_get_show_hide_field('property-address', 'advanced_search_fields'),
    'country_enable'           => tfre_get_show_hide_field('property-country', 'advanced_search_fields'),
    'state_enable'             => tfre_get_show_hide_field('province-state', 'advanced_search_fields'),
    'neighborhood_enable'      => tfre_get_show_hide_field('property-neighborhood', 'advanced_search_fields'),
    'rooms_enable'             => tfre_get_show_hide_field('property-rooms', 'advanced_search_fields'),
    'bedrooms_enable'          => tfre_get_show_hide_field('property-bedrooms', 'advanced_search_fields'),
    'bathrooms_enable'         => tfre_get_show_hide_field('property-bathrooms', 'advanced_search_fields'),
    'price_enable'             => tfre_get_show_hide_field('property-price', 'advanced_search_fields'),
    'price_is_slider'          => (tfre_get_option('price_search_field_type', '') == 'slider'),
    'size_enable'              => tfre_get_show_hide_field('property-size', 'advanced_search_fields'),
    'size_is_slider'           => (tfre_get_option('size_search_field_type', '') == 'slider'),
    'land_size_enable'         => tfre_get_show_hide_field('property-land-size', 'advanced_search_fields'),
    'land_size_is_slider'      => (tfre_get_option('land_size_search_field_type', '') == 'slider'),
    'garage_enable'            => tfre_get_show_hide_field('property-garage', 'advanced_search_fields'),
    'garage_size_enable'       => tfre_get_show_hide_field('property-garage-size', 'advanced_search_fields'),
    'garage_size_is_slider'    => (tfre_get_option('garage_size_search_field_type', '') == 'slider'),
    'property_identity_enable' => 'true',
    'features_enable'          => tfre_get_show_hide_field('property-feature', 'advanced_search_fields'),
);

extract(
    shortcode_atts(
        array(
            'layout'                   => 'tab',
            'column'                   => '3',
            'color_scheme'             => 'color-light',
            'status_enable'            => 'true',
            'type_enable'              => 'true',
            'keyword_enable'           => 'true',
            'title_enable'             => 'true',
            'address_enable'           => 'true',
            'country_enable'           => '',
            'state_enable'             => '',
            'neighborhood_enable'      => '',
            'rooms_enable'             => '',
            'bedrooms_enable'          => '',
            'bathrooms_enable'         => '',
            'price_enable'             => 'true',
            'price_is_slider'          => '',
            'size_enable'              => '',
            'size_is_slider'           => '',
            'land_size_enable'         => '',
            'land_size_is_slider'      => '',
            'label_enable'             => '',
            'garage_enable'            => '',
            'garage_size_enable'       => '',
            'garage_size_is_slider'    => '',
            'property_identity_enable' => '',
            'features_enable'          => '',
        ),
        $attrs
    )
);
$order_by               = isset($_GET['orderBy']) ? sanitize_text_field(wp_unslash($_GET['orderBy'])) : '';
$status_default         = '';
$value_status           = isset($_GET['status']) ? (wp_unslash($_GET['status'])) : $status_default;
$value_keyword          = isset($_GET['keyword']) ? (wp_unslash($_GET['keyword'])) : '';
$value_title            = isset($_GET['title']) ? (wp_unslash($_GET['title'])) : '';
$value_address          = isset($_GET['address']) ? (wp_unslash($_GET['address'])) : '';
$value_type             = isset($_GET['type']) ? (wp_unslash($_GET['type'])) : '';
$value_bathrooms        = isset($_GET['bathrooms']) ? (wp_unslash($_GET['bathrooms'])) : '';
$value_rooms            = isset($_GET['rooms']) ? (wp_unslash($_GET['rooms'])) : '';
$value_bedrooms         = isset($_GET['bedrooms']) ? (wp_unslash($_GET['bedrooms'])) : '';
$value_min_price        = isset($_GET['min-price']) ? (wp_unslash($_GET['min-price'])) : '';
$value_max_price        = isset($_GET['max-price']) ? (wp_unslash($_GET['max-price'])) : '';
$value_min_size         = isset($_GET['min-size']) ? (wp_unslash($_GET['min-size'])) : '';
$value_max_size         = isset($_GET['max-size']) ? (wp_unslash($_GET['max-size'])) : '';
$value_min_land_size    = isset($_GET['min-land-size']) ? (wp_unslash($_GET['min-land-size'])) : '';
$value_max_land_size    = isset($_GET['max-land-size']) ? (wp_unslash($_GET['max-land-size'])) : '';
$value_state            = isset($_GET['state']) ? (wp_unslash($_GET['state'])) : '';
$value_country          = isset($_GET['country']) ? (wp_unslash($_GET['country'])) : '';
$value_neighborhood     = isset($_GET['neighborhood']) ? (wp_unslash($_GET['neighborhood'])) : '';
$value_label            = isset($_GET['label']) ? (wp_unslash($_GET['label'])) : '';
$value_garage           = isset($_GET['garage']) ? (wp_unslash($_GET['garage'])) : '';
$value_min_garage_size  = isset($_GET['min-garage-size']) ? (wp_unslash($_GET['min-garage-size'])) : '';
$value_max_garage_size  = isset($_GET['max-garage-size']) ? (wp_unslash($_GET['max-garage-size'])) : '';
$enable_search_features = isset($_GET['enable-search-features']) ? (wp_unslash($_GET['enable-search-features'])) : '0';
$value_features         = isset($_GET['features']) ? (wp_unslash($_GET['features'])) : '';
$placeholder_keyword     = tfre_get_option('placeholder_keyword_field', esc_attr__( 'Enter Keyword...', 'tf-real-estate' ));

if (!empty($value_features)) {
    $value_features = explode(',', $value_features);
}

$options              = array(
    'ajax_url' => esc_url(TF_AJAX_URL),
);
$wrapper_class        = 'tfre-property-advanced-search clearfix';
$wrapper_classes      = array(
    $wrapper_class,
    $layout,
    $color_scheme,
);
$css_class_field      = 'col-md-2 col-sm-3 col-xs-12';
$css_class_half_field = 'col-md-2 col-sm-3 col-xs-12';
$search_fields        = tfre_get_option('advanced_search_fields', array( 'keyword' => 1, 'property-title' => 1, 'property-address' => 1, 'property-status' => 1, 'property-type' => 1, 'property-label' => 1, 'property-country' => 1, 'province-state' => 1, 'property-neighborhood' => 1, 'property-rooms' => 1, 'property-bathrooms' => 1, 'property-bedrooms' => 1, 'property-garage' => 1, 'property-garage-size' => 1, 'property-price' => 1, 'property-size' => 1, 'property-land-size' => 1, 'property-feature' => 1 ));

$enable_advanced_search_form = tfre_get_option('enable_advanced_search_form', 'y');
?>
<?php if ($enable_advanced_search_form == 'y'): ?>
    <div class="tfre-advanced-search-wrap">
        <div data-options="<?php echo esc_attr(json_encode($options)); ?>"
            class="<?php echo esc_attr(join(' ', $wrapper_classes)) ?>">
            <div class="form-search-wrap">
                <div class="form-search-inner">
                    <?php $advanced_search_url = tfre_get_permalink('advanced_search_page'); ?>
                    <div data-href="<?php echo esc_url($advanced_search_url) ?>" class="search-properties-form">
                        <div class="tf-search-form">
                            <div class="tf-search-form-top desktop">
                                <?php if ($status_enable == 'true' && $layout == 'tab'): ?>
                                    <div class="tfre-search-status-tab <?php echo esc_attr($css_class_field); ?> form-group">
                                        <input class="search-field" type='hidden' name="status"
                                            value="<?php echo esc_attr($value_status); ?>" data-default-value="" />
                                        <?php
                                        $property_status = tfre_get_categories('property-status');
                                        if ($property_status):
                                            foreach ($property_status as $status): ?>
                                                <button type="button" data-value="<?php echo esc_attr($status->slug) ?>" class="btn-status-filter <?php if ($value_status == $status->slug)
                                                       echo esc_html(" active", 'tf-real-estate'); ?>"><?php echo esc_html($status->name) ?></button>
                                            <?php endforeach;
                                        endif;
                                        ?>
                                    </div>
                                <?php endif; ?>
                                <div class="tfre-search-group-input">
                                    <?php render_search_fields(array_slice($search_fields, 0, 5), true); ?>
                                </div>
                                <div class="<?php echo esc_attr($css_class_field); ?> form-group pull-right">
                                    <a class="tf-search-more-btn">
                                        <div class="icon-search-more-white">
                                            <?php esc_html_e( 'Filters', 'tf-real-estate' ); ?>
                                            <i class="icon-dreamhome-filter"></i>
                                        </div>
                                        <div class="icon-search-more-black" style="display:none">
                                            <?php esc_html_e( 'Filters', 'tf-real-estate' ); ?>
                                            <i class="fa fa-times"></i>
                                        </div>
                                    </a>
                                </div>
                                <div
                                    class="<?php echo esc_attr($css_class_field); ?> form-group submit-search-form pull-right">
                                    <button type="button" class="<?php echo (tfre_get_option('enable_advanced_search_ajax') === 'n') ? 'tfre-advanced-search-btn' : 'tfre-advanced-search-ajax-btn'; ?>"><i class="fa fa-search"></i>
                                        <?php esc_html_e('Search', 'tf-real-estate') ?>
                                    </button>
                                </div>
                            </div>
                            <div class="tf-search-form-top mobile form-inline">
                                <div class="form-group input-group w-100">
                                    <div class="input-group-prepend">
                                        <button class="input-group-text tf-search-more-btn" data-toggle="collapse"
                                            aria-expanded="false"><i class="icon-dreamhome-filter"></i></button>
                                    </div>
                                    <input class="form-control search-field" value="<?php echo esc_attr($value_keyword); ?>"
                                        data-default-value="" name="keyword" type="text" placeholder="<?php echo $placeholder_keyword; ?>">
                                    <div class="input-group-append">
                                        <button type="button" class="input-group-text <?php echo (tfre_get_option('enable_advanced_search_ajax') === 'n') ? 'tfre-advanced-search-btn' : 'tfre-advanced-search-ajax-btn'; ?>"><i
                                                class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="tf-search-form-bottom desktop">
                                <div class="row">
                                    <?php render_search_fields(array_slice($search_fields, 5)); ?>
                                    <div class="wrapper-action">
                                        <a href="javascript:void(0)"
                                                class="button btn-show-properties tf-search-more-btn"><?php esc_html_e('Show Properties', 'tf-real-estate'); ?></a>
                                        <a href="javascript:void(0)"
                                            class="btn-clear-all"><?php esc_html_e('Clear All', 'tf-real-estate'); ?></a>
                                    </div>
                                </div>
                            </div>
                            <div class="tf-search-form-bottom mobile">
                                <div class="row">
                                    <?php
                                    $search_fields_bottom = array_filter($search_fields, function ($k) { return $k != 'keyword'; }, ARRAY_FILTER_USE_KEY);
                                    render_search_fields($search_fields_bottom);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>