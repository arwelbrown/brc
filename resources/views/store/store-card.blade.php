<div class="card border rounded-1 bg-black" style="height: 100%;">
    <div class="card-body d-flex flex-column justify-content-between" style="padding-top: 16px;">
        <img
            class="img-fluid"
            style="{{ $book->summary != '.' ? 'cursor: pointer;' : '' }}"
            data-bs-toggle="modal"
            data-bs-target="#show_modal_{{ $book->id }}"
            src="{{ asset($book->img_string) }}"
        >
        <h2 class="name"
            style="font-family: 'Open Sans', sans-serif;font-size: 15px;padding-top: 15px;font-weight: bold;color: rgb(255,255,255);"
        >
            {{ $book->name }}
        </h2>
        @if (!empty($book->in_development) && $book->in_development === 1)
            <p class="text-white" style="font-size: 18px;"><strong>Coming Soon!</strong></p>
        @else
            <p class="text-white" style="font-family: 'Open Sans', sans-serif;font-size: 13px;">
                Digital: ${{ $book->digital_price }}
            </p>
            <button class="btn btn-light">
                <a
                    href='{{ $book->ejunkie_link_digital }}'
                    onclick='return EJEJC_lc(this);'
                    target='ej_ejc' class='ec_ejc_thkbx'
                    style="color:black;font-family:'Open Sans', sans-serif;font-weight:900;font-size:10px;text-decoration:none;"
                >
                    ADD TO CART
                </a>
            </button>
        @endif
        @if (!empty($book->physical_price) && !empty($book->ejunkie_link_physical) && (int) $book->physical_available === 1)
            <p style="font-size: 15px;">Physical: ${{ $book->physical_price }}</p>
            <button class="btn btn-light">
                <a href='{{ $book->ejunkie_link_physical }}' onclick='return EJEJC_lc(this);'
                    target='ej_ejc' class='ec_ejc_thkbx'
                    style="color:black;font-family:'Open Sans', sans-serif;font-weight:900;font-size:10px;text-decoration:none;">
                    ADD TO CART
                </a>
            </button>
        @endif
    </div>
</div>

@if ($book->summary != '.')
    @include('partials.store-modal' , ['book' => $book])
@endif
