<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
        'id',
        'post_id',
        'mata',
        /*
         * meta structure is as follows
         *
         * meta: [
         *  {
         *      msg: "text"
         *      user_id: "user_id"
         *      upvoted_by: [userId1, userId2, userId3...]
         *      created_by: "date"
         *      modified_by: "date"
         *      repliesToThis: [
         *          {
         *              msg: "text"
         *              user_id: "user_id"
         *              upvoted_by: [userId1, userId2, userId3...]
         *          },
         *          {
         *              msg: "text"
         *
         *              user_id: "user_id"
         *              upvoted_by: [userId1, userId2, userId3...]
         *          },
         *      ]
         *  }, //more replies follow
         * ]
         */
    ];

    public function __construct()
    {
        $this->meta = json_encode(array());
    }

    public static function withPostId(string $postId)
    {
        $instance = new static();
        $instance->post_id = $postId;

        return $instance;
    }

    private function makeReply(string $userId, string $msg)
    {
        $reply = array(
            "user_id" => $userId,
            "msg" => $msg,
            "upvoted_by" => array(),
            "created_by" => date("Y-m-d H:i:s"),
            "modified_by" => NULL,
            "repliesToThis" => array(),
        );

        return $reply;
    }

    private function makeReplyToReply(string $userId, string $msg)
    {
        $reply = array(
            "user_id" => $userId,
            "msg" => $msg,
            "upvoted_by" => array(),
            "created_by" => date("Y-m-d H:i:s"),
            "modified_by" => NULL,
        );

        return $reply;
    }

    public function addReplyToPost(string $userId, string $msg)
    {
        $meta = json_decode($this->meta);
        array_push($meta, $this->makeReply($userId, $msg));
        $this->meta = json_encode($meta);

        return $this;
    }

    public function addReplyToReply(string $userId, string $msg, string $replySequence)
    {
        $meta = json_decode($this->meta);
        $replyToReply = $this->makeReplyToReply($userId, $msg);

        //get the reply of the right sequence and insert new reply
        array_push($meta[$replySequence]->repliesToThis, $replyToReply);
        $this->meta = json_encode($meta);

        return $this;
    }

}
