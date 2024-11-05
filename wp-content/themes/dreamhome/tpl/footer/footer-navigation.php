<?php

if (themesflat_get_opt('show_footer_navigation') == 1) : ?>  
    <div class="footer-navigation"> 
        <div class="container">
            <div class="wrap-navigation">
                <?php get_template_part( 'tpl/footer/brand-ft'); ?>
                <?php if (themesflat_get_opt('show_footer_navigation_menu') == 1) : ?>
                <div class="content-center">
                    <?php
                    wp_nav_menu( array( 'theme_location' => 'bottom', 'fallback_cb' => 'themesflat_menu_fallback', 'container' => false ) );
                    ?>
                </div>
                <?php endif; ?>
                <?php if (themesflat_get_opt('show_footer_navigation_social') == 1) : ?>
                <div class="content-right">
                    <?php themesflat_render_social();   ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>