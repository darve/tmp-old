<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section style="background:black;">

			<!-- article -->
			<article id="post-404">

				<div class="container">
					<div class="row">

						<div class="col-sm-6">
							<h1><?php _e( '404?! <br>Uh-oh-spaghettio!', 'html5blank' ); ?></h1>
							<p>
								<?php _e( 'That page can\'t be found. It was probably deleted or renamed (but it may well be that a certain budgie\'s to blame).', 'html5blank' ); ?>
							</p>
							<h2>
								<a href="<?php echo home_url(); ?>"><?php _e( 'Quick! Head for home!', 'html5blank' ); ?></a>
							</h2>
						</div>

						<div class="col-sm-6">
							<img src="<?php echo get_template_directory_uri(); ?>/img/budgie-404.gif" alt="Budgie 404">
						</div>

					</div>
				</div>

			</article>
			<!-- /article -->

		</section>
		<!-- /section -->
	</main>

<?php //get_sidebar(); ?>

<style>
	#post-404 h1 {
		color:white;
		font-size:4em;
		font-weight:800;
		font-family: 'ProximaNova-Bold', Arial;
	}
	#post-404 {
		padding-top:100px;
		height:100%;
	}
	@media only screen and (min-width: 1030px) {
		#post-404 {
			height:calc(100vh - 110px);
		}
	}
	#post-404 p {
		color:white !important;
		font-size:2em;
		width:100%;
		max-width:320px;
		margin-top:40px;
		margin-bottom:40px;
	}
	#post-404 a {
		color:white;
		font-weight:800;
		font-size:1em;
		font-family: 'ProximaNova-Bold', Arial;
	}
	#post-404 img {
		width:100%;
		max-width:100%;
		height:auto;
	}
	#footer-section {
		margin-top:0px;
	}
</style>

<?php get_footer(); ?>
