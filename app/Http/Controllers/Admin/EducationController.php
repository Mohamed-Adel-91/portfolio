<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEducationRequest;
use App\Http\Requests\Admin\UpdateEducationRequest;
use App\Models\University;
use App\Models\Education;
use App\Traits\DeleteFileTrait;
use App\Traits\FileUploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    use FileUploadTrait, DeleteFileTrait;

    private const IMAGE_UPLOAD_PATH = 'upload/education';

    public function index(): View
    {
        $educations = Education::with('university')
            ->orderByDesc('start_at')
            ->paginate(10);

        return view('admin.education.index', [
            'pageName' => 'Education',
            'educations' => $educations,
        ]);
    }

    public function create(): View
    {
        $universities = University::orderBy('name')->get();
        $selectedUniversityId = old('university_id') ?? session('selected_university_id') ?? null;

        return view('admin.education.create', [
            'pageName' => 'Add Education',
            'education' => new Education(),
            'universities' => $universities,
            'selectedUniversityId' => $selectedUniversityId,
        ]);
    }

    public function store(StoreEducationRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['university_id'] = (int) $data['university_id'];

        if ($request->hasFile('image')) {
            $this->ensureUploadDirectoryExists();

            $uploadedImage = $this->uploadFile(
                [$request->file('image')],
                [self::IMAGE_UPLOAD_PATH],
                ['image']
            );

            if (!empty($uploadedImage[0])) {
                $data['image'] = 'education/' . $uploadedImage[0];
            }
        } else {
            unset($data['image']);
        }

        Education::create($data);

        return redirect()
            ->route('admin.education.index')
            ->with('success', 'Education created successfully.');
    }

    public function edit(Education $education): View
    {
        $education->load('university');
        $universities = University::orderBy('name')->get();
        $selectedUniversityId = old('university_id') ?? session('selected_university_id') ?? $education->university_id;

        return view('admin.education.edit', [
            'pageName' => 'Edit Education',
            'education' => $education,
            'universities' => $universities,
            'selectedUniversityId' => $selectedUniversityId,
        ]);
    }

    public function update(UpdateEducationRequest $request, Education $education): RedirectResponse
    {
        $data = $request->validated();

        $data['university_id'] = (int) $data['university_id'];

        if ($request->hasFile('image')) {
            $this->ensureUploadDirectoryExists();

            $uploadedImage = $this->uploadFile(
                [$request->file('image')],
                [self::IMAGE_UPLOAD_PATH],
                ['image']
            );

            if (!empty($uploadedImage[0])) {
                if ($education->image) {
                    $this->deleteFile($education->image, 'upload');
                }
                $data['image'] = 'education/' . $uploadedImage[0];
            }
        } else {
            unset($data['image']);
        }

        $education->update($data);

        return redirect()
            ->route('admin.education.index')
            ->with('success', 'Education updated successfully.');
    }

    public function storeUniversityInline(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $university = University::firstOrCreate(['name' => $validated['name']]);

        return back()
            ->with('inline_university_success', 'University saved.')
            ->with('selected_university_id', $university->id);
    }

    public function destroy(Education $education): RedirectResponse
    {
        if ($education->image) {
            $this->deleteFile($education->image, 'upload');
        }

        $education->delete();

        return redirect()
            ->route('admin.education.index')
            ->with('success', 'Education deleted successfully.');
    }

    private function ensureUploadDirectoryExists(): void
    {
        $directory = public_path(self::IMAGE_UPLOAD_PATH);

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    }
}
