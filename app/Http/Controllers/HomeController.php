<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'taverns' => auth()->check() ? auth()->user()->taverns : []
        ]);
    }
}
