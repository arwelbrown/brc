<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Series;
use App\Models\Universe;
use DataProviders\eJunkie\EjProductDataProvider;
use Illuminate\Contracts\View\View;

class StoreController extends Controller
{
    public function index(): View
    {
        $products = Product::orderByDesc('id')->where('active', 1)->paginate(24);

        $featuredProducts = Product::orderByDesc('id')->where('active', '=', 1)->where('featured_product', '=', 1)->get();

        // get universes
        $universes = Universe::all();

        return view('store', ['products' => $products, 'featuredProducts' => $featuredProducts, 'universes' => $universes]);
    }

    public function seriesStore(string $universeSlug, string $slug): View
    {
        $universe = Universe::where('universe_slug', '=', $universeSlug)->first();
        $series = $universe->series()->where('series_slug', '=', $slug)->first();

        $products = $series->products()->paginate(24);

        $charactersInSeries = $series->characters()->get()->all();

        $characters = [];

        foreach ($charactersInSeries as $character) {
            $characterToInsert = $character->where('series_id', '=', $series->id)->get()->all();

            // link other series
            if (! empty($characterToInsert[0]->appearances)) {
                $showsUpIn = $characterToInsert[0]->appearances;
                $characterToInsert[0]->appearances = [];

                $appearances = [];

                foreach ($showsUpIn as $seriesId) {
                    $seriesToInsert = Series::where('id', '=', (int) $seriesId)->get()->all();
                    $universeToInsert = $seriesToInsert[0]->universe()->get()->all();

                    $appearance = [
                        'series_name' => $seriesToInsert[0]->series_name,
                        'series_slug' => $seriesToInsert[0]->series_slug,
                        'universe_slug' => $universeToInsert[0]->universe_slug,
                    ];

                    $appearances[] = $appearance;
                }

                $characterToInsert[0]->appearances = array_merge($characterToInsert[0]->appearances, $appearances);
            }

            $characters[] = $characterToInsert;
        }

        $artTeam = [];

        if (!empty($series->artists)) {
            $artTeam['artists'] = $series->artists;
        }

        if (!empty($series->colorists)) {
            $artTeam['colorists'] = $series->colorists;
        }

        if (!empty($series->letterers)) {
            $artTeam['letterers'] = $series->letterers;
        }

        return view(
            'store-series',
            [
                'products' => $products,
                'series' => $series,
                'universe' => $universe,
                'creators' => $series->creators,
                'editors' => $series->editors,
                'writers' => $series->writers,
                'artTeam' => $artTeam,
                'characters' => isset($characters[0]) ? $characters[0] : [],
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

    public function getAllFromEjunkie(EjProductDataProvider $ej = new EjProductDataProvider)
    {
        $result = $ej->getAllFromEjunkie();

        return view('ejunkie.ejunkie', ['result' => $result]);
    }

    public function getProductByProductId(int $productId, int $page = null, EjProductDataProvider $ej = new EjProductDataProvider)
    {
        $result = $ej->getProductByProductId($productId, $page);

        return view('ejunkie.ejunkie-single-product', ['result' => $result]);
    }
}
