<?php
?>

<div class="flexslider">
		<ul class="slides">
			

<?php
 $args=array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => 20,
      'caller_get_posts'=> 1
      );
      
      $oddpost = 'gray';
    $my_query = null;
    $my_query = new WP_Query($args);
    if( $my_query->have_posts() ) {
       while ($my_query->have_posts()) : $my_query->the_post();
       
if ('gray' == $oddpost) $oddpost = 'green';
else $oddpost = 'gray';

 ?>
 <?
 if($oddpost=='green'){
 ?>
 <li>
 <?
 }
 ?>
     <div class="blog-post <?= $oddpost;?> wow fadeIn" data-wow-duration="1s" data-wow-delay="0.4s">
	
				
		<div class="container">
			<div class="row">
				<div class="col-sm-7 col-xs-12">
					<h4 class="post-title"><?php the_title(); ?></h4>
					<p class="post-text">	<? the_excerpt(); ?></p>
					<a href="<?php the_permalink(); ?>" class="view-post green">View Post</a><span class="meta">Posted by <?  the_author(); ?> on <?php the_time('l jS \of F Y') ?></span>
				</div><!--col-sm-6 ends here-->
				<div class="col-sm-5 col-xs-12 clearfix">
					
						<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail('mdeium', array('class' => 'post-thumbnail green pull-right')); // Declare pixel size you need inside the array ?>
			</a>
		<?php endif; ?>
				
				</div><!--col-sm-6 ends here-->
			</div><!--row ends here-->
		</div><!--container ends here-->
	</div><!--blog-post ends here-->
	 <?
 if($oddpost=='gray'){
 ?>
 </li>
 <?
 }
 ?>

       <?php
      endwhile;
    }
wp_reset_query();  // Restore global post data stomped by the_post().


?>

	 <?
 if($oddpost=='green'){
 ?>
 </li>
 <?
 }
 ?>

			
		</ul><!--slides ends here-->
	</div><!--flexslider ends here-->