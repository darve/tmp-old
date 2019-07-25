
// Main Scripts v1.0
//----------------------------------------------------------------------------- //

$(function() {

	// Link Scrubber Script
	$("a").bind("focus", function() {
		if (this.blur) this.blur();
	});


	// Img Opacity Hover
	$("a").hover(function() {
			$(this).find("img").stop().fadeTo(200, 0.7);
		}, function() {
			$(this).find("img").stop().fadeTo(300, 1.0);
	});


	var header = $("header"),
		headerContents = $("#header_contents"),
		menu = $("a#menu_button"),
		responsiveMenu = $("nav"),
		wrapper = $("#wrapper");


	// Responsive Menu
	menu.toggle(function() {
		$(this).addClass("close");
		$("#menu_line02").hide();
		header.animate({
			marginLeft: "-=254px"
		}, 700, "easeInOutQuint");
		wrapper.animate({
			marginLeft: "-=254px"
		}, 700, "easeInOutQuint");
		responsiveMenu.fadeIn(400);
		return false;
	}, function() {
		$(this).removeClass("close");
		$("#menu_line02").show();
		header.animate({
			marginLeft: "0"
		}, 700, "easeInOutQuint");
		wrapper.animate({
			marginLeft: "0"
		}, 700, "easeInOutQuint");
		responsiveMenu.delay(700).fadeOut(400);
	});


	// Reduce Header On Scroll
	$(window).scroll(function() {
		var scroll = $(window).scrollTop(),
	    	headerSpacer = $("#header_spacer").height();

	    if (scroll >= headerSpacer) {
	        headerContents.addClass("scroll");
	    } else {
	  		headerContents.removeClass("scroll");
	    }
	});


	// Flexslider
	$("#main_image").flexslider({
		controlNav: false,
		animation: "slide"
	});


	// Form Validate Script
    $("#subForm").validate();
	// $("#contactForm").validate();


	// Footer Subscribe Ajax
	$("#subForm").submit(function (e) {
        e.preventDefault();
        $.getJSON(
        this.action + "?callback=?",
        $(this).serialize(),
        function (data) {
            if (data.Status === 400) {
                $("#subscribe_error").fadeIn(400);
            } else {
                $("#subForm").hide(), $("#subscribe_error").fadeOut(400), $("#subscribe_successfull").fadeIn(400);
            }
        });
    });




	// Main Menu Script
	// $("ul.main_nav li").hover(function() {
	// 	$(this).addClass("hover");
	// 	$("ul:first", this).stop(false, true).fadeIn(400);
	// }, function() {
	// 	$(this).removeClass("hover");
	// 	$("ul:first", this).stop(false, true).fadeOut(100);
	// });


	// Responsive Menu
	// var menu = $("a#menu");
	// var navigation = $("nav");

	// menu.click(function() {
	// 	$(this).toggleClass("active");
	// 	navigation.slideToggle(400);
	// 	return false;
	// });

	// $(window).resize(function(){
	// 	var w = $(this).width();
	// 	if(w > 767 && navigation.is(':hidden')) {
	// 		navigation.removeAttr('style');
	// 		menu.removeClass("active");
	// 	}
	// });


	// Responsive Menu - Change UL to SELECT
	// $("<select />").appendTo("nav");
	// $("<option />", {
	// 	"selected": "selected",
	// 	"value"   : "",
	// 	"text"    : "Go to..."
	// }).appendTo("nav select");
	// // Populate dropdown with menu items
	// $("nav a").each(function() {
	// 	var el = $(this);
	// 	$("<option />", {
	// 		"value"   : el.attr("href"),
	// 		"text"    : el.text()
	// 	}).appendTo("nav select");
	// });
	// // To make dropdown actually work
	// $("nav select").change(function() {
	// 	window.location = $(this).find("option:selected").val();
	// });


	// Responsive Menu Toggle	
	// $("a#sidemenu").toggle(function() {
	// 	$("#responsive_menu").show();
	// 	$("#wrapper").show().animate({
	// 		marginLeft: "-=240px"
	// 	}, 300);
	// 	$(this).addClass("active");
	// 	return false;
	// }, function() {
	// 	$("#wrapper").animate({
	// 		marginLeft: "0"
	// 	}, 300);
	// 	$("#responsive_menu").hide();
	// 	$(this).removeClass("active");
	// });

	// $(window).resize(function(){
	// 	var w = $(this).width();
	// 	if(w > 767) {
	// 		$("#wrapper").removeAttr('style');
	// 		$("a#sidemenu").removeClass("active");
	// 	}
	// });


	// Back to Top
	// $("#backtotop").click(function () {
	// 	$("html, body").animate({scrollTop: 0}, 1000);
	// });


	// Set Timeout
	// setTimeout(function() {
	// 	$("nav").css("margin-top", "-500px").delay(1800).animate({
	// 		marginTop: "27px"
	// 	}, 1000);
	// }, 7000);


	// Scroll To Div
	// $("a#the-how-button").click(function() {
	//     $("html, body").animate({
	// 		scrollTop: $("#the-how").offset().top
	//     }, 1600, "easeInOutQuint");
	//     return false;
	// });


	//ipad and iphone fix
	//if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i))) {
	    // Content Here....
	//}


	// Browser Size Relocation
	// if ( (screen.width < 1024) && (screen.height < 768) ) { 
	// 	window.location = 'http://mobile.site.com';
	// }


	// Paralax
	// $(window).bind('scroll',function(e){
	//     parallaxScroll();
	// });
	 
	// function parallaxScroll(){
	//     var scrolled = $(window).scrollTop();
	//     $("#header_contents").css('top',(0-(scrolled*.51))+'px');
	// }


	// Match Height
	// var col1Height = $("#column_one").outerHeight();
	// $("#column_two").css('height', col1Height + 'px');


	// Panel Toggle
	// $("#dropdown_box").hide();
	// $(".dropdown").click(function() {
	// 	$(this).toggleClass("dropdown_button_active");
	// 	$("#dropdown_box").slideToggle(400);
	// 	return false;
	// });

	
	// Simulate Click
	// $("a#openGallery").click(function(e) {
	// 	e.preventDefault();
	// 	$("#gallery_images ul li:first-child a").click();
	// });

	// Simulate Click with KeyPress
	// $(window).keydown(function(e) {
	//     if ( e.keyCode === 77 ) {
	//         $("a#mainMenu").click();       
	//     }
	// });

	// $("input, textarea").keydown(function(e) {
	//     e.stopPropagation();       
	// });


	// Delay Function
	// function paralaxLoad() {
	// 	$(".row").fadeOut(200);
	// }
	// setTimeout(paralaxLoad, 5000);	


	// Panel Toggle
	// $("#reservations_button a").toggle(function() {
	// 	$("#reservations").show().animate({
	// 		marginTop: "-5px"
	// 	}, 600, "easeInOutQuint");
	// 	return false;
	// }, function() {
	// 	$("#reservations").animate({
	// 		marginTop: "-300px"
	// 	}, 600, "easeInOutQuint");
	// });


	// iPAD Video Controls
	// $("#play").click(function(){
	//    document.getElementById('video01').play();
	// 	return false;
	// });

	// $("#stop").click(function(){
	//    document.getElementById('video01').pause();
	// 	return false;
	// });


	// Opacity Hover
	// $(".promo_image").hover(function() {
	// 		$(this).stop().fadeTo(200, 0.7);
	//	}, function() {
	// 		$(this).stop().fadeTo(300, 1.0);
	// });


	// Fade Out Others on Rollover
	// if($("html").hasClass('no-touch')){
	// 	$(".portfolio-thumb, .image-thumb, .service-item").hover(function(){
	// 		$(this).siblings().addClass('fade');
	// 	}, function(){
	// 		$(this).siblings().removeClass('fade');
	// 	});
	// }


	// Form Validate Script
	// $("#subForm").validate();
	// $("#emailForm").validate();
	// $("#loginForm").validate();
	// $("#contactForm").validate();

	// Form Validation for Phone Numbers - accepts numbers and spaces
	// $.validator.addMethod("phoneNumber", function(value, element) {
	//     return this.optional(element) || /^[0-9\-\+\s]+$/i.test(value);
	// }, "Phone number must contain only numbers, spaces or dashes.");

	// $("#contactForm").validate({
	//     rules: {
	//         "phone": {
	//             required: true,
	//             phoneNumber: true,
	//         }
	//     },
	//     messages: {
	//         "phone": {
	//             required: "You must enter a phone number.",
	//             phoneNumber: "Phone number format not valid."
	//         }
	//     }
	// });


	// Campaign Monitor Subscribe Form Ajax
	// $("#subForm").submit(function (e) {
	// 	e.preventDefault();
	// 	$.getJSON(
	// 	this.action + "?callback=?",
	// 	$(this).serialize(),
	// 	function (data) {
	// 		if (data.Status === 400) {
	// 			alert("Error: " + data.Message);
	// 		} else { // 200
	// 			alert("Success: " + data.Message);
	// 		}
	// 	});
	// });


	// Siblings
	// $("#content .box").hover(function() {
	// 	$(this).siblings().css({'opacity': '0.3'});
	// 	$(this).css({'opacity': '1.0'});
	// });


	// Children
	// $("#content").mouseleave(function () {
	// 	$(this).children().fadeTo("fast", 1.0);	
	// });


	// Scroll to Top
	// $("a[href=#container]").click(function(){
	// 	$("html, body").animate({ scrollTop:0 }, 800);
	// 	return false;
	// });


	// Select Box Go To URL
	// $(".selectbox").bind('change', function () {
	// 	var url = $(this).val();
	// 	if (url) {
	// 		window.location = url;
	// 	}
	// 	return false;
	// });


	// Hover Captions
	// $("ul.portfolio li").hover(function() {
	// 	$(this).find(".portfoliotext").stop().animate({
	// 		bottom: "0"
	// 	}, 600);
	// }, function() {
	// 	$(this).find(".portfoliotext").stop().animate({
	// 		bottom: "-35px"
	// 	}, 600);
	// });


	// Block Clickable
	// $("ul.portfolio li").click(function() {
	// 	window.location = $(this).find("a").attr("href");
	// 	return false;
	// });


	// Popup with Clickable Close Background
	// $("#video_button a").click(function(){
	// 	$("#video_popup").fadeOut(600);
	// 	document.getElementById("VistaVideo01").pause();
	// 	return false;
	// });

	// $("#home_video").click(function(e){
	// 	e.stopPropagation();
	// });


	// Hide Mailto Email Addresses
	// jQuery.fn.mailto = function() {
	//     return this.each(function() {
	//         var email_add = $(this).attr("href").replace(/\s*\(.+\)\s*/, "@");
	//         var email_text = $(this).html();
	//         $(this).before('<a href="mailto:' + email_add + '" rel="nofollow" title="Email ' + email_add + '">' + email_text + '</a>').remove();
	//     });
	// };

	// $(".email").mailto();
	// Email Address format <a href="email(at)sdiodsoidsjoi.com" class="email" title="">email us</a>


	// Window Scrollbar on and off
	// function resize() {
	// 	if ($(window).width() > 990) {
	// 		$("html").css({
	// 			"overflow-x": "hidden"
	// 		});
	// 	} else {
	// 		$("html").css({
	// 			"overflow-x": "auto"
	// 		});
	// 	}
	// }
	// $(document).ready(resize);
	// $(window).resize(resize);


	// Calculate Height of Object
	//var footerHeight = $("footer");
	//$("footer").css("margin-top", function() { return -$(this).outerHeight() });


	// Toggle Click Box
	// $("#register_box").hide();
	// $("a#registerarea").toggle(function() {
	// 	$("#register_box").fadeTo("fast", 1.0);
	// 	return false;
	// }, function() {
	// 	$("#register_box").fadeTo("slow", 0.0);
	// 	return false;
	// });


	// Pulse text Unlimited Times
	// function pulsate() {
	// 	$(".pulsate").
	// 		animate({opacity: 0.2}, 1000, 'linear').
	// 		animate({opacity: 1}, 1000, 'linear', pulsate);
	// 	}
 //  	pulsate();
	// Pulse text Limited Times
	// var i = 0;
	// function pulsate() {
	// 	if(i >= 3) return;
	// 	$(".pulsate").
	// 		animate({opacity: 0.2}, 1000, 'linear').
	// 		animate({opacity: 1}, 1000, 'linear', pulsate);
	// 		i++;
	// 	}
	// pulsate();


	// Animate Height
	//$("header").delay(300).animate({ height: "60px" }, 500);


	// Replace Div Content
	//var teamMember = $(this).attr("href");
	//$("#column_two").load(teamMember).hide().fadeTo(500, 1.0);


	// Waypoints Animate Menu From Top
	// $("#menu").waypoint(function (direction) {
	// 	if (direction=='down')
	// 		$("nav").animate({
	// 			marginTop: "0"
	// 		}, 400);
	// 	else {
	// 		$("nav").animate({
	// 			marginTop: "-60px"
	// 		}, 400); 
	// 	}
	// 	}, {
	// 	//offset: $.waypoints('viewportHeight') / 2
	// 	offset: 0	    
	// });


	// Fix Navigation After 100% Height
	// $(window).bind('scroll', function() {
	// 	var navHeight = $(window).height();
	// 	if ($(window).scrollTop() > navHeight) {
	// 		$("nav").addClass('fixed');
	// 	}
	// 	else {
	// 		$("nav").removeClass('fixed');
	// 	}
	// });


	// Fix Nav When Screen Scrolls
	// var offset = $("header").offset();
	// $(window).scroll(function () {  
	// var scrollTop = $(window).scrollTop();
	// 	if (offset.top < scrollTop) {
	// 		$("header").addClass("fixed");
	// 	} else {
	// 		$("header").removeClass("fixed");
	// 	}
	// });


	// Gallery Cycle Code
	// $("#main_image").cycle({
	// 	fx: "fade",
	// 	speed: 700,
	// 	timeout: 4000,
	// 	pause: 1
	// });


	// Current screen width indicator
	// $(window).resize(function() {
	// 	var windowWidth = $(window).width();
	// 	$(".screen-width").text(windowWidth + 'px');
	// });


	// Gallery Script
	// $(".thumbnails a").click(function() {
	// 	var largePath = $(this).attr("href");
	// 	$("#largeImg").attr({
	// 		src: largePath
	// 	}).hide().fadeIn(500);
	// 	return false;
	// });


	// Background Stretch
	// $.backstretch("/web/images/backgrounds/01.jpg");

	// $.backstretch([
	// 	"/web/images/backgrounds/01.jpg",
	// 	"/web/images/backgrounds/02.jpg",
	// 	"/web/images/backgrounds/03.jpg",
	// 	"/web/images/backgrounds/04.jpg"
	// ], {duration: 4000, fade: 900});


	// Hover Image Fade In and Out
	// $(".image_list li img").fadeTo("slow", 0.4);
	// $(".image_list li img").hover(function() {
	// 	$(this).stop().fadeTo("slow", 1.0);
	// }, function() {
	// 	$(this).stop().fadeTo("slow", 0.4);
	// });


	// iFrame Embed z-index Fix
	// $("iframe").each(function(){
	// 	var url = $(this).attr("src");
	// 	var char = "?";
	// 	if(url.indexOf("?") != -1){
	// 		var char = "&";
	// 	}
	// 	$(this).attr("src",url+char+"wmode=transparent");
	// });


	
	// MouseOver Examples
	// $(".cont-25 , .cont-30 , .cont-40 , .cont-50 , .cont-60 , .cont-70 ,.cont-80 , .cont-100, .cont-social, .articoli").mouseover(function() {
	// 	$(this).find("img").stop().transition({ scale: 1.05 }, 600);
	// 	$(this).find("h1").stop().css({ "color": "#b19460" });
	// 	$(this).find(".title_articoli").stop().css({ "color": "#b19460" });
	// 	$(this).find(".shadows").stop().animate({ opacity: 0.65 }, 600);
	// 	$(this).find(".border").stop().fadeTo(600, 1 );
	// 	$(this).find("#richiesta-acquisto").stop().fadeTo(600, 1 );
	
	//  });
	
	// MouseLeave Examples
	// $(".cont-25 , .cont-30 , .cont-40 , .cont-50 , .cont-60 , .cont-70 ,.cont-80 , .cont-100, .cont-social, .articoli").mouseleave(function(){
	// 	$(this).find("img").stop().transition({ scale: 1 }, 600);
	// 	$(this).find("h1").stop().css({ "color": "#fff" });
	// 	$(this).find(".title_articoli").stop().css({ "color": "#fff" });
	// 	$(this).find(".shadows").stop().animate({ opacity: 0.15 }, 600);
	// 	$(this).find(".border").stop().fadeTo(600, 0 );
	// 	$(this).find("#richiesta-acquisto").stop().fadeTo(600, 0 );
	// });

	
	// Match Document Height
	// $("#bkimg_container").css({'height':(($(document).height())) +'px'});


	// Reload Page on Window Resize
	// $(window).resize(function(){
	//       window.location.reload();
	// });


	// Load URL into Layer - Ideal for loading text into boxes
	// 	// When page loads
	// 	$("#press_column_two").load("/dakota/hotel-press/articles/upping-the-ante.html");
	// 	$("ul.press_list li a:first").addClass("active");

	// 	$("ul.press_list li a").click(function() {

	// 		// Press Links
	// 		var pressURL = $(this).attr("href");

	// 		$("ul.press_list li a").removeClass("active");
	// 		$(this).addClass("active");
	// 		$("#press_column_two").load(pressURL).hide().fadeTo(500, 1.0);
	// 		return false;
	// 	});


	// Accordion Brands Menu
	// $(function() {

	// 	$("#brands_accordion h2").click(function() {

	// 		$(this).removeClass("on");

	// 		$(".accordion_content").slideUp("normal");

	// 		if ($(this).next().is(":hidden") == true) {
	// 			$("#brands_accordion h2").removeClass("on");
	// 			$(this).addClass("on");
	// 			$(this).next().slideDown("normal");
	// 		}

	// 	});

	// 	$(".accordion_content").hide();

	// });


	// Minus Margin Click Box
	// $("#home").click(function() {
	// 	$("#right_col_contents").animate({
	// 		marginLeft: "0px"
	// 	}, 500);
	// });


	// Minus Margin Hover Box
	// $("ul.sub_navigation li").hover(function() {
	// 	$(this).animate({
	// 		marginLeft: "5px"
	// 	}, 200);
	// }, function() {
	// 	$(this).animate({
	// 		marginLeft: "0"
	// 	}, 300);
	// });


	// Fade Toggle Plugin
	// jQuery.fn.fadeToggle = function(speed, easing, callback) {
	// 	return this.animate({
	// 		opacity: "toggle"
	// 	}, speed, easing, callback);
	// };
	// $(function() {
	// 	$("#popup_hidden_area").hide();
	// 	$("a#hiddenbox").click(function() {
	// 		$("#popup_hidden_area").fadeToggle("slow");
	// 		return false;
	// 	});
	// });


	// Auto Complete - Requires jQuery UI Library http:jqueryui.com/download
	// var santas = ["Jane", "Lisa", "Lynne", "Matt", "Thomas", "Tim"]

	// $(function() {
	// 	$("#name").autocomplete({
	// 		source: santas
	// 	});
	// });


	// IF Statement
	// if ($("#media_carousel li").length > 1) {
	// 	Function Statement
	// }


	// Animate Span on Hover
	// $("#home, #menu a").hover(function() {
	// 	$(this).find("span span").stop().animate({
	// 		paddingRight: 25
	// 	}, 200);
	// }, function() {
	// 	$(this).find("span span").stop().animate({
	// 		paddingRight: 15
	// 	}, 300);
	// });


	// Add/Remove Class From Multiple Items
	// jQuery.fn.sclear = function() {
	// 	$("a#s1, a#s2, a#s3, a#s4, a#s5, a#s6").removeClass("active");
	// };
	// $(function() {
	// 	$("#prod_column_one h3").click(function() {
	// 		$(this).sclear();
	// 	});
	// });


	// Delay Loading new page after clicking link
	// $("nav ul#dkhome li a").click(function() {
	// 	$("nav").animate({
	// 		marginTop: "-500px"
	// 	}, 800);
	// 	var href = $(this).attr("href");
	// 	setTimeout(function() {
	// 		window.location = href
	// 	}, 800);
	// 	return false;
	// });


	// Prevent Default
	// $("a").click(function(event) {
	// 	alert("As you can see, the link no longer took you to jquery.com");
	// 	event.preventDefault();
	// });


	// Add Class to Link Type
	// $("a[@href$=pdf]").addClass("pdf");
	// $("a[@href$=zip]").addClass("zip");
	// $("a[@href$=psd]").addClass("psd");


});

// End Scripts --------------------------------------------------------------- //


