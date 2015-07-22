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
						var $thisEl = $( this );
						
						if ( $thisEl.hasClass( 'animated' ) ) {
							return;
						}
						
						$thisEl
							.css( 'visibility', 'visible' )
							.addClass( 'animated ' + $thisEl.data( 'animation_type' ) );
						
						// Tweak for HTML5 Fullscreen in chrome browser
						setTimeout( function() {
							$thisEl.removeClass( $thisEl.data( 'animation_type' ) );
						}, 5000 );
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