<?php 
$header_search_box = themesflat_get_opt('header_search_box');

$header_infor_phone = themesflat_get_opt('header_infor_phone');

$header_info_phone_text = themesflat_get_opt('header_info_phone_text');

$header_info_phone_number = themesflat_get_opt('header_info_phone_number');

$header_info_phone_icon = themesflat_get_opt('header_info_phone_icon');

$header_info_email_icon = themesflat_get_opt('header_info_email_icon');

$header_info_email_label = themesflat_get_opt('header_info_email_label');

$header_infor_phone_show_email = themesflat_get_opt('header_infor_phone_show_email');

$header_info_email = themesflat_get_opt('header_info_email');

$header_socials = themesflat_get_opt('header_socials');

$header_socials_label = themesflat_get_opt('header_socials_label');

$header_button = themesflat_get_opt('header_button');

$header_button_text = themesflat_get_opt('header_button_text');

$header_button_url = themesflat_get_opt('header_button_url');
?>
<header id="header" class="header header-default <?php echo themesflat_get_opt_elementor('extra_classes_header'); ?>">
    <div class="inner-header">  
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="header-wrap clearfix">
                        <div class="header-ct-left">
                            <?php get_template_part( 'tpl/header/brand'); ?>
                        </div>
                        <div class="header-ct-center">
                            <div class="inner-center">
                                <?php get_template_part( 'tpl/header/navigator'); ?>
                            </div>
                        </div>
                    <?php if( $header_search_box == 1 || $header_infor_phone == 1 || $header_socials == 1 || $header_button == 1): ?>
                        <div class="header-ct-right">
                        <?php if ( $header_search_box == 1 ) :?>
                                <div class="show-search">
                                    <a href="#"><i class="icon-dreamhome-search"></i></a> 
                                    <div class="submenu top-search widget_search">
                                        <?php get_search_form(); ?>
                                    </div>        
                                </div> 
                        <?php endif;?>
                        <?php if ( $header_socials == 1 ) :?>
                            <?php if ($header_socials_label != '') : ?>
                                <div class="social-header-2">
                                    <h6><?php echo esc_html($header_socials_label); ?></h6>
                                    <?php themesflat_render_social();   ?>
                                </div>
                            <?php else: ?>
                                <?php themesflat_render_social();   ?>
                            <?php endif;?>  
                        <?php endif;?>
                        <?php if ( themesflat_get_opt('header_login') == 1 ) :?>
                            <?php if (is_user_logged_in()): ?>
                                <?php if (class_exists('Widget_Login_Menu')): ?>
                                    <?php the_widget('Widget_Login_Menu'); ?>
                                <?php endif; ?>
                            <?php else: ?>
                            <div class="login-header">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                        <path d="M9.6237 18.5744H2.70286C2.65424 18.5744 2.60761 18.5551 2.57323 18.5207C2.53885 18.4863 2.51953 18.4397 2.51953 18.3911V17.0619C2.51953 16.3002 3.06311 15.6292 3.90095 15.059C5.39695 14.0378 7.81787 13.3943 10.5404 13.3943C10.9895 13.3943 11.4304 13.4127 11.8613 13.4466C11.9524 13.4558 12.0443 13.4466 12.1319 13.4198C12.2194 13.3929 12.3006 13.3489 12.3709 13.2902C12.4411 13.2315 12.499 13.1594 12.541 13.0781C12.583 12.9968 12.6083 12.9079 12.6155 12.8166C12.6227 12.7254 12.6117 12.6336 12.5829 12.5467C12.5542 12.4598 12.5084 12.3795 12.4482 12.3105C12.388 12.2416 12.3147 12.1853 12.2325 12.1451C12.1503 12.1048 12.0608 12.0814 11.9694 12.0762C11.494 12.038 11.0173 12.0191 10.5404 12.0193C7.4952 12.0193 4.79928 12.7811 3.12545 13.9223C1.84853 14.7932 1.14453 15.8996 1.14453 17.061V18.3911C1.14477 18.8042 1.30906 19.2003 1.60128 19.4924C1.8935 19.7844 2.28973 19.9485 2.70286 19.9485L9.6237 19.9494C9.80603 19.9494 9.9809 19.877 10.1098 19.748C10.2388 19.6191 10.3112 19.4442 10.3112 19.2619C10.3112 19.0796 10.2388 18.9047 10.1098 18.7758C9.9809 18.6468 9.80603 18.5744 9.6237 18.5744ZM10.5404 1.14583C7.75737 1.14583 5.4987 3.4045 5.4987 6.1875C5.4987 8.9705 7.75737 11.2292 10.5404 11.2292C13.3234 11.2292 15.582 8.9705 15.582 6.1875C15.582 3.4045 13.3234 1.14583 10.5404 1.14583ZM10.5404 2.52083C12.5644 2.52083 14.207 4.1635 14.207 6.1875C14.207 8.2115 12.5644 9.85416 10.5404 9.85416C8.51637 9.85416 6.8737 8.2115 6.8737 6.1875C6.8737 4.1635 8.51637 2.52083 10.5404 2.52083Z" fill="#1C1C1E"/>
                                        <path d="M16.6406 18.524C17.2605 18.618 17.8941 18.5515 18.481 18.3311C19.0678 18.1106 19.5884 17.7434 19.9931 17.2646C20.3978 16.7858 20.673 16.2112 20.7926 15.5958C20.9122 14.9804 20.8721 14.3446 20.6761 13.7491C20.4801 13.1536 20.1349 12.6182 19.6732 12.194C19.2116 11.7698 18.6489 11.471 18.039 11.326C17.429 11.1811 16.7921 11.1948 16.189 11.3659C15.5859 11.537 15.0367 11.8598 14.5937 12.3035C14.1873 12.7095 13.8821 13.2053 13.7026 13.751C13.5231 14.2967 13.4745 14.877 13.5606 15.4449L11.4321 17.5725C11.3682 17.6364 11.3174 17.7123 11.2828 17.7958C11.2482 17.8793 11.2304 17.9688 11.2305 18.0593V20.1667C11.2305 20.5462 11.5385 20.8542 11.918 20.8542H14.0254C14.1158 20.8542 14.2053 20.8364 14.2888 20.8018C14.3724 20.7672 14.4482 20.7165 14.5121 20.6525L16.6406 18.524ZM16.593 17.1123C16.4766 17.0813 16.3541 17.0814 16.2378 17.1127C16.1215 17.1439 16.0154 17.2051 15.9302 17.2902L13.7412 19.4792H12.6055V18.3434L14.7945 16.1544C14.8796 16.0692 14.9408 15.9631 14.972 15.8468C15.0032 15.7305 15.0033 15.608 14.9723 15.4917C14.8429 15.0042 14.8775 14.4878 15.071 14.022C15.2645 13.5563 15.6059 13.1672 16.0426 12.915C16.4793 12.6627 16.987 12.5613 17.4871 12.6264C17.9872 12.6915 18.4519 12.9195 18.8095 13.2752C19.1651 13.6327 19.3931 14.0975 19.4582 14.5976C19.5234 15.0977 19.4219 15.6053 19.1697 16.042C18.9174 16.4787 18.5284 16.8202 18.0626 17.0136C17.5969 17.2071 17.0804 17.2418 16.593 17.1123Z" fill="var(--theme-primary-color)"/>
                                        <path d="M16.4833 15.5998C16.3874 15.5083 16.3109 15.3984 16.2581 15.2768C16.2053 15.1552 16.1773 15.0243 16.1758 14.8917C16.1744 14.7592 16.1994 14.6276 16.2495 14.5049C16.2996 14.3822 16.3737 14.2707 16.4675 14.177C16.5614 14.0833 16.6729 14.0093 16.7957 13.9594C16.9186 13.9095 17.0501 13.8846 17.1827 13.8862C17.3152 13.8879 17.4461 13.916 17.5677 13.9689C17.6892 14.0219 17.7989 14.0986 17.8904 14.1946C18.0696 14.3826 18.1681 14.6333 18.1649 14.893C18.1617 15.1527 18.057 15.4009 17.8732 15.5845C17.6894 15.768 17.4411 15.8724 17.1814 15.8752C16.9216 15.8781 16.6711 15.7793 16.4833 15.5998Z" fill="var(--theme-primary-color)"/>
                                    </svg>
                                </div>
                                <ul>
                                    <li><span class="display-pop-login register"><?php esc_html_e('Register', 'dreamhome'); ?></span></li>
                                    <li><span class="display-pop-login login"><?php esc_html_e('Login', 'dreamhome'); ?></span></li>
                                </ul>
                            </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if ( $header_infor_phone == 1 ) :?>
                            <?php if ( $header_infor_phone_show_email == 1 ) :?>
                                <div class="phone-header-box email">
                                    <?php if ($header_info_email_icon != '') : ?>
                                        <div class="icon">
                                            <?php echo wp_kses($header_info_email_icon, themesflat_kses_allowed_html()); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="inner">
                                        <?php echo wp_kses($header_info_email_label, themesflat_kses_allowed_html()); ?>
                                        <h3><?php echo esc_html($header_info_email); ?></h3>
                                    </div>
                                </div>
                            <?php endif; ?>
                                <div class="phone-header-box phone">
                                    <?php if ($header_info_phone_icon != '') : ?>
                                        <div class="icon">
                                            <?php echo wp_kses($header_info_phone_icon, themesflat_kses_allowed_html()); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="inner">
                                        <?php echo wp_kses($header_info_phone_text, themesflat_kses_allowed_html()); ?>
                                        <h3><?php echo esc_html($header_info_phone_number); ?></h3>
                                    </div>
                                </div>
                        <?php endif; ?>
                        <?php if ( $header_button == 1 ) :?>
                            <a href="<?php echo get_permalink ( get_theme_mod ( 'header_button_url' )); ?>" class="tf-btn <?php if(!is_user_logged_in()) echo 'display-pop-login'; ?>"><?php echo wp_kses($header_button_text, themesflat_kses_allowed_html()); ?><span></span></a> 
                        <?php endif;?>
                                                          
                            </div>
                    <?php endif; ?>
                    <div class="btn-menu">
                        <span class="line-1"></span>
                    </div><!-- //mobile menu button -->
                    </div>                
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>

    <div class="canvas-nav-wrap">
        <div class="overlay-canvas-nav"><div class="canvas-menu-close"><span></span></div></div>
        <div class="inner-canvas-nav">
            <div class="group-header-logo">
                <?php get_template_part( 'tpl/header/brand-mobile'); ?>
                <div class="show-search">
                    <a href="#"><i class="icon-dreamhome-search"></i></a> 
                    <div class="submenu top-search widget_search">
                        <?php get_search_form(); ?>
                    </div>        
                </div> 
            </div>

            <div class="bottom-canvas-nav">
                <?php if ( themesflat_get_opt('header_login') == 1 ) :?>
                    <?php if (is_user_logged_in()): ?>
                        <?php if (class_exists('Widget_Login_Menu')): ?>
                            <?php the_widget('Widget_Login_Menu'); ?>
                        <?php endif; ?>
                        <?php else: ?>
                        <div class="login-header">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                    <path d="M9.6237 18.5744H2.70286C2.65424 18.5744 2.60761 18.5551 2.57323 18.5207C2.53885 18.4863 2.51953 18.4397 2.51953 18.3911V17.0619C2.51953 16.3002 3.06311 15.6292 3.90095 15.059C5.39695 14.0378 7.81787 13.3943 10.5404 13.3943C10.9895 13.3943 11.4304 13.4127 11.8613 13.4466C11.9524 13.4558 12.0443 13.4466 12.1319 13.4198C12.2194 13.3929 12.3006 13.3489 12.3709 13.2902C12.4411 13.2315 12.499 13.1594 12.541 13.0781C12.583 12.9968 12.6083 12.9079 12.6155 12.8166C12.6227 12.7254 12.6117 12.6336 12.5829 12.5467C12.5542 12.4598 12.5084 12.3795 12.4482 12.3105C12.388 12.2416 12.3147 12.1853 12.2325 12.1451C12.1503 12.1048 12.0608 12.0814 11.9694 12.0762C11.494 12.038 11.0173 12.0191 10.5404 12.0193C7.4952 12.0193 4.79928 12.7811 3.12545 13.9223C1.84853 14.7932 1.14453 15.8996 1.14453 17.061V18.3911C1.14477 18.8042 1.30906 19.2003 1.60128 19.4924C1.8935 19.7844 2.28973 19.9485 2.70286 19.9485L9.6237 19.9494C9.80603 19.9494 9.9809 19.877 10.1098 19.748C10.2388 19.6191 10.3112 19.4442 10.3112 19.2619C10.3112 19.0796 10.2388 18.9047 10.1098 18.7758C9.9809 18.6468 9.80603 18.5744 9.6237 18.5744ZM10.5404 1.14583C7.75737 1.14583 5.4987 3.4045 5.4987 6.1875C5.4987 8.9705 7.75737 11.2292 10.5404 11.2292C13.3234 11.2292 15.582 8.9705 15.582 6.1875C15.582 3.4045 13.3234 1.14583 10.5404 1.14583ZM10.5404 2.52083C12.5644 2.52083 14.207 4.1635 14.207 6.1875C14.207 8.2115 12.5644 9.85416 10.5404 9.85416C8.51637 9.85416 6.8737 8.2115 6.8737 6.1875C6.8737 4.1635 8.51637 2.52083 10.5404 2.52083Z" fill="#1C1C1E"/>
                                    <path d="M16.6406 18.524C17.2605 18.618 17.8941 18.5515 18.481 18.3311C19.0678 18.1106 19.5884 17.7434 19.9931 17.2646C20.3978 16.7858 20.673 16.2112 20.7926 15.5958C20.9122 14.9804 20.8721 14.3446 20.6761 13.7491C20.4801 13.1536 20.1349 12.6182 19.6732 12.194C19.2116 11.7698 18.6489 11.471 18.039 11.326C17.429 11.1811 16.7921 11.1948 16.189 11.3659C15.5859 11.537 15.0367 11.8598 14.5937 12.3035C14.1873 12.7095 13.8821 13.2053 13.7026 13.751C13.5231 14.2967 13.4745 14.877 13.5606 15.4449L11.4321 17.5725C11.3682 17.6364 11.3174 17.7123 11.2828 17.7958C11.2482 17.8793 11.2304 17.9688 11.2305 18.0593V20.1667C11.2305 20.5462 11.5385 20.8542 11.918 20.8542H14.0254C14.1158 20.8542 14.2053 20.8364 14.2888 20.8018C14.3724 20.7672 14.4482 20.7165 14.5121 20.6525L16.6406 18.524ZM16.593 17.1123C16.4766 17.0813 16.3541 17.0814 16.2378 17.1127C16.1215 17.1439 16.0154 17.2051 15.9302 17.2902L13.7412 19.4792H12.6055V18.3434L14.7945 16.1544C14.8796 16.0692 14.9408 15.9631 14.972 15.8468C15.0032 15.7305 15.0033 15.608 14.9723 15.4917C14.8429 15.0042 14.8775 14.4878 15.071 14.022C15.2645 13.5563 15.6059 13.1672 16.0426 12.915C16.4793 12.6627 16.987 12.5613 17.4871 12.6264C17.9872 12.6915 18.4519 12.9195 18.8095 13.2752C19.1651 13.6327 19.3931 14.0975 19.4582 14.5976C19.5234 15.0977 19.4219 15.6053 19.1697 16.042C18.9174 16.4787 18.5284 16.8202 18.0626 17.0136C17.5969 17.2071 17.0804 17.2418 16.593 17.1123Z" fill="var(--theme-primary-color)"/>
                                    <path d="M16.4833 15.5998C16.3874 15.5083 16.3109 15.3984 16.2581 15.2768C16.2053 15.1552 16.1773 15.0243 16.1758 14.8917C16.1744 14.7592 16.1994 14.6276 16.2495 14.5049C16.2996 14.3822 16.3737 14.2707 16.4675 14.177C16.5614 14.0833 16.6729 14.0093 16.7957 13.9594C16.9186 13.9095 17.0501 13.8846 17.1827 13.8862C17.3152 13.8879 17.4461 13.916 17.5677 13.9689C17.6892 14.0219 17.7989 14.0986 17.8904 14.1946C18.0696 14.3826 18.1681 14.6333 18.1649 14.893C18.1617 15.1527 18.057 15.4009 17.8732 15.5845C17.6894 15.768 17.4411 15.8724 17.1814 15.8752C16.9216 15.8781 16.6711 15.7793 16.4833 15.5998Z" fill="var(--theme-primary-color)"/>
                                </svg>
                            </div>
                            <ul>
                                <li><span class="display-pop-login register"><?php esc_html_e('Register', 'dreamhome'); ?></span></li>
                                <li><span class="display-pop-login login"><?php esc_html_e('Login', 'dreamhome'); ?></span></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>    
                <nav id="mainnav_canvas" class="mainnav_canvas" role="navigation">
                    <?php
                        wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb' => 'themesflat_menu_fallback', 'container' => false ) );
                    ?>
                </nav><!-- #mainnav_canvas -->
                <div class="wrap-btn-mobile">
                    <a href="<?php echo get_permalink ( get_theme_mod ( 'header_button_url' )); ?>" class="tf-btn <?php if(!is_user_logged_in()) echo 'display-pop-login'; ?>"><?php echo wp_kses($header_button_text, themesflat_kses_allowed_html()); ?><span></span></a> 
                </div>
                <div class="mobile-contact">
                    <h3><?php esc_html_e( 'Contact us', 'dreamhome' ); ?></h3>
                    <div class="phone-header-box phone">
                        <?php if ($header_info_phone_icon != '') : ?>
                            <div class="icon">
                                <?php echo wp_kses($header_info_phone_icon, themesflat_kses_allowed_html()); ?>
                            </div>
                        <?php endif; ?>
                        <div class="inner">
                            <?php echo wp_kses($header_info_phone_text, themesflat_kses_allowed_html()); ?>
                            <h3><?php echo esc_html($header_info_phone_number); ?></h3>
                        </div>
                    </div>
                    <div class="phone-header-box">
                        <?php if ($header_info_email_icon != '') : ?>
                            <div class="icon">
                                <?php echo wp_kses($header_info_email_icon, themesflat_kses_allowed_html()); ?>
                            </div>
                        <?php endif; ?>
                        <div class="inner">
                            <?php echo wp_kses($header_info_email_label, themesflat_kses_allowed_html()); ?>
                            <h3><?php echo esc_html($header_info_email); ?></h3>
                        </div>
                    </div>
                </div>            
            
            </div>


        </div>
    </div><!-- /.canvas-nav-wrap --> 
</header><!-- /.header --> 

