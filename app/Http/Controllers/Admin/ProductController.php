<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // prendo l'id dell'user
        $user_id = Auth::id();

        // prendo l'id del ristorante associato all'id dell'user
        $restaurant_id = Restaurant::where('user_id', $user_id)->value('id');

        if ($restaurant_id) {
            // lista di piatti associati all'id del ristorante se esiste
            $products = Product::orderBy('id')->where('restaurant_id', $restaurant_id)->get();

            return view('admin.products.index', compact('products'));
        } else {
            // altrimenti stampo
            return ('Prima di vedere i piatti, crea un ristorante');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // prendo l'id dell'user
        $user_id = Auth::id();

        // prendo l'id del ristorante associato all'id dell'user
        $restaurant_id = Restaurant::where('user_id', $user_id)->value('id');

        // prendo i dati mandati dall'utente
        $product = $request->all();

        // gestione immagini
        $product['img'] = Storage::put('uploads', $product['img']);

        // creo nuovo prodotto con i dati salvati
        // $newProduct = new Product();
        $product['restaurant_id'] = $restaurant_id;

        // $newProduct->fill($product);
        $newProduct = Product::create($product);

        $newProduct->save();

        return redirect()->route('admin.products.show', $newProduct->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

        // prendo l'id dell'user
        $user_id = Auth::id();

        // prendo l'id del ristorante associato all'id dell'user
        $restaurant_id = Restaurant::where('user_id', $user_id)->value('id');

        if ($restaurant_id != $product->restaurant_id) {
            abort(404);
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        // prendo i dati modificati
        $data = $request->all();

        // se la request ha file img sostituiamo col nuovo
        if($request->hasFile('img')){
            // gestione immagine  dove deve cancellare la relazione precedente
            if($product->img){
                Storage::delete($product->img);
            }
            // sostituisco con la nuova
            $data['img'] = Storage::put('uploads', $data['img']);
        } else {

            $data['img'] = $product->img;
        }

        // faccio update
        $product->update($data);

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        // eliminamo il prodotto
        $product->delete();
        return redirect()->route('admin.products.index')->with('deleted', 'Il piatto ' . $product->name . ' è stato eliminato');

    }

}
