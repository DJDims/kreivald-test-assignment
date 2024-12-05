<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        JsonResource::withoutWrapping();
        $this->createFolders();
    }

    private function createFolders()
    {
        Storage::disk('public')->makeDirectory('tmp');
        Storage::disk('public')->makeDirectory('user_photos');
    }
}
