<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Instantiate Faker
        $faker = Faker::create();

        // Define the number of fake comments you want to generate
        $numberOfComments = 50;

        // Loop to generate fake comments
        for ($i = 0; $i < $numberOfComments; $i++) {
            // Generate fake data for each comment
            $userId = $faker->numberBetween(1, 10); // Assuming you have 10 users in your system
            $postId = $faker->numberBetween(1, 20); // Assuming you have 20 posts in your system
            $content = $faker->paragraph();
            $parentId = null; // For simplicity, let's assume all comments are top-level comments

            // Insert the fake comment into the database
            DB::table('comments')->insert([
                'user_id' => $userId,
                'post_id' => $postId,
                'content' => $content,
                'parent_id' => $parentId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
