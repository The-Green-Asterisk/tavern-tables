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

    static function makeUniqueCode()
    {
        $code = substr(md5(uniqid(mt_rand(), true)), 0, 6);
        $tavern = TavernModel::where('code', $code)->first();
        while ($tavern) {
            $code = substr(md5(uniqid(mt_rand(), true)), 0, 6);
            $tavern = TavernModel::where('code', $code)->first();
        }
        return $code;
    }
}
