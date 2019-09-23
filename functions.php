<?php
/**
 * IvanNikitin 2019 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package IvanNikitin_2019
 */
 
/* Доп. подключения */
include( 'cpm/hooks.php' ); 
include( 'in-employee-reports/hooks.php' ); 

/* Убираем ссылки Visual Composer*/
add_action( 'vc_after_init', function() {
  vc_disable_frontend(); // this will disable frontend editor
});

 
/* Theme setup */
if ( ! function_exists( 'in_2019_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function in_2019_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on IvanNikitin 2019, use a find and replace
		 * to change 'in-2019' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'in-2019', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'Primary' => esc_html__( 'Основное меню', 'in-2019' ),
			'Footer' => esc_html__( 'Меню в подвале', 'in-201' ),
			'Account' => esc_html__( 'Меню рядом с корзиной', 'in-201' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'in_2019_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 165,
			'width'       => 136,
			'flex-width'  => true,
			'flex-height' => true,
			'class'		  => 'ml-auto mr-auto img-fluid'
		) );

		// Supports aline gutenberg
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );
		add_editor_style( 'editor-style.css' );
	}
endif;
add_action( 'after_setup_theme', 'in_2019_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function in_2019_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'in_2019_content_width', 640 );
}
add_action( 'after_setup_theme', 'in_2019_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function in_2019_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'in-2019' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'in-2019' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'in_2019_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function in_2019_scripts() {
	$version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'in_2019-style', get_stylesheet_uri(), array(), $version );

	wp_enqueue_style( 'bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', array(), $version );

}
add_action( 'wp_enqueue_scripts', 'in_2019_scripts' );

/**
 * Footer scripts and styles.
 */
function in_2019_footer_style_scripts() {
	
	$version = wp_get_theme()->get( 'Version' );

	wp_enqueue_script( 'popper', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', array('jquery'), $version, true );

	wp_enqueue_script( 'bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array('jquery'), $version, true );

	// wp_enqueue_script( 'spincrement', get_template_directory_uri() . '/src/js/libs/jquery.spincrement.min.js', array('jquery'), $version, true );

	// wp_enqueue_script( 'custom', get_template_directory_uri() . '/src/js/custom.js', array('jquery', 'spincrement'), $version, true );
	// wp_enqueue_script( 'custom', get_template_directory_uri() . '/build/app.min.js', array('jquery'), $version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_footer', 'in_2019_footer_style_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Gutenberg blocks.
 */
require get_template_directory() . '/gutenberg/index.php';

/**
 * Walker Menu class.
 */
require get_template_directory() . '/inc/classes/class-walker-menu.php';

/**
 * Custom customizer.
 */
require get_template_directory() . '/inc/customizer/index.php';

/**
 * Hooks.
 */
require get_template_directory() . '/inc/hooks/index.php';

/**
 * Filters.
 */
require get_template_directory() . '/inc/filters/index.php';

/**
 * Hooks.
 */
require get_template_directory() . '/inc/optimize.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}