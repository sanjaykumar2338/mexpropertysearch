<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if ( ! is_user_logged_in() ) {
	tfre_get_template_with_arguments( 'global/access-permission.php', array( 'type' => 'not_login' ) );
	return;
}

$is_agent                 = tfre_is_agent();
$user_can_become_agent    = tfre_get_option( 'user_can_become_agent', 'y' );
$show_hide_profile_fields = tfre_get_option( 'show_hide_profile_fields', array() );
?>
<div class="tfre_profile-form">
	<form class="tfre_profile" method="post" enctype="multipart/form-data" id="tfre_profile-form">
		<h3 class="form-title"><?php esc_html_e( 'Account Settings', 'tf-real-estate' ); ?></h3>
		<div class="tfre_become_agent">
			<div class="error_message tfre_agent_message"></div>
			<?php
			$message      = '';
			$agent_id     = get_the_author_meta( 'author_agent_id', $user_data['user_id'] );
			$agent_status = get_post_status( $agent_id );
			if ( $user_can_become_agent == 'y' ) {
				if ( ! $is_agent && ! $agent_id ) {
					$message = esc_html__( 'Your current account type is normal. If you want to become an agent, please click on button Become an Agent', 'tf-real-estate' );
				} else {
					if ( $agent_status == 'publish' ) {
						$message = esc_html__( 'Your current account type is set to agent, if you want to remove your agent account, and return to normal account, you must click the button below', 'tf-real-estate' );
					} else {
						$message = esc_html__( 'Your account need to be approved by admin to become an agent, if you want to return to normal account, you must click the button below', 'tf-real-estate' );
					}
				}
			}
			?>
			<h4><?php esc_html_e( 'Agent Account', 'tf-real-estate' ); ?></h4>
			<div class="tfre-message alert alert-warning" role="alert"><?php echo wp_kses_post( $message ); ?></div>
			<?php if ( ! $is_agent && ! $agent_id ) : ?>
				<button type="button" class="button"
					id="tfre_become_agent"><?php esc_html_e( 'Become an Agent', 'tf-real-estate' ); ?></button>
			<?php else : ?>
				<button type="button" class="button"
					id="tfre_leave_agent"><?php esc_html_e( 'Remove Agent Account', 'tf-real-estate' ); ?></button>
			<?php endif; ?>
		</div>
		<div class="error_message tfre_message"></div>
		<h3><?php esc_html_e( 'Avatar', 'tf-real-estate' ); ?></h3>
		<div class="tfre_choose_avatar d-flex">
			<div class="avatar">
				<div class="form-group">
					<?php
					$width              = tfre_get_option( 'avatar_size_w', '128' );
					$height             = tfre_get_option( 'avatar_size_h', '128' );
					$avatar_src         = tfre_image_resize_id( $user_data['user_avatar_id'], '128', '128', true );
					$no_avatar          = get_avatar_url( $user_data['user_id'] );
					$default_avatar_src = tfre_get_option( 'default_user_avatar', '' )['url'] != '' ? tfre_get_option( 'default_user_avatar', '' )['url'] : $no_avatar;
					?>
					<img loading="lazy" width="<?php echo esc_attr( $width ); ?>"
						height="<?php echo esc_attr( $height ); ?>" id="tfre_avatar_thumbnail"
						src="<?php echo esc_attr($avatar_src); ?>"
						onerror="this.src = '<?php echo esc_url( $default_avatar_src ) ?>';" alt="avatar" title="">
				</div>
			</div>
			<div class="choose-box">
				<label><?php esc_html_e( 'Upload a new avatar:', 'tf-real-estate' ); ?></label>
				<div class="form-group">
					<input type="file" class="form-control" id="tfre_avatar" name="profile_image"
						value="<?php echo esc_attr($user_data['user_avatar']) ?>">
					<input type="text" class="form-control" id="tfre_avatar_id" name="profile_image_id"
						value="<?php echo esc_attr($user_data['user_avatar_id']) ?>" hidden>
				</div>
				<span class="nofi-avt"><?php esc_html_e( 'JPEG 100x100', 'tf-real-estate' ); ?></span>
			</div>
		</div>
		<?php if ( $user_data['agent_id'] != '' && tfre_is_agent( $user_data['agent_id'] ) ) : ?>
			<h3><?php esc_html_e( 'Agent Poster', 'tf-real-estate' ); ?></h3>
			<div class="tfre_choose_agent_poster d-flex">
				<div class="agent_poster">
					<div class="form-group">
						<?php
						$poster_width   = '350';
						$poster_height  = '200';
						$default_poster = tfre_get_option( 'default_user_avatar', '' );
						$default_agent_poster = TF_PLUGIN_URL . "includes/elementor-widget/assets/images/no-image.jpg";
						if ( is_array( $default_poster ) && $default_poster['url'] != '' ) {
							$default_agent_poster = tfre_image_resize_url( $default_poster['url'], $width, $height, true )['url'];
						}
						$agent_poster_src = $user_data['agent_poster'] != '' ? $user_data['agent_poster'] : $default_agent_poster;
						?>
						<img loading="lazy" width="<?php echo esc_attr( $poster_width ); ?>"
							height="<?php echo esc_attr( $poster_height ); ?>" id="tfre_agent_poster_thumb"
							src="<?php echo esc_attr($agent_poster_src); ?>"
							onerror="this.src = '<?php echo esc_url( $default_agent_poster ) ?>';" alt="" title="">
					</div>
				</div>
				<div class="choose-box">
					<label><?php esc_html_e( 'Upload agent poster:', 'tf-real-estate' ); ?></label>
					<div class="form-group">
						<input type="file" class="form-control" id="tfre_agent_poster" name="agent_poster"
							value="<?php echo esc_attr($user_data['agent_poster']) ?>">
					</div>
					<span class="notify-agent-poster"><?php esc_html_e( 'JPEG 350x200', 'tf-real-estate' ); ?></span>
				</div>
			</div>
		<?php endif; ?>
		<h3><?php esc_html_e( 'Information', 'tf-real-estate' ); ?></h3>
		<div class="tfre-form-group">
			<?php if ( $show_hide_profile_fields["full_name"] == 1 ) : ?>
				<label
					for="full_name"><?php echo esc_html_e( 'Full name', 'tf-real-estate' ) . tfre_required_field( 'full_name', 'require_profile_fields' ); ?></label>
				<input type="text" class="form-control" name="full_name" id="full_name"
					value="<?php echo esc_attr($user_data['full_name']) ?>">
			<?php endif; ?>
			<?php if ( $show_hide_profile_fields["user_description"] == 1 ) : ?>
				<label
					for="description"><?php echo esc_html_e( 'Description:', 'tf-real-estate' ) . tfre_required_field( 'user_description', 'require_profile_fields' ); ?></label>
				<textarea id="description" name="user_description"><?php echo esc_attr($user_data['user_description']) ?></textarea>
			<?php endif; ?>
		</div>

		<div class="row">
			<?php if ( $show_hide_profile_fields["user_company"] == 1 ) : ?>
				<div class="col-md-3">
					<label
						for="company"><?php echo esc_html_e( 'Your Company', 'tf-real-estate' ) . tfre_required_field( 'user_company', 'require_profile_fields' ); ?></label>
					<input type="text" class="form-control" name="user_company" id="company"
						value="<?php echo esc_attr($user_data['user_company']) ?>">
				</div>
			<?php endif; ?>
			<?php if ( $is_agent ) : ?>
				<?php if ( $show_hide_profile_fields["user_position"] == 1 ) : ?>
					<div class="col-md-3">
						<label
							for="position"><?php echo esc_html_e( 'Position', 'tf-real-estate' ) . tfre_required_field( 'user_position', 'require_profile_fields' ); ?></label>
						<input type="text" class="form-control" name="user_position" id="position"
							value="<?php echo esc_attr($user_data['user_position']) ?>">
					</div>
				<?php endif; ?>
				<?php if ( $show_hide_profile_fields["user_office_number"] == 1 ) : ?>
					<div class="col-md-3">
						<label
							for="office_number"><?php echo esc_html_e( 'Office Number', 'tf-real-estate' ) . tfre_required_field( 'user_office_number', 'require_profile_fields' ); ?></label>
						<input type="text" class="form-control" name="user_office_number" id="office_number"
							value="<?php echo esc_attr($user_data['user_office_number']) ?>">
					</div>
				<?php endif; ?>
				<?php if ( $show_hide_profile_fields["user_office_address"] == 1 ) : ?>
					<div class="col-md-3">
						<label
							for="office_address"><?php echo esc_html_e( 'Office Address', 'tf-real-estate' ) . tfre_required_field( 'user_office_address', 'require_profile_fields' ); ?></label>
						<input type="text" class="form-control" name="user_office_address" id="office_address"
							value="<?php echo esc_attr($user_data['user_office_address']) ?>">
					</div>
				<?php endif; ?>
				<?php if ( $show_hide_profile_fields["user_licenses"] == 1 ) : ?>
					<div class="col-md-3">
						<label
							for="user_licenses"><?php echo esc_html_e( 'Licenses', 'tf-real-estate' ) . tfre_required_field( 'user_licenses', 'require_profile_fields' ); ?></label>
						<input type="text" class="form-control" name="user_licenses" id="user_licenses"
							value="<?php echo esc_attr($user_data['user_licenses']) ?>">
					</div>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ( $show_hide_profile_fields["user_job"] == 1 ) : ?>
				<div class="col-md-3">
					<label
						for="job"><?php echo esc_html_e( 'Job', 'tf-real-estate' ) . tfre_required_field( 'user_job', 'require_profile_fields' ); ?></label>
					<input type="text" class="form-control" name="user_job" id="job"
						value="<?php echo esc_attr($user_data['user_job']) ?>">
				</div>
			<?php endif; ?>
			<?php if ( $show_hide_profile_fields["user_email"] == 1 ) : ?>
				<div class="col-md-3">
					<label
						for="email"><?php echo esc_html_e( 'Email address', 'tf-real-estate' ) . tfre_required_field( 'user_email', 'require_profile_fields' ); ?></label>
					<input type="email" class="form-control" name="user_email" id="email"
						value="<?php echo esc_attr($user_data['user_email']) ?>" required>
				</div>
			<?php endif; ?>
			<?php if ( $show_hide_profile_fields["user_phone"] == 1 ) : ?>
				<div class="col-md-3">
					<label
						for="phone"><?php echo esc_html_e( 'Your Phone', 'tf-real-estate' ) . tfre_required_field( 'user_phone', 'require_profile_fields' ); ?></label>
					<input type="text" class="form-control" name="user_phone" id="phone"
						value="<?php echo esc_attr($user_data['user_phone']) ?>">
				</div>
			<?php endif; ?>
		</div>


		<div class="map">

		</div>
		<?php if ( $show_hide_profile_fields["user_location"] == 1 ) : ?>
			<label
				for="location"><?php echo esc_html_e( 'Location', 'tf-real-estate' ) . tfre_required_field( 'user_location', 'require_profile_fields' ); ?></label>
			<input type="text" class="form-control" name="user_location" id="location"
				value="<?php echo esc_attr($user_data['user_location']) ?>">
		<?php endif; ?>
		<?php if ( $is_agent ) : ?>
			<?php if ( $show_hide_profile_fields["user_select_agency"] == 1 ) : ?>
				<div class="form-group">
					<label for="agencies">
						<?php echo esc_html_e( 'Select User Agency', 'tf-real-estate' ); ?>
					</label>
					<select name="agencies[]" id="agencies" class="form-control" multiple="multiple">
						<?php tfre_get_multiple_taxonomy_by_post_id( $agent_id, 'agencies', true, false, true ); ?>
					</select>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		<?php if ( $show_hide_profile_fields["user_socials"] == 1 ) : ?>
			<label
				for="user_facebook"><?php echo esc_html_e( 'Facebook', 'tf-real-estate' ) . tfre_required_field( 'user_socials', 'require_profile_fields' ); ?></label>
			<input type="text" class="form-control" name="user_facebook" id="user_facebook"
				value="<?php echo esc_attr($user_data['user_facebook']) ?>">
		<?php endif; ?>
		<?php if ( $show_hide_profile_fields["user_socials"] == 1 ) : ?>
			<label
				for="user_twitter"><?php echo esc_html_e( 'Twitter', 'tf-real-estate' ) . tfre_required_field( 'user_socials', 'require_profile_fields' ); ?></label>
			<input type="text" class="form-control" name="user_twitter" id="user_twitter"
				value="<?php echo esc_attr($user_data['user_twitter']) ?>">
		<?php endif; ?>
		<?php if ( $show_hide_profile_fields["user_socials"] == 1 ) : ?>
			<label
				for="user_linkedin"><?php echo esc_html_e( 'Linkedin', 'tf-real-estate' ) . tfre_required_field( 'user_socials', 'require_profile_fields' ); ?></label>
			<input type="text" class="form-control" name="user_linkedin" id="user_linkedin"
				value="<?php echo esc_attr($user_data['user_linkedin']) ?>">
		<?php endif; ?>
		<button id="tfre_profile_submit" type="submit"><?php esc_html_e( 'Save & Update', 'tf-real-estate' ); ?></button>
	</form>
	<?php tfre_get_template_with_arguments( 'account/change-password.php' ); ?>
</div>