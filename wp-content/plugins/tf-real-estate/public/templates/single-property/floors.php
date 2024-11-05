<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post;
$property_meta_data          = get_post_custom( $post->ID );
$property_floors             = get_post_meta( $post->ID, 'floors_plan', true );
$property_floors_plan_toggle = get_post_meta( $post->ID, 'floors_plan_toggle', true );
$show_floor_plan = is_array( tfre_get_option( 'single_property_panels_manager' ) ) ? tfre_get_option( 'single_property_panels_manager' )['floors'] : false;
if ( $show_floor_plan == true ) :
	if ( is_array( $property_floors ) && count( $property_floors ) > 0 ) :
		wp_enqueue_script( 'bootstrap-tabcollapse' ); ?>
		<?php if ( $property_floors_plan_toggle != '0' ) : ?>
			<div id="nav-floors" class="single-property-element property-floors-tab property-tab border">
				<div class="tfre-property-floor">
					<div class="tfre-property-header">
						<h3><?php esc_html_e( 'Floor plans', 'tf-real-estate' ); ?></h3>
					</div>
					<div class="tfre-property-info">
						<?php $index = 0; ?>
						<div class="tfre-property-element">
							<ul id="tfre-floors-tabs" class="nav nav-tabs">
								<?php foreach ( $property_floors as $floor ) :
									$floor_size                   = isset( $floor['floor_size'] ) ? $floor['floor_size'] : '';
									$prop_enable_short_price_unit = tfre_get_option( 'enable_short_price_unit', 0 ) == 1 ? true : false;
									$floor_price                  = isset( $floor['floor_price'] ) ? $floor['floor_price'] : '';
									$floor_price_postfix          = isset( $floor['floor_price_postfix'] ) ? $floor['floor_price_postfix'] : '';
									$floor_bedrooms               = isset( $floor['floor_bedrooms'] ) ? $floor['floor_bedrooms'] : '';
									$floor_bathrooms              = isset( $floor['floor_bathrooms'] ) ? $floor['floor_bathrooms'] : '';
									$floor_description            = isset( $floor['floor_description'] ) ? $floor['floor_description'] : '';
									$gallery_id                   = 'tfre_floor-' . rand(); ?>
									<?php
									$nav_link_classes = array( 'nav-link d-flex justify-sb' );
									if ( $index === 0 ) {
										$nav_link_classes[] = 'active';
									}
									?>
									<li>
										<div class="row">
											<a class="<?php echo esc_attr( join( ' ', $nav_link_classes ) ) ?>" data-toggle="tab"
												href="#tfre-floor-<?php echo esc_attr( $index ); ?>">
												<div class="title-tab">
													<?php echo esc_html( ! empty( $floor['floor_name'] ) ? esc_html( $floor['floor_name'] ) : ( esc_html__( 'Floor', 'tf-real-estate' ) . ' ' . ( $index + 1 ) ) ) ?>
												</div>
												<div class="meta-floor d-flex">
													<?php if ( ! empty( $floor_price ) ) : ?>
														<div class="content-property-info-price d-flex group-inner ">
															<i class="icon-dreamhome-sale"></i>
															<span
																class="property-info-title"><?php echo esc_html_e( 'Price:', 'tf-real-estate' ); ?></span>
															<span
																class="property-info-value"><?php echo esc_html( tfre_format_price( $floor_price, $floor_price_postfix, true, $prop_enable_short_price_unit ) ); ?></span>
														</div>
													<?php endif; ?>
													<?php if ( ! empty( $floor_size ) ) : ?>
														<div class="content-property-info-size d-flex group-inner ">
															<i class="icon-dreamhome-size1"></i>
															<span
																class="property-info-title"><?php echo esc_html_e( 'Size:', 'tf-real-estate' ); ?></span>
															<span
																class="property-info-value"><?php echo wp_kses_post( tfre_get_format_number( intval( $floor_size ) ) ) ?>
																<span><?php $measurement_units = tfre_get_option_measurement_units();
																echo wp_kses( $measurement_units , array('sup' => array()) ); ?></span></span>
														</div>
													<?php endif; ?>
													<?php if ( ! empty( $floor_bedrooms ) ) : ?>
														<div class="content-property-info-beds d-flex group-inner ">
															<i class="icon-dreamhome-bed"></i>
															<span
																class="property-info-title"><?php echo esc_html_e( 'Beds:', 'tf-real-estate' ); ?></span>
															<span
																class="property-info-value"><?php echo esc_html( $floor_bedrooms ) ?></span>
														</div>
													<?php endif; ?>
													<?php if ( ! empty( $floor_bathrooms ) ) : ?>
														<div class="content-property-info-baths d-flex group-inner ">
															<i class="icon-dreamhome-bath1"></i>
															<span
																class="property-info-title"><?php echo esc_html_e( 'Baths:', 'tf-real-estate' ); ?></span>
															<span
																class="property-info-value"><?php echo esc_html( $floor_bathrooms ) ?></span>
														</div>
													<?php endif; ?>
												</div>
											</a>
										</div>
									</li>
									<?php $index++; ?>
								<?php endforeach; ?>
							</ul>
							<div class="tab-content">
								<?php $index = 0; ?>
								<?php foreach ( $property_floors as $floor ) :
									$image_src = isset($floor['floor_image']) ? wp_get_attachment_image_url( $floor['floor_image'], 'full' ) : '';
									?>
									<div id="tfre-floor-<?php echo esc_attr( $index ) ?>"
										class="tab-pane fade <?php if ( $index === 0 ) : ?>show active<?php endif; ?>">
										<?php if ( ! empty( $image_src ) ) : ?>
											<div class="floor-image tfre-light-gallery mg-bottom-20">
												<img loading="lazy" src="<?php echo esc_url( $image_src ); ?>"
													alt="<?php the_title_attribute(); ?>">
												<a data-thumb-src="<?php echo esc_url( $image_src ); ?>"
													data-gallery-id="<?php echo esc_attr( $gallery_id ); ?>" data-rel="tfre_light_gallery"
													href="<?php echo esc_url( $image_src ); ?>" class="zoomGallery"><i
														class="fa fa-expand"></i></a>
											</div>
										<?php endif; ?>
									</div>
									<?php $index++; ?>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					jQuery(document).ready(function ($) {
						$('#tfre-floors-tabs').tabCollapse();
					});
				</script>
			</div>
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>