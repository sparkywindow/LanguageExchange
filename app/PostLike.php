<?php

namespace App;

use Validator;

class PostLike extends Like
{
    protected $fillable = [
        'id',
        'target_id',
        'user_names_json'
    ];

    public function __construct() {

    }

    static function withPostId(int $postId) : PostLike
    {
        $instance = new static();
        $instance->target_id = 0;
        $instance->user_names_json = json_encode(array());
        return $instance;
    }

    static function getLike(int $targetId) : Like
    {
        $like = PostLike::where('target_id', $targetId)->get();
        if(count($like))
            return $like;
        else
            return PostLike::withPostId($targetId);
    }

    static function saveLike(Like $like, int $targetId) : bool
    {
        $like = PostLike::getLike($targetId);
        
        return PostLike::where('target_id', $targetId)->update($like);
    }
}
