<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class PhotoSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $this->generateAvatar($i);
        }
    }

    private function generateAvatar(int $i): void
    {
        $r = dechex(rand(100, 255));
        $g = dechex(rand(100, 255));
        $b = dechex(rand(100, 255));
        $image = Image::create(70, 70)->fill('#'.$r.$g.$b);
        $path = 'user_photos/'.$i.'.jpg';
        $image->save(Storage::disk('public')->path($path));
    }
}
