<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use \Illuminate\Contracts\Foundation\Application as FoundationApplication;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function index(): View|Application|Factory|FoundationApplication
    {
        $products = Product::paginate(24);

        return view('store', ['products' => $products]);
    }

    public function creatorStore(string $slug): View|Application|Factory|FoundationApplication
    {
        $products = DB::table('products')->select(
                    'id',
                    'product_name',
                    'series',
                    'tags',
                    'ejunkie_link_digital',
                    'ejunkie_link_physical',
                    'publisher_id',
                    'summary',
                    'digital_price',
                    'physical_price',
                    'img_string',
                    'in_development',
                    'physical_available',
                    'store_slug'
        )->where('store_slug', $slug)->get();

        $series = DB::table('series')->select(
            'series_name',
                    'series_logo',
                    'series_description',
                    'series_banner',
                    'has_characters_tab'
        )->where('series_slug', $slug)->get();

        return view('creator-store', ['products' => $products, 'series' => $series]);
    }

    public function otherCreators(string $slug): View|Application|Factory|FoundationApplication
    {
        $products = DB::table('products')->select(
            'id',
            'product_name',
            'series',
            'tags',
            'ejunkie_link_digital',
            'ejunkie_link_physical',
            'publisher_id',
            'summary',
            'digital_price',
            'physical_price',
            'img_string',
            'in_development',
            'physical_available',
            'store_slug'
        )->where('store_slug', $slug)->get();

        $publisherId = $products[0]->publisher_id;

        $publisher = DB::table('publishers')->select(
            'id',
                    'publisher_name',
                    'publisher_email',
                    'logo',
                    'description',
                    'banner'
        )->where('id', $publisherId)->get();

        return view('other-creators', ['products' => $products, 'publisher' => $publisher]);
    }
}
