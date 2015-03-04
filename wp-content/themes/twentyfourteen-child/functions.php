<?php
if(function_exists("register_field_group"))
{
	
	/*add WYISWYG on Client Dashboard as Notes*/
	register_field_group(array (
		'id' => 'acf_notes',
		'title' => 'Notes',
		'fields' => array (
			array (
				'key' => 'field_542acea3e8a30',
				'label' => 'Notes',
				'name' => 'notes',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	
	/*End--- add WYISWYG on Client Dashboard as Notes*/
	
	register_field_group(array (
		'id' => 'acf_change-request',
		'title' => 'Change Request',
		'fields' => array (
			array (
				'key' => 'field_534858f1e1c98',
				'label' => 'Page View Taxonomy',
				'name' => 'page_view_taxonomy',
				'type' => 'taxonomy',
				'taxonomy' => 'page_views',
				'field_type' => 'radio',
				'allow_null' => 0,
				'load_save_terms' => 1,
				'return_format' => 'object',
				'multiple' => 0,
			),
			array (
				'key' => 'field_53485c8ef1a43',
				'label' => 'PDF File Upload',
				'name' => 'pdf_file_upload',
				'type' => 'file',
				'required' => 1,
				'save_format' => 'object',
				'library' => 'all',
			),
			array (
				'key' => 'field_534862327b956',
				'label' => 'PNG File Upload',
				'name' => 'png_file_upload',
				'type' => 'file',
				'required' => 1,
				'save_format' => 'object',
				'library' => 'all',
			),
			array (
				'key' => 'field_534862427b95a',
				'label' => 'PSD File Upload',
				'name' => 'psd_file_upload',
				'type' => 'file',
				'required' => 1,
				'save_format' => 'object',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'view',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_client-details-options-page',
		'title' => 'Client Details (Options Page)',
		'fields' => array (
			array (
				'key' => 'field_53548976a75ae',
				'label' => 'Pre-paid Hours',
				'name' => 'prepaid_hours',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_535489dc736d4',
						'label' => 'Date of Purchase',
						'name' => 'date_of_purchase',
						'type' => 'date_picker',
						'column_width' => '',
						'date_format' => 'yymmdd',
						'display_format' => 'mm/dd/yy',
						'first_day' => 1,
					),
					array (
						'key' => 'field_535489ed736d5',
						'label' => 'Number of Hours Purchased',
						'name' => 'number_of_hours_purchased',
						'type' => 'number',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array (
						'key' => 'field_53212b4614709',
						'label' => 'Hours Description',
						'name' => 'hours_description',
						'type' => 'text',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	/**for Email notifications page**/
	register_field_group(array (
		'id' => 'acf_list-of-emails-to-receive-comment-notifications',
		'title' => 'List of Emails To Receive Comment Notifications',
		'fields' => array (
			array (
				'key' => 'field_535ab35d2fc06',
				'label' => 'Emails To Be Notified',
				'name' => 'emails_to_be_notified',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_535ab3932fc07',
						'label' => 'Email Address',
						'name' => 'email_address',
						'type' => 'email',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => -1,
	));
	
	
	register_field_group(array (
		'id' => 'acf_hourly-support-feature-requestbug-notification',
		'title' => 'Hourly Support: Feature Request/Bug Notification',
		'fields' => array (
			array (
				'key' => 'field_53548a4614709',
				'label' => 'Website URL',
				'name' => 'website_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53548ac41470a',
				'label' => 'Long Description',
				'name' => 'long_description',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_time-entries',
		'title' => 'Time Entries',
		'fields' => array (
			array (
				'key' => 'field_53548c4ef8774',
				'label' => 'Hours Invested',
				'name' => 'hours_invested',
				'type' => 'number',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => 120,
				'step' => '',
			),
			array (
				'key' => 'field_5335d9dc72314',
				'label' => 'Date Worked',
				'name' => 'date_worked',
				'type' => 'date_picker',
				'column_width' => '',
				'date_format' => 'yymmdd',
				'default_value' => date('Ymd'),
				'display_format' => 'mm/dd/yy',
				'first_day' => 1,
				'required' => 1,
			),
			array (
				'key' => 'field_53d96941d7228',
				'label' => 'Time Entry Categories',
				'name' => 'time_entry_categories',
				'type' => 'taxonomy',
				'required' => 1,
				'taxonomy' => 'time_entry_categories',
				'field_type' => 'select',
				'allow_null' => 0,
				'load_save_terms' => 1,
				'return_format' => 'id',
				'multiple' => 0,
			),
			array (
				'key' => 'field_53549855f0f97',
				'label' => 'Related User Stories',
				'name' => 'related_user_stories',
				'type' => 'relationship',
				'return_format' => 'object',
				'post_type' => array (
					0 => 'user_story',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'post_type',
					1 => 'post_title',
				),
				'max' => '1',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'time_entry',
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
					'value' => 'user_story',
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

if( function_exists('acf_set_options_page_title') ) {
	acf_set_options_page_menu( __('Sitewide Content') );
    acf_set_options_page_title( __('Sitewide Content') );
}

add_filter( 'sitewide_tags_custom_taxonomies', 'my_swt_custom_tax_filter' );
function my_swt_custom_tax_filter( $taxonomies ) {
	$taxonomies[] = 'page_view_taxonomy';
	$taxonomies[] = 'page_views';
	$taxonomies[] = 'user_story_categories';
	$taxonomies[] = 'time_entry_categories';
	$taxonomies[] = 'user_story_done_or_not';
	return array_unique( $taxonomies );
}

function my_swt_post_type_filter( $auction ) {
	$auction['view'] = true;
	$auction['time_entry'] = true;
	$auction['user_story'] = true;
	$auction['time_entry'] = true;
	return $auction;
}
add_filter( 'sitewide_tags_allowed_post_types', 'my_swt_post_type_filter' );


//zero menu order is taken cared before here
function my_save_item_order() {
    global $wpdb;
    
    $orders = explode(',', $_POST['order']); //blogidxpostidxmenu_order '4x2x1'
	$arr_menu_order=array();
	foreach ($orders as $order) {
	    $item=explode('x',$order);
		array_push($arr_menu_order,$item[2]);
	}
	arsort($arr_menu_order);
	//1x178x3
    foreach ($orders as $items) {
	    $itemx=explode('x',$items);
		if($itemx[0]==1){
			$successx=$wpdb->update('wp_posts', array( 'menu_order' => array_pop($arr_menu_order)), array( 'ID' => $itemx[1]) );
		}else{
			$successx=$wpdb->update('wp_'.$itemx[0].'_posts', array( 'menu_order' => array_pop($arr_menu_order)), array( 'ID' => $itemx[1]) );
		}
    }
     die(1); 
}


add_action('wp_ajax_item_sort', 'my_save_item_order');
add_action('item_sort', 'my_save_item_order');
add_action('wp_ajax_nopriv_item_sort', 'my_save_item_order');



function save_user_story_network_order() {
    global $wpdb;
    $order = explode(',', $_POST['order']); //blogidxpostidxmenu_order '4x2x1'
	
    $counter = 1;
	
    foreach ($order as $item_id) {
	    $ids=explode('x',$item_id);
		if($ids[0]==1){
			$wpdb->update('wp_posts',array('menu_order' => $counter), array( 'ID' => $ids[1] ));
		}else{
			$wpdb->update('wp_'.$ids[0].'_posts',array('menu_order' => $counter), array( 'ID' => $ids[1] ));
		}
        $counter++;
    }
	//update getsiteoption
	if(get_site_option('next_menu_order')){
	  update_site_option('next_menu_order', $counter);
	}else{
	  add_site_option('next_menu_order', $counter );
	}
    die(1); 
}



add_action('network_sort', 'save_user_story_network_order');
add_action('wp_ajax_network_sort', 'save_user_story_network_order');
add_action('wp_ajax_nopriv_network_sort', 'save_user_story_network_order');

/**change status**/
function update_change_status(){
   $data_status = explode('xxx', $_POST['data_status']); 
   $success=update_field('user_story_done_or_not', $data_status[0], $data_status[1]);
   if($success){
      echo 'Successfully updated the status of the story to '.$data_status[0].'.';
	  exit();
   }else{
	   echo 'Failed to update the status.';
	   exit();
   }
   
}

add_action('change_status', 'update_change_status');
add_action('wp_ajax_change_status', 'update_change_status');
add_action('wp_ajax_nopriv_change_status', 'update_change_status');


/*Sites order*/
function update_blogsites_sort(){
    $blogids=explode(',', $_POST['order']); //sites_orderxxxblogID'
    $counter = 1;
    foreach ($blogids as $blogid) {
		$successx=update_user_meta(1,'sites_orderxxx'.$blogid,$counter); // meta_value=sites_orderxxxblogID
		$success[]=$counter.'for'.$blogid.' and its '. $successx;
        $counter++;
    }
	var_dump($success);
    die(1); 

}


add_action('blogsites_sort', 'update_blogsites_sort');
add_action('wp_ajax_blogsites_sort', 'update_blogsites_sort');
add_action('wp_ajax_nopriv_blogsites_sort', 'update_blogsites_sort');

/*Sites order*/



/*Add file fields to the post content */

add_action("gform_after_submission_2", "set_post_content", 10, 2);

function set_post_content($entry, $form){

    //getting post
    $post = get_post($entry["post_id"]);

    //changing post content
	$imgExts = array("gif", "jpg", "jpeg", "png");
	$urlExt = pathinfo($entry[12], PATHINFO_EXTENSION);
	if (in_array($urlExt, $imgExts)) {
		$file_content.="Attached Image:<br/><a target='_blank' href='" . $entry[12] . "'><img src='".$entry[12]."'/></a><br/>";
	}elseif($entry[12]){
	    $file_content.="Attached File:<br/><a target='_blank' href='" . $entry[12] . "'><img width='100' src='http://mightylucy.com/file-attached.png'/></a><br/>";
	}
    
	update_field('field_535d4aa93a078', 4, $entry["post_id"]);//assigned-to set to sherwin by default
	
	update_field('field_5353gb9ed23d1','active',$entry["post_id"]);//set status to on progress
	
	$user_assigned = get_user_by('slug', 'sherwin');
	
	//this is where magic goes for assigned notification--sherkspear
	if(get_post_meta($entry["post_id"],'assigned_email', true)!=$user_assigned->user_email){//different value then send email 
		update_post_meta($entry["post_id"],'assigned_email', $user_assigned->user_email);
		send_email_assigned($user_assigned->user_email,$post->post_title,get_permalink($entry['post_id'])); //send sherwin status
	}
	
	$post->post_content =$file_content.$post->post_content;
    wp_update_post($post);
	$post_id = $entry['post_id'];
}

/***saves a post for user_story post type--sherkspear**/
function save_user_story_backend($post_id) {
  $post = get_post($post_id);
  
  if ('user_story' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id)) return;
	$user_assigned = get_field('assigned_to');
	if(get_post_meta($post_id,'assigned_email', true)!=$user_assigned['user_email']){//different value then send email 
		update_post_meta($post_id,'assigned_email',$user_assigned['user_email']);
		send_email_assigned($user_assigned['user_email'],$post->post_title,get_permalink($post_id)); //send email
	}
	
  }	
}

add_action('save_post', 'save_user_story_backend');


function send_email_assigned($user_email,$story_title,$story_url) {
	$subject = 'You are Assigned for the Story '.$story_title;
	$message =  'Details of the story you are assigned can be found by clicking this <a href="'.$story_url.'">'.$story_title.'</a> .';
	wp_mail( $user_email, $subject, $message);
}




add_action('wp_head','pluginname_ajaxurl');
function pluginname_ajaxurl() {
?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<style>
#sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
#sortable li { margin: 3px 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 14px;  }
#sortable li span { position: absolute; margin-left: -1.3em; }
</style>
<script>
	jQuery(function() {
	jQuery( "#sortable" ).sortable();
	jQuery( "#sortable" ).disableSelection();
});
</script>


<script type="text/javascript">
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>



<?php
}









function time_entry_updated( $post_id ) {

	// If this is just a revision, don't send the email.
	if ( wp_is_post_revision( $post_id ) ) {
		return;		
	}
	

    // If not time entry dont update
	$type1 = 'time_entry';
	    if ( $type1 != $_POST['post_type'] ) {
        return;
    }	
		

	$post_title = get_the_title( $post_id );
	$post_url = get_permalink( $post_id );
	//hrs invested
	$hrs_invested = 'field_53549855f0f97';
	$val1 = get_field_object($hrs_invested, $post_id, true);

	$field_key = "field_53549855f0f97";
	$field = get_field_object($field_key, $post_id);
 
 	//clear values
 	$totalhourspurchased = 0;
	$totalhoursinvested = 0;
	$history_hours_content = '';
	$myposts =NULL;
	

	
	global $wp_query;
	$args = array_merge(
		$wp_query->query_vars,
		array(
			'post_type' => 'time_entry',
			'posts_per_page' => '-1'
		)
	);

	query_posts( $args );	
	while ( have_posts() ) : the_post();
		$history_hours_content .= '<li><a href="'. get_permalink() . '">' . get_the_title() . ':' . get_field( 'hours_invested' ) . ' hours</a></li>' ;
		$totalhoursinvested += get_field( 'hours_invested' ); 
	endwhile;
	
	//total hours purchased

	if( have_rows('prepaid_hours', 'options') ):
		while ( have_rows('prepaid_hours', 'options') ) : the_row();	
			$totalhourspurchased += get_sub_field('number_of_hours_purchased', 'options');
		endwhile;
			else :
			endif;
	
	
	
	
	
	
	
			
	$remainingtime = $totalhourspurchased-$totalhoursinvested;		
	if (($remainingtime<=1)&&($remainingtime>0)) {
		 email_low($remainingtime, $totalhourspurchased, $totalhoursinvested);		
	} elseif ($remainingtime<=0) {
		email_zero($remainingtime, $totalhourspurchased, $totalhoursinvested);
	}
	 
	
	
}

function email_low($remainingtime, $totalhourspurchased, $totalhoursinvested) {
	
	$subject_low = 'Time for more Mighty';
	$message =  "Oh no, time is running out... \n\n";
	$message .=  "Your total purchased hours: ". $totalhourspurchased . "\n\n";	
	$message .=  "Hours used: ". $totalhoursinvested . "\n\n";
	$message .=  "Remaining hours: ". $remainingtime . "\n\n";
	$message .= '<a href="https://www.themightymo.com/agreements/hourly-wordpress-support-agreement/">Please reload your prepaid hours here</a>' ;
	$message .=  "\n\n Thanks!";
	$message_low =  $message;
	
	if( have_rows('emails_to_be_notified', 'options') ):
		$email_to = '';
		while ( have_rows('emails_to_be_notified', 'options') ) : the_row();	
		// $email_to  .=  get_sub_field('email_address', 'options'). ', ';
		$email_to  =  get_sub_field('email_address', 'options');
		// Send email to admin.
		
		wp_mail( $email_to, $subject_low, $message_low );

		endwhile;
			else :
			endif;
}


function email_zero($remainingtime, $totalhourspurchased, $totalhoursinvested) {
	
	$subject_low = 'Time for more Mighty';
	$message =  "Oh no, time is running out... \n\n";
	$message .=  "Your total purchased hours: ". $totalhourspurchased . "\n\n";	
	$message .=  "Hours used: ". $totalhoursinvested . "\n\n";
	$message .=  "Remaining hours: ". $remainingtime . "\n\n";
	$message .= '<a href="https://www.themightymo.com/agreements/hourly-wordpress-support-agreement/">Please reload your prepaid hours here</a>' ;
	$message .=  "\n\n Thanks!";
	$message_low =  $message;
	
	if( have_rows('emails_to_be_notified', 'options') ):
		$email_to = '';
		while ( have_rows('emails_to_be_notified', 'options') ) : the_row();	
		// $email_to  .=  get_sub_field('email_address', 'options'). ', ';
		$email_to  =  get_sub_field('email_address', 'options');
		// Send email to admin.
		
		wp_mail( $email_to, $subject_low, $message_low );

		endwhile;
			else :
			endif;
}




add_action( 'save_post', 'time_entry_updated' );


function check_ifnew_task($postid) {
	$daycomputed2 = (strtotime(date( 'd-m-Y', current_time( 'timestamp', 1 )))) - (strtotime(get_the_time('d-m-Y', $postid)));
	$daycomputed2 = $daycomputed2 / (60 * 60 * 24) ;
	
	if ($daycomputed2 < 7) {
//		echo 'new';
		return true;
	}	else {
//		echo 'old';
		return NULL;
	}
	
}


// Remove WPMUDEV's annoying dashboard nag
add_action('admin_head', 'my_custom_fonts');
function my_custom_fonts() {
  echo '<style>
	div.wpmudev-new, div.wpmudev-message, div.wpdv-msg {
		display: none !important;
	}
	</style>';
}

/*Bio Custom Post Type*/
add_action( 'init', 'register_cpt_bio' );

function register_cpt_bio() {

    $labels = array( 
        'name' => _x( 'Bios', 'bio' ),
        'singular_name' => _x( 'Bio', 'bio' ),
        'add_new' => _x( 'Add New', 'bio' ),
        'add_new_item' => _x( 'Add New Bio', 'bio' ),
        'edit_item' => _x( 'Edit Bio', 'bio' ),
        'new_item' => _x( 'New Bio', 'bio' ),
        'view_item' => _x( 'View Bio', 'bio' ),
        'search_items' => _x( 'Search Bios', 'bio' ),
        'not_found' => _x( 'No bios found', 'bio' ),
        'not_found_in_trash' => _x( 'No bios found in Trash', 'bio' ),
        'parent_item_colon' => _x( 'Parent Bio:', 'bio' ),
        'menu_name' => _x( 'Bios', 'bio' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        
        'supports' => array( 'title','editor','excerpt' ),
        
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );
    register_post_type( 'bio', $args );

}

/**
 * Bio Scripts
 */
function bio_scripts() {
   if(is_singular('bio')){ 
		//wp_enqueue_style( 'style-bio', get_stylesheet_uri() );
		wp_enqueue_script('script-bio','//code.jquery.com/ui/1.11.1/jquery-ui.js', array(), '1.0.0', true );
	}
}

add_action( 'wp_enqueue_scripts', 'bio_scripts');


// Add WYSIWYG Comments - via https://www.gavick.com/blog/tinymce-editor-in-the-comments-section/
function gk_comment_form( $fields ) {
    ob_start();
    wp_editor( '', 'comment', array( 'teeny' => true ));
    $fields['comment_field'] = ob_get_clean();
    return $fields;
}
//add_filter( 'comment_form_defaults', 'gk_comment_form' );

$dirName = dirname(__FILE__);
$baseName = basename(realpath($dirName));

require_once ("$dirName/ajax/developer-hours.php");

function front_end_ajax_available() 
{     
	if ( is_page ( 'report-all-dev-hours' ) ) {
		
		wp_enqueue_script( 'dev_hours', get_template_directory_uri() . '-child/js/dev-hours.js', array(), '1.0.0', true );
		wp_localize_script( 'dev_hours', 'front_end_ajax_identificator', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	}
}

add_action('template_redirect', 'front_end_ajax_available');

add_action("wp_ajax_get_developers_hours", "get_developers_hours");
add_action("wp_ajax_nopriv_get_developers_hours", "get_developers_hours");


add_action( 'wp_enqueue_scripts', 'dev_hours_scripts' );
