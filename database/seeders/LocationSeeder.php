<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        DB::table('locations')->insert([
            [
                'name' => 'Lusaka',
                'desc' => 'Lusaka Province',
                'content' => '',
            ],
            [
                'name' => 'Ndola',
                'desc' => 'Copperbelt Province',
                'content' => '',
            ],
            [
                'name' => 'Livingstone',
                'desc' => 'Southern Province',
                'content' => '',
            ],
            [
                'name' => 'Kitwe',
                'desc' => 'Copperbelt Province',
                'content' => '',
            ],
            [
                'name' => '10 Miles',
                'desc' => 'Lusaka Province',
                'content' => '',
            ],
            [
                'name' => 'Kafue',
                'desc' => 'Lusaka Province',
                'content' => '',
            ],
        ]);
    }
}
