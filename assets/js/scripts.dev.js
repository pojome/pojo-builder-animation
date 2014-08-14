/* global jQuery */

( function( $ ) {
	'use strict';
	
	var Pojo_Builder_Animation = {
		cacheElements: function() {
			this.cache.$body = $( 'body' );
		},

		buildElements: function() {
			
		},

		bindEvents: function() {
			var self = this;
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