<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="modal modal-login fade" id="tfre_login_register_modal" tabindex="-1" role="dialog">
	<div class="modal-align-item">
		<div class="modal-dialog" role="document">
			<div class="tfre-login-form">
				<div class="feature-login-form">
						<?php if (!empty(themesflat_get_opt('feature_form_login'))): ?>
							<img loading="lazy" src="<?php echo esc_url(themesflat_get_opt('feature_form_login')) ?>" class="thumb-login" alt="images">
							<?php if (!empty(themesflat_get_opt('feature_form_register'))): ?>
								<img loading="lazy" src="<?php echo esc_url(themesflat_get_opt('feature_form_register')) ?>" class="thumb-register" alt="images">
							<?php endif; ?>
						<?php else: ?>
							<img loading="lazy" src="<?php bloginfo('template_url'); ?>/images/no-thumbnail.gif" alt="image default">
						<?php endif; ?>
				</div>
				<div class="modal-content">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
								aria-hidden="true">&times;</span></button>
					<?php echo do_shortcode( '[custom_login_form]' ); ?>
				</div>
			</div>
		</div>
	</div>
</div>