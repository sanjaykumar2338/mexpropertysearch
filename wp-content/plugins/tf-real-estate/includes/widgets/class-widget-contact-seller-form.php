<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Widget_Contact_Seller_Form' ) ) {
	class Widget_Contact_Seller_Form extends WP_Widget {
		/**
		 * Constructor.
		 */
		public function __construct() {
			parent::__construct(
				'contact_seller_widget',
				__( 'Contact Seller Form Widget', 'tf-real-estate' ),
				array( 'description' => __( 'Contact Seller Form Widget.', 'tf-real-estate' ) )
			);
		}

		/**
		 * Output widget
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {
			$title              = ! empty( $instance['title'] ) ? __( $instance['title'], 'tf-real-estate' ) : __( 'Contact seller', 'tf-real-estate' );
			$args['short_code'] = ! empty( $instance['short_code'] ) ? $instance['short_code'] : __( '' );

			echo $args['before_widget'];
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			echo tfre_get_template_with_arguments( 'widgets/contact-seller-form/contact-seller-form.php', array( 'args' => $args, 'instance' => $instance ) );
			echo $args['after_widget'];
		}

		/**
		 * Back-end widget form.
		 * @param array $instance
		 */
		public function form( $instance ) {
			$title      = ! empty( $instance['title'] ) ? __( $instance['title'], 'tf-real-estate' ) : __( 'Contact seller', 'tf-real-estate' );
			$short_code = ! empty( $instance['short_code'] ) ? $instance['short_code'] : __( '' );
			?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_name( 'title' )); ?>"><?php _e( 'Title:', 'tf-real-estate' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"
					name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_name( 'short_code' )); ?>"><?php _e( 'Short code:', 'tf-real-estate' ); ?></label>
				<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'short_code' ) ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'short_code' ) ); ?>" type="text" cols="30"
					rows="10"><?php echo esc_attr( $short_code ); ?></textarea>
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
			$instance               = array();
			$instance['title']      = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['short_code'] = ( ! empty( $new_instance['short_code'] ) ) ? strip_tags( $new_instance['short_code'] ) : '';
			return $instance;
		}
	}
}