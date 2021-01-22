<?php

namespace abouterf\Media\Services;

use Intervention\Image\Facades\Image;
use Storage;

class ImageFileService
{
    private static $sizes = [300, 600];
    public static function upload($file)
    {
        // here we replced move with putFileAs facade to make our code testable.

        $fileName = uniqid();
        $extension = $file->getClientOriginalExtension();
        $dir = 'public\\';
        Storage::putFileAs($dir, $file, $fileName . '.' . $extension);
        $path = $dir . $fileName . '.' . $extension;
        return self::resize(Storage::path($path), $dir, $fileName, $extension);
    }
    private static function resize($img, $dir, $fileName, $extension)
    {
        $img = Image::make($img);
        $imgs['original'] =  $fileName . '.' . $extension;
        foreach (self::$sizes as $size) {
            $imgs[$size] =  $fileName . '_' . $size . '.' . $extension;
            $img->resize($size, null, function ($aspect) {
                $aspect->aspectRatio();
            })->save(Storage::path($dir) . $fileName . '_' . $size . '.' . $extension);
        }
        return $imgs;
    }

    public static function delete($media)
    {
        foreach ($media->files as $file) {
            Storage::delete('public\\' . $file);
        }
    }
}
