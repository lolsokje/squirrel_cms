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
    Route::middleware(['permission:manage'])->group(function () {
        Route::get('/users', 'AdminController@users')->name('admin.users');

        Route::get('/roles', 'RoleController@index')->name('admin.roles');

        Route::get('/role/create', 'RoleController@create')->name('admin.roles.create');

        Route::post('/role/store', 'RoleController@store')->name('admin.roles.store');

        Route::get('/roles/{role_name}', 'RoleController@edit')->name('admin.role.edit');

        Route::post('/roles/{role_name}/edit/permissions', 'RoleController@update')
            ->name('admin.roles.edit.permissions');

        Route::get('/users/{login_name}/edit', 'AdminController@editUser')->name('admin.users.edit');

        Route::post('/users/{login_name}/edit/roles', 'AdminController@editUserRoles')
            ->name('admin.users.edit.roles');

        Route::get('/categories', 'CategoryController@index')->name('admin.categories');

        Route::get('/categories/{name}/edit', 'CategoryController@edit')->name('admin.categories.edit');

        Route::post('/categories', 'CategoryController@store')->name('admin.categories.store');

        Route::post('/categories/{name}/update', 'CategoryController@update')->name('admin.categories.update');

        Route::get('/categories/create', 'CategoryController@create')->name('admin.categories.create');
    });

    Route::resources([
        'articles' => 'ArticleController'
    ]);

    Route::get('/', 'AdminController@index')->name('admin.index');

    Route::post('/users/update/{user}', 'AdminController@updateUser')->name('admin.users.update');

    Route::put('articles/{article}/republish', 'ArticleController@republish')->name('articles.republish');

    Route::put('articles/{article}/publish', 'ArticleController@publish')->name('articles.publish');

    Route::get('articles/generate/{count}', 'ArticleController@generate');

    Route::get('filters/articles', 'ArticleController@filter')->name('articles.filter');

    Route::post('article/duplicate_slug', 'HomeController@duplicateSlug');
});
