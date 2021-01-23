<?php
/**
 * The template for displaying all pages
 * Template Name: With Sidebar
 * Template Post Type: page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package IvanNikitin_2019
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container-fluid">
					<div class="row">
						<div class="col-lg-3 order-lg-1 order-2">
							<?php get_sidebar(); ?>
						</div>
						<div class="col-lg-9 order-lg-2 order-1">
						<?php
						while ( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/template/content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
						?>
					</div>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
