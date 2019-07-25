<?php get_header(); ?>


	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
<section id="blog-section" class="">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">

	
		<div id="header_spacer">&nbsp;</div><!-- Header Spacer -->


		<div id="title_bar"><!-- Start Title Bar -->
		
			<h1>News</h1>
		
		</div><!-- End Title Bar -->


		<div id="main_image"><!-- Start Main Image -->
		
			<img src="<?php echo get_template_directory_uri(); ?>/web/images/main_images/news.jpg" alt="" />
		
		</div><!-- End Main Image -->


		<div class="row" id="introduction"><!-- Start Row -->
		
			<div class="contents"><!-- Start Contents -->

				<div class="elephant_small"></div>


<h2><?php the_title(); ?></h2>


<h4><?php the_time('d/m/Y'); ?></h4>
			
				<p class="text_blue"><? echo simple_fields_value("newsexcerpt"); ?></p>
			
			</div><!-- End Contents -->
		
		</div><!-- End Row -->


		<div class="row" id="news_row_01"><!-- Start Row -->
		
			<div class="contents"><!-- Start Contents -->

			<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>

			<div class="two_col_one">
					<?php the_post_thumbnail(); // Fullsize image for the single post ?>
				</div>
			<?php endif; ?>

				<div class="two_col_two">
					
					<?
					the_content();
					?>
				</div>
			
			</div><!-- End Contents -->
		
		</div><!-- End Row -->

		
		<br class="clear" /><!-- Clear Fix -->
		
		
	</div>
	</div>
	</div>
	</section>	

	<?php endwhile; ?>

	<?php else: ?>

		<!-- article -->
		<article>

			<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>


<?php get_footer(); ?>
