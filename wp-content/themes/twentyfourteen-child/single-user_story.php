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
					
					$arr_user_story_done_or_not=get_field('user_story_done_or_not');
					$doneornot=get_term($arr_user_story_done_or_not[0],'user_story_done_or_not');
					$options='<tr><td><h5>Status:</h5></td><td><select id="bottomselect" status="'.$doneornot->slug.'xxx'.get_the_ID().'" class="user_story_status"> <option  value="activexxx'.get_the_ID().'"> Active</option><option  value="donexxx'.get_the_ID().'"> Done</option> <option  value="on-holdxxx'.get_the_ID().'"> On Hold</option><option  value="ready-for-client-reviewxxx'.get_the_ID().'" > Ready For Client Review</option></select></td></tr>';
					
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
			
					$doctors = get_posts(array(
						'post_type' => 'time_entry',
						'meta_query' => array(
							array(
								'key' => 'related_user_stories', // name of custom field
								'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
								'compare' => 'LIKE'
							)
						)
					));
						/*									*\
							This will contain the Time entry 
							from the Todo View  
						\*									*/
					
						if ( ! is_admin() ) { ?>
							<div class="SingleTimeEntryGroup">
								Quick Time Entry: 
								<input type="number" min=".25" max="16" step=".25" value=".25" class="SingleTimeEntryClass" id="SingleTimeEntryId">
								<?php DisplayTimeEntryCategories(); ?>	
								​<textarea id="SingleTimeEntryDescription" rows="3" cols="30" placeholder="Enter Description Here"></textarea>
								<input type="button" id="SingleTimeEntryAddButton" value="Add Time">
								<br>
							</div>
						<? 							
						} 
						
						/*									*\
							End feature 
						\*									*/
					?>
					<?php if( $doctors ): ?>
						<quote>
							Time Entries for This To-Do:
							<ul>
							<?php foreach( $doctors as $doctor ) : ?>
								<?php $photo = get_field( 'hours_invested', $doctor->ID ); ?>
								<li>
									<a href="<?php echo get_permalink( $doctor->ID ); ?>">
										<?php echo get_the_title( $doctor->ID ); ?> (<?php echo $photo; ?> hours on <?php echo date( "F d Y", strtotime( $doctor->post_date ) ); ?>)
										<?php $totalHoursWorked += $photo; ?>
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
	
	$('#SingleTimeEntryAddButton').click(function(){
		var TimeEntryDescription = $( "textarea#SingleTimeEntryDescription" ).val();
		var TimeEntryHours = $( "#SingleTimeEntryId" ).val();
		var TimeEntryCategories = $( "#TimeEntryCategories" ).val();
		var data = {
			'action': 'my_action_add_time_from_frontend',
			'title': '<?php echo the_title() ?>',
			'time_entry_description': TimeEntryDescription,
			'related_postid': '<?php the_ID(); ?>',
			'TimeEntryHours': TimeEntryHours,
			'TimeEntryCategories': TimeEntryCategories			
		};
		
		$.post(ajaxurl, data, function(response) {
			alert( 'Recorded New Time Entry.' );
		});
	})
	
})( jQuery );
</script>
<?php

get_footer();
