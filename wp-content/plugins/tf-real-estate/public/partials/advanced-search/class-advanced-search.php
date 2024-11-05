<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Advanced_Search' ) ) {
	class Advanced_Search {
		public function tfre_advanced_search_shortcode() {
			ob_start();
			tfre_get_template_with_arguments( 'advanced-search/advanced-search.php' );
			return ob_get_clean();
		}

		public function tfre_enqueue_advanced_search_scripts() {
			$tfre_property_advanced_search_vars = array(
				'ajaxUrl'          => TF_AJAX_URL,
				'currencySign'     => tfre_get_option( 'currency_sign', esc_html__( '$', 'tf-real-estate' ) ),
				'currencyPosition' => tfre_get_option( 'currency_sign_position', esc_html__( 'before', 'tf-real-estate' ) ),
				'country_default'  => is_array( get_option( 'country_list' ) ) ? get_option( 'country_list' )[0] : ''
			);
			wp_enqueue_script( 'advanced-search-js', TF_PLUGIN_URL . 'public/assets/js/advanced-search.js', array( 'jquery' ), null, true );
			wp_localize_script( 'advanced-search-js', 'advancedSearchVars', $tfre_property_advanced_search_vars );
		}

		public function get_province_states_by_country_ajax() {
			if ( ! isset( $_POST['country'] ) ) {
				return;
			}
			$country = wp_unslash( $_POST['country'] );
			$type    = isset( $_POST['type'] ) ? wp_unslash( $_POST['type'] ) : '';
			if ( ! empty( $country ) ) {
				$taxonomy_terms = get_categories(
					array(
						'taxonomy'   => 'province-state',
						'orderby'    => 'name',
						'order'      => 'ASC',
						'hide_empty' => false,
						'parent'     => 0,
						'meta_query' => array(
							array(
								'key'     => 'province_state_country',
								'value'   => $country,
								'compare' => '=',
							)
						)
					)
				);
			} else {
				$taxonomy_terms = tfre_get_categories( 'province-state' );
			}

			$html = '';
			if ( $type == 0 ) {
				$html = '<option value="">' . esc_html__( 'None', 'tf-real-estate' ) . '</option>';
			}
			if ( ! empty( $taxonomy_terms ) ) {
				if ( $type == 1 ) {
					$html .= '<option value="" selected="selected">' . esc_html__( 'Province/State', 'tf-real-estate' ) . '</option>';
				}
				if ( isset( $_POST['is_slug'] ) && ( $_POST['is_slug'] == '0' ) ) {
					foreach ( $taxonomy_terms as $term ) {
						$html .= '<option value="' . esc_attr( $term->term_id ) . '">' . esc_html( $term->name ) . '</option>';
					}
				} else {
					foreach ( $taxonomy_terms as $term ) {
						$html .= '<option value="' . esc_attr( $term->slug ) . '">' . esc_html( $term->name ) . '</option>';
					}
				}
			}

			echo wp_kses( $html, array(
				'option' => array(
					'value'    => true,
					'selected' => true
				)
			)
			);
			wp_die();
		}

		public function get_neighborhoods_by_province_state_ajax() {
			if ( ! isset( $_POST['state'] ) ) {
				return;
			}
			$country = wp_unslash( $_POST['country'] );
			$state   = wp_unslash( $_POST['state'] );
			$type    = isset( $_POST['type'] ) ? wp_unslash( $_POST['type'] ) : '';
			if ( isset( $_POST['is_slug'] ) && ( $_POST['is_slug'] == '0' ) ) {
				$property_state = get_term_by( 'id', $state, 'province-state' );
			} else {
				$property_state = get_term_by( 'slug', $state, 'province-state' );
			}

			if ( ! empty( $state ) && $property_state ) {
				$taxonomy_terms = get_categories(
					array(
						'taxonomy'   => 'neighborhood',
						'orderby'    => 'name',
						'order'      => 'ASC',
						'hide_empty' => false,
						'parent'     => 0,
						'meta_query' => array(
							array(
								'key'     => 'neighborhood_province_state',
								'value'   => $property_state->term_id,
								'compare' => '=',
							),
							array(
								'key'     => 'neighborhood_country',
								'value'   => $country,
								'compare' => '=',
							)
						)
					)
				);
			} else {
				$taxonomy_terms = tfre_get_categories( 'neighborhood' );
			}

			$html = '';
			if ( $type == 0 ) {
				$html = '<option value="">' . esc_html__( 'None', 'tf-real-estate' ) . '</option>';
			}
			if ( ! empty( $taxonomy_terms ) ) {
				if ( $type == 1 ) {
					$html .= '<option value="" selected="selected">' . esc_html__( 'Neighborhood', 'tf-real-estate' ) . '</option>';
				}
				if ( isset( $_POST['is_slug'] ) && ( $_POST['is_slug'] == '0' ) ) {
					foreach ( $taxonomy_terms as $term ) {
						$html .= '<option value="' . esc_attr( $term->term_id ) . '">' . esc_html( $term->name ) . '</option>';
					}
				} else {
					foreach ( $taxonomy_terms as $term ) {
						$html .= '<option value="' . esc_attr( $term->slug ) . '">' . esc_html( $term->name ) . '</option>';
					}
				}
			}

			echo wp_kses( $html, array(
				'option' => array(
					'value'    => true,
					'selected' => true
				)
			)
			);
			wp_die();
		}

		public function property_advanced_search_form( $atts ) {
			tfre_get_template_with_arguments( 'shortcodes/advanced-search-form/advanced-search-form.php' );
		}
	}
}