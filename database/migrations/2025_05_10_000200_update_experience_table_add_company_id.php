<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('experience', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable()->after('id');
        });

        $companyNames = DB::table('experience')
            ->whereNotNull('co_name')
            ->pluck('co_name')
            ->map(fn ($name) => trim((string) $name))
            ->filter()
            ->unique()
            ->values();

        $now = now();

        foreach ($companyNames as $name) {
            DB::table('companies')->updateOrInsert(
                ['name' => $name],
                [
                    'industry' => null,
                    'location' => null,
                    'logo' => null,
                    'website' => null,
                    'updated_at' => $now,
                    'created_at' => $now,
                ]
            );
        }

        $companyMap = DB::table('companies')
            ->whereIn('name', $companyNames)
            ->pluck('id', 'name');

        DB::table('experience')
            ->orderBy('id')
            ->select('id', 'co_name')
            ->chunkById(500, function ($experiences) use ($companyMap) {
                foreach ($experiences as $experience) {
                    $name = trim((string) $experience->co_name);
                    $companyId = $name !== '' ? $companyMap->get($name) : null;

                    if ($companyId) {
                        DB::table('experience')
                            ->where('id', $experience->id)
                            ->update(['company_id' => $companyId]);
                    }
                }
            });

        $unlinkedIds = DB::table('experience')
            ->whereNull('company_id')
            ->pluck('id');

        if ($unlinkedIds->isNotEmpty()) {
            $fallbackId = DB::table('companies')->where('name', 'Unspecified Company')->value('id');

            if (! $fallbackId) {
                $fallbackId = DB::table('companies')->insertGetId([
                    'name' => 'Unspecified Company',
                    'industry' => null,
                    'location' => null,
                    'logo' => null,
                    'website' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            DB::table('experience')
                ->whereIn('id', $unlinkedIds)
                ->update(['company_id' => $fallbackId]);
        }

        Schema::table('experience', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable(false)->change();
            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->dropColumn('co_name');
        });
    }

    public function down(): void
    {
        Schema::table('experience', function (Blueprint $table) {
            $table->string('co_name')->nullable()->after('id');
        });

        $companyNames = DB::table('companies')->pluck('name', 'id');

        DB::table('experience')
            ->orderBy('id')
            ->select('id', 'company_id')
            ->chunkById(500, function ($experiences) use ($companyNames) {
                foreach ($experiences as $experience) {
                    $name = $companyNames[$experience->company_id] ?? null;

                    if ($name !== null) {
                        DB::table('experience')
                            ->where('id', $experience->id)
                            ->update(['co_name' => $name]);
                    }
                }
            });

        Schema::table('experience', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropColumn('company_id');
        });
    }
};
