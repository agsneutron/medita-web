<?php

namespace App\Services;

use Illuminate\Session\Store;
use ImageOptimizer;

class UploadFiles
{

    public static function deleteFile($path)
    {

        $path = public_path() . $path;
        if (\File::exists($path)) \File::delete($path);
        return $path;
    }


    public static function storeFileWithName($file,$fileName,$pathType = ''){

        $path = '/uploads/' . $pathType;
        $name = str_replace('.', '', (string)microtime(true)) . '_' . $fileName.'.'.$file->extension();

        // Move image to corresponding directory
        $file->move(public_path() . $path, $name);
        return $path . $name;
    }

    public static function uploadFile($projectName,$file,$nameFile,$pathType='')
    {
        $path = '/uploads'.$pathType;
        $name = '_'.$projectName.'_'. '_' . $nameFile . '.' . $file->extension();

        // Create path if does not exists
        if (!file_exists(public_path() . $path)) {
            mkdir(
                public_path() . $path,
                0755,
                true
            );
        }

        // Move image to corresponding directory
        $file->move(public_path() . $path, $name);
        ImageOptimizer::optimize(public_path() . $path . '/' . $name);

        return $path . '/' . $name;
    }
    public static function storeFile($file,$pathType = ''){
        $path = '/uploads/' . $pathType;
        $name = str_replace('.', '', (string)microtime(true)) . '_' . $file->name;

        // Move image to corresponding directory
        $file->move(public_path() . $path, $name);
        return $path . $name;
    }
}
