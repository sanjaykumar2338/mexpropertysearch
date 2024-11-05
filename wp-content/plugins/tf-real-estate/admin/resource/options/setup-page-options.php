<?php
return array(
	'title'  => esc_html__( 'Setup Page Options', 'tf-real-estate' ),
	'id'     => 'setup-page-options',
	'desc'   => '',
	'icon'   => 'el el-link',
	'fields' => array(
		array(
			'id'      => 'add_property_page',
			'type'    => 'select',
			'title'   => esc_html__( 'Add Property', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Select page to show at add property page', 'tf-real-estate' ),
			'options' => tfre_get_all_pages(),
		),
		array(
			'id'      => 'my_properties_page',
			'type'    => 'select',
			'title'   => esc_html__( 'My Properties', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Select page to show at my properties page', 'tf-real-estate' ),
			'options' => tfre_get_all_pages(),
		),
		array(
			'id'      => 'my_invoices_page',
			'type'    => 'select',
			'title'   => esc_html__( 'My Invoices', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Select page to show at my invoice page', 'tf-real-estate' ),
			'options' => tfre_get_all_pages(),
		),
		array(
			'id'      => 'my_package_page',
			'type'    => 'select',
			'title'   => esc_html__( 'My Package', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Select page to show at my package page', 'tf-real-estate' ),
			'options' => tfre_get_all_pages(),
		),
		array(
			'id'      => 'my_profile_page',
			'type'    => 'select',
			'title'   => esc_html__( 'My Profile', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Select page to show at my profile page', 'tf-real-estate' ),
			'options' => tfre_get_all_pages(),
		),
		array(
			'id'      => 'my_favorites_page',
			'type'    => 'select',
			'title'   => esc_html__( 'My Favorites', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Select page to show at my favorites page', 'tf-real-estate' ),
			'options' => tfre_get_all_pages(),
		),
		array(
			'id'      => 'my_reviews_page',
			'type'    => 'select',
			'title'   => esc_html__( 'My Reviews', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Select page to show at my reviews page', 'tf-real-estate' ),
			'options' => tfre_get_all_pages(),
		),
		array(
			'id'      => 'my_saved_advanced_searches_page',
			'type'    => 'select',
			'title'   => esc_html__( 'My Saved Searches', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Select page to show at my saved searches page', 'tf-real-estate' ),
			'options' => tfre_get_all_pages(),
		),
		array(
			'id'      => 'advanced_search_page',
			'type'    => 'select',
			'title'   => esc_html__( 'Advanced Search', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Select page to show at advanced search page', 'tf-real-estate' ),
			'options' => tfre_get_all_pages(),
		),
		array(
			'id'      => 'login_page',
			'type'    => 'select',
			'title'   => esc_html__( 'Login', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Select page to show at login page', 'tf-real-estate' ),
			'options' => tfre_get_all_pages(),
		),
		array(
			'id'      => 'register_page',
			'type'    => 'select',
			'title'   => esc_html__( 'Register', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Select page to show at register page', 'tf-real-estate' ),
			'options' => tfre_get_all_pages(),
		),
		array(
			'id'      => 'compare_page',
			'type'    => 'select',
			'title'   => esc_html__( 'Compare', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Select page to show at compare page', 'tf-real-estate' ),
			'options' => tfre_get_all_pages(),
		),
		array(
			'id'      => 'dashboard_page',
			'type'    => 'select',
			'title'   => esc_html__( 'Dashboard', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Select page to show at dashboard page', 'tf-real-estate' ),
			'options' => tfre_get_all_pages(),
		),
		array(
			'id'      => 'properties_page',
			'type'    => 'select',
			'title'   => esc_html__( 'Properties', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Select page to show at properties page', 'tf-real-estate' ),
			'options' => tfre_get_all_pages(),
		),
		array(
			'id'      => 'agent_page',
			'type'    => 'select',
			'title'   => esc_html__( 'Agent', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Select page to show at agent page', 'tf-real-estate' ),
			'options' => tfre_get_all_pages(),
		),
		array(
			'id'      => 'agency_page',
			'type'    => 'select',
			'title'   => esc_html__( 'Agency', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Select page to show at agency page', 'tf-real-estate' ),
			'options' => tfre_get_all_pages(),
		),
		array(
			'id'      => 'payment_term_condition',
			'type'    => 'select',
			'title'   => esc_html__( 'Payment Terms & Conditions', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Select page to show at payment terms & conditions page', 'tf-real-estate' ),
			'options' => tfre_get_all_pages(),
		),
		array(
			'id'      => 'package_page',
			'type'    => 'select',
			'title'   => esc_html__( 'Package', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Select page to show at package page', 'tf-real-estate' ),
			'options' => tfre_get_all_pages(),
		),
		array(
			'id'      => 'payment_invoice_page',
			'type'    => 'select',
			'title'   => esc_html__( 'Payment Invoice', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Select page to show at payment invoice page', 'tf-real-estate' ),
			'options' => tfre_get_all_pages(),
		),
		array(
			'id'      => 'payment_completed_page',
			'type'    => 'select',
			'title'   => esc_html__( 'Payment Completed', 'tf-real-estate' ),
			'desc'    => esc_html__( 'Select page to show at payment completed page', 'tf-real-estate' ),
			'options' => tfre_get_all_pages(),
		),
	)
);
?>