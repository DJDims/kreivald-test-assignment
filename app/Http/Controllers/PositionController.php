<?php

namespace App\Http\Controllers;

use App\Services\PositionService;
use Illuminate\Database\Eloquent\Collection;

class PositionController extends Controller
{
    private PositionService $positionService;

    public function __construct(PositionService $positionService)
    {
        $this->positionService = $positionService;
    }

    public function index(): Collection
    {
        return $this->positionService->index();
    }
}
