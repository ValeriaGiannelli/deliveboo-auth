<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //creo la funzione pubblica index
    public function index()
    {
        // dump('sono la index della dashboard');
        return view('admin.dashboard');
    }
}
