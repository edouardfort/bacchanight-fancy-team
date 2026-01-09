<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $guarded = [];

    // C'est cette partie qui manquait ou qui était mal nommée :
    public function team() {
        return $this->belongsTo(Team::class);
    }
}