<?php

namespace App\Http\Controllers;

use App\Formatters\StringFormatter;
use App\Models\Product;
use App\Models\Series;
use App\Models\Universe;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\Foundation\Application as FoundationApplication;
use DataProviders\eJunkie\EjProductDataProvider;

class StoreController extends Controller
{
    public function index(): View|Application|Factory|FoundationApplication
    {
        $products = Product::all()->where('active', 1)->paginate(24);

        $featuredProducts = [];

        // quick and dirty fix

        $featuredProducts[] = Product::find(42);
        $featuredProducts[] = Product::find(43);

        return view('store', ['products' => $products, 'featuredProducts' => $featuredProducts]);
    }

    public function seriesStore(string $universeSlug, string $slug): View|Application|Factory|FoundationApplication
    {
        $universe = Universe::where('universe_slug', '=', $universeSlug)->get()->all();
        $products = Product::all()->where('store_slug', $slug)->paginate(24);
        $series = Series::where('series_slug', $slug)->first();

        $artTeam = [
            'artists' => $series->artists,
            'colorists' => $series->colorists,
            'letterers' => $series->letterers,
        ];

        return view(
            'store-series',
            [
                'products' => $products,
                'series' => $series,
                'universe' => $universe[0],
                'creators' => $series->creators,
                'editors' => $series->editors,
                'writers' => $series->writers,
                'artTeam' => $artTeam,
            ]
        );
    }

    public function universeStore(string $slug) 
    {
        $universe = Universe::where('universe_slug', $slug)->first();
        $seriesInUniverse = $universe->series()->get()->all();

        $products = [];


        foreach ($seriesInUniverse as $series) {
            $productsInSeries = $series->products()->get()->all();
            $products = array_merge($productsInSeries, $products);
        }


        return view('store-universe', ['universe' => $universe, 'seriesInUniverse' => $seriesInUniverse, 'products' => $products]);
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
