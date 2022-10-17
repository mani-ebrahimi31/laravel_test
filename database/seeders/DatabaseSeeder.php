<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*
         \App\Models\User::factory(1000)->create();

         \App\Models\User::factory()->create([
             'name' => fake()->name(),
             'email' => fake()->email(),
         ]);
        */

        for ($i = 0; $i < 10; $i++)
        {
            $category = Category::create([
                'title' => fake()->title(),
                'description' => fake()->text()
            ]);

            for ($j = 0; $j < 10; $j++)
            {
                Product::create([
                    'title' => fake()->title(),
                    'description' => fake()->text(),
                    'price' => rand(1000, 10000),
                    'image' => fake()->image(),
                    'category_id' => $category->id
                ]);
            }
        }
    }
}
