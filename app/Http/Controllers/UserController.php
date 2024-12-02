<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\PhotoService;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResponseResource;


class UserController extends Controller
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function store(UserRequest $request): UserResponseResource
    {
        $data = $request->validated();
        $user = $this->service->store($data, $request->file('photo'));
        return new UserResponseResource($user);

    }

    public function index()
    {
        return $this->service->index();
    }

    public function show($id)
    {
        return $this->service->show($id);
    }
}
