<div data-href="<?php echo esc_url( tfre_get_permalink( 'advanced_search_page' ) ); ?>" class="search-properties-form no-ajax">
	<?php if ( $status_enable == 'true' && $layout == 'tab' ) : ?>
		<div class="tf-search-status-tab">
			<?php
			$property_status     = tfre_get_categories( 'property-status' );
			$placeholder_keyword = tfre_get_option( 'placeholder_keyword_field', esc_attr__( 'Enter Keyword...', 'tf-real-estate' ) );
			if ( $property_status ) :
				foreach ( $property_status as $key => $status ) : ?>
					<a data-value="<?php echo esc_attr( $status->slug ) ?>" class="btn-status-filter <?php if ( $value_status == $status->slug || $key == 0 )
							 echo esc_attr( "active" ); ?>"><?php echo ( $status->name ) ?></a>
				<?php endforeach;
			endif;
			?>
			<input class="search-field" type='hidden' name="status" value="<?php echo esc_attr( $value_status ); ?>"
				data-default-value="" />
		</div>
	<?php endif; ?>
	<div class="tf-search-form">
		<?php if ( isset( $settings['search_advanced_top'] ) && is_array( $settings['search_advanced_top'] ) && ! empty( $settings['search_advanced_top'] ) ) : ?>
			<div class="tf-search-form-top desktop form-inline">
				<div class="group-input">
					<?php
					$search_fields = tfre_get_option( 'advanced_search_fields', array( 'keyword' => 1, 'property-title' => 1, 'property-address' => 1, 'property-status' => 1, 'property-type' => 1, 'property-label' => 1, 'property-country' => 1, 'province-state' => 1, 'property-neighborhood' => 1, 'property-rooms' => 1, 'property-bathrooms' => 1, 'property-bedrooms' => 1, 'property-garage' => 1, 'property-garage-size' => 1, 'property-price' => 1, 'property-size' => 1, 'property-land-size' => 1, 'property-feature' => 1 ) );
					render_search_fields_widget_elementor( 'search_advanced_top', $settings, true );
					?>
				</div>
				<div class="form-group pull-right">
					<a class="tf-search-more-btn">
						<div class="icon-search-more-white">
							<i class="icon-dreamhome-filter"></i>
						</div>
						<div class="icon-search-more-black" style="display:none">
							<i class="fa fa-times"></i>
						</div>
					</a>
				</div>
				<div class="form-group submit-search-form pull-right">
					<a class="tf-advanced-search-btn">
						<?php esc_html_e( 'Search Now', 'tf-real-estate' ) ?>
						<i class="fa fa-search"></i>
					</a>
				</div>
			</div>
			<div class="tf-search-form-top mobile form-inline">
				<div class="form-group input-group w-100">
					<div class="input-group-prepend">
						<button class="input-group-text tf-search-more-btn" data-toggle="collapse" aria-expanded="false"><i
								class="icon-dreamhome-filter"></i></button>
					</div>
					<input class="form-control search-input search-field" value="" name="keyword" type="text"
						placeholder="<?php echo $placeholder_keyword; ?>">
					<div class="input-group-append">
						<button class="input-group-text tf-advanced-search-btn"><i class="fa fa-search"></i></button>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<?php if ( isset( $settings['search_advanced_bottom'] ) && is_array( $settings['search_advanced_bottom'] ) && ! empty( $settings['search_advanced_bottom'] ) ) : ?>
			<div class="tf-search-form-bottom desktop form-wrap">
				<div class="row"><?php render_search_fields_widget_elementor( 'search_advanced_bottom', $settings ); ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if ( isset( $settings['search_advanced_mobile'] ) && is_array( $settings['search_advanced_mobile'] ) && ! empty( $settings['search_advanced_mobile'] ) ) : ?>
			<div class="tf-search-form-bottom mobile form-wrap">
				<div class="row"><?php render_search_fields_widget_elementor( 'search_advanced_mobile', $settings ); ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>