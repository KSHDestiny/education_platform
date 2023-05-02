<!DOCTYPE HTML>
<html>
	<head>
		<title>Education Platform</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="icon" href="{{ asset('asset1/images/diamond.png') }}">
		<link rel="stylesheet" href="{{ asset('asset1/css/main.css') }}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<noscript><link rel="stylesheet" href="{{ asset('asset1/css/noscript.css') }}" /></noscript>
	</head>
	<body class="is-preload">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center selection:bg-red-500 selection:text-white">

		<!-- Wrapper -->
			<div id="wrapper">
				<!-- Header -->
					<header id="header">
						<div class="logo">
							<span class="icon fa-gem"></span>
						</div>
						<div class="content">
							<div class="inner">
								<h1>Education Platform</h1>
								<p>Welcome to our education platform! Our website is designed to provide you with a comprehensive and engaging learning experience, whether you're a student looking to expand your knowledge or a teacher seeking new resources for your classroom</p>
							</div>
						</div>
						<nav>
							<ul>
								<li><a href="#intro">Intro</a></li>
								<li><a href="#course">Courses</a></li>
								<li><a href="#about">About</a></li>
								<li><a href="#contact">Contact</a></li>
                                <li></li>
							</ul>
						</nav>
                        @if (Route::has('login'))
                        <nav>
                            @auth
                                <ul>
                                    <li><a href="{{ url('/dashboard') }}">Home</a></li>
                                    <li></li>
                                </ul>
                            @else
                                <ul>
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                    @if (Route::has('register'))
                                        <li><a href="{{ route('register') }}">Register</a></li>
                                    @endif
                                </ul>
                            @endauth
                        </nav>
                    @endif
					</header>

				<!-- Main -->
					<div id="main">
						<!-- Intro -->
							<article id="intro">
								<h2 class="major">Introduction</h2>
								<span class="image main"><img src="{{ asset('asset1/images/education.jpg') }}" alt="" /></span>
								<p>Our website is designed to provide you with a comprehensive and engaging learning experience, whether you're a student looking to expand your knowledge or a teacher seeking new resources for your classroom. With a wide range of courses, interactive tools, and personalized learning options, we're committed to helping you achieve your educational goals. Whether you're interested in mastering a new skill, preparing for an exam, or simply exploring a new subject, our platform has everything you need to succeed. Join us today and start your journey towards lifelong learning! <br><a href="#course">Check our courses.</a></p>
							</article>

						<!-- Courses -->
							<article id="course">
								<h2 class="major">Courses</h2>
								<span class="image main"><img src="{{ asset('asset1/images/courses.jpg') }}" alt="" /></span>
								<p>World-Class Learning for Anyone, Anywhere</p>
								<p>The courses feature assignments requiring development of increasingly challenging web sites, to demonstrate basic concepts as they are introduced.  The projects will demonstrate the students skills in HTML, CSS, PHP, SQL, and JavaScript. Launch your career as a full-stack developer. Build job-ready skills for an in-demand career. No degree or prior experience required to get started.</p>
							</article>

						<!-- About -->
							<article id="about">
								<h2 class="major">About</h2>
								<span class="image main"><img src="{{ asset('asset1/images/about.webp') }}" alt="" /></span>
								<p>Education Platform partners with more than 275 leading universities and companies to bring flexible, affordable, job-relevant online learning to individuals and organizations worldwide. We offer a range of learning opportunities—from hands-on projects and courses to job-ready certificates and degree programs.</p>
								<p>We believe Learning is the source of human progress. It has the power to transform our world from illness to health, from poverty to prosperity, from conflict to peace. It has the power to transform our lives for ourselves, for our families, for our communities. No matter who we are or where we are, learning empowers us to change and grow and redefine what’s possible. That’s why access to the best learning is a right, not a privilege. And that’s why Coursera is here. We partner with the best institutions to bring the best learning to every corner of the world. So that anyone, anywhere has the power to transform their lives through learning.</p>
							</article>

                        <!-- Contact -->
							<article id="contact">
								<h2 class="major">Contact</h2>
								<span class="image main"><img src="{{ asset('asset1/images/contact.png') }}" alt="" /></span>
                                <h3>If you need help. Please Contact us.</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia id nemo suscipit minus placeat blanditiis aspernatur, corrupti repellendus nisi quia hic numquam debitis veritatis odit corporis, excepturi velit voluptatibus ducimus.</p>
                                <span style="padding-right: 20px"><a href="tel:09123456789" class="image" title="phone" target="_blank"><i class="fa-solid fa-phone fa-bounce fa-xl"></i></a></span>
								<span style="padding-right: 20px"><a href="mailto:educationplatform@gmail.com" class="image" title="email" target="_blank"><i class="fa-solid fa-envelope fa-bounce fa-xl"></i></a></span>
								<span style="padding-right: 20px"><a href="https://www.facebook.com" class="image" title="facebook" target="_blank"><i class="fa-brands fa-facebook fa-bounce fa-xl"></i></a></span>
								<span style="padding-right: 20px"><a href="https://www.instagram.com/" class="image" title="instragram" target="_blank"><i class="fa-brands fa-instagram fa-bounce fa-xl"></i></a></span>
								<span style="padding-right: 20px"><a href="https://twitter.com" class="image" title="twitter" target="_blank"><i class="fa-brands fa-twitter fa-bounce fa-xl"></i></a></span>
								<span style="padding-right: 20px"><a href="https://github.com/" class="image" title="github" target="_blank"><i class="fa-brands fa-github fa-bounce fa-xl"></i></a></span>
								<p></p>
							</article>
					    </div>

				<!-- Footer -->
					<footer id="footer">
						<p class="copyright">&copy; 2023 Education Platform <a>All &nbsp; Rights &nbsp; Reserved.</a></p>
					</footer>
			</div>

		<!-- BG -->
			<div id="bg"></div>
        </div>
	</body>

    <!-- Scripts -->
	<script src="{{ asset('asset1/js/jquery.min.js') }}"></script>
	<script src="{{ asset('asset1/js/browser.min.js') }}"></script>
	<script src="{{ asset('asset1/js/breakpoints.min.js') }}"></script>
	<script src="{{ asset('asset1/js/util.js') }}"></script>
	<script src="{{ asset('asset1/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>
