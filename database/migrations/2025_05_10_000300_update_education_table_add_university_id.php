<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('education', function (Blueprint $table) {
            $table->unsignedBigInteger('university_id')->nullable()->after('id');
        });

        $universityNames = DB::table('education')
            ->whereNotNull('university_name')
            ->pluck('university_name')
            ->map(fn ($name) => trim((string) $name))
            ->filter()
            ->unique()
            ->values();

        $now = now();

        foreach ($universityNames as $name) {
            DB::table('universities')->updateOrInsert(
                ['name' => $name],
                [
                    'country' => null,
                    'city' => null,
                    'logo' => null,
                    'website' => null,
                    'updated_at' => $now,
                    'created_at' => $now,
                ]
            );
        }

        $universityMap = DB::table('universities')
            ->whereIn('name', $universityNames)
            ->pluck('id', 'name');

        DB::table('education')
            ->orderBy('id')
            ->select('id', 'university_name')
            ->chunkById(500, function ($educations) use ($universityMap) {
                foreach ($educations as $education) {
                    $name = trim((string) $education->university_name);
                    $universityId = $name !== '' ? $universityMap->get($name) : null;

                    if ($universityId) {
                        DB::table('education')
                            ->where('id', $education->id)
                            ->update(['university_id' => $universityId]);
                    }
                }
            });

        $unlinkedIds = DB::table('education')
            ->whereNull('university_id')
            ->pluck('id');

        if ($unlinkedIds->isNotEmpty()) {
            $fallbackId = DB::table('universities')->where('name', 'Unspecified University')->value('id');

            if (! $fallbackId) {
                $fallbackId = DB::table('universities')->insertGetId([
                    'name' => 'Unspecified University',
                    'country' => null,
                    'city' => null,
                    'logo' => null,
                    'website' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            DB::table('education')
                ->whereIn('id', $unlinkedIds)
                ->update(['university_id' => $fallbackId]);
        }

        Schema::table('education', function (Blueprint $table) {
            $table->unsignedBigInteger('university_id')->nullable(false)->change();
            $table->foreign('university_id')
                ->references('id')
                ->on('universities')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->dropColumn('university_name');
        });
    }

    public function down(): void
    {
        Schema::table('education', function (Blueprint $table) {
            $table->string('university_name')->nullable()->after('id');
        });

        $universityNames = DB::table('universities')->pluck('name', 'id');

        DB::table('education')
            ->orderBy('id')
            ->select('id', 'university_id')
            ->chunkById(500, function ($educations) use ($universityNames) {
                foreach ($educations as $education) {
                    $name = $universityNames[$education->university_id] ?? null;

                    if ($name !== null) {
                        DB::table('education')
                            ->where('id', $education->id)
                            ->update(['university_name' => $name]);
                    }
                }
            });

        Schema::table('education', function (Blueprint $table) {
            $table->dropForeign(['university_id']);
            $table->dropColumn('university_id');
        });
    }
};
