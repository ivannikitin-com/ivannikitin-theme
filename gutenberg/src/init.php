<?php
/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function gutenberg_cgb_block_assets() { // phpcs:ignore
	// Styles.
	wp_enqueue_style(
		'gutenberg-cgb-style-css', // Handle.
		get_template_directory_uri() . '/gutenberg/dist/blocks.style.build.css', // Block style CSS.
		array( 'wp-editor' ) // Dependency to include the CSS after it.
	);
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

	// Styles.
	wp_enqueue_style(
		'single_block-cgb-block-editor-css',
		get_template_directory_uri() . '/gutenberg/dist/blocks.editor.build.css',
		array( 'wp-edit-blocks' )
	);
}

// Hook: Editor assets.
add_action( 'enqueue_block_editor_assets', 'gutenberg_cgb_editor_assets' );

// Create custom category
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

add_filter( 'block_categories', 'gutenberg_nikitin_block_categories', 10, 2 );

add_theme_support( 'align-wide' );			
add_theme_support( 'align-full' );			