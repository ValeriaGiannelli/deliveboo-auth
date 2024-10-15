<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = config('products');
        foreach ($products as $product) {
            $new_product = new Product();
            $new_product->restaurant_id = Restaurant::inRandomOrder()->first()->id;
            $new_product->name = $product['name'];
            $new_product->ingredients_descriptions = $product['ingredients_descriptions'];
            $new_product->img = $product['img'];
            $new_product->price = $product['price'];
            $new_product->visible = $product['visible'];
            $new_product->save();
            //dump($new_product);
        }
    }
}
