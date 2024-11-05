<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Widget_Featured_Properties' ) ) {
	class Widget_Featured_Properties extends WP_Widget {
		/**
		 * Constructor.
		 */
		public function __construct() {
			parent::__construct(
				'featured_properties_widget',
				__( 'Featured Properties Widget', 'tf-real-estate' ),
				array( 'description' => __( 'Featured Properties Widget.', 'tf-real-estate' ) )
			);
			wp_enqueue_script( 'widget-featured-properties-script', TF_PLUGIN_URL . 'public/templates/widgets/featured-properties/assets/js/featured-properties.js', array( 'jquery' ), false, true );
		}

		/**
		 * Output widget
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {
			$title                        = ! empty( $instance['title'] ) ? $instance['title'] : __( '', 'tf-real-estate' );
			$args['number_of_properties'] = ! empty( $instance['number_of_properties'] ) ? $instance['number_of_properties'] : __( '5', 'tf-real-estate' );
			$args['style']                = ! empty( $instance['style'] ) ? $instance['style'] : __( 'list', 'tf-real-estate' );

			echo $args['before_widget'];
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			echo tfre_get_template_with_arguments( 'widgets/featured-properties/featured-properties.php', array( 'args' => $args, 'instance' => $instance ) );
			echo $args['after_widget'];
		}

		/**
		 * Back-end widget form.
		 * @param array $instance
		 */
		public function form( $instance ) {
			$title                = ! empty( $instance['title'] ) ? $instance['title'] : __( '', 'tf-real-estate' );
			$number_of_properties = ! empty( $instance['number_of_properties'] ) ? $instance['number_of_properties'] : __( '5', 'tf-real-estate' );
			$style                = ! empty( $instance['style'] ) ? $instance['style'] : __( 'list', 'tf-real-estate' );
			?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_name( 'title' )); ?>"><?php _e( 'Title:', 'tf-real-estate' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"
					name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label
					for="<?php echo esc_attr($this->get_field_name( 'number_of_properties' )); ?>"><?php _e( 'Number of properties:', 'tf-real-estate' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number_of_properties' )); ?>"
					name="<?php echo esc_attr($this->get_field_name( 'number_of_properties' )); ?>" type="text"
					value="<?php echo esc_attr( $number_of_properties ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_name( 'style' )); ?>"><?php _e( 'Style:', 'tf-real-estate' ); ?></label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'style' )); ?>"
					name="<?php echo esc_attr($this->get_field_name( 'style' )); ?>">
					<option value="list" <?php echo esc_attr(selected( 'list', $style )); ?>>List</option>
					<option value="carousel" <?php echo esc_attr(selected( 'carousel', $style )); ?>>Carousel</option>
				</select>
			</p>
			<?php
		}

		/**
		 * Sanitize widget form values as they are saved.
		 * @param array $new_instance
		 * @param array $old_instance
		 * @return array
		 */
		public function update( $new_instance, $old_instance ) {
			$instance                         = array();
			$instance['title']                = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['number_of_properties'] = ( ! empty( $new_instance['number_of_properties'] ) ) ? strip_tags( $new_instance['number_of_properties'] ) : '';
			$instance['style']                = ( ! empty( $new_instance['style'] ) ) ? strip_tags( $new_instance['style'] ) : __( 'list', 'tf-real-estate' );
			return $instance;
		}
	}
}