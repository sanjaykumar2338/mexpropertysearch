<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Widget_Property_Taxonomy' ) ) {
	class Widget_Property_Taxonomy extends WP_Widget {
		/**
		 * Constructor.
		 */
		public function __construct() {
			parent::__construct(
				'property_taxonomy_widget',
				__( 'Property Taxonomy Widget', 'tf-real-estate' ),
				array( 'description' => __( 'Property Taxonomy Widget.', 'tf-real-estate' ) )
			);
		}

		/**
		 * Output widget
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {
			$title                      = ! empty( $instance['title'] ) ? $instance['title'] : '';
			$args['taxonomy']           = ! empty( $instance['taxonomy'] ) ? $instance['taxonomy'] : '';
			$args['number_of_taxonomy'] = ! empty( $instance['number_of_taxonomy'] ) ? $instance['number_of_taxonomy'] : __( '6', 'tf-real-estate' );

			echo $args['before_widget'];
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			echo tfre_get_template_with_arguments( 'widgets/property-taxonomy/property-taxonomy.php', array( 'args' => $args, 'instance' => $instance ) );
			echo $args['after_widget'];
		}

		/**
		 * Back-end widget form.
		 * @param array $instance
		 */
		public function form( $instance ) {
			$title              = ! empty( $instance['title'] ) ? $instance['title'] : '';
			$number_of_taxonomy = ! empty( $instance['number_of_taxonomy'] ) ? $instance['number_of_taxonomy'] : __( '6', 'tf-real-estate' );
			$taxonomy           = ! empty( $instance['taxonomy'] ) ? $instance['taxonomy'] : '';
			$taxonomies         = get_object_taxonomies( 'real-estate' );
			?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_name( 'title' )); ?>"><?php _e( 'Title:', 'tf-real-estate' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"
					name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_name( 'taxonomy' )); ?>"><?php _e( 'Choose taxonomy:', 'tf-real-estate' ); ?></label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'taxonomy' )); ?>"
					name="<?php echo esc_attr($this->get_field_name( 'taxonomy' )); ?>">
					<?php foreach ( $taxonomies as $tax ) :
						$term = get_taxonomy( $tax ); ?>
						<option value="<?php echo esc_attr( $term->name ); ?>" <?php selected( $term->name, $taxonomy ) ?>>
							<?php echo esc_html__($term->label); ?></option>
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_name( 'number_of_taxonomy' )); ?>"><?php _e( 'Number of taxonomy:', 'tf-real-estate' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number_of_taxonomy' )); ?>"
					name="<?php echo esc_attr($this->get_field_name( 'number_of_taxonomy' )); ?>" type="text"
					value="<?php echo esc_attr( $number_of_taxonomy ); ?>" />
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
			$instance                       = array();
			$instance['title']              = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['taxonomy']           = ( ! empty( $new_instance['taxonomy'] ) ) ? strip_tags( $new_instance['taxonomy'] ) : '';
			$instance['number_of_taxonomy'] = ( ! empty( $new_instance['number_of_taxonomy'] ) ) ? strip_tags( $new_instance['number_of_taxonomy'] ) : '';
			return $instance;
		}
	}
}