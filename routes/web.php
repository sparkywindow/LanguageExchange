<?php

use App\Task;
use App\User;
use App\Post;
use App\Guest;
use App\Reply;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {

    return redirect()->route('users.list');
});

Route::post('users/update', 'UserController@updateUser')->name('users.update');

Route::get('/users/list', function (Request $request) {
    $userList = User::orderBy('created_at', 'asc')->get();

    $user = (Auth::user() === NULL) ? new Guest() : Auth::user();

    return view('users/list', [
        'user' => $user,
        'userList' => $userList
    ]);
    
})->name('users.list');

Route::get('/users/profile/me', function (Request $request) {

    $user = (Auth::user() === NULL) ? new Guest() : Auth::user();

    return view('users/profile-me', [
        'user' => $user,
    ]);

})->name('users.profile.me');

Route::get('/posts/list', function (Request $request) {

    $user = (Auth::user() === NULL) ? new Guest() : Auth::user();
    $posts = Post::orderBy('id', 'desc')->get();

    return view('posts/list', [
        'user' => $user,
        'posts' => $posts
    ]);
    
})->name('posts.list');

Route::get('/posts/details/{id}', function (Request $request) {

    $user = (Auth::user() === NULL) ? new Guest() : Auth::user();
    $post = Post::where('id', $request->id)->first();
    $reply = Reply::where('post_id', $post->id)->get()->first();
    $reply = $reply == null ? Reply::withPostId($post->id) : $reply;
    $replies = json_decode($reply->meta);

    return view('posts/details', [
        'user' => $user,
        'post' => $post,
        'replies' => $replies,
    ]);

})->name('post.details');

Route::post('/posts/create', 'PostController@createPost')->name('posts.create');

Route::post('/replies/create', 'ReplyController@createReplyToPost')->name('replies.create');

Route::post('/replies/create/reply-to-reply', 'ReplyController@createReplyToReply')->name('replies.create-reply-to-reply');

Route::get('/privacy-policy', function (Request $request) {

    $user = (Auth::user() === NULL) ? new Guest() : Auth::user();

    return view('info/privacy-policy', [
        'user' => $user,
    ]);
});

/**
 * The code below is unrelated to the project.
 * Just left in here for reference for learning.
 */

Route::get('/ip', function (Request $request) {
    $request->session()->put('key', 'fasd');
    $ip = $_SERVER['REMOTE_ADDR'] ;
    return Response::json($ip);
});

Route::delete('/task/{id}', function ($id) {
    Task::findOrFail($id)->delete();

    return redirect('/');
});

Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/');
})->middleware('auth');
