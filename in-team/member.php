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
<article id="post-<?php the_ID(); ?>" <?php post_class('in-team single'); ?>>
	<?php
		/**
		 * inteam_before_main_content hook
		 */
		do_action( 'inteam_before_main_content' );
	?>
	
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="col-md-4">
			<?php the_post_thumbnail( 
				null, 
				array( 
					'class' => 'rounded-circle img-thumbnail border-0' 
				) 
			); ?>
		</div>
		<div class="col-md-8">
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header>

			<?php $post_id = get_the_ID(); ?>
			<div class="in-team__info_member">
				<?php if ( do_shortcode( "[inteam_position post_id='$post_id']") ) : ?>
				<div class="in-team__item">
					<span class="in-team__label"><?php esc_html_e( 'Должность:', 'in-2019' ); ?></span>
					<?php echo do_shortcode( "[inteam_position post_id='$post_id']" ); ?>

				</div>
				<?php endif; ?>
				<?php if ( do_shortcode( "[inteam_departament post_id='$post_id']") ) : ?>
				<div class="in-team__item">
					<span class="in-team__label"><?php esc_html_e( 'Отдел:', 'in-2019' ); ?></span>
					<?php echo do_shortcode( "[inteam_departament post_id='$post_id']" ); ?>
				</div>	
				<?php endif; ?>	
				<?php if ( do_shortcode( "[inteam_email post_id='$post_id']") ) : ?>
				<div class="in-team__item">
					<span class="in-team__label"><?php esc_html_e( 'E-mail:', 'in-2019' ); ?></span>
					<a href="mailto:<?php echo do_shortcode( "[inteam_email post_id='$post_id']" ); ?>"><?php echo do_shortcode( "[inteam_email post_id='$post_id']" ); ?></a>
				</div>
				<?php endif; ?>
				<?php if ( do_shortcode( "[inteam_phone post_id='$post_id']") ) : ?>
				<div class="in-team__item">
					<span class="in-team__label"><?php esc_html_e( 'Телефон:', 'in-2019' ); ?></span>
					<?php echo do_shortcode( "[inteam_phone post_id='$post_id']" ); ?>
				</div>
				<?php endif; ?>
			</div>

			<?php the_content(); ?>
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
<?php get_footer(); ?>