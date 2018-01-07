<?php

namespace App\Http\Controllers;

use App\CommentLike;
use App\PostLike;
use App\Like;
use Illuminate\Http\Request;
use Auth;


class LikeController extends Controller
{
    /**
     * Type of like to determine whether it is a commentLike or postLike
     */
    const COMMENT_TYPE = "comment";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function addLike(Request $request)
    {
        $response = array(
            'status' => 'success',
            'msg' => 'aloha',
        );
        return response()->json($response);

//        $like = $likeType === LikeController::COMMENT_TYPE ? new CommentLike() : new PostLike();
//
//        return $like->addLike($targetId, $userId);
    }

    public function removeLike(int $targetId, int $userId, string $likeType) : int
    {
        if($likeType === LikeController::COMMENT_TYPE)
            CommentLike::unLike($targetId, $userId);
        else
            PostLike::unLike($targetId, $userId);
    }


}
