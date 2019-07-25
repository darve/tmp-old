<?php

session_start();

/**

 * Template Name: Housing Association Journey

 *

 * @package WordPress

 * @subpackage Twenty_Fourteen

 * @since Twenty Fourteen 1.0

 */







get_header();





?>

<section id="housing-section" class="new">

	<div class="container">

		<div class="row">

			<div class="col-sm-12">

			</div><!--col-sm-12 ends here-->

		</div><!--row ends here-->

		<div class="row">

			<div class="col-sm-12 housing-title">

				<h2 class="title housing">Housing Association Journey</h2>

				<div class="bigger">

					<p style="text-align: left;">We partner with 30+ UK Housing Associations. We're here to represent you throughout the entire mortgage process. So you can be sure that our smart, friendly approach extends to your customers. Take a look at our simple process. We're with you every step of the way.</p>

				</div>



			</div><!--col-sm-12 ends here-->

		</div><!--row ends here-->

		<div class="row">

			<div class="col-sm-4">

				<h3 class="big-title wow slideInLeft" data-wow-duration="1s" data-wow-delay="0.4s">Smarter.</h3>

			</div><!--col-sm-4 ends here-->

			<div class="col-sm-8 wow slideInRight" data-wow-duration="1s" data-wow-delay="0.4s">

				<ul class="housing-list clearfix">

					<li>

						<div class="row">

							<div class="col-sm-2">

								<strong>1</strong>

							</div><!--col-sm-4 ends here-->

							<div class="col-sm-10">

								Refreshingly straight forward and friendly mortgage advice.

							</div><!--col-sm-8 ends here-->

						</div><!--row ends here-->

					</li>

					<li>

						<div class="row">

							<div class="col-sm-2">

								<strong>2</strong>

							</div><!--col-sm-4 ends here-->

							<div class="col-sm-10">

								We're here to make you look good and your customer happy. Even when it's not always the decision they're hoping for.

							</div><!--col-sm-8 ends here-->

						</div><!--row ends here-->

					</li>

				</ul>



			</div>

		</div><!--row ends here-->







			<div class="row">

			<div class="col-sm-12 ">

			<?php echo simple_fields_value("para");?>

			</div><!--col-sm-12 ends here-->

	</div><!--row ends here-->







	</div><!--container ends here-->

</section><!--housing-section ends here-->



<section style="margin-top: 60px;">

	<div class="container">

		<div class="row">

			<div class="col-md-12">

				<img src="<?php echo get_template_directory_uri(); ?>/web/img/housing_journey.gif" alt="Housing Association Journey" class="housingimg" />

			</div>

		</div>

	</div>

</section>



<?php get_footer(); ?>

