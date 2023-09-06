@extends ('layouts.app')
@section('content')
    <div class="container-fluid text-center" style="margin-top: 20px;">
        <div class="row g-0">
            <div class="col-md-6 col-lg-12">
                <div data-bss-parallax-bg="true" style="height: 500px;background: linear-gradient(rgba(124,104,241,0.36), #000000 109%), url({{ url('/img/br_admin/brc_wallpaper.webp') }}) center / cover no-repeat;">
                    <div class="row g-0 mb-2" style="margin-top: 20px;">
                        <div class="col-8 col-sm-10 col-md-9 col-lg-7 col-xl-7 text-center mx-auto" style="color: rgb(49, 52, 55);">
                            <h2 class="display-6 fw-bold" data-aos="fade-up" style="color: rgb(255,255,255);font-family: Anton, sans-serif;letter-spacing: 2px;margin-top: 100px;">SUBSCRIBE TO THE BRC NEWSLETTER</h2>
                            <p class="text-muted" data-aos="fade-down" style="font-family: 'Open Sans', sans-serif;margin-top: 20px;color: rgba(33, 37, 41, 0.75);"><span style="color: rgba(235, 241, 247, 0.93);">Subscribe to our official monthly newsletter to get exclusive announcement, perks, discounts and more!</span></p>
                        </div>
                    </div>
                    <form class="d-flex justify-content-center flex-wrap" data-aos="fade" data-bss-recipient="374f101e2d84c85fe299372a6799c332" data-bss-subject="Thank You for Subscribing!" style="margin-top: 20px;">
                        <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Your Email"></div>
                        <div class="mb-3"><button class="btn btn-primary ms-2" type="submit" style="background: var(--bs-blue);">Subscribe </button></div>
                    </form>
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-down" data-aos="fade-up" data-aos-delay="200" style="margin-top: 50px;color: rgb(255,255,255);font-size: 40px;font-style: italic;">
                        <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
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
            <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 item" style="padding-bottom: 10px;">
                <div class="card border rounded-0" style="background: rgb(0,0,0);">
                    <div class="card-body" style="padding-top: 16px;">
                        <img class="img-fluid" src="{{ url('img/br_admin/newsletter_may_23.webp') }}">
                        <h1 class="name" style="font-family: 'Open Sans', sans-serif;font-size: 16px;padding-top: 15px;font-weight: bold;color: rgb(255,255,255);">May 2023</h1>
                        <a class="btn"
                            role="button"
                            style="background: rgb(255,255,255);color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-weight: bold;"
                            href="{{ url('img/br_admin/newsletter_may_23.webp') }}">
                            Download PDF
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 item" style="padding-bottom: 10px;">
                <div class="card border rounded-0" style="background: rgb(0,0,0);">
                    <div class="card-body" style="padding-top: 16px;">
                        <img class="img-fluid" src="{{ url('img/br_admin/newsletter_june_23.webp') }}">
                        <h1 class="name" style="font-family: 'Open Sans', sans-serif;font-size: 16px;padding-top: 15px;font-weight: bold;color: rgb(255,255,255);">May 2023</h1>
                        <a class="btn"
                            role="button"
                            style="background: rgb(255,255,255);color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-weight: bold;"
                            href="{{ url('img/br_admin/newsletter_june_23.webp') }}">
                            Download PDF
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 item" style="padding-bottom: 10px;">
                <div class="card border rounded-0" style="background: rgb(0,0,0);">
                    <div class="card-body" style="padding-top: 16px;">
                        <img class="img-fluid" src="{{ url('img/br_admin/newsletter_july_23.webp') }}">
                        <h1 class="name" style="font-family: 'Open Sans', sans-serif;font-size: 16px;padding-top: 15px;font-weight: bold;color: rgb(255,255,255);">May 2023</h1>
                        <a class="btn"
                            role="button"
                            style="background: rgb(255,255,255);color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-weight: bold;"
                            href="{{ url('img/br_admin/newsletter_july_23.webp') }}">
                            Download PDF
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 align-self-center">
                <h1 style="margin-top: 20px;font-family: Anton, sans-serif;font-size: 30px;color: rgb(255,255,255);">AUGUST 2023</h1>
                <p style="margin-bottom: 20px;color: rgb(207,207,207);font-family: 'Open Sans', sans-serif;">Coming Soon!</p>
            </div>
        </div>
    </div>
@endsection
