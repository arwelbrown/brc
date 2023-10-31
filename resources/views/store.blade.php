@extends('layouts.app')
@section('content')
    <section class="py-4 py-xl-5 text-center" style="background: linear-gradient(rgba(9,0,34,0.75) 0%, #000000 100%), url({{ url('img/br_admin/brc_wallpaper.webp') }}) center / cover no-repeat;">
        <h1 data-aos="fade-up" style="margin-top: 80px;font-family: Anton, sans-serif;color: rgb(255,255,255);font-size: 50PX;margin-bottom: 30px;">
            DIVE INTO THE MULTIVERSE!
        </h1>
        <div class="container-fluid" data-aos="fade-up">
            <section>
                <div class="container-fluid" style="margin-top: 20px;">
                    <div class="row justify-content-start" style="margin-bottom: 20px;">
                        @foreach ($universes as $universe)
                            @if (!empty($universe->series()->get()->toArray()))
                                <div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4" data-bss-hover-animate="pulse" style="margin-bottom: 20px;">
                                    <a class="d-inline-block" href="/store/universe/{{ $universe->universe_slug }}">
                                        <img class="img-fluid" src="{{ asset($universe->universe_banner_img_string) }}">
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </section>
    <section class="text-center bg-black">
        <div class="container">
            <div class="row g-1 justify-content-center align-items-center">
                <div class="col-lg-9 align-self-center" style="margin-top: 10px;">
                    <div class="pagination-block">
                        {{ $products->links('layouts.store-pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center bg-black">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-4 col-md-6 col-lg-5 col-xxl-4 align-self-center">
                    <h1 style="font-family: Anton, sans-serif;color: rgb(255,255,255);font-size: 40PX;letter-spacing: 2px;text-align: left;">THE BRC SHOWCASE!</h1>
                    <p style="font-family: 'Open Sans', sans-serif;background: rgba(255,255,255,0);font-size: 14px;text-align: left;"><span style="color: rgb(255, 255, 255);">Get yourself copies of Broken Reality Comics </span><strong><span style="color: rgb(255, 255, 255);">NEW</span></strong><span style="color: rgb(255, 255, 255);"> Releases with SHADOW #2 and The Super Dragonfly Sentinels #2!&nbsp;</span></p>
                    <p style="font-family: 'Open Sans', sans-serif;background: rgba(255,255,255,0);font-size: 14px;text-align: left;"><span style="color: rgb(255, 255, 255);">Make sure to follow us on instagram @brokenrealitycomics to keep track Phase 1 and the latest comic book releases!</span></p>
                </div>
                @foreach ($featuredProducts as $product)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2 col-xl-2 col-xxl-2 item" style="padding-bottom: 10px;">
                        <div class="card border rounded-0" style="background: rgb(0,0,0);">
                            <div class="card-body" style="padding-top: 16px;">
                                <img class="img-fluid" src="{{ asset($product->img_string) }}">
                                <h1 class="name" style="font-family: 'Open Sans', sans-serif;font-size: 13px;padding-top: 15px;font-weight: bold;color: rgb(255,255,255);">{{ $product->product_name }}</h1>
                                @if (!empty($product->in_development) && $product->in_development === 1)
                                        <p class="text-white" style="font-size: 15px;"><strong>Coming Soon!</strong></p>
                                @else
                                    <p class="text-white" style="font-family: 'Open Sans', sans-serif;font-size: 13px;">
                                        Digital: ${{ $product->digital_price }}
                                    </p>
                                    <button class="btn btn-light">
                                        <a href='{{ $product->ejunkie_link_digital }}'
                                            onclick='return EJEJC_lc(this);'
                                            target='ej_ejc'
                                            class='ec_ejc_thkbx'
                                            style="color:black;font-family:'Open Sans', sans-serif;font-weight:900;font-size:10px;text-decoration:none;"
                                        >
                                            ADD TO CART
                                        </a>
                                    </button>
                                @endif
                                @if (
                                        !empty($product->physical_price) &&
                                        !empty($product->ejunkie_link_physical) &&
                                        (int) $product->physical_available === 1
                                    )
                                    <p style="font-size: 15px;">Physical: ${{ $product->physical_price }}</p>
                                    <button class="btn btn-light">
                                        <a href='{{ $product->ejunkie_link_physical }}'
                                            onclick='return EJEJC_lc(this);'
                                            target='ej_ejc'
                                            class='ec_ejc_thkbx'
                                            style="color:black;font-family:'Open Sans', sans-serif;font-weight:900;font-size:10px;text-decoration:none;"
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
        <div class="container" style="max-width: 900px;">
            <h1 style="font-family: Anton, sans-serif;color: rgb(255,255,255);font-size: 50PX;letter-spacing: 2px;margin-top: 50PX;">DISCOVER ALL COMICS!</h1>
            <p style="font-family: 'Open Sans', sans-serif;background: rgba(255,255,255,0);font-size: 14px;"><span style="color: rgb(255, 255, 255);">Get digital copies of our latest comic books and check out our shop by creator section for character information and blurbs written by each creator.&nbsp;Check out the all the stories provided by the individual creators that are members of Broken Reality Comics!&nbsp;Our catalog includes: Fantasy, Sci-Fi, Horror, Superheroes, Tokusatsu, Vigilantes, Reality Hopping, and more...</span></p>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-auto col-md-10 col-lg-9 col-xl-9 col-xxl-11">
                    <div class="row projects" style="background: rgba(255,255,255,0);margin-bottom: 20px;">
                        @foreach ($products as $product)
                            <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-2 item" style="padding-bottom: 10px;">
                                <div class="card border rounded-0" style="background: rgb(0,0,0);">
                                    <div class="card-body" style="padding-top: 16px;">
                                        <img class="img-fluid" src="{{ asset($product->img_string) }}">
                                        <h1 class="name" style="font-family: 'Open Sans', sans-serif;font-size: 13px;padding-top: 15px;font-weight: bold;color: rgb(255,255,255);">{{ $product->product_name }}</h1>
                                        @if (!empty($product->in_development) && $product->in_development === 1)
                                                <p class="text-white" style="font-size: 15px;"><strong>Coming Soon!</strong></p>
                                        @else
                                            <p class="text-white" style="font-family: 'Open Sans', sans-serif;font-size: 13px;">
                                                Digital: ${{ $product->digital_price }}
                                            </p>
                                            <button class="btn btn-light">
                                                <a href='{{ $product->ejunkie_link_digital }}'
                                                    onclick='return EJEJC_lc(this);'
                                                    target='ej_ejc'
                                                    class='ec_ejc_thkbx'
                                                    style="color:black;font-family:'Open Sans', sans-serif;font-weight:900;font-size:12px;text-decoration:none;"
                                                >
                                                    ADD TO CART
                                                </a>
                                            </button>
                                        @endif
                                        @if (
                                                !empty($product->physical_price) &&
                                                !empty($product->ejunkie_link_physical) &&
                                                (int) $product->physical_available === 1
                                            )
                                            <p style="font-size: 15px;">Physical: ${{ $product->physical_price }}</p>
                                            <button class="btn btn-light">
                                                <a href='{{ $product->ejunkie_link_physical }}'
                                                    onclick='return EJEJC_lc(this);'
                                                    target='ej_ejc'
                                                    class='ec_ejc_thkbx'
                                                    style="color:black;font-family:'Open Sans', sans-serif;font-weight:900;font-size:12px;text-decoration:none;"
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
            </div>
        </div>
    </section>
    <section class="text-center bg-black">
        <div class="container">
            <div class="row g-1 justify-content-center align-items-center">
                <div class="col-lg-9 align-self-center" style="margin-top: 10px;">
                    <div class="pagination-block">
                        {{ $products->links('layouts.store-pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
