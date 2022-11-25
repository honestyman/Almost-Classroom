<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    use HasFactory;

    protected $table = 'group_user';

    protected $fillable = [
        'post_id',
        'user_id',
    ];
    
    public function post()
    {
        return $this->belongsTo(Group::class);
    }
}
