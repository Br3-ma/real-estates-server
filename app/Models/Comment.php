<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    // Define the fillable properties for mass assignment
    protected $fillable = [
        'user_id',
        'post_id',
        'content',
        'parent_id', // If you have nested comments
    ];

    // Optionally, define casts for attributes
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Define relationships

    /**
     * Get the user that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the post that the comment belongs to.
     */
    public function post()
    {
        return $this->belongsTo(PropertyPost::class);
    }

    /**
     * Get the replies for the comment.
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    /**
     * Get the parent comment.
     */
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}

