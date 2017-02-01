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
});

Auth::routes();

Route::get('/home', 'HomeController@index');

//user
Route::get('/user','UserController@getLoggedInUser');
Route::resource('users','UserController');

//video
Route::get('/all-videos/{category}','VideoController@getByCategory');

Route::resource('videos','VideoController');

// facebook auth
Route::get('auth/facebook','Auth\SocialAuthController@redirectToFacebook')->name('facebook-redirect');
Route::get('auth/facebook/callback','Auth\SocialAuthController@handleFacebookCallback')->name('facebook-callback');

// google auth
Route::get('auth/google','Auth\SocialAuthController@redirectToGoogle')->name('google-redirect');
Route::get('auth/google/callback','Auth\SocialAuthController@handleGoogleCallback')->name('google-callback');


