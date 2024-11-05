<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$enable_compare = tfre_get_option('enable_compare', 'y');
TFRE_Compare::tfre_open_session();
$property_ids = $_SESSION['tfre_compare_properties'];
?>
<?php if ($enable_compare == 'y'): ?>
	<div id = "compare_listing_wrap" class="<?php echo esc_attr(empty($property_ids) ? 'compare-listing-hidden' : '')?> ">
		<div id="tfre-compare-listings" class="compare-listing ">
			<div class="compare-listing-header">
				<h6 class="title"> <?php esc_html_e('Compare', 'tf-real-estate'); ?></h6>
			</div>
			<?php do_action('tfre_show_compare'); ?>
		</div>
	</div>
<?php endif; ?>