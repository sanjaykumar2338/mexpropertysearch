<?php
/**
 * @var $invoices
 * @var $max_num_pages
 * @var $start_date
 * @var $end_date
 * @var $invoice_payment_method
 * @var $invoice_status
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if ( ! is_user_logged_in() ) {
	tfre_get_template_with_arguments( 'global/access-permission.php', array( 'type' => 'not_login' ) );
	return;
}

$tfre_allow_submit_property = tfre_allow_submit_property();
if ( ! $tfre_allow_submit_property ) {
	tfre_get_template_with_arguments( 'global/access-permission.php', array( 'type' => 'not_allow_submit_property' ) );
	return;
}
wp_enqueue_style( 'bootstrap-datepicker' );
wp_enqueue_script( 'bootstrap-datepicker' );

$language_datepicker = esc_html( tfre_get_option( 'language_datepicker', 'en-GB' ) );

if ( function_exists( 'icl_translate' ) ) {
	$language_datepicker = ICL_LANGUAGE_CODE;
}
if ( ! empty( $language_datepicker ) ) {
	wp_enqueue_script( "bootstrap-datepicker." . $language_datepicker, TF_PLUGIN_URL . 'public/assets/third-party/bootstrap-datepicker/locales/bootstrap-datepicker.' . $language_datepicker . '.js', array( 'jquery' ), '1.0', true );
}
$page_name                 = get_bloginfo( 'name', '' );
$company_address           = tfre_get_option( 'invoice_company_address', '' );
$company_name              = tfre_get_option( 'invoice_company_name', '' );
$company_phone             = tfre_get_option( 'invoice_company_phone', '' );
$package_currency_sign     = tfre_get_option( 'package_currency_sign', '$' );
$package_currency_position = tfre_get_option( 'package_currency_sign_position', 'before' );

$my_invoices_columns = array(
	'id'           => esc_html__( 'Invoice ID', 'tf-real-estate' ),
	'package_name' => esc_html__( 'Package Name', 'tf-real-estate' ),
	'price'        => esc_html__( 'Price (' . $package_currency_sign . ')', 'tf-real-estate' ),
	'method'       => esc_html__( 'Payment Method', 'tf-real-estate' ),
	'status'       => esc_html__( 'Payment Status', 'tf-real-estate' ),
	'date'         => esc_html__( 'Purchase Date', 'tf-real-estate' ),
	'action'       => esc_html__( 'Action', 'tf-real-estate' ),
);
?>
<?php if ( isset( $_GET['invoice_id'] ) && $_GET['invoice_id'] != '' ) :
	wp_enqueue_script( 'invoice-script', TF_PLUGIN_URL . 'public/assets/js/invoice.js', array( 'jquery' ), '', true );
	$invoice_id     = $_GET['invoice_id'];
	$payment_method = get_post_meta( $invoice_id, 'invoice_payment_method', true );
	$payment_status = get_post_meta( $invoice_id, 'invoice_payment_status', true );
	$price          = get_post_meta( $invoice_id, 'invoice_price', true );
	$purchase_date  = get_post_meta( $invoice_id, 'invoice_purchase_date', true );
	$package_id     = get_post_meta( $invoice_id, 'invoice_package_id', true );
	$package_name   = get_the_title( $package_id );
	$user_id        = get_post_meta( $invoice_id, 'invoice_user_id', true );
	global $current_user;
	wp_get_current_user();
	if ( $user_id != $current_user->ID ) {
		esc_html_e( 'You can\'t view this invoice', 'tf-real-estate' );
		return;
	}
	$agent_id     = get_the_author_meta( 'author_agent_id', $user_id );
	$agent_status = get_post_status( $agent_id );
	if ( $agent_status == 'publish' ) {
		$agent_email = get_post_meta( $agent_id, 'agent_email', true );
		$agent_name  = get_the_title( $agent_id );
	} else {
		$user_first_name = get_the_author_meta( 'first_name', $user_id );
		$user_last_name  = get_the_author_meta( 'last_name', $user_id );
		$user_email     = get_the_author_meta( 'user_email', $user_id );
		if ( empty( $user_first_name ) && empty( $user_last_name ) ) {
			$agent_name = get_the_author_meta( 'user_login', $user_id );
		} else {
			$agent_name = $user_first_name . ' ' . $user_last_name;
		}
		$agent_email = $user_email;
	}
	?>
	<div class="single-invoice-wrap invoice-details p-md-5">
		<div class="invoice-details-header border-bottom">
			<div class="row align-items-center">
				<div class="col-md-6 mb-4 mb-md-0">
					<h1 class="invoice-title">
						<?php printf( __( 'Invoice #%s', 'tf-real-estate' ), $invoice_id ); ?>
					</h1>
				</div>
				<div class="single-invoice-action text-md-end col-md-6 mb-4 mb-md-0">
					<a href="<?php echo esc_url( tfre_get_permalink( 'my_invoices' ) ); ?>" 
						class="btn btn-outline btn-secondary"
						title="<?php esc_attr_e( 'Back to My Invoices', 'tf-real-estate' ) ?>">
						<?php esc_html_e( 'Back to My Invoices', 'tf-real-estate' ) ?>
					</a>
					<a href="javascript:void(0)" id="invoice_print" class="btn btn-primary"
						title="<?php esc_attr_e( 'Print', 'tf-real-estate' ); ?>"
						data-invoice-id="<?php echo esc_attr( $invoice_id ); ?>" data-ajax-url="<?php echo esc_url(TF_AJAX_URL); ?>" data-home-url="<?php echo esc_url( home_url() ); ?>">
						<?php esc_html_e( 'Print', 'tf-real-estate' ) ?>
					</a>
				</div>
			</div>
		</div>
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
					<p class="invoice-info-label"><strong><?php esc_html_e( 'Invoice from', 'tf-real-estate' ) ?></strong>
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
				<div class="agent-main-info col-md-6 text-md-end">
					<div class="text-md-start float-md-end">
						<p class="invoice-info-label"><strong><?php esc_html_e( 'Invoice to', 'tf-real-estate' ) ?></strong></p>
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
							<td><?php echo date_i18n( get_option( 'date_format' ), strtotime( $purchase_date ) ); ?></td>
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
<?php else : ?>
	<div class="panel panel-default my-invoices">
		<div class="panel-body">
			<form method="get" action="<?php echo get_page_link(); ?>">
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="sr-only"
								for="invoice_status"><?php esc_html_e( 'Payment Status', 'tf-real-estate' ); ?></label>
							<select class="selectpicker form-control" id="invoice_status" name="invoice_status">
								<option value="" <?php if ( $invoice_status == '' )
									echo ' selected' ?>>
									<?php esc_html_e( 'All Payment Status', 'tf-real-estate' ); ?></option>
								<option value="1" <?php if ( $invoice_status == '1' )
									echo ' selected' ?>>
									<?php esc_html_e( 'Paid', 'tf-real-estate' ); ?></option>
								<option value="0" <?php if ( $invoice_status == '0' )
									echo ' selected' ?>>
									<?php esc_html_e( 'Not Paid', 'tf-real-estate' ); ?></option>
							</select>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="sr-only"
								for="invoice_payment_method"><?php esc_html_e( 'Invoice Payment Method', 'tf-real-estate' ); ?></label>
							<select class="selectpicker form-control" id="invoice_payment_method"
								name="invoice_payment_method">
								<option value="" <?php if ( $invoice_payment_method == '' )
									echo ' selected' ?>>
									<?php esc_html_e( 'All Invoice Payment Method', 'tf-real-estate' ); ?></option>
								<option value="paypal" <?php if ( $invoice_payment_method == 'paypal' )
									echo ' selected' ?>>
									<?php esc_html_e( 'Paypal', 'tf-real-estate' ); ?></option>
								<option value="wire_transfer" <?php if ( $invoice_payment_method == 'wire_transfer' )
									echo ' selected' ?>>
									<?php esc_html_e( 'Wire Transfer', 'tf-real-estate' ); ?></option>
								<option value="free_package" <?php if ( $invoice_payment_method == 'free_package' )
									echo ' selected' ?>><?php esc_html_e( 'Free Package', 'tf-real-estate' ); ?></option>
							</select>
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="sr-only"
								for="start_date"><?php esc_html_e( 'Start Date', 'tf-real-estate' ); ?></label>
							<input type="text" id="start_date" value="<?php echo esc_attr( $start_date ); ?>"
								name="start_date" placeholder="<?php esc_attr_e( 'Start Date', 'tf-real-estate' ); ?>"
								class="form-control input_datepicker" autocomplete="off">
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="sr-only"
								for="end_date"><?php esc_html_e( 'End Date', 'tf-real-estate' ); ?></label>
							<input type="text" id="end_date" value="<?php echo esc_attr( $end_date ); ?>" name="end_date"
								placeholder="<?php esc_attr_e( 'End Date', 'tf-real-estate' ); ?>"
								class="form-control input_datepicker" autocomplete="off">
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
						<div class="form-group">
							<input id="search_invoice" type="submit" class="btn btn-accent btn-block"
								value="<?php esc_attr_e( 'Search', 'tf-real-estate' ); ?>">
						</div>
					</div>
				</div>
			</form>
			<div class="tfre-table-listing tfre-table-listing-sc">
				<div class="table-responsive">
					<table class="table table-mobile">
						<thead>
							<tr>
								<?php foreach ( $my_invoices_columns as $key => $column ) : ?>
									<th class="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $column ); ?></th>
								<?php endforeach; ?>
							</tr>
						</thead>
						<tbody>
							<?php if ( ! $invoices ) : ?>
								<tr>
									<td colspan="7" data-title="<?php esc_attr_e( 'Results', 'tf-real-estate' ); ?>">
										<?php esc_html_e( 'You don\'t have any invoices.', 'tf-real-estate' ); ?></td>
								</tr>
							<?php else : ?>
								<?php foreach ( $invoices as $invoice ) :
									$payment_method = get_post_meta( $invoice->ID, 'invoice_payment_method', true );
									$payment_status = get_post_meta( $invoice->ID, 'invoice_payment_status', true );
									$price          = get_post_meta( $invoice->ID, 'invoice_price', true );
									$purchase_date  = get_post_meta( $invoice->ID, 'invoice_purchase_date', true );
									$package_id     = get_post_meta( $invoice->ID, 'invoice_package_id', true );
									$package_name   = get_the_title( $package_id );
									?>
									<tr>
										<?php foreach ( $my_invoices_columns as $key => $column ) : ?>
											<td class="<?php echo esc_attr( $key ); ?>" data-title="<?php echo esc_attr( $column ); ?>">
												<?php
												switch ( $key ) :
													case 'id': ?>
														<a
															href="<?php echo esc_url( tfre_get_permalink( 'my_invoices' ) . '?invoice_id=' . $invoice->ID ); ?>"><?php echo esc_html( $invoice->ID ); ?></a>
														<?php
														break;
													case 'package_name':
														echo esc_html( $package_name );
														break;
													case 'price':
														echo tfre_get_format_number( $price );
														break;
													case 'method':
														echo Invoice_Public::tfre_get_invoice_payment_method( $payment_method );
														break;
													case 'status':
														if ( $payment_status == 1 ) {
															esc_html_e( 'Paid', 'tf-real-estate' );
														} else {
															esc_html_e( 'Not Paid', 'tf-real-estate' );
														}
														break;
													case 'date':
														echo date_i18n( get_option( 'date_format' ), strtotime( $purchase_date ) );
														break;
													case 'action': ?>
														<a class="btn-action" data-toggle="tooltip" data-placement="bottom"
															title="<?php esc_attr_e( 'View Invoice', 'tf-real-estate' ); ?>"
															href="<?php echo esc_url( tfre_get_permalink( 'my_invoices' ) . '?invoice_id=' . $invoice->ID ); ?>">
															<i class="fal fa-eye"></i></a>
														<?php break;
												endswitch; ?>
											</td>
										<?php endforeach; ?>
									</tr>
								<?php endforeach; ?>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
				<script>
					jQuery(document).ready(function ($) {
						if ($('.input_datepicker').length > 0) {
							$('.input_datepicker').datepicker({
								format: 'dd-mm-yyyy',
								language: '<?php echo esc_js( $language_datepicker ); ?>',
								orientation: 'bottom',
								container: '.site-main'
							});
						}
					});
				</script>
			</div>
			<?php tfre_get_template_with_arguments( 'global/pagination.php', array( 'max_num_pages' => $max_num_pages ) ); ?>
		</div>
	</div>
<?php endif; ?>