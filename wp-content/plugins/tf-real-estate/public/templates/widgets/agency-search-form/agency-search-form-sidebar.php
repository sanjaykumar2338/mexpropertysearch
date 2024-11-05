<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$value_agency = isset($_GET['agency_name']) ? (wp_unslash($_GET['agency_name'])) : '';
?>
<div class="tfre-search-agency-wrap">
    <div class="form-search-inner">
        <?php $search_url = tfre_get_permalink('agency_page'); ?>
        <div data-href="<?php echo esc_url($search_url) ?>" class="search-agency-form">
            <div class="tf-search-form">
                <div class="row">
                    <div class="form-group">
                        <input type="text" class="form-control search-field" data-default-value=""
                            value="<?php echo esc_attr($value_agency); ?>" name="agency_name" placeholder="<?php esc_attr_e('agency name', 'tf-real-estate'); ?>">
                    </div>
                    <div class="form-group submit-search-form">
                        <button type="button" class=" tfre-search-agency-btn">
                            <?php esc_html_e('Search', 'tf-real-estate') ?><i class="icon-dreamhome-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>