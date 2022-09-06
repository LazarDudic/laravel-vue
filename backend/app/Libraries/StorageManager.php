<?php

namespace App\Libraries;

use Exception;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class StorageManager
{
    public static function deleteFile($path)
    {
        if (!Storage::exists($path)) {
            return;
        }

        Storage::delete($path);
    }

    public static function deleteFileLocal($path)
    {
        if (!Storage::disk('local')->exists($path)) {
            return;
        }
        Storage::disk('local')->delete($path);
    }
    public static function pathInfo($path)
    {
        return pathinfo($path);
    }
    public static function getUrl($path)
    {
        return config('filesystems.disks.s3.front_link') . '/' . $path;
    }
    public static function putFile($directoriumPath, $file)
    {
        $name = $file->getClientOriginalName();
        $info = pathinfo($name);
        $filename = $info["filename"];
        $extention = $info["extension"];
        $path = $directoriumPath . '/' . $filename . '.' . $extention;
        $next = 1;
        while (Storage::exists($path)) {
            $filename = $filename . $next;
            $next = $next + 1;
            $path = $directoriumPath . '/' . $filename . '.' . $extention;
        }
        $success = Storage::put($path, fopen($file->getPathName(), 'r+'), 'public');
        if (! $success) {
            throw new Exception("Couldn't upload file");
        }
        return array($path, $filename, $extention);
    }


    public static function makeThumbnail($directoriumPath, $filename, $extention, $image)
    {

        $thumb_path = $directoriumPath . '/' . $filename . '_thumb.' . $extention;

        $next = 1;
        while (Storage::exists($thumb_path)) {
            $filename = $filename . $next;
            $next = $next + 1;
            $thumb_path = $directoriumPath . '/' . $filename . '_thumb.' . $extention;
        }

        $toProcess = Image::make($image->getPathName());
        $width = $toProcess->width();
        $height = $toProcess->height();
        if ($width > $height) {
            if ($width > 512) {
                $ratio = $width / $height;
                $width = 512;
                $height = 512 / $ratio;
            }
        } else {
            if ($height > 512) {
                $ratio = $height / $width;
                $height = 512;
                $width = 512 / $ratio;
            }
        }
        $success = Storage::put($thumb_path, $toProcess->resize($width, $height)->stream(), 'public');
        if ($success) {
            return $thumb_path;
        }
        throw new Exception("Couldn't make thumbnail");
    }

    public static function makeThumbnailDesired($directoriumPath, $filename, $extention, $image, $desiredWidth = 300, $desiredHeight = 300)
    {

        $thumb_path = $directoriumPath . '/' . $filename . '_thumb.' . $extention;

        $next = 1;
        while (Storage::exists($thumb_path)) {
            $filename = $filename . $next;
            $next = $next + 1;
            $thumb_path = $directoriumPath . '/' . $filename . '_thumb.' . $extention;
        }
        $toProcess = Image::make($image->getPathName());

        $success = Storage::put($thumb_path, $toProcess->fit($desiredWidth, $desiredHeight, function ($constraint) {
            $constraint->upsize();
        })->stream(), 'public');
        if ($success) {
            return $thumb_path;
        }
        throw new Exception("Couldn't make thumbnail");
    }

    public static function putFileLocale($directoriumPath, $file, $hashSuffix = false)
    {
        $name = $file->getClientOriginalName();
        $info = pathinfo($name);
        $filename = Str::slug($info["filename"]);
        if ($hashSuffix) $filename = $filename . '-' . Str::random(5);
        $extention = $info["extension"];
        $path = $directoriumPath . '/' . $filename . '.' . $extention;
        $next = 1;
        while (Storage::disk('local')->exists($path)) {
            $filename = $filename . $next;
            $next = $next + 1;
            $path = $directoriumPath . '/' . $filename . '.' . $extention;
        }
        $success = Storage::disk('local')->put($path, fopen($file->getPathName(), 'r+'));
        if ($success) {
            return array($path, $filename, $extention);
        }
        throw new Exception("Couldn't upload file");
    }
}
