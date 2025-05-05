<?php

namespace App\Http\Controllers\Api;

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
        // $Setting = Setting::first();
        // return new SettingResource($Setting);
        // return response((new SettingResource($Setting))->toArray($request));

        // return all records
        $Setting = Setting::all();
        return SettingResource::collection($Setting);
    }
}
