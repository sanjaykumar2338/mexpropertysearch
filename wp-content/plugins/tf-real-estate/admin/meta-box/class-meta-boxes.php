<?php
/**
 * Register meta box options for the post types
 * 
 * @return  void
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if ( ! class_exists( 'Meta_Boxes' ) ) {
	class Meta_Boxes {
		public $meta_boxes;
		public $options;
		public $controls;
		public $label;
		public $id;
		public $context;
		public $priority;
		public $sections;
		public $post_types;
		public $type;
		public $callback;

		public function __construct( $args ) {
			foreach ( array_keys( get_object_vars( $this ) ) as $key ) {
				if ( isset( $args[ $key ] ) )
					$this->$key = $args[ $key ];
			}

			$this->options = isset( $this->options ) ? $this->options : array();

			foreach ( $this->options as $key => $_options ) {
				$_options['id']                           = $key;
				$this->controls[ $_options['section'] ][] = $_options;
			}
			$this->tfre_hook();
			$this->tfre_setup();
		}

		public function tfre_hook() {
			global $typenow;
			wp_enqueue_script( 'wp-plupload' );
			wp_enqueue_style( 'wp-color-picker' );
			add_action( 'save_post', array( $this, 'tfre_save_meta_boxes' ) );
			if ( $typenow == 'invoice' ) {
				add_action( 'save_post', array( $this, 'tfre_save_invoices_meta_boxes' ), 20, 2 );
			}
		}

		public function tfre_setup() {
			$callback = ( isset( $this->callback ) ? array( $this, $this->callback ) : array( $this, 'tfre_render' ) );
			$context  = ( isset( $this->context ) ? $this->context : 'normal' );
			$priority = ( isset( $this->priority ) ? $this->priority : 'default' );
			add_meta_box(
				$this->id,
				$this->label,
				$callback,
				$this->post_types,
				$context,
				$priority
			);
		}

		public function tfre_render_invoice_meta_boxes( $object ) {
			$invoice_payment_method = get_post_meta( $object->ID, 'invoice_payment_method', true );
			$invoice_payment_type   = get_post_meta( $object->ID, 'invoice_payment_type', true );
			$invoice_payment_status = get_post_meta( $object->ID, 'invoice_payment_status', true );
			$package_id             = get_post_meta( $object->ID, 'invoice_package_id', true );
			$package_name           = get_the_title( $package_id );
			$invoice_price          = get_post_meta( $object->ID, 'invoice_price', true );
			$invoice_purchase_date  = get_post_meta( $object->ID, 'invoice_purchase_date', true );
			$invoice_buyer_id       = get_post_meta( $object->ID, 'invoice_buyer_id', true );
			?>
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><?php esc_html_e( 'Invoice ID:', 'tf-real-estate' ); ?></th>
						<td><strong><?php echo esc_html( intval( $object->ID ) ); ?></strong></td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Payment Status:', 'tf-real-estate' ); ?></th>
						<td><?php
						wp_nonce_field( plugin_basename( __FILE__ ), 'invoice_nonce_field' );
						if ( $invoice_payment_status == 0 ) {
							echo '<span class="notice inline notice-warning notice-alt">' . esc_html__( 'Not Paid', 'tf-real-estate' ) . '</span>';
						} else {
							echo '<span class="notice inline notice-success notice-alt">' . esc_html__( 'Paid', 'tf-real-estate' ) . '</span>';
						}
						if ( $invoice_payment_status == 0 ) {
							?>
								<span class="set-item-paid">
									<input type="checkbox" id="payment_status" name="payment_status" value="0" />
									<label class=""
										for="payment_status"><?php esc_html_e( 'Set item paid', 'tf-real-estate' ); ?></label>
								</span>
							<?php }
						?>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Payment Method:', 'tf-real-estate' ); ?></th>
						<td>
							<strong>
								<?php echo esc_html( Invoice_Public::tfre_get_invoice_payment_method( $invoice_payment_method ) ); ?>
							</strong>
						</td>
					</tr>

					<tr>
						<th scope="row"><?php esc_html_e( 'Package Name:', 'tf-real-estate' ); ?></th>
						<td>
							<strong><?php echo esc_html( $package_name ); ?></strong>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php

						if ( $invoice_payment_type == 'package' ) {
							esc_html_e( 'Package ID:', 'tf-real-estate' );
						} else {
							esc_html_e( 'Property ID:', 'tf-real-estate' );
						}
						?>
						</th>
						<td>
							<strong><?php echo esc_html( $package_id ); ?></strong>
							<?php
							if ( $invoice_payment_type == 'package' ) {
								?>
								<a
									href="<?php echo esc_url( get_edit_post_link( $package_id ) ) ?>"><?php esc_html_e( '(Edit)', 'tf-real-estate' ); ?></a>
								<?php
							}
							?>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Package Price:', 'tf-real-estate' ); ?></th>
						<td>
							<strong><?php
							echo wp_kses_post( tfre_get_format_number( floatval( $invoice_price ) ) );
							?></strong>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Purchase Date:', 'tf-real-estate' ); ?>
						</th>
						<td>
							<strong><?php echo esc_html( $invoice_purchase_date ); ?></strong>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Buyer Name:', 'tf-real-estate' ); ?></th>
						<td>
							<strong>
								<?php
								$user_info = get_userdata( $invoice_buyer_id );
								if ( current_user_can( 'edit_users' ) && $user_info ) {
									echo '<a href="' . esc_url( get_edit_user_link( $invoice_buyer_id ) ) . '">' . esc_html( $user_info->display_name ) . '</a>';
								} else {
									if ( $user_info ) {
										echo esc_html( $user_info->display_name );
									}
								}
								?>
							</strong>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Buyer Mobile:', 'tf-real-estate' ); ?></th>
						<td>
							<strong>
								<?php
								$agent_phone_number = get_the_author_meta( 'agent_phone_number', $invoice_buyer_id );
								echo esc_html( $agent_phone_number );
								?>
							</strong>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Buyer Email:', 'tf-real-estate' ); ?></th>
						<td>
							<strong>
								<?php if ( $user_info ) {
									echo esc_html( $user_info->user_email );
								} ?>
							</strong>
						</td>
					</tr>
				</tbody>
			</table>
			<?php
		}

		public function tfre_render_user_package_meta_boxes( $object ) {
			$user_id                 = get_post_meta( $object->ID, 'package_user_id', true );
			$package_id              = get_user_meta( $user_id, 'package_id', true );
			$package_number_listings = get_user_meta( $user_id, 'package_number_listing', true );
			$package_activate_date   = get_user_meta( $user_id, 'package_activate_date', true );
			$user_package_public     = new User_Package_Public();
			$package_expired_date    = $user_package_public->tfre_get_expired_date( $package_id, $user_id );
			$package_name            = get_the_title( $package_id );
			$user_info               = get_userdata( $user_id );
			?>
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><?php esc_html_e( 'Package:', 'tf-real-estate' ); ?></th>
						<td><strong><?php echo esc_html( $package_name ); ?></strong></td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Number Listings:', 'tf-real-estate' ); ?></th>
						<td>
							<strong>
								<?php
								if ( $package_number_listings == -1 ) {
									esc_html_e( 'Unlimited', 'tf-real-estate' );
								} else {
									echo esc_html( $package_number_listings );
								}
								?>
							</strong>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Activate Date:', 'tf-real-estate' ); ?></th>
						<td>
							<strong><?php echo esc_html( $package_activate_date ); ?></strong>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Expire Date:', 'tf-real-estate' ); ?></th>
						<td>
							<strong><?php echo esc_html( $package_expired_date ); ?></strong>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Buyer Name:', 'tf-real-estate' ); ?></th>
						<td>
							<strong>
								<?php
								if ( current_user_can( 'edit_users' ) && $user_info ) {
									echo '<a href="' . esc_url( get_edit_user_link( $user_id ) ) . '">' . esc_html( $user_info->display_name ) . '</a>';
								} else {
									if ( $user_info ) {
										echo esc_html( $user_info->display_name );
									}
								}
								?>
							</strong>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Buyer Mobile:', 'tf-real-estate' ); ?></th>
						<td>
							<strong>
								<?php
								$agent_phone_number = get_the_author_meta( 'agent_phone_number', $user_id );
								echo esc_html( $agent_phone_number );
								?>
							</strong>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Buyer Email:', 'tf-real-estate' ); ?></th>
						<td>
							<strong>
								<?php if ( $user_info ) {
									echo esc_html( $user_info->user_email );
								} ?>
							</strong>
						</td>
					</tr>
				</tbody>
			</table>
			<?php
		}

		public function tfre_render_transaction_log_meta_boxes( $object ) {
			$trans_log_payment_method = get_post_meta( $object->ID, 'trans_log_payment_method', true );
			$trans_log_price          = get_post_meta( $object->ID, 'trans_log_price', true );
			$trans_log_buyer_id       = get_post_meta( $object->ID, 'trans_log_buyer_id', true );
			$trans_log_status         = get_post_meta( $object->ID, 'trans_log_status', true );
			$trans_log_package_id     = get_post_meta( $object->ID, 'trans_log_item_id', true );
			$trans_log_date           = get_post_meta( $object->ID, 'trans_log_date', true );
			$package_name             = get_the_title( $trans_log_package_id );
			$user_info                = get_userdata( $trans_log_buyer_id );
			?>
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><?php esc_html_e( 'Transaction Log ID:', 'tf-real-estate' ); ?></th>
						<td><strong><?php echo esc_html( $object->ID ); ?></strong></td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Transaction Status:', 'tf-real-estate' ); ?></th>
						<td><strong><?php if ( $trans_log_status == 1 ) {
							echo '<span>' . esc_html__( 'Succeeded', 'tf-real-estate' ) . '</span>';
						} else {
							echo '<span>' . esc_html__( 'Failed', 'tf-real-estate' ) . '</span>';
						} ?></strong></td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Package Name:', 'tf-real-estate' ); ?></th>
						<td><strong><?php echo esc_html( $package_name ); ?></strong> <a
								href="<?php echo esc_url( get_edit_post_link( $trans_log_package_id ) ) ?>"><?php esc_html_e( '(Edit)', 'tf-real-estate' ); ?></a>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Payment Method:', 'tf-real-estate' ); ?></th>
						<td>
							<strong>
								<?php echo esc_html( Invoice_Public::tfre_get_invoice_payment_method( $trans_log_payment_method ) ); ?>
							</strong>
						</td>
					</tr>

					<tr>
						<th scope="row"><?php esc_html_e( 'Price:', 'tf-real-estate' ); ?></th>
						<td>
							<strong><?php echo esc_html( tfre_get_format_number( floatval( $trans_log_price ) ) ); ?></strong>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Purchase Date:', 'tf-real-estate' ); ?></th>
						<td>
							<strong><?php echo esc_html( $trans_log_date ); ?></strong>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Buyer Name:', 'tf-real-estate' ); ?></th>
						<td>
							<strong>
								<?php
								if ( current_user_can( 'edit_users' ) && $user_info ) {
									echo '<a href="' . esc_url( get_edit_user_link( $trans_log_buyer_id ) ) . '">' . esc_html( $user_info->display_name ) . '</a>';
								} else {
									if ( $user_info ) {
										echo esc_html( $user_info->display_name );
									}
								}
								?>
							</strong>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Buyer Mobile:', 'tf-real-estate' ); ?></th>
						<td>
							<strong>
								<?php
								$agent_phone_number = get_the_author_meta( 'agent_phone_number', $trans_log_buyer_id );
								echo esc_html( $agent_phone_number );
								?>
							</strong>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Buyer Email:', 'tf-real-estate' ); ?></th>
						<td>
							<strong>
								<?php if ( $user_info ) {
									echo esc_html( $user_info->user_email );
								} ?>
							</strong>
						</td>
					</tr>
				</tbody>
			</table>
			<?php
		}

		public function tfre_render_property_country() {
			global $post;
			$property_country = get_post_meta( $post->ID, 'property_country', true );
			?>
			<div id="property-country">
				<select id="property_country" name="property_country">
					<?php
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
					foreach ( $list_countries as $key => $country ) :
						echo '<option ' . selected( $property_country, $key, false ) . ' value="' . esc_attr( $key ) . '">' . esc_html( $country ) . '</option>';
					endforeach;
					?>
				</select>
			</div>
			<?php
		}

		public function tfre_render( $post ) {
			$section  = $this->sections;
			$controls = isset( $this->controls ) ? $this->controls : array();
			$first    = true;
			?>
			<div id="mytabs">
				<ul class="category-tabs">
					<?php foreach ( $this->sections as $id => $section ) : ?>
						<?php
						if ( $first == true ) {
							$class = '';
							$first = false;
						} else {
							$class = 'hidden';
						}
						$themesflat_setcion[ $id ] = $section['title'];
						echo '<li><a href="#' . esc_attr( $id ) . '">' . esc_html__( $themesflat_setcion[ $id ], 'tf-real-estate' ) . '</a></li>';
						?>
					<?php endforeach ?>
				</ul>
				<div class="tfre-options-container-content">
					<?php
					foreach ( $controls as $key => $_controls ) { ?>
						<div id="<?php echo esc_attr( $key ); ?>" class="<?php echo esc_attr( $class ); ?>">
							<?php $this->tfre_render_content( $key, $_controls, $post ); ?>
						</div>
					<?php }
					?>
				</div>
			</div>
			<?php
			wp_nonce_field( 'custom_nonce_action', 'custom_nonce' );
		}

		function tfre_render_content( $key, $controls, $post ) {
			?>
			<div id="tfre-options-section-<?php echo esc_attr( $key ) ?>">
				<?php
				$last_row_index = 0;
				if ( array_key_exists( 'row_index', $controls[ count( $controls ) - 1 ] ) ) {
					$last_row_index = $controls[ count( $controls ) - 1 ]["row_index"];
				}

				for ( $i = 0; $i <= $last_row_index; $i++ ) {
					$row_index = $i; ?>
					<ul class="tfre-options-section-controls">
						<?php foreach ( $controls as $control ) : ?>
							<?php if ( array_key_exists( 'row_index', $control ) ) : ?>
								<?php if ( $control["row_index"] == $row_index ) { ?>
									<?php $this->tfre_render_controls( $control, true ); ?>
								<?php } ?>
							<?php else : ?>
								<?php $this->tfre_render_controls( $control ); ?>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				<?php } ?>
			</div>
			<?php
		}

		public function tfre_render_controls( $control, $same_row = false, $is_dynamic_control_children = false, $is_blank_control = false, $dynamic_control_children_value = null, $dynamic_field_id = 0, $parent_control = null, $repeater_index = 0 ) {
			global $post;
			global $wp_registered_sidebars;

			if ( $control['type'] == 'panel-dynamic' ) {
				$dynamic_fields = get_post_meta( $post->ID, $control['id'], true );
			}

			if ( empty( get_post_meta( $post->ID, $control['id'], true ) ) ) {
				$value = ( isset( $control['default'] ) ? $control['default'] : '' );
			} else {
				$value = get_post_meta( $post->ID, $control['id'], true );
			}

			if ( $control['id'] === 'property_identity' ) {
				$value = $post->ID;
			}

			if ( $is_dynamic_control_children && $is_blank_control ) {
				$value            = '';
				$dynamic_field_id = null;
			} else {
				if ( isset( $dynamic_control_children_value ) ) {
					$keys = array_keys( $dynamic_control_children_value );
					if ( in_array( $control['id'], $keys ) ) {
						$value = $dynamic_control_children_value[ $control['id'] ];
					}
				}
			}

			$class = '';
			if ( $value == 1 ) {
				$class = 'active';
			}

			$name        = ( $is_dynamic_control_children == true ? ( $is_blank_control ? "_tf_options[{$parent_control}][-1][{$control['id']}]" : "_tf_options[{$parent_control}][{$repeater_index}][{$control['id']}]" ) : "_tf_options[{$control['id']}]" );
			$title       = ( isset( $control['title'] ) ? $control['title'] : '' );
			$choices     = ( isset( $control['choices'] ) ? $control['choices'] : '' );
			$children    = ( isset( $control['children'] ) ? $control['children'] : array() );
			$children    = array_map( function ($value) {
				return '#tfre-options-control-' . $value;
			}, $children );
			$children    = implode( ",", $children );
			$description = ( isset( $control['description'] ) ? '<p>' . $control['description'] . '</p>' : '' );
			$placeholder = ( isset( $control['placeholder'] ) ? $control['placeholder'] : '' );
			$href        = ( isset( $control['href'] ) ) ? $control['href'] : '';
			$classes     = ( isset( $control['classes'] ) ) ? $control['classes'] : '';

			printf( '<li class = "tfre-options-control tfre-options-control-%2$s %3$s %4$s" id="tfre-options-control-%1$s">', esc_attr( $control['id'] ), esc_attr( $control['type'] ), esc_attr( $class ), esc_attr( $same_row ? 'col-control' : '' ) );

			switch ( $control['type'] ) {
				case 'toggle':
					printf( '<h4 class="tfre-options-control-title">%3$s</h4>%4$s
                    <label class="switch tfre-power options-%5$s-%6$s">
                      <input value="0" name="%2$s" type="hidden"><input class="%8$s" children="%7$s" type="checkbox" value="1" %1$s name="%2$s">
                      <div class="slider round"></div>
                    </label>', esc_attr( checked( true, $value, false ) ), esc_attr( $name ), $title, $description, esc_attr( $control['type'] ), esc_attr( $control['id'] ), esc_attr( $children ), esc_attr( $classes ) );
					break;
				case 'editor':
					?>
					<span class="tfre-options-control-title">
						<?php echo esc_html( $title ); ?>
					</span>
					<div class="tfre-options-control-inputs">
						<?php wp_editor( html_entity_decode( stripcslashes( $value ) ), esc_attr( $control['id'] ), array( 'textarea_name' => esc_attr( $name ) ) ); ?>
					</div>
					<?php
					break;
				case 'heading':
					printf( '<label class="options-%3$s-%4$s"><h3>%1$s</h3></label>%2$s', $title, $description, esc_attr( $control['type'] ), esc_attr( $control['id'] ) );
					break;
				case 'button':
					?>
					<a class="button button-primary <?php if ( is_array( $classes ) )
						echo esc_attr( implode( ", ", $classes ) ); ?>" href="<?php echo esc_url( $href ); ?>" target="_blank"
						title="<?php echo esc_attr( $title ); ?>"
						data-link="<?php echo esc_url( $href ); ?>"><?php echo esc_attr( $title ); ?></a>
					<?php
					break;
				case 'checkbox': ?>
					<span class="tfre-options-control-title">
						<?php echo esc_html( $title ); ?>
					</span>
					<div class="tfre-options-control-field">
						<?php
						$name = "_tf_options[{$control['id']}][]";
						$value = get_post_meta( $post->ID, $control['id'], true );
						$value = ! empty( $value ) ? $value : array();
						foreach ( $choices as $_key => $_value ) : ?>
							<label>
								<input type="hidden" name="<?php echo esc_attr( $name ); ?>" value="null">
								<input type="checkbox" value="<?php echo esc_attr( $_key ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php echo esc_attr( checked( in_array( $_key, $value ), 1 ) ); ?> />
								<span>
									<?php echo esc_html( $_value['label'] ); ?>
								</span>
							</label>
						<?php endforeach; ?>
					</div>
					<?php break;
				case 'radio': ?>
					<span class="tfre-options-control-title">
						<?php echo esc_html( $title ); ?>
					</span>
					<div class="tfre-options-control-field">
						<?php foreach ( $choices as $_key => $_value ) :
							$children_controls = isset( $_value['children'] ) && is_array( $_value['children'] ) ? $_value['children'] : array();
							$children_controls = array_map( function ($value) {
								return '#tfre-options-control-' . $value;
							}, $children_controls );
							$children_controls = implode( ",", $children_controls );
							?>
							<label>
								<input type="radio" value="<?php echo esc_attr( $_key ) ?>" name="<?php echo esc_attr( $name ); ?>"
									children="<?php echo esc_attr( $children_controls ); ?>" <?php echo esc_attr( checked( $value, $_key ) ) ?> />
								<span>
									<?php echo esc_html( $_value['label'] ) ?>
								</span>
							</label>
						<?php endforeach; ?>
					</div>
					<?php break;
				case 'select': ?>
					<span class="tfre-options-control-title">
						<?php echo esc_html( $title ); ?>
					</span>
					<div class="tfre-options-control-field">
						<select name="<?php echo esc_attr( $name ) ?>">
							<option value="-1"><?php echo esc_html__( 'None', 'tf-real-estate' ); ?></option>
							<?php foreach ( $choices as $_value => $params ) :
								printf( '<option value="%1$s" %2$s>%3$s</option>', esc_attr( $_value ), esc_attr( selected( $value, $_value ) ), $params ); ?>
							<?php endforeach; ?>
						</select>
					</div>
					<?php break;
				case 'dropdown-sidebar': ?>
					<label>
						<span class="customize-category-select-control">
							<?php esc_html( $title ); ?>
						</span>
						<select name="<?php esc_attr( $name ) ?>">
							<?php
							foreach ( $wp_registered_sidebars as $sidebar ) {
								$selected = ( strcmp( $value, $sidebar['id'] ) == 0 ? 1 : 0 );
								printf( '<option value="%1$s" %2$s>%3$s</option>', $sidebar['id'], selected( $selected ), $sidebar['name'] );
							}
							?>
						</select>
					</label>
					<?php break;
				case 'textarea': ?>
					<span class="tfre-options-control-title">
						<?php echo esc_html( $title ); ?>
					</span>
					<div class="tfre-options-control-inputs">
						<textarea name="<?php echo esc_attr( $name ); ?>"
							id="<?php echo esc_attr( $control['id'] ) ?>"><?php echo esc_html__( $value, 'tf-real-estate' ); ?></textarea>
					</div>
					<?php break;
				case 'unselect': ?>
					<span class="tfre-options-control-title">
						<?php echo esc_html( $title ); ?>
					</span>
					<div class="tfre-options-control-inputs">
						<input type="text" name="<?php echo esc_attr( $name ); ?>"
							id="<?php echo esc_attr( $control['id'] ) ?>" value="<?php echo esc_html__( $value, 'tf-real-estate' ); ?>" placeholder="<?php echo esc_attr( $placeholder ); ?>" disabled>
					</div>
					<?php break;
				case 'datetime':
					printf( '<span class="tfre-options-control-title">%3$s</span></label> %4$s<div class="tfre-options-control-inputs">
                <input name="_tf_options[%1$s]" id="tf-date-time" type="text" value="%2$s"/></div>', esc_attr( $control['id'] ), esc_attr( $value ), $title, $description );
					break;
				case 'color-picker': ?>
					<span class="tfre-options-control-title">
						<?php esc_html( $title ); ?>
					</span>
					<div class="background-color">
						<div class="tfre-options-control-color-picker">
							<div class="tfre-options-control-inputs">
								<input type="text" class='tf-color-picker wp-color-picker' id="<?php esc_attr( $name ) ?>-color"
									name="<?php esc_attr( $name ); ?>" data-default-color value="<?php esc_attr( $value ) ?>" />
							</div>
						</div>
					</div>
					<?php break;
				case 'attachments-control': ?>
					<?php
					$decoded_value = json_decode( $value );
					?>
					<div class="tfre-options-control-multi-attachments-picker background-image"
						data-customizer-link="<?php echo esc_attr( $control['id'] ); ?>">
						<span class="tfre-options-control-title">
							<?php echo esc_html( $title );
							echo wp_get_attachment_image( $decoded_value ); ?>
						</span>
						<div class="tfre-options-control-inputs">
							<div class="upload-dropzone">

								<input type="hidden" data-property="id" />
								<input type="hidden" data-property="thumbnail" />
								<ul class="upload-preview">
									<?php
									if ( is_array( $decoded_value ) ) {
										foreach ( $decoded_value as $val ) :
											if ( empty( $val ) ) {
												continue;
											}
											$file_metadata = get_post( $val );
											if ( $file_metadata === null ) {
												continue;
											}

											printf( '
                                                <li>
                                                    <a href="%1$s" target="_blank">  
                                                        <span class="dashicons dashicons-media-default"></span>
                                                    </a>
                                                    <div class="tf-file-info">
                                                        <a class="tf-file-title" href="%1$s" target="_blank">%2$s (%3$s)</a>
                                                        <div class="tf-file-name">%4$s </div>
                                                        <a href="#" id="%5$s" class="button tf-remove-media" title="Remove">
                                                        Remove
                                                        </a>
                                                    </div>
                                                </li>
                                                ', esc_url( get_edit_post_link( $val ) ), esc_html( $file_metadata->post_title ), esc_html( $file_metadata->post_mime_type ), esc_html( wp_basename( $file_metadata->guid ) ), esc_attr( $val ) );
										endforeach;
									}
									?>
								</ul>
								<span class="upload-message">
									<a href="#" class="button browse-media">
										<?php esc_html_e( 'Add files', 'tf-real-estate' ) ?>
									</a>
									<a href="#" class="upload"></a>
									<a href="#" class="button remove-all">
										<?php esc_html_e( 'Remove All', 'tf-real-estate' ) ?>
									</a>
								</span>
							</div>
						</div>
						<input class="file-value" type="hidden" name="<?php echo esc_attr( $name ); ?>"
							value="<?php echo esc_attr( $value ) ?>" />
					</div>
					<?php
					break;
				case 'image-control': ?>
					<?php
					$showupload = '_show';
					$showremove = '_hide';
					if ( $value != '' ) {
						$showupload = '_hide';
						$showremove = '_show';
					}
					$decoded_value = json_decode( $value );
					?>
					<div class="tfre-options-control-multi-media-picker background-image"
						data-customizer-link="<?php echo esc_attr( $control['id'] ); ?>">
						<span class="tfre-options-control-title">
							<?php echo esc_html( $title ); ?>
						</span>
						<div class="tfre-options-control-inputs">
							<div class="upload-dropzone">

								<input type="hidden" data-property="id" />
								<input type="hidden" data-property="thumbnail" />
								<ul id="tfre_property_gallery_container" class="upload-preview">
									<?php
									if ( is_array( $decoded_value ) ) {
										foreach ( $decoded_value as $val ) :
											printf( '
                                        <li class="sortable_item" data-data="%s">
                                            %s
                                            <a href="#" id="%d" class="tf-remove-media" title="Remove">
                                                <span class="dashicons dashicons-no-alt"></span>
                                            </a>
                                        </li>
                                        ', $val, wp_get_attachment_image( $val ), esc_attr( $val ) );
										endforeach;
									}
									?>
								</ul>
								<span class="upload-message <?php echo esc_attr( $showupload ); ?> ">
									<a href="#" class="button browse-media">
										<?php esc_html_e( 'Add files', 'tf-real-estate' ) ?>
									</a>
									<a href="#" class="upload"></a>
									<a href="#"
										class="button remove-all <?php echo esc_attr( $showremove ); ?>"><?php esc_html_e( 'Remove All', 'tf-real-estate' ) ?></a>
								</span>
							</div>
						</div>
						<input class="image-value" type="hidden" name="<?php echo esc_attr( $name ); ?>"
							value="<?php echo esc_attr( $value ) ?>" />
					</div>
					<?php
					break;
				case 'single-image-control': ?>
					<?php
					$showupload = '_show';
					$showremove = '_hide';
					if ( $value != '' ) {
						$showupload = '_hide';
						$showremove = '_show';
					}
					?>
					<div class="tfre-options-control-media-picker background-image"
						data-customizer-link="<?php echo esc_attr( $control['id'] ); ?>">
						<span class="tfre-options-control-title">
							<?php echo esc_html( $title ); ?>
						</span>
						<div class="tfre-options-control-inputs">
							<div class="upload-dropzone">
								<input type="hidden" data-property="id" />
								<input type="hidden" data-property="thumbnail" />
								<ul id="<?php echo esc_attr( $control['id'] . '_' . $dynamic_field_id ); ?>" class="upload-preview">
									<?php
									if ( ( $control['id'] === 'floor_image' ) && is_array( $value ) ) {
									}
									printf( '
                                            <li>
                                                <img loading="lazy" src="%s"/>
                                                <a href="#" id="%s" class="tf-remove-media" title="Remove">
                                                    <span data-id-field="%3$s" class="dashicons dashicons-no-alt"></span>
                                                </a>
                                            </li>
                                            ', esc_attr( wp_get_attachment_image_url( $value, 'full' ) ), esc_attr( $value ), esc_attr( $control['id'] . '_' . $dynamic_field_id ) );
									?>
								</ul>
								<span class="upload-message <?php echo esc_attr( $showupload ); ?> ">
									<a data-id-field="<?php echo esc_attr( $control['id'] . '_' . $dynamic_field_id ); ?>" href="#"
										class="button browse-media <?php echo esc_attr( $control['id'] . '_' . $dynamic_field_id ); ?>">
										<?php esc_html_e( 'Add file', 'tf-real-estate' ) ?>
									</a>
									<a href="#" class="upload"></a>
								</span>
							</div>
						</div>
						<input id="<?php echo esc_attr( $control['id'] . '_' . $dynamic_field_id ); ?>" class="single-image-value"
							type="hidden" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>" />
					</div>
					<?php
					break;
				case 'map':
					?>
					<span class="tfre-options-control-title">
						<?php echo esc_html( $title ); ?>
					</span>
					<div class="map-container">
						<input data-field-control="" type="hidden" class="tfre-map-location-field" name="<?php echo esc_attr( $name ); ?>[]"
							value="<?php echo ( is_array( $value ) && ( count( $value ) > 0 ) ? esc_attr( $value[0] ) : '' ); ?>" />
						<?php if ( tfre_get_option( "map_service" ) == 'map-box' ) : ?>
							<div class="tfre-map-address-field">
								<div class="tfre-map-address-field-text">
									<input data-field-control="" type="hidden" placeholder="<?php echo esc_attr( $placeholder ); ?>"
										name="<?php echo esc_attr( $name ); ?>[]"
										value="<?php echo ( is_array( $value ) && ( count( $value ) > 0 ) ? esc_attr( $value[1] ) : '' ); ?>" />
								</div>
							</div>
						<?php endif; ?>
						<?php if ( tfre_get_option( "map_service" ) == 'google-map' ) : ?>
							<div class="tfre-map-address-field">
								<div class="tfre-map-address-field-text">
									<input data-field-control="" type="text" placeholder="<?php echo esc_attr( $placeholder ); ?>"
										name="<?php echo esc_attr( $name ); ?>[]"
										value="<?php echo ( is_array( $value ) && ( count( $value ) > 0 ) ? esc_attr( $value[1] ) : '' ); ?>" />
								</div>
								<button type="button" class="button">
									<?php echo esc_html__( 'Find Address', 'tf-real-estate' ); ?>
								</button>
							</div>
						<?php endif; ?>
						<div id="map" style="height:400px"></div>
					</div>
					<?php
					break;
				case 'panel-dynamic':
					?>
					<div class="container-dynamic-panel">
						<?php
						if ( $dynamic_fields ) {
							$idx = 0;
							foreach ( $dynamic_fields as $k => $field ) {
								?>
								<section class="wrapper-dynamic-panel">
									<div class="header-dynamic-panel">
										<span class="dynamic-panel-title">
											<?php echo esc_html( $title ); ?>
										</span>
										<span data-control-id="<?php echo esc_attr( $control['id'] ); ?>" class="dynamic-panel-button-remove"><i
												class="dashicons dashicons-no-alt"></i></span>
									</div>
									<div class="body-dynamic-panel">
										<ul class="tfre-options-section-controls">
											<?php
											if ( isset( $control['children-dynamic-controls'] ) ) {
												foreach ( $control['children-dynamic-controls'] as $key => $ctrl ) {
													$ctrl['id'] = $key;
													$this->tfre_render_controls( $ctrl, $same_row, true, false, $field, $k, $control['id'], $idx );
												}
											}
											?>
										</ul>
									</div>
								</section>
								<?php $idx = $idx + 1;
							}
						} else {
							?>
							<section class="wrapper-dynamic-panel">
								<div class="header-dynamic-panel">
									<span class="dynamic-panel-title">
										<?php echo esc_html( $title ); ?>
									</span>
									<span data-control-id="<?php echo esc_attr( $control['id'] ); ?>" class="dynamic-panel-button-remove"><i
											class="dashicons dashicons-no-alt"></i></span>
								</div>
								<div class="body-dynamic-panel">
									<ul class="tfre-options-section-controls">
										<?php
										if ( isset( $control['children-dynamic-controls'] ) ) {
											foreach ( $control['children-dynamic-controls'] as $key => $ctrl ) {
												$ctrl['id'] = $key;
												$this->tfre_render_controls( $ctrl, $same_row, true, false, null, 0, $control['id'] );
											}
										}
										?>
									</ul>
								</div>
							</section>
						<?php } ?>
						<section class="wrapper-dynamic-panel-sample empty-row screen-reader-text">
							<div class="header-dynamic-panel">
								<span class="dynamic-panel-title">
									<?php echo esc_html( $title ); ?>
								</span>
								<span data-control-id="<?php echo esc_attr( $control['id'] ); ?>" class="dynamic-panel-button-remove"><i
										class="dashicons dashicons-no-alt"></i></span>
							</div>
							<div class="body-dynamic-panel">
								<ul class="tfre-options-section-controls">
									<?php
									if ( isset( $control['children-dynamic-controls'] ) ) {
										foreach ( $control['children-dynamic-controls'] as $key => $ctrl ) {
											$ctrl['id'] = $key;
											$this->tfre_render_controls( $ctrl, $same_row, true, true, null, 0, $control['id'] );
										}
									}
									?>
								</ul>
							</div>
						</section>
					</div>
					<button data-control-id="<?php echo esc_attr( $control['id'] ); ?>" data-id-field-latest="<?php if ( $dynamic_fields && is_array( $dynamic_fields ) ) {
							 echo esc_attr( count( $dynamic_fields ) - 1 );
						 } else {
							 echo 0;
						 } ?>" class="dynamic-panel-button-add button"
						type="button"><?php echo esc_html__( '+ Add', 'tf-real-estate' ); ?> 					<?php echo esc_html( $title ); ?></button>
					<?php
					break;
				default:
					printf( '<span class="tfre-options-control-title">%5$s</span></label> %6$s<div class="tfre-options-control-inputs">
                    <input id="%1$s" name="%2$s" type="%3$s" value="%4$s" placeholder="%7$s"/></div>', esc_attr( $control['id'] ), esc_attr( $name ), esc_attr( $control['type'] ), esc_html( $value ), $title, esc_html__( $description, 'tf-real-estate' ), esc_attr( $placeholder ) );
					break;
			}
			echo '</li>';
		}

		function tfre_save_meta_boxes( $post_id ) {
			/*
			 * We need to verify this came from the our screen and with proper authorization,
			 * because save_post can be triggered at other times.
			 */
			$nonce_name   = isset( $_POST['custom_nonce'] ) ? $_POST['custom_nonce'] : '';
			$nonce_action = 'custom_nonce_action';

			// Check if nonce is set.
			if ( ! isset( $nonce_name ) ) {
				return;
			}

			// Check if nonce is valid.
			if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
				return;
			}
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return $post_id;
			}

			// Check the user's permissions.
			if ( $_POST['post_type'] === 'real-estate' ) {
				if ( ! current_user_can( 'edit_page', $post_id ) ) {
					return $post_id;
				}
			} else {
				if ( ! current_user_can( 'edit_post', $post_id ) ) {
					return $post_id;
				}
			}
			/* OK, it's safe for us to save the data now. */
			if ( isset( $_REQUEST ) && isset( $_REQUEST['_tf_options'] ) ) {
				$datas                = stripslashes_deep( $_REQUEST['_tf_options'] );
				$new_dynamic_fields_1 = array();
				$new_dynamic_fields_2 = array();
				foreach ( $datas as $key => $value ) {
					if ( is_array( $value ) && $key !== 'property_location' ) {
						if ( $key == 'property_additional_detail' ) {
							$old_dynamic_fields = get_post_meta( $post_id, $key, true );
							$count_fields       = count( $value );
							for ( $i = 0; $i < $count_fields; $i++ ) {
								foreach ( $value[ $i ] as $key_child => $value_child ) {
									if ( $value_child != '' ) {
										$new_dynamic_fields_1[ $i ][ $key_child ] = stripslashes( strip_tags( $value_child ) );
									}
								}
							}
							if ( ! empty( $new_dynamic_fields_1 ) && $new_dynamic_fields_1 != $old_dynamic_fields )
								update_post_meta( $post_id, $key, $new_dynamic_fields_1 );
							elseif ( empty( $new_dynamic_fields_1 ) && $old_dynamic_fields )
								delete_post_meta( $post_id, $key, $old_dynamic_fields );
						} else if ( $key == 'floors_plan' ) {
							$old_dynamic_fields = get_post_meta( $post_id, $key, true );
							$count_fields       = count( $value );
							for ( $i = 0; $i < $count_fields; $i++ ) {
								foreach ( $value[ $i ] as $key_child => $value_child ) {
									if ( $value_child != '' ) {
										$new_dynamic_fields_2[ $i ][ $key_child ] = stripslashes( strip_tags( $value_child ) );
									}
								}
							}
							if ( ! empty( $new_dynamic_fields_2 ) && $new_dynamic_fields_2 != $old_dynamic_fields )
								update_post_meta( $post_id, $key, $new_dynamic_fields_2 );
							elseif ( empty( $new_dynamic_fields_2 ) && $old_dynamic_fields )
								delete_post_meta( $post_id, $key, $old_dynamic_fields );
						} else {
							if ( strlen( implode( $value ) ) == 0 ) {
								update_post_meta( $post_id, $key, array() );
							} else {
								$value = array_filter( $value, function ($v, $k) {
									return $v != 'null';
								}, ARRAY_FILTER_USE_BOTH );
								update_post_meta( $post_id, $key, $value );
							}
						}
					} else if ( $key == 'gallery_images' ) {
						if ( $value ) {
							$gallery_images_list = json_decode( $value );
							if ( ! has_post_thumbnail( $post_id ) && ( count( $gallery_images_list ) > 0 ) ) {
								update_post_meta( $post_id, '_thumbnail_id', $gallery_images_list[0] );
							}
							update_post_meta( $post_id, $key, $value );
						}
					} else {
						if ( $key === 'property_price_value' && ! empty( $value ) ) {
							update_post_meta( $post_id, 'property_price_value_multiplication_unit', ( intval( $value ) * ( intval( get_post_meta( $post_id, 'property_price_unit', true ) ) ) ) );
						}
						update_post_meta( $post_id, $key, $value );
					}
				}
			}

			if ( isset( $_REQUEST['property_country'] ) ) {
				update_post_meta( $post_id, 'property_country', wp_unslash( $_REQUEST['property_country'] ) );
			}
		}

		function tfre_save_invoices_meta_boxes( $post_id, $post ) {
			// $post_id and $post are required
			if ( empty( $post_id ) || empty( $post ) ) {
				return false;
			}

			// Dont' save meta boxes for revisions or autosaves.
			if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
				return false;
			}

			if ( ! isset( $_POST['invoice_nonce_field'] ) || ! wp_verify_nonce( wp_unslash( $_POST['invoice_nonce_field'] ), plugin_basename( __FILE__ ) ) ) {
				return false;
			}

			if ( $post->post_type == 'invoice' ) {
				$post_type = get_post_type_object( $post->post_type );
				if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
					return false;
				}

				if ( isset( $_REQUEST['payment_status'] ) ) {
					$invoice_user_id = get_post_meta( $post_id, 'invoice_user_id', true );
					$package_id      = get_post_meta( $post_id, 'invoice_package_id', true );
					$user_package    = new User_Package_Public();
					$user_package->tfre_insert_user_package( $invoice_user_id, $package_id );
					update_post_meta( $post_id, 'invoice_payment_status', 1 );
				}
			}
		}
	}
}
?>