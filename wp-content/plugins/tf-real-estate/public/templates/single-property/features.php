<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post;
$property_id        = get_the_ID();
$property_meta_data = get_post_custom( $property_id );
$property_features  = get_the_terms( $property_id, 'property-feature' );
$show_features      = is_array( tfre_get_option( 'single_property_panels_manager' ) ) ? tfre_get_option( 'single_property_panels_manager' )['features'] : false;
?>
<?php if ( $show_features == true ) :
	if ( $property_features ) : ?>
		<div id="nav-features" class="single-property-element property-info-detail border">
			<div class="tfre-property-overview">
				<div class="tfre-property-header">
					<h3><?php echo esc_html__( 'Features', 'tf-real-estate' ); ?></h3>
				</div>
				<div class="tfre-property-info">
					<div id="tfre-features" class="">
						<?php
						$features_terms_id = array();
						if ( ! is_wp_error( $property_features ) ) {
							foreach ( $property_features as $feature ) {
								$features_terms_id[] = intval( $feature->term_id );
							}
						}
						$all_features  = get_categories(
							array(
								'taxonomy'   => 'property-feature',
								'hide_empty' => 0,
								'orderby'    => 'term_id',
								'order'      => 'ASC',
							)
						);
						$parents_items = $child_items = array();
						if ( $all_features && $features_terms_id ) {
							foreach ( $all_features as $term ) {
								if ( 0 == $term->parent && in_array( $term->term_id, $features_terms_id ) )
									$parents_items[] = $term;
								if ( $term->parent && in_array( $term->term_id, $features_terms_id ) )
									$child_items[] = $term;
							}
							;
							if ( count( $child_items ) > 0 ) {
								foreach ( $parents_items as $parents_item ) {
									echo '<h4>' . esc_html( $parents_item->name ) . '</h4>';
									echo '<div class="row mg-bottom-30">';
									foreach ( $child_items as $child_item ) {
										if ( $child_item->parent == $parents_item->term_id ) {
											if ( in_array( $child_item->term_id, $features_terms_id ) ) {
												echo '<div class="col-xl-3 col-md-4 col-6 property-feature-wrap"><i class="icon-dreamhome-check-box"></i>' . esc_html( $child_item->name ) . '</div>';
											} else {
												echo '<div class="col-xl-3 col-md-4 col-6 property-feature-wrap"><i class="icon-dreamhome-check-box"></i>' . esc_html( $child_item->name ) . '</div>';
											}
										}
										;
									}
									;
									echo '</div>';
								}
								;
							} else {
								echo '<div class="row">';
								foreach ( $parents_items as $parents_item ) {
									$term_link = get_term_link( $parents_item, 'property-feature' );

									if ( in_array( $parents_item->term_id, $features_terms_id ) ) {
										echo '<div class="col-xl-3 col-md-4 col-6 property-feature-wrap"><i class="icon-dreamhome-check-box"></i>' . esc_html( $parents_item->name ) . '</div>';
									} else {
										echo '<div class="col-xl-3 col-md-4 col-6 property-feature-wrap"><i class="icon-dreamhome-check-box"></i>' . esc_html( $parents_item->name ) . '</div>';
									}
								}
								;
								echo '</div>';
							}
							;
						}
						;
						?>
					</div>
				</div>
			</div>
		</div>
	<?php endif;
endif; ?>