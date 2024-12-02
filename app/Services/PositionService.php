<?php

namespace App\Services;

use App\Models\Position;
use Illuminate\Database\Eloquent\Collection;

class PositionService
{
    public function index(): Collection
    {
        return Position::all();
    }
}
