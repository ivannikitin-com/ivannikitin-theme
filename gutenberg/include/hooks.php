<?php
function in_2019_add_form_fancybox() {
    ?>
    <div id="order_service" style="display: none; max-width: 600px;">
        <?php echo do_shortcode( '[contact-form-7 id="' . get_theme_mod( 'in_order_service' ) . '"]' ); ?>
    </div>
    <?php
}
add_action( 'wp_footer', 'in_2019_add_form_fancybox', 1 );