<?php

use Illuminate\Support\Facades\Storage;
use Intervention\Image;

if (!function_exists('interventionSaveImage'))
{
    function resizeAndSaveImage($image, $path, $width, $height, $encoding)
    {
        $resized = Image::make($image)->resize($width, $height, function ($constraint)
        {
            $constraint->aspectRatio();
        })->encode($encoding);
        return saveImage($resized, $path, $encoding);
    }
    function encodeAndSaveImage($image, $path, $encoding)
    {
        $encoded = Image::make($image)->encode($encoding);
        return saveImage($encoded, $path, $encoding);
    }
    function saveImage($image, $path, $encoding)
    {
        $hash = md5($image->__toString()) . strtotime("now");
        $savePath = $path . "$hash." . $encoding;
        Storage::put("public/" . $savePath, $image);
        return $savePath;
    }
}
