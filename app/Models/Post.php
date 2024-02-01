<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string, string>
     */
    protected $fillable = [
        'content',
        'title',
        'topic_id',
        'user_id',
        'thumbnail_path',
        'description',
    ];

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
     * Get the comments associated with the post.
     */
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the topic associated with the post.
     */
    public function topic() {
        return $this->belongsTo(Topic::class);
    }

    /**
     * Get the user associated with the post.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the votes associated with the post.
     */
    public function votes() {
        return $this->hasMany(PostVote::class);
    }
}
