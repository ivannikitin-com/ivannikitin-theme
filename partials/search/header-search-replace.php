<?php
/**
 * Site header search dropdown HTML
 *
 * Расширения поиска для внутренних страниц
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 4.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

?>

<div id="searchform-header-replace" class="clr header-searchform-wrap">
	<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-searchform">
		<input id="txtSearch" type="search" name="s" autocomplete="off" placeholder="<?php echo esc_html__( 'Type then hit enter to search...', 'total' ); ?>" />
		<?php if ( WPEX_WPML_ACTIVE ) { ?>
			<input type="hidden" name="lang" value="<?php echo( ICL_LANGUAGE_CODE ); ?>"/>
		<?php } ?>
	</form>
	<span id="searchform-header-replace-close" class="fa fa-times"></span>
</div><!-- #searchform-header-replace -->