<?php
/**
 * Тема сайта ivannikitin.com
 * 
 * Text Domain: wpex
 * @link http://codex.wordpress.org/Plugin_API
 *
 */
 
/** ==========================================================================================
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
add_action( 'wp_enqueue_scripts', 'total_child_enqueue_parent_theme_style' );
function total_child_enqueue_parent_theme_style() {

	// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update your theme)
	$theme   = wp_get_theme( 'Total' );
	$version = $theme->get( 'Version' );

	// Load the stylesheet
	wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css', array(), $version );
	
}

/** ==========================================================================================
 * Меню на страницах личного кабинета
 */
add_action( 'init', 'register_my_account_menus' );
function register_my_account_menus() {
	register_nav_menus( array(
		'customer-menu' => 'Личный кабинет: Меню клиента',
		'employee-menu' => 'Личный кабинер: Меню сотрудника',
    ));
}

/** ==========================================================================================
 * Шорткоды и форматированный текст в таксономиях
 */
add_filter( 'term_description', 'shortcode_unautop');
add_filter( 'term_description', 'do_shortcode' );

/** ==========================================================================================
 * Убираем мета Visual Composer
 * https://community.theme.co/forums/topic/how-to-remove-visual-composer-meta-tags/
 */ 
add_action('init', 'remove_vc_meta', 100);
function remove_vc_meta() 
{
    remove_action('wp_head', array(visual_composer(), 'addMetaData'));
}
 
 
/** ==========================================================================================
 *  Убираем лишнее из админбара
 */ 
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links', 99);
function remove_admin_bar_links() 
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');					// Remove the WordPress logo
    $wp_admin_bar->remove_menu('about');					// Remove the about WordPress link
    $wp_admin_bar->remove_menu('wporg');					// Remove the WordPress.org link
    $wp_admin_bar->remove_menu('documentation');			// Remove the WordPress documentation link
    $wp_admin_bar->remove_menu('support-forums');			// Remove the support forums link
    $wp_admin_bar->remove_menu('feedback');					// Remove the feedback link
    //$wp_admin_bar->remove_menu('site-name');				// Remove the site name menu
    //$wp_admin_bar->remove_menu('view-site');				// Remove the view site link
    //$wp_admin_bar->remove_menu('updates');				// Remove the updates link
    //$wp_admin_bar->remove_menu('comments');				// Remove the comments link
    $wp_admin_bar->remove_menu('customize');				// Ссылка настроить
    $wp_admin_bar->remove_menu('new-content');				// Remove the content link
    //$wp_admin_bar->remove_menu('w3tc');					// If you use w3 total cache remove the performance link
    //$wp_admin_bar->remove_menu('wpseo-menu');				// SEO Yoast
    $wp_admin_bar->remove_menu('mail_bank');				// WP Mail Bank
    $wp_admin_bar->remove_menu('theme_options');			// Параметры темы
    $wp_admin_bar->remove_menu('my-account');				// Remove the user details tab
    $wp_admin_bar->remove_menu('wpex_custom_css');			// Пользовательский CSS, добавила тема Total
    $wp_admin_bar->remove_menu('vc_inline-admin-bar-link');	// Редактировать Visual Composer
    $wp_admin_bar->remove_menu('tribe-events');				// Мероприятия
    $wp_admin_bar->remove_menu('revslider');				// RevSlider
}


/** ==========================================================================================
 * Дополнительные файлы и функции
 *
 */
include( 'functions-woocommerce.php' ); 	// Кастомизация WooCommerce
include( 'cpm/hooks.php' ); 				// Кастомизация Project Manager


/** ==========================================================================================
 * Поиск пользоваталей
 * TODO: Сделать отдельным плагином
 * https://gist.github.com/danielbachhuber/7126249
 * http://stackoverflow.com/questions/32958075/how-to-include-authors-users-in-the-results-for-the-native-wordpress-search
 *
 * Также
 * https://www.smashingmagazine.com/2012/06/front-end-author-listing-user-search-wordpress/
 */
add_filter( 'posts_search', 'db_filter_authors_search' );
function db_filter_authors_search( $posts_search ) {

	// Don't modify the query at all if we're not on the search template
	// or if the LIKE is empty
	if ( !is_search() || empty( $posts_search ) )
		return $posts_search;

	global $wpdb;
	// Get all of the users of the blog and see if the search query matches either
	// the display name or the user login
	add_filter( 'pre_user_query', 'db_filter_user_query' );
	$search = sanitize_text_field( get_query_var( 's' ) );
	$args = array(
		'count_total' => false,
		'search' => sprintf( '*%s*', $search ),
		'search_fields' => array(
			'display_name',
			'user_login',
		),
		'fields' => 'ID',
	);
	$matching_users = get_users( $args );
	remove_filter( 'pre_user_query', 'db_filter_user_query' );
	// Don't modify the query if there aren't any matching users
	if ( empty( $matching_users ) )
		return $posts_search;
	// Take a slightly different approach than core where we want all of the posts from these authors
	$posts_search = str_replace( ')))', ")) OR ( {$wpdb->posts}.post_author IN (" . implode( ',', array_map( 'absint', $matching_users ) ) . ")))", $posts_search );
	return $posts_search;
}
/**
 * Modify get_users() to search display_name instead of user_nicename
 */
function db_filter_user_query( &$user_query ) {

	if ( is_object( $user_query ) )
		$user_query->query_where = str_replace( "user_nicename LIKE", "display_name LIKE", $user_query->query_where );
	return $user_query;
} 

/**
 * Разрешенные типы файлов
 * https://codex.wordpress.org/%D0%A7%D0%90%D0%92%D0%9E/%D0%9A%D0%B0%D0%BA_%D0%B7%D0%B0%D0%B3%D1%80%D1%83%D0%B7%D0%B8%D1%82%D1%8C_%D0%BD%D0%B5%D1%81%D1%82%D0%B0%D0%BD%D0%B4%D0%B0%D1%80%D1%82%D0%BD%D1%8B%D0%B9_%D1%84%D0%B0%D0%B9%D0%BB
 */
add_filter( 'upload_mimes', 'additional_mime_types' );
function additional_mime_types( $mimes ) 
{
	$mimes['rar'] = 'application/x-rar-compressed';
	$mimes['xls'] = 'application/vnd.ms-excel';
	return $mimes;
}


 
