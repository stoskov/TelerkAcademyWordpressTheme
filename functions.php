<?php 
// Add hooks
add_filter( 'excerpt_more', 'excerpt_more_telerikacademy' );
add_filter( 'cancel_comment_reply_link', 'get_cancel_comment_reply_link_telerikacademy', 10, 3 );
add_action( 'admin_init', 'register_and_build_fields' );

/* Include user classes >> */
$locale_file = get_template_directory() . '/class-walker-main-menu-telerikacademy.php';
require_once( $locale_file );
/* Include user classes << */

/* Register menus >> */
register_nav_menu( 'site-navigation', 'Site Navigation' );	
register_nav_menu( 'site-menu', 'Site Menu' );
/* Register menus << */

/* Register  sidebars >> */

// Outher sidebar
$sidebar_args = array(
	'name' => __( 'Sidebar', 'telerikacademy' ),
	'id'  => 'sidebar',
	'class' => '',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<div class="aside-section-box"><div class="aside-section-box-top">
		</div><div class="aside-section-box-middle"><h4 class="aside-section-header">',
	'after_title' => '</h4></div><div class="aside-section-box-bottom"></div></div>' 
	);	
register_sidebar( $sidebar_args );

//Inner sidebar
$sidebar_inner_args = array(
	'name'  => __( 'Sidebar-inner', 'telerikacademy' ),
	'id' => 'sidebar-inner',
	'class'  => '',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h5 class="info-box-header">',
	'after_title' => '</h5>'
	);
register_sidebar( $sidebar_inner_args );
/* Register  sidebars << */

/* Register stylesheets >> */
wp_register_style( 'style-750px-950px', get_template_directory_uri() . '/css/style-750px-950px.css', 
	array(), false, '(max-width: 950px) and (min-width: 750px)' );
wp_register_style( 'style-less-than-750px', get_template_directory_uri() . '/css/style-less-than-750px.css',
	array(), false, '(max-width: 749px)' );
