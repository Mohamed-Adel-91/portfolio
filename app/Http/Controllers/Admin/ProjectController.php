<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectRequest;
use App\Http\Requests\Admin\UpdateProjectRequest;
use App\Models\Project;
use App\Traits\DeleteFileTrait;
use App\Traits\FileUploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
{
    use FileUploadTrait, DeleteFileTrait;

    private const IMAGE_UPLOAD_PATH = 'upload/projects';

    public function index(): View
    {
        $projects = Project::orderByDesc('lunched_at')
            ->orderByDesc('created_at')
            ->paginate(9);

        return view('admin.projects.index', [
            'pageName' => 'Projects',
            'projects' => $projects,
        ]);
    }

    public function create(): View
    {
        return view('admin.projects.create', [
            'pageName' => 'Add Project',
            'project' => new Project(),
        ]);
    }

    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $this->ensureUploadDirectoryExists();

            $uploadedImage = $this->uploadFile(
                [$request->file('image')],
                [self::IMAGE_UPLOAD_PATH],
                ['image']
            );

            if (!empty($uploadedImage[0])) {
                $data['image'] = $uploadedImage[0];
            }
        } else {
            unset($data['image']);
        }

        Project::create($data);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function edit(Project $project): View
    {
        return view('admin.projects.edit', [
            'pageName' => 'Edit Project',
            'project' => $project,
        ]);
    }

    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $this->ensureUploadDirectoryExists();

            $uploadedImage = $this->uploadFile(
                [$request->file('image')],
                [self::IMAGE_UPLOAD_PATH],
                ['image']
            );

            if (!empty($uploadedImage[0])) {
                if ($project->image) {
                    $this->deleteFile($project->image, 'upload/projects');
                }
                $data['image'] = $uploadedImage[0];
            }
        } else {
            unset($data['image']);
        }

        $project->update($data);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        if ($project->image) {
            $this->deleteFile($project->image, 'upload/projects');
        }

        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    private function ensureUploadDirectoryExists(): void
    {
        $directory = public_path(self::IMAGE_UPLOAD_PATH);

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    }
}
