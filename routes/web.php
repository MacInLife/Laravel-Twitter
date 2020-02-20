<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/home', 'PostController@index')->name('home');
//Route::get('/home', 'UserController@index')->name('home');

Route::get('/profil', 'ProfilController@index')->name('profil');

//Route concernant les tweets
//Route de la méthode post tweet
Route::post('/home', 'PostController@create')->middleware('auth')->name('create.post');
//Route de la méthode delete tweet
Route::get('/home/{id}', 'PostController@destroy')->middleware('auth')->name('destroy.post');

//Route de la gestion du compte
//Route de vision du compte
Route::get('account', 'AccountController@show')->middleware('auth')->name('account');
//Route d'update du compte
Route::post('account/{id}', 'AccountController@update')->middleware('auth')->name('account.update');
//Route de la méthode delete account
Route::get('/account/{id}', 'AccountController@destroy')->middleware('auth')->name('account.destroy');
Auth::routes();
