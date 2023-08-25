<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
class TeamController extends Controller
{
    public function index()
    {
        $team = DB::table('teams')->select(
    'name',
            'bio',
            'role',
            'img_string'
        )->get();

        return view('about-us')->with('team', $team);
    }
}
