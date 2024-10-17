<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\User;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = config('restaurant');

        $id = 1;

        foreach ($restaurants as $restaurant) {
            $new_restaurant = new Restaurant();
            $new_restaurant->restaurant_name = $restaurant['restaurant_name'];
            $new_restaurant->address = $restaurant['address'];
            $new_restaurant->piva = $restaurant['piva'];
            $new_restaurant->img = $restaurant['img'];
            $new_restaurant->description = $restaurant['description'];
            // $new_restaurant->user_id = User::inRandomOrder()->first()->id;
            $new_restaurant->user_id = $id;
            $id++;
            $new_restaurant->save();
            // dump($new_restaurant);

        }
    }
}