wp_register_style( 'style-iPhone4', get_template_directory_uri() . '/css/style-iPhone4.css',
	array(), false, 'only screen and (min-device-pixel-ratio : 1.5), 
		only screen and (-webkit-min-device-pixel-ratio : 1.5)' );
/* Register stylesheets << */

/* Theme support >> */

//Post featured images
add_theme_support( 'post-thumbnails' );

//Custom header image
$custome_header_defaults = array(
		'default-image'  => '%s/images/logo.png',
		'random-default' => false,
		'width' => '278',
		'height'  => '68',
		'flex-height' => true,
		'flex-width' => true,
		'default-text-color' => '',
		'header-text' => true,
		'uploads' => true,
		'wp-head-callback' => '',
		'admin-head-callback' => '',
		'admin-preview-callback' => '',
	);
add_theme_support( 'custom-header', $custome_header_defaults );

register_default_headers( array(
	'logo' => array(
		'url' => '%s/images/logo.png',
		'thumbnail_url' => '%s/images/logo.png',
		'description' => __( 'Logo', 'telerikacademy' )
		),
	) 	
);

//Custom background
$costom_background_defaults = array(
	'default-color' => 'e1dfeb',
	'default-image' => '',
	'wp-head-callback' => '_custom_background_cb',
	'admin-head-callback' => '',
	'admin-preview-callback' => ''
	);
add_theme_support( 'custom-background', $costom_background_defaults );

add_theme_support( 'automatic-feed-links' );
/* Theme support << */

/* Functions >> */
function register_and_build_fields() {
	register_setting('plugin_options', 'plugin_options', 'validate_setting');
}
?>
<?php 
/* Overriden WP functions >> */

//Customise the "cancel reply" link in post comments
function get_cancel_comment_reply_link_telerikacademy( $prev_link = '', $link = '', $text = '' ) {
	$style = isset($_GET['replytocom']) ? '' : ' style="display:none;"';	
	return '<a rel="nofollow" id="cancel-comment-reply-link" 
		class="command-button" href="' . $link . '"' . $style . '>' . $text . '</a>';
}

//Customise the comments presentation
function comment_telerikacademy( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

?>
	<li class="comment-item" id="comment-item-<?php comment_ID(); ?>">
		<div class="comment-header clear">
			<div class="comment-avatar">
				<?php 
					echo get_avatar( $comment, 40 ); 
				?>
			</div>
			<div class="comment-author-information">
				<span class="comment-author"> 
					<?php 
						echo get_comment_author_link();
						echo __( ' says:', 'telerikacademy' );	
					?>					
				</span> 
				<span class="comment-posted-date">
					<?php 
						printf( __( '%1$s at %2$s', 'telerikacademy' ), 
							get_comment_date(),  get_comment_time() );
					?>
				</span>
			</div>
			<div class="comment-actions-list">
				<?php 
					if (current_user_can( 'edit_comment', $comment->comment_ID )) {
				?>
						<span class="comment-action comment-edit comments-button command-button"> 
							<?php 
								edit_comment_link( __( 'Edit', 'telerikacademy' ), ' ' );
							?>
						</span>
				<?php 
					}
				?>
				<?php 
					if ( empty($post) ) {
						$post = $comment->comment_post_ID;
					}
					$post = get_post($post);
				?>
				<?php 
					if ( ! (0 == $depth || $args['max_depth'] <= $depth) && 
						"comment" == get_comment_type( $comment ) && comments_open( $post->ID ) ) { 
				?>
					<span class="comment-action comment-reply comments-button command-button"> 			
						<?php 					
							comment_reply_link( array_merge( $args,
								array(
									'reply_text' => __('Reply','telerikacademy'),
									'add_below' => 'comment-content',
									'depth' => $depth,
									'max_depth' => $args['max_depth'] )
									) 
								);					
						?>
					</span>
				<?php 
					}
				?>
			</div>
		</div>
	</li>
	<div class="comment-content" id='comment-content-<?php comment_ID() ?>'>
		<p>
			<?php 
				if ( $comment->comment_approved == '0' ) {
					echo __( 'Your comment is awaiting moderation.', 'telerikacademy' );
				} 
				else {
					comment_text();
				}	 
			?>
		</p>
	</div> 
<?php 
}
?>
<?php 
//Costomise the login form
function wp_login_form_telerikacademy() {
?>
	<form name="login-form" id="login-form" 
		action="<?php  echo esc_url( site_url( 'wp-login.php', 'login_post' ) ) ?>" method="post">
		
		<input type="text" name="log" id="user_login" size="20" tabindex="10"
			placeholder="<?php esc_attr_e( 'User name', 'telerikacademy' )?>"		
		/>
		
		<input type="password" name="pwd" id="user_pass" size="20" tabindex="20" 
			placeholder="<?php esc_attr_e( 'Password', 'telerikacademy' )?>"	
		/>	
		
		<div class="login-form-command-buttons-wrap clear">
		
			<input type="submit" name="wp-submit" id="login-submit" 
				class="command-button" value="<?php echo __( 'Log In', 'telerikacademy' ) ?>" tabindex="100" />
			<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI'] ?>" />
			
			<a href="<?php echo esc_url( wp_lostpassword_url( ) ) ?>" class ="command-button">
				<?php echo  __( 'Lost Pass?', 'telerikacademy' ) ?> 
			</a>
			
			<?php echo get_register_user_link_telerikacademy(""); ?>
		</div>	
	</form>	
<?php 
}
?>
<?php 
//Costomise the post excerpts
function excerpt_more_telerikacademy($more) {
	global $post;
	return ' <a class="article-text-more-link" href="'. 
		get_permalink($post->ID) . 
		'">[more ...]</a> ';
}

//Customise the register new user link
function get_register_user_link_telerikacademy( $link ) {
	if ( ! is_user_logged_in() ) {
		if ( get_option('users_can_register') ) {
			$link =  '<a class ="command-button"' .
				' href="' . site_url( 'wp-login.php?action=register', 'login' ) . '">' . 
				__( 'Register', 'telerikacademy') . '</a>' ;
		}
		else {
			$link = '';
		}
	} 
	else {
		$link =  '<a class ="command-button" href="' . admin_url() . '">' .
			__( 'Site Admin', 'telerikacademy' ) . '</a>' ;
	}
	return $link;
}

//Customise the posts navigation
function paginate_links_telerikacademy( $args = '' ) {
	$defaults = array(
		'base' => '%_%', // http://example.com/all_posts.php%_% : %_% is replaced by format (below)
		'format' => '?page=%#%', // ?page=%#% : %#% is replaced by the page number
		'total' => 1,
		'current' => 0,
		'show_all' => false,
		'prev_next' => true,
		'prev_text' => __( '&laquo; Previous', 'telerikacademy' ),
		'next_text' => __( 'Next &raquo;', 'telerikacademy' ),
		'end_size' => 1,
		'mid_size' => 2,
		'type' => 'plain',
		'add_args' => false, // array of query args to add
		'add_fragment' => ''
	);

	$args = wp_parse_args( $args, $defaults );
	extract($args, EXTR_SKIP);

	// Who knows what else people pass in $args
	$total = (int) $total;
	if ( $total < 2 )
		return;
	$current  = (int) $current;
	$end_size = 0  < (int) $end_size ? (int) $end_size : 1; // Out of bounds?  Make it the default.
	$mid_size = 0 <= (int) $mid_size ? (int) $mid_size : 2;
	$add_args = is_array($add_args) ? $add_args : false;
	$r = '';
	$page_links = array();
	$n = 0;
	$dots = false;

	if ( $prev_next && $current && 1 < $current ) :
		$link = str_replace('%_%', 2 == $current ? '' : $format, $base);
		$link = str_replace('%#%', $current - 1, $link);
		if ( $add_args )
			$link = add_query_arg( $add_args, $link );
		$link .= $add_fragment;
		$page_links[] = '<a class="prev page-numbers command-button" href="' . 
			esc_url( apply_filters( 'paginate_links', $link ) ) . '">' . $prev_text . '</a>';
	endif;
	for ( $n = 1; $n <= $total; $n++ ) :
		$n_display = number_format_i18n($n);
		if ( $n == $current ) :
			$page_links[] = "<span class='page-numbers command-button-current'>$n_display</span>";
			$dots = true;
		else :
			if ( $show_all || ( $n <= $end_size || 
					( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || 
					$n > $total - $end_size ) ) :
				$link = str_replace('%_%', 1 == $n ? '' : $format, $base);
				$link = str_replace('%#%', $n, $link);
				if ( $add_args )
					$link = add_query_arg( $add_args, $link );
				$link .= $add_fragment;
				$page_links[] = "<a class='page-numbers command-button' href='" . 
					esc_url( apply_filters( 'paginate_links', $link ) ) . "'>$n_display</a>";
				$dots = true;
			elseif ( $dots && !$show_all ) :
				$page_links[] = '<span class="page-numbers dots">' . __( '&hellip;', 'telerikacademy' ) . '</span>';
				$dots = false;
			endif;
		endif;
	endfor;
	if ( $prev_next && $current && ( $current < $total || -1 == $total ) ) :
		$link = str_replace('%_%', $format, $base);
		$link = str_replace('%#%', $current + 1, $link);
		if ( $add_args )
			$link = add_query_arg( $add_args, $link );
		$link .= $add_fragment;
		$page_links[] = '<a class="next page-numbers command-button" href="' . 
			esc_url( apply_filters( 'paginate_links', $link ) ) . '">' . $next_text . '</a>';
	endif;
	switch ( $type ) :
		case 'array' :
			return $page_links;
			break;
		case 'list' :
			$r .= "<ul class='page-numbers'>\n\t<li>";
			$r .= join("</li>\n\t<li>", $page_links);
			$r .= "</li>\n</ul>\n";
			break;
		default :
			$r = join("\n", $page_links);
			break;
	endswitch;
	return $r;
}

//Costomise posts pages
function wp_link_pages_telerikacademy($args = '') {
	$defaults = array(
			'before' => '<span class="info-box-header">' . 
				__( 'Pages:', 'telerikacademy' ) . '</span>',
			'after' => '',
			'link_before' => '', 
			'link_after' => '',
			'next_or_number' => 'number', 
			'nextpagelink' => __('Next page'),
			'previouspagelink' => __('Previous page'), 
			'pagelink' => '%',
			'echo' => 1
	);

	$r = wp_parse_args( $args, $defaults );
	$r = apply_filters( 'wp_link_pages_args', $r );
	extract( $r, EXTR_SKIP );

	global $page, $numpages, $multipage, $more, $pagenow;

	$output = '';
	if ( $multipage ) {
		if ( 'number' == $next_or_number ) {
			$output .= $before;
			for ( $i = 1; $i < ($numpages+1); $i = $i + 1 ) {
				$j = str_replace('%',$i,$pagelink);
				$output .= ' ';
				if ( ($i != $page) || ((!$more) && ($page==1)) ) {
					$output .= _wp_link_page_telerikacademy($i);
					$output .= $link_before . $j . $link_after;
					$output .= '</a>';
				}
				else {
					$output .= '<span class="command-button-current">';
					$output .= $link_before . $j . $link_after;
					$output .= '</span>';
				}
			}
			$output .= $after;
		} else {
			if ( $more ) {
				$output .= $before;
				$i = $page - 1;
				if ( $i && $more ) {
					$output .= _wp_link_page($i);
					$output .= $link_before. $previouspagelink . $link_after . '</a>';
				}
				$i = $page + 1;
				if ( $i <= $numpages && $more ) {
					$output .= _wp_link_page($i);
					$output .= $link_before. $nextpagelink . $link_after . '</a>';
				}
				$output .= $after;
			}
		}
	}

	if ( $echo )
		echo $output;

	return $output;
}

function _wp_link_page_telerikacademy( $i ) {
	global $post, $wp_rewrite;

	if ( 1 == $i ) {
		$url = get_permalink();
	} else {
		if ( '' == get_option('permalink_structure') || in_array($post->post_status, array('draft', 'pending')) )
			$url = add_query_arg( 'page', $i, get_permalink() );
		elseif ( 'page' == get_option('show_on_front') && get_option('page_on_front') == $post->ID )
		$url = trailingslashit(get_permalink()) . user_trailingslashit("$wp_rewrite->pagination_base/" . $i, 'single_paged');
		else
			$url = trailingslashit(get_permalink()) . user_trailingslashit($i, 'single_paged');
	}

	return '<a class="command-button" href="' . esc_url( $url ) . '">';
}
/* Overriden WP functions << */

/* User defind functions >> */

function print_the_post_title() {
	$post_title = get_the_title();

	if ( strlen($post_title) == 0 ) {
		$post_title = __( '(No Title)', 'telerikacademy' );
	}

	echo $post_title;
}

function print_post_author_date() {
	echo __( 'posted by ', 'telerikacademy' );
	echo '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" title="The post anthor">';
	echo get_the_author();
	echo '</a>';
	echo __( ' on ', 'telerikacademy' );
	echo get_the_date();
}

function get_sidebars_status() {
	$is_main_sidebar_active = is_active_sidebar( 'sidebar' );
	$is_inner_sidebar_acttive = is_active_sidebar( 'sidebar-inner' );

	$sidebar_status_list = array (
		'is_main_sidebar_active' => $is_main_sidebar_active,
		'is_inner_sidebar_acttive' => $is_inner_sidebar_acttive
	);

	return $sidebar_status_list;
}

function get_content_wrap_classes () {

	$sidebars_status_list = get_sidebars_status();
	$is_main_sidebar_active = $sidebars_status_list['is_main_sidebar_active'];
	$is_inner_sidebar_acttive = $sidebars_status_list['is_inner_sidebar_acttive'];

	if ($is_main_sidebar_active) {
		$content_class = '';
	}
	else {
		$content_class = 'content-no-sidebar';
	}
	
	if ( is_singular() ) {
		$content_wrap_class = 'content-box-one-row';
		$acticle_content_wrap_class = 'article-content-wrap-single';
		$acticle_content_no_image_wrap_class = 'article-content-no-image-wrap-single';
	}	
	elseif ($is_inner_sidebar_acttive && $is_main_sidebar_active) {
		$content_wrap_class = 'content-box-two-rows-table';
		$acticle_content_wrap_class = 'article-content-wrap';
		$acticle_content_no_image_wrap_class = 'article-content-no-image-wrap';
	}
	elseif (!$is_inner_sidebar_acttive && $is_main_sidebar_active) {
		$content_wrap_class = 'content-box-one-row';
		$acticle_content_wrap_class = 'article-content-one-row-wrap';
		$acticle_content_no_image_wrap_class = 'article-content-no-image-one-row-wrap';
	}
	elseif ($is_inner_sidebar_acttive && !$is_main_sidebar_active) {
		$content_wrap_class = 'content-box-two-rows-no-main-sidebar-table';
		$acticle_content_wrap_class = 'article-content-no-main-sidebar-wrap';
		$acticle_content_no_image_wrap_class = 'article-content-no-main-sidebar-no-image-wrap';
	}
	elseif (!$is_inner_sidebar_acttive && !$is_main_sidebar_active ) {
		$content_wrap_class = 'content-box-one-row';
		$acticle_content_wrap_class = 'article-content-full-size-wrap';
		$acticle_content_no_image_wrap_class = 'article-content-no-image-full-size-wrap';
	};
	
	$content_wrap_classes_list = array (
			'content_class' => $content_class,
			'content_wrap_class' => $content_wrap_class,
			'acticle_content_wrap_class' => $acticle_content_wrap_class,
			'acticle_content_no_image_wrap_class' => $acticle_content_no_image_wrap_class,
	);

	return $content_wrap_classes_list;
}

function print_comments_navigation() {
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
		$comments_nav_block = '';
		$comments_nav_block .= '<div class="comments-navigation clear">';
		$comments_nav_block .= 
			get_previous_comments_link( '<span class="comments-nav-prev comments-button command-button">' .
				__( '&lt; Previous', 'telerikacademy' ). '</span>' );
		$comments_nav_block .= 	
			get_next_comments_link('<span class="comments-nav-next comments-button command-button">'.
				__( 'Next &gt;', 'telerikacademy' ) . '</span>');
		$comments_nav_block .= '</div>';
		echo $comments_nav_block;
	}
}

function get_entries_header() {
		
	$entries_header;
	
	if ( is_category() ) {
		$entries_header = __( 'recent entries categorised in ', 'telerikacademy' ) . 
			single_term_title( '', false );
	}
	elseif ( is_404() ) {
		$entries_header = __( 'error 404', 'telerikacademy' );
	}
	elseif ( is_author() ) {
		$author = get_queried_object();
		$author_name = $author->display_name;
		$entries_header = __( 'recent entries posted by ', 'telerikacademy' ) . 
			$author_name;
	}
	elseif ( is_search() ) {
		$entries_header = __( 'search result', 'telerikacademy' );
	}
	elseif ( is_archive() ) {
		$entries_header = __( 'archives', 'telerikacademy' );
	}
	elseif ( is_tag() ) {
		$entries_header = __( 'recent entries taged in ', 'telerikacademy' )  . 
			single_term_title( '', false );
	}
	else {
		$entries_header = __( 'recent entries', 'telerikacademy' );
	}
	
	return $entries_header;

}
/* User defind functions << */

/* Functions << */
?>