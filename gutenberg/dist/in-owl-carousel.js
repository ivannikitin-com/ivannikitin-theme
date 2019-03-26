jQuery( document ).ready( function( $ ) {

	// Формирование карусели
	const $owl = $( '.owl-carousel-custom' );

	$owl.owlCarousel( {
		loop: false,
		center: true,
		responsive: {
			0: {
				items: 1,
				startPosition: 0,
			},
			500: {
				items: 2,
				startPosition: 1,
			},
			768: {
				items: 3,
				startPosition: 1,
			},
		},
	} );

	$owl
		.children()
		.children()
		.children()
		.children()
		.each( function( index ) {
			$( this ).attr( 'data-position', index ); // NB: .attr() instead of .data()
		} );

	const activeSlideId = $( '.owl-item.center' )
		.children()
		.attr( 'class' )
		.split( '-' )[ 1 ];

	$( '.wp-block-in-2019-what-enter-item-' + activeSlideId ).addClass( 'active' );

	$( document ).on( 'click', '.owl-item>div', function() {
		$owl.trigger( 'to.owl.carousel', $( this ).data( 'position' ) );

		$( '.wp-block-in-2019-what-enter' ).removeClass( 'active' );

		const changeActiveSlideId = $( '.owl-item.center' )
			.children()
			.attr( 'class' )
			.split( '-' )[ 1 ];

		$( '.wp-block-in-2019-what-enter-item-' + changeActiveSlideId ).addClass( 'active' );
	} );

	// Плавный скролл
	$( '.owl-carousel-custom' ).on( 'click', '.item__link-more', function( event ) {
		event.preventDefault();

		let id = $( this ).attr( 'href' ),
			top = $( id ).offset().top;

		//анимируем переход на расстояние - top за 1500 мс
		$( 'body,html' ).animate( { scrollTop: top }, 1000 );
	} );

	$('a').on('click', function() {
		if($(this).data('name-service')) {
			$('.name-service-field').val($(this).data('name-service'));
		}
	})
} );

