<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function groups() {
        return $this->belongsToMany(Group::class, 'group_user', 'user_id', 'group_id');
    }

    public function posts() {
        //return $this->hasMany(Post::class);
        return $this->belongsToMany(Post::class, 'post_user', 'user_id', 'post_id');
    }
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'bio'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
}
