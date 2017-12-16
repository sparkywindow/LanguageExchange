<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
        'id',
        'post_id',
        'user_id',
        'content',
        'replies_to_reply',
        'upvoted',
    ];
}
