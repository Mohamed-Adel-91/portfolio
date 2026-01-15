<?php

namespace App\Services\PersonalDashboard;

use App\Models\TodoCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TodoCategoryService
{
    public function create(array $data): TodoCategory
    {
        return DB::transaction(function () use ($data) {
            $data['slug'] = $this->resolveSlug($data['slug'] ?? null, $data['name'] ?? null);

            return TodoCategory::create($data);
        });
    }

    public function update(TodoCategory $category, array $data): TodoCategory
    {
        return DB::transaction(function () use ($category, $data) {
            $data['slug'] = $this->resolveSlug($data['slug'] ?? null, $data['name'] ?? null, $category->id);

            $category->update($data);

            return $category;
        });
    }

    public function delete(TodoCategory $category): void
    {
        $category->delete();
    }

    private function resolveSlug(?string $slug, ?string $name, ?int $ignoreId = null): string
    {
        $base = $slug ?: ($name ?? 'category');
        $base = Str::slug($base);

        if ($base === '') {
            $base = 'category';
        }

        $base = Str::substr($base, 0, 140);
        $candidate = $base;
        $suffix = 2;

        while ($this->slugExists($candidate, $ignoreId)) {
            $suffixLabel = '-' . $suffix;
            $trimmedBase = Str::substr($base, 0, 140 - strlen($suffixLabel));
            $candidate = $trimmedBase . $suffixLabel;
            $suffix++;
        }

        return $candidate;
    }

    private function slugExists(string $slug, ?int $ignoreId = null): bool
    {
        $query = TodoCategory::query()->where('slug', $slug);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }
}
