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
                'publisher_name' => 'Zero Medal Comix',
                'publisher_email' => 'rogferraz@gmail.com',
                'primary_contact' => 'Rogerio Ferraz da Silva',
                'logo' => 'img/other_publishers/Zero_Medal/Zero_Medal_Title.webp',
                'description' => "At First Sight Garra and Pandora's first adventure. In this issue, Garra, a creature created in an alien laboratory by using human DNA and tiger DNA, is sent to planet Earth to kill a young police woman named Pandora and retrieve the Universe Medal she just got from a strange unidentified biker. Mystery surrounds the relationship between the Garra alien creator called Dr. Mente, an old rival known only as Beta and the missing Pandora's brother.",
                'banner' => 'img/other_publishers/Zero_Medal/Zero_Medal_Web_Banner.webp'
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
                'publisher_name' => 'Lumo Station LLC',
                'publisher_email' => 'lumostation@gmail.com',
                'primary_contact' => 'Adam Mullen',
                'logo' => 'img/other_publishers/Lumostation/lumostation.webp',
                'description' => 'Lumo Station LLC is a multimedia production small business and is owned and operated by indie composer and writer Adam Mullen. It provides services in music composition and script editing & writing, as well as produces its own original content in the form of comics, music, and short stories.',
                'banner' => 'img/other_publishers/Lumostation/lumostation_banner.webp'
            ],
            [
                'publisher_name' => 'Flat Timez Publishing',
                'publisher_email' => 'awaken.the.story@gmail.com',
                'primary_contact' => 'William Fiske',
                'logo' => 'img/other_publishers/Flat_Timez/awaken-logo.webp',
                'description' => 'In a world where earth has been destroyed, and humanity is kept alive with space-age technology, we follow the awakening of one kid as he comes to know himself in the dystopian world that he calls home. Awaken explores ideas of philosophy, spirituality  and politics, asking such questions as, "who are we?" "what are we?" and where are we going as a species?"',
                'banner' => 'img/other_publishers/Flat_Timez/Flat_Timez_Publishing_Web_Banner.webp'
            ],
            [
                'publisher_name' => 'JRD Comics',
                'publisher_email' => 'joshuadbar@gmail.com',
                'primary_contact' => 'Joshua Dunbar',
                'logo' => 'img/other_publishers/Jrd_comics/SAINT_TITLE.webp',
                'description' => "Jake Barker always wanted to be a superhero. Acting as a vigilante for years, one day he finally got his wish… Too bad he had to die for it. As the world's first superhero, he's finding that his new life is not all that it's cracked up to be. Now out for vengeance, will his abilities be enough, or will vengeance find him first?",
                'banner' => 'img/other_publishers/Jrd_comics/JRD_WEB_BANNER.webp'
            ],
            [
                'publisher_name' => 'Godpunk Official',
                'publisher_email' => 'officialgodpunk@gmail.com',
                'primary_contact' => 'Cameron Lee',
                'logo' => 'img/series_godpunk/GodPunk_Title.webp',
                'description' => 'Linked to the Greek god of cicadas, Tithonus. He must use everything he knows as an archeology grad student to navigate a new world of myths and monsters!',
                'banner' => 'public/img/series_godpunk/Godpunk_Banner.webp'
            ]
        ]);
    }
}
