@extends('layouts.app')
@section('content')
    <section class="py-4 py-xl-5"
        style="background: linear-gradient(rgba(9,0,34,0.75) 0%, #000000 100%), url({{ url($bgImg) }}) center / cover no-repeat;">
        <div class="container" style="margin-bottom: 10px;margin-top: 40px;">
            <nav class="navbar navbar-expand bg-transparent p-0 navbar-dark" style="max-width: 400px;">
                <div class="container"><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span
                            class="visually-hidden">Toggle navigation</span><span
                            class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="navbar-nav flex-grow-1 justify-content-between me-auto">
                            <li class="nav-item"><a class="nav-link" href="/store"
                                    style="font-family: 'Open Sans', sans-serif;color: #ffffff;font-size: 14px;"><span
                                        style="text-decoration: underline;">« Main Store&nbsp;</span></a></li>
                            <li class="nav-item"><a class="nav-link"
                                    href="/store/{{ $title == 'BRC Store' ? 'brc' : 'community ?>' }}"
                                    style="font-family: 'Open Sans', sans-serif;color: #007aff;font-size: 14px;"><span
                                        style="color: rgb(255, 255, 255);">&nbsp;{{ $title }}</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="container text-center">

            @if (file_exists($storeLogo))
                <img class="img-fluid" data-aos="fade-up" style="text-align: center;margin-top: 50px;margin-bottom: 30px;"
                    src="{{ url($storeLogo) }}" width="30%">
            @endif

            <h1 class="text-center" data-aos="fade-up" data-aos-delay="200"
                style="font-family: Anton, sans-serif;color: rgb(255,255,255);font-size: 50PX;">
                WELCOME TO THE {{ $title }} STORE
            </h1>
            <p class="text-center" data-aos="fade-up" data-aos-delay="400"
                style="font-family: 'Open Sans', sans-serif;color: rgb(157,157,157);"><span
                    style="color: rgb(238, 238, 238); background-color: transparent;">{{ $universe->universe_summary ?? '' }}</span>
            </p>
        </div>
        <div class="container">
            <h1 class="text-center" data-aos="fade-up"
                style="font-family: Anton, sans-serif;color: rgb(255,255,255);font-size: 40PX;margin-top: 50PX;">SHOP BY
                SERIES</h1>
            <p class="text-center" data-aos="fade-up" data-aos-delay="400"
                style="font-family: 'Open Sans', sans-serif;color: rgb(157,157,157);"><span
                    style="color: rgb(238, 238, 238);">{{ $description ?? '' }}</span></p>
        </div>
        <div class="container" style="margin-top: 20px;">
            <div class="row justify-content-center" style="margin-bottom: 20px;">
                @foreach ($seriesInStore as $series)
                    @if (!empty($series->products()->get()->toArray()))
                        <div class="col-6 col-md-4 col-lg-4" data-bss-hover-animate="pulse" style="margin-bottom: 20px">
                            <a class="d-inline-block" href="/store/series/{{ $series->series_slug }}">
                                <img class="img-fluid" src="{{ url($series->series_banner) }}">
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <h1 class="text-center" data-aos="fade-up"
            style="font-family: Anton, sans-serif;color: rgb(255,255,255);font-size: 40PX;margin-top: 50px;margin-bottom: 50px;">
            DISCOVER ALL {{ str_replace(' ', '-', strtoupper($title)) }} COMICS
        </h1>
        <div class="container">
            <div class="row text-center justify-content-center projects"
                style="background: rgba(255,255,255,0);margin-bottom: 20px;">
                @foreach ($products as $product)
                    <div class="col-6 col-sm-6 col-md-3 col-lg-2 col-xl-2 col-xxl-2 item" style="padding-bottom: 10px;">
                        <div class="card border rounded-0" style="background: rgb(0,0,0);">
                            <div class="card-body text-center" style="padding-top: 16px;">
                                <img class="img-fluid" src="{{ asset($product->img_string) }}">
                                <h1 class="name"
                                    style="font-family: 'Open Sans', sans-serif;font-size: 13px;padding-top: 15px;font-weight: bold;color: rgb(255,255,255);">
                                    {{ $product->product_name }}</h1>
                                @if (!empty($product->in_development) && $product->in_development === 1)
                                    <p class="text-white" style="font-size: 13px;"><strong>Coming Soon!</strong></p>
                                    <a disabled href=""
                                        style='display:inline-block;background:black; cursor:default;center/100px no-repeat;border: none;padding: 7px 55px;border-radius: 3px;box-shadow: 1px 2px 2px rgba(0,0,0,0.2);text-decoration: none;'
                                        class='ec_ejc_thkbx'>&nbsp;
                                    </a>
                                @else
                                    <p class="text-white" style="font-family: 'Open Sans', sans-serif;font-size: 13px;">
                                        Digital: ${{ $product->digital_price }}
                                    </p>
                                    <button class="btn btn-light">
                                        <a href='{{ $product->ejunkie_link_digital }}' onclick='return EJEJC_lc(this);'
                                            target='ej_ejc' class='ec_ejc_thkbx'
                                            style="color:black;font-family:'Open Sans', sans-serif;font-weight:900;font-size:11px;text-decoration:none;">
                                            ADD TO CART
                                        </a>
                                    </button>
                                @endif
                                @if (
                                    !empty($product->physical_price) &&
                                        !empty($product->ejunkie_link_physical) &&
                                        (int) $product->physical_available === 1)
                                    <p style="font-size: 15px;">Physical: ${{ $product->physical_price }}</p>
                                    <button class="btn btn-light">
                                        <a href='{{ $product->ejunkie_link_physical }}' onclick='return EJEJC_lc(this);'
                                            target='ej_ejc' class='ec_ejc_thkbx'
                                            style="color:black;font-family:'Open Sans', sans-serif;font-weight:900;font-size:11px;text-decoration:none;">
                                            ADD TO CART
                                        </a>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
