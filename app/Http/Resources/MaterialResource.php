<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Material $resource
 */
class MaterialResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->getKey(),
            'name' => $this->resource->name,
            'cost' => $this->resource->cost,
            'weight' => $this->resource->weight,
            'quantity' => $this->resource->pivot->quantity,
        ];
    }
}
