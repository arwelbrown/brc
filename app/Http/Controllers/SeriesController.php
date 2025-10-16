<?php

namespace App\Http\Controllers;

use App\Models\Series;

class SeriesController extends Controller
{
    public static function getSeries(int $id): object
    {
        return Series::where("id", $id)->first();
    }
}
