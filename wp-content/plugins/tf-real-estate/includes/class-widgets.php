<?php
if (!defined('ABSPATH')) {
	exit;
}
if (!class_exists('Register_Widgets')) {
	class Register_Widgets
	{
		/**
		 * Construct
		 */
		public function __construct() {
			require_once TF_PLUGIN_PATH . 'includes/widgets/class-widget-login-menu.php';
			require_once TF_PLUGIN_PATH . 'includes/widgets/class-widget-property-search-form.php';
			require_once TF_PLUGIN_PATH . 'includes/widgets/class-widget-agent-search-form.php';
			require_once TF_PLUGIN_PATH . 'includes/widgets/class-widget-agency-search-form.php';
			require_once TF_PLUGIN_PATH . 'includes/widgets/class-widget-contact-agents.php';
			require_once TF_PLUGIN_PATH . 'includes/widgets/class-widget-featured-properties.php';
			require_once TF_PLUGIN_PATH . 'includes/widgets/class-widget-property-taxonomy.php';
			require_once TF_PLUGIN_PATH . 'includes/widgets/class-widget-contact-seller-form.php';
		}

		/**
		 * Register Widgets.
		 */
		public function register_widgets() {
			register_widget('Widget_Login_Menu');
			register_widget('Widget_Property_Search_Form');
			register_widget('Widget_Agent_Search_Form');
			register_widget('Widget_Agency_Search_Form');
			register_widget('Widget_Contact_Agents');
			register_widget('Widget_Featured_Properties');
			register_widget('Widget_Property_Taxonomy');
			register_widget('Widget_Contact_Seller_Form');
		}
	}
}