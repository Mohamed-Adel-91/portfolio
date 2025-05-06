<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // return first record or specific record
        // $setting = setting::first();
        // return new SettingResource($setting);
        // return response((new SettingResource($setting))->toArray($request));

        // return all records
        // $setting = Setting::get();
        // return SettingResource::collection($setting);
        $setting = Setting::find(1);
        if($setting) return ApiResponse::sendResponse(200, 'Settings retrieved successfully', new SettingResource($setting));
        return ApiResponse::sendResponse(204, 'No Content, Settings Not Found', []);
    }
}
