<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\MaterialType;
use App\Enums\ResourceType;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Material extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'type',
        'cost',
        'weight',
    ];

    protected $casts = [
        'type' => MaterialType::class,
        'cost' => 'integer',
        'weight' => 'integer',
    ];

    public function resource(): BelongsToMany
    {
        return $this->belongsToMany(NaturalResource::class)
            ->withPivot(['min_quantity', 'max_quantity']);
    }
}
