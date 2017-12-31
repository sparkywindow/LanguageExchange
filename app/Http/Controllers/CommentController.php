<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Comment;

class CommentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
    *
    *
    */
    public function commentToPost(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required|max:2048',
            'msg' => 'required|max:2048',
        ]);

        $ownerId = Auth::user()->id;

        $comment = Comment::asComment($request->post_id, $ownerId, $request->msg);

        $comment->save();

        return redirect()
            ->to('/posts/details/' . $request->post_id)
            ->with('success','Post has been uploaded successfully.');
    }

    /**
     *
     *
     */
    public function replyToComment(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required|max:2048',
            'reply_parent_id' => 'required|max:2048',
            'msg' => 'required|max:2048',
        ]);

        $comment= Comment::asReply($request->post_id, Auth::user()->id , $request->msg, $request->reply_parent_id);

        $comment->save();

        return redirect()
            ->to('/posts/details/' . $request->post_id)
            ->with('success','Post has been uploaded successfully.');
    }

}
