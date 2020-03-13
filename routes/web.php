<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('index');

Route::get('/login', 'HomeController@login')->name('login');

Route::get('/redirect', 'HomeController@redirect')->name('redirect');

Route::get('/logout', 'HomeController@logout')->name('logout');

Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.index');

    Route::post('/users/update/{user}', 'AdminController@updateUser')->name('admin.users.update');

    Route::get('/users', 'AdminController@users')->name('admin.users')->middleware(['permission:manage']);

    Route::get('/users/{login_name}/edit', 'AdminController@editUser')
        ->name('admin.users.edit')->middleware(['permission:manage']);

    Route::resources([
        'articles' => 'ArticleController'
    ]);

    Route::put('articles/{article}/republish', 'ArticleController@republish')->name('articles.republish');

    Route::put('articles/{article}/publish', 'ArticleController@publish')->name('articles.publish');

    Route::get('articles/generate/{count}', 'ArticleController@generate');

    Route::get('filters/articles', 'ArticleController@filter')->name('articles.filter');

    Route::post('article/duplicate_slug', 'HomeController@duplicateSlug');
});
