<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'bio',
        'work',
        'location',
        'website',
        'gender',
        'cover',
        'picture',
        'otp',
        'is_verified_otp',
        'google_id',
        'google_pic',
        'fname',
        'lname',
        'current_team_id',
        'role',
        'isSub',
        'is_plan_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
        'total_posts_count', // Derived attribute 1
        'total_active_posts_count', // Derived attribute 2
        'estimate_profit', // Derived attribute 2
    ];

    public function posts(){
        return $this->hasMany(PropertyPost::class);
    }

    /**
     * Get total posts count.
     *
     * @return int
     */
    public function getTotalPostsCountAttribute()
    {
        return $this->posts()->count();
    }

    /**
     * Get total active posts count.
     *
     * @return int
     */
    public function getTotalActivePostsCountAttribute()
    {
        return $this->posts()->count();
        // return $this->posts()->where('status', 'active')->count();
    }

    /**
     * Get total active posts count.
     *
     * @return int
     */
    public function getEstimateProfitAttribute()
    {
        return $this->posts()->sum('price');
        // return $this->posts()->where('status', 'active')->count();
    }
}


