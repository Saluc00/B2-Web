<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', function() {
        return view('auth.login');
    });
});

Route::group(['middleware' => ['auth']], function() {

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/admin', 'AdminController@index');
        Route::get('/admin/change/{idUser}/{idRole}', 'AdminController@change');
    });

    Route::get('/', 'HomeController@index');
    Route::get('/album/{id}', 'AlbumController@index');
    Route::get('/recherche', 'RechercheController@index');
    Route::get('/profile/{id}', 'ProfileController@index');
    Route::get('/artiste/{id}', 'ArtistController@index');
    Route::get('/playlist/{id}', 'PlaylistController@index');
    Route::get('/playlistUser/{id}', 'PlaylistController@playlistUser');
    Route::get('/genre/{id}', 'GenreController@index');
    Route::get('/likes', 'LikeController@index');
    Route::get('/delete/playlist/{id}', 'PlaylistController@delete');
    Route::get('/deconnexion', function() {
        auth()->logout();
        return redirect('/login');
    });

    Route::post('/add/playlist/{idP}/{idM}', 'PlaylistController@addMusiquePlaylist');
    Route::post('/creer/playlist', 'PlaylistController@creer');
    Route::post('/profile/{id}', 'ProfileController@update');
    Route::post('/historique/{id}', 'HistoriqueController@add');
    Route::post('/like/{genre}/{id}', 'LikeController@add');
    Route::post('/update/playlist/{id}', 'PlaylistController@update');
});
