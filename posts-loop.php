<?php 
	if (have_posts()) {
		while(have_posts()) {
			the_post(); 
			get_template_part( 'post-content' );				
		}
	}
	else {
?>
		<div class="article-text">
			<p>
				<?php 
					echo __( 'Sorry, no entries have been found', 'telerikacademy' );
				?>
			</p>
		</div>
<?php 
	}											
?>