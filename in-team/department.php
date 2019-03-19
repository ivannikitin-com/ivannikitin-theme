<?php
/**
 * The Template for displaying all team members
 *
 * This template can be overridden by copying it to yourtheme/in-team/profile.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header(); ?>
<section>
	<?php
		/**
		 * inteam_before_main_content hook
		 */
		do_action( 'inteam_before_main_content' );
	?>

	<div class="col-md-12">
		<header class="page-header text-center">
			<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header>
	</div>
	
	<?php while ( have_posts() ) : 
		the_post();

		get_template_part( 'in-team/templates/content', 'team' );

	endwhile; // end of the loop. ?>

	<?php
		/**
		 * inteam_after_main_content hook
		 */
		do_action( 'inteam_after_main_content' );
	?>

	<?php
		/**
		 * inteam_sidebar hook.
		 */
		do_action( 'inteam_sidebar' );
	?>
</section>
<?php get_footer(); ?>