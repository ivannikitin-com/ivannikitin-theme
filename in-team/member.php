<?php
/**
 * The Template for displaying Team Member Profile
 *
 * This template can be overridden by copying it to yourtheme/in-team/profile.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header(); ?>
<section id="content-wrap" class="container clr">
	<div id="primary" class="content-area clr">
		<div id="content" class="clr site-content">
			<article class="entry-content entry clr">
			<?php
				/**
				 * inteam_before_main_content hook
				 */
				do_action( 'inteam_before_main_content' );
			?>
			
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="single in-team clearfix">
					<?php if ( has_post_thumbnail() ): ?>
						<div class="images-member"><?php the_post_thumbnail( 'in_team_large' ) // Картинка 500x600 ?></div>
					<?php endif; ?>
					<div class="summary entry-summary">
						<?php $post_id = get_the_ID(); ?>
						<h1><?php the_title() ?></h1>
						<ul class="info_member">
							<li><?php echo do_shortcode( "[inteam_position label='<b>Должность:</b>' post_id='$post_id']" ) ?></li>
							<li><?php echo do_shortcode( "[inteam_departament label='<b>Отдел:</b>' post_id='$post_id']" ) ?></li>		
							<li><?php echo do_shortcode( "[inteam_email label='<b>E-mail:</b>' post_id='$post_id']" ) ?></li>
							<li><?php echo do_shortcode( "[inteam_phone label='<b>Телефон:</b>' post_id='$post_id']" ) ?></li>
						</ul>
						<div class="member-about">
							<?php the_content(); ?>
						</div>						
					</div><!--/.summary-->
				</div>
			<?php endwhile; // end of the loop. ?>

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
			</article>
		</div>
	</div>
</section>
<?php get_footer(); ?>