<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post;
$property_id = get_the_ID();
$author_id   = $post->post_author;
$agent_id    = get_the_author_meta( 'author_agent_id', $author_id );
// Other contact
$property_agent_info = get_post_meta( $property_id, 'property_agent_info', true );
if ( $property_agent_info ) {
	$agent_id = $property_agent_info;
}
$property_agent_information_options = get_post_meta( $property_id, 'agent_information_options', true );
$property_other_agent_name          = get_post_meta( $property_id, 'property_other_agent_name', true );
$property_other_agent_email         = get_post_meta( $property_id, 'property_other_agent_email', true );
$property_other_agent_phone         = get_post_meta( $property_id, 'property_other_agent_phone', true );

$agent_post_meta_data = get_post_custom( $agent_id );
$agent_avatar         = isset( $agent_post_meta_data['agent_avatar'] ) ? $agent_post_meta_data['agent_avatar'][0] : get_the_author_meta( 'profile_image_id', $author_id );
$agent_full_name      = isset( $agent_post_meta_data['agent_full_name'] ) ? $agent_post_meta_data['agent_full_name'][0] : '';
$agent_full_name      = empty( get_the_title( $agent_id ) ) ? $agent_full_name : get_the_title( $agent_id );
$agent_email          = isset( $agent_post_meta_data['agent_email'] ) ? $agent_post_meta_data['agent_email'][0] : '';
$agent_phone          = isset( $agent_post_meta_data['agent_phone_number'] ) ? $agent_post_meta_data['agent_phone_number'][0] : '';
?>
<?php if ( isset( $agent_id ) && ! empty( $agent_id ) ) : ?>
	<div class="contact-property-form">
		<div class="contact-user-wrap">
			<div class="contact-user-avatar">
				<?php
				$width              = tfre_get_option( 'avatar_size_w', '128' );
				$height             = tfre_get_option( 'avatar_size_h', '128' );
				$avatar_src         = tfre_image_resize_id( $agent_avatar, '128', '128', true );
				$no_avatar          = get_avatar_url( $author_id );
				$default_avatar_src = tfre_get_option( 'default_user_avatar', '' )['url'] != '' ? tfre_get_option( 'default_user_avatar', '' )['url'] : $no_avatar;
				?>
				<img loading="lazy" width="<?php echo esc_attr( $width ) ?>" height="<?php echo esc_attr( $height ) ?>"
					src="<?php echo esc_attr( $avatar_src ) ?>"
					onerror="this.src = '<?php echo esc_url( $default_avatar_src ) ?>';" alt="" title="">
			</div>
			<div class="contact-user-info">
				<?php if ( ! empty( $agent_full_name ) || ! empty( $property_other_agent_name ) ) : ?>
					<p class="name">
						<?php
						if ( is_singular( 'real-estate' ) ) :
							echo esc_attr( $property_agent_information_options == 'agent_info' ? $agent_full_name : $property_other_agent_name );
						else :
							echo esc_attr( $agent_full_name );
						endif;
						?>
					</p>
				<?php endif; ?>
				<?php if (tfre_get_option('show_hide_agent_information')['user_phone'] == 1 && (! empty( $agent_phone ) || ! empty( $property_other_agent_phone )) ) : ?>
					<?php if ( is_singular( 'real-estate' ) ) : ?>
						<a href="tel:<?php echo esc_attr( $property_agent_information_options == 'agent_info' ? $agent_phone : $property_other_agent_phone ); ?>"
							class="phone"><?php echo esc_attr( $property_agent_information_options == 'agent_info' ? $agent_phone : $property_other_agent_phone ); ?></a>
					<?php else : ?>
						<a href="tel:<?php echo esc_attr( $agent_phone ); ?>" class="phone"><?php echo esc_attr( $agent_phone ); ?></a>
					<?php endif; ?>

				<?php endif; ?>
				<?php if ( tfre_get_option('show_hide_agent_information')['user_email'] == 1 && (! empty( $agent_email ) || ! empty( $property_other_agent_email )) ) : ?>
					<p class="email">
						<?php
						if ( is_singular( 'real-estate' ) ) :
							echo esc_attr( $property_agent_information_options == 'agent_info' ? $agent_email : $property_other_agent_email );
						else :
							echo esc_attr( $agent_email );
						endif;
						?>
					</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>