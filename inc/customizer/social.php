<?php

add_action('customize_register', function($customizer) {

	$customizer->add_section(
		'social_settings', array(
				'title'         => __( 'Социальные сети', 'in-2019' ),
				'description'   => __( 'Ссылки на соц. сети на сайте', 'in-2019' ),
				'priority'      => 13,
		)
	);

	$customizer->add_setting( 'social_twitter', array(
		'default' => ''
		) );
	$customizer->add_control(
			'social_twitter',
			array(
					'label'     => __( 'Twitter', 'in-2019' ),
					'section'   => 'social_settings',
					'type'      => 'text',
			)
	);

	$customizer->add_setting( 'social_facebook', array(
		'default' => ''
		) );
	$customizer->add_control(
			'social_facebook',
			array(
					'label'     => __( 'Facebook', 'in-2019' ),
					'section'   => 'social_settings',
					'type'      => 'text',
			)
	);

	$customizer->add_setting( 'social_google', array(
		'default' => ''
		) );
	$customizer->add_control(
			'social_google',
			array(
					'label'     => __( 'Google Plus', 'in-2019' ),
					'section'   => 'social_settings',
					'type'      => 'text',
			)
	);

	$customizer->add_setting( 'social_pinterest', array(
		'default' => ''
		) );
	$customizer->add_control(
			'social_pinterest',
			array(
					'label'     => __( 'Pinterest', 'in-2019' ),
					'section'   => 'social_settings',
					'type'      => 'text',
			)
	);

	$customizer->add_setting( 'social_vk', array(
		'default' => ''
		) );
	$customizer->add_control(
			'social_vk',
			array(
					'label'     => __( 'Vkontakte', 'in-2019' ),
					'section'   => 'social_settings',
					'type'      => 'text',
			)
	);

	$customizer->add_setting( 'social_rss', array(
		'default' => ''
		) );
	$customizer->add_control(
			'social_rss',
			array(
					'label'     => __( 'RSS', 'in-2019' ),
					'section'   => 'social_settings',
					'type'      => 'text',
			)
	);
});