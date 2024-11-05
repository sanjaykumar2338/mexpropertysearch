<?php if ( is_page_template( 'tpl/front-page.php' ) || is_404() || get_page_template_slug( get_queried_object_id() ) == 'elementor_header_footer' ) { return; } ?>

<?php 

    $show_action_box = themesflat_get_opt('show_action_box');

    if ($show_action_box == 1) :  

    $action_box_text = themesflat_get_opt('action_box_text');

    $action_box_button_text = themesflat_get_opt('action_box_button_text');

    $action_box_button_url = themesflat_get_opt('action_box_button_url');
?>
    <div class="themesflat-action-box">
        <div class="container">
            <div class="row align-item-end">
                <div class="col-lg-8 col-md-7">
                    <div class="content">
                        <h2 class="heading"><?php echo themesflat_get_opt('action_box_text'); ?></h2>
                        <p class="description"><?php echo themesflat_get_opt('action_box_desc'); ?></p>
                        <a href="<?php echo esc_url(themesflat_get_opt('action_box_button_url')) ?>" class="tf-btn has-icon"><?php echo themesflat_get_opt('action_box_button_text'); ?><span></span></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-5">
                    <div class="content-thumb">
                        <img src="<?php echo esc_url(themesflat_get_opt('action_box_image')) ?>" alt="images">
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
