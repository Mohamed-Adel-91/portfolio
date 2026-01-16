<?php

namespace App\Services\PersonalDashboard\LifeGoals;

use App\Models\LifeGoalItem;
use App\Traits\FileUploadTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class LifeGoalItemService
{
    use FileUploadTrait;

    private const IMAGE_FOLDER = 'upload/life-goals';

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
                $this->deleteImage($item->getRawOriginal('image_path'));
                $data['image_path'] = $newPath;
            }

            $item->update($data);

            return $item;
        });
    }

    public function delete(LifeGoalItem $item): void
    {
        $this->deleteImage($item->getRawOriginal('image_path'));
        $item->delete();
    }

    private function storeImage(UploadedFile $image): ?string
    {
        $this->ensureUploadDirectoryExists();

        $uploaded = $this->uploadFile([$image], [self::IMAGE_FOLDER]);

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

        $normalized = ltrim($path, '/');
        if (str_starts_with($normalized, 'upload/')) {
            $fullPath = public_path($normalized);
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
            return;
        }

        if (str_starts_with($normalized, 'storage/')) {
            $fullPath = public_path($normalized);
            if (file_exists($fullPath)) {
                unlink($fullPath);
                return;
            }

            $storagePath = storage_path('app/public/' . ltrim(substr($normalized, strlen('storage/')), '/'));
            if (file_exists($storagePath)) {
                unlink($storagePath);
            }
            return;
        }

        $storagePath = storage_path('app/public/' . $normalized);
        if (file_exists($storagePath)) {
            unlink($storagePath);
        }
    }

    private function ensureUploadDirectoryExists(): void
    {
        $directory = public_path(self::IMAGE_FOLDER);
        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    }
}
