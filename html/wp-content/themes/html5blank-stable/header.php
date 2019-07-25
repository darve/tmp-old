<?php

date_default_timezone_set('Europe/London');

$url = "http://tmp.weareresource.co.uk";

?>
<!doctype html>
<!--[if IE 7]>  <html lang="en-GB" class="no-js ie7"> <![endif]-->
<!--[if IE 8]>  <html lang="en-GB" class="no-js ie8"> <![endif]-->
<!--[if IE 9]>  <html lang="en-GB" class="no-js ie9"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en-GB" class="no-js"> <!--<![endif]-->

	<head>
			<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> </title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">


        	<!-- Designed/Built by Atalanta Advertising // Design // www.atalanta.uk.com // Copyright <?php echo date('Y'); ?> -->
	<link type="text/plain" rel="author" href="<?php echo $url; ?>/humans.txt">

	<!-- Favicons -->
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/web/icons/favicon.ico">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/web/icons/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/web/icons/apple-touch-icon.png">

	<!-- TypeKit -->
	<script src="https://use.typekit.net/urn3ayt.js"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>




		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">


			<!-- Facebook Open Graph -->
	<meta property="og:type"			content="website">
	<meta property="og:title"			content="TMP - The mortgage people">
	<meta property="og:url"				content="<?php echo $url; ?>">
	<meta property="og:image"			content="<?php echo get_template_directory_uri(); ?>/web/images/facebook-og.jpg">
	<meta property="og:site_name"		content="TMP - The mortgage people">
	<meta property="og:description"		content="TMP - The mortgage people">

	<!-- Twitter Card (Used with Open Graph) -->
	<meta name="twitter:card"			content="summary_large_image">
	<meta name="twitter:site"			content="@TMP_Mortgages">
	<meta name="twitter:creator"		content="@TMP_Mortgages">
	<meta name="twitter:title"			content="TMP - The mortgage people">
	<meta name="twitter:description"	content="">
	<meta name="twitter:image:src"		content="<?php echo get_template_directory_uri(); ?>/web/images/facebook-og.jpg">
	<meta name="twitter:domain"			content="<?php echo $url; ?>">


		<?php wp_head(); ?>


	</head>
	<body <?php body_class(); ?> >
		<?php include("web/includes/header.php"); ?>
