<?php

namespace App\Http\Controllers\Api\Actions;

use App\Http\Controllers\Controller;
use App\Http\Resources\NaturalResourceResource;
use App\Http\Resources\PlaceResource;
use App\Models\Place;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LookController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();
        /** @var Place $place */
        $place = $user->place()
            ->with(['resources', 'exits', 'users'])
            ->first();

        return response()->json([
            'place' => new PlaceResource($place),
        ]);
    }
}
