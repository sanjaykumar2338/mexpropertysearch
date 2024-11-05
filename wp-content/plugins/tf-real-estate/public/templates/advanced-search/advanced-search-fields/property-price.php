<?php
/**
 * @var $css_class_field
 * @var $css_class_half_field
 * @var $value_min_price
 * @var $value_max_price
 * @var $value_status
 * @var $price_is_slider
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if ($price_is_slider == 'true') {
    $min_price = tfre_get_option('minimum_prices_slider', 100);
    $max_price = tfre_get_option('maximum_prices_slider', 5000000);
    ?>
    <div class="tfre-slider-range-price-wrap <?php echo esc_attr($css_class_field); ?> form-group price-field">
        <?php
        $min_price_change = ($value_min_price == '') ? $min_price : $value_min_price;
        $max_price_change = ($value_max_price == '') ? $max_price : $value_max_price;
        ?>
        <div class="tfre-range-slider-price tfre-range-slider-filter" data-min-default="<?php echo esc_attr($min_price) ?>"
            data-max-default="<?php echo esc_attr($max_price); ?>" data-min="<?php echo esc_attr($min_price_change) ?>"
            data-max="<?php echo esc_attr($max_price_change); ?>">
            <div class="tfre-title-range-slider">
                <b><?php esc_html_e('From', 'tf-real-estate') ?></b> <span class="min-value"><?php echo wp_kses_post(tfre_format_price($min_price_change)) ?></span> - <span class="max-value"><?php echo wp_kses_post(tfre_format_price($max_price_change)) ?></span>
                <input type="hidden" name="min-price" class="min-input-request"
                    value="<?php echo esc_attr($min_price_change) ?>">
                <input type="hidden" name="max-price" class="max-input-request"
                    value="<?php echo esc_attr($max_price_change) ?>">
            </div>
            <div class="tfre-range-slider">
            </div>
        </div>
    </div>
    <?php
} else {
    $property_price_dropdown_min = tfre_get_option('minimum_prices_dropdown', '0,100,300,500,700,900,1100,1300,1500,1700,1900');
    $property_price_dropdown_max = tfre_get_option('maximum_prices_dropdown', '200,400,600,800,1000,1200,1400,1600,1800,2000');
    ?>
    <div class="<?php echo esc_attr($css_class_half_field); ?> price-field form-group">
        <select name="min-price" title="<?php esc_attr_e('Min Price', 'tf-real-estate') ?>"
            class="tfre-min-price search-field form-control" data-default-value="">
            <option value="">
                <?php esc_html_e('Min Price', 'tf-real-estate') ?>
            </option>
            <?php
            $property_price_array = explode(',', $property_price_dropdown_min);
            ?>
            <?php if (is_array($property_price_array) && !empty($property_price_array)): ?>
                <?php foreach ($property_price_array as $price): ?>
                    <option <?php selected($value_min_price, $price) ?> value="<?php echo esc_attr($price) ?>"><?php echo esc_html(tfre_format_price($price)) ?></option>
                <?php endforeach; ?>
            <?php endif; ?>

        </select>
    </div>
    <div class="<?php echo esc_attr($css_class_half_field); ?> price-field form-group">
        <select name="max-price" title="<?php esc_attr_e('Max Price', 'tf-real-estate') ?>"
            class="tfre-max-price search-field form-control" data-default-value="">
            <option value="">
                <?php esc_html_e('Max Price', 'tf-real-estate') ?>
            </option>
            <?php
            $property_price_array = explode(',', $property_price_dropdown_max);
            ?>
            <?php if (is_array($property_price_array) && !empty($property_price_array)): ?>
                <?php foreach ($property_price_array as $price): ?>
                    <option <?php selected($value_max_price, $price) ?> value="<?php echo esc_attr($price) ?>"><?php echo esc_html(tfre_format_price($price)) ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>
    <?php
}