<?php

namespace App;

use Validator;

class CommentLike extends Like
{
    protected $fillable = [
        'id',
        'target_id',
        'user_names_json'
    ];

    public function __construct() {

    }

    static function getLike(int $targetId)
    {
        return CommentLike::where('target_id', $targetId)->get()->first();
    }
    
}
