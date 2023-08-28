@extends('layouts.app')
@section('content')
    <section class="py-4 py-xl-5 bg-black">
        <div class="container-fluid">
            <div class="border rounded border-0 d-flex flex-column justify-content-center align-items-center p-4 py-5" style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.45)), url({{ url('img/br_admin/brc_wallpaper.webp') }}) top / cover no-repeat; height: 700px;">
                <div class="row g-0 justify-content-center">
                    <div class="col-md-10 col-lg-12 col-xl-12 text-center d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
                        <div>
                            <h1 style="font-family: 'Changa One', serif; color: rgb(255, 255, 255); font-size: 50PX;">DISCOVER ALL COMICS!</h1>
                            <p style="font-family: 'Open Sans', sans-serif; color: rgb(255, 255, 255);">
                                Get digital copies of our latest comic books and check out our shop by creator section for character information and blurbs written by each creator.
                            </p>
                        </div>
                    </div>
                </div>
                <form>
                    <div>
                        <a class="btn" role="button" style="background: rgba(255, 255, 255, 0.9); font-family: Lato, sans-serif; font-weight: bold; font-size: 14px;" href="https://www.redbubble.com/people/brcstore/shop">Check Out The New Merch Store!&nbsp</a>
                    </div>
                </form>
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-2 col-lg-3 col-xl-3">
                    <div class="d-none d-sm-none d-md-inline d-lg-inline" style="color: rgb(255,255,255);">
                        <h1 style="font-family: 'Open Sans', sans-serif;font-size: 20px;margin-top: 50px;margin-bottom: 30px;color: rgb(255,255,255);"><strong>Comic Titles</strong></h1>
                        <hr><a href="/store" style="color: #ffffff;font-family: 'Open Sans', sans-serif;"><strong>All Comics</strong></a>
                        <hr><a href="/store/store-alexiamidnight" style="color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;">Alexia Midnight</a>
                        <hr><a href="/store/store-brokenrealities" style="color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;">Broken Realities</a>
                        <hr><a href="/store/store-chaostheory" style="color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;">Chaos Theory</a>
                        <hr><a href="/store/store-eoa" style="color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;">Elements of Agony</a>
                        <hr><a href="/store/store-escapethepit" style="color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;">Escape The Pit</a>
                        <hr><a href="/store/store-godpunk" style="color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;">Godpunk</a>
                        <hr><a href="/store/store-legends" style="color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;">Legends</a>
                        <hr><a href="/store/store-operationnitro" style="color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;">Operation Nitro</a>
                        <hr><a href="/store/store-shadow" style="color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;">Shadow</a>
                        <hr><a href="/store/store-chronicrangers" style="font-family: 'Open Sans', sans-serif;color: rgb(255,255,255);">Super Stoner Chronic Rangers</a>
                        <hr><a href="/store/store-thealpha" style="color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;">The Alpha</a>
                        <hr><a href="/store/store-thefinalwielder" style="color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;">The Final Wielder</a>
                        <hr><a href="/store/store-thesuperdragonflysentinels" style="font-family: 'Open Sans', sans-serif;color: rgb(255,255,255);">The Super Dragonfly Sentinels</a>
                        <hr>
                        <h1 style="color: rgb(255,255,255);font-size: 20px; font-family: 'Open Sans', sans-serif; font-weight: bold;">Other Publishers</h1>
                        <hr><a style="font-family: 'Open Sans', sans-serif;color: rgb(255,255,255);" href="/store/other-publishers/store-saint">JRD Comics</a>
                        <hr><a style="font-family: 'Open Sans', sans-serif;color: rgb(255,255,255);" href="/store/other-publishers/store-ecrucomics">ECRU Comics</a>
                    </div>
                </div>
                <div class="col-md-10 col-lg-9 col-xl-9">
                        <div class="row justify-content-start projects" style="background: rgba(255,255,255,0);margin-bottom: 20px;">
                            @foreach($products as $product)
                                <div class="mt-3 col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 item">
                                    <div class="card border rounded-2 bg-black">
                                        <div class="card-body" style="padding-top: 16px;">
                                            <img class="img-fluid" src="{{ url($product->img_string) }}" width="92%" alt="">
                                            <h1 class="name text-white" style="font-family: 'Open Sans', sans-serif;font-size: 16px;padding-top: 15px;font-weight: bold;">{{ $product->product_name }}</h1>
                                            <button class="modal-btn btn my-1 text-decoration-underline text-white"
                                                    id="modal_{{ $product->id }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#show_modal_{{ $product->id }}">
                                                Summary
                                            </button>
                                            @if (!empty($product->in_development) && $product->in_development === 1)
                                                <p class="text-white" style="font-size: 15px;"><strong>Coming Soon!</strong></p>
                                            @else
                                                <p class="text-white" style="font-family: 'Open Sans', sans-serif;font-size: 13px;">
                                                    Digital: ${{ $product->digital_price }}
                                                </p>
                                                <a href='{{ $product->ejunkie_link_digital }}'
                                                    onclick='return EJEJC_lc(this);'
                                                    style='display:inline-block;background: #3da5d9 url(https://www.e-junkie.com/ej/images/newaddtocart.png) center/100px no-repeat;border: none;padding: 7px 55px;border-radius: 3px;box-shadow: 1px 2px 2px rgba(0,0,0,0.2);text-decoration: none;'
                                                    target='ej_ejc'
                                                    class='ec_ejc_thkbx'>&nbsp;
                                                </a>
                                            @endif
                                            @if (
                                                    !empty($product->physical_price) &&
                                                    !empty($product->ejunkie_link_physical) &&
                                                    (int) $product->physical_available === 1
                                                )
                                                <p style="font-size: 15px;">Physical: ${{ $product->physical_price }}</p>
                                                <a href='{{ $product->ejunkie_link_physical }}'
                                                    onclick='return EJEJC_lc(this);'
                                                    style='display: inline-block; background: #49be25 url(https://www.e-junkie.com/ej/images/newaddtocart.png) center/100px no-repeat; border: none;padding: 7px 55px;border-radius: 3px;box-shadow: 1px 2px 2px rgba(0,0,0,0.2); text-decoration: none;'
                                                    target='ej_ejc'
                                                    class='ec_ejc_thkbx'>&nbsp;
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        <div class="pagination-block">
                            {{ $products->links('layouts.store-pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @foreach ($products as $product)
        <div class="modal fade" id="show_modal_{{ $product->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog bg-black">
                <div class="modal-content bg-black">
                    <div class="modal-header">
                        <h5 class="modal-title text-white">{{ $product->product_name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <div id="prod_img" class="img-fluid px-2">
                            <img src="{{ url($product->img_string) }}" alt="" width="100%"/>
                        </div>
                        <div id="prod_info">
                            <div id="prod_summary">
                                <p class="text-white">{{ $product->summary ?? '' }}</p>
                            </div>
                            <div class="d-flex flex-row">
                                @if (!empty($product->in_development) && $product->in_development === 1)
                                    <p class="text-white" style="font-size: 15px;"><strong>Coming Soon!</strong></p>
                                @else
                                    <p class="mx-3 text-white" style="font-size: 13px;">Digital: ${{ $product->digital_price }}</p>
                                    <a href='{{ $product->ejunkie_link_digital }}'
                                        onclick='return EJEJC_lc(this);'
                                        style='display: inline-block; background: #3da5d9 url(https://www.e-junkie.com/ej/images/newaddtocart.png) center/100px no-repeat; border: none;padding: 7px 55px;border-radius: 3px;box-shadow: 1px 2px 2px rgba(0,0,0,0.2); text-decoration: none;'
                                        target='ej_ejc'
                                        class='ec_ejc_thkbx'
                                        data-bs-dismiss="modal">&nbsp;
                                    </a>
                                @endif
                                @if (
                                        !empty($product->physical_price) &&
                                        !empty($product->ejunkie_link_physical) &&
                                        (int) $product->physical_available === 1
                                    )
                                    <p class="mx-3" style="font-size: 13px;">Physical: ${{ $product->physical_price }}</p>
                                    <a href='{{ $product->ejunkie_link_physical }}'
                                        onclick='return EJEJC_lc(this);'
                                        style='display: inline-block; background: #49be25 url(https://www.e-junkie.com/ej/images/newaddtocart.png) center/100px no-repeat; border: none;padding: 7px 55px;border-radius: 3px;box-shadow: 1px 2px 2px rgba(0,0,0,0.2); text-decoration: none;'
                                        target='ej_ejc'
                                        class='ec_ejc_thkbx'
                                        data-bs-dismiss="modal">&nbsp;
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <script>
    </script>
@endsection
