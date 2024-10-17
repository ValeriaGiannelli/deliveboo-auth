<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function restaurantsTypes($typeIds){

        $data = Restaurant::whereHas('types', function ($query) use ($typeIds) {
            $query->whereIn('types.id', $typeIds);
        })->get();

        return response()->json($data);

    }

    public function restaurantProducts($restaurantId){

        $data = Product::where('restaurant_id', $restaurantId)->get();

        return response()->json($data);
    }
}
