<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'path',
        'priority',
        'status',
        'proprty_post_id'
    ];

    public function post(){
        return $this->belongsTo(PropertyPost::class);
    }
}
