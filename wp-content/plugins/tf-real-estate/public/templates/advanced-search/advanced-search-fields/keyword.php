<?php
/**
 * @var $css_class_field
 * @var $value_keyword
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

$keyword_field = tfre_get_option('search_criteria_keyword_field', 'criteria_address');
$placeholder_keyword     = tfre_get_option('placeholder_keyword_field', esc_attr__( 'Enter Keyword...', 'tf-real-estate' ));

if ($keyword_field == 'criteria_title') {
	$keyword_placeholder = $placeholder_keyword;

} else if ($keyword_field == 'criteria_state') {
	$keyword_placeholder = esc_html__('Search City, State or Area', 'tf-real-estate');

} else if ($keyword_field == 'criteria_address') {
	$keyword_placeholder = esc_html__('Enter an address, zip or property ID', 'tf-real-estate');

} else {
	$keyword_placeholder = $placeholder_keyword;
}

?>
<div class="<?php echo esc_attr($css_class_field); ?> form-group keyword-field">
	<input type="text" class="form-control search-field" data-default-value=""
		value="<?php echo esc_attr($value_keyword); ?>" name="keyword"
		placeholder="<?php echo esc_attr($keyword_placeholder) ?>">
</div>