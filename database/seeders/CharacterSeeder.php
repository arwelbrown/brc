<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CharacterSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('characters')->insert([
            [
                ''
            ]
        ])
    }
}
