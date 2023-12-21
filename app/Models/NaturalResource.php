<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ResourceType;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class NaturalResource extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'type',
        'name',
        'description',
        'action_point',
        'experience_point',
        'damage_point',
    ];

    protected $casts = [
        'type' => ResourceType::class,
        'action_point' => 'integer',
        'experience_point' => 'integer',
        'damage_point' => 'integer',
    ];

    public function materials(): BelongsToMany
    {
        return $this->belongsToMany(Material::class)
            ->withPivot(['min_quantity', 'max_quantity']);
    }
}
