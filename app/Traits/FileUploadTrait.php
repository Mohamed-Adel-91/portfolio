<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

trait FileUploadTrait
{

    public function uploadFile(array $files, array $folders, array $attributes = [], Model $model = null, $renameFile = null)
    {
        try {
            $fileNames = [];

            foreach ($files as $key => $file) {
                if ($file instanceof \Illuminate\Http\UploadedFile) {
                    try {
                        $folder = 'uploads/' . $folders[$key]; // Get the upload folder dynamically

                        // Check if the directory exists, if not, create it
                        if (!is_dir($folder)) {
                            mkdir($folder, 0755, true);
                        }

                        $fileName = time() . Str::random(20) . '.' . $file->getClientOriginalExtension();

                        // Move file using copy instead of move
                        $destinationPath = $folder . '/' . $fileName;
                        copy($file->getRealPath(), $destinationPath);

                        $fileNames[] = $fileName;

                        // Delete the old file if updating
                        if (isset($model) && isset($attributes[$key]) && $model->{$attributes[$key]} !== null) {
                            $oldFilePath = $folder . '/' . $model->{$attributes[$key]};
                            if (file_exists($oldFilePath)) {
                                unlink($oldFilePath);
                            }
                        }
                    } catch (\Exception $e) {
                        throw new \Exception($e->getMessage());
                    }
                } elseif ($file !== null) {
                    $fileNames[] = $file;
                }
            }
            return $fileNames;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
