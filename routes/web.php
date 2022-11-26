<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


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

//地図表示
Route::get('/pin', 'App\Http\Controllers\PinController@index')->name("get.index");
//DBにタイトル、コメント登録
Route::post('/add', 'App\Http\Controllers\PinController@store')->name("post.store");

Route::get('/show', 'App\Http\Controllers\PinController@show');


// Route::get('/', function () {
//     return view('welcome');
// });