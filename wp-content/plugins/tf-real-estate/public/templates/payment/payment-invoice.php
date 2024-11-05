<?php
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
wp_enqueue_style( 'tf-pricetable' );
wp_enqueue_script( 'payment-script' );
wp_enqueue_script('stripe-v3');
$package_currency_sign       = tfre_get_option( 'package_currency_sign', '$' );
$package_currency_position   = tfre_get_option( 'package_currency_sign_position', 'before' );
$enable_paypal               = tfre_get_option( 'enable_paypal_setting', 'n' );
$enable_wire_transfer        = tfre_get_option( 'enable_wire_transfer_setting', 'n' );
$enable_stripe = tfre_get_option('enable_stripe_setting', 'n');
$package_page_link           = tfre_get_permalink( 'package_page' );
$payment_term_condition_link = tfre_get_permalink( 'payment_term_condition' );
$allowed_html                = array(
	'a'      => array(
		'href'   => array(),
		'title'  => array(),
		'target' => array()
	),
	'strong' => array()
);

global $current_user;
$current_user = wp_get_current_user();
$user_id      = $current_user->ID;
$package_id   = isset( $_GET['package_id'] ) ? absint( wp_unslash( $_GET['package_id'] ) ) : '';
if ( empty( $package_id ) ) {
	return;
}
$package_title           = get_the_title( $package_id );
$user_package_id         = get_the_author_meta( 'package_id', $user_id );
$user_package_public     = new User_Package_Public();
$check_package_available = $user_package_public->tfre_check_user_package_available( $user_id );
$package_free            = get_post_meta( $package_id, 'package_free', true );
$package_price           = floatval( get_post_meta( $package_id, 'package_price', true ) );
$user_package_price      = floatval( get_post_meta( $user_package_id, 'package_price', true ) );
if ( $package_free == 1 ) {
	$package_price       = 0;
	$package_price_value = $package_price;
}

if ( $package_currency_position == 'before' ) {
	$package_price_value = '<span class="price-type">' . esc_html( $package_currency_sign ) . '</span><span class="price">' . tfre_get_format_number( $package_price ) . '</span>';
} else {
	$package_price_value = '<span class="price">' . tfre_get_format_number( $package_price ) . '</span><span
			class="price-type">' . esc_html( $package_currency_sign ) . '</span>';
}

$package_unlimited_listing = get_post_meta( $package_id, 'package_unlimited_listing', true );
$package_number_listing    = get_post_meta( $package_id, 'package_number_listing', true );
$package_unlimited_time    = get_post_meta( $package_id, 'package_unlimited_time', true );

if ( $package_unlimited_time == 1 ) {
	$package_time_unit         = esc_html__( 'Never Expires', 'tf-real-estate' );
	$package_time              = esc_html__( 'Unlimited', 'tf-real-estate' );
	$package_time_unit_content = $package_time_unit;
} else {
	$package_time_unit        = get_post_meta( $package_id, 'package_time_unit', true );
	$package_number_time_unit = get_post_meta( $package_id, 'package_number_time_unit', true );
	if ( $package_number_time_unit > 1 ) {
		$package_time_unit .= 's';
	}
	$package_time_unit_content = ( ! empty( $package_number_time_unit ) ? $package_number_time_unit : 0 ) . ' ' . $package_time_unit;
	$package_time              = ( ( ! empty( $package_number_time_unit ) && ( $package_number_time_unit > 1 ) ? $package_number_time_unit . ' ' : '' ) . $package_time_unit );
}

