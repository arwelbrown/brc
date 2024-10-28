<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Contracts\View\View;

class NewsletterController extends Controller
{
    public function index(): View
    {
        $newsletters = Newsletter::orderByDesc('id')->paginate(24);

        return view('brc-newsletter', ['newsletters' => $newsletters]);
    }
}
