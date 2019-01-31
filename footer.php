<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package in-2018
 */

?>

	</div><!-- #content -->
	
	<footer class="bg-light mb-3">
		<?php wp_nav_menu( array( 
			'theme_location' => 'Footer menu',
			'menu' => 'Footer menu',
			'container' => 'nav',
			'menu_id'        => '',
			'container_class' => 'bg-primary',
			'container_id' => '',
			'menu_class' => 'nav justify-content-center ffrc',
		) );?>
		<div class="row m-0 mt-3 justify-content-between align-items-center">
			<div class="col-4">
				<?php if ( get_theme_mod ('logo_footer') ){ ?>
					<img src="<?php echo esc_url( get_theme_mod( 'logo_footer' ) ); ?>" class="img-fluid">
				<?php }?>
			</div>
			<div class="col-4 text-secondary">
				<p>&copy; Иван Никитин и партнеры 2011 - <?php echo date('Y'); ?></p>
			</div>
		</div><!--/.row-->	  
	</footer>
	
	</div><!--.#page-->
</div><!--/.container-fluid-->

<?php wp_footer(); ?>
</body>
</html>
