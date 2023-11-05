<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SubmissionController extends Controller
{
    public function index(): View
    {
        return view('submissions');
    }
}
