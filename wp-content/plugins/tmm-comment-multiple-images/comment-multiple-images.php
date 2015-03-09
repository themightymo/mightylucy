<?php

/*
Plugin Name: Comment Multiple Images by The Mighty Mo! Design Co.
Plugin URI: http://www.themightymo.com
Description: Send comment notifications to specific users for EVERY comment that is posted on a site or sub-site. Uses Advanced Custom Fields. Multi-site ready!
Author: TheMightyMo!
Author URI: http://www.themightymo.com
Version: 0.2
Text Domain: comment-multiple-images
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
Initially Created By: Luis Rosas
*/




add_action( 'comment_form_logged_in_after', 'tmm_comment_multiple_images_additional_fields' );
add_action( 'comment_form_after_fields', 'tmm_comment_multiple_images_additional_fields' );

function tmm_comment_multiple_images_additional_fields () {
	
	echo '<input type="file" name="tmm_multiple_upload[]" id="tmm_multiple_upload[]" multiple="multiple">';
}


add_action('comment_post', 'tmm_comment_multiple_images_handle_attachments', 10, 2);
function tmm_comment_multiple_images_handle_attachments($comment_id, $approved){
	if ($approved) {
		if ( $_FILES ) { 
			$files = $_FILES["tmm_multiple_upload"];  
			$attachments = array();
			foreach ($files['name'] as $key => $value) { 			
				if ($files['name'][$key]) { 
					$file = array( 
						'name' => $files['name'][$key],
						'type' => $files['type'][$key], 
						'tmp_name' => $files['tmp_name'][$key], 
						'error' => $files['error'][$key],
						'size' => $files['size'][$key]
					); 
					$_FILES = array ("tmm_multiple_upload" => $file); 
					foreach ($_FILES as $file => $array) {				
						$newupload = tmm_update_post_attachment($file,$comment_id); 
						if ($newupload) {
							$attachments[] = $newupload;	
						}
					}
				} 
			} 
			
			if ( count($attachments) > 0 ) {
				tmm_add_update_post_meta($comment_id, $attachments);
			}
		}
	}
	
}
function tmm_update_post_attachment($file_handler,$comment_id,$set_thu=false) {
	// check to make sure its a successful upload
	if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();
	
	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	require_once(ABSPATH . "wp-admin" . '/includes/media.php');
	
	$attach_id = media_handle_upload( $file_handler, $comment_id );
	if ( is_numeric( $attach_id ) ) {
		
		return $attach_id;
	}else{
		return false;
	}
}

function tmm_add_update_post_meta($comment_id, $attachments){
	add_comment_meta( $comment_id, '_tmm_multiple_upload', $attachments, true ) || update_comment_meta( $comment_id, '_tmm_multiple_upload', $attachments );
}

add_filter( 'comment_text', 'tmm_comment_multiple_images_show_attached_images', 10, 2);
function tmm_comment_multiple_images_show_attached_images($text, $comment){
	$images = get_comment_meta( $comment->comment_ID, '_tmm_multiple_upload', true );
	$arrayImages = array();
	foreach($images as $index => $value ) {
		
		$arrayImages[] =  wp_get_attachment_link( $value, 'thumbnail' ) ;
	}
	
	return implode(' <br /><br /> ', $arrayImages) . ' <br /> ' . $text;
}

function tmm_comment_multiple_images_scripts() {
	wp_enqueue_script(
		'newscript',
		plugins_url( '/js/tmm_comment_multiple_images.js' , __FILE__ ),
		array( 'jquery' )
	);
	
}

add_action( 'wp_enqueue_scripts', 'tmm_comment_multiple_images_scripts' );