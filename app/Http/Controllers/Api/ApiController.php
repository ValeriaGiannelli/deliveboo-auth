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

    // tutti i ristoranti da mandare sulla home in ordine alfabetico
    public function restaurants(Request $request){

        // ID tramite query
        $typeNames = $request->query('types');

        // se ci sono gli id, divido la stringa in un array
        if ($typeNames){
            $typeNamesArray = explode(',', $typeNames);

            // filtro i ristoranti in base all'array degli id delle tipologie, e li ordino in nome alfabetico
            $data = Restaurant::whereHas('types', function ($query) use ($typeNamesArray){
                $query->whereIn('name', $typeNamesArray);
            })->orderBy('restaurant_name')->get();

            // mando immagine all'api
            foreach($data as $restaurant){
                $restaurant->img = url('storage/' . $restaurant->img);
            }
        } else {

            // se gli id non ci sono come query, prendo tutti i ristoranti in ordine alfabetico
            $data = Restaurant::orderBy('restaurant_name')->get();

            // mando immagine all'api
            foreach($data as $restaurant){
                $restaurant->img = url('storage/' . $restaurant->img);
            }
        }

        // se data ha almeno un risultato mando un json con le informazioni
        if ($data->isNotEmpty()){
            return response()->json($data);
        } else {
            // altrimenti mando un messaggio di errore
            return response()->json(['message' => 'Non ci sono ristoranti con queste tipologie'], 404);
        }   

        
    }

    public function restaurant(Restaurant $restaurant){
        
        // recupero il singolo ristorante con l'id
        $restaurant = Restaurant::where('id', $restaurant->id)->first();

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
