jQuery( document ).ready( function( $ ) {
	const $owl = $( '.owl-carousel-custom' );

	$owl.owlCarousel( {
		loop: true,
		center: true,
	} );

	$owl
		.children()
		.children()
		.children()
		.children()
		.each( function( index ) {
			$( this ).attr( 'data-position', index ); // NB: .attr() instead of .data()
		} );

	$( document ).on( 'click', '.owl-item>div', function() {
		$owl.trigger( 'to.owl.carousel', $( this ).data( 'position' ) );
	} );
} );
