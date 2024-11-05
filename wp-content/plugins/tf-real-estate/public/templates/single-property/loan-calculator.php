<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$show_loan_calculator = is_array( tfre_get_option( 'single_property_panels_manager' ) ) ? tfre_get_option( 'single_property_panels_manager' )['loan-calculator'] : false;
if ( $show_loan_calculator == true ) : ?>
	<div id="nav-loan-calculator" class="single-property-element property-loan-calculator">
		<div class="tfre-property-header">
			<h3><?php esc_html_e( 'Loan Calculator', 'tf-real-estate' ); ?></h3>
		</div>
		<div class="property-element row">
			<?php echo do_shortcode( '[loan_calculator]' ); ?>
		</div>
	</div>
<?php endif; ?>