<?php

namespace App\Http\Controllers;

use App\PostLike;
use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\Comment;
use App\Guest;
use App\User;

class PostController extends Controller
{
    private $PostLike;
    private $user;

    /**
     * PostController constructor.
     * @param PostLike $postLike
     */
    public function __construct(PostLike $postLike)
    {
        $this->PostLike = $postLike;

        $this->middleware(function($request, $next) {
            $this->user = (Auth::user() === NULL) ? new Guest() : Auth::user();

            return $next($request);
        });
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
            $this->user->id,
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
    public function listPostsView()
    {
        return view('posts/list', [
            'user' => $this->user,
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function listPostsJSON()
    {
        $posts = Post::orderBy('id', 'desc')->get();

        $likes = array();
        $numberOfComments = array();
        $firstComments = array();
        $profilePictureUrls = array();

        foreach($posts as $post) {
            $like = PostLike::getLike($post->id);
            array_push($likes, $like);

            $firstComment = Comment::where('post_id', $post->id)->get()->first();
            array_push($firstComments, $firstComment ? $firstComment->msg : "");

            $numberOfCommentsForThePost = Comment::getNumberOfCommentsForPost($post->id);
            array_push($numberOfComments, $numberOfCommentsForThePost);

            $profilePictureUrl = User::getProfilePictureUrlWithId($post->user_id, array('width' => 50, 'height' => 50));
            array_push($profilePictureUrls, $profilePictureUrl);
        }

        $response = array(
            'user' => $this->user,
            'posts' => $posts,
            'likes' => $likes,
            'numberOfComments' => $numberOfComments,
            'firstComments' => $firstComments,
            'profilePictureUrls' => $profilePictureUrls
        );

        return response()->json($response);
    }

    /**
     * Get details of the post by post id
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPostDetailsView(Request $request)
    {
        $post = Post::where('id', $request->id)->first();
        $comments = Comment::where('post_id', $request->id)->get();
        $repliesToComments = Comment::where('post_id', $request->id)->where('reply_parent_id', '<>', '-1')->get();

        return view('posts/details', [
            'user' => $this->user,
            'post' => $post,
            'comments' => $comments,
            'repliesToComments' => $repliesToComments
        ]);
    }

}
