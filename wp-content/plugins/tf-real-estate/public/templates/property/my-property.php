<?php
/**
 * @var $properties
 * @var $max_num_pages
 * @var $list_post_status
 * @var $selected_post_status
 * @var $title_search
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!is_user_logged_in()) {
    tfre_get_template_with_arguments('global/access-permission.php', array( 'type' => 'not_login' ));
    return;
}
$property_public = new Property_Public();
$new_property_id = isset($_GET['new_property_id']) ? wp_unslash($_GET['new_property_id']) : '';
$submit_mode     = isset($_GET['submit_mode']) ? wp_unslash($_GET['submit_mode']) : '';
if (!empty($new_property_id)) {
    tfre_get_template_with_arguments('property/alert-handle-property.php', array( 'property' => get_post($new_property_id), 'submit_mode' => $submit_mode ));
}
?>
<div class="tfre_message"></div>
<div class="tfre-my-property-sc">
    <form method="get" action="<?php echo esc_url(get_page_link()); ?>" class="tfre-my-property-search">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="post_status"><?php esc_html_e('Post Status', 'tf-real-estate'); ?></label>
                    <select name="post_status" id="post_status" class="form-control"
                        title="<?php esc_attr_e('Post Status', 'tf-real-estate') ?>">
                        <option value="<?php echo esc_attr($property_public->tfre_get_link_filter_post_status('default')) ?>"
                            <?php selected('default', $selected_post_status); ?>><?php esc_html_e('Select', 'tf-real-estate'); ?></option>
                            <?php foreach ($list_post_status as $status_key => $post_status): ?>
                                <option value="<?php echo esc_attr($property_public->tfre_get_link_filter_post_status($status_key)) ?>" <?php selected($status_key, $selected_post_status); ?>>
                                    <?php esc_html_e($post_status, 'tf-real-estate'); ?>
                                </option>
                            <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="title_search"><?php esc_html_e('Post Title', 'tf-real-estate'); ?></label>
                    <input type="text" name="title_search" id="title_search"
                        value="<?php esc_attr_e($title_search); ?>" class="form-control"
                        placeholder="<?php esc_attr_e('Search by title', 'tf-real-estate'); ?>">
                </div>
            </div>
        </div>
    </form>
    <?php if (!$properties): ?>
        <div><?php esc_html_e('You don\'t have any properties.', 'tf-real-estate'); ?></div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-mobile">
                <thead>
                    <tr>
                        <th><?php esc_html_e('Title', 'tf-real-estate'); ?></th>
                        <th><?php esc_html_e('Date Published', 'tf-real-estate'); ?></th>
                        <th><?php esc_html_e('Status', 'tf-real-estate'); ?></th>
                        <th><?php esc_html_e('Feature', 'tf-real-estate'); ?></th>
                        <th><?php esc_html_e('Action', 'tf-real-estate'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($properties as $property): ?>
                        <tr>
                            <td>
                                <div class="tfre-property-listing">
                                    <?php
                                    $prop_address                 = get_post_meta($property->ID, 'property_address', true);
                                    $prop_price_value             = get_post_meta($property->ID, 'property_price_value', true);
                                    $prop_price_unit              = get_post_meta($property->ID, 'property_price_unit', true);
                                    $prop_enable_short_price_unit = tfre_get_option('enable_short_price_unit', 0) == 1 ? true : false;
                                    $prop_price_prefix            = get_post_meta($property->ID, 'property_price_prefix', true);
                                    $prop_price_postfix           = get_post_meta($property->ID, 'property_price_postfix', true);
                                    $prop_address                 = get_post_meta($property->ID, 'property_address', true);
                                    $prop_zipcode                 = get_post_meta($property->ID, 'property_zip', true);
    
                                    $width        = get_option('thumbnail_width') ? get_option('thumbnail_width') : '168px';
                                    $height       = get_option('thumbnail_height') ? get_option('thumbnail_height') : '95px';
                                    $no_image_src = tfre_get_option('default_property_image', '')['url'] != '' ? tfre_get_option('default_property_image', '')['url'] : TF_PLUGIN_URL . 'includes/elementor-widget/assets/images/no-image.jpg';
                                    $attach_id    = get_post_thumbnail_id($property);
                                    $image_src    = wp_get_attachment_image_url($attach_id);
                                    if ($property->post_status == 'publish'): ?>
                                        <a target="_blank" class="thumb" title="<?php echo esc_attr($property->post_title); ?>"
                                            href="<?php echo esc_url(get_permalink($property->ID)); ?>">
                                            <img loading="lazy" width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>"
                                                src="<?php echo esc_url($image_src) ?>"
                                                onerror="this.src = '<?php echo esc_url($no_image_src) ?>';"
                                                alt="<?php echo esc_attr($property->post_title); ?>"
                                                title="<?php echo esc_attr($property->post_title); ?>">
                                        </a>
                                    <?php else: ?>
                                        <img loading="lazy" width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>"
                                            src="<?php echo esc_url($image_src) ?>"
                                            onerror="this.src = '<?php echo esc_url($no_image_src) ?>';"
                                            alt="<?php echo esc_attr($property->post_title); ?>"
                                            title="<?php echo esc_attr($property->post_title); ?>">
                                    <?php endif; ?>
                                    <div class="tfre-property-summary">
                                        <?php if ($property->post_status === 'publish'): ?>
                                            <h4 class="tfre-property-title">
                                                <a target="_blank" title="<?php echo esc_attr($property->post_title); ?>"
                                                    href="<?php echo esc_url(get_permalink($property->ID)); ?>"><?php echo esc_html($property->post_title); ?></a>
                                            </h4>
                                        <?php else: ?>
                                            <h4 class="tfre-property-title"><?php echo esc_html($property->post_title); ?></h4>
                                        <?php endif; ?>
                                        <?php if ($prop_price_value !== ''): ?>
                                            <span class="tfre-property-price">
                                                <?php if ($prop_price_prefix !== ''): ?>
                                                    <span class="tfre-prop-price-postfix"><?php echo esc_html($prop_price_prefix) ?></span>
                                                <?php endif; ?>
                                                <span
                                                    class="tfre-prop-price-value"><?php echo esc_html(tfre_format_price($prop_price_value, $prop_price_unit, true, $prop_enable_short_price_unit)) ?></span>
                                                <?php if ($prop_price_postfix !== ''): ?>
                                                    <span class="tfre-prop-price-postfix">
                                                        <?php echo esc_html($prop_price_postfix) ?></span>
                                                <?php endif; ?>
                                            </span>
                                        <?php endif; ?>
                                        <p class="tfre-property-address">
                                            <a title="<?php echo esc_attr($prop_address) ?>" target="_blank"
                                                href="<?php echo esc_url("//maps.google.com/?q=" . $prop_address . '+' . $prop_zipcode); ?>"><?php echo esc_html($prop_address) ?></a>
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="tfre-property-date"><?php echo esc_html(date_i18n(get_option('date_format'), strtotime($property->post_date))); ?></span>
                            </td>
                            <td>
                                <span class="tfre-property-status status-<?php echo esc_attr($property->post_status); ?>">
                                    <?php
                                    switch ($property->post_status) {
                                        case 'publish':
                                            esc_html_e('Published', 'tf-real-estate');
                                            break;
                                        case 'expired':
                                            esc_html_e('Expired', 'tf-real-estate');
                                            break;
                                        case 'pending':
                                            esc_html_e('Pending', 'tf-real-estate');
                                            break;
                                        case 'hidden':
                                            esc_html_e('Hidden', 'tf-real-estate');
                                            break;
                                        default:
                                            echo esc_html($property->post_status);
                                    } ?>
                                </span>
                            </td>
                            <td>
                                <?php
                                $prop_featured = get_post_meta($property->ID, 'property_featured', true);
                                if ($prop_featured === 1): ?>
                                    <span class="tfre-property-featured"><?php esc_html_e('Yes', 'tf-real-estate') ?></span>
                                <?php else: ?>
                                    <span class="tfre-property-featured"><?php esc_html_e('No', 'tf-real-estate') ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <ul class="controller">
                                    <?php
                                    $actions = array();
                                    switch ($property->post_status) {
                                        case 'publish':
                                            $actions['hide'] = array( 'label' => __('Hide', 'tf-real-estate'), 'tooltip' => __('Hide Property', 'tf-real-estate'), 'nonce' => true, 'type_page_link' => 'my-properties', 'confirm' => esc_html__('Are you sure want to hide this property?', 'tf-real-estate') );
    
                                            $actions['edit'] = array( 'label' => __('Edit', 'tf-real-estate'), 'tooltip' => __('Edit property', 'tf-real-estate'), 'nonce' => false, 'type_page_link' => 'save-property', 'confirm' => '' );
    
                                            break;
                                        case 'hidden':
                                            $actions['show'] = array( 'label' => __('Show', 'tf-real-estate'), 'tooltip' => __('Show Property', 'tf-real-estate'), 'nonce' => true, 'type_page_link' => 'my-properties', 'confirm' => esc_html__('Are you sure want to show this property?', 'tf-real-estate') );
    
                                            break;
                                        case 'pending':
                                            $actions['edit'] = array( 'label' => __('Edit', 'tf-real-estate'), 'tooltip' => __('Edit property', 'tf-real-estate'), 'nonce' => false, 'type_page_link' => 'save-property', 'confirm' => '' );
    
                                            break;
                                        default:
                                            # code...
                                            break;
                                    }
    
                                    $actions['delete'] = array( 'label' => __('Delete', 'tf-real-estate'), 'tooltip' => __('Delete Property', 'tf-real-estate'), 'nonce' => true, 'type_page_link' => 'my-properties', 'confirm' => esc_html__('Are you sure want to delete this property?', 'tf-real-estate') );
                                    foreach ($actions as $action => $value) {
                                        $page_link               = '';
                                        $my_properties_page_link = tfre_get_permalink('my_properties_page');
                                        $save_property_page_link = tfre_get_permalink('add_property_page');
                                        if ($value['type_page_link'] !== 'my-properties') {
                                            $page_link = $save_property_page_link;
                                        } else {
                                            $page_link = $my_properties_page_link;
                                        }
                                        $action_url = add_query_arg(array( 'action' => $action, 'property_id' => $property->ID ), $page_link);
                                        if ($value['nonce']) {
                                            $action_url = wp_nonce_url($action_url, 'tfre_my_properties_actions');
                                        }
                                        ?>
                                        <li>
                                            <a <?php if (!empty($value['confirm'])): ?>
                                                onclick="return confirm('<?php echo esc_html($value['confirm']); ?>')" <?php endif; ?>
                                                href="<?php echo esc_url($action_url); ?>" data-toggle="tooltip" data-placement="bottom"
                                                data-action = "<?php echo esc_attr($action); ?>"
                                                data-property-id = "<?php echo esc_attr($property->ID); ?>"
                                                title="<?php echo esc_attr($value['tooltip']); ?>"
                                                class="btn-action tfre-dashboard-action-<?php echo esc_attr($action); ?>"><?php esc_html_e($value['label'], 'tf-real-estate'); ?>
                                            </a>
                                        </li>
                                        <?php
                                    } ?>
                                </ul>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php tfre_get_template_with_arguments('global/pagination.php', array( 'max_num_pages' => $max_num_pages )); ?>
        </div>
    <?php endif; ?>
</div>