<?php 
	get_header();
	
	$sidebars_status_list = get_sidebars_status();
	$is_main_sidebar_active = $sidebars_status_list['is_main_sidebar_active'];
	$is_inner_sidebar_acttive = $sidebars_status_list['is_inner_sidebar_acttive'];
	
	$content_wrap_classes_list = get_content_wrap_classes();
	$content_class = $content_wrap_classes_list['content_class'];
	$content_wrap_class = $content_wrap_classes_list['content_wrap_class'];
?>

<!-- Content wrap >> -->
<div id="content-wrap" class="site-wrap clear">

	<!-- Content >> -->
	<div id="content" class="<?php echo $content_class ?>">

		<div class="<?php echo  $content_wrap_class ?> clear">

			<div>

				<h5 class="info-box-header bullet-dots">
					
					<?php 						
						echo get_entries_header();
					?> 
					
				</h5>
				
				<?php get_template_part( 'posts-navigation' ) ?>
				
				<!-- Articles list >> -->
				<?php get_template_part( 'posts-loop' ) ?>
				<!-- Articles list << -->
				
				<?php get_template_part( 'posts-navigation' ) ?>

			</div>

			<?php 
				if ($is_inner_sidebar_acttive) {				
			?>
					<div id="side-bar-inner">
						<?php dynamic_sidebar( 'sidebar-inner' )?>
					</div>
			<?php 
				}
			?>

		</div>		
	</div>
	<!-- Content << -->

	<!-- Side bar >> -->
	<?php 
		if ( $is_main_sidebar_active ) {
			get_sidebar();
		}
	?>
	<!-- Side bar << -->

</div>
<!-- Content wrap << -->
<?php get_footer() ?>