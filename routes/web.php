<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['web']], function () {
    // Route::get('/', function () {
    //     return view('welcome');
    // });
    
    Auth::routes();
    Route::post('password/reset/{token?}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::get('/home', 'HomeController@index')->name('home');
//profile
Route::get('author/{id}', 'UserController@index')->name('users.index');
Route::resource('users', 'UserController')->except('index');

//posts
Route::resource('posts', 'PostController');
//comments
Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store' ]);
Route::get('comments/{id}/edit', ['uses' => 'CommentsController@edit', 'as' => 'comments.edit']);
Route::patch('comments/{id}', ['uses' => 'CommentsController@update', 'as' => 'comments.update']);
Route::delete('comments/{id}', ['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);
Route::get('comments/{id}/delete', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete']);
//blog
Route::get('blog/{slug}', 'BlogController@getSingle')->name('blog.single')->where('slug','[\w\d\-\_]+');
Route::get('/', 'BlogController@getIndex')->name('blog.index');
});
