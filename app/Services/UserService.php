<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function store($data, $photo)
    {
        $path = PhotoService::processImage($photo);
        $data['photo'] = $path;
        return User::create($data);
    }

    public function index(): Collection
    {
        return User::all();
    }

    public function show($id)
    {
        return User::find($id);
    }
}
