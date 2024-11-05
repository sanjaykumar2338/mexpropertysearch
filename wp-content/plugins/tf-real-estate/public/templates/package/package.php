<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
wp_enqueue_style( 'tf-pricetable' );
$package_currency_sign     = tfre_get_option( 'package_currency_sign', '$' );
$package_currency_position = tfre_get_option( 'package_currency_sign_position', 'before' );
?>
<div class="package-wrap row gy-5">
	<?php
	$args          = array(
		'post_type'      => 'package',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => 'meta_value_num',
		'meta_key'       => 'package_order_display',
		'order'          => 'ASC',
		'meta_query'     => array(
			array(
				'key'     => 'package_visible',
				'compare' => '=',
				'value'   => '0',
			)
		)
	);
	$packages      = new WP_Query( $args );
	$total_records = $packages->found_posts;
	$css_class     = 'col-md-4 col-sm-6';

	while ( $packages->have_posts() ) :
		$packages->the_post();
		$package_id    = get_the_ID();
		$package_price = get_post_meta( $package_id, 'package_price', true );
		$package_free  = get_post_meta( $package_id, 'package_free', true );
		if ( $package_free == 1 ) {
			$package_price = 0;
		}
		if ( $package_currency_position == 'before' ) {
			$package_price = '<span class="price-type">' . esc_html( $package_currency_sign ) . '</span><span class="price">' . tfre_get_format_number( floatval( $package_price ) ) . '</span>';
		} else {
			$package_price = '<span class="price">' . tfre_get_format_number( floatval( $package_price ) ) . '</span><span
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
			$package_number_listing = ! empty( $package_number_listing ) && $package_number_listing > 0 ? $package_number_listing : 0;
		}
		$package_number_listing_content = $package_number_listing;

		$package_popular       = get_post_meta( $package_id, 'package_popular', true );
		$package_visible       = get_post_meta( $package_id, 'package_visible', true );
		$package_order_display = get_post_meta( $package_id, 'package_order_display', true );

		if ( $package_popular == 1 ) {
			$is_popular = 'setactive';
		} else {
			$is_popular = 'noactive';
		}
		$payment_link         = tfre_get_permalink( 'payment_invoice_page' );
		$payment_process_link = add_query_arg( 'package_id', $package_id, $payment_link );
		?>
		<div class="<?php echo esc_attr( $css_class ); ?>">
			<div class="tf-pricetable <?php echo esc_attr( $is_popular ); ?>">
				<?php if ( $package_popular == 1 ) : ?>
					<span
						class="popular-label <?php echo esc_attr( $is_popular ); ?>"><?php echo esc_html( 'Popular', 'tf-real-estate' ) ?></span>
				<?php endif; ?>
				<div class="header-price">
					<div class="title"><?php esc_html_e( get_the_title( $package_id ) ); ?></div>
					<h4 class="subtitle2"><?php the_excerpt(); ?></h4>
					<div class="content-price"> <?php echo __( $package_price ); ?> <span
							class="time"><?php echo sprintf( '/%s', $package_time ) ?></span>
					</div>
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
					<a href="<?php echo esc_url( $payment_process_link ); ?>"
						class="tf-btn"><?php echo esc_html( 'Get started', 'tf-real-estate' ) ?><span></span></a>
				</div>
			</div>
		</div>
	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
</div>