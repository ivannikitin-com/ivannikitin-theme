<?php
add_action('customize_register', function($customizer) {
    // Contact Form 7

	$args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1);
	$cf7Forms = get_posts( $args );

	$forms = [];

	foreach($cf7Forms as $cf7Form) {
			$forms[$cf7Form->ID] =  $cf7Form->post_title;
    }
    
    $customizer->add_section(
		'settings-site', array(
				'title'         => 'Настройки заказа услуги',
				'priority'      => 15,
		)
    );
    
    $customizer->add_setting('in_order_service', array(
        'default'        => ''
    ));

    $customizer->add_control( 'in_order_service', array(
            'type'        => 'select',
            'label'       => 'Заказать услугу',
            'description'  => 'Класс для получения названия услуги name-service-field',
            'section'     => 'settings-site',
            'choices'	  => $forms
    ));
});