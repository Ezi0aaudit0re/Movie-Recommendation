<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    protected $table = 'movies';
    protected $fillable = [
        'title', 'genere', 'actor', 'imdb_id', 'director', 'imdb_rating', 'trailer', 'year', 'metacritic_rating'
    ];

    public function view_recommendation(){
        return $this->belongsTo('App\View_recommendation');
    }

}

?>
