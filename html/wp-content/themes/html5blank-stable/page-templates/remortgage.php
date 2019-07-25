<?php
session_start();
/**
 * Template Name: Aoplication Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */



get_header();


?>
<!--head-section ends here-->
<form method="POST" class="membership-form" id="mortgageform">
<input type="hidden" name="sub_submit" value="1" />
<section id="banner-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-5 col-xs-12">
				<div class="circles">
					<div class="circle get wow zoomIn" data-wow-duration="1s" data-wow-delay="0.5s">
						<p>Get help<br/>to buy your<br/>first home</p>
					</div><!--circle ends here-->
				</div><!--circles end here-->
				<img src="<?php echo get_template_directory_uri(); ?>/web/img/sitting-parrot.png" alt="image" class="parrot sitting">
			</div><!--col-sm-5 ends here-->
			<div class="col-sm-7 col-xs-12">
				<div class="banner-content clearfix -page">
					<h1>Easy.</h1>

					<p class="intro">This will take no more than 2 minutes. Simply answer the
following questions for us to work out how much you can
afford to borrow.</p>

					<h2><div class="ques" id="ques1">My name is <span><input type="text" name="sub_name" data-src="ques3"  /></span></div>
										<div class="ques"  id="ques3">I'm applying <span><select name="sub_applying" id="myself" data-src="ques4"><option value=""></option><option value="myself">by myself</option><option value="someoneelse">with someone else</option></select></span></div>
					<div class="ques"  id="ques4">My salary is currently <br/><span>&pound;<input type="text" name="sub_salary" id="salary1" data-src="ques5"  /></span></div>
					<div class="ques"  id="ques4-2">My partner's salary is currently <br/><span>&pound;<input type="text" name="sub_salary2" id="salary2" data-src="ques5"  /></span></div>


					<div class="ques"  id="ques5">I have <span><select name="sub_children" id="children" data-src="ques8"><option value=""></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option></select></span> children</div>

					<div class="ques"  id="ques5-2">for  <span>&pound;<input type="text" name="propval" data-src="ques8"  /></span> </div>

					<div class="ques"  id="ques8" > My monthly loan repayments are <br/><span>&pound;<input type="text" name="sub_loan" id="loan" data-src="ques6" /> </span></div>


					<div class="ques"  id="ques6" > My monthly pension payments are <br/><span>&pound;<input type="text" name="sub_pension" id="pension" data-src="ques7" /> </span></div>
					<div class="ques"  id="ques7" > The total I owe on credit cards is <br/><span>&pound;<input type="text" id="cards" name="sub_credit" data-src="about-section" /> </span></div>
</h2>
								</div><!--banner-content end here-->
			</div><!--col-sm-12 ends here-->
		</div><!--row ends here-->
	</div><!--container ends here-->
