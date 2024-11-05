<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Widget_Property_Search_Form' ) ) {
	class Widget_Property_Search_Form extends WP_Widget {
		/**
		 * Constructor.
		 */
		public function __construct() {
			parent::__construct(
				'property_search_form_widget',
				__( 'Property Search Form Widget', 'tf-real-estate' ),
				array( 'description' => __( 'Properties Search Form.', 'tf-real-estate' ) )
			);
		}

		/**
		 * Output widget
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {
			$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Property Search', 'tf-real-estate' );
			echo $args['before_widget'];
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			echo tfre_get_template_with_arguments( 'widgets/property-search-form/property-search-form-sidebar.php', array( 'args' => $args, 'instance' => $instance ) );
			echo $args['after_widget'];
		}

		/**
		 * Back-end widget form.
		 * @param array $instance
		 */
		public function form( $instance ) {
			$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Property Search', 'tf-real-estate' );
			?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_name( 'title' )); ?>"><?php _e( 'Title:', 'tf-real-estate' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"
					name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
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
			$instance          = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			return $instance;
		}
	}
}