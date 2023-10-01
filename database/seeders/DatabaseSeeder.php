<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::where('id', '=', 3)->get()->all()[0];
        $user->assignRole('admin');

        // $this->call([
        // UniverseSeeder::class,
        // SeriesSeeder::class,
        // ProductSeeder::class,
        // TeamSeeder::class,
        // UserSeeder::class,
        // CharacterSeeder::class,
        // ]);
    }
}
