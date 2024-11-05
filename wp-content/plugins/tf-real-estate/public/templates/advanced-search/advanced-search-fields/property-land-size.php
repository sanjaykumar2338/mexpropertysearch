<?php
/**
 * @var $css_class_field
 * @var $css_class_half_field
 * @var $value_min_land_size
 * @var $value_max_land_size
 * @var $land_size_is_slider
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$measurement_units = tfre_get_option_measurement_units_land();
if ($land_size_is_slider == 'true') {
    $min_land_size = tfre_get_option('minimum_land_sizes_slider', 0);
    $max_land_size = tfre_get_option('maximum_land_sizes_slider', 1000);
    ?>
    <div class="tfre-slider-range-land-size-wrap <?php echo esc_attr($css_class_field); ?> form-group land-size-field">
        <?php
        $min_land_size_change = ($value_min_land_size === '') ? $min_land_size : $value_min_land_size;
        $max_land_size_change = ($value_max_land_size === '') ? $max_land_size : $value_max_land_size;
        ?>
        <div class="tfre-range-slider-land-size tfre-range-slider-filter" data-min-default="<?php echo esc_attr($min_land_size) ?>" data-max-default="<?php echo esc_attr($max_land_size); ?>" data-min="<?php echo esc_attr($min_land_size_change) ?>"
            data-max="<?php echo esc_attr($max_land_size_change); ?>">
            <div class="tfre-title-range-slider">
                <b><?php esc_html_e('Land Area', 'tf-real-estate') ?></b> <span class="min-value"><?php echo wp_kses_post(tfre_get_format_number(intval($min_land_size_change))) ?></span> - <span class="max-value"><?php echo wp_kses_post(tfre_get_format_number(intval($max_land_size_change))) ?></span>
                <input type="hidden" name="min-land-size" class="min-input-request"
                    value="<?php echo esc_attr($min_land_size_change) ?>">
                <input type="hidden" name="max-land-size" class="max-input-request"
                    value="<?php echo esc_attr($max_land_size_change) ?>">
            </div>
            <div class="tfre-range-slider">
            </div>
        </div>
    </div>
    <?php
} else {
    $property_land_size_dropdown_min = tfre_get_option('minimum_land_sizes_dropdown', '0,100,300,500,700,900,1100,1300,1500,1700,1900');
    $property_land_size_dropdown_max = tfre_get_option('maximum_land_sizes_dropdown', '200,400,600,800,1000,1200,1400,1600,1800,2000');
    ?>
    <div class="<?php echo esc_attr($css_class_half_field); ?> form-group">
        <select name="min-land-size" title="<?php esc_attr_e('Min Land Area', 'tf-real-estate') ?>" class="tfre-min-land-size search-field form-control" data-default-value="">
            <option value="">
                <?php esc_html_e('Min Land Area', 'tf-real-estate') ?>
            </option>
            <?php
            $property_land_size_array = explode(',', $property_land_size_dropdown_min);
            ?>
            <?php if (is_array($property_land_size_array) && !empty($property_land_size_array)): ?>
                <?php foreach ($property_land_size_array as $land_size): ?>
                    <option <?php selected($value_min_land_size, $land_size) ?> value="<?php echo esc_attr($land_size) ?>"><?php echo wp_kses_post(sprintf('%s %s', tfre_get_format_number(intval($land_size)), $measurement_units)) ?></option>
                <?php endforeach; ?>
            <?php endif; ?>

        </select>
    </div>
    <div class="<?php echo esc_attr($css_class_half_field); ?> form-group">
        <select name="max-land-size" title="<?php esc_attr_e('Max Land Area', 'tf-real-estate') ?>" class="tfre-max-land-size search-field form-control" data-default-value="">
            <option value="">
                <?php esc_html_e('Max Land Area', 'tf-real-estate') ?>
            </option>
            <?php
            $property_land_size_array = explode(',', $property_land_size_dropdown_max);
            ?>
            <?php if (is_array($property_land_size_array) && !empty($property_land_size_array)): ?>
                <?php foreach ($property_land_size_array as $land_size): ?>
                    <option <?php selected($value_max_land_size, $land_size) ?> value="<?php echo esc_attr($land_size) ?>"><?php echo wp_kses_post(sprintf('%s %s', tfre_get_format_number(intval($land_size)), $measurement_units)) ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>
    <?php
}