<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package in-2018
 */

?>

	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	<?php in_2018_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'in-2018' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->


