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
        $departments = [];

        foreach ($this->getDepartmentNames() as $departmentName) {
            if ($departmentName != 'None') {
                $department = Department::where('name', '=', $departmentName)->first();
                $users = User::where('departments_id', '=', $department->id)->get()->all();
    
                $departments[$department->name] = $users;
            }
        }

        return view('about-us', ['departments' => $departments]);
    }
}