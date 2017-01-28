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
<div id="content-wrap" class="container clr">
	<?php
		/**
		 * inteam_before_main_content hook
		 */
		do_action( 'inteam_before_main_content' );
	?>
	
	<div id="primary" class="clr">
		<div class="products wpex-row clr match-height-grid">
			<?php while ( have_posts() ) : the_post(); ?>			
				<div class="in-team col span_1_of_4">
					<?php if ( has_post_thumbnail() ): ?>
						<div class="team woo-entry-image-main clr"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'in_team_medium' ); ?></a></div>
					<?php endif; ?>
					<div class="team-details match-height-content">
						<a href="<?php the_permalink(); ?>" class="woocommerce-LoopProduct-link">
							<h3><?php the_title() ?></h3>
							<?php echo do_shortcode( '[inteam_position post_id="' . get_the_ID() . '"]' ) ?>
						</a>
					</div>
				</div>
			<?php endwhile; // end of the loop. ?>
		</div>	
	</div><!-- #primary -->
	
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
</div><!-- #content-wrap -->
<?php get_footer(); ?>