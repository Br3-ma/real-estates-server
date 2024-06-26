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
        'location_id',
        'category_id',
        'status_id',
        'bedrooms',
        'bathrooms',
        'area',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'decimal:2',
        // 'amenities' => 'array',
        // 'images' => 'array',
    ];

    /**
     * Boot the model and add global scopes.
     */
    protected static function boot()
    {
        parent::boot();

        // Ensure only records with a non-null user_id are retrieved and order them in descending order
        static::addGlobalScope('withUser', function ($builder) {
            $builder->with(['user', 'images'])
                    ->whereNotNull('user_id')
                    ->orderBy('created_at', 'desc'); // Adjust the column name if needed
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
        return $this->belongsTo(PropertyType::class);
    }

    /**
     * Get the property type for the property post.
     */
    // public function favourites()
    // {
    //     return $this->hasMany(Favourite::class);
    // }

    /**
     * Get the status for the property post.
     */
    public function status()
    {
        return $this->hasOne(Status::class);
    }

    /**
     * Get the images for the property post.
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    /**
     * Get the amenities for the property post.
     */
    public function amenities()
    {
        return $this->hasMany(Amenity::class);
    }

    /**
     * Get the categories for the property post.
     */
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the amenities for the property post.
     */
    public function type()
    {
        return $this->hasOne(PropertyType::class);
    }

    /**
     * Get the amenities for the property post.
     */
    public function location()
    {
        return $this->hasOne(Location::class);
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
