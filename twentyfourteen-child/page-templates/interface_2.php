<?php
/**
 * Template Name: Client Dashboard
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content">

<?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>
<?php
get_currentuserinfo(); // NOTE: I don't know why, but this call to get_currentuserinfo() fixes a bug that was causing the home page of each sub-site to display when not logged in.
 ?>
 
    <?php  
	$totalhourspurchased = 0;
	// check if the repeater field has rows of data
	if( have_rows('prepaid_hours', 'options') ):
		$purchasedcontent='<h2>Purchase History</h2>';
		$purchasedcontent.='<ul>';
		while ( have_rows('prepaid_hours', 'options') ) : the_row();
			$purchasedcontent.= '<li>You purchased ' . get_sub_field('number_of_hours_purchased', 'options') . ' hours on ' . date("F j, Y", strtotime(get_sub_field('date_of_purchase', 'options'))) . ' <em>'.get_sub_field('hours_description', 'options').'</em></li>';
			$totalhourspurchased += get_sub_field('number_of_hours_purchased', 'options');
		endwhile;
		$purchasedcontent.='</ul>';
		
	else :
		// no rows found
	endif;
 
	//NOTE: I'm going to transfer it here to have control with the color coding classes
	$args = array( 
		'posts_per_page' => -1, 
		'post_type' => 'time_entry',
		'orderby' => 'date',
		'order' => 'DESC'
	);
	$myposts = get_posts( $args );
	$totalhoursinvested = 0;
	foreach ( $myposts as $post ) : setup_postdata( $post ); 
	
	$date1 = get_field('date_worked');
	
	if ($date1) {

		$date3 = DateTime::createFromFormat('Ymd', get_field('date_worked'));
		$date4 = $date3->format('d M, Y');
		$date3 = $date4;
	} else {
		$date3='No specified date';			
	}
	
	    $history_hours_content.='<li><a href="'. get_permalink() .'">'. get_the_title().': '.get_field('hours_invested').  ' hours ( '.$date3 .' -by: ' .get_the_author().' )</a></li>';
		$totalhoursinvested += get_field('hours_invested'); 
	endforeach; 
	$hoursAvailable = $totalhourspurchased-$totalhoursinvested;
	if($hoursAvailable>2){
	   $hrclass='greenhr';
	}elseif($hoursAvailable>1){
	   $hrclass='yellowhr';
	}else{
	   $hrclass='redhr';	  
	}
	wp_reset_postdata();?>
 
 
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			 <?php
				if($hoursAvailable<2){
				 $statusdiv='<ul><li class="'.$hrclass.'">Note: The client has only '.$hoursAvailable.' available hours.</li></ul>';
				 echo $statusdiv;
				}
			?>
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post(); ?>
									
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php twentyfourteen_post_thumbnail(); ?>
					
						<header class="entry-header">
							<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && twentyfourteen_categorized_blog() ) : ?>
							<div class="entry-meta">
								<span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'twentyfourteen' ) ); ?></span>
							</div>
							<?php
								endif;
					
								if ( is_single() ) :
									the_title( '<h1 class="entry-title">', '</h1>' );
								else :
									the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
								endif;
							?>
							
							<?php if(get_field('notes','options') && current_user_can('manage_options')){ ?>
							   <div class="notes"><?php the_field('notes','options');?></div>
							<?php } ?>
					
							<div class="entry-meta">
								<?php
									if ( 'post' == get_post_type() )
										twentyfourteen_posted_on();
					
									if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
								?>
								<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'twentyfourteen' ), __( '1 Comment', 'twentyfourteen' ), __( '% Comments', 'twentyfourteen' ) ); ?></span>
								<?php
									endif;
					
									edit_post_link( __( 'Edit', 'twentyfourteen' ), '<span class="edit-link">', '</span>' );
								?>
							</div><!-- .entry-meta -->
						</header><!-- .entry-header -->
					
						<?php if ( is_search() ) : ?>
						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->
						<?php else : ?>
						<div class="entry-content">
						   
						
						    
							<h2>Active To-Do's</h2>
							<ul id="sortable">
							<?php
							$args = array( 
								'posts_per_page' => -1, 
								'post_type' => 'user_story',
								'orderby' => 'menu_order',
								'order' => 'ASC',
								'tax_query' => array(
									array(
										'taxonomy' => 'user_story_done_or_not',
										'field' => 'slug',
										'terms' => 'active'
									)
								) 
							);
							$cleanposts = get_posts( $args );
							foreach ( $cleanposts as $post ) : setup_postdata( $post ); 
							    if($post->menu_order==0){
								//update getsiteoption
									if(get_site_option('next_menu_order')){
									  $next_menu_order=get_site_option('next_menu_order');
									  $wpdb->update('wp_'.$blog_id.'_posts', array( 'menu_order' => $next_menu_order), array( 'ID' => $post->ID) );
									  update_site_option('next_menu_order',  $next_menu_order+1);
									}else{
									  $wpdb->update('wp_'.$blog_id.'_posts', array( 'menu_order' => 1), array( 'ID' => $post->ID) );
									  add_site_option('next_menu_order',2);
									}								
								}
								
							endforeach; 
							wp_reset_postdata();
							/*
							 * Bust the non-persistent query cache. After rewriting any items
							 * with a menu_order of 0, we want to make sure that we retrive
							 * the newly stored data, not the cached query result. Otherwise
							 * the menu_order would remain zero for those items.
							 */
							$bogus_type = uniqid();
							$args['post_type'] = array('user_story', $bogus_type);
							$myposts = get_posts( $args );
							$blog_id = get_current_blog_id();
							$totalHoursEstimated = 0;
							foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
								<li  id="<?php echo $blog_id.'x'.$post->ID.'x'.$post->menu_order;?>" class="ui-state-default <?php echo $hrclass;?>" ><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?> (<?php the_field('how_many_hours_will_this_to-do_require'); ?>&nbsp;<?php if (get_field('how_many_hours_will_this_to-do_require') == 1) { echo 'hour'; } else { echo 'hours'; } ?>)</a><?php if (get_field('assigned_to')){
										$assigned_to = get_field('assigned_to');
										echo ' [' . $assigned_to['display_name'] . ']';
										
									} 
									$totalHoursEstimated += get_field('how_many_hours_will_this_to-do_require');
									//print_r(get_post_meta( get_the_ID() ));
									
									
									
									if (check_ifnew_task( $post->ID))	{
									echo '<div style="background:#FEFF00;color:#000;display: inline-block;padding: 1px 5px;margin-left: 10px;">NEW</div>';
									} 
									
									
									?>	
												
								</li>
								<?php 
							

								
							endforeach; 
							wp_reset_postdata();?>
							</ul>
							
							<!-- TODO: transfer at footer or functions.php -->
							<script>
							(function($) {  
							var itemList = $('#sortable');
							itemList.sortable({
								update: function(event, ui) {
									opts = {
										url: ajaxurl, // ajaxurl is defined by WordPress and points to /wp-admin/admin-ajax.php
										type: 'POST',
										async: true,
										cache: false,
										datatype: 'json',
										data:{
											action: 'item_sort', // Tell WordPress how to handle this ajax request
											order: itemList.sortable('toArray').toString(), // Passes ID's of list items in  1,3,2 format
										},
									    
										success: function(response) {
											//alert('response->'+response);
										},
										error: function(xhr,textStatus,e) {  // This can be expanded to provide more information
											//alert(e);
											// alert('There was an error saving the updates');
											return; 
										}
									}; 
									$.ajax(opts);
								}
							
							}); 
						})( jQuery );
						</script>
							
							<?php
							$args = array( 
								'posts_per_page' => -1, 
								'post_type' => 'user_story',
								'tax_query' => array(
									array(
										'taxonomy' => 'user_story_done_or_not',
										'field' => 'slug',
										'terms' => 'ready-for-client-review'
									)
								) 
							);
							$myposts = get_posts( $args ); ?>
							<?php if ($myposts) : ?>
							<h2>Ready For Client Review</h2>
							<ul>
							<?php
							foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
								<li>
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>							
								</li><?php 
							endforeach; 
							wp_reset_postdata();?>
							</ul>
							<?php endif; ?>
							
							
							<?php
							$args = array( 
								'posts_per_page' => -1, 
								'post_type' => 'user_story',
								'tax_query' => array(
									array(
										'taxonomy' => 'user_story_done_or_not',
										'field' => 'slug',
										'terms' => 'on-hold'
									)
								) 
							);
							$myposts = get_posts( $args );
							$totalPosts = count($myposts);
							if ($totalPosts > 0) { ?>
								<h2>On Hold To-Do's</h2>
								<ul>
								<?php
								foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
									<li>
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>							
									</li><?php 
								endforeach; 
								wp_reset_postdata();?>
								</ul>
							<?php 
							} ?>
							
							
							
							
							
							<h2>Completed To-Do's</h2>
							<a id="togglecomplete" href="#">Toggle Completed To-Dos</a>
							<ul id="completed_to_dos">
							<?php
							$args = array( 
								'posts_per_page' => -1, 
								'post_type' => 'user_story',
								'tax_query' => array(
									array(
										'taxonomy' => 'user_story_done_or_not',
										'field' => 'slug',
										'terms' => 'done'
									)
								) 
							);
							$myposts = get_posts( $args );
							foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
								<li>
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>							
								</li><?php 
							endforeach; 
							wp_reset_postdata();?>
							</ul>
							
							
							
							<h2>History of Hours Used</h2>
							<a id="togglehistoryhours" href="#">Toggle History Hours</a>
							<ul id="history_hours">
								<?php echo $history_hours_content; ?>
							</ul>	
								<?php echo $purchasedcontent; ?>
								Hours invested: <?php echo $totalhoursinvested; ?>
								<p><strong class="<?php echo  $hrclass; ?>">Available hours remaining: <?php echo $hoursAvailable; ?></strong></p>
								<p><strong>Hours required (estimated): <?php echo $totalHoursEstimated; ?></strong></p>

									
								<a href="https://www.themightymo.com/agreements/hourly-wordpress-support-agreement/">Purchase additional support hours.</a>
							</ul>													
							
							
							<?php
							the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyfourteen' ) );
							?>
							<script type="text/javascript">var $zoho= $zoho || {livedesk:{values:{},ready:function(){}}};var d=document;s=d.createElement("script");s.type="text/javascript";s.defer=true;s.src="https://livedesk.zoho.com/themightymodesignco/button.ls?embedname=themightymodesignco";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);document.write("<div id='zldbtnframe'></div>")</script>
							
						</div><!-- .entry-content -->
						<?php endif; ?>
					
						<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
					</article><!-- #post-## -->

					<?php 
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
			?>
			<!--toggle historyhours and completed todos scripts -->
			<script>
				(function($){
					//init toggle off
					$('#completed_to_dos').hide();
					$('#history_hours').hide();
					$('#togglecomplete').click(function(){
					    $('#completed_to_dos').toggle( "slow", function() {
							// Animation complete.
						});
					});
					$('#togglehistoryhours').click(function(){
						$('#history_hours').toggle( "slow", function() {
							// Animation complete.
						});
					});
				})( jQuery );
			</script>
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->
<?php
 ?>
<?php
get_sidebar();
get_footer();
