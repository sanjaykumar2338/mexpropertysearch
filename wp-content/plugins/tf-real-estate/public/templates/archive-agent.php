<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
get_header();
?>
<div class="tfre-agency-single-wrap">
    <div class="agency-single">
        <div class="container">
            <div class="row">
                <?php if (is_post_type_archive('agent')): ?>
                    <?php echo do_shortcode('[listing_agent]'); ?>
                <?php else: ?>
                    <div class="col-sm-8">
                        <?php
                        do_action('tfre_taxonomy_agency_summary');
                        ?>
                    </div>
                    <div class="col-sm-4">
                        <div class="tfre_sidebar">
                            <?php if (is_active_sidebar('agency-list-sidebar')) { ?>
                                <?php dynamic_sidebar('agency-list-sidebar'); ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();