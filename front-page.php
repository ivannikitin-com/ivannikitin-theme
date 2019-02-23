<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package in-2018
 */

get_header();
?>
<!-- Slider -->
        <div class="slider_wrap">
        	<div class="row justify-content-end">
                <div class="col-md-4">
                	<div class="social d-flex justify-content-around align-items-center">
                        <a href="#" title="Twitter" target="_blank" class="">
                            <i class="fab fa-twitter"></i>
                            <span class="screen-reader-text">Twitter</span>
                        </a>
                        <a href="#" title="Facebook" target="_blank" class=""><i class="fab fa-facebook-f"></i><span class="screen-reader-text">Facebook</span></a>
                        <a href="#" title="Google Plus" target="_blank" class="#">
                            <i class="fab fa-google-plus-g"></i>
                            <span class="screen-reader-text">Google Plus</span>
                        </a>
                        <a href="#" title="Pinterest" target="_blank" class="#">
                            <i class="fab fa-pinterest-p"></i>
                            <span class="screen-reader-text">Pinterest</span>
                        </a>
                        <a href="#" title="VK" target="_blank" class="">
                            <i class="fab fa-vk"></i>
                            <span class="screen-reader-text">VK</span>
                        </a>
                        <a href="#" title="RSS" target="_blank" class="">
                            <i class="fas fa-rss"></i>
                            <span class="screen-reader-text">RSS</span>
                        </a>
					</div><!--/.social-->

                </div><!--/end col-->
            </div><!--/.row-->
        
        </div><!--/.slider_wrap-->
        
        <main role="main">
            <?php
                if ( have_posts() ) :

                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post();

                        /*
                        * Include the Post-Type-specific template for the content.
                        * If you want to override this in a child theme, then include a file
                        * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                        */
                        get_template_part( 'template-parts/content', 'home' );

                    endwhile;

                else :

                    get_template_part( 'template-parts/content', 'none' );

                endif;
                ?>
        </main><!--.#main-->
	

<?php
get_footer();
