<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'group_user', 'group_id', 'user_id');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function groupusers(): HasMany
    {
        return $this->hasMany(GroupUser::class);
    }

    protected $fillable = [
        'name',
        'user_id',
        'invite_key',
        'public',
    ];
}
