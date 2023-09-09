<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacterSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('characters')->insert([
            [
                'real_name' => 'Jason Perez',
                'name' => 'The Alpha ',
                'race' => 'Adaptable A-Tier',
                'aliases' => '',
                'abilities' => '',
                'weaknesses' => '',
                'affiliations' => '',
                'appearances' => '',
                'history' => 'Jason was abducted by a secret organization called The Corp. His DNA was genetically altered and modified to create the very first successful lab tested "super-being" i.e. The Prototype with the goal of reshaping humanity. Jason along with three others became a notoriously dangerous mercenary group called The Four who for a certain amount of time has worked for The Corp. He took on the role of leader in the group (The Alpha). Due to unpredicted circumstances and a terrible accident The Four have disappeared from the public image and the control of The Corp for years (including The Alpha). He has lived in hiding under his normal name and has vowed to never become The Alpha again until a set of particular circumstances occurs.',
                'img_string' => '',
                'series_id' => 11
            ]
        ]);
    }
}
