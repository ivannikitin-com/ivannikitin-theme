<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package IvanNikitin_2019
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function in_2019_woocommerce_setup()
{
	add_theme_support('woocommerce');
	add_theme_support('wc-product-gallery-zoom');
	add_theme_support('wc-product-gallery-lightbox');
	add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'in_2019_woocommerce_setup');

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function in_2019_woocommerce_scripts()
{
	$version = wp_get_theme()->get('Version');
	wp_enqueue_style(
		'in-2019-woocommerce-style',
		get_template_directory_uri() . '/woocommerce.css',
		array(),
		$version
	);
}
add_action('wp_enqueue_scripts', 'in_2019_woocommerce_scripts');

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function in_2019_woocommerce_active_body_class($classes)
{
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter('body_class', 'in_2019_woocommerce_active_body_class');

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function in_2019_woocommerce_products_per_page()
{
	return 12;
}
add_filter('loop_shop_per_page', 'in_2019_woocommerce_products_per_page');

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function in_2019_woocommerce_thumbnail_columns()
{
	return 4;
}
add_filter('woocommerce_product_thumbnails_columns', 'in_2019_woocommerce_thumbnail_columns');

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function in_2019_woocommerce_loop_columns()
{
	return 1;
}
add_filter('loop_shop_columns', 'in_2019_woocommerce_loop_columns');

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function in_2019_woocommerce_related_products_args($args)
{
	$defaults = array(
		'posts_per_page' => 3,
		'columns' => 3
	);

	$args = wp_parse_args($defaults, $args);

	return $args;
}
add_filter('woocommerce_output_related_products_args', 'in_2019_woocommerce_related_products_args');

if (!function_exists('in_2019_woocommerce_product_columns_wrapper')) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function in_2019_woocommerce_product_columns_wrapper()
	{
		$columns = in_2019_woocommerce_loop_columns();
		echo '<div class="columns-' . absint($columns) . '">';
	}
}
add_action('woocommerce_before_shop_loop', 'in_2019_woocommerce_product_columns_wrapper', 40);

if (!function_exists('in_2019_woocommerce_product_columns_wrapper_close')) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function in_2019_woocommerce_product_columns_wrapper_close()
	{
		echo '</div>';
	}
}
add_action('woocommerce_after_shop_loop', 'in_2019_woocommerce_product_columns_wrapper_close', 40);

/**
 * Remove default WooCommerce wrapper.
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

if (!function_exists('in_2019_woocommerce_wrapper_before')) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function in_2019_woocommerce_wrapper_before()
	{
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php
	}
}
add_action('woocommerce_before_main_content', 'in_2019_woocommerce_wrapper_before');

if (!function_exists('in_2019_woocommerce_wrapper_after')) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function in_2019_woocommerce_wrapper_after()
	{
		?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}
}
add_action('woocommerce_after_main_content', 'in_2019_woocommerce_wrapper_after');

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'in_2019_woocommerce_header_cart' ) ) {
			in_2019_woocommerce_header_cart();
		}
	?>
 */

if (!function_exists('in_2019_woocommerce_cart_link_fragment')) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function in_2019_woocommerce_cart_link_fragment($fragments)
	{
		ob_start();
		in_2019_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter('woocommerce_add_to_cart_fragments', 'in_2019_woocommerce_cart_link_fragment');

if (!function_exists('in_2019_woocommerce_cart_link')) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function in_2019_woocommerce_cart_link()
	{
		?>
		<a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e(
	'View your shopping cart',
	'in-2019'
); ?>">
			<?php $item_count_text = sprintf(
   	/* translators: number of items in the mini cart. */
   	_n('%d item', '%d items', WC()->cart->get_cart_contents_count(), 'in-2019'),
   	WC()->cart->get_cart_contents_count()
   ); ?>
			<span class="amount"><?php echo wp_kses_data(
   	WC()->cart->get_cart_subtotal()
   ); ?></span> <span class="count"><?php echo esc_html($item_count_text); ?></span>
		</a>
		<?php
	}
}

if (!function_exists('in_2019_woocommerce_header_cart')) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function in_2019_woocommerce_header_cart()
	{
		if (is_cart()) {
			$class = 'current-menu-item';
		} else {
			$class = 'nodecor';
		} ?>
		<ul id="site-header-cart" class="site-header__cart">
			<li class="<?php echo esc_attr($class); ?>">
				<?php in_2019_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
    $instance = array(
    	'title' => ''
    );

    the_widget('WC_Widget_Cart', $instance);?>
			</li>
		</ul>
		<?php
	}
}

/**
 * ==============
 * Rewrite hooks
 * ==============
 */
function in_woocommerce_start_container()
{
	echo '<div class="container-fluid">';
}

function in_woocommerce_end_container()
{
	echo '</div>';
}

function in_woocommerce_before_shop_loop_title()
{
	echo '<div class="shop-loop-header">';
	echo '<div class="shop-loop-header__label">' .
		esc_html('Название услуги', 'in-2019') .
		'</div>';
	echo '<div class="shop-loop-header__label">' . esc_html('Стоимость', 'in-2019') . '</div>';
	echo '</div>';
}

function in_woocommerce_wrap_start()
{
	echo '<div class="product__value">';
}

function in_woocommerce_wrap_end()
{
	echo '</div>';
}

// woocommerce_before_main_content
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
add_action('woocommerce_before_main_content', 'in_woocommerce_start_container', 20);

// woocommerce_after_main_content
add_action('woocommerce_after_main_content', 'in_woocommerce_end_container', 20);

// woocommerce_sidebar
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// woocommerce_before_shop_loop
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
add_action('woocommerce_before_shop_loop', 'in_woocommerce_before_shop_loop_title', 30);

// woocommerce_before_shop_loop_item_title
remove_action(
	'woocommerce_before_shop_loop_item_title',
	'woocommerce_template_loop_product_thumbnail',
	10
);
remove_action(
	'woocommerce_before_shop_loop_item_title',
	'woocommerce_show_product_loop_sale_flash',
	10
);

// woocommerce_after_shop_loop_item_title
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

// woocommerce_after_shop_loop_item
add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 9);
add_action('woocommerce_after_shop_loop_item', 'in_woocommerce_wrap_end', 6);
add_action('woocommerce_after_shop_loop_item', 'in_woocommerce_wrap_start', 7);
add_action('woocommerce_after_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 9);
add_action('woocommerce_after_shop_loop_item', 'in_woocommerce_wrap_end', 15);

// woocommerce_before_shop_loop_item
add_action('woocommerce_before_shop_loop_item', 'in_woocommerce_wrap_start', 9);

function woocommerce_checkout_before_order_start()
{
	echo '<div class="you-order">';
}

function woocommerce_checkout_before_order_end()
{
	echo '</div>';
}

// woocommerce_checkout_before_order_review_heading
add_action(
	'woocommerce_checkout_before_order_review_heading',
	'woocommerce_checkout_before_order_start',
	0
);

// woocommerce_checkout_after_order_review
add_action('woocommerce_checkout_after_order_review', 'woocommerce_checkout_before_order_end', 0);

// woocommerce_archive_description
remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
remove_action('woocommerce_archive_description', 'woocommerce_product_archive_description', 10);

// woocommerce_after_shop_loop
add_action('woocommerce_after_shop_loop', 'woocommerce_taxonomy_archive_description', 11);
add_action('woocommerce_after_shop_loop', 'woocommerce_product_archive_description', 11);
