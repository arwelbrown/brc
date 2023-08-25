<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    public function  run(): void
    {
        DB::table('teams')->insert([
            [
                'name' => 'Gruff',
                'bio' => 'Co-Founder of Broken Reality Comics and the head of the entire operation. He is in charge of running and organizing the business and creative side of BRC.',
                'role' => 'Admin Lead',
                'img_string' => 'img/br_admin/gruff.webp'
            ],
            [
                'name' => 'Joel',
                'bio' => 'Co-Founder of Broken Reality Comics and head of branding and marketing. Joel is in charge of the BRC branding decisions, as well as the graphic design used for our ads and promotional material.',
                'role' => 'Marketing Lead',
                'img_string' => 'img/br_admin/joel.webp'
            ],
            [
                'name' => 'Arwel',
                'bio' => 'Head of the Broken Reality Comics IT department, which consists of coding, modifying, optimizing, maintaining, and updating the website, as well as other tech support.',
                'role' => 'IT Lead',
                'img_string' => 'img/br_admin/arwel.webp'
            ],
            [
                'name' => 'Isaac',
                'bio' => 'Head manager of the Broken Reality Comics creative decisions and production management departments.',
                'role' => 'Creative Lead',
                'img_string' => 'img/br_admin/isaac.webp'
            ],
            [
                'name' => 'Jamal',
                'bio' => 'The man responsible for running the Broken Reality Comics book store, from printing physicals to shipping orders.',
                'role' => 'Sales Lead',
                'img_string' => 'img/br_admin/Jamal.webp'
            ],
            [
                'name' => 'Ricky',
                'bio' => 'Manager of distribution and sales, including comics, books, and various Broken Reality Comics products.',
                'role' => 'Product Lead',
                'img_string' => 'img/br_admin/Ricky.webp'
            ],
            [
                'name' => 'Josh',
                'bio' => 'The editor in charge of keeping the Broken Reality Comics website and books clean and consistent.',
                'role' => 'Editorial Lead',
                'img_string' => 'img/br_admin/Josh.webp'
            ],
            [
                'name' => 'Chip',
                'bio' => 'The lead of all data interpretation, providing data-supported insights to help improve the Broken Reality Comics business in a magnitude of ways.',
                'role' => 'Analytical Lead',
                'img_string' => 'img/br_admin/chip.webp'
            ],
            [
                'name' => 'Pierce',
                'bio' => 'The legal expert at Broken Reality Comics, responsible for any and all things regarding legality, including contracts, copyrights, and more.',
                'role' => 'Legal Lead',
                'img_string' => 'img/br_admin/Pierce.webp'
            ],
            [
                'name' => 'Kostis',
                'bio' => 'The one responsible for quality control in regards to the Broken Reality Comics narratives, characters, and the various elements that comprise the BRC fictional worlds.',
                'role' => 'Quality Lead',
                'img_string' => 'img/br_admin/kon.webp'
            ],
        ]);
    }
}
