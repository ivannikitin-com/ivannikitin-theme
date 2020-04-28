<footer class="site-footer">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 site-footer__menu">
        <?php wp_nav_menu(array(
        	'theme_location' => 'Footer',
        	'menu' => 'Footer',
        	'container' => 'nav',
        	'menu_id' => '',
        	'container_id' => '',
        	'depth' => 1
        )); ?>
      </div>
    </div>
    <div class="row align-items-center justify-content-between site-footer__info">
      <div class="col-md-6">
        <?php if (get_theme_mod('logo_footer')): ?>
        <a class="site-footer__logo" href="<?php echo esc_url(home_url()); ?>">
          <img src="<?php echo get_theme_mod('logo_footer'); ?>">
        </a>
        <?php endif; ?>
      </div>
      <?php if (get_theme_mod('copyright_footer')): ?>
      <div class="col-md-6">
        <div class="site-footer__copyright">
          <?php printf(
          	esc_html__('%1$s - %2$s.', 'in-2019'),
          	get_theme_mod('copyright_footer'),
          	date('Y')
          ); ?>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</footer>
