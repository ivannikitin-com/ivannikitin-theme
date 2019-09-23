<?php
function gutenberg_cgb_block_assets_frontend() {
	wp_enqueue_script(
		'gutenberg-tabs-js', // Handle.
		get_template_directory_uri() . '/gutenberg/dist/in-tabs.js', // Block.build.js: We register the block here. Built with Webpack.
		array( 'jquery' ), // Dependencies, defined above.
		true // Enqueue the script in the footer.
	);
	wp_enqueue_script(
		'owl-carousel-lib', // Handle.
		'//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js',
		array( 'jquery' ), // Block.build.js: We register the block here. Built with Webpack.
		true // Enqueue the script in the footer.
	);

	wp_enqueue_style(
		'owl-carousel-css', // Handle.
		'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css' // Block style CSS.
	);

	wp_enqueue_script(
		'gutenberg-in-owl-carousel-js', // Handle.
		get_template_directory_uri() . '/gutenberg/dist/in-owl-carousel.js', // Block.build.js: We register the block here. Built with Webpack.
		array( 'owl-carousel-lib', 'jquery' ), // Dependencies, defined above.
		true // Enqueue the script in the footer.
	);

	wp_enqueue_script(
		'fancybox-lib-js',
		'//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js',
		'',
		true
	);

	wp_enqueue_style(
		'fancybox-lib-css',
		'//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css',
		''
	);
}
add_action( 'wp_footer', 'gutenberg_cgb_block_assets_frontend' );
/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function gutenberg_cgb_block_assets() { // phpcs:ignore
	// Styles.
}

// Hook: Frontend assets.
add_action( 'enqueue_block_assets', 'gutenberg_cgb_block_assets' );

/**
 * Enqueue Gutenberg block assets for backend editor.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function gutenberg_cgb_editor_assets() { // phpcs:ignore
	// Scripts.
	wp_enqueue_script(
		'gutenberg-cgb-block-js', // Handle.
		get_template_directory_uri() . '/gutenberg/dist/blocks.build.js', // Block.build.js: We register the block here. Built with Webpack.
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencies, defined above.
		true // Enqueue the script in the footer.
	);
}

// Hook: Editor assets.
add_action( 'enqueue_block_editor_assets', 'gutenberg_cgb_editor_assets' );

// Create custom category
add_filter( 'block_categories', 'gutenberg_nikitin_block_categories', 10, 2 );

function gutenberg_nikitin_block_categories ( $categories ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' 	=> 'nikitin',
				'title'	=> __( 'Nikitin', 'in-2019' ),
			)
		)
	);
}

// Register block news
include __DIR__ . '/news/index.php';