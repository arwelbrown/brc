<?php

namespace App\Http\Controllers;

use App\Models\Canon;
use App\Models\Book;
use App\Models\Series;
use App\DataProviders\eJunkie\EjProductDataProvider;
use Illuminate\Contracts\View\View;
use App\Helpers\AssetHelper;

class StoreController extends Controller
{
    /**
     *  Main store view
     *
     * @return View
     */
    public function index(): View
    {
        $books = Book::where("active", 1)->orderByDesc("id")->paginate(24);
        // set books asset paths
        foreach ($books as $book) {
            $book->img_string = AssetHelper::getPublicAssetPath(
                $book->img_string,
            );
        }

        $featuredBooks = Book::where("active", true)
            ->where("featured_product", true)
            ->orderByDesc("id")
            ->get();

        foreach ($featuredBooks as $featuredBook) {
            $featuredBook->img_string = AssetHelper::getPublicAssetPath(
                $featuredBook->img_string,
            );
        }

        $fetchCanons = Canon::all()->where("active", 1);
        $canons = [];
        foreach ($fetchCanons as $canon) {
            $canon->img_string = AssetHelper::getPublicAssetPath(
                $canon->img_string,
            );
            $canons[] = $canon;
        }

        return view("store.store", [
            "canons" => $canons,
            "books" => $books,
            "featuredBooks" => $featuredBooks,
        ]);
    }

    public function canon(string $slug): View
    {
        $canon = Canon::where("slug", "=", $slug)->get()->first();
        $seriesInCanon = $canon->series()->get();

        $canon->img_string = AssetHelper::getPublicAssetPath(
            $canon->img_string,
        );

        $canon->bg_img_string = AssetHelper::getPublicAssetPath(
            $canon->bg_img_string ?? $canon->img_string,
        );

        $formattedSeries = [];
        foreach ($seriesInCanon as $series) {
            $series->series_banner = AssetHelper::getPublicAssetPath(
                $series->series_banner,
            );
            $formattedSeries[] = $series;
        }

        $books = [];

        foreach ($seriesInCanon as $series) {
            foreach ($series->books()->get() as $book) {
                $book->img_string = AssetHelper::getPublicAssetPath(
                    $book->img_string,
                );
                $books[] = $book;
            }
        }

        return view("store.store-canon", [
            "canon" => $canon,
            "seriesInCanon" => $formattedSeries,
            "books" => $books,
        ]);
    }

    /**
     * Returns series store view
     *
     * @param $slug url slug
     *
     * @return View
     */
    public function series(string $slug): View
    {
        $series = Series::where("series_slug", $slug)->get()->first();
        $books = $series->books()->paginate(24);
        $charactersInSeries = $series->characters()->get()->all();

        // set book asset paths
        foreach ($books as $book) {
            $book->img_string = AssetHelper::getPublicAssetPath(
                $book->img_string,
            );
        }

        // set series asset paths
        $series->series_banner = AssetHelper::getPublicAssetPath(
            $series->series_banner,
        );

        $characters = [];

        foreach ($charactersInSeries as $character) {
            // set asset paths
            $character->img_string = AssetHelper::getPublicAssetPath(
                $character->img_string,
            );

            // link other series
            if (!empty($character->appearances)) {
                $showsUpIn = $character->appearances;

                $appearances = [];

                foreach ($showsUpIn as $seriesId) {
                    $seriesToInsert = Series::where("id", "=", (int) $seriesId)
                        ->get()
                        ->all();

                    $appearance = [
                        "series_name" => $seriesToInsert[0]->series_name,
                        "series_slug" => $seriesToInsert[0]->series_slug,
                    ];

                    $appearances[] = $appearance;
                }

                $character->appearances = $appearances;
            }

            $characters[] = $character;
        }

        $artTeam = [];

        if (!empty($series->artists)) {
            $artTeam["artists"] = $series->artists;
        }

        if (!empty($series->colorists)) {
            $artTeam["colorists"] = $series->colorists;
        }

        if (!empty($series->letterers)) {
            $artTeam["letterers"] = $series->letterers;
        }

        return view("store.store-series", [
            "canon" => $series->canon()->get()->first(),
            "books" => $books,
            "series" => $series,
            "creators" => $series->creators,
            "editors" => $series->editors,
            "writers" => $series->writers,
            "artTeam" => $artTeam,
            "characters" => $characters,
        ]);
    }

    public function getAllFromEjunkie(): array
    {
        $ej = new EjProductDataProvider();
        $result = $ej->getAllFromEjunkie();

        $products = $result["products"];

        return $products;
    }

    public function getProductByProductId(int $productId): array
    {
        $ej = new EjProductDataProvider();
        $result = $ej->getProductByProductId($productId);

        return $result;
    }
}
