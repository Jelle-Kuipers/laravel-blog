<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model {
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'create_update_post' => 'boolean',
        'create_update_reply' => 'boolean',
        'delete_post' => 'boolean',
        'delete_reply' => 'boolean',
        'delete_others_post' => 'boolean',
        'manage_others' => 'boolean',
    ];

    /**
     * Get the user associated with the permission.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
