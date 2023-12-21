<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Kind;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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

    public function materials(): BelongsToMany
    {
        return $this->belongsToMany(Material::class)->withPivot('quantity');
    }
}
