<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$show_review = is_array( tfre_get_option( 'single_property_panels_manager' ) ) ? tfre_get_option( 'single_property_panels_manager' )['review'] : false;
if ( $show_review == true ) :
?>
	<div id="nav-review" class="single-property-element property-reviews">
		<div class="row">
			<div class="col-md-12">
				<div class="tfre-property-header">
					<div class="row">
						<div class="col-lg-8 col-md-6 col-sm-12">
							<h3 class="reviews-count">
								<i class="icon-dreamhome-star active"></i>
								<?php echo __( sprintf( '%3$s <span>(%1$s %2$s)</span>', $total_reviews, tfre_get_number_text( $total_reviews, esc_html__( 'Reviews', 'tf-real-estate' ), esc_html__( 'Review', 'tf-real-estate' ) ), esc_html__( 'Review', 'tf-real-estate' ) ), 'tf-real-estate' ); ?>
							</h3>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="filter-review d-flex">
								<label for="order_review"><?php esc_html_e( 'Sort by', 'tf-real-estate' ) ?></label>
								<select id="order_review" class="element nice-slect-2">
									<?php foreach ( $list_filter_review as $filter_key => $filter ) : ?>
										<option value="<?php echo esc_attr($filter_key) ?>" <?php selected( $filter_key, $selected_filter_review ); ?>>
											<?php printf( __( $filter, 'tf-real-estate' ) ); ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<ul class="reviews-list">
			<?php if ( ! is_null( $get_comments ) ) {
				foreach ( $get_comments as $comment ) {
					$author_picture = get_the_author_meta( 'profile_image', $comment->user_id );
					$width          = 70;
					$height         = 70;
					$no_avatar_src  = TF_PLUGIN_URL . 'includes/elementor-widget/assets/images/no-image.jpg';
					$default_avatar = tfre_get_option( 'default_user_avatar', '' );
					if ( is_array( $default_avatar ) && $default_avatar['url'] != '' ) {
						$no_avatar_src = tfre_image_resize_url( $default_avatar['url'], $width, $height, true )['url'];
					}
					$user_link = get_author_posts_url( $comment->user_id );
					?>
					<li class="review-item">
						<div class="review-media">
							<img loading="lazy" width="<?php echo esc_attr( $width ) ?>" height="<?php echo esc_attr( $height ) ?>"
								src="<?php echo esc_url( $author_picture ? $author_picture : '' ) ?>"
								onerror="this.src = '<?php echo esc_url( $no_avatar_src ) ?>';" alt="" title="">
						</div>
						<div class="review-body">
							<div class="media-heading d-flex justify-sb">
								<a href="javascript:void(0)"><?php the_author_meta( 'display_name', $comment->user_id ); ?></a>
								<span class="review-date"><?php echo esc_html(tfre_get_comment_time( $comment->comment_id )); ?></span>
							</div>
							<div class="rating-wrap">
								<div class="form-group">
									<div class="star-rating">
										<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
											<i class="star disabled-click icon-dreamhome-star <?php echo esc_attr($i <= $comment->meta_value ? 'active' : ''); ?>"
												data-rating="<?php echo esc_attr($i); ?>"></i>
										<?php endfor; ?>
									</div>
								</div>
							</div>
							<p class="review-content"> <?php echo esc_html( $comment->comment_content ); ?> </p>
						</div>
					</li>
					<?php
				}
			}
			?>
		</ul>
		<?php if ( tfre_get_option( 'enable_comment_review_property', 'hide' ) != 'hide' ) :
			?>
			<div class="tfre-property-element">
				<div class="tfre-property-header">
					<h3><?php esc_html_e( 'Leave a review', 'tf-real-estate' ); ?></h3>
				</div>
				<div class="add-new-review">
					<?php
					if ( ! is_user_logged_in() ) {
						echo '<h5 class="review-title">' . esc_html__( 'You need to login in order to post a review.', 'tf-real-estate' ) . '</h5>';
					} else {
						?>
						<form method="post" id="tfre_review_form">
							<div class="form-group">
								<label for="review"> <?php esc_html_e( 'Your review', 'tf-real-estate' ); ?> </label>
								<textarea id="review" name="review"
									placeholder="<?php esc_attr_e( 'Your review', 'tf-real-estate' ); ?>"></textarea>
								<span class="text-danger"></span>
							</div>
							<div class="rating-box d-flex">
								<label for="property_rating"> <?php esc_html_e( 'Rating', 'tf-real-estate' ); ?> </label>
								<div class="star-rating">
									<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
										<i class="icon-dreamhome-star" data-rating="<?php echo esc_attr($i); ?>"></i>
									<?php endfor; ?>
								</div>
							</div>
							<button type="submit"
								class="tfre-submit-property-rating button"><?php esc_html_e( 'Submit Review', 'tf-real-estate' ); ?></button>
							<?php wp_nonce_field( 'tfre_submit_review_ajax_nonce', 'tfre_security_submit_review' ); ?>
							<input type="hidden" id="rating-submit" value="5" name="rating">
							<input type="hidden" name="action" value="tfre_property_submit_review_ajax">
							<input type="hidden" name="property_id" value="<?php the_ID(); ?>">
						</form>
						<?php
					}
					?>
				</div>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>