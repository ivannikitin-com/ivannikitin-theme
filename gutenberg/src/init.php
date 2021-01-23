<?php
/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function gutenberg_cgb_block_assets()
{ // phpcs:ignore
	// Styles.
}

// Hook: Frontend assets.
add_action('enqueue_block_assets', 'gutenberg_cgb_block_assets');

/**
 * Enqueue Gutenberg block assets for backend editor.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function gutenberg_cgb_editor_assets()
{
	wp_enqueue_script(
		'gutenberg-cgb-block-js', // Handle.
		get_template_directory_uri() . '/dist/gutenberg.js',
		array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor'),
		true
	);
}

// Hook: Editor assets.
add_action('enqueue_block_editor_assets', 'gutenberg_cgb_editor_assets');

// Create custom category
function gutenberg_nikitin_block_categories($categories)
{
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'nikitin',
				'title' => __('Nikitin', 'in-2019'),
			)
		)
	);
}

add_filter('block_categories', 'gutenberg_nikitin_block_categories', 10, 2);

// Register block news
include __DIR__ . '/news/index.php';
