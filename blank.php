<?php
/**
 * Template Name: Белый шаблон
 * 
 * Шаблон для пустых страниц под Visual Composer
 */

get_header('blank'); ?>	
<div id="contentBlank" role="main">
	<?php if ( have_posts() ) : ?>
		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<?php the_content(); ?>
		<?php endwhile; ?>
	<?php endif; ?>
</div><!-- #contentBlank -->
<?php get_footer('blank'); ?>
