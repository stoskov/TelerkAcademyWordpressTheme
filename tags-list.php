<div>
	
	<h3 class="info-box-header">
		<?php echo __('Tags:', 'telericacademy') ?>
	</h3>
						
	<div class="info-box-text">	
		<p>		
			<?php 									
				$tag_list = get_the_tags( $post_id );								
				if ( ! empty( $tag_list ) ) {
					foreach ( $tag_list as $tag ) {
						$tags_ouput[] =
							'<a class = "info-box-link" ' .
							'href="' . 	get_tag_link( $tag->term_id ) . '" ' .
							'title = "' . $tag->name . '" >' .
							$tag-> name .
							' (' . $tag->count . ')'.
							'</a>';				
					}	
					echo join(' | ', $tags_ouput);
				} 
				else {									
					echo  __( 'No Tags', 'telerikacademy' );									
				}									
			?>				
		</p>
	</div>
											
</div>