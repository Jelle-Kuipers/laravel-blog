<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'content' => 'string', //Not sure about this one
        'score' => 'float',
    ];

    /**
     * Get the post associated with the comment.
     */
    public function post() {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the user associated with the comment.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
