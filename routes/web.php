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

Route::get('/', 'EventController@index');

Route::get('/registration', function () {
    return view('registration');
});
//Route::get('/mainpage', function () {
    //return view('mainpage');
//});

//Route::get('postEvent', function () {
    //return view('postEvent');
//});


//Route::get('mainpage/{id}', 'EventController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/postEvents','EventController');

Route::post('/posts', 'EventController@store');

Route::get('/list_culture', 'EventController@listculture');

Route::get('/list_sports', 'EventController@listsports')->name('sportsSort');

Route::get('/list_other', 'EventController@listother')->name('otherSort');

Route::put('like/{postEvent}', 'EventController@like')->name('postEvents.like');

Route::get('mostRecent','EventController@mostRecent')->name('postEvents.mostRecent');

Route::get('mostliked','EventController@mostLiked')->name('postEvents.mostLiked');
