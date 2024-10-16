<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\ProfileController;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// finito di modificare la dashboard dovò creare un controller per la pagina guest
Route::get('/', [PageController::class, 'index'])->name('home');

// da eliminare perché vogliamo chiamarle admin
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
//

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// raggruppo le rotte
Route::middleware(['auth', 'verified'])
    // il prefisso deve avere admin
    ->prefix('admin')
    // tutti i name devono iniziare con admin.
    ->name('admin.')
    ->group(function () {
        Route::get('/', [RestaurantController::class, 'index'])->name('home');
        Route::resource('products', ProductController::class);
        Route::resource('restaurants', RestaurantController::class)->except([
            'update',
            'delete',
            'show'
        ]);
        Route::resource('sales', SaleController::class);
    });
require __DIR__ . '/auth.php';
