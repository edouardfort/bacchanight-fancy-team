<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tableau extends Model
{
    use HasFactory;

    // C'est cette ligne qui corrige ton erreur :
    protected $table = 'tableaux'; 

    protected $guarded = [];

    public function team() {
        return $this->belongsTo(Team::class);
    }
}