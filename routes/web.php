<?php

use App\Task;
use App\User;
use App\Post;
use App\Guest;
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
    $userList = User::orderBy('created_at', 'asc')->get();

    $user = (Auth::user() === NULL) ? new Guest() : Auth::user();

    return view('tabs/peopleTab', [
        'user' => $user,
        'userList' => $userList
    ]);
    
});

Route::get('/postsTab', function (Request $request) {

    $user = (Auth::user() === NULL) ? new Guest() : Auth::user();
    $posts = Post::all();

    return view('tabs/postsTab', [
        'user' => $user,
        'posts' => $posts
    ]);
    
});

Route::get('/preferenceTab', function (Request $request) {

    $user = (Auth::user() === NULL) ? new Guest() : Auth::user();

    return view('tabs/preferenceTab', [
        'user' => $user,
    ]);
    
});

Route::post('/Post/post', 'PostController@postPost')->name('Post.post');

Route::post('user/update', [
    'uses' => 'UserController@updateUser'
])->name('user.update');

Route::post('/image/post', 'ImageController@postProfileImage')->name('postProfileImage');

Route::get('/aloha', function (Request $request) {
    $sparky = $request->session()->get('key');
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
