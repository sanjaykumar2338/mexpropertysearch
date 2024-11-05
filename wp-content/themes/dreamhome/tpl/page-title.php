<?php 
if ( is_page() && is_page_template( 'tpl/front-page.php' ) ) {
    return;
}

$titles = themesflat_get_page_titles();    
ob_start();
if ( $titles['title'] ) { printf( '%s', wp_kses_post($titles['title']) ); }
$title = ob_get_clean();

?>
<!-- Page title -->
<?php
$page_title_styles = themesflat_get_opt('page_title_styles');
$page_title_alignment = themesflat_get_opt('page_title_alignment');
?>
<header class="page-header">
    <div class="page-title <?php echo esc_attr($page_title_styles); ?> <?php echo esc_attr($page_title_alignment); ?> <?php echo themesflat_get_opt_elementor('extra_classes_pagetitle'); ?>">

        <div class="overlay"></div>
        <div class="container"> 
            <div class="row">
                <div class="page-title-container">
                <?php 
                    if ( themesflat_get_opt( 'breadcrumb_enabled' ) == 1 ):
                        themesflat_breadcrumb();
                    endif;                       
                ?> 
                <?php                 
                    if ( themesflat_get_opt('page_title_heading_enabled') == 1 ) {
                        echo sprintf('<h1 class="page-title-heading">%s</h1>', $title); 
                    }  
                ?>
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->  
        </div><!-- /.container -->                     
    </div><!-- /.page-title --> 
</header><!-- /.page-header -->
