<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

final class Pojo_Builder_Animation_Actions {
	
	const DB_ANIMATION = 'pb_animation';
	
	private $_animations;

	public function get_animations() {
		if ( is_null( $this->_animations ) ) {
			$this->_animations = apply_filters(
				'pb_animation_animations_list',
				array(
					// class => title
					'fadeIn' => __( 'Fade In', 'pb-animation' ),
					'fadeInDown' => __( 'Fade Down', 'pb-animation' ),
					'fadeInUp' => __( 'Fade Up', 'pb-animation' ),
					'fadeInRight' => __( 'Fade Right', 'pb-animation' ),
					'fadeInLeft' => __( 'Fade Left', 'pb-animation' ),
					
					'zoomIn' => __( 'Zoom In', 'pb-animation' ),
					'bounce' => __( 'Bounce', 'pb-animation' ),
					'flash' => __( 'Flash', 'pb-animation' ),
				)
			);
		}
		return $this->_animations;
	}

	public function widget_attributes( $widget_attributes, $widget ) {
		if ( ! empty( $widget['widget_args'][ self::DB_ANIMATION ] ) ) {
			$widget_attributes['data-animation_type'] = $widget['widget_args'][ self::DB_ANIMATION ];
		}
		
		return $widget_attributes;
	}

	public function pb_after_widget_form( WP_Widget $widget, $instance ) {
		$id    = self::DB_ANIMATION;
		$value = isset( $instance[ $id ] ) ? $instance[ $id ] : '';
		?>
		<p>
			<label for="<?php echo $widget->get_field_id( $id ); ?>"><?php _e( 'Animation', 'pb-animation' ); ?></label>
			<select id="<?php echo $widget->get_field_id( $id ); ?>" name="<?php echo $widget->get_field_name( $id ); ?>" class="widefat pb-widget-<?php echo esc_attr( $id ); ?>">
				<option value=""><?php _e( 'None', 'pb-animation' ); ?></option>
				<?php foreach ( $this->get_animations() as $animation_class => $animation_title ) : ?>
					<option value="<?php echo esc_attr( $animation_class ); ?>"<?php selected( $value, $animation_class ); ?>><?php echo $animation_title; ?></option>
				<?php endforeach; ?>
			</select>
		</p>
	<?php
	}

	public function pb_widget_update_callback( $instance, $new_instance ) {
		$id = self::DB_ANIMATION;
		$instance[ $id ] = isset( $new_instance[ $id ] ) ? $new_instance[ $id ] : '';
		return $instance;
	}

	public function widget_css_classes( $css_classes, $widget ) {
		if ( ! empty( $widget['widget_args'][ self::DB_ANIMATION ] ) ) {
			$css_classes[] = 'pb-animation-running';
		}
		return $css_classes;
	}

	public function __construct() {
		add_action( 'pb_widget_attributes', array( &$this, 'widget_attributes' ), 30, 2 );

		add_action( 'pb_after_widget_form', array( &$this, 'pb_after_widget_form' ), 10, 2 );
		add_filter( 'pb_widget_update_callback', array( &$this, 'pb_widget_update_callback' ), 10, 2 );
		add_filter( 'pb_widget_css_classes', array( &$this, 'widget_css_classes' ), 10, 2 );

	}
	
}