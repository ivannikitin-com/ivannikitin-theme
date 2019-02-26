<?php

function render_block_news( $attributes ) {
  return null;
}

function register_block_news() {
	register_block_type(
		'in-2019/news',
		array(
			'attributes'      => array(
				'categories'      => array(
					'type' => 'string',
				),
				'className'       => array(
					'type' => 'string',
				),
				'postsToShow'     => array(
					'type'    => 'number',
					'default' => 3,
				),
				'displayPostDate' => array(
					'type'    => 'boolean',
					'default' => false,
				),
				'order'           => array(
					'type'    => 'string',
					'default' => 'desc',
				),
				'orderBy'         => array(
					'type'    => 'string',
					'default' => 'date',
				),
			),
			'render_callback' => 'render_block_news',
		)
	);
}
add_action( 'init', 'register_block_news' );