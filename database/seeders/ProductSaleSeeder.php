<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //estrazione random dei prodotti per gli ordini
        for($i = 0; $i < 15; $i++){
            // estraggo ristorante
            $product = Product::inRandomOrder()->first();

            // estraggo l'id di un type
            $sale_id = Sale::inRandomOrder()->first()->id;

            // dump($restaurant);

            // aggiungo la relazione fra il ristorante estratto e l'ide del type estratto
            // $product->types()->attach($sale_id);

            dump($product->name);
        }

    }
}
