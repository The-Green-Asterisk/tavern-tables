<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Home extends Controller
{
    public function index()
    {
        return view('home', [
            'taverns' => isset(auth()->user()->taverns) ? auth()->user()->taverns : []
        ]);
    }
}
