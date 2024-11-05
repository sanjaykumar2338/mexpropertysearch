<?php
$logo_site = themesflat_get_opt('site_logo');
if (!empty(themesflat_get_opt_elementor('site_logo'))) {
    if (themesflat_get_opt_elementor('site_logo')['url'] != '') {
        $logo_site = themesflat_get_opt_elementor('site_logo')['url'];
    }else {
        $logo_site = themesflat_get_opt('site_logo');
    }    
}
if ( $logo_site ) : ?>
    <div id="logo" class="logo" >                  
        <a href="<?php echo esc_url( home_url('/') ); ?>"  title="<?php bloginfo('name'); ?>">
            <?php if  (!empty($logo_site)) { ?>
                <img class="site-logo"  src="<?php echo esc_url($logo_site); ?>" alt="<?php bloginfo('name'); ?>"/>
            <?php } ?>
        </a>
    </div>
<?php else : ?>
    <div id="logo" class="logo">
    	<h5 class="site-title"><a href="<?php echo esc_url( home_url('/') ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h5>			
    </div><!-- /.site-infomation -->          
<?php endif; ?>