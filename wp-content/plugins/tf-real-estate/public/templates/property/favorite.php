<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
global $current_user;
wp_get_current_user();
$check_is_favorite          = false;
$user_id      = $current_user->ID;
$my_favorites = get_user_meta($user_id, 'favorites_property', true);

$property_id = get_the_ID();
if (!empty($my_favorites)) {
	$check_is_favorite = array_search($property_id, $my_favorites);
}
$title_not_favorite = $title_favorited = '';
$icon_favorite     = apply_filters('tfre_icon_favorite', 'far fa-bookmark');
$icon_not_favorite = apply_filters('tfre_icon_not_favorite', 'far fa-bookmark');

if ($check_is_favorite !== false) {
	$css_class = $icon_favorite;
	$title     = esc_attr__('It is your favorite', 'tf-real-estate');
} else {
	$css_class = $icon_not_favorite;
	$title     = esc_attr__('Add to Favorite', 'tf-real-estate');
}
?>
<a href="javascript:void(0)" class="tfre-property-favorite hv-tool <?php esc_attr_e($check_is_favorite !== false ? 'active' : ''); ?>" 
	data-tfre-data-property-id="<?php echo esc_attr(intval($property_id)) ?>" data-toggle="tooltip"
	data-tooltip="<?php echo esc_attr($title) ?>"
	data-tfre-data-title-not-favorite="<?php esc_attr_e('Add to Favorite', 'tf-real-estate') ?>"
	data-tfre-data-title-favorited="<?php esc_attr_e('It is your favorite', 'tf-real-estate'); ?>"
	data-tfre-data-icon-not-favorite="<?php echo esc_attr($icon_not_favorite) ?>"
	data-tfre-data-icon-favorited="<?php echo esc_attr($icon_favorite) ?>"><i
		class="<?php echo esc_attr($css_class); ?>" aria-hidden="true"></i></a>