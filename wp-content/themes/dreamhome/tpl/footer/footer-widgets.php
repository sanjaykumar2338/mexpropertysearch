<?php
$tab_footer = themesflat_get_opt('tab_footer');
if (themesflat_get_opt('show_footer') == 1):     
?> 
    <footer id="footer" class="footer <?php (themesflat_meta( 'footer_class' ) != "" ? esc_attr( themesflat_meta( 'footer_class' ) ):'') ;?>">
        <div class="footer-widgets <?php echo esc_attr($tab_footer == 1 ? 'menu-tab-footer' : '');  ?>">
            <div class="container">                
                <div class="row">
                    <div class="col-lg-3 col-md-6 widgets-areas areas-1">
                        <div class="wrap-widgets wrap-widgets-1">
                            <?php if ( is_active_sidebar('footer-1') ) {
                                dynamic_sidebar('footer-1');       
                            } else {
                                echo'<a class="widgets-fallback" href="' . esc_url(admin_url('widgets.php')) . '">' . esc_html__( 'Please Add Items in Widget Area 1', 'dreamhome' ) . '</a>';
                            } ?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 widgets-areas areas-2">
                        <div class="wrap-widgets wrap-widgets-2">
                            <?php if ( is_active_sidebar('footer-2') ) {
                                dynamic_sidebar('footer-2');       
                            } else {
                                echo'<a class="widgets-fallback" href="' . esc_url(admin_url('widgets.php')) . '">' . esc_html__( 'Please Add Items in Widget Area 2', 'dreamhome' ) . '</a>';
                            } ?>
                        </div>
                    </div> 
                    <div class="col-lg-3 col-md-6 widgets-areas areas-3">
                        <div class="wrap-widgets wrap-widgets-3">
                            <?php if ( is_active_sidebar('footer-3') ) {
                                dynamic_sidebar('footer-3');       
                            } else {
                                echo'<a class="widgets-fallback" href="' . esc_url(admin_url('widgets.php')) . '">' . esc_html__( 'Please Add Items in Widget Area 3', 'dreamhome' ) . '</a>';
                            } ?>
                        </div>
                    </div> 
                    <div class="col-lg-3 col-md-6 widgets-areas areas-4">
                        <div class="wrap-widgets wrap-widgets-4">
                            <?php if ( is_active_sidebar('footer-4') ) {
                                dynamic_sidebar('footer-4');       
                            } else {
                                echo'<a class="widgets-fallback" href="' . esc_url(admin_url('widgets.php')) . '">' . esc_html__( 'Please Add Items in Widget Area 4', 'dreamhome' ) . '</a>';
                            } ?>
                        </div>
                    </div>       
                </div><!-- /.row -->                  
            </div><!-- /.container --> 
        </div><!-- /.footer-widgets -->
    </footer>
<?php endif; ?>
