<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

final class Pojo_Builder_Animation_Scripts {

	public function enqueue_scripts() {
		wp_enqueue_style( 'pojo-builder-animation', POJO_BUILDER_ANIMATION_ASSETS_URL . 'css/styles.css' );
		wp_register_script( 'pojo-builder-animation', POJO_BUILDER_ANIMATION_ASSETS_URL . 'js/scripts.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'pojo-builder-animation' );
	}

	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_scripts' ), 200 );
	}
	
}