<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Post extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'msg',
        'upvoted',
        'views',
    ];

    public function __construct() {

        $this->upvoted = 0;
        $this->views = 0;
    }

    /**
     * Alternative Constructor
     *
     * @param string $userId
     * @param string $msg
     * @return Post
     */
    public static function withUserIdAndMsg(int $userId, string $msg) : Post {

        $instance = new static();
        $instance->user_id = $userId;
        $instance->msg = $msg;

        return $instance;
    }

}
