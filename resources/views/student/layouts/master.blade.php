<!DOCTYPE HTML>
<html>
	<head>
        @yield('title')
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="icon" href="{{ asset('asset1/images/diamond.png') }}">
		<link rel="stylesheet" href="{{ asset('asset3/css/main.css') }}" />
		<!-- bootstrap cdn link -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        {{-- fontawesome cdn --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

		<style>
            .bg-pale{
                background-color: #fafafa;
            }

            .text-green {
                color: #00aa1a;
            }

            .border-green {
                border-color: #00aa1a;
            }

			@media(min-width: 981px){
				.nav-none{
					display: block;
				}

				.nav-sm-none{
					display: none;
				}
			}

			@media(max-width: 980px){
				.nav-none{
					display: none;
				}

				.nav-sm-none{
					display: block;
				}
			}
		</style>
	</head>
	<body class="is-preload">
		<nav class="navbar navbar-expand-lg bg-body-tertiary nav-sm-none ">
            <div class="container-fluid">
                <a class="navbar-brand image px-3" href="{{ route('student#dashboard') }}">Education Platform</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                @yield('nav-sm')

            </div>
          </nav>

        <!-- Header -->
			<header id="header">
                <form id="myForm" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                    <input type="submit" value="Logout">
                </form>
				<div class="inner">
					<h3><strong>{{ Auth::user()->name }}</strong></h3>
					<p class="mt-2"><strong>{{ Auth::user()->email }}</strong></p>
                    <a href="{{ route('student#profilePage') }}" class="image avator"><img class="border border-white" src="@if (empty(Auth::user()->profile) && Auth::user()->gender == "male"  || Auth::user()->gender == null)
                        {{ asset('asset2/images/unknown_male.png') }}
                    @elseif (empty(Auth::user()->profile) && Auth::user()->gender == "female")
                        {{ asset('asset2/images/unknown_female.png') }}
                    @else
                        {{ asset('storage/students/'.Auth::user()->profile) }}
                    @endif" alt="" height="150px"/></a>
                    <p class="text-capitalize">@if (Auth::user()->education == "scnd")
                        Some college but no degree
                    @elseif (Auth::user()->education == "ad")
                        Associate Degree
                    @elseif (Auth::user()->education == "bd")
                        Bachelor's Degree
                    @elseif (Auth::user()->education == "md")
                        Master's Degree
                    @else
                        Undergraduate
                    @endif</p>
					@if (! Auth::user()->description)
                        <p class="">Enter Your Info ... Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, iure explicabo alias commodi neque ratione voluptatem delectus expedita nemo iusto facilis aliquid impedit error libero nisi ea voluptates magni eaque.</p>
                    @else
                        <p>{{ Auth::user()->description }}</p>
                    @endif
                    <small>Joined in {{ Auth::user()->created_at->format('M jS, o') }}</small>
				</div>
			</header>

		<!-- Main -->
			<div id="main">
				<nav class="navbar navbar-expand-lg bg-body-tertiary nav-none ">
					<div class="container-fluid">
                        <a class="navbar-brand image px-3" href="{{ route('student#dashboard') }}">Education Platform</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        @yield('nav')

                        <div class="text-end">
                            <a href="{{ route('student#discussionPage') }}" title="Discussion" class="mt-3 border-0 bg-pale"><img src="{{ asset('asset3/css/images/messenger.png') }}" width="50px" alt=""></a>
                            <a href="#" onclick="document.getElementById('myForm').submit(); return false;" title="Logout"><img src="{{ asset('asset3/css/images/logout.png') }}" class="image bg-pale" alt="" width="25px"></a>
                        </div>
					</div>
				  </nav>

                  @yield('content')
			</div>

		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					<ul class="icons">
						<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon brands fa-github"><span class="label">Github</span></a></li>
						<li><a href="#" class="icon brands fa-dribbble"><span class="label">Dribbble</span></a></li>
						<li><a href="#" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; Education Platform</li><li>2023 All Rights Reserved</a></li>
					</ul>
				</div>
			</footer>
		<!-- Scripts -->
			<script src="{{ asset('asset3/js/jquery.min.js') }}"></script>
			<script src="{{ asset('asset3/js/jquery.poptrox.min.js') }}"></script>
			<script src="{{ asset('asset3/js/browser.min.js') }}"></script>
			<script src="{{ asset('asset3/js/breakpoints.min.js') }}"></script>
			<script src="{{ asset('asset3/js/util.js') }}"></script>
			<script src="{{ asset('asset3/js/main.js') }}"></script>

			<!-- bootstrap cdn js -->
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
            {{-- fontawesome js --}}
            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

            @yield('script')
	</body>
</html>
