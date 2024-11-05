<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
wp_enqueue_style( 'agency-style' );

global $post;
$agency_term          = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$property_status      = tfre_get_categories( 'property-status' );
$listing_property_url = tfre_get_permalink( 'my_properties_page' );
$args_agent           = array(
	'post_type'   => 'agent',
	'post_status' => 'publish',
	'tax_query'   => array(
		'relation' => 'OR',
		array(
			'taxonomy' => 'agencies',
			'field'    => 'slug',
			'terms'    => $agency_term->slug,
			'operator' => 'IN'
		),
	),
);
$agent_data           = new WP_Query( $args_agent );

$agent_id_arr = array();

if ( $agent_data->have_posts() ) {
	while ( $agent_data->have_posts() ) :
		$agent_data->the_post();
		$agent_id       = get_the_ID();
		$agent_id_arr[] = $agent_id;
	endwhile;
	wp_reset_postdata();
	$agent_id_arr = array_unique( $agent_id_arr );
	$agent_id_arr = join( ',', $agent_id_arr );
}

if ( empty( $agent_id_arr ) ) {
	$agent_id_arr = '-1';
}
// Get Property of Agency
function get_list_property_by_status( $status, $agent_id_arr ) {
	$posts_per_page = tfre_get_option('item_properties_per_page_single_agency', '4');
	$args = array(
		'post_type'   => 'real-estate',
		'post_status' => 'publish',
		'posts_per_page' => $posts_per_page,
		'meta_query'  => array(
			array(
				'key'     => 'property_agent_info',
				'value'   => $agent_id_arr,
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
				$properties   = get_list_property_by_status( $term->slug, $agent_id_arr );
				$active_class = $index === 0 ? 'active' : '';
				echo '<div class="agent-tab-title property-status-tab ' . esc_attr( $active_class ) . '" data-tab-value="' . esc_attr( $term->slug ) . '">' . $term->name . '</div>';
			}
			?>
		</div>
		<div class="agent-tab-content" id="tabContent">
			<?php
			foreach ( $property_status as $index => $term ) {
				$active_class = $index === 0 ? 'active' : '';
				$properties   = get_list_property_by_status( $term->slug, $agent_id_arr );
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
					esc_html_e( 'No properties found', 'tf-real-estate' );
				}
				echo '</div></div></div></div>';
			}
			?>
		</div>
	</div>
</div>
<?php
tfre_get_template_with_arguments( 'global/property-quick-view-modal.php', array() );