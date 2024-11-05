<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$query_args = array(
    'taxonomy'   => $args['taxonomy'],
    'number'     => $args['number_of_taxonomy'],
    'hide_empty' => false,
    'count'      => true,
);
$taxonomies = get_terms($query_args);
?>
<div class="tfre-list-property-taxonomy-wrap">
    <div class="tfre-list-property-taxonomy">
        <?php if (count($taxonomies) > 0): ?>
            <?php
            $width         = 264;
            $height        = 144;
            foreach ($taxonomies as $tax):
                $term_name  = $tax->name;
                $term_link  = get_term_link($tax->term_id, $tax->taxonomy);
                $term_count = $tax->count != 0 ? $tax->count : 0;
                if ($args['taxonomy'] == 'province-state') {
                    $term_image_id = get_term_meta($tax->term_id, 'province_state_image', true);
                } else if ($args['taxonomy'] == 'neighborhood') {
                    $term_image_id = get_term_meta($tax->term_id, 'neighborhood_image', true);
                } else if ($args['taxonomy'] == 'property-type') {
                    $term_image_id = get_term_meta($tax->term_id, 'type_image', true);
                } else {
                    $term_image_id = '';
                }
                $term_image_src = tfre_image_resize_id($term_image_id, $width, $height, true);
                ?>
                <div class="taxonomy-item">
                    <?php if (!empty($term_image_src)): ?>
                        <div class="taxonomy-image">
                            <a title="<?php echo esc_attr($term_name) ?>" href="<?php echo esc_url($term_link) ?>">
                                <img loading="lazy" src="<?php echo esc_url($term_image_src) ?>" alt="<?php echo esc_attr($term_name) ?>" title="<?php echo esc_attr($term_name) ?>">
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="taxonomy-info">
                        <?php if (!empty($term_name)): ?>
                            <h2 class="taxonomy-name"><a title="<?php echo esc_attr($term_name) ?>"
                                    href="<?php echo esc_url($term_link) ?>"><?php echo esc_html($term_name) ?></a>
                            </h2>
                        <?php endif; ?>
                        <span class="taxonomy-count-property"><?php echo esc_html(sprintf('%s ' . tfre_get_number_text($term_count, esc_html__('Properties', 'tf-real-estate'), esc_html__('Property', 'tf-real-estate')), $term_count)) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="item-not-found"><?php esc_html_e('No item found', 'tf-real-estate'); ?></div>
        <?php endif; ?>
    </div>
</div>