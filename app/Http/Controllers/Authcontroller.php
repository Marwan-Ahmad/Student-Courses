<?php

namespace App\Http\Controllers;

use app\Http\Controllers\respnse as ControllersRespnse;
use App\Models\User;
use Illuminate\Http\Request;


class Authcontroller extends Controller
{

    public function register(Request $request){
        $request->validate([
            'user_name'=>'required',
            'phone'=>'required|between:10,10|unique:users',
            'password'=>'required|min:8|max:16',],[

            'phone.unique'=>'The number phone is exists'


        ]);
         $user=User::query()->create([
                'user_name'=>$request->user_name,
                'phone'=>$request->phone,
                'password'=>bcrypt($request->password)
         ]);
          $token=$user->createToken('api token')->plainTextToken;
         if(!$user){
            return response()->json([
                'data'=>[],
                'massage'=>'you not logging in',
                'satatus'=>422
            ]);
         }

         return response()->json([
            'data'=>$user,
            'token'=>$token,
            'massage'=>'you Reqistred in',
            'satatus'=>201
        ]);
    }

    public function login(Request $request){
        $request->validate([
            'phone'=>'required|digits:10|exists:users,phone',
            'password'=>'required|min:8'
        ]);

        if(!auth()->attempt($request->only(['phone','password']))){
            return response()->json([
                'Data'=>[],
                'Massage'=>'The Phone or password is Not Correct please try again',
                'status'=>500
            ],500);
        }
        $user=User::query()->where('phone',$request->phone)->first();
        $token=$user->createToken('api token')->plainTextToken;

        return response()->json([
            'Data'=>$user,
            'Token'=>$token,
            'Massage'=>'you are logging in',
            'status'=>200
        ],200);
    }
    public function logout(){
        $user=auth()->user()->currentAccessToken()->delete();
        return response()->json([
            'data'=>[$user],
            'Massage'=>'you logging out',
            'satatus'=>200
        ]);
    }
}