@extends('layouts.app')
@section('content')
<!-- <section class="py-4 py-xl-5" style="background: linear-gradient(rgba(9,0,34,0.75) 0%, #000000 100%), url({{ url('storage/img/br_admin/canon-store-bg.webp') }}) center / cover no-repeat;"> -->

<section class="py-4 py-xl-5" style="background: linear-gradient(rgba(9,0,34,0.75) 0%, #000000 100%), url({{ url($canon->bg_img_string) }}) center / cover no-repeat;">
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
                <div class="col-6 col-sm-6 col-md-4 col-lg-2 item" style="margin-bottom: 10px;">
                    @include('store.store-card',  ['book' => $book])
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
