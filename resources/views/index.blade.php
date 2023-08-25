@extends('layouts.app')
@section('content')
<section class="py-2" style="border-color: rgb(0,0,0);background: #000000;">
    <div class="container-fluid">
        <div class="text-center border rounded border-0 d-flex flex-column justify-content-center align-items-center p-4 py-5" style="background: linear-gradient(rgba(36,0,52,0.62) 0%, rgb(0,0,0) 88%), url({{ url('img/br_admin/Broken_Reality_Banners.webp') }}) center / cover no-repeat;">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-9 col-md-7 col-lg-5 align-self-center" data-aos="fade-up">
                    <img class="img-fluid" data-aos="fade-up" src="{{ url('img/br_admin/hexa_final_1.webp') }}" width="80%" style="margin-bottom: 15px;margin-top: 15px;" alt="">
                    <p class="text-center" data-aos="fade-down" style="font-family: Anton, sans-serif;color: rgb(255,255,255);font-size: 40px;letter-spacing: 1px;margin-bottom: 0;">JOIN THE NEW REALITY!</p>
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
                <p class="text-muted" data-aos="fade-down" style="font-family: 'Open Sans', sans-serif;">Subscribe to our official monthly newsletter to get exclusive announcement, perks, discounts and more!</p>
            </div>
        </div>
        <form class="d-flex justify-content-center flex-wrap" data-aos="fade" data-bss-recipient="b326dd13401a09b725d2d288751416ea" data-bss-subject="Thank You for Subscribing!">
            <div class="mb-3">
                <label for="email" hidden></label>
                <input class="form-control" id="email" type="email" name="email" placeholder="Your Email">
            </div>
            <div class="mb-3"><button class="btn btn-primary ms-2" type="submit" style="background: var(--bs-blue);">Subscribe </button></div>
        </form>
    </div>
    <h1 data-aos="fade-down" style="font-family: Anton, sans-serif;font-weight: bold;text-align: center;font-size: 36px;margin-top: 50px;letter-spacing: 2PX;">
        <span style="color: rgb(255, 255, 255);">CHECK OUT THE BR-UNIVERSE FLAGSHIP SERIES!</span>
    </h1>
    <section>
        <div class="container" style="margin-top: 20px;">
            <div class="row justify-content-center align-items-center" style="margin-bottom: 50px;">
                <div class="col-6 col-sm-6 col-md-4 col-lg-3" data-bss-hover-animate="pulse" style="margin-bottom: 20px;margin-top: 20px;">
                    <a class="d-inline-block" href="store/store-alexia-midnight">
                        <img class="img-fluid" data-bss-hover-animate="pulse" src="{{ url('img/series_alexiamidnight/Alexia_Midnight_Icon.webp') }}" alt="Alexia Midnight">
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-4 col-lg-3" data-bss-hover-animate="pulse" style="margin-bottom: 20px;margin-top: 20px;">
                    <a class="d-inline-block" href="store/store-brokenrealities">
                        <img class="img-fluid" data-bss-hover-animate="pulse" src="{{url('img/br_admin/Broken_Reality_ICON.webp') }}" alt="Broken Realities">
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-4 col-lg-3" data-bss-hover-animate="pulse" style="margin-bottom: 20px;margin-top: 20px;">
                    <a class="d-inline-block" href="store/store-chaostheory">
                        <img class="img-fluid" data-bss-hover-animate="pulse" src="{{ url('img/br_admin/sinner_icon.webp') }}" alt="Chaos Theory">
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-4 col-lg-3" data-bss-hover-animate="pulse" style="margin-bottom: 20px;margin-top: 20px;">
                    <a class="d-inline-block" href="store/store-eoa">
                        <img class="img-fluid" data-bss-hover-animate="pulse" src="{{ url('img/series_elementsofagony/Kajal_Icon.webp') }}" alt="Elements Of Agony">
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-4 col-lg-3" data-bss-hover-animate="pulse" style="margin-bottom: 20px;margin-top: 20px;">
                    <a class="d-inline-block" href="store/store-godpunk">
                        <img class="img-fluid" data-bss-hover-animate="pulse" src="{{ url('img/series_godpunk/Godpunk_Icon.webp') }}" alt="Godpunk">
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-4 col-lg-3" data-bss-hover-animate="pulse" style="margin-bottom: 20px;margin-top: 20px;">
                    <a class="d-inline-block" href="store/store-legends">
                        <img class="img-fluid" data-bss-hover-animate="pulse" src="{{ url('img/br_admin/Legends_ICON.webp') }}" alt="Legends">
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-4 col-lg-3" data-bss-hover-animate="pulse" style="margin-bottom: 20px;margin-top: 20px;">
                    <a class="d-inline-block" href="store/store-saint">
                        <img class="img-fluid" data-bss-hover-animate="pulse" src="{{ url('img/br_admin/Saint_icon.webp') }}" alt="Saint">
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-4 col-lg-3" data-bss-hover-animate="pulse" style="margin-bottom: 20px;margin-top: 20px;">
                    <a class="d-inline-block" href="store/store-shadow">
                        <img class="img-fluid" data-bss-hover-animate="pulse" src="{{ url('img/br_admin/shadow_icon.webp') }}" alt="Shadow">
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-4 col-lg-3" data-bss-hover-animate="pulse" style="margin-bottom: 20px;">
                    <a class="d-inline-block" href="store/store-chronicrangers">
                        <img class="img-fluid" data-bss-hover-animate="pulse" src="{{ url('img/br_admin/TheStoner_Icon.webp') }}" alt="Super Stoner Chronic Rangers">
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-4 col-lg-3" data-bss-hover-animate="pulse" style="margin-bottom: 20px;">
                    <a class="d-inline-block" href="store/store-thealpha">
                        <img class="img-fluid" data-bss-hover-animate="pulse" src="{{ url('img/br_admin/The_Alpha_ICON.webp') }}" alt="The Alpha">
                    </a></div>
                <div class="col-6 col-sm-6 col-md-4 col-lg-3" data-bss-hover-animate="pulse" style="margin-bottom: 20px;">
                    <a class="d-inline-block" href="store/store-tsds">
                        <img class="img-fluid" data-bss-hover-animate="pulse" src="{{ url('img/br_admin/Sentinels_Icon.webp') }}" alt="T.S.D.S">
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-4 col-lg-3" data-bss-hover-animate="pulse" style="margin-bottom: 20px;margin-top: 20px;">
                    <a class="d-inline-block" href="#">
                        <img class="img-fluid" data-bss-hover-animate="pulse" src="{{ url('img/series_emeraldcoyote/Emerald_Coyote_Icon.webp') }}" alt="The Emerald Coyote">
                    </a>
                </div>
            </div>
        </div>
        <hr>
        <div class="container-fluid">
            <div class="row" style="margin-top: 50px;">
                <div class="col-md-6 align-self-center" data-aos="fade-up">
                    <div class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000" data-bs-pause="false" id="carousel-1">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="img-fluid w-100 d-block" src="{{ url('img/br_admin/Br1_announcement.webp') }}" alt="Slide Image">
                            </div>
                            <div class="carousel-item">
                                <img class="img-fluid w-100 d-block" src="{{ url('img/br_admin/Chronic_Rangers_Announcement.webp') }}" alt="Slide Image">
                            </div>
                            <div class="carousel-item">
                                <img class="img-fluid w-100 d-block" src="{{ url('img/br_admin/BRUniversepodcast_wallpaper.webp') }}" alt="Slide Image">
                            </div>
                        </div>
                        <div>
                            <a class="carousel-control-prev" href="#carousel-1" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-1" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                                <span class="visually-hidden">Next</span>
                            </a>
                        </div>
                        <ol class="carousel-indicators">
                            <li data-bs-target="#carousel-1" data-bs-slide-to="0" class="active"></li>
                            <li data-bs-target="#carousel-1" data-bs-slide-to="1"></li>
                            <li data-bs-target="#carousel-1" data-bs-slide-to="2"></li>
                        </ol>
                    </div>
                </div>
                <div class="col" data-aos="fade-down">
                    <h1 style="font-family: Anton, sans-serif;letter-spacing: 2px;color: rgb(250,252,255);margin-top: 10PX;text-align: center;">ANNOUNCEMENTS!</h1>
                    <p style="font-family: 'Open Sans', sans-serif;color: rgb(175,182,188);">- The kickstarter exclusive 'BROKEN REALITIES #1' is now available on our digital store!</p>
                    <p style="font-family: 'Open Sans', sans-serif;color: rgb(175,182,188);">- Make sure to check out our new&nbsp;<a href="https://www.redbubble.com/people/brcstore/shop">BRC Merch Store!</a></p>
                    <p style="font-family: 'Open Sans', sans-serif;color: rgb(175,182,188);">- Follow us on Facebook and Instagram for announcements and more content!</p>
                    <p style="font-family: 'Open Sans', sans-serif;color: rgb(175,182,188);">- New BRC exclusive Kickstarter campaign "Super Stoner Chronic Rangers" will be launching soon on 04/20/23</p>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section></section>
    <div class="card-group"></div>
    <div class="container-fluid text-center py-4 py-xl-5">
        <div class="row mb-5">
            <div class="col-md-8 col-xl-6 text-center mx-auto" data-aos="fade-down">
                <h1 data-aos="fade-up" style="font-family: Anton, sans-serif;font-weight: bold;text-align: center;font-size: 36px;margin-top: 20px;letter-spacing: 2px;">
                    <span style="color: rgb(255, 255, 255);">BRC AFFILIATED PUBLISHERS</span>
                </h1>
            </div>
        </div>
        <div class="row gy-4 row-cols-md-2 row-cols-xl-3 justify-content-center" data-aos="fade-up">
            <div class="col-lg-4 align-self-center">
                <div class="card bg-dark" style="background: rgba(255,255,255,0);">
                    <div class="card-body p-4" style="background: var(--bs-card-cap-bg);">
                        <img class="img-fluid" src="{{ url('img/other_publishers/ecru_comics/Ecrucomics_Banner.webp') }}" style="margin-bottom: 5px;" alt="Ecru Comics">
                        <a class="card-link" href="store/other-publishers/store-ecrucomics" style="color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;">Ecru Comics &gt;&gt;</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card bg-dark">
                    <div class="card-body p-4">
                        <img class="img-fluid" src="{{ url('img/other_publishers/Flat_Timez/Flat_Timez_Publishing_Web_Banner.webp') }}" style="margin-bottom: 5px;" alt="Flat Timez Publishing">
                        <a class="card-link" href="store/other-publishers/store-awaken" style="font-family: 'Open Sans', sans-serif;color: rgb(255,255,255);">Flat Timez Publishing &gt;&gt;
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card bg-dark">
                    <div class="card-body p-4">
                        <img class="img-fluid" src="{{ url('img/other_publishers/Jrd_comics/JRD_WEB_BANNER.webp') }}" style="margin-bottom: 5px;" alt="JRD Comics">
                        <a class="card-link" href="store/other-publishers/store-saint" style="color: rgb(255,255,255);">JRD Comics &gt;&gt;</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card bg-dark">
                    <div class="card-body p-4">
                        <img class="img-fluid" src="{{ url('img/other_publishers/Lumostation/lumostation_banner.webp') }}" style="margin-bottom: 5px;" alt="Lumostation LLC">
                        <a class="card-link" href="store/other-publishers/store-lumostation" style="color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;">LumoStation LLC &gt;&gt;</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card bg-dark">
                    <div class="card-body p-4">
                        <img class="img-fluid" src="{{ url('img/other_publishers/Zero_Medal/Zero_Medal_Web_Banner.webp') }}" style="margin-bottom: 5px;" alt="Zero Medal Comix">
                        <a class="card-link" href="store/other-publishers/store-zeromedal" style="font-family: 'Open Sans', sans-serif;color: rgb(255,255,255);">Zero Medal Comix &gt;&gt;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
