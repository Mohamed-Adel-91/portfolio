<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Media;
use App\Models\Ad;
use Illuminate\Support\Str;

class MediaSeeder extends Seeder
{
    public function run(): void
    {
        $ad = Ad::first();

        if ($ad) {
            Media::create([
                'model_type' => Ad::class,
                'model_id' => $ad->id,
                'uuid' => Str::uuid(),
                'collection_name' => 'images',
                'name' => 'sample_image',
                'file_name' => 'sample.jpg',
                'mime_type' => 'image/jpeg',
                'disk' => 'public',
                'conversions_disk' => 'public',
                'size' => 204800,
                'manipulations' => json_encode([]),
                'custom_properties' => json_encode(['alt' => 'Sample Image']),
                'generated_conversions' => json_encode([]),
                'responsive_images' => json_encode([]),
                'order_column' => 1,
            ]);
        }
    }
}
