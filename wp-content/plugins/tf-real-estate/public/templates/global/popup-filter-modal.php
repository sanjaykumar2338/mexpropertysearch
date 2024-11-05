<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$address_enable = $keyword_enable = $title_enable = $city_enable = $type_enable = $status_enable = $rooms_enable = $bedrooms_enable = $bathrooms_enable = $price_enable = $price_is_slider = $size_enable = $size_is_slider = $land_size_enable = $land_size_is_slider = $country_enable = $state_enable = $neighborhood_enable = $label_enable = $garage_enable = $garage_size_enable = $garage_size_is_slider = $property_identity_enable = $features_enable = $color_scheme = '';

$attrs = array(
    'layout' => "tab",
    'column' => 3,
    'color_scheme' => "color-dark",
    'status_enable' => tfre_get_show_hide_field('property-status', 'advanced_search_fields'),
    'type_enable' => tfre_get_show_hide_field('property-type', 'advanced_search_fields'),
    'keyword_enable' => tfre_get_show_hide_field('keyword', 'advanced_search_fields'),
    'title_enable' => tfre_get_show_hide_field('property-title', 'advanced_search_fields'),
    'label_enable' => tfre_get_show_hide_field('property-label', 'advanced_search_fields'),
    'address_enable' => tfre_get_show_hide_field('property-address', 'advanced_search_fields'),
    'country_enable' => tfre_get_show_hide_field('property-country', 'advanced_search_fields'),
    'state_enable' => tfre_get_show_hide_field('province-state', 'advanced_search_fields'),
    'neighborhood_enable' => tfre_get_show_hide_field('property-neighborhood', 'advanced_search_fields'),
    'rooms_enable' => tfre_get_show_hide_field('property-rooms', 'advanced_search_fields'),
    'bedrooms_enable' => tfre_get_show_hide_field('property-bedrooms', 'advanced_search_fields'),
    'bathrooms_enable' => tfre_get_show_hide_field('property-bathrooms', 'advanced_search_fields'),
    'price_enable' => tfre_get_show_hide_field('property-price', 'advanced_search_fields'),
    'price_is_slider' => (tfre_get_option('price_search_field_type', '') == 'slider'),
    'size_enable' => tfre_get_show_hide_field('property-size', 'advanced_search_fields'),
    'size_is_slider' => (tfre_get_option('size_search_field_type', '') == 'slider'),
    'land_size_enable' => tfre_get_show_hide_field('property-land-size', 'advanced_search_fields'),
    'land_size_is_slider' => (tfre_get_option('land_size_search_field_type', '') == 'slider'),
    'garage_enable' => tfre_get_show_hide_field('property-garage', 'advanced_search_fields'),
    'garage_size_enable' => tfre_get_show_hide_field('property-garage-size', 'advanced_search_fields'),
    'garage_size_is_slider' => (tfre_get_option('garage_size_search_field_type', '') == 'slider'),
    'property_identity_enable' => 'true',
    'features_enable' => tfre_get_show_hide_field('property-feature', 'advanced_search_fields'),
);

