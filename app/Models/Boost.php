<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boost extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount', //string
        'desc', //string
        'icon', //string
        'duration', //integer
        'duration_type', //day. week. month, year
    ];

    /**
     * Get the user that owns the property post.
     */
    public function features()
    {
        return $this->hasMany(BoostFeature::class);
    }


}
