<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Farmer;
use Auth;


class PassportAuthController extends Controller
{

     /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::guard('farmer')->attempt(['email' => $request->email, 'password' => $request->password])){

            $user = Auth::guard('farmer')->user(); 
            $success['token'] =  $user->createToken('Farmer Login Access Token')-> accessToken; 
            $success['name'] =  $user->name;
            $success['id'] =  $user->id;
            $success['age'] =  $user->age;
            $success['gender'] =  $user->gender;
            $success['mobile'] =  $user->mobile;
            $success['address'] =  $user->address;
            $success['distict'] =  $user->distict;
            $success['taluk'] =  $user->taluk;
            $success['block'] =  $user->block;
            $success['village'] =  $user->village;
   
            return response()->json(['success'=>$success],200);
        } 
        else{
            return response()->json(['error'=>'Unauthorised'],202);
        } 
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::user()->AauthAcessToken()->delete();
         }
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

}
