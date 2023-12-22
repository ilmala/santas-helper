<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read User $resource
 */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->resource->name,
            'kind' => $this->resource->kind,
            'level' => $this->resource->level,
            'experience' => $this->resource->experience,
            'stars' => $this->resource->stars,
            'health' => [
                'current' => $this->resource->health,
                'max' => $this->resource->max_health,
            ],
            'crystal' => [
                'current' => $this->resource->crystal,
                'max' => $this->resource->max_crystal,
            ],
            'action' => [
                'current' => $this->resource->action,
                'max' => $this->resource->max_action,
            ],
            'weight' => [
                'current' => $this->resource->weight,
                'max' => $this->resource->max_weight,
            ],
            'place' => new PlaceResource($this->whenLoaded('place')),
        ];
    }
}
