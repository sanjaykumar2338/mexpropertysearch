<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!class_exists('Property_Public')) {
	class Property_Public
	{
		protected $property_id;
		protected $alert_message;
		public function tfre_enqueue_property_scripts()
		{
			$save_property_nonce = wp_create_nonce('save_property_nonce');
			$property_upload_nonce = wp_create_nonce('allow_upload_nonce');
			$property_ajax_upload_gallery_url = add_query_arg('action', 'img_upload', TF_AJAX_URL);
			$property_ajax_upload_gallery_url = add_query_arg('nonce', $property_upload_nonce, $property_ajax_upload_gallery_url);

			$property_ajax_upload_file_attachment_url = add_query_arg('action', 'file_attachment_upload', TF_AJAX_URL);
			$property_ajax_upload_file_attachment_url = add_query_arg('nonce', $property_upload_nonce, $property_ajax_upload_file_attachment_url);

			$property_variables = array(
				'plugin_url' => TF_PLUGIN_URL,
				'ajax_url' => TF_AJAX_URL,
				'ajax_url_upload_gallery' => $property_ajax_upload_gallery_url,
				'ajax_url_upload_file_attachment' => $property_ajax_upload_file_attachment_url,
				'upload_nonce' => $property_upload_nonce,
				'save_property_nonce' => $save_property_nonce,
				'file_type_title' => esc_html__('Valid file formats', 'tf-real-estate'),
				'max_property_images' => tfre_get_option('maximum_images', '20'),
				'image_max_file_size' => tfre_get_option('maximum_image_size', '1000kb'),
				'image_file_type' => tfre_get_option('image_types', 'jpg,jpeg,gif,png'),
				'max_property_attachments' => tfre_get_option('maximum_attachments', '5'),
				'attachment_max_file_size' => tfre_get_option('maximum_attachment_size', '1200kb'),
				'attachment_file_type' => tfre_get_option('attachment_types', 'pdf,txt,doc,docx,png'),
				'floor_name_text' => esc_html__('Floor Name', 'tf-real-estate'),
				'floor_size_text' => esc_html__('Floor Size', 'tf-real-estate'),
				'floor_size_postfix_text' => esc_html__('Floor Size Postfix', 'tf-real-estate'),
				'floor_bedrooms_text' => esc_html__('Floor Bedrooms', 'tf-real-estate'),
				'floor_bathrooms_text' => esc_html__('Floor Bathrooms', 'tf-real-estate'),
				'floor_price_text' => esc_html__('Floor Price', 'tf-real-estate'),
				'floor_price_postfix_text' => esc_html__('Floor Price Postfix', 'tf-real-estate'),
				'floor_image_text' => esc_html__('Floor Image', 'tf-real-estate'),
				'floor_description_text' => esc_html__('Floor Description', 'tf-real-estate'),
				'floor_upload_text' => esc_html__('Choose image', 'tf-real-estate'),
				'form_invalid_message' => esc_html__('Form Invalid', 'tf-real-estate'),
				'required_property_fields' => array(
					// Information
					'property_title' => tfre_check_required_field('property_title', 'required_property_fields'),
					'property_full_address' => tfre_check_required_field('property_full_address', 'required_property_fields'),
					'property_zip_code' => tfre_check_required_field('property_zip_code', 'required_property_fields'),
					'property_country' => tfre_check_required_field('property_country', 'required_property_fields'),
					'property_province_state' => tfre_check_required_field('property_province_state', 'required_property_fields'),
					'property_neighborhood' => tfre_check_required_field('property_neighborhood', 'required_property_fields'),
					// Price
					'property_price_value' => tfre_check_required_field('property_price_value', 'required_property_fields'),
					'property_price_unit' => tfre_check_required_field('property_price_unit', 'required_property_fields'),
					'property_price_to_call' => tfre_check_required_field('property_price_to_call', 'required_property_fields'),
					// Additional Information
					'property_type' => tfre_check_required_field('property-type', 'required_property_fields'),
					'property_status' => tfre_check_required_field('property-status', 'required_property_fields'),
					'property_label' => tfre_check_required_field('property-label', 'required_property_fields'),
					'property_size' => tfre_check_required_field('property_size', 'required_property_fields'),
					'property_land' => tfre_check_required_field('property_land', 'required_property_fields'),
					'property_rooms' => tfre_check_required_field('property_rooms', 'required_property_fields'),
					'property_bedrooms' => tfre_check_required_field('property_bedrooms', 'required_property_fields'),
					'property_bathrooms' => tfre_check_required_field('property_bathrooms', 'required_property_fields'),
					'property_garage' => tfre_check_required_field('property_garage', 'required_property_fields'),
					'property_garage_size' => tfre_check_required_field('property_garage_size', 'required_property_fields'),
					'property_year' => tfre_check_required_field('property_year', 'required_property_fields'),
					// Amenities
					'property_feature' => tfre_check_required_field('property-feature', 'required_property_fields'),
				),
				'map_service' => tfre_get_option('map_service'),
				'api_key_google_map' => tfre_get_option('google_map_api_key'),
				'api_key_map_box' => tfre_get_option('map_box_api_key'),
				'map_box_style' => tfre_get_option('map_box_style'),
				'map_zoom' => tfre_get_option('map_zoom'),
				'default_marker_image' => tfre_get_option('default_marker_image')['url'] != '' ? tfre_get_option('default_marker_image')['url'] : '',
				'marker_image_width' => tfre_get_option('marker_image_width') != '' ? tfre_get_option('marker_image_width') : '90px',
				'marker_image_height' => tfre_get_option('marker_image_height') != '' ? tfre_get_option('marker_image_height') : '119px',
				'confirm_remove_property_favorite' => esc_html__('Are you sure you want to remove this property from your favorites?', 'tf-real-estate'),
				'layout_archive_property' => tfre_get_option('layout_archive_property'),
				'item_style_layout_grid' => tfre_get_option('item_style_layout_grid'),
				'column_layout_grid' => tfre_get_option('column_layout_grid'),
				'item_style_layout_list' => tfre_get_option('item_style_layout_list'),
				'column_layout_list' => tfre_get_option('column_layout_list'),
				'icon_list' => TF_PLUGIN_URL . 'public/assets/image/icon/list.svg',
				'icon_map' => TF_PLUGIN_URL . 'public/assets/image/icon/map-white.svg',
				'currencySign'     => tfre_get_option( 'currency_sign', esc_html__( '$', 'tf-real-estate' ) ),
				'currencyPosition' => tfre_get_option( 'currency_sign_position', esc_html__( 'before', 'tf-real-estate' ) ),
			);

			// third-party
			wp_enqueue_script('plupload');
			wp_enqueue_script('owl.carousel', TF_PLUGIN_URL . 'public/assets/third-party/owl-carousel/owl.carousel.min.js', array(), '', 'all');
			wp_enqueue_script('light-gallery', TF_PLUGIN_URL . 'public/assets/third-party/light-gallery/lightgallery-all.js', array('jquery'), '', true);
			wp_enqueue_script('bootstrap-tabcollapse', TF_PLUGIN_URL . 'public/assets/third-party/bootstrap-tabcollapse/bootstrap-tabcollapse.js', array('jquery'), '', true);

			// property
			wp_enqueue_script('property-js', TF_PLUGIN_URL . 'public/assets/js/property.js', array('jquery', 'plupload'), false, true);
			wp_localize_script('property-js', 'property_variables', $property_variables);
			wp_register_script('loan-calculator', TF_PLUGIN_URL . 'public/templates/shortcodes/loan-calculator/assets/js/loan-calculator.js', array('jquery'), false, true);
			wp_register_script('related-properties', TF_PLUGIN_URL . 'public/templates/shortcodes/related-properties/assets/js/related-properties.js', array('jquery'), false, true);
			if (is_singular('real-estate')) {
				wp_register_script('nearby-places', TF_PLUGIN_URL . 'public/templates/shortcodes/nearby-places/assets/js/nearby-places.js', array('jquery'), false, true);
				$nearby_places_variables = array(
					'map_service' => tfre_get_option('map_service'),
					'api_key_map_box' => tfre_get_option('map_box_api_key'),
					'api_key_google_map' => tfre_get_option('google_map_api_key'),
				);
				wp_localize_script('nearby-places', 'nearby_places_variables', $nearby_places_variables);
			}
		}

		public function tfre_enqueue_property_styles()
		{
			wp_enqueue_style('property-css', TF_PLUGIN_URL . 'public/assets/css/property.css', array(), '', 'all');
			wp_enqueue_style('owl.carousel', TF_PLUGIN_URL . 'public/assets/third-party/owl-carousel/owl.carousel.min.css', array(), '', 'all');
			wp_enqueue_style('light-gallery', TF_PLUGIN_URL . 'public/assets/third-party/light-gallery/lightgallery.css', array(), '', 'all');
			if (is_singular('real-estate')) {
				wp_enqueue_style('nearby-places', TF_PLUGIN_URL . 'public/templates/shortcodes/nearby-places/assets/css/nearby-places.css', array(), '', 'all');
				wp_enqueue_style('loan-calculator', TF_PLUGIN_URL . 'public/templates/shortcodes/loan-calculator/assets/css/loan-calculator.css', array(), '', 'all');
			}
		}

		public function tfre_get_total_my_properties($post_status)
		{
			if (!is_user_logged_in())
				return;

			$args = array(
				'post_type' => 'real-estate',
				'post_status' => $post_status,
				'author' => get_current_user_id(),
			);
			if (current_user_can('administrator')) {
				$args['author'] = 0;
			}
			$properties = new WP_Query($args);
			wp_reset_postdata();
			return $properties->found_posts;
		}

		public function tfre_get_property_detail()
		{
			$property_id = $_POST['property_id'];
			$property = get_post($property_id);
			$prop_agent_info = get_post_meta($property_id, 'property_agent_info', true);
			$agent_post_meta_data = get_post_custom($prop_agent_info);
			$author_name = $prop_agent_info ? (isset($agent_post_meta_data['agent_full_name']) ? $agent_post_meta_data['agent_full_name'][0] : '') : get_the_author_meta('user_login', $property->post_author);
			$prop_address = get_post_meta($property_id, 'property_address', true);
			$prop_price_value = get_post_meta($property_id, 'property_price_value', true);
			$prop_price_unit = get_post_meta($property_id, 'property_price_unit', true);
			$prop_enable_short_price_unit = tfre_get_option('enable_short_price_unit', 0) == 1 ? true : false;
			$prop_price_prefix = get_post_meta($property_id, 'property_price_prefix', true);
			$prop_price_postfix = get_post_meta($property_id, 'property_price_postfix', true);
			$prop_size = get_post_meta($property_id, 'property_size', true) ? get_post_meta($property_id, 'property_size', true) : 0;
			$prop_land_area = get_post_meta($property_id, 'property_land', true) ? get_post_meta($property_id, 'property_land', true) : 0;
			$prop_rooms = get_post_meta($property_id, 'property_rooms', true) ? get_post_meta($property_id, 'property_rooms', true) : 0;
			$prop_bedrooms = get_post_meta($property_id, 'property_bedrooms', true) ? get_post_meta($property_id, 'property_bedrooms', true) : 0;
			$prop_bathrooms = get_post_meta($property_id, 'property_bathrooms', true) ? get_post_meta($property_id, 'property_bathrooms', true) : 0;
			$prop_garages = get_post_meta($property_id, 'property_garage', true) ? get_post_meta($property_id, 'property_garage', true) : 0;
			$prop_garages_size = get_post_meta($property_id, 'property_garage_size', true) ? get_post_meta($property_id, 'property_garage_size', true) : 0;
			$prop_size = get_post_meta($property_id, 'property_size', true) ? get_post_meta($property_id, 'property_size', true) : 0;
			$prop_year = get_post_meta($property_id, 'property_year', true) ? get_post_meta($property_id, 'property_year', true) : '';
			$prop_featured = get_post_meta($property_id, 'property_featured', true) ? get_post_meta($property_id, 'property_featured', true) : false;
			$prop_label = get_the_terms($property_id, 'property-label');
			$prop_gallery_images = get_post_meta($property_id, 'gallery_images', true) ? get_post_meta($property_id, 'gallery_images', true) : '';
			$property_gallery_Id = json_decode($prop_gallery_images);
			$list_gallery_images = array();
			foreach ($property_gallery_Id as $image_id) {
				$image_src = wp_get_attachment_image_src($image_id, 'large');
				if (is_array($image_src)) {
					$list_gallery_images[] = $image_src[0];
				}
			}
			$modal_content = ''; ?>
			<?php ob_start(); ?>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
					aria-hidden="true">&times;</span></button>
			<div class="popup-property-container">
				<div class="property-gallery">
					<div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff; margin-bottom: 10px"
						class="swiper-container main-swiper">
						<div class="swiper-wrapper">
							<?php foreach ($list_gallery_images as $key => $value): ?>
								<?php if ($key === 0): ?>
									<div class="swiper-slide"><img loading="lazy" src="<?php echo esc_attr($value); ?>"
											class="swiper-image tfre-light-gallery" alt="images"></div>
								<?php else: ?>
									<?php if ($toggle_lazy_load == 'on'): ?>
										<div class="swiper-slide"><img loading="lazy" data-src="<?php echo esc_attr($value); ?>"
												class="swiper-image lazy tfre-light-gallery" alt="images"></div>
									<?php else: ?>
										<div class="swiper-slide"><img loading="lazy" src="<?php echo esc_attr($value); ?>"
												class="swiper-image tfre-light-gallery" alt="images"></div>
									<?php endif; ?>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
					</div>
					<div class="swiper-container thumb-swiper">
						<div class="swiper-wrapper">
							<?php foreach ($list_gallery_images as $key => $value): ?>
								<?php if ($key === 0): ?>
									<div class="swiper-slide"><img loading="lazy" src="<?php echo esc_attr($value); ?>"
											class="swiper-image tfre-light-gallery" alt="images"></div>
								<?php else: ?>
									<?php if ($toggle_lazy_load == 'on'): ?>
										<div class="swiper-slide"><img loading="lazy" data-src="<?php echo esc_attr($value); ?>"
												class="swiper-image lazy tfre-light-gallery" alt="images"></div>
									<?php else: ?>
										<div class="swiper-slide"><img loading="lazy" src="<?php echo esc_attr($value); ?>"
												class="swiper-image tfre-light-gallery" alt="images"></div>
									<?php endif; ?>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
				<div class="property-content">
					<h2 class="property-title"><?php esc_html_e($property->post_title); ?>
					</h2>
					<?php if ($prop_featured == true): ?>
						<span class="featured-text"><?php esc_html_e('Featured', 'tf-real-estate'); ?></span>
					<?php endif; ?>
					<?php if (is_array($prop_label)): ?>
						<span class="sale-text"><?php esc_html_e($prop_label[0]->name, 'tf-real-estate'); ?></span>
					<?php endif; ?>
					<div class="tfre-property-price">
						<?php if ($prop_price_prefix !== ''): ?>
							<span class="tfre-prop-price-postfix"><?php echo esc_html($prop_price_prefix) ?></span>
						<?php endif; ?>
						<span
							class="tfre-prop-price-value"><?php echo esc_html(tfre_format_price($prop_price_value, $prop_price_unit, true, $prop_enable_short_price_unit)) ?></span>
						<?php if ($prop_price_postfix !== ''): ?>
							<span class="tfre-prop-price-postfix"> <?php echo esc_html($prop_price_postfix) ?></span>
						<?php endif; ?>
					</div>
					<div class="entry-meta">
						<?php if ($author_name != ''): ?>
							<span><i class="fal fa-user"></i> <?php esc_html_e($author_name, 'tf-real-estate') ?></span>
						<?php endif; ?>
						<?php if ($prop_address != ''): ?>
							<div>
								<i class="icon-dreamhome-location"></i>
								<span><?php echo esc_html($prop_address); ?></span>
							</div>
						<?php endif; ?>
						<?php if ($prop_year != ''): ?>
							<span class="year"><i class="icon-dreamhome-date"></i>
								<?php echo wp_kses_post(empty(tfre_get_option('enable_convert_year')) ? $prop_year : tfre_get_year_time($prop_year)); ?></span>
						<?php endif; ?>
					</div>
					<div class="description">
						<?php if ($prop_land_area != ''): ?>
							<div class="property-information">
								<i class="icon-dreamhome-size1"></i>
								<?php echo sprintf(esc_html(tfre_get_number_text($prop_land_area, esc_html__('Lands', 'tf-real-estate'), esc_html__('Land', 'tf-real-estate')) . ' %s', 'tf-real-estate'), '<span class="value">' . tfre_get_format_number(intval($prop_land_area)) . '</span>'); ?>
							</div>
						<?php endif; ?>
						<?php if ($prop_rooms != ''): ?>
							<div class="property-information">
								<i class="icon-dreamhome-door"></i>
								<?php echo sprintf(esc_html(tfre_get_number_text($prop_rooms, esc_html__('Rooms', 'tf-real-estate'), esc_html__('Room', 'tf-real-estate')) . ' %s', 'tf-real-estate'), '<span class="value">' . $prop_rooms . '</span>'); ?>
							</div>
						<?php endif; ?>
						<?php if ($prop_bedrooms != ''): ?>
							<div class="property-information">
								<i class="icons icon-bed"></i>
								<?php echo sprintf(esc_html(tfre_get_number_text($prop_bedrooms, esc_html__('Beds', 'tf-real-estate'), esc_html__('Bed', 'tf-real-estate')) . ' %s', 'tf-real-estate'), '<span class="value">' . $prop_bedrooms . '</span>'); ?>
							</div>
						<?php endif; ?>
						<?php if ($prop_bathrooms != ''): ?>
							<div class="property-information">
								<i class="icon-dreamhome-bath1"></i>
								<?php echo sprintf(esc_html(tfre_get_number_text($prop_bathrooms, esc_html__('Baths', 'tf-real-estate'), esc_html__('Bath', 'tf-real-estate')) . ' %s', 'tf-real-estate'), '<span class="value">' . $prop_bathrooms . '</span>'); ?>
							</div>
						<?php endif; ?>
						<?php if ($prop_size != ''): ?>
							<div class="property-information">
								<i class="icon-dreamhome-size1"></i>
								<?php echo sprintf(esc_html(tfre_get_number_text($prop_size, esc_html__('Sizes', 'tf-real-estate'), esc_html__('Size', 'tf-real-estate')) . ' %s', 'tf-real-estate'), '<span class="value">' . tfre_get_format_number(intval($prop_size)) . '</span>'); ?>
							</div>
						<?php endif; ?>
						<?php if ($prop_garages != ''): ?>
							<div class="property-information">
								<i class="icon-dreamhome-garage"></i>
								<?php echo sprintf(esc_html(tfre_get_number_text($prop_garages, esc_html__('Garages', 'tf-real-estate'), esc_html__('Garage', 'tf-real-estate')) . ' %s', 'tf-real-estate'), '<span class="value">' . $prop_garages . '</span>'); ?>
							</div>
						<?php endif; ?>
						<?php if ($prop_garages_size != ''): ?>
							<div class="property-information">
								<i class="icon-dreamhome-size1"></i>
								<?php echo sprintf(esc_html(tfre_get_number_text($prop_garages_size, esc_html__('Garage Sizes', 'tf-real-estate'), esc_html__('Garage Size', 'tf-real-estate')) . ' %s', 'tf-real-estate'), '<span class="value">' . tfre_get_format_number(intval($prop_garages_size)) . '</span>'); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php
			$modal_content = ob_get_clean();
			echo $modal_content;
			wp_die();
		}

		public function tfre_get_total_my_favorites()
		{
			if (!is_user_logged_in())
				return;

			$user_id = get_current_user_id();
			$my_favorites = get_user_meta($user_id, 'favorites_property', true);
			if (empty($my_favorites)) {
				$my_favorites = array(0);
			}
			$args = array(
				'post_type' => 'real-estate',
				'post__in' => $my_favorites
			);
			$favorites = new WP_Query($args);
			wp_reset_postdata();
			return $favorites->found_posts;
		}

		public function tfre_my_properties_shortcode()
		{
			$posts_per_page = tfre_get_option('item_per_page_my_properties', '10');
			$list_post_status = array(
				'publish' => esc_html__('publish', 'tf-real-estate'),
				'expired' => esc_html__('expired', 'tf-real-estate'),
				'pending' => esc_html__('pending', 'tf-real-estate'),
				'hidden' => esc_html__('hidden', 'tf-real-estate'),
				'sold' => esc_html__('sold', 'tf-real-estate')
			);
			$selected_post_status = $title_search = '';

			$title_search = !empty($_REQUEST['title_search']) ? wp_unslash($_REQUEST['title_search']) : '';

			$args = array(
				'post_type' => 'real-estate',
				'post_status' => $list_post_status,
				'posts_per_page' => $posts_per_page,
				'author' => get_current_user_id(),
				'offset' => (max(1, get_query_var('paged')) - 1) * $posts_per_page,
				'orderby' => 'date',
				'order' => 'desc',
				's' => $title_search,
			);

			if (current_user_can('administrator')) {
				$args['author'] = 0;
			}

			if (!empty($_REQUEST['post_status']) && $_REQUEST['post_status'] != 'default') {
				$selected_post_status = wp_unslash($_REQUEST['post_status']);
				$args['post_status'] = $selected_post_status;
			} else {
				$args['post_status'] = ['any', 'hidden', 'sold', 'expired'];
			}

			$properties = new WP_Query($args);

			ob_start();
			tfre_get_template_with_arguments(
				'property/my-property.php',
				array(
					'properties' => $properties->posts,
					'max_num_pages' => $properties->max_num_pages,
					'list_post_status' => $list_post_status,
					'selected_post_status' => $selected_post_status,
					'title_search' => $title_search,
				)
			);
			return ob_get_clean();
		}

		public function tfre_handle_actions_my_properties()
		{
			if (!empty($_REQUEST['action']) && !empty($_REQUEST['_wpnonce']) && wp_verify_nonce(wp_unslash($_REQUEST['_wpnonce']), 'tfre_my_properties_actions')) {
				$action = isset($_REQUEST['action']) ? wp_unslash($_REQUEST['action']) : '';
				$property_id = isset($_REQUEST['property_id']) ? absint(wp_unslash($_REQUEST['property_id'])) : '';
				$property = get_post($property_id);
				global $current_user;
				wp_get_current_user();
				$user_id = $current_user->ID;
				try {
					switch ($action) {
						case 'delete':
							wp_trash_post($property_id);
							// Alert Message
							$this->alert_message = '<div class="alert alert-success" role="alert">' . sprintf(wp_kses_post(__('<strong>Success!</strong> %s has been deleted', 'tf-real-estate')), $property->post_title) . '</div>';
							break;
						case 'hide':
							$data_update = array(
								'ID' => $property_id,
								'post_type' => 'real-estate',
								'post_status' => 'hidden'
							);
							wp_update_post($data_update);
							$this->alert_message = '<div class="alert alert-success" role="alert">' . sprintf(wp_kses_post(__('<strong>Success!</strong> %s has been hidden', 'tf-real-estate')), $property->post_title) . '</div>';
							break;
						case 'sold':
							$data_update = array(
								'ID' => $property_id,
								'post_type' => 'real-estate',
								'post_status' => 'sold'
							);
							wp_update_post($data_update);
							$this->alert_message = '<div class="alert alert-success" role="alert">' . sprintf(wp_kses_post(__('<strong>Success!</strong> %s has been sold', 'tf-real-estate')), $property->post_title) . '</div>';
							break;
						case 'show':
							$data = array(
								'ID' => $property_id,
								'post_type' => 'real-estate',
								'post_status' => 'publish'
							);
							wp_update_post($data);
							$this->alert_message = '<div class="alert alert-success" role="alert">' . sprintf(wp_kses_post(__('<strong>Success!</strong> %s has been publish', 'tf-real-estate')), $property->post_title) . '</div>';
							break;
						default:
							# code...
							break;
					}
				} catch (\Throwable $th) {
					//throw $th;
				}
			}
		}

		public function tfre_get_link_filter_post_status($post_status)
		{
			$link_filter = add_query_arg(array('post_status' => $post_status));
			return $link_filter;
		}

		public function tfre_save_property_shortcode()
		{
			if (tfre_get_option("map_service") == 'map-box') {
				$map_box_variables = array(
					'plugin_url' => TF_PLUGIN_URL,
					'ajax_url' => TF_AJAX_URL,
					'map_service' => tfre_get_option('map_service'),
					'api_key_google_map' => tfre_get_option('google_map_api_key'),
					'api_key_map_box' => tfre_get_option('map_box_api_key'),
					'map_box_style' => tfre_get_option('map_box_style'),
					'map_zoom' => tfre_get_option('map_zoom'),
					'default_marker_image' => tfre_get_option('default_marker_image')['url'] != '' ? tfre_get_option('default_marker_image')['url'] : '',
					'marker_image_width' => tfre_get_option('marker_image_width') != '' ? tfre_get_option('marker_image_width') : '90px',
					'marker_image_height' => tfre_get_option('marker_image_height') != '' ? tfre_get_option('marker_image_height') : '119px',
				);
				wp_enqueue_script('map-box-script', TF_PLUGIN_URL . 'public/assets/js/map-box.js', array('jquery'), false, true);
				wp_localize_script('map-box-script', 'map_box_variables', $map_box_variables);
			}

			$action = sanitize_url(wp_unslash($_SERVER['REQUEST_URI']));
			$mode = 'property-add';
			$submit_button_text = tfre_get_option('add_property_button_text', 'Add Property');
			if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['property_id'])) {
				$mode = 'property-edit';
				$submit_button_text = tfre_get_option('update_property_button_text', 'Update Property');
				$this->property_id = $_GET['property_id'];
			}

			ob_start();
			echo $this->alert_message;
			tfre_get_template_with_arguments(
				'property/save-property.php',
				array(
					'property_id' => $this->property_id,
					'action' => $action,
					'mode' => $mode,
					'submit_button_text' => esc_html__($submit_button_text, 'tf-real-estate'),
				)
			);
			return ob_get_clean();
		}

		public function tfre_check_user_has_permission_edit($property_id)
		{
			$permission_edit = true;

			if (!$property_id || !is_user_logged_in()) {
				$permission_edit = false;
			} else {
				$property = get_post($property_id);

				if (!$property || ($property->post_author !== get_current_user_id() && !current_user_can('edit_post', $property_id))) {
					$permission_edit = false;
				}
			}
			return $permission_edit;
		}

		public function tfre_property_image_upload_ajax()
		{
			$nonce = isset($_REQUEST['nonce']) ? wp_unslash($_REQUEST['nonce']) : '';
			if (!wp_verify_nonce($nonce, 'allow_upload_nonce')) {
				$response = array('success' => false, 'reason' => esc_html__('Check nonce failed!', 'tf-real-estate'));
				echo json_encode($response);
				wp_die();
			}

			$submitted_file = $_FILES['image_file_name'];

			$uploaded_image = wp_handle_upload($submitted_file, array('test_form' => false));

			if (isset($uploaded_image['file'])) {
				$file_name = basename($submitted_file['name']);
				$file_type = wp_check_filetype($uploaded_image['file']);
				$attachment_details = array(
					'guid' => $uploaded_image['url'],
					'post_mime_type' => $file_type['type'],
					'post_title' => preg_replace('/\.[^.]+$/', '', basename($file_name)),
					'post_content' => '',
					'post_status' => 'inherit'
				);

				$attach_id = wp_insert_attachment($attachment_details, $uploaded_image['file']);
				$attach_data = wp_generate_attachment_metadata($attach_id, $uploaded_image['file']);
				wp_update_attachment_metadata($attach_id, $attach_data);
				$thumbnail_url = wp_get_attachment_thumb_url($attach_id);
				$full_image_url = wp_get_attachment_image_src($attach_id, 'full');

				$response = array(
					'success' => true,
					'url' => $thumbnail_url,
					'attachment_id' => $attach_id,
					'full_image' => is_array($full_image_url) ? $full_image_url[0] : ''
				);
				echo json_encode($response);
				wp_die();

			} else {
				$response = array('success' => false, 'reason' => esc_html__('Upload failed!', 'tf-real-estate'));
				echo json_encode($response);
				wp_die();
			}
		}

		public function tfre_property_attachment_upload_ajax()
		{
			$nonce = isset($_REQUEST['nonce']) ? wp_unslash($_REQUEST['nonce']) : '';
			if (!wp_verify_nonce($nonce, 'allow_upload_nonce')) {
				$response = array('success' => false, 'reason' => esc_html__('Check nonce failed!', 'tf-real-estate'));
				echo json_encode($response);
				wp_die();
			}

			$submitted_file = $_FILES['file_attachments_name'];
			$file_attachment = wp_handle_upload($submitted_file, array('test_form' => false));

			if (isset($file_attachment['file'])) {
				$file_name = basename($submitted_file['name']);
				$file_type = wp_check_filetype($file_attachment['file']);


				$attachment_details = array(
					'guid' => $file_attachment['url'],
					'post_mime_type' => $file_type['type'],
					'post_title' => preg_replace('/\.[^.]+$/', '', basename($file_name)),
					'post_content' => '',
					'post_status' => 'inherit'
				);

				$attach_id = wp_insert_attachment($attachment_details, $file_attachment['file']);
				$attach_data = wp_generate_attachment_metadata($attach_id, $file_attachment['file']);
				wp_update_attachment_metadata($attach_id, $attach_data);
				$attach_url = wp_get_attachment_url($attach_id);
				$file_type_name = isset($file_type['ext']) ? $file_type['ext'] : '';
				$thumb_url = TF_PLUGIN_URL . 'public/assets/attachment/attach-' . $file_type_name . '.png';

				$response = array(
					'success' => true,
					'url' => $attach_url,
					'attachment_id' => $attach_id,
					'thumb_url' => $thumb_url,
					'file_name' => $file_name
				);
				echo json_encode($response);
				wp_die();

			} else {
				$response = array('success' => false, 'reason' => esc_html__('Upload file failed!', 'tf-real-estate'));
				echo json_encode($response);
				wp_die();
			}
		}

		public function tfre_delete_property_image_or_file_ajax()
		{
			$nonce = isset($_POST['deleteNonce']) ? wp_unslash($_POST['deleteNonce']) : '';
			if (!wp_verify_nonce($nonce, 'allow_upload_nonce')) {
				$response = array(
					'success' => false,
					'reason' => esc_html__('Security check fails', 'tf-real-estate')
				);
				echo json_encode($response);
				wp_die();
			}
			$success = false;
			if (isset($_POST['property_id']) && isset($_POST['attachment_id'])) {
				$property_id = absint(wp_unslash($_POST['property_id']));
				$type = isset($_POST['type']) ? wp_unslash($_POST['type']) : '';
				$attachment_id = absint(wp_unslash($_POST['attachment_id']));
				if ($property_id > 0) {
					if ($type === 'image') {
						delete_post_meta($property_id, 'property_images', $attachment_id);
					}
					if ($type === 'attachment') {
						delete_post_meta($property_id, 'property_attachments', $attachment_id);
					}
					$success = true;
				}
				if ($attachment_id > 0) {
					wp_delete_attachment($attachment_id);
					$success = true;
				}
			}
			$response = array(
				'success' => $success,
			);
			echo json_encode($response);
			wp_die();
		}

		public function tfre_save_property()
		{
			$tfre_allow_submit_property = tfre_allow_submit_property();
			if ($tfre_allow_submit_property) {
				$submit_mode = isset($_POST['property_mode']) ? wp_unslash($_POST['property_mode']) : '';
				$property_author = isset($_POST['property_author']) ? wp_unslash($_POST['property_author']) : '';
				$auto_publish_submitted = tfre_get_option('auto_publish_submitted', 'n');
				$auto_publish_edited = tfre_get_option('auto_publish_edited', 'n');
				$property = array();
				global $current_user;
				wp_get_current_user();
				$user_id = $current_user->ID;
				$property['post_author'] = $user_id;
				$property['post_type'] = 'real-estate';
				$property['post_status'] = 'pending';

				$submit_mode = isset($_POST['property_mode']) ? wp_unslash($_POST['property_mode']) : '';
				$property_author = isset($_POST['property_author']) ? absint(wp_unslash($_POST['property_author'])) : '';
				$property_id = 0;
				$user_package_public = new User_Package_Public();
				$check_package_available = $user_package_public->tfre_check_user_package_available($user_id);

				if (isset($_POST['property_title'])) {
					$property['post_title'] = wp_unslash($_POST['property_title']);
				}

				if (isset($_POST['property_description'])) {
					$property['post_content'] = wp_filter_post_kses($_POST['property_description']);
				}

				if ($submit_mode === 'property-add') {
					if ($auto_publish_submitted == 'y') {
						$property['post_status'] = 'publish';
					}
					if ($check_package_available != 0 || $check_package_available != -1 || $check_package_available != -2) {
						$property_id = wp_insert_post($property, true);
					}
					if ($property_id > 0) {
						$package_key = get_user_meta($user_id, 'package_key', true);
						update_post_meta($property_id, 'package_key', $package_key);
						$package_number_listing = get_user_meta($user_id, 'package_number_listing', true);
						$package_number_listing = intval($package_number_listing);
						if ($package_number_listing - 1 >= 0) {
							update_user_meta($user_id, 'package_number_listing', $package_number_listing - 1);
						}
					}
				} else if ($submit_mode === 'property-edit') {
					if ($auto_publish_edited == 'y') {
						$property['post_status'] = 'publish';
					}
					$property_id = absint(wp_unslash($_POST['property_id']));
					$property['ID'] = intval($property_id);
					if ($user_id == $property_author) {
						$property_id = wp_update_post($property);
					}
				}

				$this->property_id = $property_id;

				if ($property_id > 0) {
					if (isset($_POST['property_full_address'])) {
						update_post_meta($property_id, 'property_address', wp_unslash($_POST['property_full_address']));
					}

					if (isset($_POST['property_zip_code'])) {
						update_post_meta($property_id, 'property_zip', wp_unslash($_POST['property_zip_code']));
					}

					if (isset($_POST['property_country'])) {
						update_post_meta($property_id, 'property_country', wp_unslash($_POST['property_country']));
					}

					if (isset($_POST['property_province_state'])) {
						$property_province_state = wp_unslash($_POST['property_province_state']);
						wp_set_object_terms($property_id, $property_province_state, 'province-state');
					}

					if (isset($_POST['property_neighborhood'])) {
						$property_neighborhood = wp_unslash($_POST['property_neighborhood']);
						wp_set_object_terms($property_id, $property_neighborhood, 'neighborhood');
					}

					if (isset($_POST['property_location'])) {
						$property_property_location = wp_unslash($_POST['property_location']);
						update_post_meta($property_id, 'property_location', $property_property_location);
					}

					$property_price_to_call = isset($_POST['property_price_to_call']) ? true : false;
					update_post_meta($property_id, 'property_price_to_call', $property_price_to_call);

					if ($property_price_to_call) {
						update_post_meta($property_id, 'property_price_value', '');
						update_post_meta($property_id, 'property_price_unit', '1');
						update_post_meta($property_id, 'property_price_prefix', '');
						update_post_meta($property_id, 'property_price_postfix', '');
					} else {
						if (isset($_POST['property_price_value'])) {
							$property_price_value = wp_unslash($_POST['property_price_value']);
							update_post_meta($property_id, 'property_price_value', $property_price_value);
							if (is_numeric($property_price_value)) {
								if (isset($_POST['property_price_unit']) && is_numeric($_POST['property_price_unit'])) {
									$property_price_unit = absint(wp_unslash($_POST['property_price_unit']));
								} else {
									$property_price_unit = '1';
								}
								$property_price_value = doubleval($property_price_value);
								$property_price_value_multiplication_unit = doubleval($property_price_value) * intval($property_price_unit);
								update_post_meta($property_id, 'property_price_value', $property_price_value);
								update_post_meta($property_id, 'property_price_value_multiplication_unit', $property_price_value_multiplication_unit);
							} else {
								update_post_meta($property_id, 'property_price_value', '');
								update_post_meta($property_id, 'property_price_value_multiplication_unit', '');
							}
						}

						if (isset($_POST['property_price_unit'])) {
							$property_price_unit = isset($_POST['property_price_unit']) ? wp_unslash($_POST['property_price_unit']) : '1';
							update_post_meta($property_id, 'property_price_unit', $property_price_unit);
						}

						if (isset($_POST['property_price_prefix'])) {
							update_post_meta($property_id, 'property_price_prefix', wp_unslash($_POST['property_price_prefix']));
						}

						if (isset($_POST['property_price_postfix'])) {
							update_post_meta($property_id, 'property_price_postfix', wp_unslash($_POST['property_price_postfix']));
						}
					}

					$property_type = isset($_POST['property-type']) ? array_map('intval', wp_unslash($_POST['property-type'])) : null;
					wp_set_object_terms($property_id, $property_type, 'property-type');

					$property_status = isset($_POST['property-status']) ? array_map('intval', wp_unslash($_POST['property-status'])) : null;
					wp_set_object_terms($property_id, $property_status, 'property-status');

					$property_label = isset($_POST['property-label']) ? array_map('intval', wp_unslash($_POST['property-label'])) : null;
					wp_set_object_terms($property_id, $property_label, 'property-label');

					if (isset($_POST['property_size'])) {
						update_post_meta($property_id, 'property_size', wp_unslash($_POST['property_size']));
					}

					if (isset($_POST['property_land'])) {
						update_post_meta($property_id, 'property_land', wp_unslash($_POST['property_land']));
					}

					if (isset($_POST['property_rooms'])) {
						update_post_meta($property_id, 'property_rooms', wp_unslash($_POST['property_rooms']));
					}

					if (isset($_POST['property_bedrooms'])) {
						update_post_meta($property_id, 'property_bedrooms', wp_unslash($_POST['property_bedrooms']));
					}

					if (isset($_POST['property_bathrooms'])) {
						update_post_meta($property_id, 'property_bathrooms', wp_unslash($_POST['property_bathrooms']));
					}

					if (isset($_POST['property_garage'])) {
						update_post_meta($property_id, 'property_garage', wp_unslash($_POST['property_garage']));
					}

					if (isset($_POST['property_garage_size'])) {
						update_post_meta($property_id, 'property_garage_size', wp_unslash($_POST['property_garage_size']));
					}

					if (isset($_POST['property_year'])) {
						update_post_meta($property_id, 'property_year', wp_unslash($_POST['property_year']));
					}

					if (isset($_POST['property_identity']) && !empty($_POST['property_identity'])) {
						update_post_meta($property_id, 'property_identity', wp_unslash($_POST['property_identity']));
					} else {
						update_post_meta($property_id, 'property_identity', $property_id);
					}

					if (isset($_POST['property_featured'])) {
						$property_featured = $_POST['property_featured'] === 'on' ? true : false;
						update_post_meta($property_id, 'property_featured', $property_featured);
					}


					$property_feature = isset($_POST['property-feature']) ? wp_unslash($_POST['property-feature']) : '';
					if (is_array($property_feature)) {
						wp_set_object_terms($property_id, $property_feature, 'property-feature');
					}

					$gallery_images = isset($_POST['gallery_images']) ? wp_unslash($_POST['gallery_images']) : '';
					if (!empty($gallery_images) && is_array($gallery_images)) {
						update_post_meta($property_id, 'gallery_images', json_encode($gallery_images));
						update_post_meta($property_id, '_thumbnail_id', $gallery_images[0]);
					}

					$attachments_file = isset($_POST['attachments_file']) ? wp_unslash($_POST['attachments_file']) : '';
					if (!empty($attachments_file) && is_array($attachments_file)) {
						update_post_meta($property_id, 'attachments_file', json_encode($attachments_file));
					}

					if (isset($_POST['virtual_tour_type'])) {
						$property_virtual_tour_type = wp_unslash($_POST['virtual_tour_type']);
						update_post_meta($property_id, 'virtual_tour_type', $property_virtual_tour_type);

						if ($property_virtual_tour_type === '0') {
							$virtual_tour_embedded_code = isset($_POST['virtual_tour_embedded_code']) ? wp_unslash($_POST['virtual_tour_embedded_code']) : '';
							update_post_meta($property_id, 'virtual_tour_embedded_code', $virtual_tour_embedded_code);
						} else if ($property_virtual_tour_type === '1') {
							$virtual_tour_upload_image = isset($_POST['virtual_tour_upload_image']) ? wp_unslash($_POST['virtual_tour_upload_image']) : '';
							update_post_meta($property_id, 'virtual_tour_upload_image', $virtual_tour_upload_image);
						}
					} else {
						update_post_meta($property_id, 'virtual_tour_type', '0');
					}

					if (isset($_POST['video_url'])) {
						update_post_meta($property_id, 'video_url', wp_unslash($_POST['video_url']));
					}

					if (isset($_POST['floors_plan_toggle'])) {
						update_post_meta($property_id, 'floors_plan_toggle', wp_unslash($_POST['floors_plan_toggle']));
					}

					if (isset($_POST['floors_plan'])) {
						$floors_plan = ($_POST['floors_plan']);
						if (!empty($floors_plan)) {
							update_post_meta($property_id, 'floors_plan', $floors_plan);
						}
					}

					if (isset($_POST['property_additional_detail'])) {
						$property_additional_detail = $_POST['property_additional_detail'];
						if (!empty($property_additional_detail)) {
							update_post_meta($property_id, 'property_additional_detail', $property_additional_detail);
						}
					} else {
						update_post_meta($property_id, 'property_additional_detail', array());
					}

					$get_additional_fields = tfre_get_additional_fields();
					if (is_array($get_additional_fields) && count($get_additional_fields) > 0) {
						foreach ($get_additional_fields as $key => $field) {
							if (isset($_POST[$key])) {
								if ($field['type'] == 'textarea') {
									update_post_meta($property_id, $key, wp_filter_post_kses($_POST[$key]));
								} else if ($field['type'] == 'checkbox') {
									$arr_value = array();
									foreach ($_POST[$key] as $value) {
										$arr_value[] = $value;
									}
									update_post_meta($property_id, $key, $arr_value);
								} else {
									update_post_meta($property_id, $key, wp_unslash($_POST[$key]));
								}
							} else {
								if ($field['type'] == 'checkbox') {
									update_post_meta($property_id, $key, array());
								} else {
									update_post_meta($property_id, $key, '');
								}
							}
						}
					}

					$agent_id = get_user_meta($user_id, 'author_agent_id', true);
					update_post_meta($property_id, 'property_agent_info', $agent_id);
					if (isset($_POST['agent_information_options'])) {
						$property_agent_information_options = wp_unslash($_POST['agent_information_options']);
						update_post_meta($property_id, 'agent_information_options', $property_agent_information_options);

						if ($property_agent_information_options === 'other_info') {
							if (isset($_POST['property_other_agent_name'])) {
								update_post_meta($property_id, 'property_other_agent_name', wp_unslash($_POST['property_other_agent_name']));
							}
							if (isset($_POST['property_other_agent_email'])) {
								update_post_meta($property_id, 'property_other_agent_email', sanitize_email(wp_unslash($_POST['property_other_agent_email'])));
							}
							if (isset($_POST['property_other_agent_phone'])) {
								update_post_meta($property_id, 'property_other_agent_phone', wp_unslash($_POST['property_other_agent_phone']));
							}
							if (isset($_POST['property_other_agent_description'])) {
								update_post_meta($property_id, 'property_other_agent_description', wp_filter_post_kses($_POST['property_other_agent_description']));
							}
						}
					} else {
						update_post_meta($property_id, 'agent_information_options', 'agent_info');
					}
					return $property_id;
				}
			}

			return null;
		}

		public function tfre_handle_save_property_ajax()
		{
			$response = array(
				'status' => false,
				'message' => esc_html__('Error, try again!', 'tf-real-estate'),
			);
			header('Content-Type: application/json');
			$submit_mode = isset($_POST['property_mode']) ? wp_unslash($_POST['property_mode']) : '';
			if ($submit_mode === '') {
				return;
			}
			if (!is_user_logged_in()) {
				tfre_get_template_with_arguments('global/access-permission.php', array('type' => 'not_login'));
				return;
			}

			$nonce = isset($_REQUEST['nonce']) ? wp_unslash($_REQUEST['nonce']) : '';
			if (!wp_verify_nonce($nonce, 'save_property_nonce')) {
				$response = array('status' => false, 'message' => esc_html__('Check nonce failed!', 'tf-real-estate'));
				echo json_encode($response);
				wp_die();
			}

			$property_id = $this->tfre_save_property();
			if ($property_id) {
				$response['status'] = true;
				$response['message'] = esc_html__('Save property successfully!', 'tf-real-estate');
				$response['property_id'] = $property_id;
				$response['submit_mode'] = $submit_mode;
				$response['redirect_url'] = tfre_get_permalink('my_properties_page');
			} else {
				$response['status'] = false;
				$response['message'] = esc_html__('You are not permission!', 'tf-real-estate');
			}

			echo json_encode($response);
			wp_die();
		}

		public function tfre_property_favorite()
		{

			ob_start();
			tfre_get_template_with_arguments('property/favorite.php', array());
			echo ob_get_clean();
		}

		public function tfre_property_compare()
		{

			ob_start();
			tfre_get_template_with_arguments('property/compare-button.php', array());
			echo ob_get_clean();
		}


		public function tfre_listing_property()
		{
			$list_post_status = array('publish');
			$posts_per_page = tfre_get_option('item_per_page_my_properties', '10');
			$args = array(
				'post_type' => 'real-estate',
				'post_status' => $list_post_status,
				'orderby' => 'date',
				'order' => 'desc',
				'posts_per_page' => $posts_per_page
			);

			$properties = new WP_Query($args);

			ob_start();
			tfre_get_template_with_arguments(
				'property/list-property.php',
				array(
					'properties' => $properties,
					'list_post_status' => $list_post_status,
				)
			);
			return ob_get_clean();
		}

		public function tfre_favorite_ajax()
		{
			global $current_user;
			$property_id = isset($_POST['property_id']) ? absint(wp_unslash($_POST['property_id'])) : 0;
			wp_get_current_user();
			$user_id = $current_user->ID;
			$added = $removed = false;
			$response = '';
			if ($user_id > 0) {
				$my_favorites = get_user_meta($user_id, 'favorites_property', true);

				if (!empty($my_favorites) && (!in_array($property_id, $my_favorites))) {
					array_push($my_favorites, $property_id);
					$added = true;
				} else {
					if (empty($my_favorites)) {
						$my_favorites = array($property_id);
						$added = true;
					} else {
						$key = array_search($property_id, $my_favorites);
						if ($key !== false) {
							unset($my_favorites[$key]);
							$removed = true;
						}
					}
				}

				update_user_meta($user_id, 'favorites_property', $my_favorites);
				if ($added) {
					$response = array('added' => 1, 'message' => esc_html__('Added', 'tf-real-estate'));
				}
				if ($removed) {
					$response = array('added' => 0, 'message' => esc_html__('Removed', 'tf-real-estate'));
				}
			} else {
				$response = array(
					'added' => -1,
					'message' => esc_html__('To continue, you need to log in.', 'tf-real-estate')
				);
			}
			echo json_encode($response);
			wp_die();
		}

		public function tfre_set_views()
		{
			global $post;

			if (is_single() && (get_post_type() == 'real-estate')) {
				// Check if user login
				if (!is_user_logged_in()) {
					return;
				}
				$visited_posts = array();
				// Check cookie for list of visited posts
				$_ctp_property_views = isset($_COOKIE['ctp_property_views']) ? wp_unslash($_COOKIE['ctp_property_views']) : '';

				if (!empty($_ctp_property_views)) {
					$visited_posts = array_map('intval', explode(',', $_ctp_property_views));
				}

				// User already visited this post, don't count post view
				if (in_array($post->ID, $visited_posts)) {
					return;
				}

				// The visitor is reading this post first time in day, so we count
				$views = (int) get_post_meta($post->ID, 'property_views', true);
				$views = empty($views) ? 1 : $views++;
				update_post_meta($post->ID, 'property_views', $views + 1);

				// Add post id and set cookie for 12 hours
				$visited_posts[] = $post->ID;
				setcookie('ctp_property_views', implode(',', $visited_posts), time() + (3600 * 12), '/');

				// Set views for property in a day
				$today = date('Y-m-d', time());
				$view_by_date = get_post_meta($post->ID, 'property_views_by_date', true);

				if ($view_by_date != '' || is_array($view_by_date)) {
					if (!isset($view_by_date[$today])) {
						if (count($view_by_date) > 365) {
							array_shift($view_by_date);
						}
						$view_by_date[$today] = 1;
					} else {
						$view_by_date[$today] = intval($view_by_date[$today]) + 1;
					}
				} else {
					$view_by_date = array();
					$view_by_date[$today] = 1;
				}
				update_post_meta($post->ID, 'property_views_by_date', $view_by_date);
			}
		}

		public function tfre_properties_map_shortcode($atts)
		{
			extract(
				shortcode_atts(
					array(
						'layout_properties' => '',
						'search_form' => '',
						'map_position' => '',
						'sidebar' => '',
						'sidebar_position' => '',
						'items_per_page' => '',
						'column_properties_grid' => '',
						'column_properties_list' => '',
						'item_style_properties_grid' => '',
						'item_style_properties_list' => '',
					),
					$atts
				)
			);

			$list_order = array(
				'default' => esc_html__('Default sorting', 'tf-real-estate'),
				'featured' => esc_html__('Sort by featured First', 'tf-real-estate'),
				'latest' => esc_html__('Sort by latest', 'tf-real-estate'),
				'price' => esc_html__('Sort by price: low to high', 'tf-real-estate'),
				'price-desc' => esc_html__('Sort by price: high to low', 'tf-real-estate')
			);

			ob_start();
			tfre_get_template_with_arguments(
				'property/properties-map.php',
				array(
					'list_order' => $list_order,
					'layout_properties' => $layout_properties,
					'search_form' => $search_form,
					'map_position' => $map_position,
					'sidebar' => $sidebar,
					'sidebar_position' => $sidebar_position,
					'items_per_page' => $items_per_page,
					'column_properties_grid' => $column_properties_grid,
					'column_properties_list' => $column_properties_list,
					'item_style_properties_grid' => $item_style_properties_grid,
					'item_style_properties_list' => $item_style_properties_list,
				)
			);
			return ob_get_clean();
		}

		public function tfre_properties_switch_map_shortcode($atts)
		{
			extract(
				shortcode_atts(
					array(
						'layout_properties' => '',
						'items_per_page' => '',
						'column_properties_grid' => '',
						'item_style_properties_grid' => '',
					),
					$atts
				)
			);

			ob_start();
			tfre_get_template_with_arguments(
				'property/properties-switch-map.php',
				array(
					'layout_properties' => $layout_properties,
					'items_per_page' => $items_per_page,
					'column_properties_grid' => $column_properties_grid,
					'item_style_properties_grid' => $item_style_properties_grid,
				)
			);
			return ob_get_clean();
		}

		public function tfre_popup_filter_shortcode(){
			tfre_get_template_with_arguments(
				'shortcodes/popup-filter/popup-filter.php'
			);
		}

		public function tfre_popup_filter_modal_shortcode(){
			tfre_get_template_with_arguments('global/popup-filter-modal.php', array());
		}

		public function tfre_get_link_order_property($order)
		{
			$link_order = add_query_arg(array('orderBy' => $order));
			return $link_order;
		}

		public function tfre_single_property_gallery()
		{
			tfre_get_template_with_arguments('single-property/gallery.php');
		}

		public function tfre_single_property_header()
		{
			tfre_get_template_with_arguments('single-property/header.php');
		}

		public function tfre_single_property_overview()
		{
			tfre_get_template_with_arguments('single-property/overview.php');
		}

		public function tfre_single_property_description()
		{
			tfre_get_template_with_arguments('single-property/description.php');
		}

		public function tfre_single_property_detail()
		{
			tfre_get_template_with_arguments('single-property/property-detail.php');
		}
		public function tfre_single_property_features()
		{
			tfre_get_template_with_arguments('single-property/features.php');
		}
		public function tfre_single_property_location()
		{
			tfre_get_template_with_arguments('single-property/map-location.php');
		}

		public function tfre_single_property_floors()
		{
			global $post;
			$property_meta_data = get_post_custom($post->ID);
			$property_floors = get_post_meta($post->ID, 'floors_plan', true);
			$property_floors_plan_toggle = get_post_meta($post->ID, 'floors_plan_toggle', true);
			if ($property_floors) {
				tfre_get_template_with_arguments('single-property/floors.php', array('property_floors' => $property_floors, 'property_floors_plan_toggle' => $property_floors_plan_toggle));
			}
		}
		public function tfre_single_property_video_virtual()
		{
			tfre_get_template_with_arguments('single-property/video-virtual.php');
		}

		public function tfre_single_property_attachments()
		{
			tfre_get_template_with_arguments('single-property/attachments.php');
		}

		public function tfre_single_property_loan_calculator()
		{
			tfre_get_template_with_arguments('single-property/loan-calculator.php');
		}

		public function tfre_single_property_nearby_places()
		{
			tfre_get_template_with_arguments('single-property/nearby-places.php');
		}

		public function tfre_single_property_global_custom_section()
		{
			tfre_get_template_with_arguments('single-property/global-custom-section.php');
		}

		public function tfre_single_property_personal_custom_section()
		{
			tfre_get_template_with_arguments('single-property/personal-custom-section.php');
		}

		public function tfre_author_property_shortcode()
		{
			ob_start();
			include TF_THEME_PATH . '/shortcodes/author-contact/author-contact.php';
			return ob_get_clean();
		}

		public function tfre_loan_calculator_shortcode()
		{
			ob_start();
			include TF_THEME_PATH . '/shortcodes/loan-calculator/loan-calculator.php';
			return ob_get_clean();
		}

		public function tfre_nearby_places_shortcode()
		{
			ob_start();
			include TF_THEME_PATH . '/shortcodes/nearby-places/nearby-places.php';
			return ob_get_clean();
		}

		public function tfre_related_properties_shortcode($atts)
		{
			extract(shortcode_atts(array('current_property_id' => ''), $atts));
			ob_start();
			tfre_get_template_with_arguments(
				'/shortcodes/related-properties/related-properties.php',
				array('current_property_id' => $current_property_id)
			);
			return ob_get_clean();
		}

		public function tfre_filter_property_ajax()
		{
			$item_per_page_archive_property = tfre_get_option('item_per_page_archive_property', '-1');
			$args = array(
				'post_type' => 'real-estate',
				'posts_per_page' => $item_per_page_archive_property,
				'ignore_sticky_posts' => 1,
				'post_status' => 'publish',
			);

			// options
			$loadmore = filter_var(isset($_GET['loadmore']) ? wp_unslash($_GET['loadmore']) : false,FILTER_VALIDATE_BOOLEAN);
			$layout_archive_property = isset($_GET['layoutArchiveProperty']) ? wp_unslash($_GET['layoutArchiveProperty']) : tfre_get_option('layout_archive_property');
			$column_layout_default = $layout_archive_property == 'grid' ? tfre_get_option('column_layout_grid') : tfre_get_option('column_layout_list');
			$column_layout = isset($_GET['columnLayout']) ? wp_unslash($_GET['columnLayout']) : $column_layout_default;
			$item_style_layout_grid = tfre_get_option('item_style_layout_grid', '');
			$item_style_layout_list = tfre_get_option('item_style_layout_list', '');
			$css_class_col = 'col-md-4 col-sm-3 col-xs-12';

			if ($layout_archive_property == 'list') {
				$css_class_col = 'col-md-12';
			}

			if ($layout_archive_property == 'grid') {
				switch ($column_layout) {
					case '2':
						$css_class_col = 'col-xl-6 col-md-12';
						break;
					case '3':
						$css_class_col = 'col-xl-4 col-md-6';
						break;
					case '4':
						$css_class_col = 'col-xl-3 col-md-6';
						break;
					default:
						break;
				}
			}

			if ($layout_archive_property == 'grid') {
				$style_layout = $item_style_layout_grid;
			} else {
				$style_layout = $item_style_layout_list;
			}

			if (isset($_GET['queryData'])) {
				$query_data = sanitize_text_field($_GET['queryData']);
				parse_str($query_data, $parsed_data);
				$page = isset($parsed_data['page']) ? intval($parsed_data['page']) : '';
				$current_tax = isset($_GET['currentTax']) ? wp_unslash($_GET['currentTax']) : '';
				$current_term = isset($_GET['currentTerm']) ? wp_unslash($_GET['currentTerm']) : '';
				if ($page > 0) {
					$args['paged'] = $page;
				}

				$taxonomy_query = $metabox_query = array();
				$taxonomies = array(
					'property-type',
					'property-status',
					'property-feature',
					'property-label',
					'province-state',
					'neighborhood',
				);

				if ($current_tax != '' && $current_term != '') {
					if (!array_key_exists($current_tax, $parsed_data)) {
						$this->add_taxonomy_query($taxonomy_query, $current_tax, $current_term);
					}
				}

				foreach ($parsed_data as $key => $value) {
					switch ($key) {
						case 'min-price':
						case 'max-price':
							$this->add_price_query($metabox_query, $value, $key);
							break;
						case 'min-size':
							$this->add_numeric_meta_query($metabox_query, $value, 'property_size', '>=');
							break;
						case 'max-size':
							$this->add_numeric_meta_query($metabox_query, $value, 'property_size', '<=');
							break;
						case 'min-land-size':
							$this->add_numeric_meta_query($metabox_query, $value, 'property_land', '>=');
							break;
						case 'max-land-size':
							$this->add_numeric_meta_query($metabox_query, $value, 'property_land', '<=');
							break;
						case 'min-garages-size':
							$this->add_numeric_meta_query($metabox_query, $value, 'property_garage_size', '>=');
							break;
						case 'max-garage-size':
							$this->add_numeric_meta_query($metabox_query, $value, 'property_garage_size', '<=');
							break;
						case 'country':
							$this->add_meta_query($metabox_query, $value, 'CHAR', 'property_country', 'LIKE');
							break;
						case 'address':
							$this->add_meta_query($metabox_query, $value, 'CHAR', 'property_address', 'LIKE');
							break;
						case 'rooms':
							$this->add_numeric_meta_query($metabox_query, $value, 'property_rooms', '=');
							break;
						case 'bathrooms':
							$this->add_numeric_meta_query($metabox_query, $value, 'property_bathrooms', '=');
							break;
						case 'bedrooms':
							$this->add_numeric_meta_query($metabox_query, $value, 'property_bedrooms', '=');
							break;
						case 'type':
							$this->add_taxonomy_query($taxonomy_query, 'property-type', $value);
							break;
						case 'status':
							$this->add_taxonomy_query($taxonomy_query, 'property-status', $value);
							break;
						case 'label':
							$this->add_taxonomy_query($taxonomy_query, 'property-label', $value);
							break;
						case 'features':
							$this->add_taxonomy_query($taxonomy_query, 'property-feature', $value);
							break;
						case 'state':
							$this->add_taxonomy_query($taxonomy_query, 'province-state', $value);
							break;
						case 'neighborhood':
							$this->add_taxonomy_query($taxonomy_query, 'neighborhood', $value);
							break;
						case 'orderBy':
							switch ($value) {
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
							break;
						case 'keyword':
							if ($value !== '') {
								$keyword_field = tfre_get_option('search_criteria_keyword_field', 'criteria_address');

								$value = sanitize_text_field($value);
								if ($keyword_field === 'criteria_address') {
									$keyword_array = array(
										'relation' => 'OR',
										array(
											'key' => 'property_address',
											'value' => $value,
											'type' => 'CHAR',
											'compare' => 'LIKE',
										),
										array(
											'key' => 'property_zip',
											'value' => $value,
											'type' => 'CHAR',
											'compare' => 'LIKE',
										),
										array(
											'key' => 'property_identity',
											'value' => $value,
											'type' => 'CHAR',
											'compare' => '=',
										)
									);
									$args['p'] = $value;
								} else if ($keyword_field === 'criteria_state') {
									$tax_location[] = sanitize_title($value);
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
									$args['s'] = $value;
								}
							}
							break;
						case 'title':
							$value = sanitize_text_field($value);
							$args['s'] = $value;
							break;
						default:
							if (in_array($key, $taxonomies)) {
								$this->add_taxonomy_query($taxonomy_query, $key, $value);
							}
							break;
					}
				}

				$this->apply_tax_and_meta_queries($args, $taxonomy_query, $metabox_query, $keyword_array);

				$query = new WP_Query($args);
				$total_post = $query->found_posts;
				$post_count = $query->post_count;
				$total = $query->max_num_pages;
				$response = array();
				if ($query->have_posts()) {
					ob_start();
					while ($query->have_posts()):
						$query->the_post();
						$property_id = get_the_ID();
						$attach_id = get_post_thumbnail_id();
						$class_image_map = 'tfre-image-map';
						tfre_get_template_with_arguments(
							'property/card-item-property/' . $layout_archive_property . '/' . $style_layout . '.php',
							array(
								'property_id' => $property_id,
								'attach_id' => $attach_id,
								'css_class_col' => $css_class_col,
								'class_image_map' => $class_image_map,
							)
						);
					?>
					<?php endwhile;
					if($loadmore){
						if($total > 0){
							echo '<div class="wrapper-btn-load-more"><a class="tf-btn btn-load-more">'.esc_html__('Load More', 'tf-real-estate').'</a></div>';
						}
					}else{
						tfre_pagination_ajax($query, $page);
					}
					
					$html = ob_get_clean();
					$response = array(
						'html' => $html,
						'total_post' => $total_post,
						'post_count' => $post_count
					);
					wp_send_json($response);

				?>
				<?php } else {
					if($loadmore){
						$response = array(
							'no_item_found' => true,
							'message' => sprintf('<div class="properties-empty"><p class="item-not-found"> %s </p><p class="item-another"> %s </p><a href="javascript:void(0)" class="btn-clear-all">Reset Filters</a></div>', esc_html('Not found any properties based on your filter', 'tf-real-estate'), esc_html('Try another filter, location or keywords', 'tf-real-estate')),
						);
					}else{
						$response = array(
							'message' => sprintf('<div class="properties-empty"><p class="item-not-found"> %s </p><p class="item-another"> %s </p><a href="javascript:void(0)" class="btn-clear-all">Reset Filters</a></div>', esc_html('Not found any properties based on your filter', 'tf-real-estate'), esc_html('Try another filter, location or keywords', 'tf-real-estate')),
						);
					}
					wp_send_json($response);
				}
				wp_die();
			}
		}

		public function tfre_load_more_property_ajax()
		{
			$item_per_page_archive_property = tfre_get_option('item_per_page_archive_property', '-1');
			$args = array(
				'post_type' => 'real-estate',
				'posts_per_page' => $item_per_page_archive_property,
				'ignore_sticky_posts' => 1,
				'post_status' => 'publish',
				'offset'=> (max(1, $_GET['currentPage']) - 1) * $item_per_page_archive_property,
				'paged' => $_GET['currentPage'],
			);

			// options
			$loadmore = filter_var(isset($_GET['loadmore']) ? wp_unslash($_GET['loadmore']) : false,FILTER_VALIDATE_BOOLEAN);
			$layout_archive_property = isset($_GET['layoutArchiveProperty']) ? wp_unslash($_GET['layoutArchiveProperty']) : tfre_get_option('layout_archive_property');
			$column_layout_default = $layout_archive_property == 'grid' ? tfre_get_option('column_layout_grid') : tfre_get_option('column_layout_list');
			$column_layout = isset($_GET['columnLayout']) ? wp_unslash($_GET['columnLayout']) : $column_layout_default;
			$item_style_layout_grid = tfre_get_option('item_style_layout_grid', '');
			$item_style_layout_list = tfre_get_option('item_style_layout_list', '');
			$css_class_col = 'col-md-4 col-sm-3 col-xs-12';

			if ($layout_archive_property == 'list') {
				$css_class_col = 'col-md-12';
			}

			if ($layout_archive_property == 'grid') {
				switch ($column_layout) {
					case '2':
						$css_class_col = 'col-xl-6 col-md-12';
						break;
					case '3':
						$css_class_col = 'col-xl-4 col-md-6';
						break;
					case '4':
						$css_class_col = 'col-xl-3 col-md-6';
						break;
					default:
						break;
				}
			}

			if ($layout_archive_property == 'grid') {
				$style_layout = $item_style_layout_grid;
			} else {
				$style_layout = $item_style_layout_list;
			}

			if (isset($_GET['queryData'])) {
				$query_data = sanitize_text_field($_GET['queryData']);
				parse_str($query_data, $parsed_data);
				$page = isset($parsed_data['page']) ? intval($parsed_data['page']) : '';
				$current_tax = isset($_GET['currentTax']) ? wp_unslash($_GET['currentTax']) : '';
				$current_term = isset($_GET['currentTerm']) ? wp_unslash($_GET['currentTerm']) : '';
				if ($page > 0) {
					$args['paged'] = $page;
				}

				$taxonomy_query = $metabox_query = array();
				$taxonomies = array(
					'property-type',
					'property-status',
					'property-feature',
					'property-label',
					'province-state',
					'neighborhood',
				);

				if ($current_tax != '' && $current_term != '') {
					if (!array_key_exists($current_tax, $parsed_data)) {
						$this->add_taxonomy_query($taxonomy_query, $current_tax, $current_term);
					}
				}

				foreach ($parsed_data as $key => $value) {
					switch ($key) {
						case 'min-price':
						case 'max-price':
							$this->add_price_query($metabox_query, $value, $key);
							break;
						case 'min-size':
							$this->add_numeric_meta_query($metabox_query, $value, 'property_size', '>=');
							break;
						case 'max-size':
							$this->add_numeric_meta_query($metabox_query, $value, 'property_size', '<=');
							break;
						case 'min-land-size':
							$this->add_numeric_meta_query($metabox_query, $value, 'property_land', '>=');
							break;
						case 'max-land-size':
							$this->add_numeric_meta_query($metabox_query, $value, 'property_land', '<=');
							break;
						case 'min-garages-size':
							$this->add_numeric_meta_query($metabox_query, $value, 'property_garage_size', '>=');
							break;
						case 'max-garage-size':
							$this->add_numeric_meta_query($metabox_query, $value, 'property_garage_size', '<=');
							break;
						case 'country':
							$this->add_meta_query($metabox_query, $value, 'CHAR', 'property_country', 'LIKE');
							break;
						case 'address':
							$this->add_meta_query($metabox_query, $value, 'CHAR', 'property_address', 'LIKE');
							break;
						case 'rooms':
							$this->add_numeric_meta_query($metabox_query, $value, 'property_rooms', '=');
							break;
						case 'bathrooms':
							$this->add_numeric_meta_query($metabox_query, $value, 'property_bathrooms', '=');
							break;
						case 'bedrooms':
							$this->add_numeric_meta_query($metabox_query, $value, 'property_bedrooms', '=');
							break;
						case 'type':
							$this->add_taxonomy_query($taxonomy_query, 'property-type', $value);
							break;
						case 'status':
							$this->add_taxonomy_query($taxonomy_query, 'property-status', $value);
							break;
						case 'label':
							$this->add_taxonomy_query($taxonomy_query, 'property-label', $value);
							break;
						case 'features':
							$this->add_taxonomy_query($taxonomy_query, 'property-feature', $value);
							break;
						case 'state':
							$this->add_taxonomy_query($taxonomy_query, 'province-state', $value);
							break;
						case 'neighborhood':
							$this->add_taxonomy_query($taxonomy_query, 'neighborhood', $value);
							break;
						case 'orderBy':
							switch ($value) {
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
							break;
						case 'keyword':
							if ($value !== '') {
								$keyword_field = tfre_get_option('search_criteria_keyword_field', 'criteria_address');

								$value = sanitize_text_field($value);
								if ($keyword_field === 'criteria_address') {
									$keyword_array = array(
										'relation' => 'OR',
										array(
											'key' => 'property_address',
											'value' => $value,
											'type' => 'CHAR',
											'compare' => 'LIKE',
										),
										array(
											'key' => 'property_zip',
											'value' => $value,
											'type' => 'CHAR',
											'compare' => 'LIKE',
										),
										array(
											'key' => 'property_identity',
											'value' => $value,
											'type' => 'CHAR',
											'compare' => '=',
										)
									);
									$args['p'] = $value;
								} else if ($keyword_field === 'criteria_state') {
									$tax_location[] = sanitize_title($value);
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
									$args['s'] = $value;
								}
							}
							break;
						case 'title':
							$value = sanitize_text_field($value);
							$args['s'] = $value;
							break;
						default:
							if (in_array($key, $taxonomies)) {
								$this->add_taxonomy_query($taxonomy_query, $key, $value);
							}
							break;
					}
				}

				$this->apply_tax_and_meta_queries($args, $taxonomy_query, $metabox_query, $keyword_array);

				$query = new WP_Query($args);
				$total_post = $query->found_posts;
				$post_count = $query->post_count;
				$total = $query->max_num_pages;
				$response = array();
				if ($query->have_posts()) {
					ob_start();
					while ($query->have_posts()):
						$query->the_post();
						$property_id = get_the_ID();
						$attach_id = get_post_thumbnail_id();
						$class_image_map = 'tfre-image-map';
						tfre_get_template_with_arguments(
							'property/card-item-property/' . $layout_archive_property . '/' . $style_layout . '.php',
							array(
								'property_id' => $property_id,
								'attach_id' => $attach_id,
								'css_class_col' => $css_class_col,
								'class_image_map' => $class_image_map,
							)
						);
					?>
					<?php endwhile;
					if($loadmore){
						if($_GET['currentPage'] < $total){
							echo '<div class="wrapper-btn-load-more"><a class="tf-btn btn-load-more">'.esc_html__('Load More', 'tf-real-estate').'</a></div>';
						}
					}else{
						tfre_pagination_ajax($query, $page);
					}
					
					$html = ob_get_clean();
					$response = array(
						'html' => $html,
						'total_post' => $total_post,
						'post_count' => $post_count
					);
					wp_send_json($response);

				?>
				<?php } else {
					if($loadmore){
						$response = array(
							'no_item_found' => true,
							'message' => sprintf('<div class="properties-empty"><p class="item-not-found"> %s </p><p class="item-another"> %s </p><a href="javascript:void(0)" class="btn-clear-all">Reset Filters</a></div>', esc_html('Not found any properties based on your filter', 'tf-real-estate'), esc_html('Try another filter, location or keywords', 'tf-real-estate')),
						);
					}else{
						$response = array(
							'message' => sprintf('<div class="properties-empty"><p class="item-not-found"> %s </p><p class="item-another"> %s </p><a href="javascript:void(0)" class="btn-clear-all">Reset Filters</a></div>', esc_html('Not found any properties based on your filter', 'tf-real-estate'), esc_html('Try another filter, location or keywords', 'tf-real-estate')),
						);
					}
					
					wp_send_json($response);
				}
				wp_die();
			}
		}

		public function add_price_query(&$metabox_query, $value, $key)
		{
			$price = doubleval(sanitize_text_field($value));
			if ($price >= 0) {
				if ($key === 'min-price') {
					$metabox_query[] = array(
						'key' => 'property_price_value_multiplication_unit',
						'value' => $price,
						'type' => 'NUMERIC',
						'compare' => '>=',
					);
				} elseif ($key === 'max-price') {
					$metabox_query[] = array(
						'key' => 'property_price_value_multiplication_unit',
						'value' => $price,
						'type' => 'NUMERIC',
						'compare' => '<=',
					);
				}
			}
		}

		public function add_meta_query(&$metabox_query, $value, $type, $query_key, $compare)
		{
			$meta_value = sanitize_text_field($value);
			if ($meta_value) {
				$metabox_query[] = array(
					'key' => $query_key,
					'value' => $meta_value,
					'type' => $type,
					'compare' => $compare,
				);
			}
		}

		public function add_numeric_meta_query(&$metabox_query, $value, $query_key, $compare)
		{
			$numeric_value = doubleval(sanitize_text_field($value));
			if ($numeric_value >= 0) {
				$metabox_query[] = array(
					'key' => $query_key,
					'value' => $numeric_value,
					'type' => 'NUMERIC',
					'compare' => $compare,
				);
			}
		}

		public function add_taxonomy_query(&$taxonomy_query, $taxonomy, $value)
		{
			$taxonomy_value = sanitize_text_field($value);
			if (!empty($taxonomy_value) && $taxonomy_value !== 'all') {
				$taxonomy = str_replace('_', '-', $taxonomy);
				if ($taxonomy == 'property-feature') {
					if (!empty($taxonomy_value)) {
						$features = explode(',', $taxonomy_value);
						$features_taxonomy_queries = array('relation' => 'OR');
						foreach ($features as $feature) {
							$features_taxonomy_queries[] = array(
								'taxonomy' => $taxonomy,
								'field' => 'slug',
								'terms' => $feature,
								'operator' => 'IN'
							);
						}
						$taxonomy_query[] = $features_taxonomy_queries;
					}
				} else {
					$taxonomy_query[] = array(
						'taxonomy' => $taxonomy,
						'field' => 'slug',
						'terms' => $taxonomy_value,
					);
				}
			}
		}

		public function add_featured_query(&$metabox_query, $value)
		{
			$featured = filter_var($value, FILTER_VALIDATE_BOOLEAN);
			if ($featured) {
				$metabox_query[] = array(
					'key' => 'car_featured',
					'value' => true,
					'compare' => '=',
				);
			}
		}

		public function apply_tax_and_meta_queries(&$args, &$taxonomy_query, &$metabox_query, $keyword_array)
		{
			$taxonomy_count = count($taxonomy_query);
			if ($taxonomy_count > 0) {
				$args['tax_query'] = array(
					'relation' => 'AND',
					$taxonomy_query,
				);
			}

			$metabox_count = count($metabox_query);
			if ($metabox_count > 0) {
				$args['meta_query'] = array(
					'relation' => 'AND',
					$keyword_array,
					array(
						'relation' => 'AND',
						$metabox_query,
					),
				);
			}
		}
	}
}