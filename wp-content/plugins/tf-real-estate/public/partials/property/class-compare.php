<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'TFRE_Compare' ) ) {
	class TFRE_Compare {
		const SETTINGS_COMPARE_PAGE = 'compare_page';

		function tfre_enqueue_compare_scripts () {
            wp_enqueue_script('compare-js', TF_PLUGIN_URL . '/public/assets/js/compare.js', array('jquery'), null, false);
            wp_localize_script('compare-js', 'compare_variables', array(
                    'ajax_url' => TF_AJAX_URL,
					'compare_button_url' => tfre_get_permalink(self::SETTINGS_COMPARE_PAGE),
                    'alert_message' => esc_html__('Only allowed to compare up to 4 properties!', 'tf-real-estate'),
                    'alert_not_found' => esc_html__('Compare Page Not Found!', 'tf-real-estate')
                )
            );
			wp_enqueue_style('compare-css', TF_PLUGIN_URL . 'public/assets/css/compare.css', array(), '', 'all');
        }

		private static $_instance;

		public static function getInstance()
		{
			if (self::$_instance == null) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

        public function tfre_show_compare_listings() {
			$this::tfre_open_session();
			$tfre_compare_properties = isset($_SESSION['tfre_compare_properties']) ? (wp_unslash($_SESSION['tfre_compare_properties'])) : array();
			?>
			<div id="tfre-compare-properties-listings">
				<?php if (true ): ?>
					<div class="compare-listing-body">
						<div class="compare-thumb-main row">
							<?php
							$width             = get_option('thumbnail_width', '100px');
							$height            = get_option('thumbnail_height', '100px');
							$no_image_src      = tfre_get_option('default_property_image', '')['url'] != '' ? tfre_get_option('default_property_image', '')['url'] : TF_PLUGIN_URL . 'includes/elementor-widget/assets/images/no-image.jpg';
							foreach ( $tfre_compare_properties as $key ) : ?>
								<?php if ( $key != 0 ) :
									$attach_id = get_post_thumbnail_id( (double) $key );
									$image_src = wp_get_attachment_image_url($attach_id);?>
									<div class="compare-thumb tfre-compare-property" style = "position: relative; width: 105px; margin-left: auto; margin-right: auto; margin-bottom: 10px; overflow: hidden;"
									     data-property-id="<?php echo esc_attr( $key ); ?>">
										<img loading="lazy" class="compare-property-img" width="<?php echo esc_attr( $width ) ?>"
										     height="<?php echo esc_attr( $height ) ?>"
										     src="<?php echo esc_url( $image_src ) ?>"
										     onerror="this.src = '<?php echo esc_url( $no_image_src ) ?>';">
										<button type="button" class="compare-property-remove" style = "position: absolute; top: 0;right: 0; padding: 2px; width: 20px; height: 20px;">
											<i class="fa fa-times" style = "position: relative; top: -1px;"></i></button>
									</div>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
						<button type="button" class="button tfre-compare-properties-button"><?php esc_html_e( 'Compare', 'tf-real-estate' ); ?></button>
					</div>
					<button type="button" class="tfre-listing-btn"><i class="fa fa-angle-left"></i></button>
				<?php endif; ?>
			</div>
			<?php
        }

		public function tfre_close_session() {
			if ( isset( $_SESSION ) ) {
				session_destroy();
			}
		}

		public static function tfre_open_session() {
			if ( ( function_exists( 'session_status' ) && session_status() !== PHP_SESSION_ACTIVE )
			     || ! session_id() ) {
				session_start();
				if ( ! isset( $_SESSION['tfre_compare_starttime'] ) ) {
					$_SESSION['tfre_compare_starttime'] = time();
				}
				if ( ! isset( $_SESSION['tfre_compare_properties'] ) ) {
					$_SESSION['tfre_compare_properties'] = array();
				}
			}
			if ( isset( $_SESSION['tfre_compare_starttime'] ) ) {
				if ( (int) $_SESSION['tfre_compare_starttime'] > time() + 86400 ) {
					unset( $_SESSION['tfre_compare_properties'] );
				}
			}
		}
		public function tfre_compare_add_remove_property_ajax() {
			$property_id    = isset($_POST['property_id']) ? absint(wp_unslash($_POST['property_id'])) : 0;
			if ($property_id > 0) {
				$max_items      = tfre_get_option('max_items_compare', 4);
				$this::tfre_open_session();
				$current_number = ( isset( $_SESSION['tfre_compare_properties'] ) && is_array( $_SESSION['tfre_compare_properties'] ) ) ? count(wp_unslash($_SESSION['tfre_compare_properties'])  ) : 0;

				if ( is_array( $_SESSION['tfre_compare_properties'] ) && in_array( $property_id, $_SESSION['tfre_compare_properties'] ) ) {
					unset( $_SESSION['tfre_compare_properties'][ array_search( $property_id, $_SESSION['tfre_compare_properties'] ) ] );
				} elseif ( $current_number < $max_items ) {

					$_SESSION['tfre_compare_properties'][] = $property_id;
				}

				$_SESSION['tfre_compare_properties'] = array_unique( $_SESSION['tfre_compare_properties'] );

				$this->tfre_show_compare_listings();
			}
			wp_die();
		}

		public function tfre_template_compare_listing() {
			tfre_get_template_with_arguments( 'property/compare-listing.php' , array());
		}

		public static function tfre_compare_shortcode () {
			ob_start();
			tfre_get_template_with_arguments( 'property/compare.php' , array());
            return ob_get_clean();
		}
	}
}
