<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$rtl_carousel = '';
if( is_rtl() ){
	$rtl_carousel = true;
}else {
	$rtl_carousel = false;
}
$query_args           = array(
    'post_type'      => 'real-estate',
    'posts_per_page' => $args['number_of_properties'],
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
    'meta_query'     => array(
        array(
            'key'     => 'property_featured',
            'value'   => 1,
            'compare' => '=',
        )
    )
);
$properties           = new WP_Query($query_args);
$owl_carousel_options = array(
    'items'              => 1,
    'dots'               => false,
    'nav'                => true,
    'rtl'                => $rtl_carousel,
    'autoplay'           => true,
    'autoplayTimeout'    => 3000,
    'smartSpeed'         => 850,
    'margin'             => 10,
    'autoplayHoverPause' => true,
    'loop'               => true,
    'animateIn'          => 'fadeIn',
    'animateOut'         => 'fadeOut',
);
?>
<div class="tfre-list-featured-properties-wrap">
    <div class="tfre-list-featured-properties <?php echo esc_attr($args['style']); ?>">
        <?php if ($properties->found_posts > 0): ?>
            <?php if ($args['style'] == 'carousel'): ?>
                <div class="owl-carousel" data-options="<?php echo esc_attr(json_encode($owl_carousel_options)); ?>">
            <?php endif; ?>
                <?php
                if($args['style'] == 'list'){
                    $width         = 168;
                    $height        = 120;
                }else{
                    $width         = 672;
                    $height        = 480;
                }
                
                $no_image_src  = TF_PLUGIN_URL . 'includes/elementor-widget/assets/images/no-image.jpg';
                $default_image = tfre_get_option('default_property_image', '');
                if (is_array($default_image) && $default_image['url'] != '') {
                    $no_image_src = tfre_image_resize_url($default_image['url'], $width, $height, true)['url'];
                }
                if ($properties->have_posts()):
                    while ($properties->have_posts()):
                        $properties->the_post();
                        $property_id                              = get_the_ID();
                        $property_title                           = get_the_title($property_id);
                        $property_link                            = get_the_permalink($property_id);
                        $property_price                           = get_post_meta($property_id, 'property_price_value', true);
                        $property_price_prefix                    = get_post_meta($property_id, 'property_price_prefix', true);
                        $property_price_postfix                   = get_post_meta($property_id, 'property_price_postfix', true);
                        $property_price_unit                      = get_post_meta($property_id, 'property_price_unit', true);
                        $prop_enable_short_price_unit             = tfre_get_option('enable_short_price_unit', 0) == 1 ? true : false;
                        $property_address                         = get_post_meta($property_id, 'property_address', true);
                        $image_id                                 = get_post_thumbnail_id($property_id);
                        $property_image_src                       = tfre_image_resize_id($image_id, $width, $height, true);
                        ?>
                        <div class="item property-item">
                            <div class="property-image">
                                <a title="<?php echo esc_attr($property_title) ?>" href="<?php echo esc_url($property_link) ?>">
                                    <img loading="lazy" src="<?php echo esc_url($property_image_src) ?>"
                                        onerror="this.src = '<?php echo esc_url($no_image_src) ?>';"
                                        alt="<?php echo esc_attr($property_title) ?>"
                                        title="<?php echo esc_attr($property_title) ?>">
                                </a>
                            </div>
                            <div class="property-info">
                                <?php if (!empty($property_title)): ?>
                                    <h2 class="property-title"><a title="<?php echo esc_attr($property_title) ?>"
                                            href="<?php echo esc_url($property_link) ?>"><?php echo esc_html($property_title) ?></a>
                                    </h2>
                                <?php endif; ?>
                                <?php if (!empty($property_address)): ?>
                                    <?php $icon_white = $args['style'] == 'carousel' ? '-white.svg' : '.svg' ?>
                                    <p class="property-address"><img loading="lazy"
                                            src="<?php printf(TF_PLUGIN_URL . 'public/assets/image/icon/map%s', $icon_white); ?>"
                                            alt="icon-map"><?php echo esc_html($property_address); ?></p>
                                <?php endif; ?>
                                <?php if (!empty($property_price_prefix)): ?>
                                    <span class="property-price-prefix"><?php echo esc_html($property_price_prefix) ?></span>
                                <?php endif; ?>
                                <?php if (!empty($property_price)): ?>
                                    <span
                                        class="property-price"><?php echo esc_html(tfre_format_price($property_price, $property_price_unit, true, $prop_enable_short_price_unit)); ?></span>
                                <?php endif; ?>
                                <?php if (!empty($property_price_postfix)): ?>
                                    <span class="property-price-postfix"><?php echo esc_html($property_price_postfix) ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile;
                endif; ?>
                <?php if ($args['style'] == 'carousel'): ?>
                </div>
                <?php endif; ?>
        <?php else: ?>
            <div class="item-not-found"><?php esc_html_e('No item found', 'tf-real-estate'); ?></div>
        <?php endif; ?>
    </div>
</div>