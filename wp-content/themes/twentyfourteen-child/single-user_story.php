<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */


get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					get_template_part( 'content', 'userstory' );

					// Previous/next post navigation.
					//twentyfourteen_post_nav();

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
					
					$arr_user_story_done_or_not=get_field('field_5353gb9ed23d1',get_the_ID());
					//some of the existing user status are not using the ACF default fields but custom post type categories
					if (intval($arr_user_story_done_or_not < 1 )){		    
						$arr_doneornot=get_the_terms( get_the_ID(), 'user_story_done_or_not');
						$doneornot=$arr_doneornot[0];
					}else{
						$doneornot=get_term($arr_user_story_done_or_not,'user_story_done_or_not');
					}
	
					if($doneornot->slug=='active'){
						$active_selected=' selected';
					}elseif($doneornot->slug=='done'){
						$done_selected=' selected';
					}elseif($doneornot->slug=='ready-for-client-review'){
						$ready_for_client_selected=' selected';
					}else{
						$onhold_selected=' selected';
					}
					
					$options='<tr><td><h5>Status:</h5></td><td><select id="bottomselect"  status="'.$doneornot->slug.'xxx'.get_the_ID().'"  class="user_story_status"> <option  value="activexxx'.get_the_ID().'" '.$active_selected.'> Active</option><option  value="donexxx'.get_the_ID().'" '.$done_selected.'> Done</option> <option  value="on-holdxxx'.get_the_ID().'" '.$onhold_selected.'> On Hold</option><option  value="ready-for-client-reviewxxx'.get_the_ID().'" '.$ready_for_client_selected.'> Ready For Client Review</option></select></td></tr>';
					
					?>
					
					
					<div id="b_story_status"><table><?php echo $options;?></table><div class="ajax_status"></div></div>
				<?php endwhile;
			?>
			
			<div class="entry-content">
			
				<?php 
				if ( current_user_can('manage_options') ) {

				
	
					/*
					*  Query posts for a relationship value.
					*  This method uses the meta_query LIKE to match the string "123" to the database value a:1:{i:0;s:3:"123";} (serialized array)
					*/
			
					$timeEntries = get_posts(array(
						'post_type' => 'time_entry',
						'posts_per_page' => -1, 
						'post_status' => 'publish',
						'meta_query' => array(
							array(
								'key' => 'related_user_stories', // name of custom field
								'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
								'compare' => 'LIKE'
							)
						)
					));
			
					?>
					<?php if( $timeEntries ): ?>
						<quote>
							Time Entries for This To-Do:
							<ul>
							<?php foreach( $timeEntries as $timeEntry ) : ?>
								<?php $hours_invested = get_field( 'hours_invested', $timeEntry->ID ); ?>
								<?php $date_worked = get_field( 'date_worked', $timeEntry->ID ); ?>
								<li>
									<a href="<?php echo get_permalink( $timeEntry->ID ); ?>">
										<?php echo get_the_title( $timeEntry->ID ); ?> (<?php echo $hours_invested; ?> hours on <?php echo date( "F d, Y", strtotime( $date_worked ) ); ?><?php if ( has_term('non-billable','time_entry_categories') ) { echo ', unbilled'; } ?>)
										<?php $totalHoursWorked += $hours_invested; ?>
									</a>
								</li>
							<?php endforeach; ?>
								<li>Total hours invested on this to-do: <?php echo $totalHoursWorked; ?></li>
							</ul>
						</quote>
					<?php 
					endif; 
				} ?>
			</div><!-- .entry-content -->
		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_sidebar( 'content' );
get_sidebar();

?>
<script>
(function($) {
    $(".user_story_status").val($(".user_story_status").attr('status'));
      
   $(document).on("change",".user_story_status",function(){
       var data = {
            action: 'change_status',
            data_status:$(this).val(), 
        };
		this_value=$(this).val();

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(ajaxurl, data, function(response) {
		    //alert(response);
           $('.ajax_status').html(response);
		   
		   $("#topselect").attr(this_value);
		   $("#bottomselect").attr(this_value);
		   $("#topselect").val(this_value);
		   $("#bottomselect").val(this_value);
        }); 
	});
	
})( jQuery );
</script>
<?php

get_footer();
