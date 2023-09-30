<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FileHelper
{
    public static function fileMover($files, $storePath = null)
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

    protected static function moveSingleFile($file, $storePath)
    {
        $filename = static::generateFilename($file);
        $filePath = static::generateFilePath($filename, $storePath);
        static::storeFile($file, $filePath);
        return $filename;
    }

    protected static function moveMultipleFiles($files, $storePath)
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

    protected static function generateFilename($file)
    {
        return time() . '_' . $file->getClientOriginalName();
    }

    protected static function generateFilePath($filename, $storePath)
    {
        return $storePath . '/' . $filename;
    }

    protected static function storeFile($file, $filePath)
    {
        Storage::disk(config('fileStorage'))->put($filePath, file_get_contents($file));
    }
}
