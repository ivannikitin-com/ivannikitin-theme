<?php
/**
 * Хуки и настройки плагина woocommerce-pdf-invoices-packing-slips
 */ 

// Название кнопки на скачивание счета
add_filter( 'wpo_wcpdf_myaccount_button_text', 'in_wpo_wcpdf_myaccount_button_text', 10 , 2 );
function in_wpo_wcpdf_myaccount_button_text( $button_text, $invoice )
{
	return 'Счет (PDF)';
}


// Ссылки в ЛК на скачивание счета
add_filter( 'wpo_wcpdf_myaccount_actions', 'in_wpo_wcpdf_myaccount_actions', 10 , 2 );
function in_wpo_wcpdf_myaccount_actions( $actions, $order )
{
	if ( isset( $actions['invoice'] ) )
	{
		$actions['packing-slip'] = $actions['invoice'];
		$actions['packing-slip']['name'] = 'Акт (PDF)';
		$actions['packing-slip']['url'] = str_replace( 'document_type=invoice', 'document_type=packing-slip', $actions['packing-slip']['url'] );
	}
	return $actions;
}