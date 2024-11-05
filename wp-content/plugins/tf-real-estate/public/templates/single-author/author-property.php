<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
wp_enqueue_style( 'agent-style' );
$property_status  = tfre_get_categories( 'property-status' );
$author_id        = get_the_author_meta( 'ID' );
$author_meta_data = get_user_meta( $author_id );
$agent_id         = isset( $author_meta_data['author_agent_id'] ) ? $author_meta_data['author_agent_id'][0] : '';
function get_list_property_by_status( $status, $agent_id ) {
	$posts_per_page = tfre_get_option('item_properties_per_page_single_agent', '4');
	$args       = array(
		'post_type'   => 'real-estate',
		'post_status' => 'publish',
		'posts_per_page' => $posts_per_page,
		'meta_query'  => array(
			array(
				'key'     => 'property_agent_info',
				'value'   => $agent_id,
				'compare' => 'IN',
			),
		),
		'tax_query'   => array(
			array(
				'taxonomy' => 'property-status',
				'field'    => 'slug',
				'terms'    => $status
			),
		),
	);
	$properties = new WP_Query( $args );
	return $properties;
}
$style_layout            = $style_layout_column = '';
$layout_archive_property = tfre_get_option( 'layout_archive_property' );
if ( $layout_archive_property == 'grid' ) {
	$style_layout        = tfre_get_option( 'item_style_layout_grid' );
	$style_layout_column = 'column-2';
} else {
	$style_layout        = tfre_get_option( 'item_style_layout_list' );
	$style_layout_column = 'column-1';
}
?>

<div class="single-agent-element agent-single">
	<div class="single-agent-property agent-tabs">
		<div class="agent-tab-titles">
			<?php
			foreach ( $property_status as $index => $term ) {
				$properties   = get_list_property_by_status( $term->slug, $agent_id );
				$active_class = $index === 0 ? 'active' : '';
				echo '<div class="agent-tab-title property-status-tab ' . esc_attr( $active_class ) . '" data-tab-value="' . esc_attr( $term->slug ) . '">' . esc_html( $term->name ) . '</div>';
			}
			?>
		</div>
		<div class="agent-tab-content" id="tabContent">
			<?php
			foreach ( $property_status as $index => $term ) {
				$active_class = $index === 0 ? 'active' : '';
				$properties   = get_list_property_by_status( $term->slug, $agent_id );
				echo '<div class="agent-tab agent-property-tab ' . esc_attr( $active_class ) . '" id="' . esc_attr( $term->slug ) . '"><div class="tf-properties-wrap ' . esc_attr( $style_layout ) . '"><div class="wrap-properties-post ' . esc_attr( $style_layout_column ) . '"><div class="properties row">';
				if ( $properties->have_posts() ) {
					while ( $properties->have_posts() ) {
						$properties->the_post();
						$property_id = get_the_ID();
						$attach_id   = get_post_thumbnail_id();
						tfre_get_template_with_arguments(
							'property/card-item-property/' . $layout_archive_property . '/' . $style_layout . '.php',
							array(
								'property_id'     => $property_id,
								'attach_id'       => $attach_id,
								'class_image_map' => '',
								'css_class_col'   => '',
							)
						);
					}
					wp_reset_postdata();
				} else {
					echo esc_html_e( 'No properties found', 'tf-real-estate' );
				}
				echo '</div></div></div></div>';
			}
			?>
		</div>
	</div>
	<div class="single-agent-all-listing row">
		<div class="col-md-12">
			<div class="button-wrap">
				<a class="button tfre_listing_property_button" href="">
					<?php esc_html_e( 'View all my properties', 'tf-real-estate' ); ?>
					<i class="icon-dreamhome-right-arrow"></i>
				</a>
			</div>
		</div>
	</div>
</div>
<?php
tfre_get_template_with_arguments( 'global/property-quick-view-modal.php', array() );