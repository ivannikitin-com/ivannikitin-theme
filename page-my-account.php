<?php
/**
 * Template Name: Страницы личного кабинета
 * Шаблон показывает страницы личного кабинета во всю ширину экрана и выводит меню в зависимости от роли пользователя.
 *
 *
 *
 */

get_header(); ?>

	<div id="content-wrap" class="container clr">

		<?php wpex_hook_primary_before(); ?>

		<div id="primary" class="content-area clr">

			<?php wpex_hook_content_before(); ?>

			<div id="content" class="site-content clr">

				<?php wpex_hook_content_top(); ?>

				<?php
				if ( current_user_can( 'view_employee_menu' ) ) /* Вывод меню сотрудника */
					wp_nav_menu( array( 
					'theme_location' => 'employee-menu', 
					'container_class' => 'inline-menu' 
					) );				
				elseif ( current_user_can( 'view_customer_menu' ) ) /* Вывод меню клиента */
					wp_nav_menu( array( 
						'theme_location' => 'customer-menu', 
						'container_class' => 'inline-menu' 
					) );
				?>
				
				<?php
				// Start loop
				while ( have_posts() ) : the_post();

					get_template_part( 'partials/page-single-layout' );

				endwhile; ?>

				<?php wpex_hook_content_bottom(); ?>

			</div><!-- #content -->

			<?php wpex_hook_content_after(); ?>

		</div><!-- #primary -->

		<?php wpex_hook_primary_after(); ?>

	</div><!-- .container -->

<?php get_footer(); ?>