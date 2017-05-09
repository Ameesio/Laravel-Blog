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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/featured', function () {
    return view('featured');
})->name('featured');

Route::get('/newposts', function () {
    return view('newposts');
})->name('newposts');

Route::get('/myblog','Controller@myblogPosts',function () {
    return view('myblog');
})->name('myblog');

Route::get('/adminpanel', function () {
    return view('adminpanel');
})->name('adminpanel');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/mybloge', 'Controller@editPost')->name('editPost');

Route::post('/myblog', 'Controller@insert')->name('insertPost');

Route::post('/accountsettings', 'Controller@updateBlog')->name('updateBlog');

Route::get('/', 'Controller@homePosts')->name('homePosts');

Route::get('/accountsettings', function () {
    return view('accountsettings');
})->name('accountSettings');

Route::get('/bigbrother', function () {
    return view('bigbrother');
})->name('bigbrother');

Route::get('/postcontrol', function () {
    return view('postcontrol');
})->name('postcontrol');

Route::get('/bigbrother', 'Controller@getBigbrother')->name('bigbrother');

Route::get('/postcontrol', 'Controller@getPostControl')->name('postcontrol');

Route::post('/bigbrother', 'Controller@save_changes')->name('save_changes');

Route::post('/adminpanel', 'Controller@delete_user')->name('delete');

Route::post('/postcontrol', 'Controller@delete_post')->name('deletePost');

Route::post('/blogee', 'Controller@delete_userpost')->name('deletePost2');

Route::get('/newposts', 'Controller@getNewPosts')->name('newposts');

Route::post('/contact', 'Controller@becomeBlogger')->name('becomeblogger');