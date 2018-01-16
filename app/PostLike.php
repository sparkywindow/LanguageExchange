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
        $instance->target_id = $postId;
        $instance->user_names_json = json_encode(array());
        return $instance;
    }

    static function getLike(int $targetId)
    {
        $like = PostLike::where('target_id', $targetId)->get()->first();

        if(!isset($like)) {

            $like = PostLike::withPostId($targetId);
        }

        return $like;
    }

//    static function saveLike(Like $like, int $targetId) : bool
//    {
//        $like = PostLike::getLike($targetId);
//
//        return PostLike::where('target_id', $targetId)->update(array(
//            'id' => $like->id,
//            'target_id' => $like->target_id,
//            'user_names_json' => $like->user_names_json
//        ));
//    }
}
