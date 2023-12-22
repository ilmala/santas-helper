<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Actions;

use App\Http\Controllers\Controller;
use App\Models\NaturalResource;
use App\Models\Place;
use App\Models\User;
use App\Services\Inventory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CutController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $data = $request->validate([
            'target' => ['required', 'string']
        ]);

        /** @var User $user */
        $user = $request->user();

        /** @var Place $place */
        $place = $user->place;

        // Look if in the place there is resources
        $resource = $place->resources()
            ->where('name', 'LIKE', $data['target'])
            ->first();

        if ( ! $resource || $resource->pivot->quantity < 0) {
            return response()->json([
                'message' => "You look around, but you don't see a {$data['target']} in this area."
            ], 404);
        }

        // check if user have action points
        if (!$user->canPerformAction($resource->action_point)) {
            return response()->json([
                'message' => "You are too tired to perform this action. Maybe it's better to rest a little first!"
            ], 404);
        }

        $user->performAction($resource->action_point);

        $roll = rand(1, 8);
        if ($roll <= rand(1, 4)) {
            // @todo: Reduce tool durance
            $user->decrement('health', $resource->damage_point);

            return response()->json([
                'message' => "Damn! It seems you didn't manage to cut the tree!!! \nThe tree broke and fell on you. It gave you {$resource->damage_point} points of damage."
            ], 404);
        }

        $place->decrementResources($resource);
        $user->gainExperience($resource->experience_point);

        $generatedMaterials = [];
        $inventory = new Inventory($user->fresh());
        foreach ($resource->materials as $material) {
            $quantity = rand(
                min: $material->pivot->min_quantity,
                max: $material->pivot->max_quantity
            );

            $inventory->put($material, $quantity);

            $generatedMaterials[] = "({$quantity}) {$material->name}";
        }

        $generatedMaterialsMessage = implode(', ', $generatedMaterials);
        return response()->json([
            'message' => "Fantastic! You managed to cut the tree and divide it into several pieces. You have obtained: {$generatedMaterialsMessage} which you have loaded into your backpack!"
        ]);
    }
}
