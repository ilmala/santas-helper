<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Kind;
use App\Enums\UserState;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasUlids;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kind',
        'name',
        'email',
        'password',
        'health',
        'max_health',
        'crystal',
        'max_crystal',
        'action',
        'max_action',
        'weight',
        'max_weight',
        'level',
        'experience',
        'stars',
        'place_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'kind' => Kind::class,
        'status' => UserState::class,
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'health' => 'integer',
        'max_health' => 'integer',
        'crystal' => 'integer',
        'max_crystal' => 'integer',
        'action' => 'integer',
        'max_action' => 'integer',
        'weight' => 'integer',
        'max_weight' => 'integer',
        'level' => 'integer',
        'experience' => 'integer',
        'stars' => 'integer',
    ];

    public function recalculateWeight(): void
    {
        $totalWeight = $this->materials()
            ->sum(DB::raw("(weight * quantity)"));

        $this->update(['weight' => $totalWeight]);
    }

    public function canPerformAction(int $actionPoint = 1): bool
    {
        return $this->action >= 0 && $this->action >= $actionPoint;
    }

    public function performAction(int $actionPoint = 1): void
    {
        $this->decrement('action', $actionPoint);

        if($this->isTired()){
            $this->update(['status' => UserState::Tired]);
        }
    }

    public function isTired(): bool
    {
        return $this->action < 30;
    }

    public function gainExperience(int $experience=1): void
    {
        // @todo: check for level up
        $this->increment('experience', $experience);
    }

    /** Relations */

    public function materials(): BelongsToMany
    {
        return $this->belongsToMany(Material::class)->withPivot('quantity');
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }
}