if ( $package_unlimited_listing == 1 ) {
	$package_number_listing = esc_html__( 'Unlimited', 'tf-real-estate' );
} else {
	$package_number_listing = ! empty( $package_number_listing ) && ( $package_number_listing > 0 ) ? $package_number_listing : 0;
}
$package_popular                = get_post_meta( $package_id, 'package_popular', true );
$package_number_listing_content = $package_number_listing;
?>
<div class="payment-invoice-wrap row">
	<div class="col-md-4 col-sm-6">
		<div class="payment-invoice">
			<h2 class="panel-heading"><?php esc_html_e( 'Selected Package', 'tf-real-estate' ); ?></h2>
			<div class="tf-pricetable setactive">
				<div class="header-price">
					<div class="title"><?php esc_html_e( $package_title ); ?></div>
					<h4 class="subtitle2"><?php echo get_the_excerpt( $package_id ); ?></h4>
					<div class="content-price"> <?php echo __( $package_price_value ); ?><span
							class="time"><?php echo sprintf( '/%s', $package_time ) ?></span></div>
					<h4 class="subtitle"></h4>
				</div>
				<div class="content-list">
					<div class="inner-content-list">
						<div class="item">
							<span class="wrap-icon"><i class="fa fa-check"></i></span>
							<span
								class="text"><?php echo sprintf( __( 'Expiration Date: <strong>%s</strong>', 'tf-real-estate' ), $package_time_unit_content ); ?></span>
						</div>
						<div class="item">
							<span class="wrap-icon"><i class="fa fa-check"></i></span>
							<span
								class="text"><?php echo sprintf( __( 'Property Listing: <strong>%s</strong>', 'tf-real-estate' ), $package_number_listing_content ); ?></span>
						</div>
					</div>
				</div>
				<div class="wrap-button">
					<a href="<?php echo esc_url( $package_page_link ); ?>"
						class="tf-btn"><?php echo esc_html( 'Change Package', 'tf-real-estate' ) ?><span></span></a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-8 col-sm-6">
		<?php if ( ( $package_id == $user_package_id ) && $check_package_available == 1 ) : ?>
			<div class="alert alert-warning" role="alert">
				<?php echo sprintf( __( 'Your currently "%s" package hasn\'t expired yet, so you can\'t buy it at this time. If you would like, you can buy another package.', 'tf-real-estate' ), $package_title ); ?>
			</div>
		<?php elseif ( $check_package_available == 1 && $package_price < $user_package_price ) : ?>
			<div class="alert alert-warning" role="alert">
				<?php echo sprintf( __( 'If you would like upgrade your package, you have to buy another package with price more than currently package.', 'tf-real-estate' ), $package_title ); ?>
			</div>
		<?php else : ?>
			<?php if ( is_numeric( $package_price ) && ( $package_price > 0 ) ) : ?>
				<div class="payment-method-wrap">
					<div class="heading">
						<h2><?php esc_html_e( 'Payment Method', 'tf-real-estate' ); ?></h2>
					</div>
					<?php if ( $enable_paypal != 'n' ) : ?>
						<label>
							<input type="radio" class="payment-paypal" name="payment_method" value="paypal" checked><i
								class="fa fa-paypal"></i>
							<?php esc_html_e( 'Pay With Paypal', 'tf-real-estate' ); ?>
						</label>
					<?php endif; ?>

					<?php if ( $enable_wire_transfer != 'n' ) : ?>
						<label>
							<input type="radio" class="payment-wire-transfer" name="payment_method" value="wire_transfer">
							<i class="fa fa-send-o"></i> <?php esc_html_e( 'Wire Transfer', 'tf-real-estate' ); ?>
						</label>
						<div class="wire-transfer-info">
							<?php
							$wire_transfer_information = tfre_get_option( 'wire_transfer_information', '' );
							echo wpautop( $wire_transfer_information ); ?>
						</div>
					<?php endif; ?>

					<?php if($enable_stripe != 'n'): ?>
						<label>
							<input type="radio" id="payment-stripe" class="payment-stripe" name="payment_method" value="stripe" />
							<?php esc_html_e('Stripe', 'tf-real-estate'); ?>
						</label>
						<?php Payment_Public::tfre_handle_payment_invoice_by_stripe($package_id); ?>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<input type="hidden" name="package_id" value="<?php echo esc_attr( $package_id ); ?>">
			<p class="terms-conditions"><i class="fa fa-hand-o-right"></i>
				<?php echo sprintf( wp_kses( __( 'Please read <a target="_blank" href="%s"><strong>Terms & Conditions</strong></a> first', 'tf-real-estate' ), $allowed_html ), $payment_term_condition_link ); ?>
			</p>
			<?php if ( is_numeric( $package_price ) && $package_price > 0 ) : ?>
				<button id="payment_per_package" type="submit" class="btn tf-btn btn-submit">
					<?php esc_html_e( 'Pay Now', 'tf-real-estate' ); ?> </button>
			<?php else :
				$user_free_package = get_the_author_meta( 'free_package', $user_id );
				if ( $user_free_package == 'yes' ) : ?>
					<div class="tfre-message alert alert-warning" role="alert">
						<?php esc_html_e( 'You have already used your first free package, please choose different package.', 'tf-real-estate' ); ?>
					</div>
				<?php else : ?>
					<button id="free_package" type="submit" class="btn tf-btn btn-submit">
						<?php esc_html_e( 'Get Free Package', 'tf-real-estate' ); ?> </button>
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</div>
<?php wp_nonce_field( 'tfre_payment_ajax_nonce', 'tfre_security_payment' ); ?>