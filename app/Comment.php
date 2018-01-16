<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    const NOPARENT = -1;
    /**
     * @var array
     *
     * parent_id is set to -1 if it is a reply to a main post.
     */
    protected $fillable = [
        'id',
        'post_id',
        'reply_parent_id',
        'owner_id',
        'msg'
    ];

    /**
     * Comment constructor.
     * This is comment to a main post. Thus, its reply_parent_id is set to no parent.
     *
     * @param int $postId
     * @param int $owner_id
     * @param string $msg
     */
    public function __construct()
    {

    }

    /**
     * @param int $postId
     * @param int $owner_id
     * @param string $msg
     * @param $reply_parent_id : refers to id of the comment that it is replying to.
     * @return static
     */
    public static function asComment(int $postId, int $ownerId, string  $msg)
    {
        $instance = new static();
        $instance->post_id = $postId;
        $instance->owner_id = $ownerId;
        $instance->msg = $msg;

        $instance->reply_parent_id = Comment::NOPARENT;

        return $instance;
    }

    /**
     * @param int $postId
     * @param int $owner_id
     * @param string $msg
     * @param $reply_parent_id : refers to id of the comment that it is replying to.
     * @return static
     */
    public static function asReply(int $postId, int $owner_id, string  $msg, $reply_parent_id)
    {
        $instance = Comment::asComment($postId, $owner_id, $msg);

        $instance->reply_parent_id = $reply_parent_id;

        return $instance;
    }

    public static function getNumberOfCommentsForPost(int $postId)
    {
        return Comment::where('post_id', $postId)->count();
    }

}
