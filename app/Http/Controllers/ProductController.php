<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Publisher;
use App\Models\Series;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\Foundation\Application as FoundationApplication;
use DataProviders\eJunkie\EjProductDataProvider;

class ProductController extends Controller
{
    public function index(): View|Application|Factory|FoundationApplication
    {
        $products = Product::all()->where('active', 1)->paginate(24);

        return view('store', compact('products'));
    }

    public function creatorStore(string $slug): View|Application|Factory|FoundationApplication
    {
        $products = Product::all()->where('store_slug', $slug)->paginate(24);

        $series = Series::where('series_slug', $slug)->first();

        return view('creator-store', ['products' => $products, 'series' => $series]);
    }

    public function otherCreators(string $slug): View|Application|Factory|FoundationApplication
    {
        $products = Product::all()->where('store_slug', $slug);

        $publisherId = $products->first()->publisher_id;

        $publisher = Publisher::where('id', $publisherId)->first();

        return view('other-creators', ['products' => $products, 'publisher' => $publisher]);
    }

    public function getAllFromEjunkie()
    {
        $ej = new EjProductDataProvider();
        $result = $ej->getAllFromEjunkie();

        return view('ejunkie.ejunkie', ['result' => $result]);
    }

    public function getProductByProductId(int $productId, ?int $page = null)
    {
        $ej = new EjProductDataProvider();
        $result = $ej->getProductByProductId($productId, $page);

        return view('ejunkie.ejunkie-single-product', ['result' => $result]);
    }
}
