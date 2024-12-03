<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginationRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UsersPaginationResource;
use App\Services\UserService;
use App\Services\PhotoService;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCreatedResource;
use Illuminate\Http\Request;


class UserController extends Controller
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function store(UserRequest $request): UserCreatedResource
    {
        $data = $request->validated();
        $user = $this->service->store($data, $request->file('photo'));
        return new UserCreatedResource($user);

    }

    public function index(PaginationRequest $request)
    {
        $paginationData = $request->paginationData();
        $data = $this->service->index($paginationData);
        if ($paginationData['page'] > $data->lastPage()) return response()->json([
            'success' => false,
            'message' => 'Page not found.'
        ]);
        return new UsersPaginationResource($data);
    }

    public function show($id)
    {
        $user = $this->service->show($id);
        return response()->json([
            'success' => true,
            'user' => new UserResource($user),
        ]);
    }
}
