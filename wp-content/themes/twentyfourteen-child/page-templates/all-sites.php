<?php
/**
 * Template Name: REPORT: All Sites
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
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			
									
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php twentyfourteen_post_thumbnail(); ?>
					
						<header class="entry-header">
							
							<h1 class="entry-title">REPORT: All Active Sites</h1>	
											
						</header><!-- .entry-header -->
					
						
						<div class="entry-content">
						
							<?php
							//getpostmeta  xxx
							//update_post_meta($post_id, $meta_key, $meta_value)  meta_value=sites_orderxxxblogID
														
							$args = array(
										'archived'   => false,
										'mature'     => false,
										'spam'       => false,
										'deleted'    => false,
										'limit'      => 200,
										'sort_column'=> 'registered',
									);
									
							$blog_list = wp_get_sites($args);
							
							foreach ($blog_list as $blog) {
								$blogID = $blog['blog_id'];
								$site_order=get_user_meta(1,'sites_orderxxx'.$blogID,true);
								$site_orderx[]=$site_order.'yyy'.$blogID;
								if(empty($site_order)){
								   $site_order=-1;
								}
								$blog_details=get_blog_details($blogID);
								$arr_site['blogID']=$blogID;
								$arr_site['blogOrder']=$site_order;
								$arr_site['blogURL']=$blog_details->siteurl;
								$arr_site['blogName']=$blog_details->blogname;
								
								switch_to_blog($blog['blog_id']);
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
								$results = get_posts($args);
								$activeToDos = count($results);
								$arr_site['activeToDos']=$activeToDos;
								restore_current_blog();
								
								$arr_sites[]=$arr_site;
							}
							
							/*sort by site_order*/
							$blogOrders = array();
							foreach ($arr_sites as $key => $row)
							{
								$blogOrders[$key] = $row['blogOrder'];
							}
							array_multisort($blogOrders, SORT_ASC, $arr_sites);
							
							echo '<ul id="sortable">';
							foreach ($arr_sites as $blog) {
								if ($blog['activeToDos']==0){ $noToDos = ' gray'; } else { $noToDos = ' greenhr'; };
								echo '<li  id="'.$blog['blogID'].'" class="ui-state-default'. $noToDos .'" ><a href="'.$blog['blogURL'] .'">'.$blog['blogName']. ' (' . $blog['activeToDos'].'&nbsp;active&nbsp;to-dos)</a></li>';
							}
							echo '</ul>';
							
							?>
							<script>
								(function($) {  
								var itemList = $('#sortable');
								itemList.sortable({
									update: function(event, ui) {
									    itemlistx=itemList.sortable('toArray').toString();
										opts = {
											url: ajaxurl, // ajaxurl is defined by WordPress and points to /wp-admin/admin-ajax.php
											type: 'POST',
											async: true,
											cache: false,
											datatype: 'json',
											data:{
												action: 'blogsites_sort', // Tell WordPress how to handle this ajax request
												order: itemlistx, // Passes ID's of list items in  1,3,2 format
											},
											//console.log(order);
											success: function(response) {
												return; 
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
							
						</div><!-- .entry-content -->
						
					</article><!-- #post-## -->

					
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->
<?php
 ?>
<?php
get_sidebar();
get_footer();