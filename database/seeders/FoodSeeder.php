<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FoodSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $categories = ['Hoa quả', 'Thực phẩm hữu cơ', 'Thực phẩm khô', 'Sản phẩm nổi bật'];

        foreach (range(1, 10) as $index) {
            DB::table('t_food')->insert([
                'name' => $faker->word,
                'description' => $faker->sentence,
                'price' => $faker->randomFloat(2, 10, 100),
                'image' => 'https://via.placeholder.com/150',
                'category' => $faker->randomElement($categories),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
