@extends('layouts.app')
@section('content')
<!-- <section class="py-4 py-xl-5" style="background: linear-gradient(rgba(9,0,34,0.75) 0%, #000000 100%), url({{ url('storage/img/br_admin/canon-store-bg.webp') }}) center / cover no-repeat;"> -->

<section class="py-4 py-xl-5" style="background: linear-gradient(rgba(9,0,34,0.75) 0%, #000000 100%), url({{ url($canon->img_string) }}) center / cover no-repeat;">
    <div class="container" style="margin-bottom: 10px;margin-top: 40px;">
        <nav class="navbar navbar-expand bg-transparent p-0 navbar-dark" style="max-width: 400px;">
            <div class="container"><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav flex-grow-1 justify-content-between me-auto">
                        <li class="nav-item"><a class="nav-link" href="/store" style="font-family: 'Open Sans', sans-serif;color: #ffffff;font-size: 14px;"><span style="text-decoration: underline;">« Main Store&nbsp;</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="/store/canon/{{ $canon->slug }}" style="font-family: 'Open Sans', sans-serif;color: #007aff;font-size: 14px;"><span style="color: rgb(255, 255, 255);">&nbsp;{{ $canon->name }}</span></a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container text-center">

        <!-- <img class="img-fluid" data-aos="fade-up" style="text-align: center;margin-top: 50px;margin-bottom: 30px;" src="{{ url($canon->img_string) }}" width="30%"> -->

        <h1 class="text-center" data-aos="fade-up" data-aos-delay="200" style="font-family: Anton, sans-serif;color: rgb(255,255,255);font-size: 50PX;">
            WELCOME TO THE {{ str_replace(' ',  '-', strtoupper($canon->name)) }} STORE
        </h1>
        <p class="text-center" data-aos="fade-up" data-aos-delay="400" style="font-family: 'Open Sans', sans-serif;color: rgb(157,157,157);"><span style="color: rgb(238, 238, 238); background-color: transparent;">{{ $universe->universe_summary ?? ''}}</span></p>
    </div>
    <div class="container">
        <h1 class="text-center" data-aos="fade-up" style="font-family: Anton, sans-serif;color: rgb(255,255,255);font-size: 40PX;margin-top: 50PX;">SHOP BY SERIES</h1>
    </div>
    <div class="container" style="margin-top: 20px;">
        <div class="row justify-content-center" style="margin-bottom: 20px;">
            @foreach ($seriesInCanon as $series)
                <div class="col-6 col-md-4 col-lg-4" data-bss-hover-animate="pulse" style="margin-bottom: 20px">
                    <a class="d-inline-block" href="/store/series/{{ $series->series_slug }}">
                        <img class="img-fluid" src="{{ url($series->series_banner) }}">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <h1 class="text-center" data-aos="fade-up" style="font-family: Anton, sans-serif;color: rgb(255,255,255);font-size: 40PX;margin-top: 50px;margin-bottom: 50px;">
        DISCOVER ALL {{ str_replace(' ',  '-', strtoupper($canon->name)) }} COMICS
    </h1>
    <div class="container">
        <div class="row text-center justify-content-center projects" style="background: rgba(255,255,255,0);margin-bottom: 20px;">
            @foreach ($books as $book)
                <div class="col-6 col-sm-6 col-md-3 col-lg-2 col-xl-2 col-xxl-2 item" style="padding-bottom: 10px;">
                    <div class="card border rounded-0" style="background: rgb(0,0,0);">
                        <div class="card-body text-center" style="padding-top: 16px;">
                            <img class="img-fluid" src="{{ asset($book->img_string) }}">
                            <h1 class="name" style="font-family: 'Open Sans', sans-serif;font-size: 13px;padding-top: 15px;font-weight: bold;color: rgb(255,255,255);">{{ $book->name }}</h1>
                            @if (!empty($book->in_development) && $book->in_development === 1)
                                <p class="text-white" style="font-size: 13px;"><strong>Coming Soon!</strong></p>
                                <a disabled href=""
                                    style='display:inline-block;background:black; cursor:default;center/100px no-repeat;border: none;padding: 7px 55px;border-radius: 3px;box-shadow: 1px 2px 2px rgba(0,0,0,0.2);text-decoration: none;'
                                    class='ec_ejc_thkbx'>&nbsp;
                                </a>
                            @else                                   
                                <p class="text-white" style="font-family: 'Open Sans', sans-serif;font-size: 13px;">
                                    Digital: ${{ $book->digital_price }}
                                </p>
                                <button class="btn btn-light">
                                    <a href='{{ $book->ejunkie_link_digital }}'
                                        onclick='return EJEJC_lc(this);'
                                        target='ej_ejc'
                                        class='ec_ejc_thkbx'
                                        style="color:black;font-family:'Open Sans', sans-serif;font-weight:900;font-size:11px;text-decoration:none;"
                                    >
                                        ADD TO CART
                                    </a>
                                </button>
                            @endif
                            @if (
                                    !empty($book->physical_price) &&
                                    !empty($book->ejunkie_link_physical) &&
                                    (int) $book->physical_available === 1
                                )
                                <p style="font-size: 15px;">Physical: ${{ $book->physical_price }}</p>
                                <button class="btn btn-light">
                                    <a href='{{ $book->ejunkie_link_physical }}'
                                        onclick='return EJEJC_lc(this);'
                                        target='ej_ejc'
                                        class='ec_ejc_thkbx'
                                        style="color:black;font-family:'Open Sans', sans-serif;font-weight:900;font-size:11px;text-decoration:none;"
                                    >
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
