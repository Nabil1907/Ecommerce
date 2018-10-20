<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //.
    public function property()
    {
    return $this->belongsTo('App\Property');
    }
    public function featured_product()
    {
    return $this->belongsTo('App\Featured_Product');
    }
    public function user()
    {
    return $this->belongsTo('App\User');
    }



}
