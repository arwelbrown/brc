<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(['name' => 'brc']);
        Role::create(['name' => 'jrd']);
        Role::create(['name' => 'ecru']);

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