</section>
<!--banner-section ends here-->


	<section id="about-section" class="gym-section sectionhide sechide1">
		<div class="container" >
				<div class="row">
					<div class="col-sm-12">
						<div class="semi-circle gray">
						</div><!--semi-circle ends here-->
					</div><!--col-sm-12 ends here-->
				</div><!--row ends here-->
			<div class="row">
				<div class="col-sm-4">
				</div><!--col-sm-4 ends here-->
				<div class="col-sm-8 wow slideInRight" data-wow-duration="1s" data-wow-delay="0.4s">

						<h3 >Nearly there. Now a little more about you.</h3>
				</div>
				<div class="col-sm-4">

						<h3 class="big-title wow fadeIn" data-wow-duration="1s" data-wow-delay="0.4s">Gym.</h3>
				</div><!--col-sm-4 ends here-->
				<div class="col-sm-8 wow slideInRight" data-wow-duration="1s" data-wow-delay="0.4s">

					<p class="membership-tagline">How much is your membership per month?</p>
					<ul class="membership-list clearfix gym">
						<li>
							<p>N/A</p>

							<input type="radio" name="sub_gym" id="gym1"  value="n/a" />
							<label for="gym1" class="membership-type" value="0"></label>
						</li>
						<li>
							<p>&pound; 10</p>
							<input type="radio" name="sub_gym" id="gym2" value="10" />
							<label for="gym2" class="membership-type"></label>

						</li>
						<li>
							<p>&pound; 20</p>
							<input type="radio" name="sub_gym" id="gym3" value="20" />
							<label for="gym3" class="membership-type"></label>


						</li>
						<li>
							<p>&pound; 30</p>
							<input type="radio" name="sub_gym" id="gym4" value="30" />
							<label for="gym4" class="membership-type"></label>

						</li>
						<li>
							<p>&pound; 40</p>
							<input type="radio" name="sub_gym" id="gym5" value="40" />
							<label for="gym5" class="membership-type"></label>


						</li>
						<li>
							<p>&pound; 50</p>
							<input type="radio" name="sub_gym" id="gym6" value="50" />
							<label for="gym6" class="membership-type"></label>


						</li>
						<li>
							<p>&pound; 60</p>
							<input type="radio" name="sub_gym" id="gym7" value="60" />
							<label for="gym7" class="membership-type"></label>


						</li>
						<li>
							<p>&pound; 70+</p>
							<input type="radio" name="sub_gym" id="gym8" value="80" />
							<label for="gym8" class="membership-type"></label>


						</li>
					</ul><!--membership-list ends here-->
				</div>
			</div><!--row ends here-->
		</div><!--container ends here-->
	</section><!--about-section/gym-section ends here-->
	<section id="about-section" class="gym-section food-section foodac sectionhide sechide2">
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
						<h3 class="big-title wow fadeIn gray" data-wow-duration="1s" data-wow-delay="0.4s">Food.</h3>
				</div><!--col-sm-4 ends here-->
				<div class="col-sm-8 wow slideInRight" data-wow-duration="1s" data-wow-delay="0.4s">
					<p class="membership-tagline">How much do you spend on food per month?</p>
					<ul class="membership-list clearfix food">
						<li>
							<p>Under &pound; 100</p>
							<input type="radio" name="sub_food" id="food1" value="50" />
							<label for="food1" class="membership-type"></label>

						</li>
						<li>
							<p>&pound; 100 - &pound; 250</p>
							<input type="radio" name="sub_food" id="food2" value="200" />
							<label for="food2" class="membership-type"></label>

						</li>
						<li>
							<p>&pound; 250 - &pound; 500</p>
							<input type="radio" name="sub_food" id="food3" value="375" />
							<label for="food3" class="membership-type"></label>

						</li>
						<li>
							<p>&pound; 500 - &pound; 750</p>
							<input type="radio" name="sub_food" id="food4" value="675" />
							<label for="food4" class="membership-type"></label>

						</li>
						<li>
							<p>&pound; 750 - &pound; 1000</p>
							<input type="radio" name="sub_food" id="food5" value="825" />
							<label for="food5" class="membership-type"></label>

						</li>

					</ul><!--membership-list ends here-->
				</div>
			</div><!--row ends here-->
		</div><!--container ends here-->
	</section><!--about-section/food-section ends here-->
	<section id="about-section" class="gym-section drink-section sectionhide sechide3">
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
						<h3 class="big-title wow fadeIn" data-wow-duration="1s" data-wow-delay="0.4s">Drink.</h3>
				</div><!--col-sm-4 ends here-->
				<div class="col-sm-8 wow slideInRight" data-wow-duration="1s" data-wow-delay="0.4s">
					<p class="membership-tagline">How much do you spend on posh coffee per week? </p>
					<ul class="membership-list clearfix drink">
						<li>
							<p>N/A</p>
							<input type="radio" name="sub_drink" id="coffee1" value="0" />
							<label for="coffee1" class="membership-type"></label>

						</li>
						<li>
							<p>&pound; 10</p>
							<input type="radio" name="sub_drink" id="coffee2" value="10" />
							<label for="coffee2" class="membership-type"></label>

						</li>
						<li>
							<p>&pound; 20</p>
							<input type="radio" name="sub_drink" id="coffee3" value="20" />
							<label for="coffee3" class="membership-type"></label>

						</li>
						<li>
							<p>&pound; 30</p>
							<input type="radio" name="sub_drink" id="coffee4" value="30" />
							<label for="coffee4" class="membership-type"></label>

						</li>
						<li>
							<p>&pound; 40</p>
							<input type="radio" name="sub_drink" id="coffee5" value="40" />
							<label for="coffee5" class="membership-type"></label>
						</li>
						<li>
							<p>&pound; 50</p>
							<input type="radio" name="sub_drink" id="coffee6" value="50" />
							<label for="coffee6" class="membership-type"></label>

						</li>
						<li>
							<p>&pound; 60</p>
							<input type="radio" name="sub_drink" id="coffee7" value="60" />
							<label for="coffee7" class="membership-type"></label>

						</li>
						<li>
							<p>&pound; 70+</p>
							<input type="radio" name="sub_drink" id="coffee8" value="70" />
							<label for="coffee8" class="membership-type"></label>

						</li>
					</ul><!--membership-list ends here-->
				</div>
			</div><!--row ends here-->
		</div><!--container ends here-->
	</section><!--about-section/drink-section ends here-->
	<section id="about-section" class="gym-section food-section mobile-section sectionhide sechide4">
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
						<h3 class="big-title wow fadeIn gray" data-wow-duration="1s" data-wow-delay="0.4s">Childcare costs.</h3>
				</div><!--col-sm-4 ends here-->
				<div class="col-sm-8 wow slideInRight" data-wow-duration="1s" data-wow-delay="0.4s">
					<p class="membership-tagline">What are your monthly childcare costs? </p>
					<ul class="membership-list clearfix food mobile">
						<li>
							<p>Under &pound; 50</p>
							<input type="radio" name="sub_childcare" id="bills1" value="50" />
							<label for="bills1" class="membership-type"></label>

						</li>
						<li>
							<p>&pound; 50 - &pound; 100</p>
							<input type="radio" name="sub_childcare" id="bills2" value="150" />
							<label for="bills2" class="membership-type"></label>
						</li>
						<li>
							<p>&pound; 100 - &pound; 200</p>
							<input type="radio" name="sub_childcare" id="bills3" value="150" />
							<label for="bills3" class="membership-type"></label>

						</li>
						<li>
							<p>&pound; 200 - &pound; 300</p>
							<input type="radio" name="sub_childcare" id="bills4" value="250" />
							<label for="bills4" class="membership-type"></label>
						</li>
					</ul><!--membership-list ends here-->
				</div>
			</div><!--row ends here-->
		</div><!--container ends here-->
	</section><!--about-section/food-section ends here-->
	<section id="about-section" class="gym-section wifi-section sectionhide sechide5">
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
						<h3 class="big-title wow fadeIn" data-wow-duration="1s" data-wow-delay="0.4s">Travel.</h3>
				</div><!--col-sm-4 ends here-->
				<div class="col-sm-8 wow slideInRight" data-wow-duration="1s" data-wow-delay="0.4s">
					<p class="membership-tagline">How much do you pay for travel per month?</p>
					<ul class="membership-list clearfix wifi">
						<li>
							<p>Under &pound;50</p>
							<input type="radio" name="sub_travel" id="wifi1" value="50" />
							<label for="wifi1" class="membership-type"></label>

						</li>
						<li>
							<p>&pound; 50 - &pound; 100</p>
							<input type="radio" name="sub_travel" id="wifi2" value="100" />
							<label for="wifi2" class="membership-type"></label>

						</li>
						<li>
							<p>&pound; 100 - &pound; 200</p>
							<input type="radio" name="sub_travel" id="wifi3" value="200" />
							<label for="wifi3" class="membership-type"></label>

						</li>
						<li>
							<p>&pound; 200 - &pound; 300</p>
							<input type="radio" name="sub_travel" id="wifi4" value="300" />
							<label for="wifi4" class="membership-type"></label>

						</li>
					</ul><!--membership-list ends here-->
					<input type="submit" name="sub_submit" class="mem-submit" value="submit">
				</div><!--col-sm-8 ends here-->
			</div><!--row ends here-->
		</div><!--container ends here-->
	</section><!--about-section/food-section ends here-->

