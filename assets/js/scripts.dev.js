/* global jQuery */

( function( $ ) {
	'use strict';
	
	var Pojo_Builder_Animation = {
		cache: {
			$document: $( document ),
			$window: $( window )
		},
		
		cacheElements: function() {
			this.cache.$body = $( 'body' );
		},

		buildElements: function() {
			
		},

		bindEvents: function() {
			var self = this;

			$( '.pb-animation-running' ).waypoint( function() {
					$( this )
						.show()
						.addClass( 'animated ' + $( this ).data( 'animation_type' ) );
				},
				{
					offset: '80%'
				}
			);
		},

		init: function() {
			this.cacheElements();
			this.buildElements();
			this.bindEvents();
		}
	};

	$( document ).ready( function( $ ) {
		Pojo_Builder_Animation.init();
	} );
	
}( jQuery ) );