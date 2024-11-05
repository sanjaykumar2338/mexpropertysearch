<?php

/**
 * The template loader functionality of the plugin.
 */
if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Template_Loader')) {
    class Template_Loader
    {
        private static $_instance;

        public static function get_instance() {
            if (self::$_instance == null) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        public function __construct() {}

        function is_real_estate_taxonomy() {
            return is_tax(get_object_taxonomies('real-estate'));
        }

        function is_agent_taxonomy() {
            return is_tax(get_object_taxonomies('agent'));
        }

        public function template_loader($template) {
            $file     = '';
            $file_arr = array();

            if (is_embed()) {
                return $template;
            }

            if (is_single()) {
                if (get_post_type() == 'real-estate') {
                    $file = 'single-property.php';
                }
                if (get_post_type() == 'agent') {
                    $file = 'single-agent.php';
                }
                $file_arr[] = $file;
                $file_arr[] = TF_PLUGIN_PATH . '/public/templates/' . $file;
            } else if ($this->is_real_estate_taxonomy()) {
                $term = get_queried_object();
                if (is_tax('property-type') || is_tax('property-status') || is_tax('property-feature') || is_tax('property-label') || is_tax('province-state') || is_tax('neighborhood')) {
                    $file = 'taxonomy-' . $term->taxonomy . '.php';
                } else {
                    $file = 'archive-property.php';
                }
                $file_arr[] = 'taxonomy-' . $term->taxonomy . '-' . $term->slug . '.php';
                $file_arr[] = TF_PLUGIN_PATH . '/public/templates/' . 'taxonomy-' . $term->taxonomy . '-' . $term->slug . '.php';
                $file_arr[] = 'taxonomy-' . $term->taxonomy . '.php';
                $file_arr[] = TF_PLUGIN_PATH . '/public/templates/' . 'taxonomy-' . $term->taxonomy . '.php';
                $file_arr[] = $file;
                $file_arr[] = TF_PLUGIN_PATH . '/public/templates/' . $file;
            } else if ($this->is_agent_taxonomy()) {
                $term = get_queried_object();
                $file = is_tax('agencies') ? 'taxonomy-' . $term->taxonomy . '.php' : 'archive-agent.php';
                $file_arr[] = 'taxonomy-' . $term->taxonomy . '-' . $term->slug . '.php';
                $file_arr[] = TF_PLUGIN_PATH . '/public/templates/' . 'taxonomy-' . $term->taxonomy . '-' . $term->slug . '.php';
                $file_arr[] = 'taxonomy-' . $term->taxonomy . '.php';
                $file_arr[] = TF_PLUGIN_PATH . '/public/templates/' . 'taxonomy-' . $term->taxonomy . '.php';
                $file_arr[] = $file;
                $file_arr[] = TF_PLUGIN_PATH . '/public/templates/' . $file;
            } else if (is_post_type_archive('real-estate') || is_page('properties')) {
                $map_position = tfre_get_option('map_position');
                $file         = ($map_position == 'map-header' || $map_position == 'hide-map') ? 'archive-property.php' : 'archive-property-half-map.php';
                $file_arr[]   = $file;
                $file_arr[]   = TF_PLUGIN_PATH . '/public/templates/' . $file;
            } else if (is_post_type_archive('agent') || is_page('agents')) {
                $file       = 'archive-agent.php';
                $file_arr[] = $file;
                $file_arr[] = TF_PLUGIN_PATH . '/public/templates/' . $file;
            } else if (is_author()) {
                $file       = 'author.php';
                $file_arr[] = $file;
                $file_arr[] = TF_PLUGIN_PATH . '/public/templates/' . $file;
            }

            if ($file) {
                $template = locate_template(array_unique($file_arr));
                if (!$template) {
                    $template = TF_PLUGIN_PATH . '/public/templates/' . $file;
                }
            }
            return $template;
        }
    }
}