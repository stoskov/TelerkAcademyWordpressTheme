<div>	

	<h3 class="info-box-header">
		<?php echo __( 'Categories:', 'telerikacademy' ) ?>
	</h3>
	
	<div class="info-box-text">
		<p>			
			<?php 								
				$categories_list = get_the_category( $post_id );									
				if ( ! empty( $categories_list ) ) {
					foreach ( $categories_list as $category ) {
						$categories_ouput[] =
							'<a class = "info-box-link" ' .
							'href = "' . get_category_link( $category->term_id ) . '" ' .
							'title = "' . $category->name . '" >' .
							$category-> name .
							' (' . $category->count . ')' .
							'</a>';				
					}					
					echo join( ' | ', $categories_ouput );
				} else {									
					echo  __( 'Uncategorized', 'telerikacademy' );									
				}											
			?>				
		</p>							
	</div>		
				
</div>	