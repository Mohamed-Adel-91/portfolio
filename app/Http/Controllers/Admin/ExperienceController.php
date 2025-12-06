<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreExperienceRequest;
use App\Http\Requests\Admin\UpdateExperienceRequest;
use App\Models\Company;
use App\Models\Experience;
use App\Traits\DeleteFileTrait;
use App\Traits\FileUploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    use FileUploadTrait, DeleteFileTrait;

    private const IMAGE_UPLOAD_PATH = 'upload/experience';

    public function index(): View
    {
        $experiences = Experience::with('company')
            ->orderByDesc('start_at')
            ->paginate(10);

        return view('admin.experience.index', [
            'pageName' => 'Experience',
            'experiences' => $experiences,
        ]);
    }

    public function create(): View
    {
        $companies = Company::orderBy('name')->get();
        $selectedCompanyId = old('company_id') ?? session('selected_company_id') ?? null;

        return view('admin.experience.create', [
            'pageName' => 'Add Experience',
            'experience' => new Experience(),
            'companies' => $companies,
            'selectedCompanyId' => $selectedCompanyId,
        ]);
    }

    public function store(StoreExperienceRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['company_id'] = (int) $data['company_id'];

        if ($request->hasFile('image')) {
            $this->ensureUploadDirectoryExists();

            $uploadedImage = $this->uploadFile(
                [$request->file('image')],
                [self::IMAGE_UPLOAD_PATH],
                ['image']
            );

            if (!empty($uploadedImage[0])) {
                $data['image'] = 'experience/' . $uploadedImage[0];
            }
        } else {
            unset($data['image']);
        }

        Experience::create($data);

        return redirect()
            ->route('admin.experience.index')
            ->with('success', 'Experience created successfully.');
    }

    public function edit(Experience $experience): View
    {
        $experience->load('company');
        $companies = Company::orderBy('name')->get();
        $selectedCompanyId = old('company_id') ?? session('selected_company_id') ?? $experience->company_id;

        return view('admin.experience.edit', [
            'pageName' => 'Edit Experience',
            'experience' => $experience,
            'companies' => $companies,
            'selectedCompanyId' => $selectedCompanyId,
        ]);
    }

    public function update(UpdateExperienceRequest $request, Experience $experience): RedirectResponse
    {
        $data = $request->validated();

        $data['company_id'] = (int) $data['company_id'];

        if ($request->hasFile('image')) {
            $this->ensureUploadDirectoryExists();

            $uploadedImage = $this->uploadFile(
                [$request->file('image')],
                [self::IMAGE_UPLOAD_PATH],
                ['image']
            );

            if (!empty($uploadedImage[0])) {
                if ($experience->image) {
                    $this->deleteFile($experience->image, 'upload');
                }
                $data['image'] = 'experience/' . $uploadedImage[0];
            }
        } else {
            unset($data['image']);
        }

        $experience->update($data);

        return redirect()
            ->route('admin.experience.index')
            ->with('success', 'Experience updated successfully.');
    }

    public function storeCompanyInline(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $company = Company::firstOrCreate(['name' => $validated['name']]);

        return back()
            ->with('inline_company_success', 'Company saved.')
            ->with('selected_company_id', $company->id);
    }

    public function destroy(Experience $experience): RedirectResponse
    {
        if ($experience->image) {
            $this->deleteFile($experience->image, 'upload');
        }

        $experience->delete();

        return redirect()
            ->route('admin.experience.index')
            ->with('success', 'Experience deleted successfully.');
    }

    private function ensureUploadDirectoryExists(): void
    {
        $directory = public_path(self::IMAGE_UPLOAD_PATH);

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    }
}
