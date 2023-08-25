<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Broken Reality Comics</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anton&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Changa+One:400,400i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Iceberg&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{ url('fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ url('fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('fonts/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ url('fonts/fontawesome5-overrides.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/Contact-Form-Clean.css') }}">
    <link rel="stylesheet" href="{{ url('css/Customizable-Background--Overlay.css') }}">
    <link rel="stylesheet" href="{{ url('css/Features-Cards-icons.css') }}">
    <link rel="stylesheet" href="{{ url('css/Footer-Dark.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{ url('css/Navigation-Clean.css') }}">
    <link rel="stylesheet" href="{{ url('css/Newsletter-Subscription-Form.css') }}">
    <link rel="stylesheet" href="{{ url('css/Simple-Slider-swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/Team-Clean.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
            integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
            crossorigin="anonymous">
    </script>
</head>
<body class="bg-black">
<nav class="navbar navbar-light navbar-expand-lg sticky-top shadow-lg navigation-clean" style="background: rgb(0,0,0);">
    <div class="container-fluid"><a class="navbar-brand" href="/" style="color: rgb(255,255,255);font-family: Lato, sans-serif;font-size: 23px;font-weight: bold;">BROKEN REALITY COMICS</a><button data-bs-toggle="collapse" class="navbar-toggler text-start" data-bs-target="#navcol-2" style="border-color: rgb(0,0,0);"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon" style="color: rgb(255,255,255);border-color: rgb(255,255,255);background: rgba(33,37,41,0);text-align: left;"><i class="fa fa-navicon" style="font-size: 30px;"></i></span></button>
        <div class="collapse navbar-collapse" id="navcol-2">
            <ul class="navbar-nav navbar-nav-scroll mx-auto">
                <li class="nav-item text-end"><a class="nav-link" href="/store" style="color: var(--bs-white);font-size: 18px;font-family: 'Open Sans', sans-serif;">Comic Book Store</a></li>
                <li class="nav-item text-end"><a class="nav-link" href="https://www.redbubble.com/people/BRCStore/shop" style="color: var(--bs-white);font-size: 18px;font-family: 'Open Sans', sans-serif;">Merch Store</a></li>
                <li class="nav-item text-end"></li>
                <li class="nav-item dropdown" style="background: rgba(255,255,255,0);"><a class="dropdown-toggle nav-link text-end" aria-expanded="false" data-bs-toggle="dropdown" href="#" style="font-size: 18px;font-family: 'Open Sans', sans-serif;color: rgb(255,255,255);">Shop by Series</a>
                    <div class="dropdown-menu dropdown-menu-end text-end" style="background: #000000;">
                        <a class="dropdown-item" href="/store/store-alexiamidnight" style="font-family: 'Open Sans', sans-serif;color: rgb(255,255,255);font-size: 13px;">Alexia Midnight</a>
                        <a class="dropdown-item" href="/store/store-brokenrealities" style="color: rgb(255,255,255);font-size: 13px;font-family: 'Open Sans', sans-serif;">Broken Realities</a>
                        <a class="dropdown-item" href="/store/store-chaostheory" style="color: rgb(255,255,255);font-size: 13px;font-family: 'Open Sans', sans-serif;">Chaos Theory</a>
                        <a class="dropdown-item" href="/store/store-chronicrangers" style="color: rgb(255,255,255);font-size: 13px;font-family: 'Open Sans', sans-serif;">Chronic Rangers</a>
                        <a class="dropdown-item" href="/store/store-eoa" style="color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;font-size: 13px;">Elements Of Agony</a>
                        <a class="dropdown-item" href="/store/store-escapethepit" style="color: rgb(255,255,255);font-size: 13px;">Escape The Pit</a>
                        <a class="dropdown-item" href="/store/store-godpunk" style="color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;font-size: 13px;">Godpunk</a>
                        <a class="dropdown-item" href="/store/store-legends" style="color: rgb(255,255,255);font-size: 13px;">Legends</a>
                        <a class="dropdown-item" href="/store/store-saint" style="color: rgb(255,255,255);font-size: 13px;">Saint</a>
                        <a class="dropdown-item" href="/store/store-shadow" style="color: rgb(255,255,255);font-size: 13px;">Shadow</a>
                        <a class="dropdown-item" href="/store/store-thealpha" style="color: rgb(255,255,255);font-size: 13px;">The Alpha</a>
                        <a class="dropdown-item" href="/store/store-tsds" style="color: rgb(255,255,255);font-size: 13px;">TSDS</a>
                    </div>
                </li>
                <li class="nav-item dropdown"><a class="dropdown-toggle nav-link text-end" aria-expanded="false" data-bs-toggle="dropdown" href="#" style="font-size: 18px;font-family: 'Open Sans', sans-serif;color: rgb(255,255,255);">More!</a>
                    <div class="dropdown-menu text-end" style="font-size: 13px;background: rgb(0,0,0);">
                        <a class="dropdown-item" href=/about-us style="color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;">About Us</a>
                        <a class="dropdown-item" href="/brc-newsletter" style="color: rgb(255,255,255);">BRC Newsletter</a>
                    </div>
                </li>
                <li class="nav-item text-end">
                    <a class="nav-link ec_ejc_thkbx " style="color: var(--bs-white);font-size: 18px;font-family: 'Open Sans', sans-serif;"
                        href="https://www.e-junkie.com/ecom/gb.php?c=cart&ejc=2&cl=382587"
                        target="ej_ejc"
                        onclick="return EJEJC_lc(this);"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-cart-fill">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>
</body>
<footer class="footer-dark" style="background: rgb(0, 0, 0); padding-top: 30px; padding-bottom: 30px;">
    <div class="container">
        <div class="row g-0 text-center justify-content-center align-items-center">
            <div class="col-4 col-sm-3 col-md-3 col-lg-2 col-xl-2 align-self-center item">
                <div>
                    <a href="/">
                        <img class="img-fluid" src="{{ url('img/br_admin/hexa_final_1.webp') }}" width="80%" alt="BRC Hex logo">
                    </a>
                </div>
            </div>
            <div class="col-5 col-sm-5 col-md-3 col-lg-3 col-xl-3 col-xxl-2 offset-md-1 offset-lg-1 offset-xl-1 align-self-center item" style="font-family: Lato, sans-serif;color: rgb(255,255,255);">
                <ul class="list-unstyled text-center text-white">
                    <li class="text-center" style="font-size: 16px;">
                        <div><a href="/store" style="font-family: 'Open Sans', sans-serif;">Comic Book Store</a></div>
                    </li>
                    <li class="text-center" style="font-size: 16px;">
                        <div><a href="https://www.redbubble.com/people/brcstore/shop" style="font-family: 'Open Sans', sans-serif;">Merch Store</a></div>
                    </li>
                    <li class="text-center" style="font-size: 16px;">
                        <div><a href="/about-us" style="font-family: 'Open Sans', sans-serif;">About Us</a></div>
                    </li>
                </ul>
            </div>
            <div class="col-lg-2 col-xl-2 offset-lg-1 offset-xl-0 align-self-center item social">
                <a href="https://www.facebook.com/ThExpanse1/">
                    <i class="icon ion-social-facebook">

                    </i>
                </a>
                <a href="https://www.instagram.com/brokenrealitycomics/">
                    <i class="icon ion-social-instagram">

                    </i>
                </a>
                <a href="https://www.kickstarter.com/projects/legends-tableflip/the-expanse-1?ref=6fu64q&amp;token=fc2d1ba9">
                    <i class="fab fa-kickstarter"></i>
                </a>
            </div>
        </div>
        <p class="lead text-center" style="color: rgb(187, 187, 187);font-size: 13px; margin-top: 20px; font-family: 'Open Sans', sans-serif;">Broken Reality Comics © 2023</p>
    </div>
</footer>
<script type="text/javascript">function EJEJC_lc(th) { return false; } </script>
<script src="https://www.fatfreecartpro.com/ecom/box_fb_n.js" type="text/javascript"></script>
<script src="{{ url('js/bs-init.js') }}"></script>
<script src="{{ url('js/bootstrap.min.js') }}"></script>
<script src="{{ url('js/aos.min.js') }}"></script>
<script src="{{ url('js/smart-forms.min.js') }}"></script>
<script src="{{ url('js/Simple-Slider-swiper-bundle.min.js') }}"></script>
<script src="{{ url('js/Simple-Slider.js') }}"></script>
<script src="{{ url('js/Swipe-Slider-7.js') }}"></script>
</html>
