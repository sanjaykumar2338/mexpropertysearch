<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Admin_Custom_Post_Type' ) ) {
	class Admin_Custom_Post_Type {
		/**
		 * Define list custom post type
		 */
		function tfre_get_list_custom_post_type() {
			$custom_post_types = array();

			$custom_url_properties 	= tfre_get_option( 'custom_url_properties', 'real-estate' );
			$custom_url_agent 	   	= tfre_get_option( 'custom_url_agent', 'agent' );
			$package_enable = tfre_get_option( 'enable_package') == 'n' ? false : true;

			$custom_post_types['real-estate'] = array(
				'name'                => __( 'Real Estate', 'tf-real-estate' ),
				'singular_name'       => __( 'Real Estate', 'tf-real-estate' ),
				'description'         => __( 'Holds our custom article post specific data', 'tf-real-estate' ),
				'public'              => true,
				'publicly_queryable'  => true,
				'slug_post_type'  	  => $custom_url_properties,
				'menu_position'       => 2,
				'has_archive'         => true,
				'hierarchical'        => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'query_var'           => true,
				'menu_icon'           => 'dashicons-building',
				'can_export'          => true,
				'map_meta_cap'        => true,
				'capability_type'     => array( 'real-estate', 'real-estates' ),
				'capabilities'        => array(),
				'supports'            => array(),
				'exclude_from_search' => false,
			);

			$custom_post_types['agent'] = array(
				'name'                => __( 'Agents', 'tf-real-estate' ),
				'singular_name'       => __( 'Agent', 'tf-real-estate' ),
				'description'         => __( 'Holds our custom article post specific data', 'tf-real-estate' ),
				'public'              => true,
				'publicly_queryable'  => true,
				'slug_post_type'  	  => $custom_url_agent,
				'menu_position'       => 3,
				'has_archive'         => true,
				'hierarchical'        => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'show_in_rest'        => true,
				'map_meta_cap'        => true,
				'query_var'           => true,
				'menu_icon'           => 'dashicons-businessperson',
				'can_export'          => true,
				'capability_type'     => array( 'agent', 'agents' ),
				'capabilities'        => array(
					'read_post'          => 'read_agent',
					'edit_post'          => 'edit_agent',
					'edit_posts'         => 'edit_agents',
					'publish_posts'      => 'publish_agents',
					'edit_publish_posts' => 'edit_publish_agents',
					'delete_post'        => 'delete_agent'
				),
				'supports'            => array(),
				'exclude_from_search' => false,
			);

			$custom_post_types['package'] = array(
				'name'                => __( 'Package', 'tf-real-estate' ),
				'singular_name'       => __( 'Package', 'tf-real-estate' ),
				'description'         => __( 'Holds our custom article post specific data', 'tf-real-estate' ),
				'public'              => true,
				'publicly_queryable'  => false,
				'slug_post_type'  	  => 'package',
				'menu_position'       => 3,
				'has_archive'         => true,
				'hierarchical'        => true,
				'show_ui'             => $package_enable,
				'show_in_menu'        => true,
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'show_in_rest'        => true,
				'map_meta_cap'        => true,
				'query_var'           => false,
				'menu_icon'           => 'dashicons-archive',
				'can_export'          => true,
				'capability_type'     => array( 'package', 'packages' ),
				'capabilities'        => array(),
				'supports'            => array(),
				'exclude_from_search' => false,
			);

			$custom_post_types['invoice'] = array(
				'name'                => __( 'Invoice', 'tf-real-estate' ),
				'singular_name'       => __( 'Invoice', 'tf-real-estate' ),
				'description'         => __( 'Holds our custom article post specific data', 'tf-real-estate' ),
				'public'              => true,
				'publicly_queryable'  => false,
				'slug_post_type'  	  => 'invoice',
				'menu_position'       => 4,
				'has_archive'         => true,
				'hierarchical'        => true,
				'show_ui'             => $package_enable,
				'show_in_menu'        => true,
				'show_in_admin_bar'   => false,
				'show_in_nav_menus'   => true,
				'show_in_rest'        => true,
				'map_meta_cap'        => true,
				'query_var'           => false,
				'menu_icon'           => 'dashicons-text-page',
				'can_export'          => true,
				'capability_type'     => array( 'invoice', 'invoices' ),
				'capabilities'        => array(
					'create_posts' => 'do_not_allow',
					'edit_post'    => 'edit_invoices',
					'delete_posts' => 'delete_invoices'
				),
				'supports'            => array( 'title', 'excerpt' ),
				'exclude_from_search' => true,
			);

			$custom_post_types['user-package'] = array(
				'name'                => __( 'User Packages', 'tf-real-estate' ),
				'singular_name'       => __( 'User Package', 'tf-real-estate' ),
				'description'         => __( 'Holds our custom article post specific data', 'tf-real-estate' ),
				'public'              => true,
				'publicly_queryable'  => false,
				'slug_post_type'  	  => 'user-package',
				'menu_position'       => 5,
				'has_archive'         => true,
				'hierarchical'        => true,
				'show_ui'             => $package_enable,
				'show_in_menu'        => true,
				'show_in_admin_bar'   => false,
				'show_in_nav_menus'   => true,
				'show_in_rest'        => true,
				'map_meta_cap'        => true,
				'query_var'           => false,
				'menu_icon'           => 'dashicons-id-alt',
				'can_export'          => true,
				'capability_type'     => array( 'user-package', 'user-packages' ),
				'capabilities'        => array(
					'create_posts' => 'do_not_allow',
					'edit_post'    => 'edit_user_packages',
					'delete_posts' => 'delete_user_packages'
				),
				'supports'            => array( 'title', 'excerpt' ),
				'exclude_from_search' => true,
			);

			$custom_post_types['transaction-log'] = array(
				'name'                => __( 'Transaction Logs', 'tf-real-estate' ),
				'singular_name'       => __( 'Transaction Log', 'tf-real-estate' ),
				'description'         => __( 'Holds our custom article post specific data', 'tf-real-estate' ),
				'public'              => true,
				'publicly_queryable'  => false,
				'slug_post_type'  	  => 'transaction-log',
				'menu_position'       => 5,
				'has_archive'         => true,
				'hierarchical'        => true,
				'show_ui'             => $package_enable,
				'show_in_menu'        => true,
				'show_in_admin_bar'   => false,
				'show_in_nav_menus'   => true,
				'show_in_rest'        => true,
				'map_meta_cap'        => true,
				'query_var'           => false,
				'menu_icon'           => 'dashicons-feedback',
				'can_export'          => true,
				'capability_type'     => array( 'transaction-log', 'transaction-logs' ),
				'capabilities'        => array(
					'create_posts' => 'do_not_allow',
					'edit_post'    => 'edit_transaction-logs',
					'delete_posts' => 'delete_transaction-logs'
				),
				'supports'            => array( 'title', 'excerpt' ),
				'exclude_from_search' => true,
			);

			return $custom_post_types;
		}

		/**
		 * Register custom post type
		 */
		function tfre_register_custom_post_type() {
			$list_custom_post_type = $this->tfre_get_list_custom_post_type();

			foreach ( $list_custom_post_type as $post_type => $value ) {
				$post_type_name = $value['name'];

				$default_args = array(
					'labels'              => array(
						'name'               => sprintf( __( '%s', 'tf-real-estate' ), $post_type_name ),
						'singular_name'      => sprintf( __( '%s', 'tf-real-estate' ), $value['singular_name'] ),
						'add_new'            => sprintf( __( 'Add New %s', 'tf-real-estate' ), $value['singular_name'] ),
						'add_new_item'       => sprintf( __( 'Add New %s', 'tf-real-estate' ), $value['singular_name'] ),
						'edit_item'          => sprintf( __( 'Edit %s', 'tf-real-estate' ), $value['singular_name'] ),
						'new_item'           => sprintf( __( 'New %s', 'tf-real-estate' ), $value['singular_name'] ),
						'all_items'          => sprintf( __( 'All %s', 'tf-real-estate' ), $value['singular_name'] ),
						'view_item'          => sprintf( __( 'View %s', 'tf-real-estate' ), $value['singular_name'] ),
						'search_items'       => sprintf( __( 'Search %s', 'tf-real-estate' ), $value['singular_name'] ),
						'featured_image'     => __( 'Poster', 'tf-real-estate' ),
						'set_featured_image' => __( 'Add Poster', 'tf-real-estate' )
					),
					'description'         => $value['description'],
					'public'              => $value['public'],
					'publicly_queryable'  => $value['publicly_queryable'],
					'menu_position'       => $value['menu_position'],
					'rewrite'             => array( 'slug' => $value['slug_post_type'] ),
					'supports'            => count( $value['supports'] ) > 0 ? $value['supports'] : array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'revisions', 'author', 'trackbacks' ),
					'has_archive'         => $value['has_archive'],
					'hierarchical'        => $value['hierarchical'],
					'show_ui'             => $value['show_ui'],
					'show_in_menu'        => $value['show_in_menu'],
					'show_in_admin_bar'   => $value['show_in_admin_bar'],
					'show_in_nav_menus'   => $value['show_in_nav_menus'],
					'query_var'           => $value['query_var'],
					'menu_icon'           => $value['menu_icon'],
					'can_export'          => $value['can_export'],
					'exclude_from_search' => $value['exclude_from_search'],
				);

				if ( count( $value['capabilities'] ) > 0 ) {
					$default_args['capability_type'] = $value['capability_type'];
					$default_args['capabilities']    = $value['capabilities'];
				}

				register_post_type( $post_type, $default_args );
			}
		}
	}
}