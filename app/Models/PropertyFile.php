<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'status',
        'property_post_id',
    ];

    public function propertyPost()
    {
        return $this->belongsTo(PropertyPost::class, 'property_post_id');
    }
}
