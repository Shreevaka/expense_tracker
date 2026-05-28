<?php

namespace domain\Services;

use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function store($image, $folderName)
    {
        $folderPath = 'public/' . $folderName;

        $fileName = time() . '_' . uniqid() . '.' . $image->extension();

        $imagePath = Storage::disk('local')->putFileAs($folderPath, $image, $fileName);

        $imagePathWithoutPublic = substr($imagePath, strlen('public/'));

        return $imagePathWithoutPublic;
    }

    public function delete($path)
    {
        $imagePath = 'public/' . $path;
        Storage::disk('local')->delete($imagePath);
    }
}
