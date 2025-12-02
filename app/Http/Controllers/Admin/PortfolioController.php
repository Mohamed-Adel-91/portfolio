<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePortfolioRequest;
use App\Http\Requests\Admin\UpdatePortfolioRequest;
use App\Models\Portfolio;
use App\Models\Project;
use App\Traits\DeleteFileTrait;
use App\Traits\FileUploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PortfolioController extends Controller
{
    use FileUploadTrait, DeleteFileTrait;

    private const IMAGE_UPLOAD_PATH = 'upload/portfolio';

    public function index(): View
    {
        $portfolios = Portfolio::with(['project'])
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.portfolio.index', [
            'pageName' => 'Portfolio',
            'portfolios' => $portfolios,
        ]);
    }

    public function create(): View
    {
        return view('admin.portfolio.create', [
            'pageName' => 'Add Portfolio Item',
            'portfolio' => new Portfolio(),
            'projects' => Project::orderBy('name')->get(),
        ]);
    }

    public function store(StorePortfolioRequest $request): RedirectResponse
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

        Portfolio::create($data);

        return redirect()
            ->route('admin.portfolio.index')
            ->with('success', 'Portfolio item created successfully.');
    }

    public function edit(Portfolio $portfolio): View
    {
        return view('admin.portfolio.edit', [
            'pageName' => 'Edit Portfolio Item',
            'portfolio' => $portfolio,
            'projects' => Project::orderBy('name')->get(),
        ]);
    }

    public function update(UpdatePortfolioRequest $request, Portfolio $portfolio): RedirectResponse
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
                if ($portfolio->image) {
                    $this->deleteFile($portfolio->image, self::IMAGE_UPLOAD_PATH);
                }
                $data['image'] = $uploadedImage[0];
            }
        } else {
            unset($data['image']);
        }

        $portfolio->update($data);

        return redirect()
            ->route('admin.portfolio.index')
            ->with('success', 'Portfolio item updated successfully.');
    }

    public function destroy(Portfolio $portfolio): RedirectResponse
    {
        if ($portfolio->image) {
            $this->deleteFile($portfolio->image, self::IMAGE_UPLOAD_PATH);
        }

        $portfolio->delete();

        return redirect()
            ->route('admin.portfolio.index')
            ->with('success', 'Portfolio item deleted successfully.');
    }

    private function ensureUploadDirectoryExists(): void
    {
        $directory = public_path(self::IMAGE_UPLOAD_PATH);

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    }
}
