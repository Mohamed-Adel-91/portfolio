<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\IntroRequest;
use App\Models\Intro;
use App\Traits\FileUploadTrait;
use App\Traits\DeleteFileTrait;

class IntroController  extends Controller
{
    use FileUploadTrait, DeleteFileTrait;
    public function edit()
    {
        $data = Intro::first() ?? new Intro();
        return view('admin.intro.edit')->with([
            'pageName' => 'Edit Intro Section',
            'data' => $data,
        ]);
    }

    public function update(IntroRequest $request)
    {
        $item = Intro::first() ?? new Intro();
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $folder = 'upload/intro';
            $uploadedImage = $this->uploadFile(
                [$request->file('image')],
                [$folder],
                ['image'],
            );

            if (!empty($uploadedImage[0])) {
                if ($item->image) {
                    $this->deleteFile($item->image, 'upload/intro');
                }
                $validatedData['image'] = $uploadedImage[0];
            }
        }

        if ($request->hasFile('cv_pdf')) {
            $folder = 'upload/cv';
            $uploadedCV = $this->uploadFile(
                [$request->file('cv_pdf')],
                [$folder],
                ['cv_pdf'],
            );

            if (!empty($uploadedCV[0])) {
                if ($item->cv_pdf) {
                    $this->deleteFile($item->cv_pdf, 'upload/cv');
                }
                $validatedData['cv_pdf'] = $uploadedCV[0];
            }
        }

        if (!$request->hasFile('image') && !$item->image) {
            unset($validatedData['image']);
        }

        if (!$request->hasFile('cv_pdf') && !$item->cv_pdf) {
            unset($validatedData['cv_pdf']);
        }

        if (!$item->exists) {
            $item->fill($validatedData);
            $item->save();
        } else {
            $item->update($validatedData);
        }

        session()->flash('success', 'Intro updated successfully!');
        return back();
    }
}
