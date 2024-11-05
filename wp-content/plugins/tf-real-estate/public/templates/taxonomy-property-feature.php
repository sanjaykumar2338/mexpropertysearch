<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$map_position = tfre_get_option('map_position');
if ($map_position == 'map-header' || $map_position == 'hide-map') {
    tfre_get_template_with_arguments('archive-property.php');
} else {
    tfre_get_template_with_arguments('archive-property-half-map.php');
}
?>