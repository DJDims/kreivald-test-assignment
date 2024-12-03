<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function store($data, $photo)
    {
        $path = PhotoService::processImage($photo);
        $data['photo'] = 'storage/'.$path;
        return User::create($data);
    }

    public function index($paginationData)
    {
        return User::paginate($paginationData['count'], ["*"], 'page', $paginationData['page']);
    }

    public function show($id)
    {
        return User::find($id);
    }
}
