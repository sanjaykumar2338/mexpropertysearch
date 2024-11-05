<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('Agent_Public')) {
    class Agent_Public
    {
        public function tfre_enqueue_agent_scripts() {
            wp_enqueue_script('agency-script', TF_PLUGIN_URL . 'public/assets/js/agency.js', array( 'jquery' ), null, true);
            wp_localize_script(
                'agency-script',
                'agency_variables',
				array(
					'plugin_url'           => TF_PLUGIN_URL,
					'map_service'          => tfre_get_option( 'map_service' ),
					'api_key_google_map'   => tfre_get_option( 'google_map_api_key' ),
					'api_key_map_box'      => tfre_get_option( 'map_box_api_key' ),
					'map_box_style'        => tfre_get_option( 'map_box_style' ),
					'map_zoom'             => tfre_get_option( 'map_zoom' ),
					'default_marker_image' => tfre_get_option( 'default_marker_image' )['url'] != '' ? tfre_get_option( 'default_marker_image' )['url'] : '',
					'marker_image_width'   => tfre_get_option( 'marker_image_width' ) != '' ? tfre_get_option( 'marker_image_width' ) : '90px',
					'marker_image_height'  => tfre_get_option( 'marker_image_height' ) != '' ? tfre_get_option( 'marker_image_height' ) : '119px',
				)
            );
            wp_enqueue_script('agent-script', TF_PLUGIN_URL . 'public/assets/js/agent.js', array( 'jquery' ), null, true);
            wp_localize_script(
                'agent-script',
                'agent_variables',
                array(
                    'listing_property_url' => tfre_get_permalink('my_properties_page'),
                    'alert_not_found'      => esc_html__('My listing Not Found!', 'tf-real-estate')
                )
            );
        }

        public function tfre_enqueue_agent_styles() {
            wp_register_style('agent-style', TF_PLUGIN_URL . 'public/assets/css/agent.css', array(), '', 'all');
            wp_register_style('agency-style', TF_PLUGIN_URL . 'public/assets/css/agency.css', array(), '', 'all');
        }

        public function tfre_taxonomy_agency_detail() {
            tfre_get_template_with_arguments('agency/agency-info.php');
        }

        public function tfre_taxonomy_agency_property() {
            tfre_get_template_with_arguments('agency/agency-property.php');
        }

        public function tfre_single_agent_info() {
            tfre_get_template_with_arguments('single-agent/agent-info.php');
        }

        public function tfre_single_agent_property() {
            tfre_get_template_with_arguments('single-agent/agent-property.php');
        }

        public function tfre_single_author_info(){
            tfre_get_template_with_arguments('single-author/author-info.php');
        }

        public function tfre_single_author_property(){
            tfre_get_template_with_arguments('single-author/author-property.php');
        }

        public function tfre_listing_agent() {
            $list_post_status     = array( 'publish' );
            $selected_post_status = $selected_order = $view = $agent_search = '';
            $posts_per_page = tfre_get_option('item_per_page_archive_agent', '10');

            $list_order = array(
                'default'   => esc_html__('Default sorting', 'tf-real-estate'),
                'name_desc' => esc_html__('Sort by name (A-Z)', 'tf-real-estate'),
                'name_asc'  => esc_html__('Sort by name (Z-A)', 'tf-real-estate'),
            );

            $args = array(
                'post_type'      => 'agent',
                'post_status'    => $list_post_status,
                'posts_per_page' => $posts_per_page,
                'offset'         => (max(1, get_query_var('paged')) - 1) * $posts_per_page,
                'orderby'        => 'date',
                'order'          => 'desc',
                's'              => $agent_search,
            );

            if (!empty($_REQUEST['post_status']) && $_REQUEST['post_status'] != 'default') {
                $selected_post_status = wp_unslash($_REQUEST['post_status']);
                $args['post_status']  = $selected_post_status;
            } else {
                $args['post_status'] = $list_post_status;
            }

            if (!empty($_REQUEST['view'])) {
                $view = wp_unslash($_REQUEST['view']);
            }

            if (!empty($_REQUEST['agent_search'])) {
                $agent_search       = wp_unslash($_REQUEST['agent_search']);
                $args['s'] = $agent_search;
            }

            if (!empty($_REQUEST['agent_name'])) {
                $value_agent = isset($_REQUEST['agent_name']) ? (wp_unslash($_REQUEST['agent_name'])) : '';
                $args['s']   = $value_agent;
            }

            if (!empty($_REQUEST['agency'])) {
                $value_agency      = isset($_REQUEST['agency']) ? (wp_unslash($_REQUEST['agency'])) : '';
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'agencies',
                        'field'    => 'slug',
                        'terms'    => $value_agency
                    ),
                );
            }

            if (!empty($_REQUEST['orderBy'])) {
                $selected_order = wp_unslash($_REQUEST['orderBy']);
                switch ($selected_order) {
                    case 'name_asc':
                        $args['orderby'] = 'name';
                        $args['order'] = 'asc';
                        break;
                    default:
                        $args['orderby'] = 'name';
                        $args['order'] = 'desc';
                }
            }

            $agents      = new WP_Query($args);
            $total_pages = $agents->max_num_pages;

            ob_start();
            tfre_get_template_with_arguments(
                'agent/list-agent.php',
                array(
                    'agents'           => $agents->posts,
                    'list_post_status' => $list_post_status,
                    'list_order'       => $list_order,
                    'selected_order'   => $selected_order,
                    'view'             => $view,
                    'max_num_pages'    => $total_pages,
                    'agent_search'     => $agent_search
                )
            );
            return ob_get_clean();
        }

        public function tfre_listing_agency() {
            $list_post_status = array( 'publish' );
            $taxonomy_name    = 'agencies';
            $selected_order   = $view = $agency_search = '';
            $posts_per_page = tfre_get_option('item_per_page_agency_listing', '10');
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
            $list_order  = array(
                'default'   => esc_html__('Default sorting', 'tf-real-estate'),
                'name_desc' => esc_html__('Sort by name (A-Z)', 'tf-real-estate'),
                'name_asc'  => esc_html__('Sort by name (Z-A)', 'tf-real-estate'),
            );
            $args           = array(
                'taxonomy'   => $taxonomy_name,
                'hide_empty' => false,
                'number'     => $posts_per_page,
                'offset'     => ($paged - 1) * $posts_per_page,
            );

            if (!empty($_REQUEST['orderBy'])) {
                $selected_order = wp_unslash($_REQUEST['orderBy']);
                switch ($selected_order) {
                    case 'name_asc':
                        $args['orderby'] = 'name';
                        $args['order'] = 'asc';
                        break;
                    default:
                        $args['orderby'] = 'name';
                        $args['order'] = 'desc';
                }
            }
            if (!empty($_REQUEST['view'])) {
                $view = wp_unslash($_REQUEST['view']);
            }
            if (!empty($_REQUEST['agency_name'])) {
                $agency_search      = wp_unslash($_REQUEST['agency_name']);
                $args['name__like'] = $agency_search;
            }
            
            $terms       = get_terms($args);
            $total_terms = !empty($_REQUEST['agency_name']) ? count($terms) : wp_count_terms($taxonomy_name);
            $total_pages = ceil($total_terms / $posts_per_page);
            ob_start();
            tfre_get_template_with_arguments(
                'agency/list-agency.php',
                array(
                    'terms'            => $terms,
                    'list_post_status' => $list_post_status,
                    'list_order'       => $list_order,
                    'selected_order'   => $selected_order,
                    'view'             => $view,
                    'max_num_pages'    => $total_pages,
                    'agency_search'    => $agency_search
                )
            );
            return ob_get_clean();
        }
    }
}