<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


// This code is a helper class that will help you to move files from your web application to your storage.
// The code is using the Laravel Storage facade. You can change the code to use any other storage library.


class FileHelper
{
    /**
     * Move one or more files to a new location.
     *
     * @param  array|UploadedFile  $files
     * @param  string  $storePath
     * @return array|string
     */

    // This code moves files from the request to the file storage.
    // It returns an array of file names.
    // It is used in the controller to move files from the request to the file storage.
    // It is used in the controller to move files from the request to the file storage.

    public static function fileMover($files, $storePath = null): array
    {
        if ($storePath === null) {
            $storePath = config('folderName');
        }

        if (is_array($files)) {
            return static::moveMultipleFiles($files, $storePath);
        } else {
            return static::moveSingleFile($files, $storePath);
        }
    }

    protected static function moveSingleFile($file, $storePath): string
    {
        $filename = static::generateFilename($file);
        $filePath = static::generateFilePath($filename, $storePath);
        static::storeFile($file, $filePath);
        return $filename;
    }

    protected static function moveMultipleFiles($files, $storePath): array
    {
        $data = [];

        foreach ($files as $file) {
            $filename = static::generateFilename($file);
            $filePath = static::generateFilePath($filename, $storePath);
            static::storeFile($file, $filePath);
            $data[] = $filename;
        }

        return $data;
    }

    protected static function generateFilename($file): string
    {
        return time() . '_' . $file->getClientOriginalName();
    }

    protected static function generateFilePath($filename, $storePath): string
    {
        return $storePath . '/' . $filename;
    }

    protected static function storeFile($file, $filePath): void
    {
        Storage::disk(config('fileStorage'))->put($filePath, file_get_contents($file));
    }
}
