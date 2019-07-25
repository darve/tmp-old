<?php

session_start();

/**

 * Template Name: Housing Association

 *

 * @package WordPress

 * @subpackage Twenty_Fourteen

 * @since Twenty Fourteen 1.0

 */







get_header();



					

?>

<section id="housing-section">

	<div class="container">

		<div class="row">

			<div class="col-sm-12">

				<div class="semi-circle">

				</div><!--semi-circle ends here-->

			</div><!--col-sm-12 ends here-->

		</div><!--row ends here-->

		<div class="row">

			<div class="col-sm-12 housing-title">

				<h2 class="title housing">Housing Association Area</h2>

				<div class="bigger">	<?

				echo simple_fields_value("housing",4);	?></div>

				

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

								<?php echo simple_fields_value("point1",4);?>							</div><!--col-sm-8 ends here-->

						</div><!--row ends here-->

					</li>

					<li>

						<div class="row">

							<div class="col-sm-2">

								<strong>2</strong>

							</div><!--col-sm-4 ends here-->

							<div class="col-sm-10">

									<?php echo simple_fields_value("point2",4);?>									</div><!--col-sm-8 ends here-->

						</div><!--row ends here-->

					</li>

				</ul>

				

			</div>

		</div><!--row ends here-->

		<img src="<?php echo get_template_directory_uri(); ?>/web/img/TMP-Process-Map_v2.png" alt="Housing Association Process" class="housingimg" />

		

	

		

			<div class="row">

			<div class="col-sm-12 ">

			<?php echo simple_fields_value("para");?>	

			</div><!--col-sm-12 ends here-->

	</div><!--row ends here-->





		

	</div><!--container ends here-->

</section><!--housing-section ends here-->



	

<?php get_footer(); ?>