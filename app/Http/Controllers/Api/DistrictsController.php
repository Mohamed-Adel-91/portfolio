<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\DistrictResource;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // $districts = District::get();
        // if($districts->count() > 0) return ApiResponse::sendResponse(200, 'Districts retrieved successfully', DistrictResource::collection($districts));
        // return ApiResponse::sendResponse(200, 'Districts is Empty', []);

        $districts = District::where('city_id', $request->input('city'))->get();
        if($districts->count() > 0) return ApiResponse::sendResponse(200, 'Districts retrieved successfully', DistrictResource::collection($districts));
        return ApiResponse::sendResponse(200, 'Districts is Empty', []);
    }
}
