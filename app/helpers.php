<?php

use Illuminate\Support\Facades\Storage;
use Image;

if (!function_exists('interventionSaveImage'))
{
    function resizeSaveImage($image, $path, $width, $height)
    {
        $resize = Image::make($image)->resize($width, $height, function ($constraint)
        {
            $constraint->aspectRatio();
        })->encode("webp");
        $hash = md5($resize->__toString());
        $savePath = $path . "$hash.webp";
        Storage::put("public/" . $path, $resize);
        return $savePath;
    }
}
