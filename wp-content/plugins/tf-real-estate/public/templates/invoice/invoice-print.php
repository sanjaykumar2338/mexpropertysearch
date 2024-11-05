<?php
/**
 * @var $invoice_id
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$invoice = get_post( $invoice_id );
if ( $invoice->post_type !== 'invoice' ) {
	esc_html_e( 'Invoice ineligible to print!', 'tf-real-estate' );
	return;
}

wp_enqueue_script( 'jquery' );
wp_dequeue_script( 'datetimepicker' );
wp_add_inline_script( 'jquery', "jQuery(window).on('load',function(){ print(); });" );

$page_name                 = get_bloginfo( 'name', '' );
$package_currency_sign     = tfre_get_option( 'package_currency_sign', '$' );
$package_currency_position = tfre_get_option( 'package_currency_sign_position', 'before' );
$company_address           = tfre_get_option( 'invoice_company_address', '' );
$company_name              = tfre_get_option( 'invoice_company_name', '' );
$company_phone             = tfre_get_option( 'invoice_company_phone', '' );
$payment_method            = get_post_meta( $invoice_id, 'invoice_payment_method', true );
$payment_status            = get_post_meta( $invoice_id, 'invoice_payment_status', true );
$price                     = get_post_meta( $invoice_id, 'invoice_price', true );
$purchase_date             = get_post_meta( $invoice_id, 'invoice_purchase_date', true );
$package_id                = get_post_meta( $invoice_id, 'invoice_package_id', true );
$package_name              = get_the_title( $package_id );
$user_id                   = get_post_meta( $invoice_id, 'invoice_user_id', true );
$agent_id                  = get_the_author_meta( 'author_agent_id', $user_id );
$agent_status              = get_post_status( $agent_id );

if ( $agent_status == 'publish' ) {
    $agent_name  = get_the_title( $agent_id );
	$agent_email = get_post_meta( $agent_id, 'agent_email', true );
} else {
	$user_first_name = get_the_author_meta( 'first_name', $user_id );
	$user_last_name  = get_the_author_meta( 'last_name', $user_id );
	$user_email      = get_the_author_meta( 'user_email', $user_id );
	if ( empty( $user_first_name ) && empty( $user_last_name ) ) {
		$agent_name = get_the_author_meta( 'user_login', $user_id );
	} else {
		$agent_name = $user_first_name . ' ' . $user_last_name;
	}
	$agent_email = $user_email;
}
?>
<html <?php language_attributes(); ?>>
<head>
	<?php wp_head(); ?>
</head>
<body>
	<div class="single-invoice-wrap invoice-details">
		<div class="card card-body invoice-details-body">
			<div class="page-info mb-2 text-center">
				<div class="invoice-info mb-4">
					<h3 class="invoice-title">
						<?php printf( __( 'Invoice from %s', 'tf-real-estate' ), $page_name ); ?>
					</h3>
					<p class="invoice-id">
						<?php printf( __( 'Invoice #%s', 'tf-real-estate' ), $invoice_id ); ?>
					</p>
				</div>
			</div>
			<div class="single-invoice-info row mb-4">
				<div class="agent-company-info col-md-6 mb-4 mb-md-0">
					<p class="invoice-info-label">
						<strong><?php esc_html_e( 'Invoice from', 'tf-real-estate' ) ?></strong>
					</p>
					<?php if ( ! empty( $company_name ) ) : ?>
						<div class="invoice-name">
							<?php echo esc_html( $company_name ); ?>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $company_address ) ) : ?>
						<div class="invoice-details company-address">
							<?php echo esc_html( $company_address ); ?>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $company_phone ) ) : ?>
						<div class="invoice-details company-phone">
							<?php echo esc_html( $company_phone ); ?>
						</div>
					<?php endif; ?>
				</div>
				<div class="agent-main-info col-md-6 mb-4 text-md-end">
                    <div class="text-md-start float-md-end">
                        <p class="invoice-info-label"><strong><?php esc_html_e( 'Invoice to', 'tf-real-estate' ) ?></strong>
                        </p>
                        <?php if ( ! empty( $agent_name ) ) : ?>
                            <div class="invoice-name">
                                <?php echo esc_html( $agent_name ); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( ! empty( $agent_email ) ) : ?>
                            <div class="invoice-details agent-email">
                                <?php echo esc_html( $agent_email ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
				</div>
			</div>
			<div class="invoice-info">
				<table class="table table-mobile">
					<tbody>
						<tr>
							<th><?php esc_html_e( 'Package Name:', 'tf-real-estate' ); ?></th>
							<td><?php echo esc_html( $package_name ); ?></td>
						</tr>
						<tr>
							<th><?php esc_html_e( 'Payment Method:', 'tf-real-estate' ); ?></th>
							<td><?php echo esc_html( Invoice_Public::tfre_get_invoice_payment_method( $payment_method ) ); ?></td>
						</tr>
						<tr>
							<th><?php esc_html_e( 'Purchase Date:', 'tf-real-estate' ); ?></th>
							<td><?php echo date_i18n( get_option( 'date_format' ), strtotime( $purchase_date ) ); ?>
							</td>
						</tr>
						<tr>
							<th><?php esc_html_e( 'Total Price:', 'tf-real-estate' ); ?></th>
							<td><?php
							if ( $package_currency_position == 'before' ) {
								$price = '<span class="price-currency-sign">' . esc_html( $package_currency_sign ) . '</span><span class="price">' . tfre_get_format_number( floatval( $price ) ) . '</span>';
							} else {
								$price = '<span class="price">' . tfre_get_format_number( floatval( $price ) ) . '</span><span
								class="price-currency-sign">' . esc_html( $package_currency_sign ) . '</span>';
							}
							echo __( $price ); ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>