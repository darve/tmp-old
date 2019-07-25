<header id="head-section" style="position:relative">
	<div class="container">
		<div class="row">
			<div class="col-sm-3 clearfix col-xs-12">
				<a href="/" id="logo"><img src="<?php echo get_template_directory_uri(); ?>/web/img/logo.png"alt="image"></a>
			</div><!--col-sm-6 ends here-->
			<div class="col-sm-9 col-xs-12 clearfix">
				<nav class="nav pull-right">
					<ul class="clearfix" id="menu">
					<?
					if ( is_front_page() ) {
						$home="";
					}else{
						$home="/";
					}
					?>
						<li class="active"><a href="<?= $home;?>#header-section">Welcome</a></li>
						<li><a href="<?= $home;?>#about-section">About us</a></li>
						<li><a href="<?= $home;?>#team-section">Our Team</a></li>
						<li>
							<a href="#">Housing Association</a>
							<ul>
								<li><a href="<?php echo home_url(); ?>/housing-association/client-journey/">Client Journey</a></li>
								<li><a href="<?php echo home_url(); ?>/housing-association/housing-association-journey/">Housing Journey</a></li>
							</ul>
						</li>
						<!--<li><a href="/housing-association/">Housing Association</a></li>-->
						<li><a href="<?= $home;?>#contact-section">Contact us</a></li>
						<li style="margin-top: -5px;"><a href="https://www.facebook.com/tmpthemortgagepeople/" target="_blank"><img src="<?php echo home_url(); ?>/wp-content/themes/html5blank-stable/web/icons/menu_fb.png" alt="Facebook" /></a> <a href="https://twitter.com/Chirpymortgages" target="_blank"><img src="<?php echo home_url(); ?>/wp-content/themes/html5blank-stable/web/icons/menu_twitter.png" alt="Twitter" /></a> <a href="https://www.linkedin.com/company/tmp-the-mortgage-people" target="_blank"><img src="<?php echo home_url(); ?>/wp-content/themes/html5blank-stable/web/icons/menu_linkedin.png" alt="LinkedIn" /></a></li>
					</ul><!--menu ends here-->
				</nav>
			</div><!--col-sm-12 ends here-->
		</div><!--row ends here-->
	</div><!--container ends here-->
</header>
