<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Series;
use App\DataProviders\eJunkie\EjProductDataProvider;
use Illuminate\Contracts\View\View;

class StoreController extends Controller
{
    public function index(): View
    {
        $books = Book::orderByDesc('id')->where('active', 1)->paginate(24);
        $featuredBooks = Book::orderByDesc('id')->where('active', 1)->where('featured_product', 1)->get();

        return view('store', ['books' => $books, 'featuredBooks' => $featuredBooks]);
    }

    public function series(string $slug): View
    {
        $series = Series::where('series_slug', $slug)->get()->first();

        $books = $series->books()->paginate(24);

        $charactersInSeries = $series->characters()->get()->all();

        $characters = [];

        foreach ($charactersInSeries as $character) {
            $characterToInsert = $character
                ->where('series_id', '=', $series->id)
                ->get()
                ->all();

            // link other series
            if (!empty($characterToInsert[0]->appearances)) {
                $showsUpIn = $characterToInsert[0]->appearances;
                $characterToInsert[0]->appearances = [];

                $appearances = [];

                foreach ($showsUpIn as $seriesId) {
                    $seriesToInsert = Series::where('id', '=', (int) $seriesId)->get()->all();

                    $appearance = [
                        'series_name' => $seriesToInsert[0]->series_name,
                        'series_slug' => $seriesToInsert[0]->series_slug,
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
                'store'         => $series->brc_series == 1 ? 'BRC' : 'Community',
                'products'      => $books,
                'series'        => $series,
                'creators'      => $series->creators,
                'editors'       => $series->editors,
                'writers'       => $series->writers,
                'artTeam'       => $artTeam,
                'characters'    => isset($characters[0]) ? $characters[0] : [],
            ]
        );
    }

    public function brcOrCommunity(string $slug): View
    {
        switch ($slug) {
            case 'brc':
                $brcBooks = 1;
                $bgImg = 'img/universe_bruniverse/bruniverse2.webp';
                $storeLogo = 'img/universe_brokenrealitycomics/BRC LOGO TAG.webp';
                $description = '
                    After the death of Tenebris in “Broken Realities #1”, the known Universe was forced to endure a cataclysmic release of energy. 
                    The force of the event was strong enough to divide the Universe into three territories.
                ';
                break;
            case 'community':
                $brcBooks = 0;
                $bgImg = 'img/universe_infinitedimensions/beyond.webp';
                break;
            default:
                throw new \Exception('Invalid URL!');
        }


        $seriesCollection = Series::where('brc_series', $brcBooks)->get();

        $books = [];
        foreach ($seriesCollection as $series) {
            foreach ($series->books()->get()->all() as $book) {
                $books[] = $book;
            }
        }

        return view(
            'store-brc-or-community',
            [
                'title'             => $slug,
                'books'             => $books,
                'bgImg'             => $bgImg,
                'storeDescription'  => $description ?? null,
                'storeLogo'         => $storeLogo ?? null,
                'seriesInStore'     => $seriesCollection,
            ]
        );
    }

    public function getAllFromEjunkie(): array
    {
        $ej = new EjProductDataProvider();
        $result = $ej->getAllFromEjunkie();

        $products = $result['products'];

        return $products;
    }

    public function getProductByProductId(int $productId): array
    {
        $ej = new EjProductDataProvider();
        $result = $ej->getProductByProductId($productId);

        return $result;
    }
}
