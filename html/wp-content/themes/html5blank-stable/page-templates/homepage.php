<?php
session_start();

/**
 * Template Name: Homepage Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */


error_reporting(0);
get_header();


?>
<!--head-section ends here-->
<section id="banner-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-5 col-xs-12">
				<img src="<?php echo get_template_directory_uri(); ?>/web/img/parrot.png" alt="image" class="parrot">
			</div><!--col-sm-5 ends here-->
			<div class="col-sm-7 col-xs-12">
				<div class="banner-content clearfix">
					<div class="banner-title">
						<h1>Chirpy.</h1>
						<h2>The <strong>amazingly helpful</strong><br/> mortgage people.</h2>
					</div>
					<div id="feefo-service-review-carousel-widgetId" class="feefo-review-carousel-widget-service"></div>
					<div class="apply-now-pointer">
						<img src="<?php echo get_template_directory_uri(); ?>/motivo/apply-now.png" alt="" class="">
					</div>
				</div><!--banner-content end here-->
			</div><!--col-sm-12 ends here-->
		</div><!--row ends here-->
	</div><!--container ends here-->
	<div class="motivo-banner-buttons">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="motivo-banner-button-container">
						<a href="<?php echo home_url(); ?>/mortgage/">
							<div class="motivo-banner-button-title">
								<h3>AFFORDABILITY</h3>
							</div>
							<div class="motivo-banner-button-content">
								<p>Click here to find out what’s affordable</p>
							</div>
						</a>
					</div>
					<div class="motivo-banner-button-container">
						<a href="<?php echo home_url(); ?>/apply-now/">
							<div class="motivo-banner-button-title">
								<h3>SAVINGS</h3>
							</div>
							<div class="motivo-banner-button-content">
								<p>Already a Homeowner?<br/>Click here for a Remortgage Assessment</p>
							</div>
						</a>
					</div>
					<div class="motivo-banner-button-container">
						<a href="<?php echo home_url(); ?>/apply-now/">
							<div class="motivo-banner-button-title">
								<h3>APPLY</h3>
							</div>
							<div class="motivo-banner-button-content">
								<p>Need an Assessment?<br/>Click here to complete your Financial Assessment</p>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--banner-section ends here-->
	<section id="about-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
					<h3 class="big-title wow fadeIn" data-wow-duration="1s" data-wow-delay="0.4s">Blimey.</h3>
			</div><!--col-sm-4 ends here-->
			<div class="col-sm-8 wow slideInRight" data-wow-duration="1s" data-wow-delay="0.4s">
				<h2 class="title">About us</h2>
				<?

 while ( have_posts() ) : the_post();


		echo the_content();

		endwhile;
		?>
</div>
		</div><!--row ends here-->



	</div><!--container ends here-->
</section><!--about-section ends here-->
<section id="team-section">
	<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="semi-circle white">
					</div><!--semi-circle ends here-->
				</div><!--col-sm-12 ends here-->
			</div><!--row ends here-->
		<div class="row">
			<div class="col-sm-4">
					<h3 class="big-title black wow fadeIn" data-wow-duration="1s" data-wow-delay="0.4s">Tip Top.</h3>
			</div><!--col-sm-4 ends here-->
			<div class="col-sm-8 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.4s">
				<h2 class="title">Team Page</h2>
				<?
				echo simple_fields_value("team");	?>		</div><!--col-sm-8 ends here-->
		</div><!--row ends here-->
		<div class="team-members">
      <?php
        $staff = get_posts(array('post_type' => 'staff','post_status' => 'publish','posts_per_page' => -1, 'orderby' => 'title', 'order'=> 'asc'));
        $count = 1;
        foreach ($staff as $member) {
          $img = simple_fields_value('staffphoto',$member->ID,true);
          $fImg = simple_fields_value('overlayimage',$member->ID,true);
          $position = str_replace(' and ',' & ', simple_fields_value('staffpos', $member->ID, true));
          $telephone = simple_fields_value('tel', $member->ID, true);
          $email = simple_fields_value('staffemail', $member->ID, true);
          $bio = simple_fields_value('bio', $member->ID, true);
					$item['full'] = strip_tags($bio);
					$item['exerpt'] = '';
					$exerpt = explode(' ', $item['full']);
					for ($i=0; $i < count($exerpt); $i++) {
						$item['exerpt'][] = $exerpt[$i];
						if($i == 20){
							break;
						}
					}
					$item['exerpt'] = implode(' ', $item['exerpt']);
					rtrim($item['full']);
					rtrim($item['exerpt']);

          echo '<div class="col-sm-3 col-xs-6">' . "\r\n";
          echo '  <div class="member" style="background-image:url('. $img['image_src']['medium_large'][0] .')"></div>' . "\r\n";
          echo '  <div class="bio">' . "\r\n";
          echo '    <h3>'. $member->post_title .'</h3>' . "\r\n";
          echo '    <h4>'. ucwords($position) .'</h4>' . "\r\n";
          echo '    <div class="contact-info">' . "\r\n";
          echo ($email)     ? '<a href="mailto:'. str_replace('tmpmartgages','tmpmortgages',$email) .'"><span class="tooltip">'. str_replace('tmpmartgages','tmpmortgages',$email) .'</span><i class="fa fa-envelope"></i></a>' . "\r\n":'';
          echo ($telephone) ? '<a href="tel:'. str_replace(array('DD', ' '), array('',''), $telephone) .'"><span class="tooltip">'. str_replace(array('DD', ' '), array('',''), $telephone) .'</span><i class="fa fa-phone"></i></a>' . "\r\n":'';
          echo ($facebook)  ? '<a href="'. $facebook .'"><i class="fa fa-facebook"></i></a>' . "\r\n":'';
          echo ($twitter)   ? '<a href="'. $twitter .'"><i class="fa fa-twitter"></i></a>' . "\r\n":'';
          echo '    </div>' . "\r\n";
          echo '    <div class="bio-text" data-text="'. $item['full'] . '" data-exerpt="'. $item['exerpt'] .'...">';
          echo '    	<p>'. $item['exerpt'] .'...</p>';
					if(strlen($item['full']) > strlen($item['exerpt'])){
						echo '<span>Read More</span>';
					}
					echo '		</div>';
          echo '	</div>' . "\r\n";
          echo '</div>' . "\r\n";
          $count++;
        }
      ?>
		</div><!--row ends here-->
    <br/>
    <br/>
	</div><!--team-members ends here-->
</section><!--about-section ends here-->

  <section id="juicer-section">
    <div class="container">
      <div class="col-sm-12 contact-title">
        <h2 class="title contact">Follow us</h2>
      </div><!--col-sm-12 ends here-->
      <div class="row">
        <div class="col-sm-12">
          <?php juicer_feed('name=tmp&per=15'); ?>
        </div><!--col-sm-12 ends here-->
      </div><!--row ends here-->
    </div><!--container ends here-->
  </section><!--contact-section ends here-->



<?php get_footer(); ?>
