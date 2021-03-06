<header class="site-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-4 col-md-3 col-lg-3 col-xl-2">
        <div class="site-header__logo">
          <?php the_custom_logo(); ?>
        </div>
      </div>
      <div class="col-sm-8 col-md-9 col-lg-9 col-xl-10">
        <div class="row justify-content-center justify-content-md-start">
          <div class="col-auto col-lg-auto">
            <div class="site-header__phone">
              <?php if (get_theme_mod('phone_header')): ?>
              <a class="site-header__number" href="tel:<?php echo get_theme_mod(
              	'phone_header'
              ); ?>">
                <i class="fas fa-phone-alt"></i>
                <?php echo get_theme_mod('phone_header'); ?>
              </a>
              <?php endif; ?>
              <?php if (get_theme_mod('work_time_header')): ?>
              <span class="site-header__hour"><?php echo get_theme_mod(
              	'work_time_header'
              ); ?></span>
              <?php endif; ?>
            </div>
          </div>
          <div class="col-auto col-lg-auto">
            <?php if (get_theme_mod('email_header')): ?>
            <a class="site-header__email" href="mailto:<?php echo get_theme_mod(
            	'email_header'
            ); ?>">
              <i class="fas fa-envelope"></i>
              <?php echo get_theme_mod('email_header'); ?>
            </a>
            <?php endif; ?>
          </div>
          <div class="col-md-12 col-lg-5 ml-lg-auto">
            <div class="site-header__account">
              <?php wp_nav_menu(array(
              	'theme_location' => 'Account',
              	'depth' => 1,
              	'container' => 'div',
              	'container_class' => 'menu-account'
              )); ?>
              <?php if (function_exists('in_2019_woocommerce_header_cart')) {
              	in_2019_woocommerce_header_cart();
              } ?>
            </div>
          </div>
          <div class="col-md-12 site-header__main-menu">
            <div class="row align-items-center">
              <div class="col-lg site-header__search order-lg-last">
                <?php get_search_form(); ?>
              </div>
              <div class="col-lg">
                <nav class="navbar navbar-expand-lg order-lg-first">
                  <button aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbar" data-toggle="collapse" type="button">
                    <i class="fas fa-stream"></i>
                  </button>
                  <?php wp_nav_menu(array(
                  	'theme_location' => 'Primary',
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
