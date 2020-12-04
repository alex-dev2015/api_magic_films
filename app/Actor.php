<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $fillable = ['name'];

    public function listFilms(){
        return $this->belongsToMany(Film::class, 'film_actor');
    }

}
