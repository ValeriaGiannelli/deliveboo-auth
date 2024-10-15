<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            return redirect()->action([RestaurantController::class, 'index']);
        } else {
            return view('auth.login');
        }
    }
}
