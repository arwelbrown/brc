<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

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
            TeamSeeder::class,
            CharacterSeeder::class,
        ]);

        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'Edit All']);

        $role->givePermissionTo($permission);

        $user = User::where('name', '=', 'Arwel Brown')->get()->all()[0];
        $user->assignRole('admin');
    }
}
