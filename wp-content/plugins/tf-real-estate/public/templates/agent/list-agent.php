<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

wp_enqueue_style('agent-style');
wp_enqueue_style('agency-style');
?>
<div class="row">
    <div class="col-sm-3">
        <h2><?php esc_html_e('Agents', 'tf-real-estate'); ?></h2>
    </div>
    <div class="col-sm-9">

        <div class="tfre-controll-agencies">
            <div class="group-switch-layout">
                <a class="agent-view-grid-list list-view <?php echo esc_attr($view == 'list' || $view == '' ? 'active' : '') ?>"
                    href="javascript:void(0)" data-value="list"><i class="far fa-list"></i></a>
                <a class="agent-view-grid-list grid-view <?php echo esc_attr($view == 'grid' ? 'active' : '') ?>"
                    href="javascript:void(0)" data-value="grid"><i class="far fa-th-large"></i></a>
            </div>
    
            <?php if ($view == 'list' || $view == ''): ?>
            <?php endif; ?>
    
            <div class="group-agency-order">
                <select name="orderby" id="agent_order_by" class="form-control"
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
<div class="cards-container list-item-agent">
    <div class="row">
        <div class="agent-inner <?php echo esc_attr(tfre_get_option('archive_agent_sidebar_position')); ?> <?php echo esc_attr(tfre_get_option('archive_agent_sidebar') == 'enable' ? 'col-md-8' : 'col-md-12'); ?>">
            <?php if ($view == 'grid'): ?>
                <?php if ($agents): ?>
                    <div class="agent-inner row">
                            <?php foreach ($agents as $agent):
                                tfre_get_template_with_arguments(
                                    'agent/card-item-agent.php',
                                    array(
                                        'agent' => $agent,
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
                <?php if ($agents): ?>
                    <?php foreach ($agents as $agent):
                        tfre_get_template_with_arguments(
                            'agent/card-item-agent.php',
                            array(
                                'agent' => $agent,
                                'view' => $view == '' ? 'list' : $view
                            )
                        );
                    endforeach; ?>
                <?php else: ?>
                    <div class="item-not-found"><?php esc_html_e('No item found', 'tf-real-estate'); ?></div>
                <?php endif; ?>
            <?php endif; ?>
        <?php tfre_get_template_with_arguments('global/pagination.php', array( 'max_num_pages' => $max_num_pages )); ?>
        </div>
        <?php if (tfre_get_option('archive_agent_sidebar') == 'enable'): ?>
            <div class="agent-search-inner col-md-4">
                <div class="tfre_sidebar">
                <?php if (is_active_sidebar('archive-agent-sidebar')) { ?>
                    <?php dynamic_sidebar('archive-agent-sidebar'); ?>
                <?php } ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php
wp_reset_postdata();