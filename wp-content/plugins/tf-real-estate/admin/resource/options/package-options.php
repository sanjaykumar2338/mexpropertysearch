<?php
return array(
	'title'  => esc_html__( 'Package Options', 'tf-real-estate' ),
	'id'     => 'package-options',
	'desc'   => '',
	'icon'   => 'el el-folder',
	'fields' => array(
		array(
			'id'      => 'enable_package',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Enable Package', 'tf-real-estate' ),
			'options' => array(
				'y' => esc_html__( 'Yes', 'tf-real-estate' ),
				'n' => esc_html__( 'No', 'tf-real-estate' ),
			),
			'default' => 'y',
			'class'   => 'hide-icon-blank',
		),
        array(
			'id'    => 'package_currency_sign',
			'type'  => 'text',
			'title' => esc_html__( 'Currency Sign', 'tf-real-estate' ),
		),
        array(
			'id'      => 'package_currency_sign_position',
			'type'    => 'select',
			'title'   => esc_html__( 'Currency Sign Position', 'tf-real-estate' ),
			'options' => array(
				'before' => esc_html__( 'Before ($1,000)', 'tf-real-estate' ),
				'after'  => esc_html__( 'After (1,000$)', 'tf-real-estate' ),
			),
			'default' => 'before',
		),

    )
);