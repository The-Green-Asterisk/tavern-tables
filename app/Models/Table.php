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

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_table');
    }

    public function people()
    {
        $users = $this->belongsToMany(User::class, 'user_table')->get();
        $people = $this->belongsToMany(Person::class)->get();
        return $users->merge($people)->unique('email');
    }

    public function gm()
    {
        return $this->hasOne(User::class, 'id', 'gm_id');
    }
}
