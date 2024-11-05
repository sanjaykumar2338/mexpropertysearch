<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header();
$style_single = get_post_meta( get_the_ID(), 'gallery_image_type', true );
$panels       = tfre_get_option( 'single_property_panels_manager' );
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content style-<?php echo esc_attr( themesflat_get_opt( 'property_style_gallery' ) ); ?>">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="header-gallery-style-grid">
									<?php do_action( 'tfre_single_property_summary_header' ); ?>
								</div>
							</div>
						</div>
					</div>
					<div class="tfre-property-gallery-single">
						<?php do_action( 'tfre_single_property_summary_gallery' ); ?>
					</div>
					<?php if ( $style_single == 'single-style-2' ) : ?>
						<div class="property-navigation">
							<div class="container-fluid">
								<div class="row">
									<div class="col-md-12">
										<div class="property-navigation-item">
											<ul class="navigation-item">
												<?php foreach ( $panels as $key => $value ) { ?>
													<?php if ( $panels[ $key ] == 1 && $key != 'gallery' ) :
														$key_name = str_replace( "-", " ", $key );
														?>
														<li> <a href="#nav-<?php echo esc_attr( $key ); ?>"
																class="item-nav"><?php echo $key_name; ?></a> </li>
													<?php endif; ?>
												<?php } ?>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endif; ?>
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="header-gallery-style-slider">
									<?php do_action( 'tfre_single_property_summary_header' ); ?>
								</div>
							</div>
							<div
								class="<?php echo esc_attr( $style_single != 'single-style-2' ? 'col-md-8' : 'col-md-12' ); ?>">
								<?php foreach ( $panels as $key => $value ) { ?>
									<?php if ( $panels[ $key ] == 1 && $key != 'gallery' && $key != 'review' ) : ?>
										<?php
										$key = str_replace( 'virtual-360', 'video-virtual', $key );
										$key = str_replace( 'video', 'video-virtual', $key );
										$key = str_replace( 'file-attachment', 'attachments', $key );
										tfre_get_template_with_arguments( 'single-property/' . $key . '.php' ); ?>
									<?php endif; ?>
								<?php } ?>
								<?php do_action( 'tfre_single_review' ); ?>
							</div>
							<?php if ( $style_single != 'single-style-2' ) : ?>
								<div class="col-md-4">
									<div class="tfre_single_sidebar">
										<?php themesflat_dynamic_sidebar( 'themesflat-custom-sidebar-propertysidebar' ); ?>
									</div>
								</div>
							<?php endif; ?>
							<div class="col-md-12 related-single-property">
								<?php echo do_shortcode( '[related_properties current_property_id="' . get_the_ID() . '"]' ); ?>
							</div>
						</div>
					</div>
				</div>
			</article>
			<?php
		endwhile;
		?>
	</main>
</div>
<?php get_footer(); ?>