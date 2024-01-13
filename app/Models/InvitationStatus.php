<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvitationStatus extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
}
