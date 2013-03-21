<div id="comments-wrap">

	<?php 
		if ( post_password_required() ) { 
	?>
			<p class="comments-nopassword">
				<?php  
					echo __( 'This post is password protected. Enter the password to view any comments.', 
						'telerikacademy' ); 
				?>
			</p>		
	<?php
			echo '</div>';
			return;
		}
	?>

	<?php 
		if ( have_comments() ) {
	?>
			<h3 class="comments-title">
				<?php
					printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'telerikacademy' ),
					number_format_i18n( get_comments_number() ),  get_the_title() );
				?>
			</h3>
	
			<?php print_comments_navigation() ?>
	
			<ul class="comments-list">
				<?php wp_list_comments( array( 'callback' => 'comment_telerikacademy' ) );	?>
			</ul>
	
			<?php print_comments_navigation() ?>

	<?php 
		}
		else {
			if ( ! comments_open() ) {
	?>
				<p class="comments-nocomments">
					<?php _e( 'Comments are closed.', 'telerikacademy' ); ?>
				</p>
	<?php 
			}  // end ! comments_open() 

		} // end have_comments() 		
		
		$required_fields = get_option( 'require_name_email' );
		
		if ( $required_fields ) {
			$required_fields_atribute = ' required="required" ';
			$required_fields_html = '<span class="required">*</span>';
			$aria_req_atribute = ' aria-required="true"';
		}
		else {
			$required_fields_atribute = "";
			$required_fields_html = "";
			$aria_req_atribute = "";
		}
		
		$author_field_html = 
			'<input id="author" name="author" type="text" class="comment-user-field" value="" ' .
				$required_fields_atribute . ' ' . $aria_req_atribute . 
				'placeholder="' . esc_attr( 'Name', 'telerikacademy' ) . '" />';
		
		$email_field_html = 
			'<input id="email" name="email" type="text"  class="comment-user-field" value="" ' .
				$required_fields_atribute . ' ' . $aria_req_atribute . 
				'placeholder="' . esc_attr( 'E-mail', 'telerikacademy' ) . '" />'; 
				
		$fields_list =  array(
			'author' => $author_field_html,			
			'email'  => $email_field_html
		);
		
		$comment_field_html = 
			'<div id="comment-form-text-area-wrap">' .
				'<label for="comment" class="info-box-header">' . 
					_x( 'Comment', 'noun', 'telerikacademy' ) . 
				'</label>' .
				'<textarea id="comment-text-area" name="comment" cols="45" rows="8" aria-required="true"' .
					'placeholder="' . __( "Comment text", "telerikacademy" ) . '">' .
				'</textarea>' .
			'</div>';
		
		$comments_args = array(
	        "title_reply" => __( "Write a comment", "telerikacademy" ),
			"title_reply_to" => __( "Write a comment", "telerikacademy" ),
			"cancel_reply_link" => __( "Cancel", "telerikacademy" ),
			"id_submit"	=> "submit-comment",
			"comment_notes_before" => "",
			"comment_field" => $comment_field_html,
			"fields" => $fields_list,
			"id_form" => "comment-form",
		);		
		comment_form($comments_args);
	?>
</div>
