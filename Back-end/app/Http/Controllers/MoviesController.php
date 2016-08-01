<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Helper;
use App\Http\Requests;
use App\Movies;

class MoviesController extends Controller
{
    private $userId;

    public function __construct(Request $request){
        // This check the user info to get his id
        $this->userId = 19;
    }

    // public function getMovies(){
    //     if(isset($this->userId)){
    //         define(NUMBER, 1);
    //         try
    //         {
    //             DB::transaction(function(){
    //                 $movieId = ViewRecommendation::where('user_id', $userId)->where('viewed', $viewed)->get(['movie_id']);
    //                 $movieId = $movieId->toArray();
    //                 foreach ($movieId['movie_id'] as $id) {
    //                     $result[] = Movie::where('movie_id', $id)->skip(0)->take(NUMBER)->get()->toArray();
    //                 }
    //
    //                 if(count($result) == 0){
    //                     throw new \Exception("Information regarding the movies cannot be found");
    //                 }
    //             });
    //         }
    //         catch (\Exception $e)
    //         {
    //             DB::rollback();
    //             return json_encode(['code'=>500, 'Message'=>$e->getMessage()]);
    //         }
    //
    //         return json_encode(['code'=>200, 'Message'=>'Success', 'response'=>$result]);
    //     }
    //     else
    //         return json_encode('code'=> 500, 'message'=>'User Cannot be determined');
    // }

    public function getSuggestion(){
        try {
            $result = Movies::orderByRaw("RAND()")->get()->first()->toArray();
            if(!$result){
                throw new \Exception('There was some problem getting the movie');
            }
            return json_encode(['code'=> 200, 'message'=> 'success', 'response'=> $result]);
        } catch (\Exception $e) {
            return json_encode(['code'=> 500, 'message'=> $e->getMessage()]);
        }

    }

    public function addMovies(Request $request){
        try {
            if(isset($this->userId) && isset($request->info)){
                for($i = 0, $n = count($request->info); $i<$n; $i++){
                    $data = json_decode($request->info[$i]);
                    unset($data->Response);
                    if(count(Helper::checkExistence('App\Movies', ['Title' => $data->Title]))== 0){
                        $result = Helper::create('App\Movies', (array) $data);
                        if(!$result){
                            throw new \Exception('There was a problem inserting '.$result);
                        }
                    }
                    else {
                        throw new \Exception("Not inserted already present");

                    }
                }

                // return json_encode(['code'=> 200, 'message'=>'success']);

            }
        } catch (\Exception $e) {
            return json_encode(['code'=> 500, 'message'=> $e->getMessage()]);
        }


    }
}
