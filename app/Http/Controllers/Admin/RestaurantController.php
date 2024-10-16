<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use App\Models\Type;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // prendo l'id dell'user
        $user_id = Auth::id();
        //prendo i tipi
        $types = Type::all();

        // prendo l'id del ristorante associato all'id dell'user
        $restaurant = Restaurant::where('user_id', $user_id)->value('name');
        return view('admin.dashboard', compact('restaurant', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $restaurant = Restaurant::create($data);
        //controllo se sono stati inseriti tipi
        if (array_key_exists('types', $data)) {
            $restaurant->types()->attach($data['types']);
        }
        return redirect()->route('admin.restaurants.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}