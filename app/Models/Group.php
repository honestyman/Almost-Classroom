<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'group_user', 'group_id', 'user_id');
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }

    
    public function groupusers()
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
