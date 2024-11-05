<?php
/**
 * @var $property_data
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$show_hide_property_fields = tfre_get_option('show_hide_property_fields', array());
$features_checked_by_id    = array();
if (isset($property_data)) {
    $features_by_id = get_the_terms($property_data->ID, 'property-feature');
    if ($features_by_id && !is_wp_error($features_by_id)) {
        foreach ($features_by_id as $feature) {
            $features_checked_by_id[] = intval($feature->term_id);
        }
    }
}

$parent_items = $child_items = array();
$parent_items = get_terms('property-feature', array( 'parent' => 0, 'orderby' => 'term_id', 'order' => 'ASC', 'hide_empty' => false ));
if (is_array($parent_items)) {
    foreach ($parent_items as $term) {
        $child_items = get_terms('property-feature', array( 'parent' => $term->term_id, 'orderby' => 'term_id', 'order' => 'ASC', 'hide_empty' => false ));
    } ?>
    <div class="tfre-field-wrap tfre-amenities">
        <div class="tfre-field-title">
            <h3><?php echo esc_html_e('Amenities', 'tf-real-estate') . tfre_required_field('property-feature', 'required_property_fields'); ?>
            </h3>
        </div>
        <?php if ($show_hide_property_fields['property-feature'] == 1): ?>
            <div class="tfre-field tfre-property-feature">
                <?php
                if (is_taxonomy_hierarchical('property-feature') && (is_array($child_items) && count($child_items) > 0)) {
                    foreach ($parent_items as $parent_item) {
                        echo '<div class="property-fields property-feature row">';
                        echo '<div class="col-sm-3 parent-item form-check"><label>';
                        if (in_array($parent_item->term_id, $features_checked_by_id)) {
                            echo '<input id="' . esc_attr($parent_item->name) . '" class="form-check-input" type="checkbox" name="property-feature[]" value="' . esc_attr($parent_item->name) . '" checked />';
                        } else {
                            echo '<input id="' . esc_attr($parent_item->name) . '" class="form-check-input" type="checkbox" name="property-feature[]" value="' . esc_attr($parent_item->name) . '" />';
                        }
                        echo '<label for="' . esc_attr($parent_item->name) . '">' . esc_html($parent_item->name);
                        echo '</label></div>';
                        foreach ($child_items as $child_item) {
                            if ($child_item->parent == $parent_item->term_id) {
                                echo '<div class="col-sm-3 children-item group-checkbox">';
                                if (in_array($child_item->term_id, $features_checked_by_id)) {
                                    echo '<input id="' . esc_attr($child_item->name) . '" class="form-check-input" type="checkbox" name="property-feature[]" value="' . esc_attr($child_item->name) . '" checked />';
                                } else {
                                    echo '<input id="' . esc_attr($child_item->name) . '" class="form-check-input" type="checkbox" name="property-feature[]" value="' . esc_attr($child_item->name) . '" />';
                                }
                                echo '<label for="' . esc_attr($child_item->name) . '">' . esc_html($child_item->name);
                                echo '</label></div>';
                            }
                        }
                        echo '</div>';
                    }
                } else {
                    echo '<div class="property-fields property-feature row">';
                    foreach ($parent_items as $parent_item) {
                        echo '<div class="col-sm-3 parent-item group-checkbox">';
                        if (in_array($parent_item->term_id, $features_checked_by_id)) {
                            echo '<input id="' . esc_attr($parent_item->name) . '" class="form-check-input" type="checkbox" name="property-feature[]" value="' . esc_attr($parent_item->name) . '" checked />';
                        } else {
                            echo '<input id="' . esc_attr($parent_item->name) . '" class="form-check-input" type="checkbox" name="property-feature[]" value="' . esc_attr($parent_item->name) . '" />';
                        }
                        echo '<label for="' . esc_attr($parent_item->name) . '">' . esc_html($parent_item->name);
                        echo '</label></div>';
                    }
                    echo '</div>';
                }
                ?>
            </div>
        <?php endif; ?>
    </div>
<?php } ?>