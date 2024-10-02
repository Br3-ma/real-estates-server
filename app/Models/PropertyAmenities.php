<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAmenities extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_post_id',
        'amenity_name'
    ];

    public function property()
    {
        return $this->belongsTo(PropertyPost::class, 'property_post_id');
    }
}
