<?php
/*
Plugin Name: Pojo Builder Animation
Plugin URI: http://pojo.me/
Description: The Builder Animation plugin makes it possible to animate element by setting some animation in widget's builder with Pojo Framework.
Author: Pojo Team
Author URI: http://pojo.me/
Version: 1.0.1
Text Domain: pb-animation
Domain Path: /languages/
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'POJO_BUILDER_ANIMATION__FILE__', __FILE__ );
define( 'POJO_BUILDER_ANIMATION_BASE', plugin_basename( POJO_BUILDER_ANIMATION__FILE__ ) );
define( 'POJO_BUILDER_ANIMATION_URL', plugins_url( '/', POJO_BUILDER_ANIMATION__FILE__ ) );
define( 'POJO_BUILDER_ANIMATION_ASSETS_URL', POJO_BUILDER_ANIMATION_URL . 'assets/' );

final class Pojo_Builder_Animation {
	
	/**
	 * @var Pojo_Builder_Animation The one true Pojo_Builder_Animation
	 * @since 1.0.0
	 */
	private static $_instance = null;
	
	/** @var Pojo_Builder_Animation_Actions */
	public $actions;
	
	/** @var Pojo_Builder_Animation_Scripts */
	public $scripts;

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
	
	/**cd 
	 * @return Pojo_Builder_Animation
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) )
			self::$_instance = new Pojo_Builder_Animation();
		
		return self::$_instance;
	}

	public function bootstrap() {
		// This plugin for Pojo Themes..
		// TODO: Add notice for non-pojo theme
		if ( ! class_exists( 'Pojo_Core' ) )
			return;
		
		include( 'classes/class-pojo-builder-animation-actions.php' );
		include( 'classes/class-pojo-builder-animation-scripts.php' );
		
		$this->actions = new Pojo_Builder_Animation_Actions();
		$this->scripts = new Pojo_Builder_Animation_Scripts();
	}
	
	private function __construct() {
		add_action( 'init', array( &$this, 'bootstrap' ) );
		add_action( 'plugins_loaded', array( &$this, 'load_textdomain' ) );
	}
	
}

Pojo_Builder_Animation::instance();
// EOF