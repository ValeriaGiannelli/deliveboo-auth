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
        // Recupera tutte le vendite e i prodotti
        $sales = Sale::all();
        $products = Product::all();

        foreach ($sales as $sale) {
                // Seleziona casualmente 1-5 prodotti per ciascuna vendita
                $randomProducts = $products->random(rand(1, 5));

                foreach ($randomProducts as $product) {
                    // Qui creiamo la relazione nella tabella pivot
                    $sale->products()->attach($product->id, [
                        'product_name' => $product->name,
                        'amount' => rand(1, 5), // Quantità casuale
                        'price' => $product->price,
                    ]);
                }
            }
    }
}