extract(
    shortcode_atts(
        array(
            'layout' => 'tab',
            'column' => '3',
            'color_scheme' => 'color-light',
            'status_enable' => 'true',
            'type_enable' => 'true',
            'keyword_enable' => 'true',
            'title_enable' => 'true',
            'address_enable' => 'true',
            'country_enable' => '',
            'state_enable' => '',
            'neighborhood_enable' => '',
            'rooms_enable' => '',
            'bedrooms_enable' => '',
            'bathrooms_enable' => '',
            'price_enable' => 'true',
            'price_is_slider' => '',
            'size_enable' => '',
            'size_is_slider' => '',
            'land_size_enable' => '',
            'land_size_is_slider' => '',
            'label_enable' => '',
            'garage_enable' => '',
            'garage_size_enable' => '',
            'garage_size_is_slider' => '',
            'property_identity_enable' => '',
            'features_enable' => '',
        ),
        $attrs
    )
);
$order_by = isset($_GET['orderBy']) ? sanitize_text_field(wp_unslash($_GET['orderBy'])) : '';
$status_default = '';
$value_status = isset($_GET['status']) ? (wp_unslash($_GET['status'])) : $status_default;
$value_keyword = isset($_GET['keyword']) ? (wp_unslash($_GET['keyword'])) : '';
$value_title = isset($_GET['title']) ? (wp_unslash($_GET['title'])) : '';
$value_address = isset($_GET['address']) ? (wp_unslash($_GET['address'])) : '';
$value_type = isset($_GET['type']) ? (wp_unslash($_GET['type'])) : '';
$value_bathrooms = isset($_GET['bathrooms']) ? (wp_unslash($_GET['bathrooms'])) : '';
$value_rooms = isset($_GET['rooms']) ? (wp_unslash($_GET['rooms'])) : '';
$value_bedrooms = isset($_GET['bedrooms']) ? (wp_unslash($_GET['bedrooms'])) : '';
$value_min_price = isset($_GET['min-price']) ? (wp_unslash($_GET['min-price'])) : '';
$value_max_price = isset($_GET['max-price']) ? (wp_unslash($_GET['max-price'])) : '';
$value_min_size = isset($_GET['min-size']) ? (wp_unslash($_GET['min-size'])) : '';
$value_max_size = isset($_GET['max-size']) ? (wp_unslash($_GET['max-size'])) : '';
$value_min_land_size = isset($_GET['min-land-size']) ? (wp_unslash($_GET['min-land-size'])) : '';
$value_max_land_size = isset($_GET['max-land-size']) ? (wp_unslash($_GET['max-land-size'])) : '';
$value_state = isset($_GET['state']) ? (wp_unslash($_GET['state'])) : '';
$value_country = isset($_GET['country']) ? (wp_unslash($_GET['country'])) : '';
$value_neighborhood = isset($_GET['neighborhood']) ? (wp_unslash($_GET['neighborhood'])) : '';
$value_label = isset($_GET['label']) ? (wp_unslash($_GET['label'])) : '';
$value_garage = isset($_GET['garage']) ? (wp_unslash($_GET['garage'])) : '';
$value_min_garage_size = isset($_GET['min-garage-size']) ? (wp_unslash($_GET['min-garage-size'])) : '';
$value_max_garage_size = isset($_GET['max-garage-size']) ? (wp_unslash($_GET['max-garage-size'])) : '';
$enable_search_features = isset($_GET['enable-search-features']) ? (wp_unslash($_GET['enable-search-features'])) : (tfre_get_option('toggle_property_features', 'n') == 'y' ? '0' : '1');
$value_features = isset($_GET['features']) ? (wp_unslash($_GET['features'])) : '';
$placeholder_keyword = tfre_get_option('placeholder_keyword_field', esc_attr__('Enter Keyword...', 'tf-real-estate'));

if (!empty($value_features)) {
    $value_features = explode(',', $value_features);
}

$options = array(
    'ajax_url' => esc_url(TF_AJAX_URL),
);
$wrapper_class = 'tfre-property-advanced-search clearfix';
$wrapper_classes = array(
    $wrapper_class,
    $layout,
    $color_scheme,
);
$css_class_field = 'col-md-12';
$css_class_half_field = 'col-md-6 col-sm-6 col-xs-12';
$search_fields = tfre_get_option('advanced_search_fields', array('keyword' => 1, 'property-title' => 1, 'property-address' => 1, 'property-status' => 1, 'property-type' => 1, 'property-label' => 1, 'property-country' => 1, 'province-state' => 1, 'property-neighborhood' => 1, 'property-rooms' => 1, 'property-bathrooms' => 1, 'property-bedrooms' => 1, 'property-garage' => 1, 'property-garage-size' => 1, 'property-price' => 1, 'property-size' => 1, 'property-land-size' => 1, 'property-feature' => 1));
?>

