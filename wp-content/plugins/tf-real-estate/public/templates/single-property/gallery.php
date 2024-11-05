<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
wp_enqueue_style('owl.carousel');
wp_enqueue_script('owl.carousel');
global $post;
$property_gallery              = get_post_meta(get_the_ID(), 'gallery_images', true);
$property_gallery_image_type   = get_post_meta(get_the_ID(), 'gallery_image_type', true);
$single_property_gallery_style = $property_gallery_image_type != 'none' ? $property_gallery_image_type : tfre_get_option('single_property_gallery_style');
$property_location             = get_post_meta(get_the_ID(), 'property_location', true);
$show_gallery = is_array(tfre_get_option( 'single_property_panels_manager' )) ? tfre_get_option( 'single_property_panels_manager' )['gallery'] : false;

// RTL Gallery
$rtl_carousel = '';
if( is_rtl() ){
	$rtl_carousel = 'yes';
}

if($show_gallery == true) {
    if ($property_gallery):
        $property_gallery = json_decode($property_gallery, true);
        ?>
        <div id="tabs-header-single-property">
            <ul class="tabs-nav">
                <li><a href="#tabs-gallery"><i class="far fa-images"></i></a></li>
                <li><a id="tab-map" href="#tabs-map"><i class="far fa-map"></i></a></li>
            </ul>
            <div class="tabs-content">
                <div id="tabs-gallery">
                    <div class="single-property-element property-gallery-wrap">
                        <?php if ($single_property_gallery_style == 'gallery-style-slider'): ?>
                            <div class="tfre-property-info">
                                <div class="single-property-image-main owl-carousel manual tfre-carousel-manual" data-rtl="<?php echo esc_attr( $rtl_carousel ) ?>">
                                    <?php
                                    $gallery_id = 'tfre-' . rand();
                                    foreach ($property_gallery as $image):
                                        $image_src      = tfre_image_resize_id($image, 1920, 750, true);
                                        $image_full_src = wp_get_attachment_image_src($image, 'full');
                                        if (!empty($image_full_src) && is_array($image_full_src)) {
                                            ?>
                                            <div class="item property-gallery-item tfre-light-gallery">
                                                <img loading="lazy" src="<?php echo esc_url($image_src) ?>" alt="<?php the_title(); ?>"
                                                    title="<?php the_title(); ?>">
                                                <a data-thumb-src="<?php echo esc_url($image_full_src[0]); ?>"
                                                    data-gallery-id="<?php echo esc_attr($gallery_id); ?>" data-rel="tfre_light_gallery"
                                                    href="<?php echo esc_url($image_full_src[0]); ?>" class="zoomGallery"><i
                                                        class="fa fa-expand"></i></a>
                                            </div>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                </div>
                                <div class="single-property-image-thumb slider-style1 owl-carousel manual tfre-carousel-manual" data-item="3">
                                    <?php
                                    foreach ($property_gallery as $image):
                                        $image_src = tfre_image_resize_id($image, 120, 120, true);
                                        if (!empty($image_src)) { ?>
                                            <div class="item property-gallery-item">
                                                <img loading="lazy" src="<?php echo esc_url($image_src) ?>" alt="<?php the_title(); ?>"
                                                    title="<?php the_title(); ?>">
                                            </div>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php elseif ($single_property_gallery_style == 'gallery-style-slider-2'): ?>
                            <div class="tfre-property-gallery-style2">
                                <div class="container">
                                    <div class="tfre-property-info slider-style2">
                                        <div class="single-property-image-main slider-style2 owl-carousel manual tfre-carousel-manual" data-rtl="<?php echo esc_attr( $rtl_carousel ) ?>">
                                            <?php
                                            $gallery_id = 'tfre-' . rand();
                                            foreach ($property_gallery as $image):
                                                $image_src      = tfre_image_resize_id($image, 1920, 750, true);
                                                $image_full_src = wp_get_attachment_image_src($image, 'full');
                                                if (!empty($image_full_src) && is_array($image_full_src)) {
                                                    ?>
                                                    <div class="item property-gallery-item tfre-light-gallery">
                                                        <img loading="lazy" src="<?php echo esc_url($image_src) ?>" alt="<?php the_title(); ?>"
                                                            title="<?php the_title(); ?>">
                                                        <a data-thumb-src="<?php echo esc_url($image_full_src[0]); ?>"
                                                            data-gallery-id="<?php echo esc_attr($gallery_id); ?>" data-rel="tfre_light_gallery"
                                                            href="<?php echo esc_url($image_full_src[0]); ?>" class="zoomGallery"><i
                                                                class="fa fa-expand"></i></a>
                                                    </div>
                                                <?php } ?>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="single-property-image-thumb slider-style2 owl-carousel manual tfre-carousel-manual" data-item="4">
                                            <?php
                                            foreach ($property_gallery as $image):
                                                $image_src = tfre_image_resize_id($image, 210, 111, true);
                                                if (!empty($image_src)) { ?>
                                                    <div class="item property-gallery-item">
                                                        <img loading="lazy" src="<?php echo esc_url($image_src) ?>" alt="<?php the_title(); ?>"
                                                            title="<?php the_title(); ?>">
                                                    </div>
                                                <?php } ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="container-grid-gallery">
                                <div class="tfre-property-info style-grid">
                                    <?php
                                    $gallery_id = 'tfre-' . rand();
                                    $key        = 1;
                                    foreach ($property_gallery as $image):
                                        $max_item       = count($property_gallery);
                                        $image_full_src = wp_get_attachment_image_src($image, 'full');
                                        if (!empty($image_full_src) && is_array($image_full_src)) {
                                            ?>
                                            <div class="item property-gallery-item tfre-light-gallery item-<?php echo esc_attr($key); ?>">
                                                <img loading="lazy" src="<?php echo esc_url($image_full_src[0]) ?>" alt="<?php the_title(); ?>"
                                                    title="<?php the_title(); ?>">
                                                <a data-thumb-src="<?php echo esc_url($image_full_src[0]); ?>"
                                                    data-gallery-id="<?php echo esc_attr($gallery_id); ?>" data-rel="tfre_light_gallery"
                                                    href="<?php echo esc_url($image_full_src[0]); ?>" class="zoomGallery"><i
                                                        class="fa fa-expand"></i></a>
                                                <?php if ($key == 4): ?>
                                                    <div class="overlay_item">
                                                        <div class="inner">
                                                            <i class="icon-dreamhome-image2"></i>
                                                            <h3><?php echo sprintf(__('Show all %d Photos', 'tf-real-estate'), $max_item) ?>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php } ?>
                                        <?php $key++; endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div id="tabs-map">
                    <div class="map-container">
                        <input data-field-control="" class="latlng_searching" type="hidden" class="tfre-map-latlng-field"
                            name="property_location[]"
                            value="<?php echo esc_attr(is_array($property_location) ? $property_location[0] : ''); ?>" />
                        <div class="tfre-map-address-field">
                            <div class="tfre-map-address-field-input">
                                <input data-field-control="" class="address_searching" type="hidden" 
                                    name="property_location[]"
                                    value="<?php echo esc_attr(is_array($property_location) ? $property_location[1] : ''); ?>" />
                            </div>
                        </div>
                        <div id="map-header"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; 
}?>