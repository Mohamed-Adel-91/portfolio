<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsRequest;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function edit()
    {
        $data = Setting::firstOrFail();
        return view('admin.settings.edit')->with([
            'pageName' => 'Edit Settings',
            'data' => $data,
        ]);
    }

    public function update(SettingsRequest $request)
    {
        $setting = Setting::firstOrFail();
        $setting->update($request->validated());
        session()->flash('success', 'Settings updated successfully');
        return back();
    }
}
