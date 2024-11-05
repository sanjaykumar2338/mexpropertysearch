<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$value_agent  = isset($_GET['agent_name']) ? (wp_unslash($_GET['agent_name'])) : '';
$value_agency = isset($_GET['agency']) ? (wp_unslash($_GET['agency'])) : '';
?>
<div class="tfre-search-agent-wrap">
    <div class="form-search-inner">
        <?php $search_url = tfre_get_permalink('agent_page'); ?>
        <div data-href="<?php echo esc_url($search_url) ?>" class="search-agent-form">
            <div class="tf-search-form">
                <div class="row">
                    <div class="form-group">
                        <input type="text" class="form-control search-field" data-default-value=""
                            value="<?php echo esc_attr($value_agent); ?>" name="agent_name" placeholder="<?php esc_attr_e('Agent name', 'tf-real-estate') ?>">
                    </div>
                    <div class="form-group">
                        <select name="agency" title="<?php esc_attr_e('Agency', 'tf-real-estate') ?>"
                            class="search-field form-control" data-default-value="">
                            <option value="" <?php selected('', $value_agency) ?>>
                                <?php esc_html_e('All Agency', 'tf-real-estate') ?>
                            </option>
                            <?php tfre_get_taxonomy_options('agencies', $value_agency, true, false); ?>
                        </select>
                    </div>
                    <div class="form-group submit-search-form">
                        <button type="button" class="tfre-search-agent-btn">
                            <?php esc_html_e('Search Now', 'tf-real-estate') ?><i class="icon-dreamhome-search"></i>
                        </button>
                        <input type="submit" hidden/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>