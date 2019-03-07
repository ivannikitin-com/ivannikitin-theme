<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package IvanNikitin_2019
 */

?>

	</div><!-- #content -->

	<footer class="bg-light site-footer">
		<?php wp_nav_menu( array( 
			'theme_location' 	=> 'Footer',
			'menu' 				=> 'Footer',
			'container' 		=> 'nav',
			'menu_id'        	=> '',
			'container_class' 	=> '',
			'container_id' 		=> '',
			'menu_class' 		=> 'nav justify-content-center ffrc',
			'depth'     		=> 1
		) );?>
		<div class="row m-0 mt-3 justify-content-between align-items-center">
			<div class="col-4">
				<?php if ( get_theme_mod( 'logo_footer' ) ) : ?>
					<a href="<?php echo esc_url( home_url() ); ?>">
						<img src="<?php echo get_theme_mod( 'logo_footer' ); ?>" width="133" height="64" class="img-fluid">
					</a>
				<?php endif; ?>
			</div>
			<?php if ( get_theme_mod( 'copyright_footer' ) ) : ?>
			<div class="col-4 text-secondary">
				<?php printf( 
					esc_html__( '%1$s - %2$s.', 'in-2019')
					, 
					get_theme_mod( 'copyright_footer' ),
					date('Y')
				); ?>
			</div>
			<?php endif; ?>
		</div><!--/.row-->
	
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
