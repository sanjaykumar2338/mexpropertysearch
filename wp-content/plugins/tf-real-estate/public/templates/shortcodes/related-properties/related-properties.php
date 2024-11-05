<?php
/**
 * @var $current_property_id
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
wp_enqueue_script( 'related-properties' );

$property_type         = get_the_terms( $current_property_id, 'property-type' );
$property_status       = get_the_terms( $current_property_id, 'property-status' );
$property_label        = get_the_terms( $current_property_id, 'property-label' );
$property_features     = get_the_terms( $current_property_id, 'property-feature' );
$property_state        = get_the_terms( $current_property_id, 'province-state' );
$property_neighborhood = get_the_terms( $current_property_id, 'neighborhood' );

// Options related properties
$heading             = tfre_get_option( 'heading_related_properties', 'Featured properties' );
$description         = tfre_get_option( 'description_related_properties', 'Explore all the different types of properties so you can choose the best option for you.' );
$related_by_taxonomy = tfre_get_option( 'related_by_taxonomy', 'property-type' );
$item_per_page       = tfre_get_option( 'item_per_page_related_properties', 6 );
$loop                = tfre_get_option( 'enable_loop_related_properties', 0 ) == 1 ? true : false;
$auto_loop           = tfre_get_option( 'enable_auto_loop_related_properties', 0 ) == 1 ? true : false;
$arrow               = tfre_get_option( 'enable_arrow_related_properties', 0 ) == 1 ? true : false;
$bullets             = tfre_get_option( 'enable_bullets_related_properties' ) == 1 ? true : false;
$spacing             = tfre_get_option( 'spacing_related_properties', 30 );
$prev_icon           = tfre_get_option( 'carousel_prev_icon_related_properties', 'far fa-arrow-left' );
$next_icon           = tfre_get_option( 'carousel_next_icon_related_properties', 'far fa-arrow-right' );
$column_desk         = tfre_get_option( 'carousel_column_desk_related_properties', 3 );
$column_laptop       = tfre_get_option( 'carousel_column_laptop_related_properties', 3 );
$column_tablet       = tfre_get_option( 'carousel_column_tablet_related_properties', 2 );
$column_mobile       = tfre_get_option( 'carousel_column_mobile_related_properties', 1 );

$args           = array(
	'posts_per_page'      => $item_per_page,
	'post__not_in'        => array( $current_property_id ),
	'post_type'           => 'real-estate',
	'orderby'             => array(
		'date' => 'DESC',
	),
	'offset'              => ( max( 1, get_query_var( 'paged' ) ) - 1 ) * $item_per_page,
	'ignore_sticky_posts' => 1,
	'post_status'         => 'publish',
);
$taxonomy_query = array();

function get_array_terms_value( $array_terms ) {
	if ( ! is_array( $array_terms ) )
		return;

	$array_terms_value = array();
	foreach ( $array_terms as $term ) {
		array_push( $array_terms_value, $term->slug );
	}
	return $array_terms_value;
}

switch ( $related_by_taxonomy ) {
	case 'property-type':
		$taxonomy_query[] = array(
			'taxonomy' => 'property-type',
			'field'    => 'slug',
			'terms'    => get_array_terms_value( $property_type )
		);
		break;
	case 'property-status':
		$taxonomy_query[] = array(
			'taxonomy' => 'property-status',
			'field'    => 'slug',
			'terms'    => get_array_terms_value( $property_status )
		);
		break;
	case 'property-label':
		$taxonomy_query[] = array(
			'taxonomy' => 'property-label',
			'field'    => 'slug',
			'terms'    => get_array_terms_value( $property_label )
		);
		break;
	case 'property-feature':
		$taxonomy_query[] = array(
			'taxonomy' => 'property-feature',
			'field'    => 'slug',
			'terms'    => get_array_terms_value( $property_features )
		);
		break;
	case 'province-state':
		$taxonomy_query[] = array(
			'taxonomy' => 'province-state',
			'field'    => 'slug',
			'terms'    => get_array_terms_value( $property_state )
		);
		break;
	case 'neighborhood':
		$taxonomy_query[] = array(
			'taxonomy' => 'neighborhood',
			'field'    => 'slug',
			'terms'    => get_array_terms_value( $property_neighborhood )
		);
		break;
	default:
		# code...
		break;
}

$style_layout = $style_layout_column = $rtl_carousel = '';
if ( is_rtl() ) {
	$rtl_carousel = 'yes';
}

$layout_archive_property = 'grid';
$style_layout_column     = 'column-1';
$style_layout = tfre_get_option( 'item_style_layout_grid' );

$args['tax_query'] = array(
	'relation' => 'AND',
	$taxonomy_query
);
$query             = new WP_Query( $args );
?>
<div class="related-properties row">
	<h2 class="heading"><?php esc_html_e( $heading, 'tf-real-estate' ); ?></h2>
	<div class="description">
		<p><?php esc_html_e( $description, 'tf-real-estate' ); ?></p>
	</div>
	<div class="tf-properties-wrap <?php echo esc_attr( $style_layout ); ?>">
		<div class="wrap-properties-post <?php echo esc_attr( $style_layout_column ); ?>">
			<div class="properties row">
				<div class="owl-carousel" data-loop="<?php echo esc_attr( $loop ); ?>"
					data-auto="<?php echo esc_attr( $auto_loop ); ?>"
					data-desk="<?php echo esc_attr( $column_desk ); ?>"
					data-laptop="<?php echo esc_attr( $column_laptop ); ?>"
					data-tablet="<?php echo esc_attr( $column_tablet ); ?>"
					data-mobile="<?php echo esc_attr( $column_mobile ); ?>"
					data-arrow="<?php echo esc_attr( $arrow ) ?>" data-prev_icon="<?php echo esc_attr( $prev_icon ) ?>"
					data-next_icon="<?php echo esc_attr( $next_icon ) ?>"
					data-spacing="<?php echo esc_attr( $spacing ) ?>" data-bullets="<?php echo esc_attr( $bullets ) ?>"
					data-rtl="<?php echo esc_attr( $rtl_carousel ) ?>">
					<?php if ( $query->have_posts() ) :
						while ( $query->have_posts() ) :
							$query->the_post();
							$property_id     = get_the_ID();
							$attach_id       = get_post_thumbnail_id();
							$class_image_map = 'tfre-image-map';
							$css_class_col   = 'col-sm-12';
							tfre_get_template_with_arguments(
								'property/card-item-property/' . $layout_archive_property . '/' . $style_layout . '.php',
								array(
									'property_id'     => $property_id,
									'attach_id'       => $attach_id,
									'class_image_map' => $class_image_map,
									'css_class_col'   => $css_class_col
								)
							);
							?>
						<?php endwhile; ?>
					<?php else : ?>
						<div class="item-not-found"><?php esc_html_e( 'No item found', 'tf-real-estate' ); ?></div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
tfre_get_template_with_arguments( 'global/property-quick-view-modal.php', array() );