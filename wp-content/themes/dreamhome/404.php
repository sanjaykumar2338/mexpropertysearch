<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package dreamhome
 */

get_header(); ?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div id="primary" class="fullwidth-404">
					<main id="main" class="site-main" role="main">
						<section class="error-404 not-found">
							<div class="error-box-404 vertical-center">
								<div class="error-box text-center">
									<div class="thumb-404">
										<img src="<?php echo THEMESFLAT_LINK . 'images/404.webp'; ?>" alt="404">
									</div>
									<div class="error-404-text">
										<h1><?php esc_html_e( 'Oh no... We lost this page', 'dreamhome' ); ?></h1>
										<p><?php esc_html_e( 'We searched everywhere but couldn’t find what you’re looking for. Let’s find a better place for you to go.', 'dreamhome' ); ?></p>
									</div>
									
									<div class="wrap-button-404">
										<a href="<?php echo esc_url( home_url('/') ); ?>" class="button"><?php esc_html_e( 'Back to home','dreamhome' ) ?></a>
									</div>
								</div>
							</div>
						</section><!-- .error-404 -->
					</main><!-- #main -->
				</div><!-- #primary -->
			</div><!-- /.col-md-12 -->
		</div><!-- /.row -->
	</div>

<?php get_footer(); ?>