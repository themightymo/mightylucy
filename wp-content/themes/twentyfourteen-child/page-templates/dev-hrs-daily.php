<?php
/**
 * Template Name: REPORT: All Dev hrs daily
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
							
							<div class="entry-meta">
								
							</div>
							<h1 class="entry-title">REPORT: Developer Hours Worked</h1>	
											
							<div class="entry-meta">
								
							</div><!-- .entry-meta -->
						</header><!-- .entry-header -->
					
						
						<div class="entry-content">
<form action="<?php $_PHP_SELF ?>" method="GET">						
	<?php
wp_enqueue_script('jquery-ui-datepicker');
wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
?>					
<input type="text" id="dte1" name="dte1" value=""/>

<script type="text/javascript">

jQuery(document).ready(function() {
    jQuery('#dte1').datepicker({
        dateFormat : 'yymmdd'
    });
});

</script>				
							
							<table id="myTable" class="tablesorter">
								<thead>
								<tr>
								   <th>Sitename</th>
								   <th>Hours Invested</th>
								   <th>Date Worked</th>
								   <th>Developer</th>
								   <th>Post ID</th>
								</tr>
								</thead>
								<tbody>
								<?php	
								$singleUserStory = array();
								$userStories = array();
								//Hide sites that are archived, mature, spam, or deleted
								$siteArgs = array(
								    'archived'   => false,
								    'mature'     => false,
								    'spam'       => false,
									'limit'      => 200,
								    'deleted'    => false,
								);
								$blog_list = wp_get_sites($siteArgs);
								$blog_list[]=array('blog_id',1); //insert mightylucy entries
								//var_dump($blog_list);
								
								foreach ($blog_list AS $blog) {
									$blogID = $blog['blog_id'];
									
									switch_to_blog($blogID);
									
									$args = array( 
										'posts_per_page' => -1,
										'post_type' => 'time_entry'
										
									);
										
									$myposts = get_posts( $args );
									
									$blog_details = get_blog_details($blogID);
									
	//								print_r($blog_details);
									
									foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
										<?php
										$singleUserStory['sitename'] = $blog_details->blogname;
										$singleUserStory['hours_invested'] = get_field('hours_invested');
										$singleUserStory['date_worked'] = get_field('date_worked');
										$singleUserStory['author'] = get_the_author(); 
										$singleUserStory['post_id'] = get_the_ID();
										$userStories[] = $singleUserStory;
										?>
<?	if (($singleUserStory['date_worked'])== $_GET['dte1']) {?>				
										<tr>
										<td><?php echo $singleUserStory['sitename']; ?></td>
										<td><?php echo $singleUserStory['hours_invested']; ?></td>
										
										<td><?php echo $singleUserStory['date_worked']; ?></td>
										<td><?php echo $singleUserStory['author']; ?></td>
										<td><?php edit_post_link('edit', '', '', $singleUserStory['post_id']);?></td>
										</tr>
						<? } ?>				
										
										<?
									endforeach; 
									
									wp_reset_postdata(); 
									
									restore_current_blog();
								}
								
								
								
								//echo '<pre>';
								//var_dump($userStories);
								//echo '</pre>';
								?>
								</tbody>
							</table>	
							
							<input id="table2CSV" value="Export as CSV text" type="button" onclick="jquery('#myTable').table2CSV()">	
</form>												
						</div><!-- .entry-content -->
						
					</article><!-- #post-## -->

					
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();