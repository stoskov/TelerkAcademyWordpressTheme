<?php 
	if ( is_sticky( $post->ID ) ) {
		$sticky_post_class = "sticky-post";		
	}
	else {
		$sticky_post_class = "";
	}
?>
<article <?php post_class( $sticky_post_class . ' article clear' ); ?>>

	<span class="info-box-header sticky-post-title">
		<?php echo __( 'sticky post', 'telerikacademy' ); ?>
	</span>

	<?php 
		if ( is_singular() ) {
	?>
		<h2 class="article-header-single">
			<?php print_the_post_title(); ?>
		</h2>
	<?php 
		}
		else {
	?>	
		<h2 class="article-header">
			<a href="<?php the_permalink()?>">
				<?php print_the_post_title(); ?>
			</a>
		</h2>
	<?php 
		}
	?>	
	<?php 	
		$content_wrap_classes_list = get_content_wrap_classes();
		$acticle_content_wrap_class = $content_wrap_classes_list['acticle_content_wrap_class'];
		$acticle_content_no_image_wrap_class = $content_wrap_classes_list['acticle_content_no_image_wrap_class'];
	
		if ( has_post_thumbnail() ) {
			$image = simplexml_load_string( get_the_post_thumbnail() );
			$image_src = $image->attributes()->src;
			$image_alt = $image->attributes()->alt;
			$image_title = $image->attributes()->title;
			$article_content_wrap_class = $acticle_content_wrap_class . ' clear';
	?>								
			<img src="<?php echo $image_src ?>" width="127" height="127"
				alt="<?php echo $image_alt ?>" title="<?php echo $image_title ?>"
				class="article-picture" />
	<?php 
		} 
		else {
			$article_content_wrap_class = $acticle_content_no_image_wrap_class . ' clear';
		}
	?>
	
	<div class="<?php echo $article_content_wrap_class; ?>">
	
		<?php 
			if ( ! is_page() ) {
		?>
			<p class="article-posted-date">
				<?php print_post_author_date() ?>
			</p>
		<?php 
			}
		?>
		<?php 
			if ( is_singular() ) {
		?>
				<div class="article-text-single">
					<?php the_content(); ?>
				</div>				
				
				<?php
					global $multipage;
					if ( $multipage ) { 
				?>
					<!-- Pages navigation >> -->
					<div class="posts-pages clear">						
						<?php 
							wp_link_pages_telerikacademy();
						?>
					</div>
					<!-- Pages navigation << -->
				<?php 
					}
				?>
		<?php 
			}
			else {
		?>
				<div class="article-text">
					<?php the_excerpt();?>
				</div>
		<?php 
			}
		?>	
	</div>
</article>	