<?php

namespace App\Http\Resources;

use App\Models\NaturalResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read NaturalResource $resource
 */
class NaturalResourceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->getKey(),
            'type' => $this->resource->type,
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'quantity' => $this->resource->pivot->quantity,
        ];
    }
}
