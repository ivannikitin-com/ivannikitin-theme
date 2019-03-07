<?php
add_action('customize_register', function($customizer) {

	$customizer->add_section(
		'footer_settings', array(
				'title'         => __( 'Подвал', 'in-2019' ),
				'priority'      => 12,
		)
	);

	$customizer->add_setting( 'copyright_footer', array(
		'default' => ''
		) );
	$customizer->add_control(
			'copyright_footer',
			array(
					'label'     => __( 'Copyright', 'in-2019' ),
					'section'   => 'footer_settings',
					'type'      => 'text',
			)
    );
    
	$customizer->add_setting(
		'logo_footer',
		array(
			'default'      => '',
			'transport'    => 'postMessage'
		)
	);
	
	$customizer->add_control(
		new WP_Customize_Image_Control(
			$customizer,
			'logo_footer',
			array(
				'label'    => 'Логотип в подвале',
				'settings' => 'logo_footer',
				'section'  => 'footer_settings'
			)
		)
	);

});