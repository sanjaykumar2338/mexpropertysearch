<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package dreamhome
 */
?>

<?php  
	$sidebar = themesflat_get_opt( 'blog_sidebar_list' );
	if ( is_page() ) {			
		$sidebar = themesflat_get_opt( 'page_sidebar_list' );			
	}	
	if ( is_search() ) {			
		$sidebar = themesflat_get_opt( 'blog_sidebar_list' );			
	}
	
 	?>
	<div id="secondary" class="widget-area" role="complementary">
		<div class="sidebar">
		<?php	  
	        themesflat_dynamic_sidebar ( $sidebar ); 
		?>
		</div>
	</div><!-- #secondary -->
	<?php
?>