<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\DataProviders\eJunkie\EjProductDataProvider;
use App\Models\Department;
use Illuminate\Contracts\View\View;

class DepartmentController extends Controller
{
    private function getDepartmentNames(): array
    {
        return Department::all('name')->toArray();
    }

    public function index()
    {
        //
    }
}