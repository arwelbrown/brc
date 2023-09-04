@extends('layouts.app')
@section('content')
<section class="py-2" style="border-color: rgb(0,0,0);background: #000000;">
    <div class="container-fluid">
        <div 
            class="text-center border rounded border-0 d-flex flex-column justify-content-center align-items-center p-4 py-5"
            style="background: linear-gradient(rgba(36,0,52,0.62) 0%, rgb(0,0,0) 88%), url({{ url('img/br_admin/Broken_Reality_Banners.webp') }}) center / cover no-repeat;"
        >
            <div class="row justify-content-center">
                <div class="col-12 col-sm-9 col-md-7 col-lg-5 align-self-center" data-aos="fade-up">
                    <img class="img-fluid" data-aos="fade-up" src="{{ asset('/img/br_admin/hexa_final_1.webp') }}" width="100%" style="margin-bottom: 15px;margin-top: 15px;">
                    <p class="text-center" data-aos="fade-down" style="font-family: Anton, sans-serif;color: rgb(255,255,255);font-size: 40px;letter-spacing: 1px;margin-bottom: 0px;">JOIN THE NEW REALITY!</p>
                    <p class="text-center" data-aos="fade-down" style="font-family: 'Open Sans', sans-serif;color: rgb(255,255,255);font-size: 30px;letter-spacing: 1px;">#BRUNIVERSE</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="border-0 newsletter-subscribe py-4 py-xl-5" style="background: linear-gradient(#000000 0%, rgb(18,21,24) 53%), rgb(0,0,0);">
    <div class="container">
        <div class="row mb-2">
            <div class="col-8 col-sm-10 col-md-9 col-lg-8 col-xl-7 text-center mx-auto" style="color: rgb(49, 52, 55);">
                <h2 class="display-6 fw-bold" data-aos="fade-up" style="color: rgb(255,255,255);font-family: Anton, sans-serif;letter-spacing: 2px;">SUBSCRIBE TO THE BRC NEWSLETTER</h2>
                <p class="text-white" data-aos="fade-down" style="font-family: 'Open Sans', sans-serif;">
                    Subscribe to our official monthly newsletter to get exclusive announcement, perks, discounts and more!
                </p>
            </div>
        </div>
        <form class="d-flex justify-content-center flex-wrap" data-aos="fade" data-bss-recipient="374f101e2d84c85fe299372a6799c332" data-bss-subject="Thank You for Subscribing!">
            <div class="mb-3">
                <label for="email" hidden></label>
                <input class="form-control" id="email" type="email" name="email" placeholder="Your Email">
            </div>
            <div class="mb-3">
                <button class="btn btn-primary ms-2" type="submit" style="background: var(--bs-blue);">Subscribe</button>
            </div>
        </form>
    </div>
    <hr>
    <section>
        <hr>
        <div class="container-fluid">
            <div class="row justify-content-center" style="margin-top: 50px;">
                <div class="col-md-6 align-self-center" data-aos="fade-up">
                    <div class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000" data-bs-pause="false" id="carousel-1">
                        <div class="carousel-inner">
                            <div class="carousel-item active"><img class="img-fluid w-100 d-block" src="{{ url('img/br_admin/Home_Page_Banner_1.webp') }}" alt="Slide Image"></div>
                            <div class="carousel-item"><img class="img-fluid w-100 d-block" src="{{ url('img/br_admin/Home_Page_Banner_2.webp') }}" alt="Slide Image"></div>
                            <div class="carousel-item"><img class="img-fluid w-100 d-block" src="{{ url('img/br_admin/Home_Page_Banner_3.webp') }}" alt="Slide Image"></div>
                        </div>
                        <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span><span class="visually-hidden">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button" data-bs-slide="next"><span class="carousel-control-next-icon"></span><span class="visually-hidden">Next</span></a></div>
                        <div class="carousel-indicators"><button type="button" data-bs-target="#carousel-1" data-bs-slide-to="0" class="active"></button> <button type="button" data-bs-target="#carousel-1" data-bs-slide-to="1"></button> <button type="button" data-bs-target="#carousel-1" data-bs-slide-to="2"></button></div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-5 col-xxl-4 text-start" data-aos="fade-down">
                    <h1 style="font-family: Anton, sans-serif;letter-spacing: 2px;color: rgb(250,252,255);margin-top: 20px;text-align: center;">ANNOUNCEMENTS!</h1>
                    <p style="font-family: 'Open Sans', sans-serif;color: rgb(175,182,188);">- Dive into The NEW BRC Multiverse!</p>
                    <p style="font-family: 'Open Sans', sans-serif;color: rgb(175,182,188);">- Get Your Latest&nbsp;&nbsp;<a href="https://www.redbubble.com/people/brcstore/shop" style="color: var(--bs-body-bg);">BRC Merch Store Here!</a></p>
                    <p class="text-start" style="font-family: 'Open Sans', sans-serif;color: rgb(175,182,188);">- Follow us on Facebook and Instagram for announcements and more content!</p>
                    <p class="text-start" style="font-family: 'Open Sans', sans-serif;color: rgb(175,182,188);">- Subscribe to our email list and get the official "BRC TIMES" monthly newsletter. This includes sneak peeks of the BRU along with special announcemnts on Broken Reality Comics Latest Releases.&nbsp;</p>
                </div>
            </div>
        </div>
        <hr>
        <h1 data-aos="fade-down" style="font-family: Anton, sans-serif;font-weight: bold;text-align: center;font-size: 36px;margin-top: 50px;letter-spacing: 2PX;"><span style="color: rgb(255, 255, 255);">CHECK OUT THE #BRUNIVERSE FLAGSHIP SERIES!</span></h1>
        <div class="container-fluid" style="margin-top: 20px;max-width: 900px;">
            <div class="row justify-content-center align-items-center" style="margin-bottom: 50px;">
                <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4" data-bss-hover-animate="pulse" style="margin-bottom: 20px;margin-top: 20px;"><a class="d-inline-block" href="/store/universe/bruniverse/brokenrealities"><img class="img-fluid" data-bss-hover-animate="pulse" src="{{ url('img/br_admin/Broken_Reality_ICON.webp')}}"></a></div>
                <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4" data-bss-hover-animate="pulse" style="margin-bottom: 20px;margin-top: 20px;"><a class="d-inline-block" href="/store/universe/bruniverse/elementsofagony"><img class="img-fluid" data-bss-hover-animate="pulse" src="{{ url('img/series_elementsofagony/Kajal_Icon.webp') }}"></a></div>
                <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4" data-bss-hover-animate="pulse" style="margin-bottom: 20px;margin-top: 20px;"><a class="d-inline-block" href="/store/universe/bruniverse/legends"><img class="img-fluid" data-bss-hover-animate="pulse" src="{{ url('img/series_legends/Legends_ICON.webp') }}"></a></div>
                <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4" data-bss-hover-animate="pulse" style="margin-bottom: 20px;margin-top: 20px;"><a class="d-inline-block" href="/store/universe/bruniverse/shadow"><img class="img-fluid" data-bss-hover-animate="pulse" src="{{ url('img/series_shadow/Shadow_Icon.webp') }}"></a></div>
                <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4" data-bss-hover-animate="pulse" style="margin-bottom: 20px;"><a class="d-inline-block" href="/store/universe/bruniverse/chronicrangers"><img class="img-fluid" data-bss-hover-animate="pulse" src="{{ url('img/series_chronicrangers/TheStoner_Icon.webp') }}"></a></div>
                <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4" data-bss-hover-animate="pulse" style="margin-bottom: 20px;"><a class="d-inline-block" href="/store/universe/bruniverse/thealpha"><img class="img-fluid" data-bss-hover-animate="pulse" src="{{ url('img/series_thealpha/The_Alpha_ICON.webp') }}"></a></div>
            </div>
        </div>
    </section>
    <hr>
    <section></section>
    <div class="card-group"></div>
</section>
@endsection
