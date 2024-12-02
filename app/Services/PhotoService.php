<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Tinify\Tinify;
use Tinify\Source as TinifySource;

class PhotoService
{

    public static function processImage($file): string
    {
        if (!is_dir(Storage::path('tmp'))) mkdir(Storage::path('tmp'), 0755, true);
        if (!is_dir(Storage::path('user_photos'))) mkdir(Storage::path('user_photos'), 0755, true);

        $tmpPath = $file->store('tmp');

        Tinify::setKey(env('TINIFY_API_KEY'));
        $compressed = TinifySource::fromFile(Storage::path($tmpPath));
        $compressed->toFile(Storage::path($tmpPath));

        $image = Image::read(Storage::path($tmpPath));
        $image->resize(width: 70, height: 70);
        $path = 'user_photos/'.uniqid().".".$file->getClientOriginalExtension();
        $image->save(Storage::path($path));
        Storage::delete($tmpPath);

        return $path;
    }
}
