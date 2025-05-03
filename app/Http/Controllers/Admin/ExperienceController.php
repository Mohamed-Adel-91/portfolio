<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Traits\DeleteFileTrait;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExperienceController extends Controller
{
    use FileUploadTrait, DeleteFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experiences = Experience::latest()->get();
        return view('experiences.index', compact('experiences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('experiences.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'co_name' => 'required|string|max:255',
            'work_type' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'nullable|string|max:255',
            'start_at' => 'required|date',
            'end_at' => 'nullable|date|after_or_equal:start_at'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('experience_images', 'public');
        }

        Experience::create($validated);

        return redirect()->route('experiences.index')->with('success', 'Experience added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Experience $experience)
    {
        return view('experiences.show', compact('experience'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Experience $experience)
    {
        return view('experiences.edit', compact('experience'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'co_name' => 'required|string|max:255',
            'work_type' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'nullable|string|max:255',
            'start_at' => 'required|date',
            'end_at' => 'nullable|date|after_or_equal:start_at'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($experience->image) {
                Storage::disk('public')->delete($experience->image);
            }
            $validated['image'] = $request->file('image')->store('experience_images', 'public');
        }

        $experience->update($validated);

        return redirect()->route('experiences.index')->with('success', 'Experience updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience)
    {
        if ($experience->image) {
            Storage::disk('public')->delete($experience->image);
        }

        $experience->delete();

        return redirect()->route('experiences.index')->with('success', 'Experience deleted successfully!');
    }
}
