(function( $ ) {
	'use strict';

	document.addEventListener( 'DOMContentLoaded', function () {
		var splide = new Splide( '.splide', {
			type    : 'loop',
			autoplay: 'play',
			perPage : 1,
		  } );

		splide.on( 'autoplay:playing', function ( rate ) {
		
		} );

		splide.mount();
	});

})( jQuery );
