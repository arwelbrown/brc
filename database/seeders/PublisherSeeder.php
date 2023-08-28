<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublisherSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('publishers')->insert([
            [
                'publisher_name' => 'Broken Reality Comics',
                'publisher_email' => 'broken-reality-comics@hotmail.co.uk',
                'primary_contact' => 'Gruffydd Thomas',
                'logo' => 'img/br_admin/hexa_final_1.webp',
                'description' => null,
                'banner' => 'img/br_admin/brc_wallpaper.webp'
            ],
            [
                'publisher_name' => 'ECRU Comics',
                'publisher_email' => 'carrilloartstudios@gmail.com',
                'primary_contact' => 'Erik Carrillo',
                'logo' => null,
                'description' => 'Ecrucomics is a comic book universe started by Erik Carrillo in 2014. A collection of heroes throughout different points in time that come together to form E.H.V.A. in order to fight off an ancient alien force known as the Anunnaki. Follow along on this epic journey! ',
                'banner' => 'img/other_publishers/ecru_comics/Ecrucomics_Banner.webp'
            ],
            [
                'publisher_name' => 'JRD Comics',
                'publisher_email' => 'joshuadbar@gmail.com',
                'primary_contact' => 'Joshua Dunbar',
                'logo' => 'img/other_publishers/Jrd_comics/SAINT_TITLE.webp',
                'description' => "Jake Barker always wanted to be a superhero. Acting as a vigilante for years, one day he finally got his wish… Too bad he had to die for it. As the world's first superhero, he's finding that his new life is not all that it's cracked up to be. Now out for vengeance, will his abilities be enough, or will vengeance find him first?",
                'banner' => 'img/other_publishers/Jrd_comics/JRD_WEB_BANNER.webp'
            ],
        ]);
    }
}
