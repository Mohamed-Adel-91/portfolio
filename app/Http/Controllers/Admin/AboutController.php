<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutRequest;
use App\Models\About;
use App\Traits\FileUploadTrait;
use App\Traits\DeleteFileTrait;

class AboutController extends Controller
{
    use FileUploadTrait, DeleteFileTrait;
    public function edit()
    {
        $data = About::first() ?? new About();
        return view('admin.about.edit')->with([
            'pageName' => 'Edit About Section',
            'data' => $data,
        ]);
    }

    public function update(AboutRequest $request)
    {
        $item = About::first() ?? new About();
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $folder = 'upload/about';
            $uploadedImage = $this->uploadFile(
                [$request->file('image')],
                [$folder],
                ['image'],
            );

            if (!empty($uploadedImage[0])) {
                if ($item->image) {
                    $this->deleteFile($item->image, 'upload/about');
                }
                $validatedData['image'] = $uploadedImage[0];
            }
        }

        if (!$request->hasFile('image') && !$item->image) {
            unset($validatedData['image']);
        }

        if (!$item->exists) {
            $item->fill($validatedData);
            $item->save();
        } else {
            $item->update($validatedData);
        }

        session()->flash('success', 'About updated successfully!');
        return back();
    }
}
