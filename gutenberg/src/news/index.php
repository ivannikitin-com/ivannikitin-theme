<?php

function render_block_news( $attributes ) {
	$args = array(
		'posts_per_page'   => $attributes['postsToShow'],
		'post_status'      => 'publish',
		'order'            => $attributes['order'],
		'orderby'          => $attributes['orderBy'],
		'suppress_filters' => false,
	);

	if ( isset( $attributes['categories'] ) ) {
		$args['category'] = $attributes['categories'];
	}

	$recent_posts = get_posts( $args );
	$list_items_markup = '';

	foreach ( $recent_posts as $post ) {
		$title = get_the_title( $post );
		if ( ! $title ) {
			$title = __( '(Untitled)' );
		}
		$list_items_markup .= sprintf(
			'<div class="col-md-4 wp-block-in-2019-news_item mb-3 mb-sm-4 mb-md-4">
				<a href="%3$s">
					<div class="wp-block-in-2019-news_thumb" style="background-image: url(%1$s);"></div>
				</a>
				<div class="card-body">
					<h5 class="wp-block-in-2019-news_title">%2$s</h5>			
			',
			esc_url( get_the_post_thumbnail_url( $post ) ),
			$title,
			esc_url( get_permalink( $post ) )
		);
		if ( isset( $attributes['displayPostDate'] ) && $attributes['displayPostDate'] ) {
			$list_items_markup .= sprintf(
				'<time datetime="%1$s" class="wp-block-in-2019-news_date">%2$s</time>',
				esc_attr( get_the_date( 'c', $post ) ),
				esc_html( get_the_date( '', $post ) )
			);
		}

		$list_items_markup .= sprintf('
			<a href="%1$s" class="wp-block-in-2019-news_link">%2$s</a>
			',
			esc_url( get_permalink( $post ) ),
			esc_html__( 'Read More', 'in-2019' )
		);

		$list_items_markup .= "</div></div>\n";
	}

	$class = 'wp-block-in-2019-news';
	if ( isset( $attributes['displayPostDate'] ) && $attributes['displayPostDate'] ) {
		$class .= ' has-dates';
	}

	if ( isset( $attributes['className'] ) ) {
		$class .= ' ' . $attributes['className'];
	}

	$block_content = sprintf(
		'<div class="row %1$s">%2$s</div>',
		esc_attr( $class ),
		$list_items_markup
	);
	return $block_content;
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