<div class="modal fade popup_filter_modal" id="popup_filter_modal" tabindex="-1" role="dialog"
    aria-labelledby="PopupFilterModalLabel">
    <div class="modal-xl modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body desktop">
                <div class="wrapper-heading">
                    <h2 class="heading"><?php esc_html_e('Filter', 'tf-real-estate'); ?></h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <?php $min_price = tfre_get_option('minimum_prices_slider', 100);
                $max_price = tfre_get_option('maximum_prices_slider', 5000000);
                $price_is_slider = (tfre_get_option('price_search_field_type', '') == 'slider');
                if ($price_is_slider == 'true') {
                    ?>
                    <div
                        class="tfre-slider-range-price-wrap <?php echo esc_attr($css_class_field); ?> form-group price-field">
                        <?php
                        $min_price_change = empty($value_min_price) ? $min_price : $value_min_price;
                        $max_price_change = empty($value_max_price) ? $max_price : $value_max_price;
                        ?>
                        <div class="tfre-range-slider-price tfre-range-slider-filter"
                            data-min-default="<?php echo esc_attr($min_price) ?>"
                            data-max-default="<?php echo esc_attr($max_price); ?>"
                            data-min="<?php echo esc_attr($min_price_change) ?>"
                            data-max="<?php echo esc_attr($max_price_change); ?>">
                            <label><?php esc_html_e('Price Range', 'tf-real-estate'); ?></label>
                            <div class="tfre-range-slider">
                            </div>
                            <div class="tfre-title-range-slider">
                                <b><?php esc_html_e('From', 'tf-real-estate') ?></b> <span
                                    class="min-value"><?php echo wp_kses_post(tfre_format_price($min_price_change)) ?></span>
                                - <span
                                    class="max-value"><?php echo wp_kses_post(tfre_format_price($max_price_change)) ?></span>
                                <input type="hidden" name="min-price" class="min-input-request"
                                    value="<?php echo esc_attr($min_price_change) ?>">
                                <input type="hidden" name="max-price" class="max-input-request"
                                    value="<?php echo esc_attr($max_price_change) ?>">
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    $property_price_dropdown_min = tfre_get_option('minimum_prices_dropdown', '0,100,300,500,700,900,1100,1300,1500,1700,1900');
                    $property_price_dropdown_max = tfre_get_option('maximum_prices_dropdown', '200,400,600,800,1000,1200,1400,1600,1800,2000');
                    ?>
                    <div class="wrapper-dropdown-ajax">
                        <label><?php esc_html_e('Price', 'tf-real-estate'); ?></label>
                        <div class="dropdown-group">
                            <div class="<?php echo esc_attr($css_class_half_field); ?> price-field form-group">
                                <select name="min-price" title="<?php esc_attr_e('Min Price', 'tf-real-estate') ?>"
                                    class="search-field form-control" data-default-value="">
                                    <option value="">
                                        <?php esc_html_e('Min Price', 'tf-real-estate') ?>
                                    </option>
                                    <?php
                                    $property_price_array = explode(',', $property_price_dropdown_min);
                                    ?>
                                    <?php if (is_array($property_price_array) && !empty($property_price_array)): ?>
                                        <?php foreach ($property_price_array as $price): ?>
                                            <option <?php selected($value_min_price, $price) ?>
                                                value="<?php echo esc_attr($price) ?>">
                                                <?php echo esc_html(tfre_format_price($price)) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </select>
                            </div>
                            <div class="<?php echo esc_attr($css_class_half_field); ?> price-field form-group">
                                <select name="max-price" title="<?php esc_attr_e('Max Price', 'tf-real-estate') ?>"
                                    class="search-field form-control" data-default-value="">
                                    <option value="">
                                        <?php esc_html_e('Max Price', 'tf-real-estate') ?>
                                    </option>
                                    <?php
                                    $property_price_array = explode(',', $property_price_dropdown_max);
                                    ?>
                                    <?php if (is_array($property_price_array) && !empty($property_price_array)): ?>
                                        <?php foreach ($property_price_array as $price): ?>
                                            <option <?php selected($value_max_price, $price) ?>
                                                value="<?php echo esc_attr($price) ?>">
                                                <?php echo esc_html(tfre_format_price($price)) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php
                } ?>
                <?php $min_size = tfre_get_option('minimum_sizes_slider', 0);
                $max_size = tfre_get_option('maximum_sizes_slider', 1000);
                $size_is_slider = (tfre_get_option('size_search_field_type', '') == 'slider');
                $measurement_units = tfre_get_option_measurement_units();
                if ($size_is_slider == 'true') {
                    ?>
                    <div
                        class="tfre-slider-range-size-wrap <?php echo esc_attr($css_class_field); ?> form-group size-field">
                        <?php
                        $min_size_change = empty($value_min_size) ? $min_size : $value_min_size;
                        $max_size_change = empty($value_max_size) ? $max_size : $value_max_size;
                        ?>
                        <div class="tfre-range-slider-size tfre-range-slider-filter"
                            data-min-default="<?php echo esc_attr($min_size) ?>"
                            data-max-default="<?php echo esc_attr($max_size); ?>"
                            data-min="<?php echo esc_attr($min_size_change) ?>"
                            data-max="<?php echo esc_attr($max_size_change); ?>">
                            <label><?php esc_html_e('Size Range', 'tf-real-estate'); ?></label>
                            <div class="tfre-range-slider">
                            </div>
                            <div class="tfre-title-range-slider">
                                <b><?php esc_html_e('Size', 'tf-real-estate') ?></b> <span
                                    class="min-value"><?php echo wp_kses_post(tfre_get_format_number(intval($min_size_change))) ?></span>
                                - <span
                                    class="max-value"><?php echo wp_kses_post(tfre_get_format_number(intval($max_size_change))) ?></span>
                                <input type="hidden" name="min-size" class="min-input-request"
                                    value="<?php echo esc_attr($min_size_change) ?>">
                                <input type="hidden" name="max-size" class="max-input-request"
                                    value="<?php echo esc_attr($max_size_change) ?>">
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    $property_size_dropdown_min = tfre_get_option(
                        'minimum_sizes_dropdown',
                        '0,100,300,500,700,900,1100,1300,1500,1700,1900'
                    );
                    $property_size_dropdown_max = tfre_get_option(
                        'maximum_sizes_dropdown',
                        '200,400,600,800,1000,1200,1400,1600,1800,2000'
                    );
                    ?>
                    <div class="wrapper-dropdown-ajax">
                        <label><?php esc_html_e('Size', 'tf-real-estate'); ?></label>
                        <div class="dropdown-group">
                            <div class="<?php echo esc_attr($css_class_half_field); ?> form-group">
                                <select name="min-size" title="<?php esc_attr_e('Min size', 'tf-real-estate') ?>"
                                    class="search-field form-control" data-default-value="">
                                    <option value="">
                                        <?php esc_html_e('Min size', 'tf-real-estate') ?>
                                    </option>
                                    <?php
                                    $property_size_array = explode(',', $property_size_dropdown_min);
                                    ?>
                                    <?php if (is_array($property_size_array) && !empty($property_size_array)): ?>
                                        <?php foreach ($property_size_array as $size): ?>
                                            <option <?php selected($value_min_size, $size) ?> value="<?php echo esc_attr($size) ?>">
                                                <?php echo wp_kses_post(sprintf('%s %s', tfre_get_format_number(intval($size)), $measurement_units)) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </select>
                            </div>
                            <div class="<?php echo esc_attr($css_class_half_field); ?> form-group">
                                <select name="max-size" title="<?php esc_attr_e('Max Size', 'tf-real-estate') ?>"
                                    class="search-field form-control" data-default-value="">
                                    <option value="">
                                        <?php esc_html_e('Max Size', 'tf-real-estate') ?>
                                    </option>
                                    <?php
                                    $property_size_array = explode(',', $property_size_dropdown_max);
                                    ?>
                                    <?php if (is_array($property_size_array) && !empty($property_size_array)): ?>
                                        <?php foreach ($property_size_array as $size): ?>
                                            <option <?php selected($value_max_size, $size) ?> value="<?php echo esc_attr($size) ?>">
                                                <?php echo wp_kses_post(sprintf('%s %s', tfre_get_format_number(intval($size)), $measurement_units)) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php
                } ?>
                <?php $rooms_list = tfre_get_option('rooms_list_dropdown', '1,2,3,4,5,6,7,8,9,10');
                $rooms_array = explode(',', $rooms_list);
                ?>
                <div class="<?php echo esc_attr($css_class_field); ?> form-group rooms-field">
                    <label><?php esc_html_e('Rooms', 'tf-real-estate'); ?></label>
                    <div class="wrapper-btn-filter">
                        <?php if (is_array($rooms_array) && !empty($rooms_array)): ?>
                            <?php foreach ($rooms_array as $room): ?>
                                <button
                                    class="button-outline filter-room <?php esc_attr_e($value_rooms == $room ? 'active' : '') ?>"
                                    value="<?php echo esc_attr($room) ?>" data-tax="rooms">
                                    <?php echo esc_html($room) ?>
                                </button>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <?php $bedrooms_list = tfre_get_option('bedrooms_list_dropdown', '1,2,3,4,5,6,7,8,9,10');
                $bedrooms_array = explode(',', $bedrooms_list);
                ?>
                <div class="<?php echo esc_attr($css_class_field); ?> form-group rooms-field">
                    <label><?php esc_html_e('BedRooms', 'tf-real-estate'); ?></label>
                    <div class="wrapper-btn-filter">
                        <?php if (is_array($bedrooms_array) && !empty($bedrooms_array)): ?>
                            <?php foreach ($bedrooms_array as $bedroom): ?>
                                <button
                                    class="button-outline filter-bedroom <?php esc_attr_e($value_bedrooms == $bedroom ? 'active' : '') ?>"
                                    value="<?php echo esc_attr($bedroom) ?>" data-tax="bedrooms">
                                    <?php echo esc_html($bedroom) ?>
                                </button>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <?php $bathrooms_list = tfre_get_option('bathrooms_list_dropdown', '1,2,3,4,5,6,7,8,9,10');
                $bathrooms_array = explode(',', $bathrooms_list);
                ?>
                <div class="<?php echo esc_attr($css_class_field); ?> form-group rooms-field">
                    <label><?php esc_html_e('BathRooms', 'tf-real-estate'); ?></label>
                    <div class="wrapper-btn-filter">
                        <?php if (is_array($bathrooms_array) && !empty($bathrooms_array)): ?>
                            <?php foreach ($bathrooms_array as $bathroom): ?>
                                <button
                                    class="button-outline filter-bathroom <?php esc_attr_e($value_bathrooms == $bathroom ? 'active' : '') ?>"
                                    value="<?php echo esc_attr($bathroom) ?>" data-tax="bathrooms">
                                    <?php echo esc_html($bathroom) ?>
                                </button>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>


                <?php $garage_list = tfre_get_option('garages_list_dropdown', '1,2,3,4,5,6,7,8,9,10');
                $garage_array = explode(',', $garage_list);
                ?>
                <div class="<?php echo esc_attr($css_class_field); ?> form-group rooms-field">
                    <label><?php esc_html_e('Garages', 'tf-real-estate'); ?></label>
                    <div class="wrapper-btn-filter">
                        <?php if (is_array($garage_array) && !empty($garage_array)): ?>
                            <?php foreach ($garage_array as $garage): ?>
                                <button
                                    class="button-outline filter-garage <?php esc_attr_e($value_garage == $garage ? 'active' : '') ?>"
                                    value="<?php echo esc_attr($garage) ?>" data-tax="garage">
                                    <?php echo esc_html($garage) ?>
                                </button>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <?php
                tfre_get_template_with_arguments(
                    'advanced-search/advanced-search-fields/property-feature.php',
                    array(
                        'css_class_field' => $css_class_field,
                        'enable_search_features' => $enable_search_features,
                        'enable_toggle_property_features' => tfre_get_option('toggle_property_features', 'n'),
                        'value_features' => $value_features,
                        'enable_label' => true
                    )
                );
                ?>
                <div class="wrapper-action">
                    <a href="javascript:void(0)"
                        class="btn-clear-all"><?php esc_html_e('Clear All', 'tf-real-estate'); ?></a>
                    <a href="javascript:void(0)"
                        class="button btn-show-properties"><?php esc_html_e('Show Properties', 'tf-real-estate'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>