<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Apartment',
                'desc' => 'High-rise and low-rise apartment buildings.',
                'content' => 'Apartments are self-contained housing units that occupy part of a building.',
                'icon_name' => 'building',
                'type' => 'font-awesome',
            ],
            [
                'name' => 'House',
                'desc' => 'Standalone houses with multiple rooms.',
                'content' => 'Houses are residential buildings that stand alone, often with multiple rooms and sometimes with yards.',
                'icon_name' => 'home',
                'type' => 'material-community',
            ],
            [
                'name' => 'Condo',
                'desc' => 'Condominium units.',
                'content' => 'Condos are individual units within a larger property complex, typically with shared amenities.',
                'icon_name' => 'city',
                'type' => 'material-community',
            ],
            [
                'name' => 'Townhouse',
                'desc' => 'Multi-floor homes that share one or two walls with adjacent properties.',
                'content' => 'Townhouses are multi-story homes that share walls with adjacent units but have their own entrances.',
                'icon_name' => 'city-variant',
                'type' => 'material-community',
            ],
            [
                'name' => 'Studio',
                'desc' => 'Single-room apartments.',
                'content' => 'Studios are small apartments that combine living room, bedroom, and kitchen into a single room.',
                'icon_name' => 'home-city',
                'type' => 'material-community',
            ],
            [
                'name' => 'Villa',
                'desc' => 'Luxury houses, often located in prime locations.',
                'content' => 'Villas are luxury houses with extensive amenities, often located in prime locations.',
                'icon_name' => 'home-modern',
                'type' => 'material-community',
            ]
        ];

        foreach ($types as $pt) {
            PropertyType::create($pt);
        }
    }
}
