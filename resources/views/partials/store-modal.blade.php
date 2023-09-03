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