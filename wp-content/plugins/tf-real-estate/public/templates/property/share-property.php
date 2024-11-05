<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$property_id  = get_the_ID();
$sl_url       = get_permalink( $property_id );
$facebookURL  = TF_PLUGIN_PROTOCOL . '://www.facebook.com/sharer/sharer.php?u=' . $sl_url;
$tweetURL     = TF_PLUGIN_PROTOCOL . '://twitter.com/intent/tweet?url=' . $sl_url;
$linkedinURL  = TF_PLUGIN_PROTOCOL . '://www.linkedin.com/shareArticle?mini=true&amp;url=' . $sl_url;
$pinterestURL = TF_PLUGIN_PROTOCOL . '://pinterest.com/pin/create/bookmarklet/?url=' . $sl_url;
$skypeURL     = TF_PLUGIN_PROTOCOL . '://web.skype.com/share?url=' . $sl_url;
$whatsappURL     = TF_PLUGIN_PROTOCOL . '://wa.me/?text=' . $sl_url;
global $show_hide_actions_button;
$show_hide_list_social_button = tfre_get_option( 'show_hide_list_social_button', array() );
if ( ! is_array( $show_hide_list_social_button ) ) {
	$show_hide_list_social_button = array();
}
?>
<div class="dropdown">
	<a href="#" class="tfre-property-share hv-tool dropdown-toggle" data-toggle="dropdown" data-toggle="tooltip"
		data-tooltip="<?php esc_attr_e('Share', 'tf-real-estate'); ?>"><i class="far fa-share-alt"></i></a>
	<div class="dropdown-menu">
		<?php if($show_hide_list_social_button["social-actions-facebook"] == 1): ?>
		<li><a href="<?php echo esc_attr( $facebookURL ) ?>" class="menu-social" target="_blank"><i
					class="fab fa-facebook-f"></i> Facebook</a></li>
		<?php endif; ?>
		<?php if($show_hide_list_social_button["social-actions-twitter"] == 1 ) : ?>
		<li><a href="<?php echo esc_attr( $tweetURL ) ?>" class="menu-social" target="_blank"><i
					class="fab fa-twitter"></i> Twitter</a></li>
		<?php endif; ?>
		<?php if($show_hide_list_social_button["social-actions-linkedin"] == 1 ) : ?>
		<li><a href="<?php echo esc_attr( $linkedinURL ) ?>" class="menu-social" target="_blank"><i
					class="fab fa-linkedin-in"></i> Linkedin</a></li>
		<?php endif; ?>
		<?php if($show_hide_list_social_button["social-actions-pinterest"] == 1 ) : ?>
		<li><a href="<?php echo esc_attr( $pinterestURL ) ?>" class="menu-social" target="_blank"><i
					class="fab fa-pinterest-p"></i> Pinterest</a></li>
		<?php endif; ?>
		<?php if($show_hide_list_social_button["social-actions-skype"] == 1): ?>
		<li><a href="<?php echo esc_attr( $skypeURL ) ?>" class="menu-social" target="_blank"><i class="fab fa-skype"></i>
				Skype</a></li>
		<?php endif; ?>
		<?php if($show_hide_list_social_button["social-actions-whatsapp"] == 1 ) : ?>
		<li><a href="<?php echo esc_attr( $whatsappURL ) ?>" class="menu-social" target="_blank"><i class="fab fa-whatsapp"></i>
				Whatsapp</a></li>
		<?php endif; ?>
	</div>
</div>