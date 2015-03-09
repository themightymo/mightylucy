<?php
/**
 * @package tmm_edit_title
 * @version 0.0.1
 */
/*
Plugin Name: TMM Edit Title
Description: Makes single post and page titles editable in place for logged in administrators.
Author: Erik Mattheis and Toby Cryns
Version: 0.0.1
Author URI: @erikmattheis @tobycryns
*/

/* Add script to document head */

function tmm_edit_title_scripts() {
	
	if ( !is_admin() ) {
		wp_enqueue_script( 'tmm-edit-title-script', plugin_dir_url( __FILE__ ) . '/js/script.js', array('jquery'), '20140101', false );
	}
}

add_action( 'wp_enqueue_scripts', 'tmm_edit_title_scripts' );

/* Define responses to requests to admin-ajax.php
wp_ajax_tmm_save_title is triggered on a request like
admin-ajax.php?action=tmm_save_title */

add_action('wp_ajax_tmm_save_title', 'tmm_save_title');

function tmm_save_title() {
	global $wpdb;
	$wpdb->update($wpdb->posts,
		array('post_title' => $_REQUEST['title']),
		array('ID' => $_REQUEST['ID']));
	wp_die();

}

function tmm_add_form( $title ) {

	if ( in_the_loop() &&  is_user_logged_in() && is_single()) {
		$form = '<form style="display:none" class="title-editor" id="title-editor-' . get_the_ID() . '">'
			. '<input id="title-value" name="title-value" style="border:1px solid red;" onblur="saveTitle(this.form)" value="' . $title . '">'
			. '<input type="hidden" name="ID" value="' . get_the_ID() . '">'
			. '</form>';
	    return '<a onclick="showForm(' . get_the_ID() . ')" class="entry-title-text" id="entry-title-text-' . get_the_ID() . '">' . $title . '</a>' . $form;
	}
	else {
		return $title;
	}
}

add_filter( 'the_title', 'tmm_add_form', 10, 2 );