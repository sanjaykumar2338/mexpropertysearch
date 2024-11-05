<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
get_header();
?>
<div class="container">
    <div class="row">
        <div class="<?php echo esc_attr(themesflat_get_opt( 'agent_layout' ) == 'agent-sidebar-right' ? 'col-md-8' : 'col-md-12'); ?>">
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <?php while (have_posts()) :
                        the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                        <div class="entry-content">
                            <?php do_action('tfre_single_agent_summary'); ?>
                        </div>
                    </article>
                    <?php endwhile;?>
                </main>
            </div>
        </div>
        <?php 
            if ( themesflat_get_opt( 'agent_layout' ) == 'agent-sidebar-right') : ?>
                <div class="col-md-4">
                   <?php themesflat_dynamic_sidebar('themesflat-custom-sidebar-propertysidebar'); ?>
                </div>
        <?php  endif;?>
    </div>
</div>

<?php get_footer(); ?>