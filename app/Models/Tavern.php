<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tavern extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function tables()
    {
        return $this->hasMany(Table::class);
    }
}
