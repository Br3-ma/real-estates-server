<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyPost extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'price',
        'location',
        'long',
        'lat',
        'user_id',
        'property_type_id',
        'status_id',
        'bedrooms',
        'bathrooms',
        'area',
        'amenities',
        'images',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'decimal:2',
        'amenities' => 'array',
        'images' => 'array',
    ];

    /**
     * Boot the model and add global scopes.
     */
    protected static function boot()
    {
        parent::boot();

        // Ensure only records with a non-null user_id are retrieved
        static::addGlobalScope('withUser', function ($builder) {
            $builder->with('user')->whereNotNull('user_id');
        });
    }

    /**
     * Get the user that owns the property post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the property type for the property post.
     */
    public function propertyType()
    {
        // return $this->belongsTo(PropertyType::class);
    }

    /**
     * Get the status for the property post.
     */
    public function status()
    {
        // return $this->belongsTo(Status::class);
    }

    /**
     * Get the images for the property post.
     */
    public function images()
    {
        // return $this->hasMany(Image::class);
    }

    /**
     * Scope a query to only include active property posts.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to filter property posts by location.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $location
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLocatedAt($query, $location)
    {
        return $query->where('location', $location);
    }
}
