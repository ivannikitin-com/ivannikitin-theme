<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<section id="wc-dashboard">
	<p>Операции в личном кабинете:</p>
	<ul>
		<li>
			<strong><a href="<?php echo wc_get_endpoint_url( 'edit-account' ) ?>billing/">Ваш профиль</a></strong> &mdash;
			Ваше имя, контакнтые данные (E-mail, телефон, фотография профиля и др.)<br/>
			Пожалуйста, проверьте корректность этих данных и при необходимости исправьте.<br/>
			Здесь можно при необходимости изменить пароль.
		</li>	
		<li>
			<strong><a href="<?php echo wc_get_endpoint_url( 'orders' ) ?>">Заказы</a></strong> &mdash; 
			список ваших заказов.
		</li>
		<li>
			<strong><a href="<?php echo wc_get_endpoint_url( 'edit-address' ) ?>billing/">Ваш адрес</a></strong> &mdash;
			ваш официальный адрес или <strong>юридический адрес</strong> вашей организации.<br/>
			Пожалуйста, проверьте его корректность и при необходимости исправьте. Этот адрес используется для оформления документов.  
		</li>
		<li>
			<strong><a href="<?php echo wc_get_endpoint_url( 'edit-address' ) ?>shipping/">Адрес доставки</a></strong> &mdash;
			это <strong>почтовый адрес</strong>, по которому мы отправляем вам всю корреспонденцию и оригиналы документов.<br/>
			Пожалуйста, проверьте его корректность и при необходимости исправьте.  
		</li>	
		<li>
			<strong><a href="/my-account/projects/">Проекты</a></strong> &mdash;
			Список доступных вам проектов и задач в них. 
		</li>
		<li>
			<strong><a href="/my-account/tasks/?page=cpm_task&tab=current">Задачи</a></strong> &mdash;
			Задачи, которые Вы отслеживаете, или по которым мы ждем от Вас реакции или ответа.<br/>
			Пожалуйста, регулярно просматривайте этот список.
		</li>		
		<li>
			<strong><a href="<?php echo esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) )?>">Выход</a></strong> &mdash;
			Завершение текущей сессии и выход из системы. 
		</li>	
	</ul>
</section>
<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
