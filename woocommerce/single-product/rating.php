<?php
/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 999
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product;
if ( 'no' === get_option( 'woocommerce_enable_review_rating' ) ) {
	return;
}
$rating_count    = $product->get_rating_count();
$review_count    = $product->get_review_count();
$average         = $product->get_average_rating();
$average_display = str_replace( '.00', '', $average );
$average_display = ( strpos( $average_display, '.' ) !== false ) ? $average_display + 0 : floatval( $average_display ) . '.0';
$comments_open   = comments_open(); ?>

<div class="woocommerce-product-rating">
	<?php if ( $average ) {
		echo wc_get_rating_html( $average, $rating_count );
	} elseif ( $comments_open ) {
		echo '<div class="star-rating">' . wc_get_star_rating_html( $average ) . '</div>'; // show 0 ratings
	} ?>
	<?php if ( $comments_open ) : ?>
		<?php if ( $average ) { ?>
			<span class="wpex-avg-rating"><?php echo esc_html( $average_display ); ?></span> <a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<?php printf( _n( '%s review', '%s reviews', $review_count, 'total' ), '<span class="wpex-count">' . esc_html( $review_count ) . '</span>' ); ?>)</a>
		<?php } else { ?>
			<a href="#reviews" class="woocommerce-review-link" rel="nofollow">Будьте первым, кто оставит отзыв</a>
		<?php } ?>
	<?php endif ?>
</div>
