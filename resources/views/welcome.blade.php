<!DOCTYPE html>
<!--[if lt IE 7]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class='no-js' lang='en'>
	<!--<![endif]-->
	<head>
		<meta charset='utf-8' />
		<meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible' />
		<title>Avenir - Coming Soon</title>

		<link rel="apple-touch-icon" href="{{asset('images/favicon.png')}}" />

		<link rel="stylesheet" href="{{asset('css/maximage.css')}}" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="{{asset('css/styles.css')}}" type="text/css" media="screen" charset="utf-8" />

		<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

		<!--[if IE 6]>
			<style type="text/css" media="screen">
				.gradient {display:none;}
			</style>
		<![endif]-->
	</head>
	<body>

		<!-- Social Links -->
		<nav class="social-nav">
			<ul>
				<li><a href="https://www.facebook.com"><img src="{{asset('images/icon-facebook.png')}}" /></a></li>
			</ul>
		</nav>

		<!-- Switch to full screen -->
		<button class="full-screen" onclick="$(document).toggleFullScreen()"></button>

		<!-- Site Logo -->
		<div id="logo">Vote</div>

		<!-- Main Navigation -->
		<nav class="main-nav">
			<ul>
				<li><a href="#home" class="active">Home</a></li>
				{{-- <li><a href="#about">About</a></li>
				<li><a href="#contact">Contact</a></li> --}}
			</ul>
		</nav>

		<!-- Slider Controls -->
		<a href="" id="arrow_left"><img src="{{asset('images/arrow-left.png')}}" alt="Slide Left" /></a>
		<a href="" id="arrow_right"><img src="{{asset('images/arrow-right.png')}}" alt="Slide Right" /></a>

		<!-- Home Page -->
		<section class="content show" id="home">
			<h1>Welcome</h1>
			<h5>Our new site is coming soon!</h5>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vulputate arcu sit amet sem venenatis dictum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse eu massa sed orci interdum lobortis. Vivamus rutrum.</p>
			<p><a href="#about">More info &#187;</a></p>
		</section>

		{{-- <!-- About Page -->
		<section class="content hide" id="about">
			<h1>About</h1>
			<h5>Here's a little about what we're up to.</h5>
			<p>Nullam quis arcu a elit feugiat congue nec non orci. Pellentesque feugiat bibendum placerat. Nullam eu massa in ipsum varius laoreet. Ut tristique pretium egestas. Sed sed velit dolor. Nam rhoncus euismod lorem, id placerat ipsum placerat nec. Mauris ut eros a ligula tristique lacinia non blandit metus. Sed vitae velit lorem, et scelerisque diam.</p>
			<p><a href="#">Follow our updates on Twitter</a></p>
		</section>

		<!-- Contact Page -->
		<section class="content hide" id="contact">
			<h1>Contact</h1>
			<h5>Get in touch.</h5>
			<p>Email: <a href="#">info@avenir.com</a><br />
				Phone: 123.456.7890<br /></p>
			<p>123 East Main<br />
				New York, NY 12345</p>
		</section> --}}

		<!-- Background Slides -->
		<div id="maximage">
			<div>
				<img src="{{asset('images/backgrounds/bg-img-1.jpg')}}" alt="" />
				<img class="gradient" src="{{asset('images/backgrounds/gradient.png')}}" alt="" />
			</div>
			<div>
				<img src="{{asset('images/backgrounds/bg-img-2.jpg')}}" alt="" />
				<img class="gradient" src="{{asset('images/backgrounds/gradient.png')}}" alt="" />
			</div>
			<div>
				<img src="{{asset('images/backgrounds/bg-img-3.jpg')}}" alt="" />
				<img class="gradient" src="{{asset('images/backgrounds/gradient.png')}}" alt="" />
			</div>
			<div>
				<img src="{{asset('images/backgrounds/bg-img-4.jpg')}}" alt="" />
				<img class="gradient" src="{{asset('images/backgrounds/gradient.png')}}" alt="" />
			</div>
			<div>
				<img src="{{asset('images/backgrounds/bg-img-5.jpg')}}" alt="" />
				<img class="gradient" src="{{asset('images/backgrounds/gradient.png')}}" alt="" />
			</div>
		</div>

		<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js'></script>
		<script src="{{asset('js/jquery.easing.min.js')}}" type="text/javascript" charset="utf-8"></script>
		<script src="{{asset('js/jquery.cycle.all.js')}}" type="text/javascript" charset="utf-8"></script>
		<script src="{{asset('js/jquery.maximage.js')}}" type="text/javascript" charset="utf-8"></script>
		<script src="{{asset('js/jquery.fullscreen.js')}}" type="text/javascript" charset="utf-8"></script>
		<script src="{{asset('js/jquery.ba-hashchange.js')}}" type="text/javascript" charset="utf-8"></script>
		<script src="{{asset('js/main.js')}}" type="text/javascript" charset="utf-8"></script>

		<script type="text/javascript" charset="utf-8">
			$(function(){
				$('#maximage').maximage({
					cycleOptions: {
						fx: 'fade',
						speed: 1000, // Has to match the speed for CSS transitions in jQuery.maximage.css (lines 30 - 33)
						timeout: 5000,
						prev: '#arrow_left',
						next: '#arrow_right',
						pause: 0,
						before: function(last,current){
							if(!$.browser.msie){
								// Start HTML5 video when you arrive
								if($(current).find('video').length > 0) $(current).find('video')[0].play();
							}
						},
						after: function(last,current){
							if(!$.browser.msie){
								// Pauses HTML5 video when you leave it
								if($(last).find('video').length > 0) $(last).find('video')[0].pause();
							}
						}
					},
					onFirstImageLoaded: function(){
						jQuery('#cycle-loader').hide();
						jQuery('#maximage').fadeIn('fast');
					}
				});

				// Helper function to Fill and Center the HTML5 Video
				jQuery('video,object').maximage('maxcover');

			});
		</script>
  </body>
</html>