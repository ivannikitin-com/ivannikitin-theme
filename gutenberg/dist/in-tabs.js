jQuery( document ).ready( function( $ ) {
	$( '.in-tabs-wrap' ).each( function( a ) {
		const inStartTab = $( this )
			.find( '> .in-tabs-title-list .in-tab-title-active a' )
			.attr( 'data-tab' );

		$( '.in-tabs-content-wrap' )
			.find( '.in-inner-tab-' + inStartTab )
			.addClass( 'active' );
	} );

	$( '.in-tabs-wrap > .in-tabs-title-list .in-title-item a' ).on( 'click', function() {
		const tabId = $( this ).attr( 'data-tab' );
		const tabList = $( '.in-tabs-content-wrap .in-tab-inner-content' );
		tabList.removeClass( 'active' );

		$( '.in-tabs-wrap > .in-tabs-title-list .in-title-item' )
			.removeClass( 'in-tab-title-active' )
			.addClass( 'in-tab-title-inactive' );

		$( this )
			.parent()
			.removeClass( 'in-tab-title-inactive' )
			.addClass( 'in-tab-title-active' );

		$( '.in-tabs-content-wrap' )
			.find( '.in-inner-tab-' + tabId )
			.addClass( 'active' );
	} );
} );
