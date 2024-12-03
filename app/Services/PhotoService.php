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
        if (!is_dir(Storage::disk('public')->path('tmp'))) mkdir(Storage::disk('public')->path('tmp'), 0755, true);
        if (!is_dir(Storage::disk('public')->path('user_photos'))) mkdir(Storage::disk('public')->path('user_photos'), 0755, true);

        $tmpPath = $file->store('tmp', 'public');

        Tinify::setKey(env('TINIFY_API_KEY'));
        $compressed = TinifySource::fromFile(Storage::disk('public')->path($tmpPath));
        $compressed->toFile(Storage::disk('public')->path($tmpPath));

        $image = Image::read(Storage::disk('public')->path($tmpPath));
        $image->resize(width: 70, height: 70);
        $path = 'user_photos/'.uniqid().".".$file->getClientOriginalExtension();
        $image->save(Storage::disk('public')->path($path));
        Storage::disk('public')->delete($tmpPath);

        return $path;
    }
}
