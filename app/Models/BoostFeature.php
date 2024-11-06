<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoostFeature extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'desc',
    ];

    /**
     * Get the user that owns the property post.
     */
    public function boost()
    {
        return $this->belongsTo(Boost::class);
    }
}
