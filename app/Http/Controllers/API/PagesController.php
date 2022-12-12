<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cms;


/**
 * @group  Page
 *
 * APIs for page details
 */
class PagesController extends Controller
{
    /**
     * Page Details
     * @urlParam  slug required string The Slug of Page.(exmple: about-us/privacy-policy/terms-conditions)
    @response  200{
    "status": true,
    "code": 200,
    "message": "Page details",
    "data": [
            {
                "id": 3,
                "title": "About Us",
                "slug": "about-us",
                "text_content": "test content",
                "created_at": "2022-02-22T10:33:27.000000Z",
                "updated_at": "2022-02-22T10:33:27.000000Z",
            }
        ] 
    }
     */
    public function pageDetails($slug)
    {
        try {

            $page_details = Cms::where('slug',$slug)->first();

            $status = true;
            $responseData = $page_details;
            $responseCode = 200;
            $responseMsg = "Page details";
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
