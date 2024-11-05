<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$array_agent = array();

$query_args = array(
    'post_type'      => 'agent',
    'posts_per_page' => $args['number_of_agents'],
    'post_status'    => 'publish'
);
$agents     = new WP_Query($query_args);

if ($agents->have_posts()):
    while ($agents->have_posts()):
        $agents->the_post();
        $agent_id       = get_the_ID();
        $total_property = tfre_get_total_properties_by_user($agent_id);
        $array_agent[]  = array(
            'id'             => $agent_id,
            'total_property' => $total_property
        );
    endwhile;
endif;
function compare_total_properties_of_agent($a, $b) {
    if ($a['total_property'] == $b['total_property']) {
        return 0;
    }
    return ($a['total_property'] > $b['total_property']) ? -1 : 1;
}
usort($array_agent, "compare_total_properties_of_agent");
?>
<div class="tfre-list-contact-agents-wrap">
    <div class="tfre-list-contact-agents">
        <?php if (count($array_agent) > 0): ?>
            <?php
            $width          = 65;
            $height         = 65;
            $no_avatar_src  = TF_PLUGIN_URL . 'includes/elementor-widget/assets/images/no-image.jpg';
            $default_avatar = tfre_get_option('default_user_avatar', '');
            if (is_array($default_avatar) && $default_avatar['url'] != '') {
                $no_avatar_src = tfre_image_resize_url($default_avatar['url'], $width, $height, true)['url'];
            }
            ?>
            <?php foreach ($array_agent as $index => $agent): ?>
                <?php
                $index += 1;
                if ($index > $args['number_of_agents']) {
                    return;
                }
                $agent_name         = get_the_title($agent['id']);
                $agent_link         = get_the_permalink($agent['id']);
                $agent_phone_number = get_post_meta($agent['id'], 'agent_phone_number', true);
                $avatar_id          = get_post_thumbnail_id($agent['id']);
                $avatar_src         = tfre_image_resize_id($avatar_id, $width, $height, true);
                ?>
                <div class="agent-item">
                    <div class="agent-avatar"><a title="<?php echo esc_attr($agent_name) ?>"
                            href="<?php echo esc_url($agent_link) ?>">
                            <img loading="lazy" src="<?php echo esc_url($avatar_src) ?>"
                                onerror="this.src = '<?php echo esc_url($no_avatar_src) ?>';"
                                alt="<?php echo esc_attr($agent_name) ?>" title="<?php echo esc_attr($agent_name) ?>"></a>
                    </div>
                    <div class="agent-info">
                        <?php if (!empty($agent_name)): ?>
                            <h2 class="agent-name"><a title="<?php echo esc_attr($agent_name) ?>"
                                    href="<?php echo esc_url($agent_link) ?>"><?php echo esc_html($agent_name) ?></a>
                            </h2>
                        <?php endif;
                        if (!empty($agent_phone_number)): ?>
                            <span class="agent-position"><?php echo esc_html($agent_phone_number) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="item-not-found"><?php esc_html_e('No item found', 'tf-real-estate'); ?></div>
        <?php endif; ?>
    </div>
</div>