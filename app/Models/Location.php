<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'content',
    ];

    public function property_post(){
        return $this->hasMany(PropertyPost::class);
    }
}
