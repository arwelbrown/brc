@extends('layouts.app')
@section('content')
    <section class="py-4 py-xl-5 text-center"
        style="background: linear-gradient(rgba(9,0,34,0.75) 0%, #000000 100%), url({{ url('storage/img/br_admin/brc_wallpaper.webp') }}) center / cover no-repeat;">
        <h1 data-aos="fade-up"
            style="margin-top: 80px;font-family: Anton, sans-serif;color: rgb(255,255,255);font-size: 50PX;margin-bottom: 30px;">
            EXPLORE THE GREAT BEYOND!
        </h1>
        <div class="container-fluid" data-aos="fade-up">
            <section>
                  <div class="row justify-content-center" style="margin-bottom: 20px;">
                      @foreach($canons as $canon)
                        <div class="col-sm-3 col-md-3 col-lg-4 col-xl-4" data-bss-hover-animate="pulse"
                            style="margin-bottom: 20px;">
                            <a class="d-inline-block" href="/store/canon/{{ $canon->slug }}">
                                <img
                                    class="img-fluid"
                                    src="{{ asset($canon->img_string) }}"
                                >
                            </a>
                        </div>
                      @endforeach
                </div>
            </section>
        </div>
    </section>
    <section class="text-center bg-black">
        <div class="container">
            <div class="row g-1 justify-content-center align-items-center">
                <div class="col-lg-9 align-self-center" style="margin-top: 10px;">
                    <div class="pagination-block">
                        {{ $books->links('layouts.store-pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center bg-black">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-4 col-md-6 col-lg-5 col-xxl-4 align-self-center">
                    <h2
                        style="font-family: Anton, sans-serif;color: rgb(255,255,255);font-size: 40PX;letter-spacing: 2px;text-align: left;">
                        THE BRC SHOWCASE!
                    </h2>
                    <p
                        style="font-family: 'Open Sans', sans-serif;background: rgba(255,255,255,0);font-size: 14px;text-align: left;">
                        <span style="color: rgb(255, 255, 255);">Make sure to follow us on instagram @brokenrealitycomics to
                            keep track Phase 1 and the latest comic book releases!</span>
                    </p>
                </div>
                @foreach ($featuredBooks as $book)
                    @include('store.store-card', ['book' => $book])
                @endforeach
            </div>
        </div>
        <div class="container" style="max-width: 900px;">
            <h2
                style="font-family: Anton, sans-serif;color: rgb(255,255,255);font-size: 50PX;letter-spacing: 2px;margin-top: 50PX;">
                DISCOVER ALL COMICS!</h2>
            <p style="font-family: 'Open Sans', sans-serif;background: rgba(255,255,255,0);font-size: 14px;">
              <span style="color: rgb(255, 255, 255);">
                Get digital copies of our latest comic books and check out our shop
                by creator section for character information and blurbs written by each creator.&nbsp;Check out the all
                the stories provided by the individual creators that are members of Broken Reality Comics!&nbsp;Our
                catalog includes: Fantasy, Sci-Fi, Horror, Superheroes, Tokusatsu, Vigilantes, Reality Hopping, and
                more...
              </span>
            </p>
        </div>
        <div class="container">
            <div class="row d-flex justify-content-center">
                @foreach ($books as $book)
                    @include('store.store-card', ['book' => $book])
                @endforeach
            </div>
        </div>
    </section>
    <section class="text-center bg-black">
        <div class="container">
            <div class="row g-1 justify-content-center align-items-center">
                <div class="col-lg-9 align-self-center" style="margin-top: 10px;">
                    <div class="pagination-block">
                        {{ $books->links('layouts.store-pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
