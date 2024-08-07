<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The attributes that should be appended.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'total_posts',
        'estimate_profit',
        'total_properties',
    ];

    // /**
    //  * Boot method to attach model event listeners.
    // */
    // protected static function booted()
    // {
    //     static::addGlobalScope('withRelations', function ($builder) {
    //         $builder->with(['posts', 'favourites']);
    //     });
    // }

    public function getTotalPostsAttribute()
    {
        return $this->posts()->where('status_id', 1)->count();
    }

    public function getTotalPropertiesAttribute()
    {
        return $this->posts()->count();
    }

    public function getEstimateProfitAttribute()
    {
        return $this->posts()->sum('price');
    }


    public function posts(){
        return $this->hasMany(PropertyPost::class);
    }

    public function favourites(){
        return $this->hasMany(Favourite::class);
    }
}
