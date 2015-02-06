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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> ng-app="example">
	

	<div class="entry-content">
	
		<div ng-controller="WpRestController" >

			<h1>WP-REST DEMO</h1>
			
			<div ng-init="getItems()" style="width:45%;float:left">
			
			    <div ng-repeat="post in data">
			        <h2 ng-bind="post.title"></h2>
			        
			        <a ng-click="getOnePost(post.ID)" href>view</a>
			
			        <p><em ng-bind="post.date_gmt | date:'MMMM d, yyyy'"></em></p>
			        <div ng-bind-html="post.content | unsafe"></div>
			        <!-- <div>user_story_done_or_not = {{post.terms.user_story_done_or_not.0.slug}}</div> -->
			        <div>ID = {{post.ID}}</div>
			    </div>
			
			</div>
			
			<div style="width:45%; float:left;" ng-show="!viewList">
			    
		        <h2 ng-bind="oneTitle"></h2>
		        <div ng-bind-html="oneContent | unsafe"></div>
		        <a ng-click="backToList()" ng-href="#single">Back to list</a>
		              
			</div>
	
		</div>
		
	</div><!-- .entry-content -->
	
</article><!-- #post-## -->
