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
 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="bootstrap-4.1.3/site/docs/4.1/assets/js/vendor/popper.min.js"></script>
    <!--<script src="bootstrap-4.1.3/dist/js/bootstrap.min.js" ></script>-->
</body>
</html>
