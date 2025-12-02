<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGalleryRequest;
use App\Http\Requests\Admin\UpdateGalleryRequest;
use App\Models\Gallery;
use App\Traits\DeleteFileTrait;
use App\Traits\FileUploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class GalleryController extends Controller
{
    use FileUploadTrait, DeleteFileTrait;

    private const IMAGE_UPLOAD_PATH = 'upload/gallery';

    public function index(): View
    {
        $galleries = Gallery::orderByDesc('created_at')->paginate(12);

        return view('admin.gallery.index', [
            'pageName' => 'Gallery',
            'galleries' => $galleries,
        ]);
    }

    public function create(): View
    {
        return view('admin.gallery.create', [
            'pageName' => 'Add Gallery Item',
            'gallery' => new Gallery(),
        ]);
    }

    public function store(StoreGalleryRequest $request): RedirectResponse
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

        Gallery::create($data);

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery item created successfully.');
    }

    public function edit(Gallery $gallery): View
    {
        return view('admin.gallery.edit', [
            'pageName' => 'Edit Gallery Item',
            'gallery' => $gallery,
        ]);
    }

    public function update(UpdateGalleryRequest $request, Gallery $gallery): RedirectResponse
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
                if ($gallery->image) {
                    $this->deleteFile($gallery->image, self::IMAGE_UPLOAD_PATH);
                }
                $data['image'] = $uploadedImage[0];
            }
        } else {
            unset($data['image']);
        }

        $gallery->update($data);

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery item updated successfully.');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        if ($gallery->image) {
            $this->deleteFile($gallery->image, self::IMAGE_UPLOAD_PATH);
        }

        $gallery->delete();

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery item deleted successfully.');
    }

    private function ensureUploadDirectoryExists(): void
    {
        $directory = public_path(self::IMAGE_UPLOAD_PATH);

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    }
}
