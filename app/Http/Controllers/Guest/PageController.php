<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            return view('admin.index');
        } else {
            return view('auth.login');
        }
    }
}
