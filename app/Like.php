<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

abstract class Like extends Model
{
    protected $fillable = [
        'id',
        'target_id',
        'user_names_json'
    ];

    public function __construct() {

    }

    abstract static function getLike(int $parent);

//    abstract static function saveLike(Like $like, int $targetId) : bool;

    public function like(int $targetId, int $userId) : Like
    {
        $like = $this->getLike($targetId, $userId);

        $names = json_decode($like->user_names_json);

        array_push($names, $userId);

        $names = array_unique($names);

        $like->user_names_json = json_encode($names);

        $like->save();

        return $like;
    }

    public function unlike(int $targetId, int $userId) : Like
    {
        $like = $this->getLike($targetId);

        $names = json_decode($like->user_names_json);

        $names = array_diff($names, array($userId));

        $like->user_names_json = json_encode($names);

        $like->save();

        return $like;
    }

    public function checkIfLiked(int $targetId, int $userId) :bool
    {
        $like = $this->getLike($targetId);

        return in_array(json_decode($like->user_names_json), $userId);
    }

}
