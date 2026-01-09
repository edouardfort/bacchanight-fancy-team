<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $guarded = [];
public function questions() { return $this->hasMany(Question::class); }
public function tableaux() { return $this->hasMany(Tableau::class); }
}
