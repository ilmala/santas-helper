<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MaterialResource;
use App\Services\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function __invoke(Request $request)
    {
        $inventory = new Inventory($request->user()->fresh());

        return response()->json([
            'materials' => MaterialResource::collection($inventory->list()),
        ]);
    }
}
