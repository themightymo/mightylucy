<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php twentyfourteen_post_thumbnail(); ?>

	<header class="entry-header" <?php if(function_exists('live_edit')) { live_edit('post_title, post_content, user_story_done_or_not, how_many_hours_will_this_to-do_require, assigned_to'); }?>>
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
		
		<?php if (get_field('how_many_hours_will_this_to-do_require')>0) { ?>
		<div class="hours-estimate" style="clear:both;margin-bottom:1em;">We estimate that this to-do will require <strong><?php the_field('how_many_hours_will_this_to-do_require'); ?> <?php if (get_field('how_many_hours_will_this_to-do_require') == 1) { echo 'hour'; } else { echo 'hours'; } ?></strong>.</div>
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
	
		<!--get_status-->
		<?php
		//onactive=6 done=4 onhold=9 readyforreview=12
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
		
		$options='<tr><td><h5>Status:</h5></td><td><select id="topselect"  status="'.$doneornot->slug.'xxx'.get_the_ID().'"  class="user_story_status '.$arr_user_story_done_or_not.'test"> <option  value="activexxx'.get_the_ID().'" '.$active_selected.'> Active</option><option  value="donexxx'.get_the_ID().'" '.$done_selected.'> Done</option> <option  value="on-holdxxx'.get_the_ID().'" '.$onhold_selected.'> On Hold</option><option  value="ready-for-client-reviewxxx'.get_the_ID().'" '.$ready_for_client_selected.'> Ready For Client Review</option></select></td></tr>';
		
		?>
		<div id="t_story_status"><table><?php echo $options;?></table><div class="ajax_status"></div></div>
		<p>This to-do was requested by <span style="font-weight:bold"><?php echo ucwords(get_the_author()); ?> on <?php the_date();?></span> and is assigned to <span style="font-weight:bold"><?php $assigned_to = get_field('assigned_to'); echo $assigned_to['display_name']; ?></span>. Estimated: <?php the_field('how_many_hours_will_this_to-do_require'); ?></p>
		
		<?php
		
		the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyfourteen' ) );
		?>
		
		<?php
		$current_user;
		if ( current_user_can('publish_posts') ) {
			echo make_clickable(get_field('lowrize_url'));
		}?>	
		
		<?php 
		
		if (get_field('date_worked')) {
			$date1 = DateTime::createFromFormat('Ymd', get_field('date_worked'));
			echo 'Date Worked: ' . $date1->format('d M, Y') .' -by:'.get_the_author(); 			
		}
		

		
		
		
		
		
		$posts = get_field('related_user_stories');
		if( $posts ): ?>
			<h2>Related User Stories:</h2>
		    <ul>
		    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
		        <?php setup_postdata($post); ?>
		        <li>
		            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		        </li>
		    <?php endforeach; ?>
		    </ul>
		    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
		<?php 
		endif; ?>
		
		
	</div><!-- .entry-content -->
	<?php endif; ?>

	<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
</article><!-- #post-## -->
