<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Una categoria ha tanti posts 

class Category extends Model
{
    public function posts() {
        return $this->hasMany('App\Post');
    }
}
