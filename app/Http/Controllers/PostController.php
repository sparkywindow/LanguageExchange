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
    public function createPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:2048',
            'detail' => 'required|max:2048',
        ]);

        $post = Post::withUserIdTitleAndDetail(
            Auth::user()->id,
            $request->title,
            $request->detail
        );

        $post->save();

        return redirect()
            ->to('/posts/list')
            ->with('success','Post has been uploaded successfully.');
    }

}
