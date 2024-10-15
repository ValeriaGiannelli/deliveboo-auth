<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            return redirect()->action([DashboardController::class, 'index']);
        } else {
            return view('auth.login');
        }
    }
}
