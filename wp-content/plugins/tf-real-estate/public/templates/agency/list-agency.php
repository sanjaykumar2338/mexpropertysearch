<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
wp_enqueue_style('agency-style');
?>
<div class="cards-container">
    <div class="row">
        <div class="agency-inner <?php echo esc_attr(tfre_get_option('agency_listing_sidebar')); ?> <?php echo esc_attr(tfre_get_option('agency_listing_sidebar_position')); ?> <?php echo esc_attr(tfre_get_option('agency_listing_sidebar') == 'enable' ? 'col-md-8' : 'col-md-12'); ?>">
            <div class="row agency-listing-header">
                <div class="col-sm-3">
                    <h2><?php esc_html_e('Agencies', 'tf-real-estate'); ?></h2>
                </div>
                <div class="col-sm-9">
                    <div class="tfre-controll-agencies">
                        <div class="group-switch-layout">
                            <a class="agency-view-grid-list list-view <?php echo esc_attr($view == 'list' || $view == '' ? 'active' : '') ?>"
                                href="javascript:void(0)" data-value="list"><i
                                    class="far fa-list"></i></a>
                            <a class="agency-view-grid-list grid-view <?php echo esc_attr($view == 'grid' ? 'active' : '') ?>"
                                href="javascript:void(0)" data-value="grid"><i
                                    class="far fa-th-large"></i></a>
                        </div>
                        <?php if ($view == 'list' || $view == ''): ?>
                        <?php endif; ?>
                        <div class="group-agency-order">
                            <select name="orderby" id="agency_order_by" class="form-control"
                                title="<?php esc_attr_e('Sort By', 'tf-real-estate') ?>">
                                <?php foreach ($list_order as $key => $order): ?>
                                    <option value="<?php echo esc_attr(tfre_get_link_order($key)) ?>" <?php selected($key, $selected_order); ?>>
                                        <?php printf(__($order, 'tf-real-estate')); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($view == 'grid'): ?>
                <?php if ($terms): ?>
                    <div class="agency-inner-grid">
                        <?php foreach ($terms as $term):
                            tfre_get_template_with_arguments(
                                'agency/card-item-agency.php',
                                array(
                                    'term' => $term,
                                    'view' => $view == '' ? 'list' : $view
                                )
                            );
                        endforeach;
                        ?>
                    </div>
                <?php else: ?>
                    <div class="item-not-found"><?php esc_html_e('No item found', 'tf-real-estate'); ?></div>
                <?php endif; ?>
            <?php else: ?>
                <?php if ($terms): ?>
                    <?php foreach ($terms as $term):
                        tfre_get_template_with_arguments(
                            'agency/card-item-agency.php',
                            array(
                                'term' => $term,
                                'view' => $view == '' ? 'list' : $view
                            )
                        );
                    endforeach; ?>
                <?php else: ?>
                    <div class="item-not-found"><?php esc_html_e('No item found', 'tf-real-estate'); ?></div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php if (tfre_get_option('agency_listing_sidebar') == 'enable'): ?>
            <div class="agency-search-inner col-md-4">
                <div class="tfre_sidebar">
                    <?php if (is_active_sidebar('agency-list-sidebar')) { ?>
                        <?php dynamic_sidebar('agency-list-sidebar'); ?>
                    <?php } ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php tfre_get_template_with_arguments('global/pagination.php', array( 'max_num_pages' => $max_num_pages )); ?>
</div>
<?php
wp_reset_postdata();