<?php 
	get_header(); 
	the_post();
?>
	<!-- Content wrap >> -->
	<div id="content-wrap" class="site-wrap clear">
	
		<!-- Content >> -->
		<div id="content" class="content-no-sidebar">	
		
			<!-- Article Content >> -->
			<div class="content-box-one-row clear">	
				<div>	
					<?php get_template_part( 'post-content' )?>											
				</div>
			</div>
			<!-- Article Content << -->
			
			<!-- Categories >> -->
			<div class="content-box-one-row">	
				<?php get_template_part( 'categories-list' ) ?>
			</div>
			<!-- Categories << -->
			
			<!-- Tags >> -->
			<div class="content-box-one-row">
				<?php get_template_part( 'tags-list' ) ?>
			</div>			
			<!-- Tags << -->
			
			<!-- Comments >> -->
			<div class="content-box-one-row">
				<?php get_template_part( 'comments-section' ) ?>
			</div>	
			<!-- Comments << -->
			
		</div>
		<!-- Content << -->
		
	</div>
	<!-- Content wrap << -->
	
<?php get_footer() ?>
