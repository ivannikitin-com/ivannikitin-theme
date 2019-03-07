<?php
add_action('customize_register', function($customizer) {

	$customizer->add_section(
		'header_settings', array(
				'title'         => __( 'Шапка', 'in-2019' ),
				'description'   => __( 'Контактная информация на сайте', 'in-2019' ),
				'priority'      => 11,
		)
	);

	$customizer->add_setting( 'phone_header', array(
		'default' => ''
		) );
	$customizer->add_control(
			'phone_header',
			array(
					'label'     => __( 'Номер телефона', 'in-2019' ),
					'section'   => 'header_settings',
					'type'      => 'text',
			)
	);

	$customizer->add_setting( 'email_header', array(
        'default' => ''
        ) );
	$customizer->add_control(
			'email_header',
			array(
					'label' => __( 'E-mail', 'in-2019' ),
					'section' => 'header_settings',
					'type' => 'text'
			)
	);

	$customizer->add_setting( 'work_time_header', array(
        'default' => ''
        ) );
	$customizer->add_control(
			'work_time_header',
			array(
					'label' => __( 'Время работы', 'in-2019' ),
					'section' => 'header_settings',
					'type' => 'text',

			)
	);
});