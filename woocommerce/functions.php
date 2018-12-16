<?php
/**
 * Хуки и кастомизация WooCommerce
 */
 
/**
 * Cоответствие с с Федеральным законом № 152-ФЗ "О персональных данных" 
 */
include( 'tems-of-use.php' ); 

/** ==========================================================================================
 * Вывод списка продуктов в таблице
 * Здесь определяется начало и конце таблицы
 * Вывод продукта - в шаблоне woocommerce/content-product.php
 */

// Функция возвращает true, если нужнен табличный показ продуктов
function is_table_product()
{
	//$result = current_user_can( 'administrator' ) && is_shop();
	$result = is_shop();
	return $result;
}

// Отлючим пагинацию при табличном выводе. мы не можем ее сделать в хуках, поскольку ее надо выключить ДО выбора записей
add_action( 'pre_get_posts', 'set_products_per_page', 1 );					
function set_products_per_page( $query )
{
	// Мы не можем использовать функцию is_table_product() поскольку она работает только после выбора записей
	// Там условный тег!
	// Поэтому привязываемся к URL	
		
	if ( $_SERVER['REQUEST_URI'] != '/service/' ) return;
		
	if ( is_table_product() )
		$query->set( 'posts_per_page', -1 );
}


// Убираем НЕТ В НАЛИЧИИ для ряда продуктов
add_filter( 'woocommerce_stock_html', 'in_woocommerce_stock_html', 10, 3 ); 
function in_woocommerce_stock_html( $availability_html, $availability_availability, $product ) { 
	if ( $product->get_sku() == 'cosulting-free' )
		return '';	
    return $availability_html;
}


/** ==========================================================================================
 * Хук на вывод TITLE личного кабинера в заголовке страницы и в TITLE
 * https://wpexplorer-themes.com/total/docs/page-title-filter/
 * https://yoast.com/wordpress/plugins/seo/api/
 */
add_filter( 'wpex_title', 'in_wc_my_account_title' );		// TOTAL hook
add_filter( 'wpseo_title', 'in_wc_my_account_title' );		// Yoast SEO hook
function in_wc_my_account_title( $title ) 
{
	// Если это страница аккаунта и WC включен
	if ( function_exists( 'is_account_page' ) && is_account_page() )
	{
		// Текущий пользователь
		$current_user = wp_get_current_user();
		
		// Пользователь авторизован?
		if ( $current_user->ID != 0 )
			$title = 'Личный кабинет пользователя ' . esc_html( $current_user->display_name );
		else
			$title = 'Вход в личный кабинет';
	}		

    return $title; 
}


/** ==========================================================================================
 * Хук на вывод TITLE личного кабинера в заголовке страницы и в TITLE
 * https://wpexplorer-themes.com/total/docs/page-title-filter/
 * https://yoast.com/wordpress/plugins/seo/api/
 */
add_filter( 'woocommerce_product_add_to_cart_text' , 'in_woocommerce_product_add_to_cart_text' );
/**
 * custom_woocommerce_template_loop_add_to_cart
*/
function in_woocommerce_product_add_to_cart_text() {
	global $product;
	
	$product_type = $product->product_type;
	
	switch ( $product_type ) {
		case 'external':
			return 'Купить';
		break;
		case 'grouped':
			return 'Подробнее...';
		break;
		case 'simple':
			return 'Оплатить';
		break;
		case 'variable':
			return 'Выберите условия...';
		break;
		default:
			return 'Подробнее...';
	}
	
}


/** ==========================================================================================
 * Хук на вывод РАСПРОДАЖА
 */
add_filter( 'woocommerce_sale_flash' , 'in_woocommerce_sale_flash', 99, 3 );
/**
 * custom_woocommerce_template_loop_add_to_cart
*/
function in_woocommerce_sale_flash( $text, $post, $product ) 
{
	return '<span class="onsale">Льготная цена!</span>';
	
}


