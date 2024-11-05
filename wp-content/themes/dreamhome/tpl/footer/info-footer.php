<?php
$show_footer_info = themesflat_get_opt('show_footer_info');

if ($show_footer_info == 1) :         
?>  
    <div class="info-footer"> 
        <div class="container">
            <div class="wrap-info">
                <div class="box-add">
                    <div class="thumb">
                        <img src="<?php echo esc_url(themesflat_get_opt('footer_info_image')) ?>" alt="images">
                    </div>
                    <div class="content">
                        <h6><?php echo themesflat_get_opt('footer_info_text'); ?></h6>
                        <p><?php echo themesflat_get_opt('footer_info_description'); ?></p>
                        <a href="<?php echo esc_url(themesflat_get_opt('footer_info_button_url')) ?>" class="tf-btn"><?php echo themesflat_get_opt('footer_info_button'); ?><span></span></a>
                    </div>
                </div>
                <div class="box-add">
                    <div class="thumb">
                        <img src="<?php echo esc_url(themesflat_get_opt('footer_info_image2')) ?>" alt="">
                    </div>
                    <div class="content">
                        <h6><?php echo themesflat_get_opt('footer_info_text2'); ?></h6>
                        <p><?php echo themesflat_get_opt('footer_info_description2'); ?></p>
                        <a href="<?php echo esc_url(themesflat_get_opt('footer_info_button_url2')) ?>" class="tf-btn"><?php echo themesflat_get_opt('footer_info_button2'); ?><span></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>