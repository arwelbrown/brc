<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniverseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('universes')->insert([
            [
                'universe_name'         =>  'BR Universe',
                'universe_slug'         => 'bruniverse',
                'universe_summary'      => 'Step into a world of imagination and adventure! Explore the shelves and discover the iconic heroes that exist within the BRUniverse. Whether you\'re a seasoned collector or new to the genre, we have something for every fan.',
                'universe_description'  => 'After the death of Tenebris in “Broken Realities #1”, the known Universe was forced to endure a cataclysmic release of energy. The force of the event was strong enough to divide the Universe into three territories.' 
            ],
            [
                'universe_name'         => 'Saint Verse',
                'universe_slug'         => 'saintverse',
                'universe_summary'      => 'Home to the iconic indie titles SAINT, CHAOS THEORY, and DEVILISH!',
                'universe_description'  => '',
            ],
            [
                'universe_name'         => 'Toku-Verse',
                'universe_slug'         => 'tokuverse',
                'universe_summary'      => 'Home of the toku sector of Broken Reality Comics which includes popular titles like GODPUNK and The Super Dragonfly Sentinels',
                'universe_description'  => '',
            ],
            [
                'universe_name' => 'Ecru-Verse',
                'universe_slug' => 'ecruverse',
                'universe_summary'  => 'Home of ECRU Comics Titles "The Sergeant, Moonage, Blaze & Vigor, Armored Eagle, and E.H.V.A.',
                'universe_description'  => '',
            ],
        ]);
    }
}