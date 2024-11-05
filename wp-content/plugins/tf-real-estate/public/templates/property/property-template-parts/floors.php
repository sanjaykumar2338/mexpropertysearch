<?php
/**
 * @var $property_data
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$floors_plan_toggle = '0';
$floors_plan        = array();
if ($property_data) {
    $floors_plan_toggle = get_post_meta($property_data->ID, 'floors_plan_toggle', true);
    $floors_plan        = get_post_meta($property_data->ID, 'floors_plan', true);
}
$show_hide_property_fields = tfre_get_option('show_hide_property_fields', array());
?>
<div class="tfre-field-wrap tfre-floor-sc">
    <div class="tfre-field-title">
        <h3><?php esc_html_e('Floors', 'tf-real-estate'); ?></h3>
    </div>
    <div class="tfre-field tfre-property-enable-floor-plan">
        <?php if ($show_hide_property_fields['floors_plan'] == 1): ?>
            <div class="form-group">
                <label><?php echo esc_html__('Enable Floor Plan', 'tf-real-estate') ?></label>
                <div class="group-checkbox">
                    <input class="tfre-disable-floors-plan" id="disable_floors_plan" value="0" type="radio"
                        name="floors_plan_toggle" <?php checked($floors_plan_toggle, '0'); ?>>
                    <label class="form-check-label" for="disable_floors_plan">
                        <?php esc_html_e('Disable', 'tf-real-estate'); ?>
                    </label>
                </div>
                <div class="group-checkbox">
                    <input class="tfre-enable-floors-plan" id="enable_floors_plan" value="1" type="radio"
                        name="floors_plan_toggle" <?php checked($floors_plan_toggle, '1'); ?>>
                    <label class="form-check-label" for="enable_floors_plan">
                        <?php esc_html_e('Enable', 'tf-real-estate'); ?>
                    </label>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="tfre-field tfre-property-floors">
        <?php if ($show_hide_property_fields['floors_plan'] == 1): ?>
            <table class="table">
                <tbody id="tfre-floors-plan">
                    <?php
                    if (empty($floors_plan)) {
                        ?>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-sm-12 mb-3">
                                        <div class="form-group">
                                            <label
                                                for="<?php echo esc_attr('floor_name_0') ?>"><?php esc_html_e('Floor Name', 'tf-real-estate'); ?></label>
                                            <input name="<?php echo esc_attr('floors_plan[0][floor_name]'); ?>" type="text"
                                                id="<?php echo esc_attr('floor_name_0'); ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <div class="form-group">
                                            <label
                                                for="<?php echo esc_attr('floor_price_0') ?>"><?php esc_html_e('Floor Price (Only digits)', 'tf-real-estate'); ?></label>
                                            <input name="<?php echo esc_attr('floors_plan[0][floor_price]') ?>" type="number"
                                                id="<?php echo esc_attr('floor_price_0') ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <div class="form-group">
                                            <label
                                                for="<?php echo esc_attr('floor_price_postfix_0') ?>"><?php esc_html_e('Price Postfix', 'tf-real-estate'); ?></label>
                                            <input name="<?php echo esc_attr('floors_plan[0][floor_price_postfix]') ?>"
                                                type="text" id="<?php echo esc_attr('floor_price_postfix_0') ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <div class="form-group">
                                            <label
                                                for="<?php echo esc_attr('floor_size_0') ?>"><?php esc_html_e('Floor Size (Only digits)', 'tf-real-estate'); ?></label>
                                            <input name="<?php echo esc_attr('floors_plan[0][floor_size]') ?>" type="number"
                                                id="<?php echo esc_attr('floor_size_0') ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <div class="form-group">
                                            <label
                                                for="<?php echo esc_attr('floor_size_postfix_0') ?>"><?php esc_html_e('Size Postfix', 'tf-real-estate'); ?></label>
                                            <input name="<?php echo esc_attr('floors_plan[0][floor_size_postfix]') ?>"
                                                type="text" id="<?php echo esc_attr('floor_size_postfix_0') ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <div class="form-group">
                                            <label
                                                for="<?php echo esc_attr('floor_bedrooms_0') ?>"><?php esc_html_e('Bedrooms', 'tf-real-estate'); ?></label>
                                            <input name="<?php echo esc_attr('floors_plan[0][floor_bedrooms]') ?>" type="number"
                                                id="<?php echo esc_attr('floor_bedrooms_0') ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <div class="form-group">
                                            <label
                                                for="<?php echo esc_attr('floor_bathrooms_0') ?>"><?php esc_html_e('Bathrooms', 'tf-real-estate'); ?></label>
                                            <input name="<?php echo esc_attr('floors_plan[0][floor_bathrooms]') ?>"
                                                type="number" id="<?php echo esc_attr('floor_bathrooms_0') ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <div class="form-group">
                                            <label
                                                for="<?php echo esc_attr('floor_image_url_0') ?>"><?php esc_html_e('Floor Image', 'tf-real-estate'); ?></label>
                                            <div id="tfre-floor-preview-image-container-0" class="preview-image"></div>
                                            <div id="tfre-floor-plupload-container-0" class="file-upload-block">
                                                <input name="" type="text" id="<?php echo esc_attr('floor_image_url_0') ?>"
                                                    class="tfre_floor_image_url form-control">
                                                <input type="hidden" class="tfre_floor_image_id"
                                                    name="<?php echo esc_attr('floors_plan[0][floor_image]') ?>" value=""
                                                    id="<?php echo esc_attr('floor_image_id_0') ?>" />
                                                <button type="button" data-row-index="0" id="tfre-upload-floor-img-0"
                                                    title="<?php esc_attr_e('Choose image', 'tf-real-estate') ?>"
                                                    class="tfre-floors-planImg"><i class="fa fa-file-image"></i></button>
                                            </div>

                                            <div id="tfre-floor-errors-log-0"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label
                                            for="<?php echo esc_attr('floor_description_0') ?>"><?php esc_html_e('Description', 'tf-real-estate'); ?></label>
                                        <textarea name="<?php echo esc_attr('floors_plan[0][floor_description]') ?>" rows="4"
                                            id="<?php echo esc_attr('floor_description_0') ?>"></textarea>
                                    </div>
                                </div>
                            </td>
                            <td class="row-remove">
                                <span data-remove="0" class="remove-floors-plan remove"><i class="fa fa-times"></i></span>
                            </td>
                        </tr>
                        <?php
                    } else {
                        $row_index = 0;
                        foreach ($floors_plan as $floor) {
                            $floor_name_value          = !empty($floor['floor_name']) ? $floor['floor_name'] : '';
                            $floor_price_value         = !empty($floor['floor_price']) ? $floor['floor_price'] : '';
                            $floor_price_postfix_value = !empty($floor['floor_price_postfix']) ? $floor['floor_price_postfix'] : '';
                            $floor_size_value          = !empty($floor['floor_size']) ? $floor['floor_size'] : '';
                            $floor_size_postfix_value  = !empty($floor['floor_size_postfix']) ? $floor['floor_size_postfix'] : '';
                            $floor_bedrooms_value      = !empty($floor['floor_bedrooms']) ? $floor['floor_bedrooms'] : '';
                            $floor_bathrooms_value     = !empty($floor['floor_bathrooms']) ? $floor['floor_bathrooms'] : '';
                            $floor_image_value         = !empty($floor['floor_image']) ? $floor['floor_image'] : '';
                            $floor_description_value   = !empty($floor['floor_description']) ? $floor['floor_description'] : '';
                            ?>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label
                                                    for="<?php echo esc_attr('floor_name_' . intval($row_index)) ?>"><?php esc_html_e('Floor Name', 'tf-real-estate'); ?></label>
                                                <input
                                                    name="<?php echo esc_attr('floors_plan[' . intval($row_index) . '][floor_name]') ?>"
                                                    type="text" id="<?php echo esc_attr('floor_name_' . intval($row_index)) ?>"
                                                    class="form-control" value="<?php echo esc_attr($floor_name_value); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="<?php echo esc_attr('floor_price_' . intval($row_index)) ?>"><?php esc_html_e('Floor Price (Only digits)', 'tf-real-estate'); ?></label>
                                                <input
                                                    name="<?php echo esc_attr('floors_plan[' . intval($row_index) . '][floor_price]') ?>"
                                                    type="number" id="<?php echo esc_attr('floor_price_' . intval($row_index)) ?>"
                                                    class="form-control" value="<?php echo esc_attr($floor_price_value); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="<?php echo esc_attr('floor_price_postfix_' . intval($row_index)) ?>"><?php esc_html_e('Price Postfix', 'tf-real-estate'); ?></label>
                                                <input
                                                    name="<?php echo esc_attr('floors_plan[' . intval($row_index) . '][floor_price_postfix]') ?>"
                                                    type="text"
                                                    id="<?php echo esc_attr('floor_price_postfix_' . intval($row_index)) ?>"
                                                    class="form-control"
                                                    value="<?php echo esc_attr($floor_price_postfix_value); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="<?php echo esc_attr('floor_size_' . intval($row_index)) ?>"><?php esc_html_e('Floor Size (Only digits)', 'tf-real-estate'); ?></label>
                                                <input
                                                    name="<?php echo esc_attr('floors_plan[' . intval($row_index) . '][floor_size]') ?>"
                                                    type="number" id="<?php echo esc_attr('floor_size_' . intval($row_index)) ?>"
                                                    class="form-control" value="<?php echo esc_attr($floor_size_value); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="<?php echo esc_attr('floor_size_postfix_' . intval($row_index)) ?>"><?php esc_html_e('Size Postfix', 'tf-real-estate'); ?></label>
                                                <input
                                                    name="<?php echo esc_attr('floors_plan[' . intval($row_index) . '][floor_size_postfix]') ?>"
                                                    type="text"
                                                    id="<?php echo esc_attr('floor_size_postfix_' . intval($row_index)) ?>"
                                                    class="form-control" value="<?php echo esc_attr($floor_size_postfix_value); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="<?php echo esc_attr('floor_bedrooms_' . intval($row_index)) ?>"><?php esc_html_e('Bedrooms', 'tf-real-estate'); ?></label>
                                                <input
                                                    name="<?php echo esc_attr('floors_plan[' . intval($row_index) . '][floor_bedrooms]') ?>"
                                                    type="number"
                                                    id="<?php echo esc_attr('floor_bedrooms_' . intval($row_index)) ?>"
                                                    class="form-control" value="<?php echo esc_attr($floor_bedrooms_value); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="<?php echo esc_attr('floor_bathrooms_' . intval($row_index)) ?>"><?php esc_html_e('Bathrooms', 'tf-real-estate'); ?></label>
                                                <input
                                                    name="<?php echo esc_attr('floors_plan[' . intval($row_index) . '][floor_bathrooms]') ?>"
                                                    type="number"
                                                    id="<?php echo esc_attr('floor_bathrooms_' . intval($row_index)) ?>"
                                                    class="form-control" value="<?php echo esc_attr($floor_bathrooms_value); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="<?php echo esc_attr('floor_image_url_' . intval($row_index)) ?>"><?php esc_html_e('Floor Image', 'tf-real-estate'); ?></label>
                                                <div id="tfre-floor-preview-image-container-<?php echo esc_attr(intval($row_index)); ?>"
                                                    class="preview-image">
                                                    <div id="floor-img-" class="floor-image-wrap">
                                                        <figure class="media-thumb">
                                                            <img loading="lazy"
                                                                src="<?php echo esc_attr(wp_get_attachment_image_url($floor_image_value, 'full')); ?>">

                                                            <a class="icon icon-delete" data-property-id="0"
                                                                data-img-id="<?php echo esc_attr($floor_image_value); ?>"
                                                                href="javascript:;"><i class="fa fa-times"></i></a>

                                                            <span style="display: none;" class="icon icon-loader"><i
                                                                    class="fa fa-spinner fa-spin"></i></span>
                                                        </figure>
                                                    </div>
                                                </div>
                                                <div id="tfre-floor-plupload-container-<?php echo esc_attr(intval($row_index)); ?>"
                                                    class="file-upload-block">
                                                    <input name="" type="text"
                                                        id="<?php echo esc_attr('floor_image_url_' . intval($row_index)) ?>"
                                                        class="tfre_floor_image_url form-control"
                                                        value="<?php echo esc_attr(wp_get_attachment_image_url($floor_image_value, 'full')); ?>">

                                                    <input type="hidden" class="tfre_floor_image_id"
                                                        name="<?php echo esc_attr('floors_plan[' . intval($row_index) . '][floor_image]') ?>"
                                                        value="<?php echo esc_attr($floor_image_value); ?>"
                                                        id="<?php echo esc_attr('floor_image_id_' . intval($row_index)) ?>" />

                                                    <button type="button"
                                                        data-row-index="<?php echo esc_attr(intval($row_index)); ?>"
                                                        id="tfre-upload-floor-img-<?php echo esc_attr(intval($row_index)); ?>"
                                                        title="<?php esc_attr_e('Choose image', 'tf-real-estate') ?>"
                                                        class="tfre-floors-planImg"><i class="fa fa-file-image"></i></button>
                                                </div>
                                                <div id="tfre-floor-errors-log-<?php echo esc_attr(intval($row_index)); ?>"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label
                                                for="<?php echo esc_attr('floor_description_' . intval($row_index)) ?>"><?php esc_html_e('Description', 'tf-real-estate'); ?></label>
                                            <textarea
                                                name="<?php echo esc_attr('floors_plan[' . intval($row_index) . '][floor_description]') ?>"
                                                rows="4"
                                                id="<?php echo esc_attr('floor_description_' . intval($row_index)) ?>"><?php echo esc_attr($floor_description_value); ?></textarea>
                                        </div>
                                    </div>
                                </td>
                                <td class="row-remove">
                                    <span data-remove="<?php echo esc_attr($row_index - 1); ?>" class="remove-floors-plan remove"><i
                                            class="fa fa-times"></i></span>
                                </td>
                            </tr>
                            <?php
                            $row_index++;
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <button type="button" id="add-floors-row"
                                        data-floor-latest="<?php echo (empty($floors_plan) ? 0 : esc_attr($row_index - 1)); ?>"
                                        class="btn-big-spacing">
                                        <i class="fa fa-plus"></i>
                                        <?php esc_html_e('Add More', 'tf-real-estate'); ?>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        <?php endif; ?>
    </div>
</div>