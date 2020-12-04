<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected $fillable = ['name'];

    public function listFilms(){
        return $this->hasMany(Film::class);
    }
}
