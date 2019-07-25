<?php get_header(); ?>

<div id="header_spacer">&nbsp;</div><!-- Header Spacer -->


		<div id="title_bar"><!-- Start Title Bar -->

			<h1>News</h1>

		</div><!-- End Title Bar -->


		<div id="main_image"><!-- Start Main Image -->

		<?
		 echo get_the_post_thumbnail( '15', 'full' );

			 ?>

		</div><!-- End Main Image -->


		<div class="row" id="introduction"><!-- Start Row -->

			<div class="contents"><!-- Start Contents -->

				<div class="elephant_small"></div>

				<p>Here's what we have been up to recently.</p>

			</div><!-- End Contents -->

		</div><!-- End Row -->


			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>




<?php get_footer(); ?>
