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
        for($i = 1; $i < 6; $i++){
            
            // estraggo ristorante
            $restaurant = Restaurant::where('id', $i)->first();

            $random = rand(1,3);

            // Assegniamo tipologie uniche fino a raggiungere il numero desiderato
            $assignedTypes = [];
            
            for($e = 1; $e <= $random; $e++){
                
                do {

                    // Estrai casualmente un id di type
                    $type_id = Type::inRandomOrder()->first()->id;

                    // Controlla se il type_id è già stato associato a questo ristorante
                    $alreadyAttached = $restaurant->types()->where('type_id', $type_id)->exists();

                } while ($alreadyAttached || in_array($type_id, $assignedTypes));

                    // Aggiungi alla lista di tipi assegnati
                    $assignedTypes[] = $type_id;

                    // Aggiungi la relazione tra il ristorante e il tipo estratto
                    $restaurant->types()->attach($type_id);
                
            }
        }
    }
}
