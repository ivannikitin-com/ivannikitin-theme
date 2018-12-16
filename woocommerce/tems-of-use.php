<?php
/**
 * Cоответствие с с Федеральным законом № 152-ФЗ "О персональных данных" 
 * https://stackoverflow.com/questions/33122634/how-do-i-validate-agree-terms-checkbox-for-woocommerce-registration-form
 */

// Форма регистрации
add_action( 'woocommerce_register_form', 'in_woocommerce_register_form' ); 
function in_woocommerce_register_form()
{
    // Используем стандартный шаблон
	//wc_get_template( 'checkout/terms.php' );
	
?>	<p class="form-row terms wc-terms-and-conditions">
		<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
			<input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="terms" <?php checked( apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms'] ) ), true ); ?> id="terms" /> <span><?php printf( __( 'I&rsquo;ve read and accept the <a href="%s" class="woocommerce-terms-and-conditions-link">terms &amp; conditions</a>', 'woocommerce' ), esc_url( wc_get_page_permalink( 'terms' ) ) ); ?></span> <span class="required">*</span>
		</label>
		<input type="hidden" name="terms-field" value="1" />
	</p>
<?php
}

// Проверка согласия с условиями
add_action( 'woocommerce_process_registration_errors', 'in_woocommerce_process_registration_errors', 10, 4 );
function in_woocommerce_process_registration_errors( $errors, $username, $password, $email )
{
    if ( empty( $_POST['terms'] ) ) {
        throw new Exception( 'В соответствии с Федеральным законом РФ № 152-ФЗ "О персональных данных" Вы должны прочитать и принять соглашение об обработке Ваших персональных данных.' );
    }
    return $errors;
}
