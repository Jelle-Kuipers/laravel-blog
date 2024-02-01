<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostVote extends Model {
    use HasFactory;

    /**
     * Get the user associated with the vote.
     */
    public function user() {
        return $this->hasOne(User::class);
    }

    /**
     * Get the post associated with the vote.
     */
    public function post() {
        return $this->hasOne(Post::class);
    }
}
