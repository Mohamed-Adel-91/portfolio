<?php

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait FileUploadTrait
{

    public function uploadFile(array $files, array $folders, array $attributes = [], Model $model = null)
    {
        try {

            $fileNames = [];

            foreach ($files as $key => $file) {
                if (isset($file)) {

                    $fileName = time() . Str::random(20) . '.' . $file->getClientOriginalExtension();
                    $file->move($folders[$key], $fileName);
                    $fileNames[] = $fileName;

                    if (isset($model)) {
                        if ($model->{$attributes[$key]} !== null) {
                            if (file_exists($folders[$key] . '/' . $model->{$attributes[$key]})) {
                                unlink($folders[$key] . '/' . $model->{$attributes[$key]});
                            }
                        }
                    }

                }

            }

            return $fileNames;

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}

// {

//     public function uploadFile(array $files, array $folders, array $attributes = [], Model $model = null, $renameFile = null)
//     {
//         try {
//             $fileNames = [];

//             foreach ($files as $key => $file) {
//                 if ($file instanceof \Illuminate\Http\UploadedFile) {
//                     try {
//                         $folder = 'uploads/' . $folders[$key]; // Get the upload folder dynamically
//                         $fileName = time() . Str::random(20) . '.' . $file->getClientOriginalExtension();

//                         // Move file using copy instead of move
//                         $destinationPath = $folder . '/' . $fileName;
//                         copy($file->getRealPath(), $destinationPath);

//                         $fileNames[] = $fileName;

//                         // Delete the old file if updating
//                         if (isset($model) && isset($attributes[$key]) && $model->{$attributes[$key]} !== null) {
//                             $oldFilePath = $folder . '/' . $model->{$attributes[$key]};
//                             if (file_exists($oldFilePath)) {
//                                 unlink($oldFilePath);
//                             }
//                         }
//                     } catch (\Exception $e) {
//                         throw new \Exception($e->getMessage());
//                     }
//                 } elseif ($file !== null) {
//                     $fileNames[] = $file;
//                 }
//             }
//             return $fileNames;
//         } catch (\Exception $e) {
//             throw new \Exception($e->getMessage());
//         }
//     }
// }
