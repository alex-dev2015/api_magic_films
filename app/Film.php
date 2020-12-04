<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = ['name', 'classification_id', 'director_id'];

    public function listActors(){
        return $this->belongsToMany(Actor::class, 'film_actor');
    }
}