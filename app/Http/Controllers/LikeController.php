<?php

namespace App\Http\Controllers;

use App\CommentLike;
use App\PostLike;
use App\Guest;
use Illuminate\Http\Request;
use Auth;


class LikeController extends Controller
{
    /**
     * Type of like to determine whether it is a commentLike or postLike
     */
    const COMMENT_TYPE = "comment";

    private $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = (Auth::user() === NULL) ? new Guest() : Auth::user();

    }

    public function like(Request $request)
    {
        $this->validate($request, [
            'likeType' => 'required|max:2048',
            'targetId' => 'required|max:2048',
        ]);

        $like = ($request->likeType === LikeController::COMMENT_TYPE) ? new CommentLike() : new PostLike();
        $like = $like->like($request->targetId, $this->user->id);

        $response = array(
            'status' => 'success',
            'like' => $like,
        );
        return response()->json($response);
    }

    public function unlike(int $targetId, int $userId, string $likeType) : int
    {
        if($likeType === LikeController::COMMENT_TYPE)
            CommentLike::unlike($targetId, $userId);
        else
            PostLike::unlike($targetId, $userId);
    }


}
