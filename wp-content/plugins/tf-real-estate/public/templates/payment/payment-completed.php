<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$payment_public = new Payment_Public();
$payment_method = isset( $_GET['payment_method'] ) ? absint( ( wp_unslash( $_GET['payment_method'] ) ) ) : -1;
if ( $payment_method == 1 || $payment_method == 4 ) {
	switch ( $payment_method ) {
		case 1:
			$payment_public->tfre_payment_completed_by_paypal();
			break;
		case 4:
			$payment_public->tfre_payment_completed_by_stripe();
			break;
	}
	?>
	<div class="payment-completed-wrap">
		<div class="heading">
			<h2><?php echo wp_kses_post( tfre_get_option( 'thankyou_title', '' ) ); ?></h2>
		</div>
		<div class="payment-completed-content">
			<?php
			$html_info = tfre_get_option( 'thankyou_paypal_stripe_content', '' );
			echo wpautop( $html_info ); ?>
		</div>
		<a href="<?php echo esc_url( tfre_get_permalink( 'dashboard_page' ) ); ?>" class="btn tf-btn btn-submit">
			<?php esc_html_e( 'Go to Dashboard', 'tf-real-estate' ); ?> </a>
	</div>
	<?php
} elseif ( $payment_method == 2 ) {
	?>
	<div class="payment-completed-wrap">
		<div class="heading">
			<h2><?php echo wp_kses_post( tfre_get_option( 'thankyou_title', '' ) ); ?></h2>
		</div>
		<div class="payment-completed-content">
			<?php $html = tfre_get_option( 'thankyou_wire_transfer_content', '' );
			echo wpautop( $html ); ?>
		</div>
		<a href="<?php echo esc_url( tfre_get_permalink( 'dashboard_page' ) ); ?>"
			class="btn tf-btn"><?php esc_html_e( 'Go to Dashboard', 'tf-real-estate' ); ?></a>
	</div>
	<?php
} elseif ( $payment_method == 3 ) {
	?>
	<div class="payment-completed-wrap">
		<div class="heading">
			<h2><?php echo wp_kses_post( tfre_get_option( 'thankyou_title', '' ) ); ?></h2>
		</div>
		<a href="<?php echo esc_url( tfre_get_permalink( 'dashboard_page' ) ); ?>"
			class="btn tf-btn"><?php esc_html_e( 'Go to Dashboard', 'tf-real-estate' ); ?></a>
	</div>
	<?php
} else {
	?>
	<div class="payment-completed-wrap">
		<div class="heading">
			<h2><?php echo wp_kses_post( __( 'Transaction Failed', 'tf-real-estate' ) ); ?></h2>
		</div>
		<a href="<?php echo esc_url( tfre_get_permalink( 'dashboard_page' ) ); ?>" class="btn tf-btn btn-submit">
			<?php esc_html_e( 'Go to Dashboard', 'tf-real-estate' ); ?> </a>
	</div>
	<?php
}
?>