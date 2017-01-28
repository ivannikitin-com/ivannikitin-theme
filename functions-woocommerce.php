<?php
/**
 * Хуки и кастомизация WooCommerce
 */

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