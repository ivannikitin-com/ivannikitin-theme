<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package in-2018
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<!-- Custom styles for this template    
	<link href="custom.css" rel="stylesheet">	 -->    

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="container-fluid">
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'in-2018' ); ?></a>

		<header id="masthead" class="site-header">
			<div class="row align-items-stretch m-0">
				<div class="col-5 col-sm-4 col-md-3 col-lg-3 col-xl-2 logo justify-content-center">
					<?php
					if (get_theme_mod( 'logo_header' )){					
					if ( is_front_page() && is_home() ) : ?>
						<span class="text-center"><img src="<?php echo get_theme_mod( 'logo_header' ); ?>" width="165" height="136" class="ml-auto mr-auto img-fluid" alt="<?php bloginfo( 'name' ); ?>"></span>	
						<?php else : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-center"><img src="<?php echo get_theme_mod( 'logo_header' ); ?>" width="165" height="136" alt="<?php bloginfo( 'name' ); ?>" class="m-auto img-fluid"></a>
					<?php endif;
					$in_2018_description = get_bloginfo( 'description', 'display' );
					if ( $in_2018_description || is_customize_preview() ) :?>
						<p class="site-description"><?php echo $in_2018_description; /* WPCS: xss ok. */ ?></p>
					<?php endif;
					}
					?>
				</div><!--/.logo-->
				<div class="col-7 col-sm-8 col-md-9 col-lg-9 col-xl-10 pr-0">
            	<div class="row mr-0">
        			<div class="col-md-7 col-lg-7 col-xl-8">
                    	<div class="row">
                            <div class="col-auto col-lg-auto phone ffrc mt-2 mt-lg-3"><a href="tel:+74955653488" class="d-block ffrc">+7 (495) 565-34-88</a>
                            	<span class="hour">Пн.-Пт. 10:00 - 18:00</span>
                            </div>
                        	<div class="col-auto col-lg-6 email mt-2 mt-lg-3"><a href="mailto:info@ivannikitin.com" class="ffrc">info@ivannikitin.com</a></div>
                		</div><!--/.row-->
                        
                    </div>
                    <div class="col-md-5 col-lg-5 col-xl-4 mr-0">
                        <div class="row mt-3 mt-md-2 mt-lg-3">
                            <div class="col login text-nowrap ffrc"><a href="#" class="nodecor"><span>Личный кабинет</span></a></div>
                            <div class="col cart text-nowrap ffrc"><a href="#" class="nodecor"><span>Корзина 123456</span></a></div>
                        </div><!--/.row-->
                    </div>
                
            		<div class="w-100 mt-3 mt-lg-4 d-none d-sm-block"></div>
                    
                    <div class="col d-none d-sm-block mb-lg-2">
                    	<div class="row align-items-center jc-sb-lg">
                            <div class="col-lg search order-lg-last">
                                <form action="/" method="get" class="form-row">
                                    <input type="text" name="s" placeholder="" value="" class="col ph order-2">
                                    <input type="submit" value="" class="order-1">
                                </form>
                            </div><!--/.search-->
                            <div class="col-lg pr-lg-0">
                                <nav class="navbar navbar-expand-lg navbar-light order-lg-first main_menu">
                                    <button class="navbar-toggler mb-2" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                                      <span class="navbar-toggler-icon"></span>
                                      <span class="navbar-toggler-icon"></span>
                                      <span class="navbar-toggler-icon"></span>
                                    </button>                                   
									
									<?php wp_nav_menu( array( 
										'theme_location' => 'Primary',
										'menu' => 'Primary menu',
										'menu_id'        => '',
										'container_class' => 'navbar-collapse collapse',
										'container_id' => 'navbar',
										'menu_class' => 'navbar-nav text-left',
									) );?>									                                
                                </nav>
                            </div><!--/.col-->
                        </div><!--/.row-->
                    </div><!--/.col-->
            	</div><!--/.row-->
            </div>
        
			</div><!--/.row-->
            
            <!-- --For mobile-->
            <div class="col d-sm-none p-0">
            	<div class="row align-items-center no-gutters">
                    <div class="col-12 col-lg-auto search order-lg-last">
                        <form action="/" method="get" class="form-row">
                            <input type="text" name="s" placeholder="" value="" class="col ph order-2">
                            <input type="submit" value="" class="order-1">
                        </form>
                    </div><!--/.search-->
                    <div class="col-12 col-lg-auto pr-lg-0">
                        <nav class="navbar navbar-expand-lg navbar-light order-lg-first main_menu">
                            <button class="navbar-toggler mb-2" type="button" data-toggle="collapse" data-target="#navbar_m" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                              <span class="navbar-toggler-icon"></span>
                              <span class="navbar-toggler-icon"></span>
                              <span class="navbar-toggler-icon"></span>
                            </button>
								<?php wp_nav_menu( array( 
									'theme_location' => 'Primary',
									'menu' => 'Primary menu',
									'menu_id'        => '',
									'container_class' => 'navbar-collapse collapse',
									'container_id' => 'navbar_m',
									'menu_class' => 'navbar-nav text-left',
								) );?>
                            </div><!--/#navbar_m-->
                        </nav>
                    </div><!--/.col-->
				</div><!--/.row-->
			</div><!--/.col-->
      	</header>
    
        
