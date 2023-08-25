@extends ('layouts.app')
@section('content')
    <div class="container-fluid" style="margin-top: 20px;">
        <div class="row g-0">
            <div class="col-md-6 col-lg-12">
                <div data-bss-parallax-bg="true"
                        style="height: 300px;background: linear-gradient(rgba(124,104,241,0.36), #000000 109%), url({{ url('img/br_admin/brc_wallpaper.webp') }}) center / cover no-repeat;">

                </div>
            </div>
        </div>
    </div>
    <div class="row g-0 mb-2" style="margin-top: 20px;">
        <div class="col-8 col-sm-10 col-md-9 col-lg-8 col-xl-7 text-center mx-auto" style="color: rgb(49, 52, 55);">
            <h2 class="display-6 fw-bold" data-aos="fade-up" style="color: rgb(255,255,255);font-family: Anton, sans-serif;letter-spacing: 2px;">SUBSCRIBE TO THE BRC NEWSLETTER</h2>
            <p class="text-muted" data-aos="fade-down" style="font-family: 'Open Sans', sans-serif;margin-top: 20px;">Subscribe to our official monthly newsletter to get exclusive announcement, perks, discounts and more!</p>
        </div>
    </div>
    <form class="d-flex justify-content-center flex-wrap" data-aos="fade" data-bss-recipient="b326dd13401a09b725d2d288751416ea" data-bss-subject="Thank You for Subscribing!" style="margin-top: 20px;">
        <div class="mb-3">
            <label>
                <input class="form-control" type="email" name="email" placeholder="Your Email">
            </label>
        </div>
        <div class="mb-3"><button class="btn btn-primary ms-2" type="submit" style="background: var(--bs-blue);">Subscribe</button></div>
    </form>
    <div class="container" style="text-align: center;color: rgb(255,255,255);font-size: 30px;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-down" data-aos="fade-up" data-aos-delay="200" style="margin-top: 100px;">
            <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"></path>
        </svg></div>
    <div class="container py-4 py-xl-5">
        <div class="row mb-5" style="margin-top: 100px;">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2 class="display-6 fw-bold"
                    data-aos="fade-up"
                    style="color: rgb(255,255,255);font-family: Anton, sans-serif;letter-spacing: 2px;margin-top: 8px;">
                    WELCOME TO THE BRC TIMES!
                </h2>
                <p style="color: rgb(108,117,125);font-family: 'Open Sans', sans-serif;">
                    Enjoy Broken Reality Comics Monthly Newsletter Catalog. Subscribe for exclusive announcement, artwork and more! You can also enjoy&nbsp;
                </p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row text-center" style="margin-bottom: 50px;">
            <div class="col-md-3 align-self-center" style="margin-bottom: 20px;">
                <img class="img-fluid" src="{{ url('img/br_admin/BRC_Times_May2023.webp') }}" width="80%" alt="">
                <p style="font-family: 'Open Sans', sans-serif;color: rgb(255,255,255);margin-top: 10px;">May 2023</p>
                <a class="btn"
                    role="button"
                    style="background: rgb(255,255,255);color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-weight: bold;"
                    href="{{ url('img/br_admin/BRC_Times_May2023.webp') }}">
                    View Newsletter!
                </a>
            </div>
            <div class="col-md-3 align-self-center">
                <h1 style="margin-top: 20px;font-family: Anton, sans-serif;font-size: 30px;color: rgb(255,255,255);">
                    JUNE 2023
                </h1>
                <p style="margin-bottom: 20px;color: rgb(207,207,207);font-family: 'Open Sans', sans-serif;">
                    Coming Soon!
                </p>
            </div>
            <div class="col-md-3 align-self-center">
                <h1 style="margin-top: 20px;font-size: 30px;font-family: Anton, sans-serif;color: rgb(255,255,255);">
                    JULY 2023
                </h1>
                <p style="margin-bottom: 20px;color: rgb(207,207,207);font-family: 'Open Sans', sans-serif;">
                    Coming Soon!
                </p>
            </div>
            <div class="col-md-3 align-self-center">
                <h1 style="margin-top: 20px;font-family: Anton, sans-serif;font-size: 30px;color: rgb(255,255,255);">
                    AUGUST 2023
                </h1>
                <p style="margin-bottom: 20px;color: rgb(207,207,207);font-family: 'Open Sans', sans-serif;">
                    Coming Soon!
                </p>
            </div>
        </div>
    </div>
@endsection
