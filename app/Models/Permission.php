<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model {
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'create_update_post',
        'create_update_reply',
        'delete_post',
        'delete_reply',
        'delete_others_post',
        'delete_others_reply',
        'manage_topics',
        'manage_others',
    ];

    /**
     * Get the user associated with the permission.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
