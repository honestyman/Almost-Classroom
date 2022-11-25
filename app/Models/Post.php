<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'post_user', 'post_id', 'user_id');
    }

    public function group() {
        return $this->belongsTo(Group::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function postusers()
    {
        return $this->hasMany(PostUser::class);
    }

    protected $fillable = [
        'name',
        'content',
        'user_id',
        'group_id',
        'type',
        'deadline',
    ];
    
}
