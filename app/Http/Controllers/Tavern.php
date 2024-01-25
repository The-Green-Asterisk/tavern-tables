<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tavern as TavernModel;

class Tavern extends Controller
{
    public function index(TavernModel $tavern)
    {
        return view('tavern', [
            'tavern' => $tavern,
            'taverns' => auth()->user()->taverns
        ]);
    }
}
