<?php
/**
 * Template Name: REPORT: All Developer Hours
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
						<div id="date-ranges">
							<input type="date" id="rangeFrom" value="<?php echo date('Y-m-d'); ?>"/> <i>to</i> <input type="date" id="rangeTo" value="<?php echo date('Y-m-d'); ?>" />
						</div>
							
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
							
							<input id="table2CSV" value="Export as CSV text" type="button" onclick="jquery('#myTable').table2CSV()">						
						</div><!-- .entry-content -->
						
					</article><!-- #post-## -->

					
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();