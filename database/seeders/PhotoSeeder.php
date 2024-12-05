<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Geometry\Factories\PolygonFactory;
use Intervention\Image\Geometry\Factories\RectangleFactory;
use Intervention\Image\Geometry\Factories\CircleFactory;

class PhotoSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $this->generateAvatar($i);
        }
    }

    private function generateAvatar(int $i): void
    {
        $r = dechex(rand(100, 255));
        $g = dechex(rand(100, 255));
        $b = dechex(rand(100, 255));
        $image = Image::create(70, 70)->fill('#'.$r.$g.$b);
        switch (rand(0,2)) {
            case 0:
                $image->drawCircle(35, 35, function(CircleFactory $circle) {
                    $circle->radius(25);
                    $circle->background($this->getRandomColor());
                    $circle->border('#000000', 1);
                });
                break;
            case 1:
                $image->drawRectangle(10, 10, function(RectangleFactory $rectangle) {
                    $rectangle->size(50, 50);
                    $rectangle->background($this->getRandomColor());
                    $rectangle->border('#000000', 1);
                });
                break;
            case 2:
                $image->drawPolygon(function(PolygonFactory $polygon) {
                    $polygon->point(10, 10);
                    $polygon->point(60, 10);
                    $polygon->point(35, 60);
                    $polygon->background($this->getRandomColor());
                    $polygon->border('#000000', 1);
                });
                break;
        }
        $path = 'user_photos/'.$i.'.jpg';
        $image->save(Storage::disk('public')->path($path));
    }

    private function getRandomColor()
    {
        return '#'.dechex(rand(100, 255)).dechex(rand(100, 255)).dechex(rand(100, 255));
    }
}
