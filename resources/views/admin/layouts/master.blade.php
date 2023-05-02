<!DOCTYPE HTML>
<html>
	<head>
		@yield('title')
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="icon" href="{{ asset('asset1/images/diamond.png') }}">
		<link rel="stylesheet" href="{{ asset('asset2/css/main.css') }}" />
		<noscript><link rel="stylesheet" href="{{ asset('asset2/css/noscript.css') }}" /></noscript>
		<!-- bootstrap cdn css -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        {{-- fontawesome cdn css --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            .img-invert{
                filter: invert(1);
            }

            @media(max-width: 980px){
                .img-invert{
                    padding-top: 15px;
                    filter: invert(0);
                }
            }
        </style>
	</head>
	<body class="is-preload">
		<!-- Wrapper -->
        <div id="wrapper" class="fade-in">

            @yield('header')

                <!-- Nav -->
            <nav id="nav">
                @yield('navbar')
                <ul class="icons">
                    <li><a href="{{ route('admin#discussionPage') }}" title="Discussion" class="image mt-3"><img src="{{ asset('asset2/images/messenger.png') }}" width="40px" alt=""></a></li>
                    <li><a href="{{ route('myProfile',[Auth::user()->id]) }}" title="Profile" class="image mt-3"><img class="rounded-circle" src="@if (Auth::user()->profile == null && Auth::user()->gender == "male"  || Auth::user()->profile ==null && Auth::user()->gender == null)
                        {{ asset('asset2/images/unknown_male.png') }}
                    @elseif (Auth::user()->profile == null && Auth::user()->gender == "female")
                        {{ asset('asset2/images/unknown_female.png') }}
                    @else
                        {{ asset('storage/'.Auth::user()->profile) }}
                    @endif" width="40px" height="40px" alt=""></a></li>
                    <li class="image mt-3 pb-4">
                        <a href="#" onclick="document.getElementById('myForm').submit(); return false;" title="Logout"><img src="{{ asset('asset2/images/logout.png') }}" class="img-invert" alt="" width="40px"></a>
                    </li>
                </ul>
            </nav>
            <form id="myForm" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                <input type="submit" value="Logout">
            </form>
            <!-- Wrapper -->
            @yield('body')

            <!-- Copyright -->
            <div id="copyright">
                <ul><li>&copy; Education Platform</li><li>2023 All Rights Reserved</li></ul>
            </div>

        </div>
	</body>
    <!-- Scripts -->
	<script src="{{ asset('asset2/js/jquery.min.js') }}"></script>
	<script src="{{ asset('asset2/js/jquery.scrollex.min.js') }}"></script>
	<script src="{{ asset('asset2/js/jquery.scrolly.min.js') }}"></script>
	<script src="{{ asset('asset2/js/browser.min.js') }}"></script>
	<script src="{{ asset('asset2/js/breakpoints.min.js') }}"></script>
	<script src="{{ asset('asset2/js/util.js') }}"></script>
	<script src="{{ asset('asset2/js/main.js') }}"></script>
	<!-- bootstrap cdn js -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    {{-- fontawesome cdn js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @yield("scriptJquery")
</html>
