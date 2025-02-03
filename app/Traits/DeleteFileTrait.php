<?php

namespace App\Traits;

trait DeleteFileTrait
{

    public function deleteFile($filename, $folder)
    {
        if ($filename) {
            $filePath = public_path($folder . '/' . $filename);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }

}