</form><!--member-ship form ends here-->
<section id="about-section" class="thanks-section sectionhide sechide6">
	<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="semi-circle">
					</div><!--semi-circle ends here-->
				</div><!--col-sm-12 ends here-->
			</div><!--row ends here-->
		<div class="row">
			<div class="col-sm-12 wow slideInRight" data-wow-duration="1s" data-wow-delay="0.4s">
				<h2 class="title thanks-title">THANKS <span id="insertname"></span></h2>
				<p>Based on the information you provided, here's what we think you can afford to pay
monthly.</p>
				<!-- <p class="green">Log-in for further access and we’ll be in touch </p>-->
			</div><!--col-sm-12 ends here-->
		</div><!--row ends here-->
		<div class="row">
			<div class="col-sm-12">
				<h3 class="amount"><span id="amount">£140k</span>Blimey</h3>
				<p><span class="green"><a href="/apply-now/">Register with us today</a> </span> to find out the value of mortgage this might get you. </p>

			</div><!--col-sm-12 ends here-->
		</div><!--row ends here-->

		<div class="row">
			<div class="col-sm-12">
				<a href="/apply-now/" class="log-on-white pull-left">Register</a>
			</div><!--col-sm-12 ends here-->
		</div><!--row end here-->

		<div class="row">
			<div class="col-sm-12">
			<br/><br/>
				<?
				echo simple_fields_value("lenderfees");	?>

<br/><br/>
				<?
				echo simple_fields_value("extracosts");	?>
				</div><!--col-sm-12 ends here-->
		</div><!--row ends here-->

	</div><!--container ends here-->
</section><!--about-section ends here-->

<?php get_footer(); ?>
