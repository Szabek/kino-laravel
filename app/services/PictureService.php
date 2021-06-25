<?php


namespace App\services;


use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PictureService
{

    public function resizePicture(string $pictureSource, int $width, int $height)
    {
        $image = Image::make(public_path("storage/{$pictureSource}"))->fit($width, $height);
        $image->save();
    }

    public function removePicture(string $pictureSource)
    {
        if (Storage::exists(public_path("storage/{$pictureSource}"))) {
            Storage::delete(public_path("storage/{$pictureSource}"));
            return true;
        }
        return false;
    }
}

