<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sale;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sales = config('sales.sales');

        foreach ($sales as $sale) {
            $new_sale = new Sale();
            $new_sale->full_name = $sale['full_name'];
            $new_sale->email = $sale['email'];
            $new_sale->address = $sale['address'];
            $new_sale->total_price = $sale['total_price'];
            $new_sale->phone_number = $sale['phone_number'];
            $new_sale->created_at = $sale['created_at'];
            $new_sale->save();
        }
    }
}
