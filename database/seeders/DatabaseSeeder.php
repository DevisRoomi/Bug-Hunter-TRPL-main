<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $equipments = [
            [
                'name' => 'Power Bank',
                'image' => 'images/power-bank-missing.jpg',
            ],
            [
                'name' => 'Jas Hujan',
                'image' => 'images/jas-hujan.jpg',
            ],
            [
                'name' => 'Senter',
                'image' => 'images/senter.jpg',
            ],
            [
                'name' => 'Backpack',
                'image' => 'images/backpack.jpg',
            ],
        ];

        foreach ($equipments as $equipment) {
            DB::table('equipments')->updateOrInsert(
                ['name' => $equipment['name']],
                ['image' => $equipment['image']]
            );
        }
    }
}
