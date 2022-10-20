<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostUser extends Model
{
    use HasFactory;

    protected $table = 'post_user';

    protected $fillable = [
        'post_id',
        'user_id',
        'finished',
    ];
    
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
