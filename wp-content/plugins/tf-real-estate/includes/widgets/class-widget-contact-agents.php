<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Widget_Contact_Agents' ) ) {
	class Widget_Contact_Agents extends WP_Widget {
		/**
		 * Constructor.
		 */
		public function __construct() {
			parent::__construct(
				'contact_agents_widget',
				__( 'Contact Agents Widget', 'tf-real-estate' ),
				array( 'description' => __( 'Contact Agents Widget.', 'tf-real-estate' ) )
			);
		}

		/**
		 * Output widget
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {
			$title                    = ! empty( $instance['title'] ) ? __( $instance['title'], 'tf-real-estate' ) : __( 'Contact Agents', 'tf-real-estate' );
			$args['number_of_agents'] = ! empty( $instance['number_of_agents'] ) ? $instance['number_of_agents'] : __( '3', 'tf-real-estate' );

			echo $args['before_widget'];
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			echo tfre_get_template_with_arguments( 'widgets/contact-agents/contact-agents.php', array( 'args' => $args, 'instance' => $instance ) );
			echo $args['after_widget'];
		}

		/**
		 * Back-end widget form.
		 * @param array $instance
		 */
		public function form( $instance ) {
			$title            = ! empty( $instance['title'] ) ? __( $instance['title'], 'tf-real-estate' ) : __( 'Contact Agents', 'tf-real-estate' );
			$number_of_agents = ! empty( $instance['number_of_agents'] ) ? $instance['number_of_agents'] : __( '3', 'tf-real-estate' );
			?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_name( 'title' )); ?>"><?php _e( 'Title:', 'tf-real-estate' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"
					name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_name( 'number_of_agents' )); ?>"><?php _e( 'Number of agents:', 'tf-real-estate' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number_of_agents' )); ?>"
					name="<?php echo esc_attr($this->get_field_name( 'number_of_agents' )); ?>" type="text"
					value="<?php echo esc_attr( $number_of_agents ); ?>" />
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
			$instance                     = array();
			$instance['title']            = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['number_of_agents'] = ( ! empty( $new_instance['number_of_agents'] ) ) ? strip_tags( $new_instance['number_of_agents'] ) : '';
			return $instance;
		}
	}
}