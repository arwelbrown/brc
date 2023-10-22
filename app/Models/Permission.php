<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as PermissionsRole;

class Permission extends PermissionsRole
{
    use HasFactory;
}
