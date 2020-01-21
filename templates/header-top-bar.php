<div class="header-top-bar">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php if (!is_front_page()) {
        	if (function_exists('yoast_breadcrumb')) {
        		yoast_breadcrumb('<div id="breadcrumbs">', '</div>');
        	}
        } ?>
		<div class="header-top-bar__social">
		<?php if (get_theme_mod('social_twitter')): ?>
                <a href="<?php echo get_theme_mod(
                	'social_twitter'
                ); ?>" title="Twitter" target="_blank" class="">
                    <i class="fab fa-twitter"></i>
                </a>
            <?php endif; ?>
            <?php if (get_theme_mod('social_facebook')): ?>
                <a href="<?php echo get_theme_mod(
                	'social_facebook'
                ); ?>" title="Facebook" target="_blank" class="">
                    <i class="fab fa-facebook"></i>
                </a>
            <?php endif; ?>
            <?php if (get_theme_mod('social_google')): ?>
                <a href="<?php echo get_theme_mod(
                	'social_google'
                ); ?>" title="Google Plus" target="_blank" class="#">
                    <i class="fab fa-google-plus"></i>
                </a>
            <?php endif; ?>
            <?php if (get_theme_mod('social_pinterest')): ?>
                <a href="<?php echo get_theme_mod(
                	'social_pinterest'
                ); ?>" title="Pinterest" target="_blank" class="#">
                    <i class="fab fa-pinterest"></i>
                </a>
            <?php endif; ?>
            <?php if (get_theme_mod('social_vk')): ?>
                <a href="<?php echo get_theme_mod(
                	'social_vk'
                ); ?>" title="VK" target="_blank" class="">
                    <i class="fab fa-vk"></i>
                </a>
            <?php endif; ?>
            <?php if (get_theme_mod('social_rss')): ?>
                <a href="<?php echo get_theme_mod(
                	'social_rss'
                ); ?>" title="RSS" target="_blank" class="">
                    <i class="fas fa-rss"></i>
                </a>
            <?php endif; ?>
		</div>
      </div>
    </div>
  </div>
</div>
