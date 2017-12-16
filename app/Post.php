<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'title',
        'detail',
        'upvoted',
        'views',
    ];

    public function __construct() {

        $this->upvoted = 0;
        $this->views = 0;
    }

    /*
     * Helper function to create Post with just title, and detail.
     */
    public static function withUserIdTitleAndDetail(string $userId, string $title, string $detail) {

        $instance = new static();
        $instance->user_id = $userId;
        $instance->title = $title;
        $instance->detail = $detail;

        return $instance;
    }

}
