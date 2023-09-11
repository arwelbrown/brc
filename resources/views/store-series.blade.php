@extends('layouts.app')
@section('content')
<section class="bg-black">
    <div class="container text-center" style="background: rgba(255,255,255,0);margin-top: 40px;">
        <h1 style="font-family: Anton, sans-serif;color: rgb(0,0,0);font-size: 50PX;letter-spacing: 2px;"><span style="color: rgb(255, 255, 255);">DIVE INTO THE LORE OF {{ strtoupper($series->series_name) }}!</span></h1>
    </div>
    <div class="container" style="margin-bottom: 10px;margin-top: 40px;">
        <nav class="navbar navbar-expand bg-transparent p-0 navbar-dark" style="max-width: 400px;">
            <div class="container"><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav flex-grow-1 justify-content-between me-auto">
                        <li class="nav-item"><a class="nav-link" href="/store" style="font-family: 'Open Sans', sans-serif;color: #ffffff;font-size: 14px;"><span style="text-decoration: underline;">« Main Store&nbsp;</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="/store/universe/{{ $universe->universe_slug }}" style="font-family: 'Open Sans', sans-serif;color: #ffffff;font-size: 14px;"><span style="text-decoration: underline;">« {{ $universe->universe_name }} Store</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="/store/universe/{{ $universe->universe_slug }}/{{ $series->series_slug }}" style="font-family: 'Open Sans', sans-serif;font-size: 14px;">{{ $series->series_name }}</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>          
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-9 col-md-9 col-lg-9 col-xl-8 col-xxl-8 align-self-center">
                <div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" role="tab" data-bs-toggle="tab" href="#tab-1" style="color: rgb(255,255,255);background: var(--bs-card-cap-bg);font-family: 'Open Sans', sans-serif;font-weight: bold;">
                                {{ $series->series_name }}
                            </a>
                        </li>

                        @if (!empty($characters) && count($characters) > 0) 
                            <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-2" style="color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;background: rgba(255,255,255,0);"><strong>Character Bio</strong></a></li>
                        @endif
                    </ul>
                    <div class="tab-content" style="margin-bottom: 50px;">
                        <div class="tab-pane fade show active" role="tabpanel" id="tab-1">
                            <section class="py-4 py-xl-5">
                                <img class="img-fluid" src="{{ url($series->series_banner) }}">
                            </section>
                            <div class="row justify-content-start projects" style="background: rgba(255,255,255,0);margin-bottom: 20px;">
                                @foreach($products as $product)
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 item">
                                        <div class="card border rounded-0 mb-3" style="background: rgba(255,255,255,0);">
                                            <div class="card-body text-center" style="padding-top: 16px;">
                                                <img class="img-fluid" src="{{ url($product->img_string) }}">
                                                <h1 class="name" style="font-family: 'Open Sans', sans-serif;font-size: 13px;padding-top: 15px;font-weight: bold;color: rgb(255,255,255);">{{ $product->product_name }}</h1>
                                                @if (!empty($product->in_development) && $product->in_development === 1)
                                                    <p class="text-white" style="font-size: 13px;"><strong>Coming Soon!</strong></p>
                                                    <a disabled href=''
                                                        style='display:inline-block;background:black; cursor:default;center/100px no-repeat;border: none;padding: 7px 55px;border-radius: 3px;box-shadow: 1px 2px 2px rgba(0,0,0,0.2);text-decoration: none;'
                                                        class='ec_ejc_thkbx'>
                                                    </a>
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
                        @if (!empty($characters))
                            <div class="tab-pane fade" role="tabpanel" id="tab-2">
                            @foreach ($characters as $character)
                                <div class="row justify-content-start projects" style="background: rgba(255,255,255,0);margin-bottom: 20px;margin-top: 20px;">
                                    
                                    <div class="col-sm-12 col-md-6 col-lg-6 align-self-center">
                                        <img class="img-fluid" src="{{ url($character->img_string) }}">
                                    </div>
                                    <div class="col-lg-6">
                                        <h1 class="text-start" style="font-family: Iceberg, serif;font-weight: bold;">
                                            <span style="color: rgb(255, 255, 255);">
                                                {{ strtoupper($character->name) }}
                                            </span>
                                        </h1>

                                        @if (!empty($character->real_name))
                                            <p class="text-start" style="font-family: 'Open Sans', sans-serif;"><strong><span style="color: rgb(255, 255, 255); background-color: transparent;">Name</span></strong><span style="color: rgb(255, 255, 255); background-color: transparent;">: {{ $character->real_name }}</span></p>
                                        @endif

                                        @if (!empty($character->aliases))
                                            <p class="text-start" style="font-family: 'Open Sans', sans-serif;"><strong><span style="color: rgb(255, 255, 255); background-color: transparent;">Alias</span></strong><span style="color: rgb(255, 255, 255); background-color: transparent;">: {{ implode(', ', $character->aliases) }}</span></p>
                                        @endif

                                        @if (!empty($character->race))
                                            <p class="text-start" style="font-family: 'Open Sans', sans-serif;"><strong><span style="color: rgb(255, 255, 255); background-color: transparent;">Race</span></strong><span style="color: rgb(255, 255, 255); background-color: transparent;">: {{ $character->race }}</span></p>
                                        @endif

                                        @if (!empty($character->abilities)) 
                                            <p class="text-start" style="font-family: 'Open Sans', sans-serif;"><strong><span style="color: rgb(255, 255, 255); background-color: transparent;">Abilities</span></strong><span style="color: rgb(255, 255, 255); background-color: transparent;">: {{ implode(', ', $character->abilities) }}</span></p>
                                        @endif

                                        @if (!empty($character->weaknesses))
                                            <p class="text-start" style="font-family: 'Open Sans', sans-serif;"><strong><span style="color: rgb(255, 255, 255); background-color: transparent;">Weaknesses</span></strong><span style="color: rgb(255, 255, 255); background-color: transparent;">: {{ implode(', ', $character->weaknesses) }}</span></p>
                                        @endif

                                        @if (!empty($character->affiliations))
                                            <p class="text-start" style="font-family: 'Open Sans', sans-serif;"><strong><span style="color: rgb(255, 255, 255); background-color: transparent;">Affiliation</span></strong><span style="color: rgb(255, 255, 255); background-color: transparent;">: {{ implode(', ', $character->affiliations) }}</span></p>
                                        @endif

                                        @if (!empty($character->appearances))
                                            <p class="text-start" style="font-family: 'Open Sans', sans-serif;">
                                                <strong><span style="color: rgb(255, 255, 255); background-color: transparent;">Appearances:</span></strong>:
                                                <span style="color: rgb(255, 255, 255); background-color: transparent;">
                                                    @foreach ($character->appearances as $index => $appearance)
                                                        <a class="text-white" href='/store/universe/{{ $appearance['universe_slug'] }}/{{ $appearance['series_slug'] }}'>
                                                            {{ $appearance['series_name'] }}{{ $index == count($character['appearances']) ? '' : ', ' }}
                                                        </a>
                                                    @endforeach
                                                </span>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-11">
                                        <p class="text-start" style="font-family: 'Open Sans', sans-serif;"><strong><span style="color: rgb(255, 255, 255); background-color: transparent;">History</span></strong><span style="color: rgb(255, 255, 255); background-color: transparent;">: {{ $character->history }}</span></p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div 
                class="col-sm-12 col-md-9 col-lg-3 col-xxl-3 text-start text-white"
                data-aos="fade-down"
                data-aos-delay="200"
                style="font-family:'Open Sans', sans-serif';color: rgb(255,255,255);"
            >
                @if (!empty($creators))
                    <h1 style="text-align: left;color: rgb(255,255,255);font-size: 25px;font-family: 'Open Sans', sans-serif;font-weight: bold;">Creator(s):</h1>
                    <p class="mb-4" style="color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;">
                        @foreach ($creators as $index => $creator)
                            @if ($index + 1 != count($creators))
                                {{ $creator }},&nbsp;
                            @else
                                {{ $creator }}
                            @endif
                        @endforeach
                    </p>
                @endif
                @if (!empty($writers))
                    <h1 style="text-align: left;color: rgb(255,255,255);font-size: 25px;font-family: 'Open Sans', sans-serif;font-weight: bold;">Writing Team:</h1>
                    <p class="mb-4" style="color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;">
                        @foreach ($writers as $index => $writer)
                            @if ($index + 1 != count($writers))
                                {{ $writer }},&nbsp;
                            @else
                                {{ $writer }}
                            @endif
                        @endforeach
                    </p>
                @endif
                @if (!empty($editors))
                    <h1 style="text-align: left;color: rgb(255,255,255);font-size: 25px;font-family: 'Open Sans', sans-serif;font-weight: bold;">Editors:</h1>
                    <p class="mb-4" style="color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;">
                        @foreach ($editors as $index => $editor)
                            @if ($index + 1 != count($editors))
                                {{ $editor }},&nbsp;
                            @else
                                {{ $editor }}
                            @endif
                        @endforeach
                    </p>
                @endif
                @if (!empty($artTeam))
                    <h1 style="text-align: left;color: rgb(255,255,255);font-size: 25px;font-family: 'Open Sans', sans-serif;font-weight: bold;">Art Team:</h1>
                    @foreach ($artTeam as $deptName => $dept)
                        @if (!empty($dept))
                        <p style="color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;"><u>{{ ucfirst($deptName) }}</u></p>
                            @foreach ($dept as $index => $artist)
                                <p class="mb-4" style="color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;">
                                    
                                    @if ($index + 1 != count($dept))
                                        {{ $artist }},&nbsp;
                                    @else
                                        {{ $artist }}
                                    @endif
                                </p>
                            @endforeach
                        @endif
                    @endforeach
                @endif
                <h1 style="text-align: left;color: rgb(255,255,255);font-size: 25px;font-family: 'Open Sans', sans-serif;font-weight: bold;">
                    Summary:
                </h1>
                <p class="mb-4" style="color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;">
                    {{ $series->series_description }}
                    <br>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
