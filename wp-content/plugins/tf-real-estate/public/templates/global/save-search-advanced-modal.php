<?php
/**
 * @var $parameters
 * @var $search_query
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div class="modal fade save_search_advanced_modal" id="save_search_advanced_modal" tabindex="-1" role="dialog"
    aria-labelledby="SaveSearchModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="SaveSearchModalLabel"><?php esc_html_e('Saved Search', 'tf-real-estate'); ?>
                </p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form></form><!-- don't remove this form, to save search form not hidden -->
                <div class="alert alert-warning" role="alert">
                    <i class="fa fa-info-circle"></i>
                    <?php esc_html_e('You will receive an email notification whenever have a new property that matching with your condition advanced search saved.', 'tf-real-estate'); ?>
                </div>
                <form id="tfre_save_search_form" method="post">
                    <div class="form-group">
                        <label for="tfre_title"><?php esc_html_e('Title', 'tf-real-estate'); ?></label>
                        <input type="text" name="title" id="tfre_title"
                            placeholder="<?php esc_attr_e('Input title', 'tf-real-estate'); ?>" class="form-control"
                            value="" aria-describedby="parameters" required>
                        <input type="hidden" name="parameters"
                            value="<?php echo esc_attr(base64_encode($parameters)); ?>">
                        <input type="hidden" name="search_query"
                            value="<?php echo esc_attr(base64_encode(serialize($search_query))); ?>">
                        <input type="hidden" name="url_request"
                            value="<?php echo esc_url(sanitize_url($_SERVER['REQUEST_URI'])) ?>">
                        <input type="hidden" name="action" value='tfre_save_advanced_search_ajax'>
                        <input type="hidden" name="tfre_save_search_nonce"
                            value="<?php echo esc_attr(wp_create_nonce('tfre_save_search_nonce_field')) ?>">
                        <small id="parameters"
                            class="form-text text-muted"><?php echo wp_kses_post(sprintf(esc_html__('Parameters: %s', 'tf-real-estate'), $parameters)); ?></small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn-default"
                    data-dismiss="modal"><?php esc_html_e('Close', 'tf-real-estate'); ?></button>
                <button id="tfre_save_search" class="btn btn-primary" type="button"><?php esc_html_e('Save', 'tf-real-estate'); ?></button>
            </div>
        </div>
    </div>
</div>