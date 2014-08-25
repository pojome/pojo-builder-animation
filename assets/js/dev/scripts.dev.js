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
			this.cache.$animationRunning = $( '.pb-animation-running' );
		},

		buildElements: function() {},

		bindEvents: function() {
			var self = this;

			self.cache.$body.imagesLoaded().always( function( instance ) {
				self.cache.$animationRunning.waypoint( function() {
						$( this )
							.css( 'visibility', 'visible' )
							.addClass( 'animated ' + $( this ).data( 'animation_type' ) );
					},
					{
						offset: '80%'
					}
				);
			} );
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