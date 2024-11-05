<?php
/**
 * @var $property_data
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$property_id                 = $property_data ? $property_data->ID : null;
$property_meta_data          = $property_data ? get_post_meta( $property_data->ID ) : array();
$decimal_point               = tfre_get_option( 'decimal_separator', '.' );
$property_price_short_format = '^[0-9]+([' . $decimal_point . '][0-9]+)?$';
$property_size_value         = $property_data ? get_post_meta( $property_data->ID, 'property_size', true ) : '';
$property_land_value         = $property_data ? get_post_meta( $property_data->ID, 'property_land', true ) : '';
$property_rooms_value        = $property_data ? get_post_meta( $property_data->ID, 'property_rooms', true ) : '';
$property_bedrooms_value     = $property_data ? get_post_meta( $property_data->ID, 'property_bedrooms', true ) : '';
$property_bathrooms_value    = $property_data ? get_post_meta( $property_data->ID, 'property_bathrooms', true ) : '';
$property_garage_value       = $property_data ? get_post_meta( $property_data->ID, 'property_garage', true ) : '';
$property_garage_size_value  = $property_data ? get_post_meta( $property_data->ID, 'property_garage_size', true ) : '';
$property_year_value         = $property_data ? get_post_meta( $property_data->ID, 'property_year', true ) : '';
$property_identity_value     = $property_data ? get_post_meta( $property_data->ID, 'property_identity', true ) : '';
$property_additional_detail  = $property_data ? get_post_meta( $property_data->ID, 'property_additional_detail', true ) : '';
$show_hide_property_fields   = tfre_get_option( 'show_hide_property_fields', array() );
$measurement_units = tfre_get_option_measurement_units();
?>
<div class="tfre-field-wrap tfre-add-information">
	<div class="tfre-field-title">
		<h3><?php esc_html_e( 'Additional Information', 'tf-real-estate' ); ?></h3>
	</div>
	<div class="property-fields row">
		<div class="col-sm-4">
			<?php if ( $show_hide_property_fields['property-type'] == 1 ) : ?>
				<div class="form-group">
					<label for="property_type">
						<?php echo esc_html_e( 'Property Type', 'tf-real-estate' ) . tfre_required_field( 'property-type', 'required_property_fields' ); ?>
					</label>
					<select name="property-type[]" id="property_type" class="form-control" multiple="multiple">
						<?php
						tfre_get_multiple_taxonomy_by_post_id( $property_id, 'property-type', true, false, true ); ?>
					</select>
				</div>
			<?php endif; ?>
		</div>
		<div class="col-sm-4">
			<?php if ( $show_hide_property_fields['property-status'] == 1 ) : ?>
				<div class="form-group">
					<label for="property_status">
						<?php echo esc_html_e( 'Property Status', 'tf-real-estate' ) . tfre_required_field( 'property-status', 'required_property_fields' ); ?>
					</label>
					<select name="property-status[]" id="property_status" class="form-control" multiple="multiple">
						<?php tfre_get_multiple_taxonomy_by_post_id( $property_id, 'property-status', true, false, true ); ?>
					</select>
				</div>
			<?php endif; ?>
		</div>
		<div class="col-sm-4">
			<?php if ( $show_hide_property_fields['property-label'] == 1 ) : ?>
				<div class="form-group">
					<label for="property_label">
						<?php echo esc_html_e( 'Property Label', 'tf-real-estate' ) . tfre_required_field( 'property-label', 'required_property_fields' ); ?>
					</label>
					<select name="property-label[]" id="property_label" class="form-control" multiple="multiple">
						<?php tfre_get_multiple_taxonomy_by_post_id( $property_id, 'property-label', true, false, true ); ?>
					</select>
				</div>
			<?php endif; ?>
		</div>
		<div class="col-sm-4">
			<?php if ( $show_hide_property_fields['property_size'] == 1 ) : ?>
				<div class="form-group">
					<label
						for="property_size"><?php echo sprintf( esc_html__( 'Size (%s)', 'tf-real-estate' ), $measurement_units ) . tfre_required_field( 'property_size', 'required_property_fields' ); ?></label>
					<input type="number" id="property_size" class="form-control" name="property_size"
						value="<?php echo esc_attr( $property_size_value ); ?>">
				</div>
			<?php endif; ?>
		</div>
		<div class="col-sm-4">
			<?php if ( $show_hide_property_fields['property_land'] == 1 ) : ?>
				<div class="form-group">
					<label
						for="property_land"><?php echo sprintf( esc_html__( 'Land Area (%s)', 'tf-real-estate' ), $measurement_units ) . tfre_required_field( 'property_land', 'required_property_fields' ); ?></label>
					<input type="number" id="property_land" class="form-control" name="property_land"
						value="<?php echo esc_attr( $property_land_value ); ?>">
				</div>
			<?php endif; ?>
		</div>
		<div class="col-sm-4">
			<?php if ( $show_hide_property_fields['property_rooms'] == 1 ) : ?>
				<div class="form-group">
					<label
						for="property_rooms"><?php echo esc_html__( 'Rooms', 'tf-real-estate' ) . tfre_required_field( 'property_rooms', 'required_property_fields' ); ?></label>
					<input type="number" id="property_rooms" class="form-control" name="property_rooms"
						value="<?php echo esc_attr( $property_rooms_value ); ?>">
				</div>
			<?php endif; ?>
		</div>
		<div class="col-sm-4">
			<?php if ( $show_hide_property_fields['property_bedrooms'] == 1 ) : ?>
				<div class="form-group">
					<label
						for="property_bedrooms"><?php echo esc_html__( 'Bedrooms', 'tf-real-estate' ) . tfre_required_field( 'property_bedrooms', 'required_property_fields' ); ?></label>
					<input type="number" id="property_bedrooms" class="form-control" name="property_bedrooms"
						value="<?php echo esc_attr( $property_bedrooms_value ); ?>">
				</div>
			<?php endif; ?>
		</div>
		<div class="col-sm-4">
			<?php if ( $show_hide_property_fields['property_bathrooms'] == 1 ) : ?>
				<div class="form-group">
					<label
						for="property_bathrooms"><?php echo esc_html__( 'Bathrooms', 'tf-real-estate' ) . tfre_required_field( 'property_bathrooms', 'required_property_fields' ); ?></label>
					<input type="number" id="property_bathrooms" class="form-control" name="property_bathrooms"
						value="<?php echo esc_attr( $property_bathrooms_value ); ?>">
				</div>
			<?php endif; ?>
		</div>
		<div class="col-sm-4">
			<?php if ( $show_hide_property_fields['property_garage'] == 1 ) : ?>
				<div class="form-group">
					<label
						for="property_garage"><?php echo esc_html__( 'Garages', 'tf-real-estate' ) . tfre_required_field( 'property_garage', 'required_property_fields' ); ?></label>
					<input type="number" id="property_garage" class="form-control" name="property_garage"
						value="<?php echo esc_attr( $property_garage_value ); ?>">
				</div>
			<?php endif; ?>
		</div>
		<div class="col-sm-4">
			<?php if ( $show_hide_property_fields['property_garage_size'] == 1 ) : ?>
				<div class="form-group">
					<label
						for="property_garage_size"><?php echo sprintf( esc_html__( 'Garages Size (%s)', 'tf-real-estate' ), $measurement_units ) . tfre_required_field( 'property_garage_size', 'required_property_fields' ); ?></label>
					<input type="number" id="property_garage_size" class="form-control" name="property_garage_size"
						value="<?php echo esc_attr( $property_garage_size_value ); ?>">
				</div>
			<?php endif; ?>
		</div>
		<div class="col-sm-4">
			<?php if ( $show_hide_property_fields['property_year'] == 1 ) : ?>
				<div class="form-group">
					<label
						for="property_year"><?php echo esc_html__( 'Year Built', 'tf-real-estate' ) . tfre_required_field( 'property_year', 'required_property_fields' ); ?></label>
					<input type="number" id="property_year" class="form-control" name="property_year"
						value="<?php echo esc_attr( $property_year_value ); ?>">
				</div>
			<?php endif; ?>
		</div>
		<div class="col-sm-4">
			<?php if ( $show_hide_property_fields['property_identity'] == 1 ) : ?>
				<div class="form-group">
					<label for="property_identity"><?php echo esc_html__( 'Property ID', 'tf-real-estate' ); ?></label>
					<input type="number" id="property_identity" class="form-control" name="property_identity"
						value="<?php echo esc_attr( $property_identity_value ); ?>" disabled>
				</div>
			<?php endif; ?>
		</div>
		<?php
		$get_additional_fields = tfre_get_additional_fields();
		if ( is_array( $get_additional_fields ) && count( $get_additional_fields ) > 0 ) {
			foreach ( $get_additional_fields as $key => $field ) {
				switch ( $field['type'] ) {
					case 'text':
						?>
						<div class="col-sm-4">
							<div class="form-group">
								<label for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field['title'] ); ?></label>
								<input type="text" id="<?php echo esc_attr( $key ); ?>" class="form-control"
									name="<?php echo esc_attr( $key ); ?>" value="<?php if ( isset( $property_meta_data[ $key ] ) ) {
											 echo esc_attr( $property_meta_data[ $key ][0] );
										 } ?>">
							</div>
						</div>
						<?php
						break;
					case 'textarea':
						?>
						<div class="col-sm-4">
							<div class="form-group">
								<label for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field['title'] ); ?></label>
								<textarea name="<?php echo esc_attr( $key ); ?>" rows="3" id="<?php echo esc_attr( $key ); ?>"
									class="form-control"><?php if ( isset( $property_meta_data[ $key ] ) ) {
										echo esc_attr( $property_meta_data[ $key ][0] );
									} ?></textarea>
							</div>
						</div>
						<?php
						break;
					case 'select':
						?>
						<div class="col-sm-4">
							<div class="form-group">
								<label for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field['title'] ); ?></label>
								<select name="<?php echo esc_attr( $key ); ?>" id="<?php echo esc_attr( $key ); ?>"
									class="form-control">
									<?php
									foreach ( $field['choices'] as $opt_key => $opt_value ) : ?>
										<option value="<?php echo esc_attr( $opt_key ); ?>" <?php if ( isset( $property_meta_data[ $key ] ) ) {
												 echo esc_attr( selected( $property_meta_data[ $key ][0], $opt_key, false ) );
											 } ?>>
											<?php echo esc_html( $opt_value ); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<?php
						break;
					case 'radio':
						?>
						<div class="col-sm-12">
							<div class="form-group">
								<label><?php echo esc_html( $field['title'] ); ?></label>
								<div class="field-<?php echo esc_attr( $key ); ?>">
									<?php foreach ( $field['choices'] as $opt_key => $opt_value ) : ?>
										<input type="radio" name="<?php echo esc_attr( $key ); ?>"
											value="<?php echo esc_attr( $opt_key ); ?>" <?php if ( isset( $property_meta_data[ $key ] ) ) {
													 echo esc_attr( checked( $property_meta_data[ $key ][0], $opt_key ) );
												 } else {
													 echo esc_attr( checked( $field['default'], $opt_key ) );
												 } ?> />
										<label class="radio-inline">
											<?php echo esc_html( $opt_value['label'] ); ?>
										</label>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
						<?php
						break;
					case 'checkbox':
						?>
						<div class="col-sm-12">
							<div class="form-group">
								<label><?php echo esc_html( $field['title'] ); ?></label>
								<div class="field-<?php echo esc_attr( $key ); ?>">
									<?php
									$property_field = $property_data ? get_post_meta( $property_data->ID, $key, true ) : array();
									if ( empty( $property_field ) ) {
										$property_field = array();
									}
									foreach ( $field['choices'] as $opt_key => $opt_value ) :
										?>
										<input type="checkbox" name="<?php echo esc_attr( $key ); ?>[]"
											value="<?php echo esc_attr( $opt_key ); ?>" <?php if ( in_array( $opt_key, $property_field ) ) {
													 echo esc_attr( 'checked' );
												 } ?> />
										<label class="group-checkbox">
											<?php echo esc_html( $opt_value['label'] ); ?>
										</label>
										<?php
									endforeach; ?>
								</div>
							</div>
						</div>
						<?php
						break;
					default:
						# code...
						break;
				}
			}
		}
		?>
	</div>
	<?php if ( $show_hide_property_fields['property_additional_detail'] == 1 ) : ?>
		<div class="property-additional-details">
			<h4><?php esc_html_e( 'Additional details', 'tf-real-estate' ); ?></h4>
			<table class="additional-block">
				<thead>
					<tr>
						<td><label><?php esc_html_e( 'Title', 'tf-real-estate' ); ?></label></td>
						<td><label><?php esc_html_e( 'Value', 'tf-real-estate' ); ?></label></td>
						<td class="column-action"></td>
					</tr>
				</thead>
				<tbody id="tfre_additional_details">
					<?php if ( ! empty( $property_additional_detail ) && is_array($property_additional_detail) ) {
						$row_index = 0;
						foreach ( $property_additional_detail as $index => $additional_detail ) { ?>
							<tr>
								<td>
									<input class="form-control" type="text"
										name="property_additional_detail[<?php echo esc_attr( $index ); ?>][additional_detail_title]"
										id="additional_detail_title_<?php echo esc_attr( $index ); ?>"
										value="<?php echo esc_attr( $additional_detail['additional_detail_title'] ); ?>">
								</td>
								<td>
									<input class="form-control" type="text"
										name="property_additional_detail[<?php echo esc_attr( $index ); ?>][additional_detail_value]"
										id="additional_detail_value_<?php echo esc_attr( $index ); ?>"
										value="<?php echo esc_attr( $additional_detail['additional_detail_value'] ); ?>">
								</td>
								<td>
									<span class="remove-additional-detail"><i class="fa fa-times"></i></span>
								</td>
							</tr>
							<?php $row_index++;
						}
					} ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="3">
							<button type="button"
								data-increment="<?php echo ( empty( $property_additional_detail ) ? -1 : esc_attr( $row_index - 1 ) ); ?>"
								class="add-additional-detail"><i class="fa fa-plus"></i>
								<?php esc_html_e( 'Add New', 'tf-real-estate' ); ?></button>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	<?php endif; ?>
</div>