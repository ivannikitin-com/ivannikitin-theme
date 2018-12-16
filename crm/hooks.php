<?php
/**
 * Хуки WC CRM
 */
// Фильтр в файле class-wc-crm-customer
add_filter( 'wc_crm_customer_agents', 'example_callback' );
function in_wc_crm_customer_agents( $agents )
{
	return $agents;
}