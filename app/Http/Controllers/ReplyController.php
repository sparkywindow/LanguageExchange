<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Reply;

class ReplyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    *
    *
    */
    public function createReplyToPost(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required|max:2048',
            'msg' => 'required|max:2048',
        ]);

        //check and create a post if it does not exist
        $reply= Reply::where('post_id', $request->post_id)->first();
        if($reply == null)
            $reply = Reply::withPostId($request->post_id);

        $reply = $reply->addReplyToPost(Auth::user()->id, $request->msg);

        $reply->save();

        return redirect()
            ->to('/posts/details/' . $request->post_id)
            ->with('success','Post has been uploaded successfully.');
    }

    /**
     *
     *
     */
    public function createReplyToReply(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required|max:2048',
            'msg' => 'required|max:2048',
            'replySequence' => 'required|max:2048',
        ]);

        $reply= Reply::where('post_id', $request->post_id)->first();

        //@todo if reply does not exist, do something

        $reply = $reply->addReplyToReply(
            Auth::user()->id,
            $request->msg,
            $request->replySequence
        );

        $reply->save();

        return redirect()
            ->to('/posts/details/' . $request->post_id)
            ->with('success','Post has been uploaded successfully.');
    }

}
