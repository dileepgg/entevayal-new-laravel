<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Farmer;

class FarmerApiController extends Controller
{
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

    }

}
