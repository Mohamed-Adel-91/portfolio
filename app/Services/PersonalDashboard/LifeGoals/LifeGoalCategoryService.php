<?php

namespace App\Services\PersonalDashboard\LifeGoals;

use App\Models\LifeGoalCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LifeGoalCategoryService
{
    public function create(array $data): LifeGoalCategory
    {
        return DB::transaction(function () use ($data) {
            $data['slug'] = $this->resolveSlug($data['slug'] ?? null, $data['name'] ?? null);

            return LifeGoalCategory::create($data);
        });
    }

    public function update(LifeGoalCategory $category, array $data): LifeGoalCategory
    {
        return DB::transaction(function () use ($category, $data) {
            $data['slug'] = $this->resolveSlug($data['slug'] ?? null, $data['name'] ?? null, $category->id);

            $category->update($data);

            return $category;
        });
    }

    public function delete(LifeGoalCategory $category): void
    {
        $category->delete();
    }

    private function resolveSlug(?string $slug, ?string $name, ?int $ignoreId = null): string
    {
        $base = $slug ?: ($name ?? 'goal-category');
        $base = Str::slug($base);

        if ($base === '') {
            $base = 'goal-category';
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
        $query = LifeGoalCategory::query()->where('slug', $slug);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }
}
