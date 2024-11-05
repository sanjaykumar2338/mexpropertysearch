<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if ( !is_user_logged_in() ) {
    tfre_get_template_with_arguments('global/access-permission.php', array('type' => 'not_login'));
    return;
}
$prop_enable_short_price_unit = tfre_get_option('enable_short_price_unit', 0) == 1 ? true : false;
?>
<div class="tfre_message"></div>
<div class="tfre-table-listing tfre-table-listing-sc">
    <div class="table-responsive">
        <table class="table table-mobile" id="tfre_my_favorite">
            <thead>
                <tr>
                    <th><?php esc_html_e('Listing title', 'tf-real-estate'); ?></th>
                    <th><?php esc_html_e('Date Published', 'tf-real-estate'); ?></th>
                    <th><?php esc_html_e('Action', 'tf-real-estate'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!$favorites): ?>
                    <tr> 
                        <td colspan="3"> <?php esc_html_e('You don\'t have any favorites.', 'tf-real-estate'); ?>
                        </td>
                    </tr>
                 <?php else: ?>
                    <?php foreach ($favorites as $favorite) : ?>
                        <tr>
                            <td>
                                <div class= "favorite-listing">
                                    <div class="thumb">
                                        <?php
                                         $prop_address       = get_post_meta($favorite->ID, 'property_address', true);
                                         $prop_price_value   = get_post_meta($favorite->ID, 'property_price_value', true);
                                         $prop_price_unit    = get_post_meta($favorite->ID, 'property_price_unit', true);
                                         $prop_price_prefix  = get_post_meta($favorite->ID, 'property_price_prefix', true);
                                         $prop_price_postfix = get_post_meta($favorite->ID, 'property_price_postfix', true);
    
                                         $width        = get_option('thumbnail_width', '168px');
                                         $height       = get_option('thumbnail_height', '95px');
                                         $no_image_src = tfre_get_option('default_property_image', '')['url'] != '' ? tfre_get_option('default_property_image', '')['url'] : TF_PLUGIN_URL . 'includes/elementor-widget/assets/images/no-image.jpg';
    
                                         $attach_id = get_post_thumbnail_id($favorite);
                                         $image_src = wp_get_attachment_image_url($attach_id);
                                         ?>
                                        <a target="_blank" title="<?php echo esc_attr($favorite->post_title); ?>"
                                        href="<?php echo esc_url(get_permalink($favorite->ID)); ?>">
                                            <img loading="lazy" width="<?php echo esc_attr($width) ?>"
                                                height="<?php echo esc_attr($height) ?>"
                                                src="<?php echo esc_url($image_src) ?>"
                                                onerror="this.src = '<?php echo esc_url($no_image_src) ?>';"
                                                alt="<?php echo esc_attr($favorite->post_title); ?>"
                                                title="<?php echo esc_attr($favorite->post_title); ?>">
                                        </a>
                                    </div>
                                    <div class="tfre-property-summary">
                                            <?php if ($favorite->post_status === 'publish'): ?>
                                                <h4 class="tfre-property-title">
                                                    <a target="_blank" title="<?php echo esc_attr($favorite->post_title); ?>"
                                                            href="<?php echo esc_url(get_permalink($favorite->ID)); ?>"><?php echo esc_html($favorite->post_title); ?></a>
                                                </h4>
                                            <?php else: ?>
                                                <h4 class="tfre-property-title"><?php echo esc_html($favorite->post_title); ?></h4>
                                            <?php endif; ?>
                                            <p class="tfre-property-address">
                                                <?php echo esc_html($prop_address) ?></a>
                                            </p>
                                            <?php if ($prop_price_value !== ''): ?>
                                                <span class="tfre-property-price">
                                                    <?php if ($prop_price_prefix !== ''): ?>
                                                        <span class="tfre-prop-price-postfix"><?php echo esc_html($prop_price_prefix) ?></span>
                                                    <?php endif; ?>
                                                    <span class="tfre-prop-price-value"><?php echo esc_html(tfre_format_price($prop_price_value, $prop_price_unit, true, $prop_enable_short_price_unit)); ?></span>
                                                    <?php if ($prop_price_postfix !== ''): ?>
                                                        <span class="tfre-prop-price-postfix"> <?php echo esc_html($prop_price_postfix) ?></span>
                                                    <?php endif; ?>
                                                </span>
                                            <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="tfre-favorite--date"><?php echo esc_html(date_i18n(get_option('date_format'), strtotime($favorite->post_date))) ; ?></span>
                            </td>
                            <td>
                                <?php
                                $actions = array('id' => 'remove', 'label' => __('Remove', 'tf-real-estate'), 'tooltip' => __('Remove Favorite', 'tf-real-estate'), 'nonce' => true, 'confirm' => esc_html__('Are you sure you want to remove this favorite?', 'tf-real-estate'));
                                $my_properties_page_link = tfre_get_permalink('my_properties_page');
                                $action_url = add_query_arg(array('action' => $actions, 'property_id' => $favorite->ID), $my_properties_page_link);
                                if ($actions['nonce']) {
                                    $action_url = wp_nonce_url($action_url, 'tfre_my_favorite_actions');
                                }
                                ?>
                                <a  href="javascript:void(0)"
                                    data-tfre-data-property-id="<?php echo esc_attr(intval($favorite->ID))  ?>"
                                    data-toggle="tooltip"
                                    data-placement="bottom"
                                    title="<?php echo esc_attr($actions['tooltip']); ?>"
                                    class="tfre-favorite-remove tfre-dashboard-action-<?php echo esc_attr($actions['id']); ?>">
                                    <img loading="lazy" src="<?php bloginfo('template_url'); ?>/images/svg-theme/icon-3.svg" alt="icon"><?php esc_html_e(' Delete', 'tf-real-estate'); ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?> 
            </tbody>
        </table>
        <?php tfre_get_template_with_arguments( 'global/pagination.php', array( 'max_num_pages' => $max_num_pages ) ); ?>
    </div>
</div>