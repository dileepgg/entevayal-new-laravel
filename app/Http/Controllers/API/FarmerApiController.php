<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Farmer;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class FarmerApiController extends Controller
{
    //use HasApiTokens;

    public function index()
    {

    }
 
    public function show($id)
    {
        $farmer = Farmer::find($id);
        return response()->json(['success'=>$farmer],200);
        
    }

    public function store(Request $request)
    {
        $security_question = [];
        $security_answer = [];

        $request->validate([
            'owner_name' => ['required', 'string', 'max:255'],
            'reg_dob' => ['required'],
            'reg_age' => ['required'],
            'reg_gender' => ['required'],
            'reg_phone' => ['required'],
            'reg_address' => ['required'],
            'reg_taluk' => ['required'],
            'reg_village' => ['required'],
            'reg_district' => ['required'],
            'reg_block' => [],
            'reg_email' => ['required', 'string', 'email', 'max:255',],
            'reg_pwd' => ['required'],
            'reg_sec_qs1' => ['required'],
            'reg_sec_ans1' => ['required'],
            'reg_sec_qs2' => ['required'],
            'reg_sec_ans2' => ['required'],
            'user_type' => ['required'],
        ]);

        (isset($request->reg_sec_qs1)) ? $security_question[] = $request->reg_sec_qs1 : '';
        (isset($request->reg_sec_qs2)) ? $security_question[] =  $request->reg_sec_qs2 : '';
        (isset($request->reg_sec_ans1)) ? $security_answer[] =  $request->reg_sec_ans1 : '';
        (isset($request->reg_sec_ans2)) ? $security_answer[] = $request->reg_sec_ans2 : '';

        $farmer = Farmer::create([
            'name' => $request->owner_name,
            'age' => $request->reg_age,
            'gender' => $request->reg_gender,
            'phone' => $request->reg_phone,
            'address' => $request->reg_address,
            'taluk' => $request->reg_taluk,
            'village' => $request->reg_village,
            'district' => $request->reg_district,
            'block' => $request->reg_block,
            'email' => $request->reg_email,
            'password' => isset($request->reg_pwd) ? Hash::make($request->reg_pwd) : NULL,
            'security_question' => (!empty($security_question)) ? serialize($security_question) : NULL,
            'security_answer' => (!empty($security_answer)) ? serialize($security_answer) : NULL,
        ]);

        $farmer->save();

        // Creating a token without scopes...
        $token = $farmer->createToken('Farmer Register Access Token')->accessToken;

        //return the access token 
        return response()->json(['token'=>$token],200);
    }

}
