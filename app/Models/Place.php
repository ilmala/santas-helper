<?php

namespace App\Models;

use App\Enums\PlaceType;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Place extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'type',
        'name',
        'description',
    ];

    protected $casts = [
        'type' => PlaceType::class,
    ];

    public function resources(): BelongsToMany
    {
        return $this->belongsToMany(NaturalResource::class)
            ->withPivot(['quantity']);
    }

    public function decrementResources(NaturalResource $resource, int $quantity = 1): void
    {
        $this->resources()
            ->updateExistingPivot(
                id: $resource->id,
                attributes: [
                    'quantity' => $resource->pivot->quantity - $quantity
                ]
            );
    }
}
