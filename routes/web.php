<?php

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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('home');

Auth::routes();

Route::prefix('blogs')->group(function(){
    Route::get('', 'BlogsController@index')->name('blogs');
    Route::get('create', 'BlogsController@create')->name('blogs.create');
    Route::post('store', 'BlogsController@store')->name('blogs.store');

    //trashed routes
    Route::prefix('trash')->group(function(){
        Route::get('', 'BlogsController@trash')->name('blogs.trash');
        Route::get('{id}/restore', 'BlogsController@restore')->name('blogs.restore');
        Route::delete('{id}/permanent-delete', 'BlogsController@permanentDelete')->name('blogs.permanent-delete');
    });

    Route::prefix('{id}')->group(function(){
        Route::get('', 'BlogsController@show')->name('blogs.show');
        Route::get('edit', 'BlogsController@edit')->name('blogs.edit');
        Route::patch('update', 'BlogsController@update')->name('blogs.update');
        Route::delete('delete', 'BlogsController@delete')->name('blogs.delete');
    });
});


//Admin Routes
Route::prefix('admin')->group(function(){
    Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('blogs', 'AdminController@blogs')->name('admin.blogs');
});

// route resource
Route::resource('categories', 'CategoryController');
Route::resource('users', 'UserController');


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

//contact routes
Route::prefix('contact')->group(function(){
    Route::get('', 'MailController@contact')->name('contact');
    Route::post('send', 'MailController@send')->name('mail.send');
});