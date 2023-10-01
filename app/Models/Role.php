<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as RolesModel;

class Role extends RolesModel
{
    use HasFactory;
}
