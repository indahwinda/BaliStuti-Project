<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;
class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for($i = 1; $i <= 20; $i++){
            Product::create([
                'cate_id' => '1',
                'name'    => $faker->name,
                'slug' =>$faker->slug,
                'small_description' => Str::random(20),
                'description' => Str::random(20), 
                'original_price' =>mt_rand(10,100),
                'selling_price' =>mt_rand(10,100),
                'image' =>'1645329213.jpg',
                'qty' => mt_rand(10,100),
                'tax' => mt_rand(10,100),
                'status' => '1',
                'trending' => '0',
                'meta_title'=> Str::random(20),
                'meta_keywords'=> Str::random(20),
                'meta_description'=> Str::random(20),
            ]);
        }
    }
}
