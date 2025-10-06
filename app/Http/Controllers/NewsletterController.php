<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Contracts\View\View;
use App\Helpers\AssetHelper;

class NewsletterController extends Controller
{
    public function index(): View
    {
        $newsletters = Newsletter::orderByDesc('id')->paginate(24);
        foreach ($newsletters as $newsletter) {
            $newsletter->img_string = AssetHelper::getPublicAssetPath($newsletter->img_string);
            $newsletter->file_path = AssetHelper::getPublicAssetPath($newsletter->file_path);
        }

        return view('brc-newsletter', ['newsletters' => $newsletters]);
    }
}
