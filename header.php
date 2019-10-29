<?php
/**
 * The header for our theme
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
<div class="container">
  <header class="site-header">
    <div class="row">
      <div class="col-5 col-sm-4 col-md-3 col-lg-3 col-xl-2">
        <div class="site-header__logo">
          <?php the_custom_logo(); ?>
        </div>
      </div>
      <div class="col-7 col-sm-8 col-md-9 col-lg-9 col-xl-10">
        <div class="row">
          <div class="col-auto col-lg-auto">
            <div class="site-header__phone">
              <?php if (get_theme_mod('phone_header')): ?>
                  <i class="fas fa-phone-alt"></i>
                  <a href="tel:<?php echo get_theme_mod(
                      'phone_header'
                  ); ?>" class="site-header__number">
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
          <div class="col-auto col-lg-6">
            <?php if (get_theme_mod('email_header')): ?>
                <a href="mailto:<?php echo get_theme_mod(
                    'email_header'
                ); ?>" class="site-header__email">
                    <i class="fas fa-envelope"></i>
                    <?php echo get_theme_mod('email_header'); ?>
                </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </header>
</div>

	<div id="content" class="site-content">
