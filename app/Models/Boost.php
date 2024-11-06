<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boost extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'desc',
        'icon',
        'duration',
        'duration_type',
    ];

    /**
     * Get the user that owns the property post.
     */
    public function features()
    {
        return $this->hasMany(BoostFeature::class);
    }


}
