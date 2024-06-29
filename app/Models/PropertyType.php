<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'content',
        'icon_name',
        'type',
    ];

    /**
     * Get the user that owns the property post.
     */
    public function post()
    {
        return $this->hasMany(PropertyPost::class);
    }

}



