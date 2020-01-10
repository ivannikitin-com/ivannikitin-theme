<?php
/**
 * header-small
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package IvanNikitin_2019
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="site">
		<header class="site-header site-header_small">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-4 col-md-3 col-lg-3 col-xl-2">
						<div class="site-header__logo">
							<a href="/"><img src="<?php echo esc_url( get_theme_mod( 'file-upload' ) ); ?>"></a>
						</div>
					</div>
					<div class="col-sm-8 col-md-9 col-lg-9 col-xl-10">
						<div class="row justify-content-center justify-content-md-start">

							<div class="col-md-12 site-header__main-menu">
								<div class="row align-items-center">
									<div class="col-lg site-header__search order-last">
										<?php get_search_form(); ?>
									</div>
									<div class="col-lg">
										<nav class="navbar navbar-expand-lg order-lg-first">
											<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
												aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
												<i class="fas fa-stream"></i>
											</button>
											<?php wp_nav_menu(array(
                    	'theme_location' => 'Primary-header-small',
                    	'depth' => 2,
                    	'container' => 'div',
                    	'container_class' => 'collapse navbar-collapse',
                    	'container_id' => 'navbar',
                    	'menu_class' => 'navbar-nav',
                    	'fallback_cb' => 'bs4Navwalker::fallback',
                    	'walker' => new bs4Navwalker()
                    )); ?>
										</nav>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

		<div id="content" class="site-content">