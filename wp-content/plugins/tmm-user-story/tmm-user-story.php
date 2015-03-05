<?php
/*
Plugin Name: TheMightyMo User Stories
Plugin URI: http://www.themightymo.com
Description: This is a plugin that works with user stories for MightyLucy project management.
Version: 1.0
Author: Sherwin Calimpong - TheMightyMo
Author URI: http://www.themightymo.com

------------------------------------------------------------
Copyright 2015

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
*/



/**
 * CPT_UserStories class.
 */
class CPT_UserStories {

	public function __construct() {
		add_action( 'init', array($this, 'register_cpt_user_stories') );
		add_action( 'init', array($this, 'register_user_story_field_group') );
	}

	function register_cpt_user_stories() {
		register_post_type( "user_stories", array (
				'labels' =>
				array (
					'name' => 'User Stories',
					'singular_name' => 'User Story',
					'add_new' => 'Add New',
					'add_new_item' => 'Add New User Story',
					'edit_item' => 'Edit User Story',
					'new_item' => 'New User Story',
					'view_item' => 'View User Story',
					'search_items' => 'Search User Stories',
					'not_found' => 'No User Stories found',
					'not_found_in_trash' => 'No User Stories found in Trash',
					'parent_item_colon' => 'Parent Entry:',
				),
				'description' => '',
				'publicly_queryable' => true,
				'exclude_from_search' => false,
				'map_meta_cap' => true,
				'capability_type' => 'post',
				'public' => true,
				'hierarchical' => false,
				'rewrite' =>
				array (
					'slug' => 'user_stories',
					'with_front' => true,
					'pages' => true,
					'feeds' => true,
				),
				'has_archive' => true,
				'query_var' => 'user_stories',
				'supports' =>
				array (
					0 => 'title',
					1 => 'editor',
					2 => 'author',
					3 => 'comments',
				),
				'taxonomies' =>
				array (
					0 => 'category',
				),
				'show_ui' => true,
				'menu_position' => 30,
				'menu_icon' => false,
				'can_export' => true,
				'show_in_nav_menus' => true,
				'show_in_menu' => true,
			) );
	}

	public function register_user_story_field_group() {
		if (function_exists("register_field_group")) {
			register_field_group(array (
					'id' => 'acf_user-stories',
					'title' => 'User Stories',
					'fields' => array (
						array (
							'key' => 'field_535d4aa93a078',
							'label' => 'Assigned To',
							'name' => 'assigned_to',
							'default_value' => 4,
							'required' => 1,
							'type' => 'user',
							'role' => array (
								0 => 'all',
							),
							'field_type' => 'select',
							'allow_null' => 0,
						),
						array (
							'key' => 'field_535f1df9145d8',
							'label' => 'How much time will this to-do require?',
							'name' => 'how_many_hours_will_this_to-do_require',
							'type' => 'select',
							'required' => 1,
							'choices' => array (
								/*'0-1' => '1',
					'1-2' => '2',
					'2-4' => '4',
					'4-8' => '8',
					'8-16' => '16',
					'16-32' => '32',
					'32-48' => '48',*/
								'Not Estimated' => 'Not Estimated',
								'1' => '0-1 hours',
								'2' => '1-2 hours',
								'4' => 'half day',
								'8' => '1 day',
								'16' => '2 days',
								'32' => '3-4 days',
								'40' => '1 week',
								'80' => '1-2 weeks',
							),
							'default_value' => 0,
							'allow_null' => 0,
							'multiple' => 0,
						),
						array (
							'key' => 'field_53549b3392875',
							'label' => 'Website URL',
							'name' => 'website_url',
							'type' => 'text',
							'required' => 0,
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'formatting' => 'none',
							'maxlength' => '',
						),
						array (
							'key' => 'field_53549b52fa767',
							'label' => 'File Upload',
							'name' => 'file_upload',
							'type' => 'file',
							'save_format' => 'object',
							'library' => 'all',
						),
						array (
							'key' => 'field_53549b9ed3f31',
							'label' => 'User Story Categories',
							'name' => 'user_story_categories',
							'type' => 'taxonomy',
							'taxonomy' => 'user_story_categories',
							'field_type' => 'checkbox',
							'allow_null' => 0,
							'load_save_terms' => 1,
							'return_format' => 'id',
							'multiple' => 0,
						),
						array (
							'key' => 'field_5353gb9ed23d1',
							'label' => 'Done yet?',
							'name' => 'user_story_done_or_not',
							'type' => 'taxonomy',
							'taxonomy' => 'user_story_done_or_not',
							'field_type' => 'radio',
							'allow_null' => 0,
							'load_save_terms' => 1,
							'return_format' => 'id',
							'multiple' => 0,
						),
						array (
							'key' => 'field_5354ab724d9f4',
							'label' => 'LowRize URL',
							'name' => 'lowrize_url',
							'type' => 'text',
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'formatting' => 'html',
							'maxlength' => '',
						),
					),
					'location' => array (
						array (
							array (
								'param' => 'post_type',
								'operator' => '==',
								'value' => 'user_stories',
								'order_no' => 0,
								'group_no' => 0,
							),
						),
					),
					'options' => array (
						'position' => 'normal',
						'layout' => 'default',
						'hide_on_screen' => array (
						),
					),
					'menu_order' => 0,
				));
		}
	}


}

new CPT_UserStories();