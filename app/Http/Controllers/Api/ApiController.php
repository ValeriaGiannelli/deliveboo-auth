<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    // tutti i types da mandare sulla home
    public function types(){

        // types ordinati per id
        $data = Type::orderBy('id')->get();

        return response()->json($data);
    }

    public function restaurants(Request $request){

        // Tipologie tramite query (ad es. 'ITALIANO,CINESE')
        $typeNames = $request->query('types');
    
        // se ci sono le tipologie, divido la stringa in un array
        if ($typeNames) {
            $typeNamesArray = explode(',', $typeNames);
    
            // Filtro i ristoranti che hanno tutte le tipologie selezionate e carico anche le tipologie associate
            $data = Restaurant::where(function ($query) use ($typeNamesArray) {
                foreach ($typeNamesArray as $typeName) {
                    $query->whereHas('types', function ($query) use ($typeName) {
                        $query->where('name', $typeName);
                    });
                }
            })->with('types') // Carica anche le tipologie con i ristoranti
              ->orderBy('restaurant_name')->get();
    
            // mando immagine all'api e aggiungo le tipologie
            foreach($data as $restaurant) {
                $restaurant->img = url('storage/' . $restaurant->img);
    
            }
    
        } else {
            // Se non ci sono tipologie nella query, prendo tutti i ristoranti in ordine alfabetico e le loro tipologie
            $data = Restaurant::with('types')->orderBy('restaurant_name')->get();
    
            // mando immagine all'api e aggiungo le tipologie
            foreach($data as $restaurant) {
                $restaurant->img = url('storage/' . $restaurant->img);
    
            }
        }
    
        // Se ci sono risultati, restituisco i dati, altrimenti un messaggio di errore
        if ($data->isNotEmpty()) {
            return response()->json($data);
        } else {
            return response()->json(['message' => 'Non ci sono ristoranti con queste tipologie'], 404);
        }
    }
    

    public function restaurant(Restaurant $restaurant){
        
        // recupero il singolo ristorante con l'id
        $restaurant = Restaurant::where('id', $restaurant->id)->with('types')->first();

        // mandare immagine all'API
        $restaurant->img = url('storage/' . $restaurant->img);
        

        return response()->json($restaurant);
    }


    // tutti i prodotti del ristorante selezionato
    public function restaurantProducts(Restaurant $restaurant){

        // Recupero i prodotti del ristorante selezionato
        $products = Product::where('restaurant_id', $restaurant->id)->orderBy('name')->get();

        // mandare immagine all'API
        foreach($products as $product){
            $product->img = url('storage/' . $product->img);
        }
    
        // Restituisco i dati al front-end in formato JSON
        return response()->json($products);
    }
}
