<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip', 'device', 'parent', 'platform', 'username', 'password', 'created_at', 'updated_at'
    ];

    public function view_recommendation(){
        return $this->belongsTo('App\View_recommendation');
    }

     public $timestamps = true;

}
