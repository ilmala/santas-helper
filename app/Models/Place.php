<?php

namespace App\Models;

use App\Enums\PlaceType;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Place extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'type',
        'name',
        'description',
        //'exits'
    ];

    protected $casts = [
        'type' => PlaceType::class,
    ];

    public function exits(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Place::class,
            table: 'exit_place',
            foreignPivotKey: 'place_id',relatedPivotKey: 'exit_id'
        )->withPivot(['direction']);
    }

    public function resources(): BelongsToMany
    {
        return $this->belongsToMany(NaturalResource::class)
            ->withPivot(['quantity']);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
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
