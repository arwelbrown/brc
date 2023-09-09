<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


/*
            [
                'series_name' => '',
                'series_description' => '',
                'series_slug' => '',
                'series_banner' => '',
                'universe_id' => '',
            ]
*/

class SeriesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('series')->insert([
            [
                'series_name'           => 'Alexia Midnight',
                'series_description'    => 'Alexia Midnight, a newborn vampire must understand what it means to be a vampire with the best teacher of them all Dracula. Meanwhile being chased by The Vigor, a religious cult bound to hunt the night.',
                'series_slug'           => 'alexiamidnight',
                'series_banner'         => 'img/series_alexiamidnight/Alexia_Midnight_Banner.webp',
                'spin_offs'             => '',
                'universe_id'           => 1,
            ],
            [
                'series_name'           => 'Broken Realities',
                'series_description'    => 'Welcome to the first installment of the interconnected Universe known as "Broken Realities."  The Broken Realities series as a whole plans to show you the mysteries of the Universe, the origins of the gods, the birth of multiple dimensions and the events that will bring us all together into one shared canvas. This is not a one and done kind of crossover, this is not an anthology, this is a series that will help show you a Universe we as a team have created.',
                'series_slug'           => 'brokenrealities',
                'series_banner'         => 'img/series_brokenrealities/broken_realities_banner.webp',
                'spin_offs'             => '',
                'universe_id'           => 1,
            ],
            [
                'series_name'           => 'Chaos Theory',
                'series_description'    => 'Brainwashed and subjected to countless experiments in hopes of recreating his condition, Inik was held captive until he was 20 years old. During this time, Donovan managed to use the data of his failed experiments on Inik to lay the foundation for the empire that Majesty would become, by creating deviants and sending the world into a state of chaos. Now that Inik is free in this new lawless world, he only has one goal in mind… Kill the man that started all of this! ',
                'series_slug'           => 'chaostheory',
                'series_banner'         => 'img/series_chaostheory/Chaos_Theory_Banner.webp',
                'spin_offs'             => '',
                'universe_id'           => 2,
            ],
            [
                'series_name'           => 'Elements Of Agony',
                'series_description'    => 'In a world filled with mythical creatures, someone must protect mankind and keep them at peace. That person is Ka`Jal Master of the Elements. Trained by her Aunt Mariah, Ka`jal seeks to run things with an iron fist, but a new race of mythical creatures have other plans to run wild. When Ka`jal discover some disturbing news about her parents death, will she be able to balance it all?',
                'series_slug'           => 'elementsofagony',
                'series_banner'         => 'img/series_elementsofagony/EOA_Banner.webp',
                'spin_offs'             => '',
                'universe_id'           => 1,
            ],
            [
                'series_name'           => 'Escape The Pit',
                'series_description'    => "A mysterious incident has caused Castle's maximum security prison known as \"The Pit\" to malfunction. As a result, all sorts of dangerous monsters from both Legends and The Alpha Series escape.",
                'series_slug'           => 'escapethepit',
                'series_banner'         => 'img/series_escapethepit/Escape_the_pit_banner.webp',
                'spin_offs'             => '',
                'universe_id'           => 1,
            ],
            [
                'series_name'           => 'Godpunk',
                'series_description'    => 'Linked to the Greek god of cicadas, Tithonus. He must use everything he knows as an archeology grad student to navigate a new world of myths and monsters! ',
                'series_slug'           => 'godpunk',
                'series_banner'         => 'img/series_godpunk/Godpunk_Banner.webp',
                'spin_offs'             => '',
                'universe_id'           => 3,
            ],
            [
                'series_name'           => 'Legends',
                'series_description'    => 'Lancelot, the last knight of the round table, was made immortal after the final battle of Camelot. With help from a supporting cast of characters from myth and history, he must fight to protect the world from the forces of darkness that mean to cause it harm.',
                'series_slug'           => 'legends',
                'series_banner'         => 'img/series_legends/Legends_Banner.webp',
                'spin_offs'             => '',
                'universe_id'           => 1,
            ],
            [
                'series_name'           => 'Operation Nitro',
                'series_description'    => 'Operation: Nitro takes place one month after the events of The Alpha Prototype Trilogy, where James (Jim) White, formerly part of the United States Special Forces, gets reunited with former members of his unit. The unit gets called once again on a dangerous mission, where they need the help of an "enhanced".',
                'series_slug'           => 'operationnitro',
                'series_banner'         => 'img/series_operationnitro/Operation_Nitro_Banner.webp',
                'spin_offs'             => '',
                'universe_id'           => 1,
            ],
            [
                'series_name'           => 'Shadow',
                'series_description'    => 'Jason Lynch has been invited into a new partnership with the mayor of Chicago and the city\'s new E.C.U. Advisor Harry Shuester. Suspicious of the new project Jason investigates as the local vigilante (Shadow) only to find out the task may be tougher than expected. ',
                'series_slug'           => 'shadow',
                'series_banner'         => 'img/series_shadow/Shadow_Banner.webp',
                'spin_offs'             => '',
                'universe_id'           => 1,
            ],
            [
                'series_name'           => 'Super Stoner Chronic Rangers',
                'series_description'    => 'Ahhh… Love is in the air… Or is that something else? Chuuch and his girlfriend Bethany Blazeit ditch school for their anniversary to have lunch and a smoke at the park, but when they cross paths with a scornful fisherman out for blood they are thrust into a battle for survival against the large hook-fisted bastard. Can our heroes fry this fish? Tune in to find out!',
                'series_slug'           => 'chronicrangers',
                'series_banner'         => 'img/series_chronicrangers/Chronic_Rangers_Banner.webp',
                'spin_offs'             => '',
                'universe_id'           => 1,
            ],
            [
                'series_name'           => 'The Alpha',
                'series_description'    => 'What\'s it like to live in the modern world where a genetically enhanced superhuman race is taking over? You get The Alpha: The prototype and the first successfully created superhuman, as well as a new breed of super humans emerging in a world very similar to our own. ',
                'series_slug'           => 'thealpha',
                'series_banner'         => 'img/series_thealpha/The_Alpha_Banner.webp',
                'spin_offs'             => '',
                'universe_id'           => 1,
            ],
            [
                'series_name'           => 'The Final Wielder',
                'series_description'    => 'Three amulets forged by the protectors of the universe. Due to one of the wielders going mad the amulets were hidden. Charles is trained in the art of sorcery and warned about future dangers Earth faces by Andveri, the protector of the amulet. Now Charles must decide what to do about his family, the threat headed to Earth, and the other undiscovered items.',
                'series_slug'           => 'thefinalwielder',
                'series_banner'         => 'img/series_finalwielder/Final_Wielder_Banner.webp',
                'spin_offs'             => '',
                'universe_id'           => 1,
            ],
            [
                'series_name'           => 'The Super Dragonfly Sentinels',
                'series_description'    => 'Three individuals who live on the planet Selusha are recruited by a lead scientist named Beltox Van Velspot to stop an alien invasion of the Alnoe Species. The Alnoe are lizard-like humanoids who only care about repopulating other planets and spreading tyranny across the galaxy.',
                'series_slug'           => 'thesuperdragonflysentinels',
                'series_banner'         => 'img/series_thesuperdragonflysentinels/tsds_Banner.webp',
                'spin_offs'             => '',
                'universe_id'           => 3,
            ],
            [
                'series_name'           => 'Saint',
                'series_description'    => "Jake Barker always wanted to be a superhero. Acting as a vigilante for years, one day he finally got his wish… Too bad he had to die for it. As the world's first superhero, he's finding that his new life is not all that it's cracked up to be. Now out for vengeance, will his abilities be enough, or will vengeance find him first?",
                'series_slug'           => 'saint',
                'series_banner'         => 'img/series_saint/Saint_Banner.webp',
                'spin_offs'             => '',
                'universe_id'           => 2,
            ],
            [
                'series_name' => 'Armored Eagle',
                'series_description' => '',
                'series_slug' => 'armoredeagle',
                'series_banner' => 'img/series_armoredeagle/Armored_Eagle_Banner.webp',
                'spin_offs'             => '',
                'universe_id' => 4,
            ],
            [
                'series_name' => 'Moonage',
                'series_description' => '',
                'series_slug' => 'moonage',
                'series_banner' => 'img/series_moonage/Moonage_Banner.webp',
                'spin_offs'             => '',
                'universe_id' => 4,
            ],
            [
                'series_name' => 'The Sergeant',
                'series_description' => '',
                'series_slug' => 'thesergeant',
                'series_banner' => 'img/series_thesergeant/The_Sergeant_Banner.webp',
                'spin_offs'             => '',
                'universe_id' => 4,
            ],
            [
                'series_name' => 'Blaze And Vigor',
                'series_description' => '',
                'series_slug' => 'blazeandvigor',
                'series_banner' => 'img/series_blazeandvigor/Blaze_And_Vigor_Banner.webp',
                'spin_offs'             => '',
                'universe_id' => 4,
            ],
            [
                'series_name' => 'E.V.H.A',
                'series_description' => '',
                'series_slug' => 'ehva',
                'series_banner' => 'img/series_ehva/EHVA_Banner.webp',
                'spin_offs'             => '',
                'universe_id' => 4,
            ],
            [
                'series_name'           => 'Devilish',
                'series_description'    => '',
                'series_slug'           => 'devilish',
                'series_banner'         => 'img/series_devilish/Devilish_Banner.webp',
                'spin_offs'             => '',
                'universe_id'           => 2,
            ],
            [
                'series_name'           => 'The Emerald Coyote',
                'series_description'    => '',
                'series_slug'           => 'theemeraldcoyote',
                'series_banner'         => 'img/series_theemeraldcoyote/EC_Banner.webp',
                'spin_offs'             => '',
                'universe_id'           => 1,
            ],
        ]);
    }
}
