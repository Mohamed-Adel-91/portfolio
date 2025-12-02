<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreResumeRequest;
use App\Http\Requests\Admin\UpdateResumeRequest;
use App\Models\Resume;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ResumeController extends Controller
{
    public function index(): View
    {
        $resumes = Resume::orderByDesc('id')->paginate(10);

        return view('admin.resume.index', [
            'pageName' => 'Resume',
            'resumes' => $resumes,
        ]);
    }

    public function create(): View
    {
        return view('admin.resume.create', [
            'pageName' => 'Add Resume',
            'resume' => new Resume(),
        ]);
    }

    public function store(StoreResumeRequest $request): RedirectResponse
    {
        Resume::create($request->validated());

        return redirect()
            ->route('admin.resume.index')
            ->with('success', 'Resume created successfully.');
    }

    public function edit(Resume $resume): View
    {
        return view('admin.resume.edit', [
            'pageName' => 'Edit Resume',
            'resume' => $resume,
        ]);
    }

    public function update(UpdateResumeRequest $request, Resume $resume): RedirectResponse
    {
        $resume->update($request->validated());

        return redirect()
            ->route('admin.resume.index')
            ->with('success', 'Resume updated successfully.');
    }

    public function destroy(Resume $resume): RedirectResponse
    {
        $resume->delete();

        return redirect()
            ->route('admin.resume.index')
            ->with('success', 'Resume deleted successfully.');
    }
}
