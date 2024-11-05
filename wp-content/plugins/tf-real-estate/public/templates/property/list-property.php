<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$css_class_col = 'col-md-3 col-sm-4 col-xs-12';
?>
<div class="tfre_message"></div>
<div class="cards-container row">
    <?php if ($properties->have_posts()):
        while ($properties->have_posts()):
            $properties->the_post();
            $property_id = get_the_ID();
            $attach_id   = get_post_thumbnail_id();
            tfre_get_template_with_arguments(
                'property/card-item-property.php',
                array(
                    'property_id'   => $property_id,
                    'attach_id'     => $attach_id,
                    'css_class_col' => $css_class_col
                )
            );
        endwhile;
    else: ?>
        <div class="item-not-found"><?php esc_html_e('No item found', 'tf-real-estate'); ?></div>
    <?php endif; ?>
</div>
<?php
wp_reset_postdata();
tfre_get_template_with_arguments( 'global/property-quick-view-modal.php', array() );