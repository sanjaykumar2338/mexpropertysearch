<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Admin_Taxonomies' ) ) {
	class Admin_Taxonomies {
		private $screen = array();
		/**
		 * Define list taxonomies for property
		 */
		function tfre_get_list_config_taxonomies() {
			$taxs = array();

			$custom_url_property_type 	   		= tfre_get_option( 'custom_url_property_type', 'property-type' );
			$custom_url_property_status 	   	= tfre_get_option( 'custom_url_property_status', 'property-status' );
			$custom_url_property_feature 	   	= tfre_get_option( 'custom_url_property_feature', 'property-feature' );
			$custom_url_property_label 	   		= tfre_get_option( 'custom_url_property_label', 'property-label' );
			$custom_url_province_state 	   		= tfre_get_option( 'custom_url_province_state', 'province-state' );
			$custom_url_property_neighborhood 	= tfre_get_option( 'custom_url_property_neighborhood', 'property-neighborhood' );
			$custom_url_agency 	   				= tfre_get_option( 'custom_url_agency', 'agency' );


			// create a custom taxonomy name it "Property Type" for your CTP real-estate
			$taxs['property-type'] = array(
				'post_type'                       => array( 'real-estate' ),
				'singular_name'                   => esc_html__( 'Property Type', 'tf-real-estate' ),
				'hierarchical'                    => true,
				'label'                           => esc_html__( 'Property Type', 'tf-real-estate' ),
				'show_ui'                         => true,
				'show_admin_column'               => true,
				'query_var'                       => true,
				'rewrite'                         => array( 'slug' => $custom_url_property_type ),
				'enable_taxonomy_parent_dropdown' => false,
			);

			// create a custom taxonomy name it "Property Status" for your CTP real-estate
			$taxs['property-status'] = array(
				'post_type'                       => array( 'real-estate' ),
				'singular_name'                   => esc_html__( 'Property Status', 'tf-real-estate' ),
				'hierarchical'                    => true,
				'label'                           => esc_html__( 'Property Status', 'tf-real-estate' ),
				'show_ui'                         => true,
				'show_admin_column'               => true,
				'query_var'                       => true,
				'rewrite'                         => array( 'slug' => $custom_url_property_status ),
				'enable_taxonomy_parent_dropdown' => false,
			);

			// create a custom taxonomy name it "Property Feature" for your CTP real-estate
			$taxs['property-feature'] = array(
				'post_type'                       => array( 'real-estate' ),
				'singular_name'                   => esc_html__( 'Property Feature', 'tf-real-estate' ),
				'hierarchical'                    => true,
				'label'                           => esc_html__( 'Property Feature', 'tf-real-estate' ),
				'show_ui'                         => true,
				'show_admin_column'               => true,
				'query_var'                       => true,
				'rewrite'                         => array( 'slug' => $custom_url_property_feature ),
				'enable_taxonomy_parent_dropdown' => false,
			);

			// create a custom taxonomy name it "Property Label" for your CTP real-estate
			$taxs['property-label'] = array(
				'post_type'                       => array( 'real-estate' ),
				'singular_name'                   => esc_html__( 'Property Label', 'tf-real-estate' ),
				'hierarchical'                    => true,
				'label'                           => esc_html__( 'Property Label', 'tf-real-estate' ),
				'show_ui'                         => true,
				'show_admin_column'               => true,
				'query_var'                       => true,
				'rewrite'                         => array( 'slug' => $custom_url_property_label ),
				'enable_taxonomy_parent_dropdown' => false,
			);

			// create a custom taxonomy name it "Province/State" for your CTP real-estate
			$taxs['province-state'] = array(
				'post_type'                       => array( 'real-estate' ),
				'singular_name'                   => esc_html__( 'Province/State', 'tf-real-estate' ),
				'hierarchical'                    => true,
				'label'                           => esc_html__( 'Province/State', 'tf-real-estate' ),
				'show_ui'                         => true,
				'show_admin_column'               => true,
				'query_var'                       => true,
				'rewrite'                         => array( 'slug' => $custom_url_province_state ),
				'enable_taxonomy_parent_dropdown' => false,
			);

			// create a custom taxonomy name it "Neighborhood" for your CTP real-state
			$taxs['neighborhood'] = array(
				'post_type'                       => array( 'real-estate' ),
				'singular_name'                   => esc_html__( 'Neighborhood', 'tf-real-estate' ),
				'hierarchical'                    => true,
				'label'                           => esc_html__( 'Neighborhood', 'tf-real-estate' ),
				'show_ui'                         => true,
				'show_admin_column'               => true,
				'query_var'                       => true,
				'rewrite'                         => array( 'slug' => $custom_url_property_neighborhood ),
				'enable_taxonomy_parent_dropdown' => false,
			);

			// create a custom taxonomy name it "agency" for your CTP agent
			$taxs['agencies'] = array(
				'post_type'                       => array( 'agent' ),
				'singular_name'                   => esc_html__( 'Agency', 'tf-real-estate' ),
				'hierarchical'                    => true,
				'label'                           => esc_html__( 'Agency', 'tf-real-estate' ),
				'show_ui'                         => true,
				'show_admin_column'               => true,
				'query_var'                       => true,
				'rewrite'                         => array( 'slug' => $custom_url_agency ),
				'enable_taxonomy_parent_dropdown' => false,
			);

			return $taxs;
		}

		/**
		 * Registers taxonomies
		 */
		public function tfre_register_taxonomies() {
			$taxonomies = $this->tfre_get_list_config_taxonomies();
			foreach ( $taxonomies as $taxonomy => $arguments ) {
				if ( ! isset( $arguments ) && ! is_array( $arguments ) ) {
					return;
				}
				if ( ! isset( $arguments['post_type'] ) ) {
					return;
				}
				if ( $arguments['enable_taxonomy_parent_dropdown'] == false ) {
					$this->screen[] = $taxonomy;
				}

				$post_type     = array_unique( (array) $arguments['post_type'] );
				$singular_name = isset( $arguments['singular_name'] ) ? $arguments['singular_name'] : '';
				$label         = isset( $arguments['label'] ) ? $arguments['label'] : '';

				$default_args = array(
					'hierarchical' => true,
					'label'        => $label,
					'query_var'    => true,
					'rewrite'      => array(
						'slug'       => $taxonomy,
						'with_front' => false
					),
					'labels'       => array(
						'name'                       => $singular_name,
						'singular_name'              => $singular_name,
						'menu_name'                  => $label,
						'search_items'               => sprintf( esc_html__( 'Search %s', 'tf-real-estate' ), $label ),
						'popular_items'              => sprintf( esc_html__( 'Popular %s', 'tf-real-estate' ), $label ),
						'all_items'                  => sprintf( esc_html__( 'All %s', 'tf-real-estate' ), $label ),
						'parent_item'                => sprintf( esc_html__( 'Parent %s', 'tf-real-estate' ), $singular_name ),
						'parent_item_colon'          => sprintf( esc_html__( 'Parent %s:', 'tf-real-estate' ), $singular_name ),
						'edit_item'                  => sprintf( esc_html__( 'Edit %s', 'tf-real-estate' ), $singular_name ),
						'view_item'                  => sprintf( esc_html__( 'View %s', 'tf-real-estate' ), $singular_name ),
						'update_item'                => sprintf( esc_html__( 'Update %s', 'tf-real-estate' ), $singular_name ),
						'add_new_item'               => sprintf( esc_html__( 'Add New %s', 'tf-real-estate' ), $singular_name ),
						'new_item_name'              => sprintf( esc_html__( 'New %s New', 'tf-real-estate' ), $singular_name ),
						'separate_items_with_commas' => sprintf( esc_html__( 'Separate %s with commas', 'tf-real-estate' ), strtolower( $label ) ),
						'add_or_remove_items'        => sprintf( esc_html__( 'Add or remove %s', 'tf-real-estate' ), strtolower( $label ) ),
						'choose_from_most_used'      => sprintf( esc_html__( 'Choose from the most used %s', 'tf-real-estate' ), strtolower( $label ) ),
						'not_found'                  => sprintf( esc_html__( 'No %s found.', 'tf-real-estate' ), strtolower( $label ) ),
						'no_terms'                   => sprintf( esc_html__( 'No %s', 'tf-real-estate' ), strtolower( $label ) ),
						'items_list_navigation'      => sprintf( esc_html__( '%s list navigation', 'tf-real-estate' ), $label ),
						'items_list'                 => sprintf( esc_html__( '%s list', 'tf-real-estate' ), $label ),
					)
				);

				$arguments           = wp_parse_args( $arguments, $default_args );
				$arguments['labels'] = wp_parse_args( $arguments['labels'], $default_args['labels'] );
				unset( $arguments['enable_taxonomy_parent_dropdown'] );
				register_taxonomy( $taxonomy, $post_type, $arguments );
			}
		}

		/**
		 * Remove Taxonomy Parent
		 */
		public function tfre_remove_tax_parent_dropdown() {
			$screen = get_current_screen();
			$parent = null;
			if ( in_array( $screen->taxonomy, $this->screen ) ) {
				if ( 'edit-tags' == $screen->base ) {
					$parent = "$('label[for=parent]').parent()";
				} elseif ( 'term' == $screen->base ) {
					$parent = "$('label[for=parent]').parent().parent()";
				}
			}
			if ( $parent ) {
				echo __( '<script type="text/javascript">' );
				echo __( 'jQuery(document).ready(function ($){' );
				echo __( $parent . '.remove();' );
				echo __( '});' );
				echo __( '</script>' );
			}
		}

		/**
		 * Define list term meta
		 */
		public function tfre_get_list_controls_term_meta( $taxonomy ) {
			if ( $taxonomy === 'province-state' || $taxonomy === 'neighborhood' ) {
				$countries               = tfre_list_countries();
				$countries_list_selected = get_option( 'country_list' );
				$list_countries          = array();
				if ( ( is_array( $countries_list_selected ) && count( $countries_list_selected ) != 0 ) ) {
					foreach ( $countries_list_selected as $key => $value ) {
						$list_countries[ $value ] = $countries[ $value ];
					}
				} else {
					$list_countries = $countries;
				}

				$terms_province_state = get_categories(
					array(
						'taxonomy'   => 'province-state',
						'hide_empty' => 0,
						'parent'     => 0,
						'show_count' => 1,
						'orderby'    => 'name',
						'order'      => 'ASC',
					)
				);
				$list_terms           = array();
				foreach ( $terms_province_state as $key => $value ) {
					$list_terms[ $value->term_id ] = $value->name;
				}
			}

			$controls = array();
			switch ( $taxonomy ) {
				case 'agencies':
					$controls['agency_banner'] = array(
						'type'    => 'single-image-control',
						'section' => 'agencies-settings',
						'title'   => esc_html__( 'Banner', 'tf-real-estate' ),
					);

					$controls['agency_logo'] = array(
						'type'    => 'single-image-control',
						'section' => 'agencies-settings',
						'title'   => esc_html__( 'Logo', 'tf-real-estate' ),
					);

					$controls['agency_address'] = array(
						'type'        => 'text',
						'section'     => 'agencies-settings',
						'title'       => esc_html__( 'Full Address', 'tf-real-estate' ),
						'placeholder' => esc_html__( 'Full Address', 'tf-real-estate' ),
					);

					$controls['agency_location'] = array(
						'type'        => 'map',
						'title'       => esc_html__( 'Location at Map', 'tf-real-estate' ),
						'section'     => 'agencies-settings',
						'placeholder' => esc_html__( 'Map location', 'tf-real-estate' ),
					);

					$controls['agency_email'] = array(
						'type'        => 'text',
						'section'     => 'agencies-settings',
						'title'       => esc_html__( 'Email', 'tf-real-estate' ),
						'placeholder' => esc_html__( 'Email', 'tf-real-estate' ),
					);

					$controls['agency_fax_number'] = array(
						'type'        => 'text',
						'section'     => 'agencies-settings',
						'title'       => esc_html__( 'Fax Number', 'tf-real-estate' ),
						'placeholder' => esc_html__( 'Fax Number', 'tf-real-estate' ),
					);

					$controls['agency_office_number'] = array(
						'type'        => 'text',
						'section'     => 'agencies-settings',
						'title'       => esc_html__( 'Office Number', 'tf-real-estate' ),
						'placeholder' => esc_html__( 'Office Number', 'tf-real-estate' ),
					);

					$controls['agency_phone_number'] = array(
						'type'        => 'text',
						'section'     => 'agencies-settings',
						'title'       => esc_html__( 'Phone Number', 'tf-real-estate' ),
						'placeholder' => esc_html__( 'Phone Number', 'tf-real-estate' ),
					);

					$controls['agency_website'] = array(
						'type'        => 'text',
						'section'     => 'agencies-settings',
						'title'       => esc_html__( 'Website', 'tf-real-estate' ),
						'placeholder' => esc_html__( 'Website', 'tf-real-estate' )
					);

					$controls['agency_facebook'] = array(
						'type'        => 'text',
						'section'     => 'agencies-settings',
						'title'       => esc_html__( 'Facebook', 'tf-real-estate' ),
						'placeholder' => esc_html__( 'Facebook', ' tf-real-estate' )
					);

					$controls['agency_instagram'] = array(
						'type'        => 'text',
						'section'     => 'agencies-settings',
						'title'       => esc_html__( 'Instagram', 'tf-real-estate' ),
						'placeholder' => esc_html__( 'Instagram', ' tf-real-estate' )
					);

					$controls['agency_twitter'] = array(
						'type'        => 'text',
						'section'     => 'agencies-settings',
						'title'       => esc_html__( 'Twitter', 'tf-real-estate' ),
						'placeholder' => esc_html__( 'Twitter', ' tf-real-estate' )
					);

					$controls['agency_vimeo'] = array(
						'type'        => 'text',
						'section'     => 'agencies-settings',
						'title'       => esc_html__( 'Vimeo', 'tf-real-estate' ),
						'placeholder' => esc_html__( 'Vimeo', ' tf-real-estate' )
					);

					$controls['agency_youtube'] = array(
						'type'        => 'text',
						'section'     => 'agencies-settings',
						'title'       => esc_html__( 'Youtube', 'tf-real-estate' ),
						'placeholder' => esc_html__( 'Youtube', ' tf-real-estate' )
					);

					$controls['agency_tiktok'] = array(
						'type'        => 'text',
						'section'     => 'agencies-settings',
						'title'       => esc_html__( 'Tiktok', 'tf-real-estate' ),
						'placeholder' => esc_html__( 'Tiktok', ' tf-real-estate' )
					);

					$controls['agency_skype'] = array(
						'type'        => 'text',
						'section'     => 'agencies-settings',
						'title'       => esc_html__( 'Skype', 'tf-real-estate' ),
						'placeholder' => esc_html__( 'Skype', ' tf-real-estate' )
					);

					$controls['agency_linkedin'] = array(
						'type'        => 'text',
						'section'     => 'agencies-settings',
						'title'       => esc_html__( 'LinkedIn', 'tf-real-estate' ),
						'placeholder' => esc_html__( 'LinkedIn', ' tf-real-estate' )
					);

					$controls['agency_pinterest'] = array(
						'type'        => 'text',
						'section'     => 'agencies-settings',
						'title'       => esc_html__( 'Pinterest', 'tf-real-estate' ),
						'placeholder' => esc_html__( 'Pinterest', ' tf-real-estate' )
					);
					break;

				case 'neighborhood':
					$controls['neighborhood_country'] = array(
						'type'    => 'select',
						'section' => 'neighborhood-settings',
						'title'   => esc_html__( 'Country ', 'tf-real-estate' ),
						'choices' => $list_countries,
					);

					$controls['neighborhood_province_state'] = array(
						'type'    => 'select',
						'section' => 'neighborhood-settings',
						'title'   => esc_html__( 'Province/State', 'tf-real-estate' ),
						'choices' => $list_terms,
					);

					$controls['neighborhood_image'] = array(
						'type'    => 'single-image-control',
						'section' => 'neighborhood-settings',
						'title'   => esc_html__( 'Neighborhood Image', 'tf-real-estate' ),
					);
					break;

				case 'province-state':
					$controls['province_state_country'] = array(
						'type'    => 'select',
						'section' => 'province-state-settings',
						'title'   => esc_html__( 'Country', 'tf-real-estate' ),
						'choices' => $list_countries,
					);

					$controls['province_state_image'] = array(
						'type'    => 'single-image-control',
						'section' => 'province-state-settings',
						'title'   => esc_html__( 'Province/State Image', 'tf-real-estate' ),
					);
					break;

				case 'property-label':
					$controls['label_color'] = array(
						'type'    => 'color-picker',
						'section' => 'property-label-settings',
						'title'   => esc_html__( 'Label Color', 'tf-real-estate' ),
						'default' => '#6E55FF',
					);
					break;

				case 'property-status':
					$controls['status_color'] = array(
						'type'    => 'color-picker',
						'section' => 'property-status-settings',
						'title'   => esc_html__( 'Status Color', 'tf-real-estate' ),
						'default' => '#ffffff',
					);
					break;

				case 'property-type':
					$controls['type_image'] = array(
						'type'    => 'single-image-control',
						'section' => 'property-type-settings',
						'title'   => esc_html__( 'Type Image', 'tf-real-estate' ),
					);

					$controls['type_icon'] = array(
						'type'    => 'single-image-control',
						'section' => 'property-type-settings',
						'title'   => esc_html__( 'Type Icon', 'tf-real-estate' )
					);
					break;

				default:
					break;
			}
			return $controls;
		}

		/**
		 * Registers term meta
		 */
		public function tfre_register_term_meta() {
			new Term_Meta(
				array(
					'id'         => 'agencies',
					'label'      => esc_html__( 'Agencies Settings ', 'tf-real-estate' ),
					'post_types' => 'agent',
					'taxonomy'   => array( 'agencies' ),
					'priority'   => 'high',
					'sections'   => array(
						'agencies-settings' => array( 'title' => esc_html__( 'Agencies Settings', 'tf-real-estate' ) ),
					),
					'options'    => $this->tfre_get_list_controls_term_meta( 'agencies' )
				)
			);

			new Term_Meta(
				array(
					'id'         => 'neighborhood',
					'label'      => esc_html__( 'Neighborhood', 'tf-real-estate' ),
					'post_types' => 'real-estate',
					'taxonomy'   => array( 'neighborhood' ),
					'priority'   => 'high',
					'sections'   => array(
						'neighborhood-settings' => array( 'title' => esc_html__( 'Neighborhood Settings', 'tf-real-estate' ) ),
					),
					'options'    => $this->tfre_get_list_controls_term_meta( 'neighborhood' )
				)
			);

			new Term_Meta(
				array(
					'id'         => 'province-state',
					'label'      => esc_html__( 'Province/State', 'tf-real-estate' ),
					'post_types' => 'real-estate',
					'taxonomy'   => array( 'province-state' ),
					'priority'   => 'high',
					'sections'   => array(
						'province-state-settings' => array( 'title' => esc_html__( 'Province/State Settings', 'tf-real-estate' ) ),
					),
					'options'    => $this->tfre_get_list_controls_term_meta( 'province-state' )
				)
			);

			new Term_Meta(
				array(
					'id'         => 'property-label',
					'label'      => esc_html__( 'Property Label', 'tf-real-estate' ),
					'post_types' => 'real-estate',
					'taxonomy'   => array( 'property-label' ),
					'priority'   => 'high',
					'sections'   => array(
						'property-label-settings' => array( 'title' => esc_html__( 'Property Label Settings', 'tf-real-estate' ) ),
					),
					'options'    => $this->tfre_get_list_controls_term_meta( 'property-label' )
				)
			);

			new Term_Meta(
				array(
					'id'         => 'property-status',
					'label'      => esc_html__( 'Property Status', 'tf-real-estate' ),
					'post_types' => 'real-estate',
					'taxonomy'   => array( 'property-status' ),
					'priority'   => 'high',
					'sections'   => array(
						'property-status-settings' => array( 'title' => esc_html__( 'Property Status Settings', 'tf-real-estate' ) ),
					),
					'options'    => $this->tfre_get_list_controls_term_meta( 'property-status' )
				)
			);

			new Term_Meta(
				array(
					'id'         => 'property-type',
					'label'      => esc_html__( 'Property Type', 'tf-real-estate' ),
					'post_types' => 'real-estate',
					'taxonomy'   => array( 'property-type' ),
					'priority'   => 'high',
					'sections'   => array(
						'property-type-settings' => array( 'title' => esc_html__( 'Property Type Settings', 'tf-real-estate' ) ),
					),
					'options'    => $this->tfre_get_list_controls_term_meta( 'property-type' )
				)
			);
		}
	}
}