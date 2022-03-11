<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FarmerCrop;
use Validator;

class FarmerCropController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'userID' => 'required',
            'crop' => 'required',
            'soil_type' => 'required',
            'cultivation_type' => 'required',
            'plantation_date' => 'required|date_format:Y-m-d',
            'field_details' => 'required',
            'survey_no' => 'required',
            'land_area' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['success' => false, 'message' => $validator->errors()], '404');
        } 
        else
        {
            $crop = FarmerCrop::create([
                'farmer_id' => $request->userID,
                'crop' => $request->crop,
                'soiltype' => $request->soil_type,
                'cultivationtype' => $request->cultivation_type,
                'plantingdate' => $request->plantation_date,
                'fielddetails' => $request->field_details,
                'surveynumber' => $request->survey_no,
                'landarea' => $request->land_area,
            ]);

            //return crop id 
            return response()->json(['id' => $crop->id],200);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $crop = FarmerCrop::where('farmer_id', $id)->first();
        //return crop details
        return response()->json(['success' => $crop],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            // 'userID' => 'required',
            // 'crop' => 'required',
            // 'soil_type' => 'required',
            // 'cultivation_type' => 'required',
            // 'plantation_date' => 'required|date_format:Y-m-d',
            // 'field_details' => 'required',
            // 'survey_no' => 'required',
            // 'land_area' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['success' => false, 'message' => $validator->errors()], '404');
        } 
        else
        {
            // store
            $crop = FarmerCrop::find($id);
            $crop->crop = $request->crop;
            $crop->save();

            //return crop id 
            return response()->json(['id' => $crop->id],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return FarmerCrop::destroy($id);
    }

}
