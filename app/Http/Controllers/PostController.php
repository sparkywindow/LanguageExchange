<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Auth;
use App\Post;

class PostController extends Controller
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
    * post Post Request
    * 
    */
    // get image from upload-image page 
    public function postPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:2048',
            'detail' => 'required|max:2048',
        ]);

        $post = new Post;
        $post->user_id = Auth::user()->id;
        $post->title = $request->title;
        $post->content = $request->detail;
        $post->upvoted = 0;
        $post->views = 0;

//        var_dump($post); exit();

        $post->save();

        return redirect()
            ->to('/postsTab')
            ->with('success','Post has been uploaded successfully.');
    }

}
