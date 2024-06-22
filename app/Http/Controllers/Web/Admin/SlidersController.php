<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SlidersRequest;
use App\Models\Sliders;
use App\Traits\FileUploadTrait;

class SlidersController extends Controller
{
    use FileUploadTrait;
    public function index()
    {

        $data = Sliders::all();

        $groupedSliders = $data->groupBy('pageName')->map(function ($pageGroup) {
            return $pageGroup->groupBy('sectionName');
        });

        return view('admin.sliders.index')->with([
            'groupedSliders' => $groupedSliders,
            'pageName' => 'Sliders - All list',
        ]);
    }

    public function create()
    {
        return view('admin.sliders.form')->with([
            'pageName' => 'Create Slider',
            'isUpdate' => false,
        ]);
    }
    public function store(SlidersRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $folder = 'uploads/sliders';
            $uploadedImage = $this->uploadFile(
                [$request->file('image')],
                [$folder],
                ['image'],
            );

            if (!empty($uploadedImage[0])) {
                $validatedData['image'] = $uploadedImage[0];
            }
        }

        $slider = new Sliders();
        $slider->fill($validatedData);
        $slider->setTranslations('title', $request->input('title'));
        $slider->setTranslations('description', $request->input('description'));
        $slider->save();
        session()->flash('success', 'Slider added successfully');
        return redirect()->route('admin.sliders.index');
    }

    public function show($slider)
    {
        $slider = Sliders::findOrFail($slider);
        return view('admin.sliders.index', compact('slider'));
    }

    public function edit(Sliders $slider)
    {
        return view('admin.sliders.form')->with([
            'pageName' => 'Edit sliders',
            'data' => $slider,
            'isUpdate' => true,
        ]);
    }

    public function update(SlidersRequest $request, Sliders $slider)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $folder = 'uploads/sliders';

            $uploadedImage = $this->uploadFile(
                [$request->file('image')],
                [$folder],
                ['image'],
                $slider
            );

            if (!empty($uploadedImage[0])) {
                $validatedData['image'] = $uploadedImage[0];
            }
        }

        $slider->fill($validatedData);
        $slider->setTranslations('title', $request->input('title'));
        $slider->setTranslations('description', $request->input('description'));
        $slider->save();
        session()->flash('success', 'Slider updated successfully');
        return redirect()->route('admin.sliders.index');
    }

    public function destroy($slider)
    {
        $slider = Sliders::findOrFail($slider);
        $slider->delete();
        session()->flash('success', 'Slider deleted successfully');
        return redirect()->route('admin.sliders.index');
    }
}
