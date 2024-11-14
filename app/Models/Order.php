<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Define the fillable attributes
    protected $fillable = [
        'post_id',
        'plan_id',
        'user_id',
        'type',
        'duration',
        'duration_type',
        'status',
    ];
}
