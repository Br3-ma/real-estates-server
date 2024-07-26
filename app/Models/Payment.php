<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'description',
        'amount',
        'item',
        'txn_fee',
        'txn_ref',
        'txn_status',
        'status',
    ];

    public function user(){
        return $this->belongsTo(PropertyPost::class);
    }

    public function property_post(){
        return $this->belongsTo(PropertyPost::class);
    }
}
