@extends('layouts.app')
@section('content')
<section class="text-center">
    <div class="container text-center" style="background: #ffffff;margin-top: 40px;">
        <h1 style="font-family: Anton, sans-serif; color: rgb(0, 0, 0); font-size: 50PX; letter-spacing: 2px;">DISCOVER ALL COMICS!</h1>
        <p style="font-family: 'Open Sans', sans-serif;">Get digital copies of our latest comic books and check out our shop by creator section for character information and blurbs written by each creator.<span style="color: rgb(0, 0, 0); background-color: rgb(255, 255, 255);">&nbsp;Check out the all the stories provided by the individual creators that are members of Broken Reality Comics!&nbsp;Our catalog includes: Fantasy, Sci-Fi, Horror, Superheroes, Tokusatsu, Vigilantes, Reality Hopping, and more...</span></p>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-2 col-lg-3 col-xl-3" style="margin-bottom: 50px;">
                <div class="d-none d-sm-none d-md-inline d-lg-inline">
                    <h1 style="font-family: 'Open Sans', sans-serif; font-size: 20px; margin-top: 50px; margin-bottom: 30px;"><strong>Comic Titles</strong></h1>
                    <hr><a href="/store" style="color: var(--bs-red);">All Comics</a>
                    <hr><a href="/store/store-alexiamidnight">Alexia Midnight</a>
                    <hr><a href="/store/store-brokenrealities">Broken Realities</a>
                    <hr><a href="/store/store-chaostheory">Chaos Theory</a>
                    <hr><a href="/store/store-eoa">Elements of Agony</a>
                    <hr><a href="/store/store-escapethepit">Escape The Pit</a>
                    <hr><a href="/store/store-godpunk">Godpunk</a>
                    <hr><a href="/store/store-legends">Legends</a>
                    <hr><a href="/store/store-operationnitro">Operation Nitro</a>
                    <hr><a href="/store/store-shadow">Shadow</a>
                    <hr><a href="/store/store-chronicrangers">Super Stoner Chronic Rangers</a>
                    <hr><a href="/store/store-thealpha">The Alpha</a>
                    <hr><a href="/store/store-thefinalwielder">The Final Wielder</a>
                    <hr><a href="/store/store-tsds">The Super Dragonfly Sentinels</a>
                    <hr>
                    <h1 style="font-size: 20px; font-family: 'Open Sans', sans-serif; font-weight: bold;">Other Publishers</h1>
                    <hr><a href="/store/other-publishers/store-saint">JRD Comics</a>
                    <hr><a href="/store/other-publishers/store-ecrucomics">ECRU Comics</a>
                    <hr><a href="/store/other-publishers/store-awaken">Flat Timez Publishing</a>
                    <hr><a href="/store/other-publishers/store-lumostation">Lumostation LLC</a>
                    <hr><a href="/store/other-publishers/store-zeromedal">Zero Medal</a>
                </div>
            </div>
            <div class="col-sm-9 col-md-9 col-lg-9">
                <div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation"><a class="nav-link active" role="tab" data-bs-toggle="tab" href="#tab-1" style="color: rgb(73, 80, 87);">{{ $publisher[0]->publisher_name }}</a></li>
                    </ul>
                    <div class="tab-content" style="margin-bottom: 50px;">
                        <div class="tab-pane fade show active" role="tabpanel" id="tab-1">
                            <section class="py-4 py-xl-5">
                                <div class="container">
                                    <div class="border rounded border-0 d-flex flex-column justify-content-center align-items-center p-4 py-5" style="background: linear-gradient(rgba(0, 0, 0, 0), #000000), url({{ url($publisher[0]->banner) }}); background-size: auto, cover;">
                                        <div class="row">
                                            <div class="col-md-10 col-xl-7 text-center d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
                                                <div>
                                                    @if(!empty($publisher[0]->logo))
                                                        <img class="img-fluid" src="{{ url($publisher[0]->logo) }}" width="50%" alt="">
                                                    @endif
                                                    <p class="mb-4" style="color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;">{{ $publisher[0]->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="row projects" style="background: #ffffff; margin-bottom: 20px;">
                                @foreach($products as $product)
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 item">
                                        <div class="card">
                                            <div class="card-body" style="padding-top: 16px;">
                                                <img class="img-fluid" src="{{ url($product->img_string) }}" alt="">
                                                <h1 class="name" style="font-family: 'Open Sans', sans-serif;font-size: 16px;padding-top: 15px;font-weight: bold;">{{ $product->product_name }}</h1>
                                                <button class="modal-btn btn my-1 text-decoration-underline"
                                                        id="modal_{{ $product->id }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#show_modal_{{ $product->id }}">
                                                    Summary
                                                </button>
                                                <p style="color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;font-size: 12px;">
                                                    ${{ $product->digital_price }} (Digital Copy)
                                                </p>
                                                <a href='{{ $product->ejunkie_link_digital }}' onclick='return EJEJC_lc(this);' style='display:inline-block;background: #3da5d9 url(https://www.e-junkie.com/ej/images/newaddtocart.png) center/100px no-repeat;border: none;padding: 7px 55px;border-radius: 3px;box-shadow: 1px 2px 2px rgba(0,0,0,0.2);text-decoration: none;' target='ej_ejc' class='ec_ejc_thkbx'>&nbsp</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@foreach ($products as $product)
    <div class="modal fade" id="show_modal_{{ $product->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $product->product_name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <div id="prod_img" class="img-fluid px-2">
                        <img src="{{ url($product->img_string) }}" alt="" width="100%"/>
                    </div>
                    <div id="prod_info">
                        <div id="prod_summary">
                            <p>{{ $product->summary ?? '' }}</p>
                        </div>
                        <div class="d-flex flex-row">
                            @if (!empty($product->in_development) && $product->in_development === 1)
                            @else
                                <p class="mx-3" style="font-size: 13px;">Digital: ${{ $product->digital_price }}</p>
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
@endsection
