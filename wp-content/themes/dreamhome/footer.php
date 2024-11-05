<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package dreamhome
 */
?>
</div><!-- #content -->
</div><!-- #main-content -->

<?php get_template_part('tpl/partner'); ?>

<!-- Start Footer -->
<div class="footer_background <?php echo themesflat_get_opt_elementor('extra_classes_footer'); ?>">
    <div class="overlay-footer"></div>

    <!-- Footer action -->
    <?php get_template_part('tpl/action-box'); ?>

    <!-- Info Footer -->
    <?php get_template_part('tpl/footer/info-footer'); ?>

    <!-- Footer Widget -->
    <?php get_template_part('tpl/footer/footer-widgets'); ?>

    <!-- Footer navigation -->
    <?php get_template_part('tpl/footer/footer-navigation'); ?>

    <!-- Bottom -->
    <?php get_template_part('tpl/footer/bottom'); ?>

</div> <!-- Footer Background Image -->
<!-- End Footer -->

</div><!-- /#boxed -->
<?php wp_footer(); ?>
<?php if (is_plugin_active('tf-real-estate/index.php')): ?>
    <?php do_action('popup_filter_modal_form'); ?>
<?php else: ?>
    <h6 class="nofi-popup-search"><?php esc_html_e('Need to active plugin TF Real Estate!', 'dreamhome'); ?></h6>
<?php endif; ?>
</body>

</html>