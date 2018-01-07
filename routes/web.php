<?php

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

/**
 * Map the landing page to the User List.
 */
Route::get('/', function (Request $request) {

        return redirect()->route('users.list');
});

/**
 * users routes
 */

Route::get('/users/list', 'UserController@listUsers')->name('users.list');

Route::get('/users/profile/me', 'UserController@getMyProfile')->name('users.profile.me');

Route::group(['middleware' => 'auth'], function() {

    Route::post('users/update', 'UserController@updateUser')->name('users.update');
});

/**
 * posts routes
 */

Route::get('/posts/list', 'PostController@listPosts')->name('posts.list');

Route::get('/posts/list/json', 'PostController@listPostsJSON')->name('posts.list.json');

Route::get('/posts/details/{id}', 'PostController@getPostDetails')->name('post.details');

Route::group(['middleware' => 'auth'], function() {

    Route::post('/posts/create', 'PostController@createPost')->name('posts.create');
});

/**
 * comments routes
 */

Route::group(['middleware' => 'auth'], function() {

    Route::post('/comments/create', 'CommentController@commentToPost')->name('comments.create');

    Route::post('/comments/reply-to-comment', 'CommentController@replyToComment')->name('comments.reply-to-comment');
});

/**
 * likes routes
 */

Route::group(['middleware' => 'auth'], function() {

    Route::post('/likes/create', 'LikeController@addLike')->name('likes.add');

    Route::post('/likes/delete', 'LikeController@deleteLike')->name('likes.delete');

});
