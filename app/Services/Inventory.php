<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Material;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

readonly class Inventory
{
    public function __construct(private User $user)
    {
    }

    /**
     * @return Collection
     */
    public function list(): Collection
    {
        return $this->user->materials()
            ->orderBy('name')
            ->get();
    }

    public function get(): void
    {

    }

    /**
     * @param Material $material
     * @param int $quantity
     * @return void
     */
    public function put(Material $material, int $quantity = 1): void
    {
        $exists = $this->user->materials()->find($material->id);

        if ($exists) {
            $this->user->materials()->updateExistingPivot($material->id, ['quantity' => $exists->pivot->quantity + $quantity]);
        } else {
            $this->user->materials()->attach($material->id, ['quantity' => $quantity]);
        }

        // Recalculate user total weight
        $totalWeight = $this->user->materials()
            ->sum(DB::raw("(weight * quantity)"));

        $this->user->update(['weight' => $totalWeight]);
    }
}
