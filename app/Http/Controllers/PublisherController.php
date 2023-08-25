<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class PublisherController extends Controller
{
    public function index()
    {
        $publishers = DB::table('publishers')->select(
            'id',
            'publisher_name',
            'publisher_email'
        )->get();

        return view('publishers')->with('publishers', $publishers);
    }
}
