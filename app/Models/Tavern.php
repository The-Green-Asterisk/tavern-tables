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
        return $this->belongsToMany(User::class, 'user_tavern');
    }

    public function tables()
    {
        return $this->hasMany(Table::class);
    }

    public function tavernKeeper()
    {
        return $this->hasOne(User::class, 'keeper_id');
    }

    public function people()
    {
        $tablePeople = $this->tables->map(function ($table) {
            return $table->people();
        })->flatten()->unique('email');

        return $this->users->merge($tablePeople)->unique('email');
    }

    public function waitingPeople()
    {
        return $this->people()->filter(function ($person) {
            return $person->tables()->count() === 0 && !$person->isDm();
        });
    }
}