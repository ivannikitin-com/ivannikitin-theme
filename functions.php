<?php
/**
 * in-2018 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package in-2018
 */
if ( ! function_exists( 'in_2018_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function in_2018_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on in-2018, use a find and replace
		 * to change 'in-2018' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'in-2018', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'in-2018' ),
			'menu-2' => esc_html__( 'Footer menu', 'in-2018' ),
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
		add_theme_support( 'custom-background', apply_filters( 'in_2018_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

			
		/**
		 * Включаем поддержку WooCommerce
		 * В этом вызове также можно указать некоторые параметры. См ссылку ниже
		 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
		 */
		add_theme_support( 'woocommerce', array(
			'thumbnail_image_width' => 150,			//TODO: Необходимо установить правильные значения!
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 2,
				'max_rows'        => 8,
				'default_columns' => 4,
				'min_columns'     => 2,
				'max_columns'     => 5,
			),
		) );		
		
	}
endif;
add_action( 'after_setup_theme', 'in_2018_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function in_2018_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'in_2018_content_width', 640 );
}
add_action( 'after_setup_theme', 'in_2018_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function in_2018_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'in-2018' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'in-2018' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'in_2018_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function in_2018_scripts() {
	wp_enqueue_style( 'in-2018-bootstrap', get_template_directory_uri() . '/bootstrap-4.1.3/dist/css/bootstrap.min.css' );
	wp_enqueue_style( 'in-2018-style', get_stylesheet_uri() );
	wp_enqueue_script( 'in-2018-popper', get_template_directory_uri() . '/bootstrap-4.1.3/site/docs/4.1/assets/js/vendor/popper.min.js', array('jquery'),null, true );
	//wp_enqueue_script( 'in-2018-holder', get_template_directory_uri() . '/bootstrap-4.1.3/site/docs/4.1/assets/js/vendor/holder.min.js', array('jquery','in-2018-bootstrap'),null, true );
	//wp_enqueue_script( 'in-2018-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'in-2018-bootstrap-js', get_template_directory_uri() . '/bootstrap-4.1.3/dist/js/bootstrap.min.js', array('jquery'), null, true );

	wp_enqueue_script( 'in-2018-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'in_2018_scripts' );

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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


/**
 * Дополнительные файлы включений. Все специфические функции пишем в них
 */
require get_template_directory() . '/woocommerce/hooks.php';

