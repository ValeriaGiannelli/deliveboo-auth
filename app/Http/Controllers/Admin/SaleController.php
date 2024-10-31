<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Models\Restaurant;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SaleController extends Controller
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

        // array con tutti gli id dei prodotti del ristorante
        $products_ids = Product::where('restaurant_id', $restaurant_id)->get('id');

        // query basta sulla relazione tra sale e product, che filtra tutti gli ordini che comprendono i prodotti presenti nell'array
        $sales = Sale::whereHas('products', function ($query) use ($products_ids) {
            $query->whereIn('product_id', $products_ids);
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.sales.index', compact('sales'));
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
    public function store(Request $request, Sale $sale)
    {

        $data = $request->all();

        $products = $data['products'];

        $new_sale = Sale::create($data);

        foreach ($products as $product) {
            $new_sale->products()->attach($product['id'], [
                'product_name' => $product['name'],
                'amount' => $product['quantity'],
                'price' => $product['price'],
            ]);
        }

        return response()->json($new_sale);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        // prendo l'id dell'user
        $user_id = Auth::id();

        // prendo l'id del ristorante associato all'id dell'user
        $restaurant_id = Restaurant::where('user_id', $user_id)->value('id');

        // Verifica se almeno uno dei prodotti della vendita appartiene al ristorante dell'utente
        $productBelongsToRestaurant = $sale->products->contains(function ($product) use ($restaurant_id) {
            return $product->restaurant_id == $restaurant_id;
        });

        if (!$productBelongsToRestaurant) {
            abort(404);
        } else {

            return view('admin.sales.show', compact('sale'));
        }
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

    /****************************************/
    // STATISTICHE //
    /****************************************/
    public function stats()
    {
        // Ottieni l'ID dell'utente e del ristorante
        $user_id = Auth::id();
        $restaurant_id = Restaurant::where('user_id', $user_id)->value('id');

        // Ottieni gli ID dei prodotti del ristorante
        $products_ids = Product::where('restaurant_id', $restaurant_id)->pluck('id');

        // Query per ottenere i guadagni mensili per gli ultimi 12 mesi per il ristorante
        $monthlySales = Sale::whereHas('products', function ($query) use ($products_ids) {
            $query->whereIn('product_id', $products_ids);
        })
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('SUM(total_price) as total_sales')
            )
            ->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonths(11)) // Precisamente ultimi 12 mesi
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get()
            ->keyBy('month'); // Associa le vendite mensili alla chiave "month"

        // Crea un array con esattamente gli ultimi 12 mesi
        $allMonths = [];
        $sales = [];
        $currentDate = Carbon::now()->startOfMonth();

        for ($i = 0; $i < 12; $i++) {
            // Ottieni la chiave mese in formato "YYYY-MM"
            $monthKey = $currentDate->copy()->subMonths($i)->format('Y-m');

            // Ottieni il nome del mese per l'output
            $monthLabel = $currentDate->copy()->subMonths($i)->locale('it')->isoFormat('MMMM YYYY');
            $allMonths[] = ucfirst($monthLabel); // Capitalizza la prima lettera

            // Inserisci il valore delle vendite o 0 se non ci sono dati
            $sales[] = $monthlySales->has($monthKey) ? $monthlySales[$monthKey]->total_sales : 0;
        }

        // Inverti l'ordine dei mesi e delle vendite per partire dal mese più vecchio
        $allMonths = array_reverse($allMonths);
        $sales = array_reverse($sales);

        // Calcola il totale delle vendite
        $totalSales = array_sum($sales);

        return view('admin.sales.stats', compact('allMonths', 'sales', 'totalSales'));
    }
}
