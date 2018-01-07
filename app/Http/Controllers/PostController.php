<?php

namespace App\Http\Controllers;

use App\PostLike;
use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\Comment;
use App\Guest;

class PostController extends Controller
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
     * Create a Post
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    // get image from upload-image page 
    public function createPost(Request $request)
    {
        $this->validate($request, [
            'msg' => 'required|max:2048',
        ]);

        $post = Post::withUserIdAndMsg(
            Auth::user()->id,
            $request->msg
        );

        $post->save();

        return redirect()
            ->to('/posts/list')
            ->with('success','Post has been uploaded successfully.');
    }

    /**
     * List every post
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listPosts()
    {
        $user = (Auth::user() === NULL) ? new Guest() : Auth::user();
        $posts = Post::orderBy('id', 'desc')->get();

        $likes = array();

        foreach($posts as $post) {
            $like = PostLike::getLike($post->id);
            array_push($likes, $like);
        }

        return view('posts/list', [
            'user' => $user,
            'posts' => $posts,
            'likes' => $likes
        ]);
    }

    /**
     * List every post
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listPostsJSON()
    {
        $user = (Auth::user() === NULL) ? new Guest() : Auth::user();
        $posts = Post::orderBy('id', 'desc')->get();

        $likes = array();

        foreach($posts as $post) {
            $like = PostLike::getLike($post->id);
            array_push($likes, $like);
        }

        $response = array(
            'user' => $user,
            'posts' => $posts,
            'likes' => $likes
        );

        return response()->json($response);
    }

    /**
     * Get details of the post by post id
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPostDetails(Request $request)
    {
        $user = (Auth::user() === NULL) ? new Guest() : Auth::user();
        $post = Post::where('id', $request->id)->first();
        $comments = Comment::where('post_id', $request->id)->get();
        $repliesToComments = Comment::where('post_id', $request->id)->where('reply_parent_id', '<>', '-1')->get();

        return view('posts/details', [
            'user' => $user,
            'post' => $post,
            'comments' => $comments,
            'repliesToComments' => $repliesToComments
        ]);
    }

}
