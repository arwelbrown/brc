<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
            * Seed the application's database.
            */
    public function run(): void
    {
        $this->call([
            UniverseSeeder::class,
            SeriesSeeder::class,
            ProductSeeder::class,
            CharacterSeeder::class,
        ]);

        User::create([
            'name' => 'Arwel Brown',
            'email' => 'arwel@brc.com',
            'password' => password_hash('Jazzmaster03!', PASSWORD_ARGON2I),
            'email_verified_at' => Carbon::now(),
            'position' => 'Founder',
            'img_string' => 'img/br_admin/brc_team/arwel.webp'
        ]);

        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'Edit All']);

        $role->givePermissionTo($permission);

        $user = User::where('name', '=', 'Arwel Brown')->get()->all()[0];
        $user->assignRole('admin');
    }
}
