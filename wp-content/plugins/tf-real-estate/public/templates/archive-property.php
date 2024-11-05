<?php
/**
 * @var $attrs
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
get_header();
$property_public = new Property_Public();
$list_order = array(
	'default' => esc_html__('Default sorting', 'tf-real-estate'),
	'featured' => esc_html__('Sort by featured First', 'tf-real-estate'),
	'latest' => esc_html__('Sort by latest', 'tf-real-estate'),
	'price' => esc_html__('Sort by price: low to high', 'tf-real-estate'),
	'price-desc' => esc_html__('Sort by price: high to low', 'tf-real-estate')
);
$order_by = isset($_GET['orderBy']) ? sanitize_text_field(wp_unslash($_GET['orderBy'])) : '';
$status_default = '';
$value_status = isset($_GET['status']) ? (wp_unslash($_GET['status'])) : $status_default;
$value_keyword = isset($_GET['keyword']) ? (wp_unslash($_GET['keyword'])) : '';
$value_title = isset($_GET['title']) ? (wp_unslash($_GET['title'])) : '';
$value_address = isset($_GET['address']) ? (wp_unslash($_GET['address'])) : '';
$value_type = isset($_GET['type']) ? (wp_unslash($_GET['type'])) : '';
$value_bathrooms = isset($_GET['bathrooms']) ? (wp_unslash($_GET['bathrooms'])) : '';
$value_rooms = isset($_GET['rooms']) ? (wp_unslash($_GET['rooms'])) : '';
$value_bedrooms = isset($_GET['bedrooms']) ? (wp_unslash($_GET['bedrooms'])) : '';
$value_min_price = isset($_GET['min-price']) ? (wp_unslash($_GET['min-price'])) : '';
$value_max_price = isset($_GET['max-price']) ? (wp_unslash($_GET['max-price'])) : '';
$value_min_size = isset($_GET['min-size']) ? (wp_unslash($_GET['min-size'])) : '';
$value_max_size = isset($_GET['max-size']) ? (wp_unslash($_GET['max-size'])) : '';
$value_min_land_size = isset($_GET['min-land-size']) ? (wp_unslash($_GET['min-land-size'])) : '';
$value_max_land_size = isset($_GET['max-land-size']) ? (wp_unslash($_GET['max-land-size'])) : '';
$value_state = isset($_GET['state']) ? (wp_unslash($_GET['state'])) : '';
$value_country = isset($_GET['country']) ? (wp_unslash($_GET['country'])) : '';
$value_neighborhood = isset($_GET['neighborhood']) ? (wp_unslash($_GET['neighborhood'])) : '';
$value_label = isset($_GET['label']) ? (wp_unslash($_GET['label'])) : '';
$value_garage = isset($_GET['garage']) ? (wp_unslash($_GET['garage'])) : '';
$value_min_garage_size = isset($_GET['min-garage-size']) ? (wp_unslash($_GET['min-garage-size'])) : '';
$value_max_garage_size = isset($_GET['max-garage-size']) ? (wp_unslash($_GET['max-garage-size'])) : '';
$enable_search_features = isset($_GET['enable-search-features']) ? (wp_unslash($_GET['enable-search-features'])) : '0';
$value_features = isset($_GET['features']) ? (wp_unslash($_GET['features'])) : '';

if (!empty($value_features)) {
	$value_features = explode(',', $value_features);
}
$style_layout = $style_layout_column = $layout = $color_scheme = '';
$options = array(
	'ajax_url' => esc_url(TF_AJAX_URL),
);
$wrapper_class = 'tfre-property-advanced-search clearfix';
$wrapper_classes = array(
	$wrapper_class,
	$layout,
	$color_scheme,
);

$layout_archive_property = tfre_get_option('layout_archive_property');
if ($layout_archive_property == 'grid') {
	$style_layout = tfre_get_option('item_style_layout_grid');
	$style_layout_column = tfre_get_option('column_layout_grid');
} else {
	$style_layout = tfre_get_option('item_style_layout_list');
	$style_layout_column = tfre_get_option('column_layout_list');
}

$css_class_col = 'col-md-2 col-sm-3 col-xs-12';

if ($layout_archive_property == 'list') {
	$css_class_col = 'col-sm-12';
}

if ($layout_archive_property == 'grid') {
	switch (tfre_get_option('column_layout_grid')) {
		case '2':
			$css_class_col = 'col-md-6';
			break;
		case '3':
			$css_class_col = 'col-md-4';
			break;
		case '4':
			$css_class_col = 'col-xl-3 col-md-6';
			break;
		default:
			# code...
			break;
	}
}

$item_per_page_archive_property = tfre_get_option('item_per_page_archive_property', '10');
$args = array(
	'posts_per_page' => $item_per_page_archive_property,
	'post_type' => 'real-estate',
	'orderby' => array(
		'menu_order' => 'ASC',
		'date' => 'DESC',
	),
	'offset' => (max(1, get_query_var('paged')) - 1) * $item_per_page_archive_property,
	'ignore_sticky_posts' => 1,
	'post_status' => 'publish',
);

$metabox_query = $taxonomy_query = array();
$parameters = $keyword_array = '';

// set query keyword field
if ($value_keyword !== '') {
	$keyword_field = tfre_get_option('search_criteria_keyword_field', 'criteria_address');
	if ($keyword_field === 'criteria_address') {
		$keyword_array = array(
			'relation' => 'OR',
			array(
				'key' => 'property_address',
				'value' => $value_keyword,
				'type' => 'CHAR',
				'compare' => 'LIKE',
			),
			array(
				'key' => 'property_zip',
				'value' => $value_keyword,
				'type' => 'CHAR',
				'compare' => 'LIKE',
			),
			array(
				'key' => 'property_identity',
				'value' => $value_keyword,
				'type' => 'CHAR',
				'compare' => '=',
			)
		);
		$args['p'] = $value_keyword;
	} else if ($keyword_field === 'criteria_state') {
		$tax_location[] = sanitize_title($value_keyword);
		$tax_query = array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'province-state',
				'field' => 'slug',
				'terms' => $tax_location
			),
			array(
				'taxonomy' => 'neighborhood',
				'field' => 'slug',
				'terms' => $tax_location
			)
		);

		$taxonomy_query[] = $tax_query;
	} else {
		$args['s'] = $value_keyword;
	}
	$parameters .= sprintf(__('Keyword: <strong>%s</strong> | ', 'tf-real-estate'), $value_keyword);
}
// set query Title field
if (!empty($value_title)) {
	$args['s'] = $value_title;
	$parameters .= sprintf(__('Title: <strong>%s</strong> | ', 'tf-real-estate'), $value_title);
}
// set query taxonomy type field
if (isset($value_type) && !empty($value_type)) {
	$taxonomy_query[] = array(
		'taxonomy' => 'property-type',
		'field' => 'slug',
		'terms' => $value_type
	);
	$parameters .= sprintf(__('Type: <strong>%s</strong> | ', 'tf-real-estate'), $value_type);
}
// set query taxonomy status field
if (isset($value_status) && !empty($value_status)) {
	$taxonomy_query[] = array(
		'taxonomy' => 'property-status',
		'field' => 'slug',
		'terms' => $value_status
	);
	$parameters .= sprintf(__('Status: <strong>%s</strong> | ', 'tf-real-estate'), $value_status);
}
// set query taxonomy label field
if (isset($value_label) && !empty($value_label)) {
	$taxonomy_query[] = array(
		'taxonomy' => 'property-label',
		'field' => 'slug',
		'terms' => $value_label
	);
	$parameters .= sprintf(__('Label: <strong>%s</strong> | ', 'tf-real-estate'), $value_label);
}
// set query taxonomy features field
if (!empty($value_features)) {
	$taxonomy_query[] = array(
		'taxonomy' => 'property-feature',
		'field' => 'slug',
		'terms' => $value_features
	);
	foreach ($value_features as $feature) {
		$parameters .= sprintf(__('Feature: <strong>%s</strong> | ', 'tf-real-estate'), $feature);
	}
}
// set query meta box country field
if (!empty($value_country)) {
	$metabox_query[] = array(
		'key' => 'property_country',
		'value' => $value_country,
		'type' => 'CHAR',
		'compare' => 'LIKE',
	);
	$parameters .= sprintf(__('Country: <strong>%s</strong> | ', 'tf-real-estate'), $value_country);
}
// set query taxonomy province/state field
if (!empty($value_state)) {
	$taxonomy_query[] = array(
		'taxonomy' => 'province-state',
		'field' => 'slug',
		'terms' => $value_state
	);
	$parameters .= sprintf(__('Province/State: <strong>%s</strong> | ', 'tf-real-estate'), $value_state);
}
// set query taxonomy neighborhood field
if (!empty($value_neighborhood)) {
	$taxonomy_query[] = array(
		'taxonomy' => 'neighborhood',
		'field' => 'slug',
		'terms' => $value_neighborhood
	);
	$parameters .= sprintf(__('Neighborhood: <strong>%s</strong> | ', 'tf-real-estate'), $value_neighborhood);
}
// set query meta box Address field
if (!empty($value_address)) {
	$metabox_query[] = array(
		'key' => 'property_address',
		'value' => $value_address,
		'type' => 'CHAR',
		'compare' => 'LIKE',
	);
	$parameters .= sprintf(__('Address: <strong>%s</strong> | ', 'tf-real-estate'), $value_address);
}
// set query meta box room field
if (!empty($value_rooms)) {
	$value_rooms = sanitize_text_field($value_rooms);
	$metabox_query[] = array(
		'key' => 'property_rooms',
		'value' => $value_rooms,
		'type' => 'CHAR',
		'compare' => '=',
	);
	$parameters .= sprintf(__('Rooms: <strong>%s</strong> | ', 'ts-real-estate'), $value_rooms);
}
// set query meta box bathroom field
if (!empty($value_bathrooms)) {
	$value_bathrooms = sanitize_text_field($value_bathrooms);
	$metabox_query[] = array(
		'key' => 'property_bathrooms',
		'value' => $value_bathrooms,
		'type' => 'CHAR',
		'compare' => '=',
	);
	$parameters .= sprintf(__('Bathrooms: <strong>%s</strong> | ', 'tf-real-estate'), $value_bathrooms);
}
// set query meta box bedroom field
if (!empty($value_bedrooms)) {
	$value_bedrooms = sanitize_text_field($value_bedrooms);
	$metabox_query[] = array(
		'key' => 'property_bedrooms',
		'value' => $value_bedrooms,
		'type' => 'CHAR',
		'compare' => '=',
	);
	$parameters .= sprintf(__('Bedrooms: <strong>%s</strong> | ', 'tf-real-estate'), $value_bedrooms);
}
// set query meta box price field
if (!empty($value_max_price) && !empty($value_min_price)) {
	$max_price = doubleval(tfre_clean_doubleval($value_max_price));
	$min_price = doubleval(tfre_clean_doubleval($value_min_price));

	if ($min_price >= 0 && $max_price >= $min_price) {
		$metabox_query[] = array(
			'key' => 'property_price_value_multiplication_unit',
			'value' => array($min_price, $max_price),
			'type' => 'NUMERIC',
			'compare' => 'BETWEEN'
		);
		$parameters .= sprintf(__('Price: <strong>%s - %s</strong> |', 'tf-real-estate'), $min_price, $max_price);
	}
} else if (!empty($max_price)) {
	$max_price = doubleval(tfre_clean_doubleval($value_max_price));
	if ($max_price >= 0) {
		$metabox_query[] = array(
			'key' => 'property_price_value_multiplication_unit',
			'value' => $max_price,
			'type' => 'NUMERIC',
			'compare' => '<='
		);
		$parameters .= sprintf(__('Max Price: <strong>%s</strong> |', 'tf-real-estate'), $max_price);
	}
} else if (!empty($min_price)) {
	$min_price = doubleval(tfre_clean_doubleval($value_min_price));
	if ($min_price >= 0) {
		$metabox_query[] = array(
			'key' => 'property_price_value_multiplication_unit',
			'value' => $min_price,
			'type' => 'NUMERIC',
			'compare' => '>='
		);
		$parameters .= sprintf(__('Min Price: <strong>%s</strong> |', 'tf-real-estate'), $min_price);
	}
}
// set query meta box size field
if (!empty($value_max_size) && !empty($value_min_size)) {
	$min_size = intval($value_min_size);
	$max_size = intval($value_max_size);
	if ($min_size >= 0 && $max_size >= $min_size) {
		$metabox_query[] = array(
			'key' => 'property_size',
			'value' => array($min_size, $max_size),
			'type' => 'NUMERIC',
			'compare' => 'BETWEEN'
		);
		$parameters .= sprintf(__('Size: <strong>%s - %s</strong> |', 'tf-real-estate'), $min_size, $max_size);
	}
} else if (!empty($value_max_size)) {
	$max_size = intval($value_max_size);
	if ($max_size >= 0) {
		$metabox_query[] = array(
			'key' => 'property_size',
			'value' => $max_size,
			'type' => 'NUMERIC',
			'compare' => '<='
		);
		$parameters .= sprintf(__('Max Size: <strong>%s</strong> |', 'tf-real-estate'), $max_size);
	}
} else if (!empty($value_min_size)) {
	$min_size = intval($value_min_size);
	if ($min_size >= 0) {
		$metabox_query[] = array(
			'key' => 'property_size',
			'value' => $min_size,
			'type' => 'NUMERIC',
			'compare' => '>='
		);
		$parameters .= sprintf(__('Min Size: <strong>%s</strong>', 'tf-real-estate'), $min_size);
	}
}
// set query meta box land size field
if (!empty($value_max_land_size) && !empty($value_min_land_size)) {
	$max_land_size = intval($value_max_land_size);
	$min_land_size = intval($value_min_land_size);
	if ($min_land_size >= 0 && $max_land_size >= $max_land_size) {
		$metabox_query[] = array(
			'key' => 'property_land',
			'value' => array($min_land_size, $max_land_size),
			'type' => 'NUMERIC',
			'compare' => 'BETWEEN'
		);
		$parameters .= sprintf(__('Land Area: <strong>%s - %s</strong>', 'tf-real-estate'), $min_land_size, $max_land_size);
	}
} else if (!empty($value_max_land_size)) {
	$max_land_size = intval($value_max_land_size);
	if ($max_land_size >= 0) {
		$metabox_query[] = array(
			'key' => 'property_land',
			'value' => $max_land_size,
			'type' => 'NUMERIC',
			'compare' => '<='
		);
		$parameters .= sprintf(__('Max Land Area: <strong>%s</strong>', 'tf-real-estate'), $max_land_size);
	}
} else if (!empty($value_min_land_size)) {
	$min_land_size = intval($value_min_land_size);
	if ($min_land_size >= 0) {
		$metabox_query[] = array(
			'key' => 'property_land',
			'value' => $min_land_size,
			'type' => 'NUMERIC',
			'compare' => '>=',
		);
		$parameters .= sprintf(__('Min Land Area: <strong>%s</strong>', 'tf-real-estate'), $min_land_size);
	}
}
// set query meta box garage size field
if (!empty($value_min_garage_size) && !empty($value_max_garage_size)) {
	$min_garage_size = intval($value_min_garage_size);
	$max_garage_size = intval($value_max_garage_size);
	if ($min_garage_size >= 0 && $max_garage_size >= $min_garage_size) {
		$metabox_query[] = array(
			'key' => 'property_garage_size',
			'value' => array($min_garage_size, $max_garage_size),
			'type' => 'NUMERIC',
			'compare' => 'BETWEEN',
		);
		$parameters .= sprintf(__('Garage Size: <strong>%s - %s</strong>', 'tf-real-estate'), $min_garage_size, $max_garage_size);
	}
} else if (!empty($value_max_garage_size)) {
	$max_garage_size = intval($value_max_garage_size);
	if ($max_garage_size >= 0) {
		$metabox_query[] = array(
			'key' => 'property_garage_size',
			'value' => $max_garage_size,
			'type' => 'NUMERIC',
			'compare' => '<='
		);
		$parameters .= sprintf(__('Max Garage Size: <strong>%s</strong>', 'tf-real-estate'), $max_garage_size);
	}
} else if (!empty($value_min_garage_size)) {
	$min_garage_size = intval($value_min_garage_size);
	if ($min_garage_size >= 0) {
		$metabox_query[] = array(
			'key' => 'property_garage_size',
			'value' => $min_garage_size,
			'type' => 'NUMERIC',
			'compare' => '>='
		);
		$parameters .= sprintf(__('Min Garage Size: <strong>%s</strong>', 'tf-real-estate'), $min_garage_size);
	}
}

// set query orderby
if (in_array($order_by, array('default', 'featured', 'price', 'price-desc', 'latest'))) {
	switch ($order_by) {
		case 'featured':
			$args['meta_key'] = 'property_featured';
			$args['orderby'] = 'meta_value';
			$args['order'] = 'DESC';
			break;
		case 'latest':
			$args['orderby'] = 'date';
			$args['order'] = 'DESC';
			break;
		case 'price':
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = 'property_price_value';
			$args['order'] = 'ASC';
			break;
		case 'price-desc':
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = 'property_price_value';
			$args['order'] = 'DESC';
			break;
		default:
			$args['orderby'] = 'date';
			$args['order'] = 'ASC';
	}
}

if (is_tax()) {
	$current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
	$taxonomy_name = get_query_var('taxonomy');
	if (!empty($taxonomy_name)) {
		$taxonomy_query[] = array(
			'taxonomy' => $taxonomy_name,
			'field' => 'slug',
			'terms' => $current_term->slug
		);
	}
}

$taxonomy_count = count($taxonomy_query);
if ($taxonomy_count > 0) {
	$args['tax_query'] = array(
		'relation' => 'AND',
		$taxonomy_query
	);
}

$metabox_count = count($metabox_query);
if ($metabox_count > 0) {
	$args['meta_query'] = array(
		'relation' => 'AND',
		$keyword_array,
		array(
			'relation' => 'AND',
			$metabox_query
		)
	);
}
$results = new WP_Query($args);
$total_post = $results->found_posts;
?>
<?php if (tfre_get_option('map_position') != 'hide-map'): ?>
	<div class="map-container <?php echo esc_attr(tfre_get_option('hide_map_mobile') == 'y' ? 'hide-map-mobile' : ''); ?>"
		style="height:600px">
		<div id="map" class="no-fixed"></div>
	</div>
<?php endif; ?>

<?php tfre_get_option('archive_property_sidebar') !== 'enable' && tfre_get_option('archive_property_search_form') == 'enable' && do_action('property_advanced_search_form'); ?>

<div class="tfre_message"></div>
<div
	class="cards-container row <?php echo esc_attr(tfre_get_option('map_position')); ?> <?php echo esc_attr(tfre_get_option('archive_property_sidebar') == 'enable' ? 'has-sidebar' : 'no-sidebar'); ?> <?php echo esc_attr(tfre_get_option('archive_property_sidebar_position')); ?>">
	<div
		class="<?php echo esc_attr(tfre_get_option('archive_property_sidebar') == 'enable' ? 'col-xl-9 col-md-12' : 'col-md-12') ?> properties-list-wrap">
		<form method="get" action="<?php echo esc_url(get_page_link()); ?>" class="tfre-my-property-search">
			<input type="hidden" name="layout_archive_property" id="layout_archive_property"
				value="<?php echo esc_attr($layout_archive_property); ?>">
			<input type="hidden" name="column_layout" id="column_layout"
				value="<?php echo esc_attr($layout_archive_property == 'grid' ? $column_layout_grid : $column_layout_list); ?>">
			<div class="row">
				<div class="col-lg-6">
					<h2><?php esc_html_e('Property listing', 'tf-real-estate'); ?></h2>
					<p class="count-results">
						<?php echo sprintf(esc_html__('There are currently', 'tf-real-estate') . ' <span class="count-result count-total">%d</span> <span class="text-result">%s</span>', $total_post, tfre_get_number_text($total_post, esc_html__('results', 'tf-real-estate'), esc_html__('result', 'tf-real-estate'))); ?>
					</p>
				</div>
				<div class="col-lg-6 toolbar-search-list">
					<div class="form-group">
						<a class="btn btn-display-properties-grid"
							data-style-layout="<?php echo esc_attr(tfre_get_option('item_style_layout_grid')); ?>"
							data-style-layout-column="<?php echo esc_attr(tfre_get_option('column_layout_grid')); ?>"><i
								class="far fa-th"></i></a>
					</div>
					<div class="form-group">
						<a class="btn btn-display-properties-list"
							data-style-layout="<?php echo esc_attr(tfre_get_option('item_style_layout_list')); ?>"
							data-style-layout-column="<?php echo esc_attr(tfre_get_option('column_layout_list')); ?>"><i
								class="far fa-list-ul"></i></a>
					</div>
					<div class="form-group">
						<select name="sortby" id="property_order_by" class="form-control"
							title="<?php esc_attr_e('Sort By', 'tf-real-estate') ?>">
							<?php foreach ($list_order as $key => $order): ?>
								<option value="<?php echo esc_attr($property_public->tfre_get_link_order_property($key)) ?>"
									<?php selected($key, $order_by); ?>>
									<?php printf(__($order, 'tf-real-estate')); ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
		</form>
		<div class="tf-properties-wrap <?php echo esc_attr($style_layout); ?>">
			<div class="wrap-properties-post <?php echo esc_attr($style_layout_column); ?>">
				<div class="group-card-item-property properties row">
					<?php if ($results->have_posts()):
						while ($results->have_posts()):
							$results->the_post();
							$property_id = get_the_ID();
							$attach_id = get_post_thumbnail_id();
							$class_image_map = 'tfre-image-map';
							tfre_get_template_with_arguments(
								'property/card-item-property/' . $layout_archive_property . '/' . $style_layout . '.php',
								array(
									'property_id' => $property_id,
									'attach_id' => $attach_id,
									'class_image_map' => $class_image_map,
									'css_class_col' => $css_class_col
								)
							);
							?>
						<?php endwhile;
					else: ?>
						<div class="properties-empty"><p class="item-not-found"><?php esc_html_e('Not found any properties based on your filter', 'tf-real-estate'); ?></p><p class="item-another"> <?php esc_html_e('Try another filter, location or keywords', 'tf-real-estate'); ?> </p><a href="javascript:void(0)" id="btn-clear-all" class="btn-clear-all"><?php esc_html_e('Reset Filters', 'tf-real-estate'); ?></a></div>
					<?php endif; ?>
				</div>
			</div>
			<div class="overlay-filter-tab" style="display: none;">
				<div class="filter-loader"></div>
			</div>
			<div class="pagination-wrap"><?php tfre_pagination_ajax($results); ?></div>
		</div>
	</div>
	<?php if (tfre_get_option('archive_property_sidebar') == 'enable'): ?>
		<div class="col-xl-3 col-md-12">
			<div class="tfre_sidebar">
				<?php if (is_active_sidebar('archive-properties-sidebar')) { ?>
					<?php dynamic_sidebar('archive-properties-sidebar'); ?>
				<?php } ?>
			</div>
		</div>
	<?php endif; ?>
</div>
<?php
wp_reset_postdata();
get_footer();
tfre_get_template_with_arguments('global/property-quick-view-modal.php', array());