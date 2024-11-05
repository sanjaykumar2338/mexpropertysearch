<?php
/**
 * @var $package_id
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! is_user_logged_in() ) {
	tfre_get_template_with_arguments( 'global/access-permission.php', array( 'type' => 'not_login' ) );
	return;
}
wp_enqueue_style( 'tf-pricetable' );
$package_currency_sign     = tfre_get_option( 'package_currency_sign', '$' );
$package_currency_position = tfre_get_option( 'package_currency_sign_position', 'before' );
$package_unlimited_time    = get_post_meta( $package_id, 'package_unlimited_time', true );
$package_number_listing    = get_user_meta( $current_user_id, 'package_number_listing', true );
$package_unlimited_listing = get_post_meta( $package_id, 'package_unlimited_listing', true );
if ( $package_unlimited_time == 1 ) {
	$package_time_unit   = esc_html__( 'Never Expires', 'tf-real-estate' );
	$package_time        = esc_html__( 'Unlimited', 'tf-real-estate' );
	$package_expiry_date = $package_time_unit;
} else {
	$user_package_public      = new User_Package_Public();
	$package_expiry_date      = $user_package_public->tfre_get_expired_date( $package_id, $current_user_id );
	$package_time_unit        = get_post_meta( $package_id, 'package_time_unit', true );
	$package_number_time_unit = get_post_meta( $package_id, 'package_number_time_unit', true );
	if ( $package_number_time_unit > 1 ) {
		$package_time_unit .= 's';
	}
	$package_time = ( ( ! empty( $package_number_time_unit ) && ( $package_number_time_unit > 1 ) ? $package_number_time_unit . ' ' : '' ) . $package_time_unit );
}
if ( $package_unlimited_listing == 1 ) {
	$package_number_listing = esc_html__( 'Unlimited', 'tf-real-estate' );
} else {
	$package_number_listing = ! empty( $package_number_listing ) && $package_number_listing > 0 ? $package_number_listing : 0;
}
$package_number_listing_content = $package_number_listing;
$package_price                  = get_post_meta( $package_id, 'package_price', true );
$package_free                   = get_post_meta( $package_id, 'package_free', true );
if ( $package_free == 1 ) {
	$package_price = 0;
}
if ( $package_currency_position == 'before' ) {
	$package_price = '<span class="price-type">' . esc_html( $package_currency_sign ) . '</span><span class="price">' . tfre_get_format_number( floatval( $package_price ) ) . '</span>';
} else {
	$package_price = '<span class="price">' . tfre_get_format_number( floatval( $package_price ) ) . '</span><span
			class="price-type">' . esc_html( $package_currency_sign ) . '</span>';
}

$package_link = tfre_get_permalink( 'package_page' );
?>

<div class="package-wrap row px-5">
	<?php if ( ! empty( $package_id ) ) : ?>
		<div class="tf-pricetable setactive col-md-6 col-xl-4">
			<span class="active-label setactive"><?php echo esc_html( 'Active', 'tf-real-estate' ) ?></span>
			<div class="header-price">
				<div class="title"><?php esc_html_e( get_the_title( $package_id ) ); ?></div>
				<h4 class="subtitle2"><?php echo get_the_excerpt( $package_id ); ?></h4>
				<div class="content-price"> <?php echo __( $package_price ); ?><span
						class="time"><?php echo sprintf( '/%s', $package_time ) ?></span></div>
				<h4 class="subtitle"></h4>
			</div>
			<div class="content-list">
				<div class="inner-content-list">
					<div class="item">
						<span class="wrap-icon"><i class="fa fa-check"></i></span>
						<span
							class="text"><?php echo sprintf( __( 'Expiry Date: <strong>%s</strong>', 'tf-real-estate' ), $package_expiry_date ); ?></span>
					</div>
					<div class="item">
						<span class="wrap-icon"><i class="fa fa-check"></i></span>
						<span
							class="text"><?php echo sprintf( __( 'Property Listing: <strong>%s</strong>', 'tf-real-estate' ), $package_number_listing_content ); ?></span>
					</div>
				</div>
			</div>
			<div class="wrap-button">
				<a href="<?php echo esc_url( $package_link ); ?>"
					class="tf-btn"><?php echo esc_html( 'Upgrade', 'tf-real-estate' ) ?><span></span></a>
			</div>
		</div>
	<?php else : ?>
		<div class="alert alert-warning" role="alert">
			<?php echo __( 'You hasn\'t package yet. If you would like, you can buy package.', 'tf-real-estate' ); ?>
		</div>
		<div class="wrap-button">
			<a href="<?php echo esc_url( $package_link ); ?>"
				class="tf-btn"><?php echo esc_html( 'Buy Package', 'tf-real-estate' ) ?><span></span></a>
		</div>
	<?php endif; ?>
</div>