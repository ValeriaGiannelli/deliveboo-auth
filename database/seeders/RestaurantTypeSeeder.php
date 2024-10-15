<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\Type;

class RestaurantTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //estrazione random dei tipi per i 5 ristoranti
        for($i = 0; $i < 15; $i++){
            // estraggo ristorante
            $restaurant = Restaurant::inRandomOrder()->first();

            // estraggo l'id di un type
            $type_id = Type::inRandomOrder()->first()->id;

            // dump($restaurant);

            // aggiungo la relazione fra il ristorante estratto e l'ide del type estratto
            $restaurant->types()->attach($type_id);
        }
    }
}
