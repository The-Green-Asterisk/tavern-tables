<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function tavern()
    {
        return $this->belongsTo(Tavern::class);
    }

    public function ruleset()
    {
        return $this->hasOne(Ruleset::class);
    }
}
