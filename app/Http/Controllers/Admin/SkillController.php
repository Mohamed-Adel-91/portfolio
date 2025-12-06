<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSkillRequest;
use App\Http\Requests\Admin\UpdateSkillRequest;
use App\Models\Skill;
use App\Traits\DeleteFileTrait;
use App\Traits\FileUploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SkillController extends Controller
{
    use FileUploadTrait, DeleteFileTrait;

    private const LOGO_UPLOAD_PATH = 'upload/skills';

    public function index(): View
    {
        $skills = Skill::orderBy('type')->orderBy('name')->paginate(20);

        return view('admin.skills.index', [
            'pageName' => 'Skills',
            'skills' => $skills,
        ]);
    }

    public function create(): View
    {
        $typeOptions = Skill::typeOptions();

        return view('admin.skills.create', [
            'pageName' => 'Add Skill',
            'skill' => new Skill(),
            'typeOptions' => $typeOptions,
        ]);
    }

    public function store(StoreSkillRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $this->ensureUploadDirectoryExists();

        if ($request->hasFile('logo')) {
            $uploadedLogo = $this->uploadFile(
                [$request->file('logo')],
                [self::LOGO_UPLOAD_PATH],
                ['logo']
            );

            if (!empty($uploadedLogo[0])) {
                $validated['logo'] = 'skills/' . $uploadedLogo[0];
            }
        } else {
            unset($validated['logo']);
        }

        Skill::create($validated);

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Skill created successfully.');
    }

    public function edit(Skill $skill): View
    {
        $typeOptions = Skill::typeOptions();

        return view('admin.skills.edit', [
            'pageName' => 'Edit Skill',
            'skill' => $skill,
            'typeOptions' => $typeOptions,
        ]);
    }

    public function update(UpdateSkillRequest $request, Skill $skill): RedirectResponse
    {
        $validated = $request->validated();

        $this->ensureUploadDirectoryExists();

        if ($request->hasFile('logo')) {
            $uploadedLogo = $this->uploadFile(
                [$request->file('logo')],
                [self::LOGO_UPLOAD_PATH],
                ['logo'],
                $skill
            );

            if (!empty($uploadedLogo[0])) {
                if ($skill->logo) {
                    $this->deleteFile($skill->logo, 'upload');
                }

                $validated['logo'] = 'skills/' . $uploadedLogo[0];
            }
        } else {
            unset($validated['logo']);
        }

        $skill->update($validated);

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        if ($skill->logo) {
            $this->deleteFile($skill->logo, 'upload');
        }

        $skill->delete();

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Skill deleted successfully.');
    }

    private function ensureUploadDirectoryExists(): void
    {
        $directory = public_path(self::LOGO_UPLOAD_PATH);

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    }
}
