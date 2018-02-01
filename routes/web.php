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
    return redirect('/google');
});

Auth::routes();
Route::get('/google', 'GoogleController@index');
Route::get('/callback', 'GoogleController@callback');
Route::get('/delete/{id}','GoogleController@destroy');
Route::post('/post','GoogleController@store');
Route::get('/register', 'RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'RegisterController@register');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::group(['prefix' => 'admin', 'middleware' => ['admin_menu','admin_auth']], function () {
    Route::get('/logout', 'Auth\LoginController@logout')->name('admin.auth.logout');
    Route::get('/dashboard', 'HomeController@index')->name('admin.get_home');
    
});


//Route::get('/{any}', function () {
//        return redirect('/login');
//})->where('any', '.*s');
