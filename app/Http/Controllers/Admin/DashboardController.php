<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    //creo la funzione pubblica index
    public function index()
    {
        /* // prendo l'id dell'user
        $user_id = Auth::id();

        // prendo l'id del ristorante associato all'id dell'user
        $restaurant = Restaurant::where('user_id', $user_id)->value('name');
        return view('admin.dashboard', compact('restaurant')); */
    }
}
