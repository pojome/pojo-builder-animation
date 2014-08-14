<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

final class Pojo_Builder_Animation_Scripts {

	public function enqueue_scripts() {
		wp_enqueue_style( 'pojo-builder-animation', POJO_BUILDER_ANIMATION_ASSETS_URL . 'css/animate.min.css' );
		wp_register_script( 'pojo-builder-animation', POJO_BUILDER_ANIMATION_ASSETS_URL . 'js/scripts.dev.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'pojo-builder-animation' );
	}

	public function widget_attributes( $widget_attributes, $widget ) {
		if ( ! empty( $widget['widget_args']['pb_animation'] ) ) {
			$widget_attributes['data-animation_type'] = $widget['widget_args']['pb_animation'];
		}
		
		return $widget_attributes;
	}

	public function pb_after_widget_form( WP_Widget $widget, $instance ) {
		$id    = 'pb_animation';
		$value = isset( $instance[ $id ] ) ? $instance[ $id ] : '';
		?>
		<p>
			<label for="<?php echo $widget->get_field_id( $id ); ?>"><?php _e( 'Animation', 'pojo' ); ?></label>
			<input class="widefat pb-widget-<?php echo esc_attr( $id ); ?>" id="<?php echo $widget->get_field_id( $id ); ?>" name="<?php echo $widget->get_field_name( $id ); ?>" type="text" value="<?php echo esc_attr( $value ); ?>" />
		</p>
	<?php
	}

	public function pb_widget_update_callback( $instance, $new_instance ) {
		$id = 'pb_animation';
		$instance[ $id ] = isset( $new_instance[ $id ] ) ? $new_instance[ $id ] : '';
		return $instance;
	}

	public function widget_css_classes( $css_classes, $widget ) {
		if ( ! empty( $widget['widget_args']['pb_animation'] ) ) {
			$css_classes[] = 'pb-animation-running';
		}
		
		return $css_classes;
	}

	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_scripts' ), 200 );

		add_action( 'pb_widget_attributes', array( &$this, 'widget_attributes' ), 30, 2 );

		add_action( 'pb_after_widget_form', array( &$this, 'pb_after_widget_form' ), 10, 2 );
		add_filter( 'pb_widget_update_callback', array( &$this, 'pb_widget_update_callback' ), 10, 2 );
		add_filter( 'pb_widget_css_classes', array( &$this, 'widget_css_classes' ), 10, 2 );

	}
	
}