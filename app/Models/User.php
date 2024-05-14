<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Traits\HasRoles;

/**
 * @mixin Builder
 */

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'submitted_at',
        'submission_count',
        'accepted_at',
        'accepted_by',
        'became_member_at',
        'membership_expires_at',
        'declined_at',
        'declined_by',
        'password',
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
        'submitted_at' => 'datetime',
        'submission_count' => 'integer',
        'accepted_at' => 'datetime',
        'became_member_at' => 'datetime',
        'membership_expires_at' => 'datetime',
        'declined_at' => 'datetime',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function acceptedBy(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'accepted_by');
    }

    public function declinedBy(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'declined_by');
    }
}
