<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$color_scheme = '';

$attrs = array(
    'layout' => "tab",
    'column' => 3,
    'color_scheme' => "color-dark",
);

extract(
    shortcode_atts(
        array(
            'layout' => 'tab',
            'column' => '3',
            'color_scheme' => 'color-light',
        ),
        $attrs
    )
);
$value_keyword = isset($_GET['keyword']) ? (wp_unslash($_GET['keyword'])) : '';
$placeholder_keyword = tfre_get_option('placeholder_keyword_field', esc_attr__('Enter Keyword...', 'tf-real-estate'));

$options = array(
    'ajax_url' => esc_url(TF_AJAX_URL),
);
$wrapper_class = 'tfre-property-advanced-search clearfix';
$wrapper_classes = array(
    $wrapper_class,
    $layout,
    $color_scheme,
);
$advanced_search_url = tfre_get_permalink('advanced_search_page');
$css_class_field = 'col-md-12';
$css_class_half_field = 'col-md-6 col-sm-6 col-xs-12';
$search_fields = tfre_get_option('advanced_search_fields', array('keyword' => 1, 'property-title' => 1, 'property-address' => 1, 'property-status' => 1, 'property-type' => 1, 'property-label' => 1, 'property-country' => 1, 'province-state' => 1, 'property-neighborhood' => 1, 'property-rooms' => 1, 'property-bathrooms' => 1, 'property-bedrooms' => 1, 'property-garage' => 1, 'property-garage-size' => 1, 'property-price' => 1, 'property-size' => 1, 'property-land-size' => 1, 'property-feature' => 1));
?>
<div class="tfre-advanced-search-wrap header-search">
    <div data-options="<?php echo esc_attr(json_encode($options)); ?>"
        class="<?php echo esc_attr(join(' ', $wrapper_classes)) ?>">
        <div class="form-search-wrap">
            <div class="form-search-inner">
                <div data-href="<?php echo esc_url($advanced_search_url) ?>" class="search-properties-form">
                    <div class="tf-search-form">
                        <div class="tf-search-form-top desktop">
                            <div class="tfre-search-group-input">
                                <?php render_search_fields(array_slice($search_fields, 0, 3), true); ?>
                            </div>
                            <div class="<?php echo esc_attr($css_class_field); ?> form-group pull-right">
                                <a class="tf-search-more-btn btn-popup-filter">
                                    <div class="icon-search-more-white">
                                        <?php esc_html_e('Filters', 'tf-real-estate'); ?>
                                        <i class="icon-dreamhome-filter"></i>
                                    </div>
                                    <div class="icon-search-more-black" style="display:none">
                                        <?php esc_html_e('Filters', 'tf-real-estate'); ?>
                                        <i class="icon-dreamhome-filter"></i>
                                    </div>
                                </a>
                            </div>
                            <div
                                class="<?php echo esc_attr($css_class_field); ?> form-group submit-search-form pull-right">
                                <button type="button"
                                    class="<?php echo (tfre_get_option('enable_advanced_search_ajax') === 'n') ? 'tfre-advanced-search-btn' : 'tfre-advanced-search-ajax-btn'; ?>"><i
                                        class="fa fa-search"></i>
                                    <?php esc_html_e('Search', 'tf-real-estate') ?>
                                </button>
                            </div>
                        </div>
                        <div class="tf-search-form-top mobile form-inline">
                            <div class="form-group input-group w-100">
                                <input class="form-control search-field" value="<?php echo esc_attr($value_keyword); ?>"
                                    data-default-value="" name="keyword" type="text"
                                    placeholder="<?php echo $placeholder_keyword; ?>">
                                <div class="input-group-prepend">
                                    <button class="input-group-text tf-search-more-btn btn-popup-filter"
                                        data-toggle="collapse" aria-expanded="false"><i
                                            class="icon-dreamhome-filter"></i></button>
                                </div>
                                <div class="input-group-append">
                                    <button type="button"
                                        class="input-group-text <?php echo (tfre_get_option('enable_advanced_search_ajax') === 'n') ? 'tfre-advanced-search-btn' : 'tfre-advanced-search-ajax-btn'; ?>"><i
                                            class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>