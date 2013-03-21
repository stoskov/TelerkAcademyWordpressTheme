<!DOCTYPE html>
<html <?php language_attributes( $doctype ) ?>>
<head>
	<title><?php wp_title() ?></title>
	<meta charset=<?php bloginfo( 'charset' ) ?> />
	<meta name="description"
		content="Svetozar Toskov's final project in Telerik Academy HTML5&amp;CSS3 Course" />
	<meta name="keywords"
		content="Toskov, Svetozar Toskov, Telerik, Telerik Academy, HTML5, CSS3, Course, Web design, Final Project, Wordpress" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo("stylesheet_url"); ?>" />
	<?php 	
		wp_enqueue_style( "style-750px-950px" );
		wp_enqueue_style( "style-less-than-750px" );
		wp_enqueue_style( "style-iPhone4" );
		
		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
	 	wp_head(); 
 	?>
</head>
<body <?php body_class(); ?> >

	<!-- Header >> -->
	<header>
		
		<div id="site-admin-wrap" class="site-wrap clear">
			<div id="site-admin-seach-form-wrap" >
				<?php get_search_form() ?>
			</div>
			<div id="site-admin-login-wrap">			
				<?php					
					if ( ! is_user_logged_in() ) {
						wp_login_form_telerikacademy();					 	
					}
					else {		
						echo get_register_user_link_telerikacademy('');				
						echo'<a href="' . esc_url( wp_logout_url( $_SERVER['REQUEST_URI'] ) ) . 
						'" class ="command-button">' . __( 'Log out', 'telerikacademy' ) . '</a>';						
					} 					
				?>
			</div>
		
		</div>
		
		<!-- Site navigation >> -->
		<?php 				
			wp_nav_menu( array (
				'theme_location' => 'site-navigation',
				'container' => 'nav',
				'container_class' => 'site-wrap',
				'container_id' => 'site-nav',
				'items_wrap' => '<ul class="clear">%3$s</ul>',
				
				)
			)
		?>
		<!-- Site navigation <<	-->

		<!-- Site head >> -->
		<div id="site-head">

			<!-- Main menu >> -->
			<?php
				$walker_main_menu_telerikacademy = new Walker_Main_Menu_Telerikacademy();
				wp_nav_menu( array (
					'theme_location' => 'site-menu',
					'container' => 'nav',
					'container_class' => 'site-wrap',
					'container_id' => 'main-menu',
					'items_wrap' => '<ul class="clear">%3$s</ul>',
					'walker' => $walker_main_menu_telerikacademy,
					)
				)
			?>
			<!-- Main menu << -->

			<?php	
				if ( function_exists( 'get_custom_header' ) ) {
					$header_image_width = get_theme_support( 'custom-header', 'width' );
				} 
				else {
					$header_image_width = HEADER_IMAGE_WIDTH;
				}
	
				if ( get_header_image() ) {
					if ( function_exists( 'get_custom_header' ) ) {
						$header_image_width  = get_custom_header()->width;
						$header_image_height = get_custom_header()->height;
					} 
					else {
						$header_image_width  = HEADER_IMAGE_WIDTH;
						$header_image_height = HEADER_IMAGE_HEIGHT;
					}
			?>

				<!-- Company logo section >> -->
				<div id="logo-wrap" class="site-wrap clear">
					<img alt="" id="logo-handler" title="" width="<?php echo $header_image_width; ?>"
						height="<?php echo $header_image_height; ?>" src="<?php  header_image(); ?>" />
				</div>
				<!-- Company logo section << -->
			<?php 
				} 
			?>

		</div>
		<!-- Site head << -->
		
	</header>
	<!-- Header << -->