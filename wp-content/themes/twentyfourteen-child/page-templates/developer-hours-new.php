<?php
/**
 * Template Name: REPORT: All Developer Hours NEW
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
							
							
<?php
$parameters = array(
	'post_type'	=> 'user_story'
);

network_query_posts( $parameters );
$myvar = network_query_posts( $parameters );
echo '<pre>';
print_r($myvar);
echo '</pre>';
if ( network_have_posts() ) {
	while ( network_have_posts() ) {
		network_the_post();
		?>
		<a href="<?php echo network_get_permalink(); ?>">
		<strong><?php network_the_title() ?></strong>
		</a><br>
		<?php 
		switch_to_blog($blog_id);

			the_field( "how_many_hours_will_this_to-do_require", $post_id );
		
		restore_current_blog();
		
		global $post;
		the_field( "how_many_hours_will_this_to-do_require", $post_id );
		?>

		<?php
	}
}
?>							
							
							<?php /*
							<table id="myTable" class="tablesorter">
								<thead>
									<tr>
									   <th>Sitename</th>
									   <th>Hours Invested</th>
									   <th>Date Worked</th>
									   <th>Developer</th>
									   <th>Billable?</th>
									   <th>Post Meta</th>
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
									
									foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
										<?php
										$singleUserStory['sitename'] = $blog_details->blogname;
										$singleUserStory['hours_invested'] = get_field('hours_invested');
										$singleUserStory['date_worked'] = get_field('date_worked');
										$singleUserStory['author'] = get_the_author(); 
										$singleUserStory['post_id'] = get_the_ID();
										$singleUserStory['billable_or_nonbillable'] = get_the_terms (get_the_id(), 'time_entry_categories');
										$userStories[] = $singleUserStory;
										?>
										<tr>
											<td><?php echo $singleUserStory['sitename']; ?></td>
											<td><?php echo $singleUserStory['hours_invested']; ?></td>
											<td><?php echo $singleUserStory['date_worked']; ?></td>
											<td><?php echo $singleUserStory['author']; ?></td>
											<td><?php 
												// via http://code-tricks.com/get-the-current-taxonomy-of-the-post-using-get-the-terms-in-wordpress/											
												$terms = get_the_terms( $post->ID , 'time_entry_categories' );
												foreach ( $terms as $term ) {
													$term_link = get_term_link( $term, 'time_entry_categories' );
													echo $term->name;
												}
												?>
											</td>
											<td>
												<ul>
													<li><?php edit_post_link('Edit Time Entry', '', '', $singleUserStory['post_id']);?></li>
													<?php
													// Display the permalink for the to-dos that are linked to this time entry "related_user_stories"
													$posts = get_field('related_user_stories');
	 
													if( $posts ): ?>
													    
													    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
													        <?php setup_postdata($post); ?>
													        <li>
													            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
													        </li>
													    <?php endforeach; ?>
													    
													    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
													<?php endif; ?>
												</ul>
											</td>
										</tr>
										<?
									endforeach; 
									
									wp_reset_postdata(); 
									
									restore_current_blog();
								}
								
								
								
								//echo '<pre>';
								//var_dump($userStories);
								//echo '</pre>';
								?>
								<tfoot>
									<tr>
									   <td>Sitename</td>
									   <td>Hours Invested</td>
									   <td>Date Worked</td>
									   <td>Developer</td>
									   <td>Billable?</td>
									   <td>Post ID</td>
									</tr>
								</tfoot>
								</tbody>
							</table>	
							
							<input id="table2CSV" value="Export as CSV text" type="button" onclick="jquery('#myTable').table2CSV()">								*/ ?>
						</div><!-- .entry-content -->
						
					</article><!-- #post-## -->

					
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();