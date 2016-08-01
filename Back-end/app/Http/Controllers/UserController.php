<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Helper;
use App\Http\Requests;
use App\User;
use UserAgentParser\Provider\Http\UserAgentStringCom;


class UserController extends Controller
{
    public function __construct(){
         header("Access-Control-Allow-Origin: *");
    }

    public function login(){

    }



    public function createUser(Request $request){
        if(isset($request->info)){
            $check = User::where('username', $request->info['username'])->where('password', $request->info['password'])->get(['id']);
            if($check->id != null){
                return json_encode(['code'=> 304, 'message'=>'user already exists']);
            }
            $data = $request->info;
            $data['ip'] = $request->server('REMOTE_ADDR');
            $data['created_at'] =
            $result = Helper::create('App\User', $data);
        }
        else
            return json_encode(['code'=>422, 'message'=>'Missing parameters']);

        if($result){
            return json_encode(['code'=>200, 'message'=>'User Succesfully created']);
        }
        else {
            return json_encode(['code'=>500, 'message'=>$result]);
        }
    }
}
