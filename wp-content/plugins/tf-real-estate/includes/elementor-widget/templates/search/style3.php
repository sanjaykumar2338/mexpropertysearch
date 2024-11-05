<div class="all-button">
	<div class="button-search search-more-btn pull-right">
		<a class="tf-search-properties-sidebar-btn">
			<div class="icon-search-more-white">
				<?php esc_html_e( 'Filters', 'tf-real-estate' ) ?>
				<i class="icon-dreamhome-filter"></i>
			</div>
			<div class="icon-search-more-black" style="display:none">
				<?php esc_html_e( 'Filters', 'tf-real-estate' ) ?>
				<i class="fa fa-times"></i>
			</div>
		</a>
	</div>
</div>
<div class="search-properties-sidebar-wrapper">
	<div data-href="<?php echo esc_url( tfre_get_permalink( 'advanced_search_page' ) ); ?>"
		class="search-properties-form no-ajax">
		<?php if ( $status_enable == 'true' && $layout == 'tab' ) : ?>
			<div class="tf-search-status-tab">
				<?php
				$property_status     = tfre_get_categories( 'property-status' );
				$placeholder_keyword = tfre_get_option( 'placeholder_keyword_field', esc_attr__( 'Enter Keyword...', 'tf-real-estate' ) );
				if ( $property_status ) :
					foreach ( $property_status as $key => $status ) : ?>
						<a data-value="<?php echo esc_attr( $status->slug ) ?>" class="btn-status-filter <?php if ( $value_status == $status->slug || $key == 0 ) echo esc_attr( "active", 'tf-real-estate' ); ?>"><?php echo esc_html( $status->name ) ?></a>
					<?php endforeach;
				endif;
				?>
				<input class="search-field" type='hidden' name="status" value="<?php echo esc_attr( $value_status ); ?>"
					data-default-value="" />
			</div>
		<?php endif; ?>
		<div class="tf-search-form">
			<?php if ( isset( $settings['search_advanced_top'] ) && is_array( $settings['search_advanced_top'] ) && ! empty( $settings['search_advanced_top'] ) ) : ?>
				<div class="tf-search-form-top desktop">
					<?php
					$search_fields = tfre_get_option( 'advanced_search_fields', array( 'keyword' => 1, 'property-title' => 1, 'property-address' => 1, 'property-status' => 1, 'property-type' => 1, 'property-label' => 1, 'property-country' => 1, 'province-state' => 1, 'property-neighborhood' => 1, 'property-rooms' => 1, 'property-bathrooms' => 1, 'property-bedrooms' => 1, 'property-garage' => 1, 'property-garage-size' => 1, 'property-price' => 1, 'property-size' => 1, 'property-land-size' => 1, 'property-feature' => 1 ) );
					render_search_fields_widget_elementor( 'search_advanced_top', $settings, true );
					?>
					<?php if ( isset( $settings['search_advanced_bottom'] ) && is_array( $settings['search_advanced_bottom'] ) && ! empty( $settings['search_advanced_bottom'] ) ) : ?>
						<div class="tf-search-form-bottom desktop form-wrap">
							<div class="row-search-form-bottom">
								<?php render_search_fields_widget_elementor( 'search_advanced_bottom', $settings, true ); ?>
							</div>
						</div>
					<?php endif; ?>
					<div class="all-button">
						<div class="button-search submit-search-form pull-right">
							<a class="tf-advanced-search-btn">
								<?php esc_html_e( 'Search Now', 'tf-real-estate' ) ?>
								<i class="fa fa-search"></i>
							</a>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="close-search-properties-sidebar"><i class="fa fa-times"></i></div>
</div>
<div class="overlay-search-properties-sidebar"></div>