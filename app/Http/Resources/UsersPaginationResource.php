<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersPaginationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'page' => $this->resource->currentPage(),
            'total_pages' => $this->resource->lastPage(),
            'total_users' => $this->resource->total(),
            'count' => $this->resource->perPage(),
            'links' => [
                'next_url' => $this->resource->nextPageUrl(),
                'prev_url' => $this->resource->previousPageUrl(),
            ],
            'users' => UserResource::collection($this->resource->items()),
        ];
    }
}
