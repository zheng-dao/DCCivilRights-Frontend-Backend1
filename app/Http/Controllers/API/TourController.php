<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\{
    Landmark,
    LeadGen,
    LeadGenLocation
};
use Illuminate\Support\Facades\Validator;



/**
 * @group  Landmarks
 *
 * APIs for managing landmarks
 */
class TourController extends Controller
{
    /**
     * Tour list
    @response  200{
    "status": true,
    "code": 200,
    "message": "Landmark listing",
    "data": [
            {
                "id": 8,
                "title": "QA",
                "audio": "6214bbf764ed91645526007808878.mp3",
                "address": "Kolkata",
                "lat": "20",
                "lng": "25",
                "content": "Testing",
                "is_active": 1,
                "created_at": "2022-02-22T10:33:27.000000Z",
                "updated_at": "2022-02-22T10:33:27.000000Z",
                "landmark_image": [
                    {
                        "id": 14,
                        "image": "6214bbf76b58d1645526007151796.jpg",
                        "is_featured": 0,
                        "landmark_id": 8,
                        "created_at": "2022-02-22T10:33:27.000000Z",
                        "updated_at": "2022-02-22T10:33:27.000000Z"
                    }
                ]
            }
        ] 
    }
     */
    public function tourList()
    {
        try {

            $landmarks = Landmark::with('landmarkImage')->orderBy('sort', 'asc')->get();
            $status = true;
            $responseData = $landmarks;
            $responseCode = 200;
            $responseMsg = "Landmark listing";
        } catch (\Exception $e) {
            Log::error(" :: EXCEPTION :: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            $status = false;
            $responseData = NULL;
            $responseCode = $e->getCode();
            $responseMsg = $e->getMessage();
        }
        return response()->json(["status" => $status, "code" => $responseCode, "message" => $responseMsg, "data" => $responseData]);
    }


    /**
     * Tour details
     * @urlParam  id required integer The ID of Landmark.
    @response  200{
    "status": true,
    "code": 200,
    "message": "Landmark details",
    "data": {
        "id": 8,
        "title": "QA",
        "audio": "6214bbf764ed91645526007808878.mp3",
        "address": "Kolkata",
        "lat": "20",
        "lng": "25",
        "content": "Testing",
        "is_active": 1,
        "created_at": "2022-02-22T10:33:27.000000Z",
        "updated_at": "2022-02-22T10:33:27.000000Z",
        "landmark_image": [
            {
                "id": 14,
                "image": "6214bbf76b58d1645526007151796.jpg",
                "is_featured": 0,
                "landmark_id": 8,
                "created_at": "2022-02-22T10:33:27.000000Z",
                "updated_at": "2022-02-22T10:33:27.000000Z"
            }
        ]
    }
}
     */
    public function tourDetails($id)
    {
        try {

            $landmark_details = LandMark::with('landmarkImage')->where('id', $id)->first();

            $status = true;
            $responseData = $landmark_details;
            $responseCode = 200;
            $responseMsg = "Landmark details";
        } catch (\Exception $e) {
            Log::error(" :: EXCEPTION :: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            $status = false;
            $responseData = NULL;
            $responseCode = $e->getCode();
            $responseMsg = $e->getMessage();
        }
        return response()->json(["status" => $status, "code" => $responseCode, "message" => $responseMsg, "data" => $responseData]);
    }





    /**
     * Load Gen Form Submit
     * @bodyParam  first_name string required The First Name of User.
     * @bodyParam  last_name string The Last Name of User.
     * @bodyParam  phone integer required The Phone No of User.
     * @bodyParam  email string required The Email of User.
     * @bodyParam  locations array required The Location of User.
     * @bodyParam  locations[].landmark_id integer required The Ids of Landmark.
    @response  200{
    "status": true,
    "code": 200,
    "message": "Submit successfully",
    "data": ""
    }
     */
    public function submitLoadGenForm(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "first_name" => "required",
                'last_name' => "required",
                "email" => "required",
                "phone" => "required",
            ]);
            if ($validator->fails())
                return response()->json(["status" => false, "validation_errors" => $validator->errors()]);
            $leadgen = new LeadGen;
            $leadgen->first_name = $request->first_name;
            $leadgen->last_name = $request->last_name;
            $leadgen->email = $request->email;
            $leadgen->phone = $request->phone;
            $leadgen->save();
            foreach ($request->locations as $location) {
                $leadgenLocation = new LeadGenLocation;
                $leadgenLocation->lead_gen_id = $leadgen->id;
                $leadgenLocation->landmark_id = $location;
                $leadgenLocation->save();
            }
            $status = true;
            $responseData = "";
            $responseCode = 200;
            $responseMsg = "Submit successfully";
        } catch (\Exception $e) {
            Log::error(" :: EXCEPTION :: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            $status = false;
            $responseData = NULL;
            $responseCode = $e->getCode();
            $responseMsg = $e->getMessage();
        }
        return response()->json(["status" => $status, "code" => $responseCode, "message" => $responseMsg, "data" => $responseData]);
    }
}
