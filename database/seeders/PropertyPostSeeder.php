<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PropertyPostSeeder extends Seeder
{
    public function run()
    {

        DB::table('property_posts')->insert([
            [
                'title' => '5 Rooms Luxurious Villa in Beverly Hills',
                'description' => 'A luxurious villa with stunning views and modern amenities.',
                'price' => 10000.00,
                'location' => 'Kamwala south secondary school',
                'long' => -118.400356,
                'lat' => 34.073620,
                'user_id' => 1,
                'property_type_id' => 1,
                'location_id' => 2,
                'category_id' => 3,
                'status_id' => 1,
                'bedrooms' => 5,
                'bathrooms' => 4,
                'area' => 4500
            ],
            [
                'title' => 'Cozy Apartment in Lusaka',
                'description' => 'A cozy apartment located in the heart of New York City.',
                'price' => 1400.00,
                'location' => 'Kamwala south secondary school',
                'long' => -73.935242,
                'lat' => 40.730610,
                'user_id' => 1,
                'property_type_id' => 2,
                'location_id' => 1,
                'category_id' => 1,
                'status_id' => 1,
                'bedrooms' => 2,
                'bathrooms' => 1,
                'area' => 900
            ],
            [
                'title' => 'Big House in Lusaka',
                'description' => 'A cozy apartment located in the heart of New York City.',
                'price' => 12000.00,
                'location' => 'Kamwala south secondary school',
                'long' => -73.935242,
                'lat' => 40.730610,
                'user_id' => 1,
                'property_type_id' => 2,
                'location_id' => 3,
                'category_id' => 1,
                'status_id' => 1,
                'bedrooms' => 2,
                'bathrooms' => 1,
                'area' => 900
            ],
            [
                'title' => 'Neat House in Lusaka',
                'description' => 'A cozy apartment located in the heart of New York City.',
                'price' => 1000.00,
                'location' => 'Kamwala south secondary school',
                'long' => -73.935242,
                'lat' => 40.730610,
                'user_id' => 1,
                'property_type_id' => 2,
                'location_id' => 1,
                'category_id' => 1,
                'status_id' => 1,
                'bedrooms' => 2,
                'bathrooms' => 1,
                'area' => 900
            ],
            // Add more entries as needed...
        ]);
    }
}
