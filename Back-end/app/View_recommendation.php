<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View_recommendation extends Model
{
    protected $table = 'view_recommendation';

    public function users(){
        return $this->hasMany('App\User');
    }

    public function movies(){
        return $this->hasMany('App\Movie')
    }
}
