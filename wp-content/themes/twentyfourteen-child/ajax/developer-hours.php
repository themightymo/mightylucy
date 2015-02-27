<?php

function get_developers_hours(){
	$singleUserStory = array();
	$userStories = array();
	
	$start_date =  str_replace('-','',$_GET['start_date']) ;
	$end_date =  str_replace('-','',$_GET['end_date']) ;
	//Hide sites that are archived, mature, spam, or deleted
	$siteArgs = array(
		'archived'   => false,
		'mature'     => false,
		'spam'       => false,
		'deleted'    => false,
	);
	$blog_list = wp_get_sites($siteArgs);
	$blog_list[]=array('blog_id',1); //insert mightylucy entries
	//var_dump($blog_list);
	
	foreach ($blog_list AS $blog) {
		$blogID = $blog['blog_id'];
		
		switch_to_blog($blogID);
		
		
		
		$args = array(
			'post_type' => 'time_entry',
			'posts_per_page' => -1,
			
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'date_worked',
					'value' => $start_date,
					'type' => 'NUMERIC',
					'compare' => '>='
				),
				array(
					'key' => 'date_worked',
					'value' => $end_date,
					'type' => 'NUMERIC',
					'compare' => '<='
				)
			),
			
		);
		$mypostsWP = new WP_Query( $args );
			
		//$myposts = get_posts( $args );
		
		$blog_details = get_blog_details($blogID);
		
//		print_r($blog_details);
		//var_dump($myposts);
		while ( $mypostsWP->have_posts() ) : ?>
			<?php
			$mypostsWP->the_post();
			//var_dump($post);
			$singleUserStory = array();
			$singleUserStory[] = $blog_details->blogname;
			$singleUserStory[] = get_field('hours_invested');
			$singleUserStory[] = get_field('date_worked');
			$singleUserStory[] = get_the_author();
			$terms_post = array_values( get_the_terms (get_the_id(), 'time_entry_categories') );
			$singleUserStory[] = $terms_post[0]->name;
			$singleUserStory[] = get_the_ID();
			$userStories[] = $singleUserStory;
			
			
		endwhile; 
		
		wp_reset_postdata(); 
		
		restore_current_blog();
		
		
	}
	
	echo json_encode( array("data"=>$userStories) );
	//echo json_encode( $userStories );
		
	die();
	
	
}

?>