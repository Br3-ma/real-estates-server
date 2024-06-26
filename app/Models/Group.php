<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;



    /**
     * Get the user that owns the property post.
     */
    public function post()
    {
        return $this->belongsTo(PropertyPost::class);
    }
}
