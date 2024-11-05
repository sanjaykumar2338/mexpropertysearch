<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if ( ! is_user_logged_in() ) : ?>
	<a href="javascript:void(0)" class="display-pop-login topbar-link" data-toggle="modal"><i class="fa fa-user"></i><span
			class="hidden-xs"><?php esc_html_e( 'Login or Register', 'tf-real-estate' ) ?></span></a>
<?php else :
	global $current_user;
	wp_get_current_user();
	$user_display_name = $current_user->display_name;
	$user_id           = $current_user->ID;
	$user_avatar       = get_the_author_meta( 'profile_image', $user_id );
	$no_avatar         = get_avatar_url( $user_id );
	$default_image_src = tfre_get_option( 'default_user_avatar', '' )['url'] != '' ? tfre_get_option( 'default_user_avatar', '' )['url'] : $no_avatar;
	$menus             = tfre_get_menu_user_login();
	?>
	<div class="user-dropdown dropdown">
		<span class="user-display-name dropdown-toggle" id="dropdown-menu-user-login" data-toggle="dropdown"
			aria-haspopup="true" aria-expanded="false">
			<img loading="lazy" id="tfre_avatar_thumbnail" src="<?php echo esc_attr( $user_avatar ); ?>"
				onerror="this.src = '<?php echo esc_url( $default_image_src ) ?>';"
				alt="<?php echo esc_attr( $user_display_name ); ?>" title="<?php echo esc_attr( $user_display_name ); ?>">
			<span class="display-name hidden-xs"><?php echo esc_html( $user_display_name ); ?></span>
		</span>
		<div class="dropdown-menu" aria-labelledby="dropdown-menu-user-login">
			<ul class="user-dropdown-menu list-group">
				<?php $key = 1;
				foreach ( $menus as $menu ) : ?>
					<li class="list-group-item">
						<a href="<?php echo esc_url( $menu['url'] ); ?>" class="menu-index-<?php echo esc_attr( $key ); ?>">
							<?php echo wp_kses_post( $menu['icon'] );
							echo esc_html( $menu['label'] ); ?>
							<span><?php echo esc_html( $menu['total'] ? sprintf( __( "(%s)" ), $menu['total'] ) : '' ); ?></span>
						</a>
					</li>
					<?php
					$key++;
				endforeach; ?>
			</ul>
		</div>
	</div>
<?php endif; ?>