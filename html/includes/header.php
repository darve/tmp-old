<header id="head-section">
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
						<li class="active"><a href="<?= $home;?>#header-section"><i class="fa fa-flag"></i>Welcome</a></li>
						<li><a href="<?= $home;?>#about-section"><i class="fa fa-comment"></i>About us</a></li>
						<li><a href="<?= $home;?>#team-section"><i class="fa fa-user"></i>Team Page</a></li>
						<li><a href="/housing-association/"><i class="fa fa-map-marker"></i>Housing Association Area</a></li>
						<li><a href="<?= $home;?>#blog-section"><i class="fa fa-globe"></i>Blog</a></li>
						<li><a href="<?= $home;?>#contact-section"><i class="fa fa-edit"></i>Contact us</a></li>
						<!--<li><a href="https://form.jotform.com/60770533070146" class="logon" target="_blank">Log on</a></li>-->
					
					</ul><!--menu ends here-->
				</nav>
			</div><!--col-sm-12 ends here-->
		</div><!--row ends here-->		
	</div><!--container ends here-->
</header>