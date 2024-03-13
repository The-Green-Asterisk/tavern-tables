<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tavern;

class TavernController extends Controller
{
    public function index(Tavern $tavern)
    {
        return view('pages.tavern', [
            'tavern' => $tavern,
            'taverns' => auth()->user()->taverns
        ]);
    }

    static function makeUniqueCode()
    {
        $code = substr(md5(uniqid(mt_rand(), true)), 0, 6);
        $tavern = Tavern::where('code', $code)->first();
        while ($tavern) {
            $code = substr(md5(uniqid(mt_rand(), true)), 0, 6);
            $tavern = Tavern::where('code', $code)->first();
        }
        return $code;
    }
}
