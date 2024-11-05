<?php
/**
 * @var $property
 * @var $submit_mode
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

?>
<div class="alert-handle-property">
    <div class="tfre-message alert alert-success" role="alert">
        <?php
        if (isset($property)) {
            switch ($property->post_status):
                case 'publish':
                    if ($submit_mode === 'property-add') {
                        printf(wp_kses_post(__('Add your property successfully. To view your property <a class="accent-color" href="%s">click here</a>.', 'tf-real-estate')), get_permalink($property->ID));
                    } else {
                        printf(wp_kses_post(__('Your changes have been saved. To view your property edited <a class="accent-color" href="%s">click here</a>.', 'tf-real-estate')), get_permalink($property->ID));
                    }
                    break;
                case 'pending':
                    if ($submit_mode === 'property-add') {
                        printf(wp_kses_post(__('Add your property successfully. Your property need approved, it will be visible.', 'tf-real-estate')), get_permalink($property->ID));
                    } else {
                        echo wp_kses_post(__('Your changes have been saved. Your changes need approved.', 'tf-real-estate'));
                    }
                    break;
                default:
                    break;
            endswitch;
        }
        ?>
    </div>
</div>