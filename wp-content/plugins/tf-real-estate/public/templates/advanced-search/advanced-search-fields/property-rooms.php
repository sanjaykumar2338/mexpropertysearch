<?php
/**
 * @var $css_class_field
 * @var $value_rooms
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$rooms_list = tfre_get_option('rooms_list_dropdown','1,2,3,4,5,6,7,8,9,10');
$rooms_array = explode( ',', $rooms_list );
?>
<div class="<?php echo esc_attr($css_class_field); ?> form-group rooms-field">
    <select name="rooms" title="<?php esc_attr_e('Rooms', 'tf-real-estate') ?>"
        class="tfre-property-room-ajax search-field form-control" data-default-value="">
        <option value="" <?php selected('', $value_rooms) ?>>
            <?php esc_html_e('Rooms', 'tf-real-estate') ?>
        </option>
        <?php if (is_array($rooms_array) && !empty($rooms_array) ): ?>
		    <?php foreach ($rooms_array as $room) : ?>
			    <option <?php selected($value_rooms, $room) ?> value="<?php echo esc_attr($room)?>"><?php echo esc_html($room)?></option>
		    <?php endforeach; ?>
	    <?php endif; ?>
    </select>
</div>