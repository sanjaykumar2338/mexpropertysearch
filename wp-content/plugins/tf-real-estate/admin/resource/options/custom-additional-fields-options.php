<?php
return array(
	'title'  => esc_html__( 'Custom Additional Fields', 'tf-real-estate' ),
	'id'     => 'custom-additional-fields-options',
	'desc'   => '',
	'icon'   => 'el el-file-new',
	'fields' => array(
		array(
			'id'           => 'additional_fields',
			'type'         => 'repeater',
			'title'        => esc_html__( 'Property Detail Fields', 'tf-real-estate' ),
			'subtitle'     => esc_html__( 'Add more custom additional field for property detail', 'tf-real-estate' ),
			'group_values' => true,
			'init_empty'   => true,
			'fields'       => array(
				array(
					'id'          => 'additional_field_label',
					'type'        => 'text',
					'title'       => esc_html__( 'Label', 'tf-real-estate' ),
					'placeholder' => esc_html__( 'Label', 'tf-real-estate' ),
				),
				array(
					'id'          => 'additional_field_name',
					'type'        => 'text',
					'title'       => esc_html__( 'Name', 'tf-real-estate' ),
					'placeholder' => esc_html__( 'Name', 'tf-real-estate' ),
				),
				array(
					'id'          => 'additional_field_type',
					'type'        => 'select',
					'title'       => esc_html__( 'Select Field Type', 'tf-real-estate' ),
					'options'     => array(
						'text'     => esc_html__( 'Text', 'tf-real-estate' ),
						'textarea' => esc_html__( 'Textarea', 'tf-real-estate' ),
						'select'   => esc_html__( 'Select', 'tf-real-estate' ),
						'radio'    => esc_html__( 'Radio', 'tf-real-estate' ),
						'checkbox' => esc_html__( 'Checkbox', 'tf-real-estate' ),
					),
					'placeholder' => esc_html__( 'Field Type', 'tf-real-estate' ),
				),
				array(
					'id'       => 'additional_field_option_value',
					'type'     => 'multi_text',
					'title'    => esc_html__( 'Options Value', 'tf-real-estate' ),
					'required' => array(
						array( 'additional_field_type', '=', array( 'select', 'radio', 'checkbox' ) )
					)
				),
			)
		)
	)
);