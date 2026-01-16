<?php

namespace App\Services\PersonalDashboard\LifeGoals;

use App\Models\LifeGoalItem;
use App\Traits\FileUploadTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class LifeGoalItemService
{
    use FileUploadTrait;

    private const IMAGE_FOLDER = 'life-goals';

    public function create(array $data, ?UploadedFile $image = null): LifeGoalItem
    {
        return DB::transaction(function () use ($data, $image) {
            if ($image) {
                $data['image_path'] = $this->storeImage($image);
            }

            return LifeGoalItem::create($data);
        });
    }

    public function update(LifeGoalItem $item, array $data, ?UploadedFile $image = null): LifeGoalItem
    {
        return DB::transaction(function () use ($item, $data, $image) {
            if ($image) {
                $newPath = $this->storeImage($image);
                $this->deleteImage($item->image_path);
                $data['image_path'] = $newPath;
            }

            $item->update($data);

            return $item;
        });
    }

    public function delete(LifeGoalItem $item): void
    {
        $this->deleteImage($item->image_path);
        $item->delete();
    }

    private function storeImage(UploadedFile $image): ?string
    {
        $directory = $this->uploadDirectory();
        $this->ensureUploadDirectoryExists();

        $uploaded = $this->uploadFile([$image], [$directory]);

        if (empty($uploaded[0])) {
            return null;
        }

        return self::IMAGE_FOLDER . '/' . $uploaded[0];
    }

    private function deleteImage(?string $path): void
    {
        if (! $path) {
            return;
        }

        $fullPath = storage_path('app/public/' . $path);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

    private function uploadDirectory(): string
    {
        return storage_path('app/public/' . self::IMAGE_FOLDER);
    }

    private function ensureUploadDirectoryExists(): void
    {
        $directory = $this->uploadDirectory();
        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    }
}
