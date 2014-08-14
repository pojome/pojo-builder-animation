<?php
/*
Plugin Name: Pojo Builder Animation
Plugin URI: http://pojo.me/
Description: ..
Author: Pojo Team
Author URI: http://pojo.me/
Version: 1.0.0
Text Domain: pb-animation
Domain Path: /languages/
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'POJO_BUILDER_ANIMATION__FILE__', __FILE__ );
define( 'POJO_BUILDER_ANIMATION_BASE', plugin_basename( POJO_BUILDER_ANIMATION__FILE__ ) );


final class Pojo_Builder_Animation {
	
	/**
	 * @var Pojo_Builder_Animation The one true Pojo_Builder_Animation
	 * @since 1.0.0
	 */
	private static $_instance = null;
	
	public function load_textdomain() {
		load_plugin_textdomain( 'pb-animation', false, basename( dirname( __FILE__ ) ) . '/languages' );
	}
	
	/**
	 * Throw error on object clone
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'pb-animation' ), '1.0.0' );
	}
	
	/**
	 * Disable unserializing of the class
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'pb-animation' ), '1.0.0' );
	}
	
	/**
	 * @since 1.0.0
	 * @return Pojo_Builder_Animation
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) )
			self::$_instance = new Pojo_Builder_Animation();
		
		return self::$_instance;
	}
	
	private function __construct() {
		add_action( 'plugins_loaded', array( &$this, 'load_textdomain' ) );
	}
	
}

Pojo_Builder_Animation::instance();
// EOF/ EOF