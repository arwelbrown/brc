<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller
{
    /**
     * @return array
     */
    public function index(): array
    {
        return Book::all()->toArray();
    }
}
