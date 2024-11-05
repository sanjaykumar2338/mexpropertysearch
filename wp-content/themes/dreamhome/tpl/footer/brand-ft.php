<?php
$logo_site = themesflat_get_opt('site_logo_ft');

if ( $logo_site ) : ?>
    <div class="content-left">
        <div id="logo-footer" >                  
            <a href="<?php echo esc_url( home_url('/') ); ?>"  title="<?php bloginfo('name'); ?>">
                <?php if  (!empty($logo_site)) { ?>
                    <img class="site-logo"  src="<?php echo esc_url($logo_site); ?>" alt="<?php bloginfo('name'); ?>"/>
                <?php } ?>
            </a>
        </div>
    </div>
<?php else : ?>
    <div class="content-left">
        <div id="logo-footer">
            <h6 class="site-title"><a href="<?php echo esc_url( home_url('/') ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h6>			
            <p class="site-description"><?php bloginfo( 'description' ); ?></p>	
        </div><!-- /.site-infomation -->          
    </div>
<?php endif; ?>