<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\View_recommendation;
use App\Http\Requests;
use App\Movies;
use DB;

/**
* This is a helper controller to perform crud operations
*/
class Helper extends Controller
{
    /**
    * Finds 5 movie recommendations
    * @param $viewed find the movies which user has seen or recommended
    */
    public static function getMovies($viewed=0, $userId){


    }

    /**
    * Find if a user or movie already exists
    * @param $where type - array key value
    * @param $model - the model to check in
    * @return id if exists
    */
    public static function checkExistence($model, $where){
        $result = $model::where(key($where), $where['Title'])->get(['id']);
        return $result;
    }

    /**
    * THis function creates a user or a movie
    * @param $model - which model to update
    * @param $data - data to update
    */
    public static function create($model, $data){
        try {
            DB::transaction(function() use ($model, $data){
                $result = $model::insert([$data]);
                if(!$result){
                    throw new \Exception("There was some problem creating the user");
                }
            });
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }

        // return true if query executed succesfully
        return true;

    }

    /**
    * This method updates the information
    * @param $model - which model we have to update
    * @param $data - the data we have to update
    */
    public function update($model, $data){

    }

    /**
    * This function deletes a user or a movie
    * @param $model default users id
    * @param $id id of the movie or user
    */
    public function delete($model='User', $id){

    }

    /**
    * This function is used for testing purpose
    * @param $data - thing to dump
    */
    public static function test($data){
        echo "<pre>";
        var_dump($data);
        die("</pre>");
    }
}
