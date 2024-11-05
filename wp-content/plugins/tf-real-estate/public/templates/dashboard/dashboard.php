<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if (!is_user_logged_in()) {
    tfre_get_template_with_arguments('global/access-permission.php', array('type' => 'not_login'));
    return;
}
$property_public        = new Property_Public();
$my_property_page       = tfre_get_permalink('my_properties_page') ? tfre_get_permalink('my_properties_page') : '';
$my_property_publish    = $my_property_page ? add_query_arg(array('post_status' => 'publish'), $my_property_page): '';
$my_property_pending    = $my_property_page ? add_query_arg(array('post_status' => 'pending'), $my_property_page): '';
$my_favorite            = tfre_get_permalink('my_favorites_page') ? tfre_get_permalink('my_favorites_page') : '';
$my_review              = tfre_get_permalink('my_reviews_page') ? tfre_get_permalink('my_reviews_page') : '';
$prop_enable_short_price_unit = tfre_get_option('enable_short_price_unit', 0) == 1 ? true : false;
?>
<div class="tfre-dashboard">
    <div class="tfre-dashboard-overview">
            <div class="row" >
                <div class="col-sm-6 col-xl-3 border">
                    <a class="tfre-card" href="<?php echo esc_url($my_property_publish) ?>">
                        <div class= "card-body row align-items-center">
                            <div class="tfre-icon-overview">
                                <img loading="lazy" src="<?php bloginfo('template_url'); ?>/images/svg-theme/icon-2.svg" alt="icon">
                            </div>
                            <div class="col-7">
                                <h5><?php esc_html_e( 'Your Listing', 'tf-real-estate' ); ?></h5>
                                <div class="tfre-dashboard-title">
                                    <div class="listing-text"><?php echo sprintf(__('%d <p>/%d Remaining</p>','tf-real-estate'), ($publish_property_by_user > $pending_properties) ?($publish_property_by_user - $pending_properties) : $publish_property_by_user, $publish_property_by_user)?> </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-xl-3 border">
                    <a class="tfre-card" href="<?php echo esc_url($my_property_pending) ?>">
                        <div class="card-body row align-items-center">
                            <div class="tfre-icon-overview">
                                <img loading="lazy" src="<?php bloginfo('template_url'); ?>/images/svg-theme/icon-1.svg" alt="icon">
                            </div>
                            <div class="col-7">
                                <h5><?php esc_html_e( 'Pending', 'tf-real-estate' ); ?></h5>
                                <div class="tfre-dashboard-title">
                                    <span><?php echo sprintf(__('<b>%d</b>','tf-real-estate'),$pending_properties)?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-xl-3 border">
                    <a class="tfre-card" href="<?php echo esc_url($my_favorite) ?>">
                        <div class="card-body row align-items-center">
                            <div class="tfre-icon-overview">
                                <img loading="lazy" src="<?php bloginfo('template_url'); ?>/images/svg-theme/icon-8.svg" alt="icon">
                            </div>
                            <div class="col-7">
                                <h5><?php esc_html_e( 'Favorites', 'tf-real-estate' ); ?></h5>
                                <div class="tfre-dashboard-title">
                                    <span><?php echo sprintf( __('<b>%d</b>', 'tf-real-estate'), $total_favorite) ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-xl-3 border">
                    <a class="tfre-card" href="<?php echo esc_url($my_review) ?>">
                        <div class="card-body row align-items-center">
                            <div class="tfre-icon-overview">
                                <img loading="lazy" src="<?php bloginfo('template_url'); ?>/images/svg-theme/icon-7.svg" alt="icon">
                            </div>
                            <div class="col-7">
                                <h5><?php esc_html_e( 'Reviews', 'tf-real-estate' ); ?></h5>
                                <div class="tfre-dashboard-title">
                                    <span><?php echo sprintf( __('<b>%d</b>', 'tf-real-estate'), $total_review) ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
    </div>
    <div class="tfre-dashboard-middle mt-2">
            <div class="row">
                <div class="tfre-dashboard-middle-left col-xl-9 col-md-12">
                    <div class="tfre-dashboard-listing">
                        <h5><?php esc_html_e( 'New listing', 'tf-real-estate' ); ?></h5>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="text" name="title_search" id="title_search" value ="<?php echo esc_attr($search) ?>"
                                    placeholder="<?php esc_attr_e( 'Search...', 'tf-real-estate' ); ?>">
                            </div>
                            <div class="col-sm-3">
                                <div class="group-input-icon">
                                    <input type="text" id="from-date" class="datetimepicker" name="from_date" value ="<?php echo esc_attr($from_date) ?>"
                                        placeholder="<?php esc_attr_e( 'From Date', 'tf-real-estate' ); ?>">
                                    <span class="datepicker-icon">
                                        <img loading="lazy" src="<?php bloginfo('template_url'); ?>/images/svg-theme/icon-6.svg" alt="icon">
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="group-input-icon">
                                    <input type="text" id="to-date" class="datetimepicker" name="to_date" value ="<?php echo esc_attr($to_date) ?>"
                                        placeholder="<?php esc_attr_e( 'To Date', 'tf-real-estate' ); ?>">
                                    <span class="datepicker-icon">
                                        <img loading="lazy" src="<?php bloginfo('template_url'); ?>/images/svg-theme/icon-6.svg" alt="icon">
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <select name="post_status" id="post_status" class="form-control"
                                    title="<?php esc_attr_e('Post Status', 'tf-real-estate') ?>">
                                    <option value="<?php echo esc_attr($property_public->tfre_get_link_filter_post_status('default')) ?>"  <?php selected('default', $selected_post_status); ?> ><?php esc_html_e('Select', 'tf-real-estate'); ?></option>
                                    <?php foreach ($list_post_status as $status_key => $post_status): ?>
                                        <option value="<?php echo esc_attr($property_public->tfre_get_link_filter_post_status($status_key)) ?>" <?php selected($status_key, $selected_post_status); ?>>
                                            <?php esc_html_e($post_status, 'tf-real-estate'); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>           
                        </div>
                        <div class="tfre-table-listing">
                            <?php if (!$properties): ?>
                                <div><?php esc_html_e('You don\'t have any properties.', 'tf-real-estate'); ?></div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table">
                                        <span class="result-text"><?php echo sprintf( __('<b>%d</b> results found', 'tf-real-estate'), $total_post_listing) ?></span>
                                        <thead>
                                            <tr>
                                                <th><?php esc_html_e('Listing', 'tf-real-estate'); ?></th>
                                                <th><?php esc_html_e('Status', 'tf-real-estate'); ?></th>
                                                <th><?php esc_html_e('Action', 'tf-real-estate'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody class="tfre-table-content">
                                            <?php foreach ($properties as $property) : ?>
                                                <tr>
                                                    <td class="column-property">
                                                        <div class="tfre-listing-product">
                                                            <?php
                                                                $prop_address = get_post_meta($property->ID, 'property_address', true);
                                                                $prop_price_value = get_post_meta($property->ID, 'property_price_value', true);
                                                                $prop_price_unit = get_post_meta($property->ID, 'property_price_unit', true);
                                                                $prop_price_prefix = get_post_meta($property->ID, 'property_price_prefix', true);
                                                                $prop_price_postfix = get_post_meta($property->ID, 'property_price_postfix', true);
                                                                $prop_address = get_post_meta($property->ID, 'property_address', true);
                                                                $prop_zipcode = get_post_meta($property->ID, 'property_zip', true);
            
                                                                $width = tfre_get_option('thumbnail_width', 168);
                                                                $height = tfre_get_option('thumbnail_height', 95);
                                                                $no_image_src = tfre_get_option('default_property_image', '')['url'] != '' ? tfre_get_option('default_property_image', '')['url'] : TF_PLUGIN_URL . 'includes/elementor-widget/assets/images/no-image.jpg';
                                                                
                                                                $attach_id = get_post_thumbnail_id($property);
                                                                $image_src = $attach_id != 0 ? tfre_image_resize_url(wp_get_attachment_image_url($attach_id, "full"), $width, $height, true)['url'] : $no_image_src;
                                                                if ($property->post_status == 'publish') : ?>
                                                                    <a class="thumbproduct" target="_blank" title="<?php echo esc_attr($property->post_title); ?>"
                                                                    href="<?php echo get_permalink($property->ID); ?>">
                                                                        <img loading="lazy" width="<?php echo esc_attr($width) ?>"
                                                                            height="<?php echo esc_attr($height) ?>"
                                                                            src="<?php echo esc_url($image_src) ?>"
                                                                            onerror="this.src = '<?php echo esc_url($no_image_src) ?>';"
                                                                            alt="<?php echo esc_attr($property->post_title); ?>"
                                                                            title="<?php echo esc_attr($property->post_title); ?>">
                                                                    </a>
                                                                <?php else : ?>
                                                                    <img loading="lazy" class="thumbnail" width="<?php echo esc_attr($width) ?>"
                                                                        height="<?php echo esc_attr($height) ?>"
                                                                        src="<?php echo esc_url($image_src) ?>"
                                                                        onerror="this.src = '<?php echo esc_url($no_image_src) ?>';"
                                                                        alt="<?php echo esc_attr($property->post_title); ?>"
                                                                        title="<?php echo esc_attr($property->post_title); ?>">
                                                                <?php endif; ?>
                                                                <div class="tfre-property-summary">
                                                                    <?php if ($property->post_status === 'publish'): ?>
                                                                        <h4 class="tfre-property-title">
                                                                            <a target="_blank" title="<?php echo esc_attr($property->post_title); ?>"
                                                                                    href="<?php echo get_permalink($property->ID); ?>"><?php echo esc_html($property->post_title); ?></a>
                                                                        </h4>
                                                                    <?php else: ?>
                                                                        <h4 class="tfre-property-title"><?php echo esc_html($property->post_title); ?></h4>
                                                                    <?php endif; ?>
                                                                    <div class="tfre-property-date"><?php esc_html_e( 'Posting date: ', 'tf-real-estate' ); ?><?php echo esc_html(date_i18n(get_option('date_format'), strtotime($property->post_date))) ; ?></div>
                                                                    <?php if ($prop_price_value !== ''): ?>
                                                                        <div class="tfre-property-price">
                                                                            <?php if ($prop_price_prefix !== ''): ?>
                                                                                <span class="tfre-prop-price-postfix"><?php echo esc_html($prop_price_prefix) ?></span>
                                                                            <?php endif; ?>
                                                                            <span class="tfre-prop-price-value"><?php echo tfre_format_price($prop_price_value, $prop_price_unit, true, $prop_enable_short_price_unit) ?></span>
                                                                            <?php if ($prop_price_postfix !== ''): ?>
                                                                                <span class="tfre-prop-price-postfix"> <?php echo esc_html($prop_price_postfix) ?></span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                        </div>
                                                    </td>
                                                    <td class="column-status">
                                                        <span class="tfre-property-status status-<?php echo esc_attr($property->post_status); ?>">
                                                            <?php
                                                            switch ($property->post_status) {
                                                                case 'publish':
                                                                    esc_html_e('Approved','tf-real-estate');
                                                                    break;
                                                                case 'sold':
                                                                    esc_html_e('Sold','tf-real-estate');
                                                                    break;
                                                                case 'pending':
                                                                    esc_html_e('Pending','tf-real-estate');
                                                                    break;
                                                                default:
                                                                    echo esc_html($property->post_status);
                                                            }?>
                                                        </span>
                                                    </td>
                                                    <td class="column-controller">
                                                        <?php
                                                        $actions = array();
            
                                                        $actions['edit'] = array('id' => 'edit', 'label' => __('Edit', 'tf-real-estate'), 'tooltip' => __('Edit property', 'tf-real-estate'), 'nonce' => false, 'type_page_link' => 'save-property', 'confirm' => '');
            
                                                        $actions['sold'] = array('id' => 'sold', 'label' => __('Sold', 'tf-real-estate'), 'tooltip' => __('Sold Property', 'tf-real-estate'), 'nonce' => true, 'type_page_link' => 'my-properties', 'confirm' => esc_html__('Are you sure you want to sold this property?', 'tf-real-estate'));
            
                                                        $actions['delete'] = array('id' => 'delete', 'label' => __('Delete', 'tf-real-estate'), 'tooltip' => __('Delete Property', 'tf-real-estate'), 'nonce' => true, 'type_page_link' => 'my-properties', 'confirm' => esc_html__('Are you sure you want to delete this property?', 'tf-real-estate'));
            
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
                                                            <div class="inner-controller">
                                                                <span class="icon">
                                                                    <?php
                                                                        switch ($action) {
                                                                            case 'edit':
                                                                                ?>
                                                                                    <img loading="lazy" src="<?php bloginfo('template_url'); ?>/images/svg-theme/icon-5.svg" alt="icon">
                                                                                <?php
                                                                                break;
                                                                            case 'sold':
                                                                                ?>
                                                                                    <img loading="lazy" src="<?php bloginfo('template_url'); ?>/images/svg-theme/icon-4.svg" alt="icon">
                                                                                <?php
                                                                                break;
                                                                            case 'delete':
                                                                                ?>
                                                                                    <img loading="lazy" src="<?php bloginfo('template_url'); ?>/images/svg-theme/icon-3.svg" alt="icon">
                                                                                <?php
                                                                                break;
                                                                            default:
                                                                                ?>
                                                                                    <img loading="lazy" src="<?php bloginfo('template_url'); ?>/images/svg-theme/icon-5.svg" alt="icon">
                                                                                <?php
                                                                    }?>
                                                                    
                                                                </span>
                                                                <?php if ($property->post_status === 'sold' && ($action === 'sold' ||  $action === 'edit')   ) : ?>
                                                                        <a disabled="disabled" class="disabled-click"> <?php echo esc_html($value['label']); ?></a>
                                                                <?php else : ?>
                                                                    <a href="<?php echo $action != 'edit' ? 'javascript:void(0)' : esc_url($action_url); ?>"
                                                                    data-toggle="tooltip"
                                                                    data-placement="bottom"
                                                                    data-action = "<?php echo esc_attr($action); ?>"
                                                                    data-property-id = "<?php echo esc_attr($property->ID); ?>"
                                                                    disabled = "<?php $property->post_status == 'publish' ? true : false  ?>"
                                                                    title="<?php echo esc_attr($value['tooltip']); ?>"
                                                                    class="btn-action tfre-dashboard-action-<?php echo esc_attr($action); ?>"><?php esc_html_e($value['label'], 'tf-real-estate'); ?></a>
                                                                <?php endif; ?>
                                                            </div>
                                                            <?php
                                                        } ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php tfre_get_template_with_arguments( 'global/pagination.php', array( 'max_num_pages' => $max_num_pages ) ); ?>
                            <?php endif; ?>    
                        </div>
                    </div>
                    <div class="tfre-page-insight">
                        <h5><?php esc_html_e( 'Page Insight', 'tf-real-estate' ); ?></h5>
                        <div class="tfre-page-insight-filter">
                            <div class="row">
                                <div class="col-xl-6 col-md-12">
                                    <div class="tfre-page-insight-filter-button">
                                        <div class="group-button">
                                            <button type="button" class="btn btn-light btn-filter-chart" data-value="1"><?php esc_html_e( 'Day', 'tf-real-estate' ); ?></button>
                                        </div>
                                        <div class="group-button">
                                            <button type="button" class="btn btn-light btn-filter-chart" data-value="7"><?php esc_html_e( 'Week', 'tf-real-estate' ); ?></button>
                                        </div>
                                        <div class="group-button">
                                            <button type="button" class="btn btn-light btn-filter-chart" data-value="30"><?php esc_html_e( 'Month', 'tf-real-estate' ); ?></button>
                                        </div>
                                        <div class="group-button">
                                            <button type="button" class="btn btn-light btn-filter-chart" data-value="365"><?php esc_html_e( 'Year', 'tf-real-estate' ); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="insight-chart-container">
                            <canvas id="insight-chart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="tfre-dashboard-middle-right col-xl-3 col-md-12">
                    <div class="tfre-card tfre-dashboard-message">
                        <h5><?php esc_html_e( 'Messages', 'tf-real-estate' ); ?></h5>
                        <b><?php esc_html_e( 'Comming soon!', 'tf-real-estate' ); ?></b>
                    </div>
                    <div class="tfre-card tfre-dashboard-reviews">
                        <h5><?php esc_html_e( 'Recent Reviews', 'tf-real-estate' ); ?></h5>
                        <?php if (!$reviews): ?>
                            <span><?php esc_html_e('Don\'t have any reviews.', 'tf-real-estate'); ?></span>
                        <?php else: ?>
                            <ul>
                            <?php foreach ($reviews as $review) : 
                                $author_picture = get_the_author_meta('profile_image', $review->user_id);
                                $no_avatar_src  = TF_PLUGIN_URL . 'includes/elementor-widget/assets/images/no-image.jpg';
                                $width = 34;
                                $height = 34;
                                $default_avatar = tfre_get_option('default_user_avatar', '');
                                if (is_array($default_avatar) && $default_avatar['url'] != '') {
                                    $no_avatar_src = tfre_image_resize_url($default_avatar['url'], $width, $height, true)['url'];
                                }
                                $user_link = get_author_posts_url($review->user_id);
                                ?>
                                <li class="comment byuser">
                                    <div class="group-author">
                                            <img loading="lazy" class="avatar" width="<?php echo esc_attr($width) ?>"
                                                height="<?php echo esc_attr($height) ?>"
                                                src="<?php echo esc_url($author_picture ? $author_picture : '') ?>"
                                                onerror="this.src = '<?php echo esc_url($no_avatar_src) ?>';"
                                                alt=""
                                                title="">
                                                <?php
                                                $user_info = get_userdata($review->user_id);
                                                ?>
                                                <span class="review-name">
                                                    <?php echo sprintf(__('<b>%s</b>','tf-real-estate'),$user_info ? $user_info->user_nicename : '')?></span>
                                                <span class="review-date"><?php echo esc_html(tfre_get_comment_time($review->comment_ID)); ?></span>

                                    </div>
                                    <div class="content">
                                            <p><?php echo esc_html($review->comment_content); ?> </p>
                                            <span class="rating-wrap">
                                                <div class="form-group">
                                                    <div class="star-rating">
                                                        <?php for ($i = 1; $i <= 5; $i++) :  ?>
                                                            <i class="star disabled-click far fa-star <?php echo esc_attr($i <= get_comment_meta($review->comment_ID, 'property_rating', true) ? 'active' : ''); ?>" data-rating="<?php echo esc_attr($i); ?>" ></i>
                                                        <?php endfor; ?>
                                                    </div>
                                                </div>
                                            </span>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                            </ul>
                        <?php endif; ?> 
                    </div>
                </div>
            </div>
    </div>
</div>