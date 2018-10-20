<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Featured_Product extends Model
{
    public function likes()
    {
    return $this->hasMany('App\Like');
    }
    public function cards()
    {
    return $this->hasMany('App\Card');
    }
}
