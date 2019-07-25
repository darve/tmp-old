<?php
/**
 * Template Name: Privacy Policy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
session_start();
get_header();
?>
<section id="">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1><?php the_title();?></h1>
			</div>
			<div class="col-md-12">
				<?php the_content();?>
			</div>
		</div>
	</div><!--container ends here-->
</section><!--housing-section ends here-->
<?php get_footer(); ?>
