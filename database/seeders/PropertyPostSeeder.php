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
                'price' => 2500000.00,
                'location' => 'Kamwala south secondary school',
                'long' => -118.400356,
                'lat' => 34.073620,
                'user_id' => 1,
                'property_type_id' => 1,
                'status_id' => 1,
                'bedrooms' => 5,
                'bathrooms' => 4,
                'area' => 4500,
                'amenities' => json_encode(['Pool', 'Gym', 'Sauna']),
                'images' => json_encode([
                    'https://images.prop24.com/330526071/Crop600x400',
                    'https://content.knightfrank.com/property/zm0276/images/57e79bed-fea4-476e-828a-1e21d4b56e70-0.jpg',
                    'https://images.prop24.com/332390606/Crop600x400'
                ])
            ],
            [
                'title' => 'Cozy Apartment in Lusaka',
                'description' => 'A cozy apartment located in the heart of New York City.',
                'price' => 1200000.00,
                'location' => 'Kamwala south secondary school',
                'long' => -73.935242,
                'lat' => 40.730610,
                'user_id' => 1,
                'property_type_id' => 2,
                'status_id' => 1,
                'bedrooms' => 2,
                'bathrooms' => 1,
                'area' => 900,
                'amenities' => json_encode(['Gym', 'Doorman']),
                'images' => json_encode([
                    'https://lh6.googleusercontent.com/proxy/w9xd7rjB9tQK-feRMp13Sax-k6eHZ9ojBOpFgDWzMiHORwUF9fATBYI8meI59cKEMNmrSz_h5il7IA2QYuviKjjKfhbzbG6ulBu8onyboe4m99BDhn_SRlVLs3Ouv-qzvKjpdEmo3IMpmYGH3SZDJQ',
                    'https://real-estate-zambia.beforward.jp/wp-content/uploads/2018/03/IMG_4070-1.jpg',
                    'https://www.zambianhome.com/wp-content/uploads/2017/03/16999230_1261069797334172_599184433058358429_n.jpg',
                    'https://real-estate-zambia.beforward.jp/wp-content/uploads/2022/06/AAB14.jpg'
                ])
            ],
            // Add more entries as needed...
        ]);
    }
}
