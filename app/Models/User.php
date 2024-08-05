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
 * @mixin IdeHelperUser
 */

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

//    public mixed $first_name;
//    public mixed $last_name;
//    public mixed $email;
//    public mixed $phone_main;
//    public mixed $phone_main;
//    public mixed $phone_3;
//    public mixed $eoi_status;

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
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_main',
        'phone_mobile',
        'registration_fee_paid',
        'eoi_status',
        'submission_count',
        'submission_fee_paid',
        'submission_status',
        'submission_interview_at',
        'submission_accepted_at',
        'submission_accepted_by',
        'became_registrant_at',
        'registration_expires_at',
        'registration_pathway',
        'declined_at',
        'declined_by',
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
//        'submission_submitted_at' => 'datetime',
        'submission_count' => 'integer',
        'submission_accepted_at' => 'datetime',
        'became_registrant_at' => 'datetime',
        'registration_expires_at' => 'datetime',
        'declined_at' => 'datetime',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeSearch($query, $value)
    {
        $query->where('first_name', 'like', "%{$value}%")
              ->orWhere('last_name', 'like', "%{$value}%")
              ->orWhere('email', 'like', "%{$value}%");
    }

    public function scopePublicSearch($query, $value)
    {
        $query->where('first_name', 'like', "%{$value}%")
              ->orWhere('last_name', 'like', "%{$value}%");
    }

    public function acceptedBy(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'submission_accepted_by');
    }

    public function declinedBy(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'declined_by');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function eoi()
    {
        return $this->hasOne(Eoi::class);
    }

    public function submission()
    {
        return $this->hasOne(Submission::class);
    }
}
